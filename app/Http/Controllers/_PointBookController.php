<?php

namespace App\Http\Controllers;

use App\Models\Employment_bond;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PointBookController extends Controller
{
    /**
     * Passo 1: Exibe a tela com os filtros (Mês, Feriados, Sábados Letivos e Servidores)
     */
    public function index()
    {
        $title = "Gerar Livro de Ponto para Impressão";

        $employment_bonds = Employment_bond::with('employee')
            ->join('employees', 'employment_bonds.employee_id', '=', 'employees.id')
            ->where('employment_bonds.status', 'ATIVO') // <-- Filtra apenas ativos
            ->orderBy('employees.name', 'asc')
            ->select('employment_bonds.*')
            ->get();

        return view('point.pointBook', [
            'title' => $title, 
            'employment_bonds' => $employment_bonds
        ]);
    }

    public function print(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'employment_bonds' => 'required|array'
        ]);

        // Removidas as barras invertidas \Carbon\Carbon para evitar o erro T_NS_SEPARATOR
        $date = Carbon::createFromFormat('Y-m',$request->month);
        $year =$date->year;
        $month =$date->month;
        $daysInMonth =$date->daysInMonth;
        
        $monthName = mb_strtoupper($date->locale('pt_BR')->translatedFormat('F/Y'));

        $holidays =$request->holidays ?? [];
        $saturdays =$request->saturdays ?? [];

        // Removida a barra invertida \App\Models\Employment_bond
        $bonds = Employment_bond::with(['employee', 'leaves', 'activityTimes'])
            ->whereIn('id', $request->employment_bonds)
            ->get();

        $pointSheets = [];

        foreach ($bonds as $bond) {$daysData = [];

            // Identifica se é vigia / escala 12x36
            $isVigia = in_array($bond->work_shift, ['12x36_diurno', '12x36_noturno']) || 
                       stripos($bond->post ?? '', 'vigia') !== false || 
                       stripos($bond->role ?? '', 'vigia') !== false;

            // Identifica se é noturno
            $isNightVigia = $isVigia && (
                $bond->work_shift === '12x36_noturno' || 
                stripos($bond->work_shift ?? '', 'noite') !== false || 
                stripos($bond->work_shift ?? '', 'noturno') !== false ||
                stripos($bond->post ?? '', 'noite') !== false
            );

            $workShift = strtolower($bond->work_shift ?? '');

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $currentDate = Carbon::createFromDate($year, $month,$day);
                $dateFormatted =$currentDate->format('Y-m-d');
                $dayOfWeek =$currentDate->dayOfWeek; // 0 = Dom, 6 = Sáb
                $currentEnglishDay = strtolower($currentDate->format('l')); // Dia da semana em inglês (ex: friday)

                $t1Status = 'NORMAL';$t1Obs = '';
                $t2Status = 'NORMAL';$t2Obs = '';

                // 1. Licença Médica
                /*$isLeave =$bond->leaves->filter(function ($leave) use ($currentDate) {
                    return $currentDate->between($leave->start_date,$leave->end_date);
                })->isNotEmpty();

                if ($isLeave) {
                    $t1Status = 'BLOCKED';$t1Obs = 'LICENÇA MÉDICA';
                    $t2Status = 'BLOCKED';$t2Obs = 'LICENÇA MÉDICA';
                }*/

                // 1. Busca se existe algum afastamento no dia atual
                $activeLeave = $bond->leaves->first(function ($leave) use ($currentDate) {
                    return $currentDate->between($leave->start_date, $leave->end_date);
                });

                if ($activeLeave) {
                    // Pega o nome do tipo em português e converte para MAIÚSCULO (ex: "FÉRIAS", "LICENÇA MÉDICA", "RECESSO", "FOLGA TRE")
                    $obsText = mb_strtoupper($activeLeave->type_name);

                    $t1Status = 'BLOCKED'; 
                    $t1Obs    = $obsText;

                    $t2Status = 'BLOCKED'; 
                    $t2Obs    = $obsText;
                }
                // 2. Vigias (Escala 12x36)
                elseif ($isVigia) {
                    if ($bond->scale_start_date) {$scaleStart = Carbon::parse($bond->scale_start_date)->startOfDay();$diffInDays = $scaleStart->diffInDays($currentDate->startOfDay(), false);

                        if ($diffInDays % 2 !== 0) {
                            $t1Status = 'BLOCKED';$t1Obs = 'FOLGA (ESCALA 12x36)';
                            $t2Status = 'BLOCKED';$t2Obs = 'FOLGA (ESCALA 12x36)';
                        }
                    }
                }
                // 3. Demais Servidores
                else {
                    // A. Bloqueia turno que não trabalha (apenas tracejado)
                    if (str_contains($workShift, 'matutino') || $workShift === 'manha' || $workShift === 'm') {
                        $t2Status = 'BLOCKED'; $t2Obs = '---';
                    } elseif (str_contains($workShift, 'vespertino') || str_contains($workShift, 'tarde') || $workShift === 'v') {
                        $t1Status = 'BLOCKED'; $t1Obs = '---';
                    }

                    // B. Registros em activityTimes (recorrente por dia da semana no description e turno no shift)
                    if ($bond->activityTimes) {
                        foreach ($bond->activityTimes as$activity) {
                            $activityDay = strtolower(trim($activity->description ?? ''));

                            // Valida se a descrição bate com o dia da semana em inglês atual
                            if ($activityDay ===$currentEnglishDay) {
                                
                                // Tradução inteligente dos nomes em inglês para Português
                                $rawType = strtolower(trim($activity->type ?? ''));
                                if ($rawType === 'fixed off' || $rawType === 'fixed_off') {$obsText = 'FOLGA';
                                } elseif ($rawType === 'activity time' || $rawType === 'activity_time') {$obsText = 'HORA ATIVIDADE';
                                } else {
                                    $obsText = mb_strtoupper($activity->type ?? 'FOLGA');
                                }

                                $targetShift = strtolower(trim($activity->shift ?? $activity->turn ?? 'both'));

                               if (str_contains($targetShift, '1') || str_contains($targetShift, 'manhã') || str_contains($targetShift, 'manha') || str_contains($targetShift, 'matutino') || $targetShift === 'm') {
                                $t1Status = 'BLOCKED'; 
                                $t1Obs = $obsText;
                            } elseif (str_contains($targetShift, '2') || str_contains($targetShift, 'tarde') || str_contains($targetShift, 'vespertino') || $targetShift === 'v') {
                                $t2Status = 'BLOCKED'; 
                                $t2Obs = $obsText;
                            } else {
                                $t1Status = 'BLOCKED'; 
                                $t1Obs = $obsText;
                                $t2Status = 'BLOCKED'; 
                                $t2Obs = $obsText;
                            }
                            }
                        }
                    }

                    // C. Feriados, Domingos e Sábados
                    if (in_array($dateFormatted,$holidays)) {
                        $t1Status = 'BLOCKED';$t1Obs = 'FERIADO / RECESSO';
                        $t2Status = 'BLOCKED';$t2Obs = 'FERIADO / RECESSO';
                    }
                    elseif ($dayOfWeek === 0) {
                        $t1Status = 'BLOCKED';$t1Obs = 'DOMINGO';
                        $t2Status = 'BLOCKED';$t2Obs = 'DOMINGO';
                    }
                    elseif ($dayOfWeek === 6) {
                        if (in_array($dateFormatted,$saturdays)) {
                            // Sábado letivo aberto (respeitando o turno)
                            if (str_contains($workShift, 'matutino')) { $t2Status = 'BLOCKED';$t2Obs = '---'; }
                            if (str_contains($workShift, 'vespertino')) { $t1Status = 'BLOCKED';$t1Obs = '---'; }
                        } else {
                            $t1Status = 'BLOCKED';$t1Obs = 'SÁBADO';
                            $t2Status = 'BLOCKED';$t2Obs = 'SÁBADO';
                        }
                    }
                }

                $daysData[] = [
                    'day' => str_pad($day, 2, '0', STR_PAD_LEFT),
                    'day_name' => ucfirst($currentDate->locale('pt_BR')->isoFormat('ddd')),
                    't1_status' => $t1Status,
                    't1_obs' => $t1Obs,
                    't2_status' => $t2Status,
                    't2_obs' => $t2Obs,
                ];
            }

            $pointSheets[] = [
                'bond' => $bond,
                'days' => $daysData,
                'isNightVigia' => $isNightVigia
            ];
        }

        return view('point.interactiveBook', [
            'pointSheets' => $pointSheets,
            'monthName' => $monthName
        ]);
    }
}