@extends('layouts.site')

@section('content')

<!-- Estilos para Impressão -->
<style>
  @media print {
    /* Esconde elementos de navegação e botões */
    aside, .navbar, .is-hero-bar, .card-header, form, .button, #notification, .actions-bar {
      display: none !important;
    }
    
    body, .main-section, .card, .card-content {
      padding: 0 !important;
      margin: 0 !important;
      box-shadow: none !important;
      border: none !important;
      background-color: white !important;
    }

    .print-title {
      display: block !important;
      text-align: center;
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 15px;
      color: black;
    }

    /* Força comportamento rigoroso de tabela em linha na impressão */
    table {
      width: 100% !important;
      border-collapse: collapse !important;
      display: table !important;
    }

    thead {
      display: table-header-group !important;
    }

    tbody {
      display: table-row-group !important;
    }

    tr {
      display: table-row !important;
      page-break-inside: avoid;
    }

    th, td {
      display: table-cell !important;
      border: 1px solid #000 !important;
      padding: 6px 8px !important;
      text-align: left !important;
      color: black !important;
      font-size: 12px !important;
      vertical-align: middle !important;
    }

    /* Desativa rótulos responsivos do tema na impressão */
    td::before {
      content: "" !important;
      display: none !important;
    }
  }
  
  .print-title {
    display: none;
  }
</style>

<!-- Título Dinâmico para a folha impressa -->
@php
    $filtro = request('filtro_principal');
    $tituloImpressao = 'Lista Geral de Alunos';

    if($filtro == 'bolsa_familia') {
        $tituloImpressao = 'Relação de Alunos - Bolsa Família';
    } elseif($filtro == 'necessidades_especiais') {
        $tituloImpressao = 'Relação de Alunos - Necessidades Especiais';
    } elseif($filtro == 'transporte') {
        $tituloImpressao = request('rota') 
            ? 'Relação de Alunos - Transporte Escolar (Rota: ' . request('rota') . ')' 
            : 'Relação de Alunos - Transporte Escolar (Geral)';
    }
@endphp

  @if(session('error'))
  <div id="notification" class="notification red mb-5">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
      <div>
        <span class="icon"><i class="fa-solid fa-circle-exclamation"></i></span>
        <b>{{session('error')}}</b>
      </div>
      <button type="button" class="button small textual --jb-notification-dismiss" onclick="hide()">Ocultar</button>
    </div>
  </div>
  @endif

  @if(session('success'))
  <div id="notification" class="notification green mb-5">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
      <div>
        <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
        <b>{{session('success')}}</b>
      </div>
      <button type="button" class="button small textual --jb-notification-dismiss" onclick="hide()">Ocultar</button>
    </div>
  </div>
  @endif

  <!-- Cabeçalho e Botões -->
  <div class="actions-bar flex flex-col md:flex-row justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-700">Painel SIGE</h1>
    
    <div class="flex space-x-2">
        <button type="button" onclick="window.print()" class="button bg-blue-600 text-white font-bold shadow hover:bg-blue-500">
            <span class="icon"><i class="fa-solid fa-print"></i></span> 
            <span>Imprimir Lista</span>
        </button>

        <form method="POST" action="{{ route('sige.sync') }}">
            @csrf
            <button type="submit" class="button bg-teal-900 text-white font-bold shadow hover:bg-teal-700" onclick="this.classList.add('is-loading')">
                <span class="icon"><i class="fa-solid fa-rotate"></i></span> 
                <span>Sincronizar Banco</span>
            </button>
        </form>
    </div>
  </div>

  <!-- Cartão de Filtros -->
  <div class="card mb-6">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon"><i class="fa-solid fa-filter"></i></span>
        Filtros de Busca
      </p>
    </header>
    <div class="card-content">
      <form method="GET" action="{{ route('sige.show') }}">
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 items-end">
          
          <!-- Filtro Único -->
          <div class="field w-full md:w-1/3">
            <label class="label">Selecione a Lista</label>
            <div class="control">
              <div class="select w-full">
                <select name="filtro_principal" id="filtro_principal" class="w-full" onchange="toggleRota()">
                  <option value="">Todos os Alunos</option>
                  <option value="bolsa_familia" {{ $filtro == 'bolsa_familia' ? 'selected' : '' }}>Bolsa Família</option>
                  <option value="necessidades_especiais" {{ $filtro == 'necessidades_especiais' ? 'selected' : '' }}>Necessidades Especiais</option>
                  <option value="transporte" {{ $filtro == 'transporte' ? 'selected' : '' }}>Transporte Escolar</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Filtro de Rota -->
          <div class="field w-full md:w-1/3 {{ $filtro == 'transporte' ? '' : 'hidden' }}" id="rota_container">
            <label class="label">Qual Rota?</label>
            <div class="control">
              <div class="select w-full">
                <select name="rota" id="rota_select" class="w-full">
                  <option value="">Todas as Rotas</option>
                  @foreach($rotasDisponiveis as $rota)
                    <option value="{{ $rota }}" {{ request('rota') == $rota ? 'selected' : '' }}>{{ $rota }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <!-- Botão Pesquisar -->
          <div class="field">
            <div class="control">
              <button type="submit" class="button bg-teal-900 text-white font-bold shadow hover:bg-teal-700">
                <span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span> 
                <span>Filtrar Lista</span>
              </button>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>

  <!-- Tabela de Resultados -->
  <div class="print-title">{{ $tituloImpressao }}</div>

  <div class="card has-table mt-10">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon"><i class="fa-solid fa-users"></i></span>
        Resultados ({{ $students->count() }} alunos)
      </p>
    </header>
    <div class="card-content">
      <table>
        <thead>
          <tr>
            <th style="width: 50px;" class="text-center">Nº</th>
            <th>Nome do Aluno</th>
            <th style="width: 180px;">Turma</th>
            
            @if($filtro == 'transporte')
              <th style="width: 220px;">Rota</th>
            @elseif($filtro == 'necessidades_especiais')
              <th style="width: 250px;">Necessidade Especial</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse($students as $student)
          <tr>
            <td class="text-center font-bold">{{ $loop->iteration }}</td>
            <td data-label="Nome">{{ $student->name }}</td>
            <td data-label="Turma">{{ $student->class_name }}</td>
            
            @if($filtro == 'transporte')
              <td data-label="Rota">{{ $student->transport_route ?: '-' }}</td>
            @elseif($filtro == 'necessidades_especiais')
              <td data-label="Necessidade">{{ $student->special_need ?: '-' }}</td>
            @endif
          </tr>
          @empty
          <tr>
            <td colspan="{{ ($filtro == 'transporte' || $filtro == 'necessidades_especiais') ? 4 : 3 }}" class="text-center text-gray-500 py-4">
              Nenhum aluno encontrado para este filtro.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection

@section('script')
<script>
  function toggleRota() {
      const filtroPrincipal = document.getElementById('filtro_principal');
      const rotaContainer = document.getElementById('rota_container');
      const rotaSelect = document.getElementById('rota_select');
      
      if (filtroPrincipal.value === 'transporte') {
          rotaContainer.classList.remove('hidden');
          rotaSelect.disabled = false;
      } else {
          rotaContainer.classList.add('hidden');
          rotaSelect.value = '';
          rotaSelect.disabled = true;
      }
  }

  function hide() {
      const notification = document.getElementById('notification');
      if(notification) {
          notification.style.display = 'none';
      }
  }
</script>
@endsection