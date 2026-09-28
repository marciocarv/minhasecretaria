<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SigeStudent;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\DB;

class SigeSyncController extends Controller
{

    public function show(Request $request)
    {
        // Iniciamos a consulta ao banco
        $query = SigeStudent::query();

        // Filtro Único Principal
        if ($request->filled('filtro_principal')) {
            if ($request->filtro_principal == 'bolsa_familia') {
                $query->where('has_bolsa_familia', true);
            } elseif ($request->filtro_principal == 'necessidades_especiais') {
                $query->whereNotNull('special_need');
            } elseif ($request->filtro_principal == 'transporte') {
                $query->whereNotNull('transport_route');
                
                // Se escolheu Transporte, verificamos se tem rota específica
                if ($request->filled('rota')) {
                    $query->where('transport_route', $request->rota);
                }
            }
        }

        // Buscamos todas as rotas diferentes cadastradas no banco para o select secundário
        $rotasDisponiveis = SigeStudent::whereNotNull('transport_route')
            ->select('transport_route')
            ->distinct()
            ->orderBy('transport_route')
            ->pluck('transport_route');

        // Usamos get() em vez de paginate() para que a lista completa vá para a impressora
        $students = $query->orderBy('class_name')->orderBy('name')->get();

        return view('sige.index', compact('students', 'rotasDisponiveis'));
    }

    public function sync(Request $request)
    {
        // 1. DADOS DE ACESSO
        $usuarioSige = '02728831157'; 
        $senhaSige = 'Mestre1990';
        $urlRelatorio = 'https://palmas.sigeeducacional.com.br/sige/indexrelatorio.php?url=4841A2D340886709F779C630BC9957F3&idunidade=41&ano=2026&idturma%5B%5D=25815&idturma%5B%5D=25816&idturma%5B%5D=25817&idturma%5B%5D=25818&idturma%5B%5D=25819&idturma%5B%5D=25820&idturma%5B%5D=25821&idturma%5B%5D=25822&idturma%5B%5D=25823&idturma%5B%5D=25824&idturma%5B%5D=25825&idturma%5B%5D=25826&idturma%5B%5D=25827&idturma%5B%5D=25828&idturma%5B%5D=25829&idturma%5B%5D=25830&idturma%5B%5D=25831&idturma%5B%5D=25832&mostraprofessor=0&ordenacaomatricula=0&colunavazia=0&impressaoseparada=0&tipoimpressao=1&datamatriculaate=&datamatricula=&idlocalizacao=&observacao=&campos%5B%5D=idpessoa&campos%5B%5D=nome&campos%5B%5D=idnecessidadeespecial&campos%5B%5D=descricaorotatransporteescolar&campos%5B%5D=descricaoprogramasocial'; 

        // 2. CONFIGURAÇÃO DE REDE COM USER-AGENT DE NAVEGADOR REAL
        $client = new Client(HttpClient::create([
            'verify_peer' => false,
            'verify_host' => false,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
                'Accept-Language' => 'pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
            ]
        ]));

        try {
            DB::beginTransaction();

            // PASSO 1: Acessar a tela de login
            $crawler = $client->request('GET', 'https://palmas.sigeeducacional.com.br/sige/index.php');

            // Checagem flexível: Procura por formulário ou pelo campo 'cpf'
            $hasForm = $crawler->filter('form')->count() > 0;
            $hasCpfInput = $crawler->filter('input[name="cpf"]')->count() > 0;

            if (!$hasForm && !$hasCpfInput) {
                // Captura o trecho do texto retornado para diagnóstico caso ainda seja bloqueado
                $preview = substr(trim(strip_tags($crawler->html())), 0, 120);
                throw new \Exception('A página de login não respondeu adequadamente. Resposta do SIGE: "' . $preview . '"');
            }

            // PASSO 2: Preencher e enviar o formulário de login
            if ($hasForm) {
                $form = $crawler->filter('form')->form();
            } else {
                $form = $crawler->selectButton('Entrar')->form();
            }

            $crawler = $client->submit($form, [
                'cpf' => $usuarioSige,
                'senha' => $senhaSige
            ]);

            // PASSO 3: Acessar a página do relatório
            $crawler = $client->request('GET', $urlRelatorio);

            // Verifica se o relatório carregou as tabelas
            $relatorioTabelas = $crawler->filter('table.table-relatorio');
            if ($relatorioTabelas->count() === 0) {
                throw new \Exception('Não foi possível carregar o relatório. Verifique se as credenciais de CPF/Senha estão corretas.');
            }

            // PASSO 4: Limpar a base antiga
            SigeStudent::truncate();

            // PASSO 5: Extração de Dados
            $relatorioTabelas->each(function ($tableNode) {

                $turma = 'N/A';
                $tabelasAnteriores = $tableNode->previousAll()->filter('table');
                if ($tabelasAnteriores->count() > 0) {
                    $colunasTabelaAnterior = $tabelasAnteriores->first()->filter('td');
                    if ($colunasTabelaAnterior->count() > 1) {
                        $turma = trim($colunasTabelaAnterior->eq(1)->text());
                    }
                }

                $tableNode->filter('tbody tr')->each(function ($tr) use ($turma) {
                    $tds = $tr->filter('td');

                    if ($tds->count() < 6) {
                        return;
                    }

                    $registration = trim($tds->eq(1)->text());
                    $name         = trim($tds->eq(2)->text());
                    $specialNeed  = trim($tds->eq(3)->text());
                    $transport    = trim($tds->eq(4)->text());
                    $social       = trim($tds->eq(5)->text());

                    if (empty($name) || empty($registration)) {
                        return;
                    }

                    $specialNeed = (stripos($specialNeed, 'Não possuem') !== false || empty($specialNeed)) ? null : $specialNeed;
                    $transport   = empty($transport) ? null : $transport;
                    $hasBolsa    = (stripos($social, 'BOLSA FAMILIA') !== false);

                    SigeStudent::create([
                        'registration'      => $registration,
                        'name'              => $name,
                        'class_name'        => $turma,
                        'transport_route'   => $transport,
                        'special_need'      => $specialNeed,
                        'has_bolsa_familia' => $hasBolsa,
                    ]);
                });
            });

            DB::commit();

            return redirect()->back()->with('success', 'Sincronização com o SIGE realizada com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao sincronizar com o SIGE: ' . $e->getMessage());
        }
    }
}