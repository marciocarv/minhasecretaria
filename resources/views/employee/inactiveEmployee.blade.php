@extends('layouts.site')

@section('content')

<section class="is-hero-bar">
  <div class="flex flex-col items-center justify-between space-y-6 md:flex-row md:space-y-0">
    <h1 class="title">
      {{$title}}
    </h1>
  </div>
</section>

<section class="section main-section">
  @if(session('success'))
  <div id="notification" class="notification green">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
      <div>
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>{{session('success')}}</b>
      </div>
      <button type="button" class="button small textual --jb-notification-dismiss" onclick="hide()">Ocultar</button>
    </div>
  </div>
  @endif

  @if(session('error'))
  <div id="notification" class="notification red">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
      <div>
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>{{session('error')}}</b>
      </div>
      <button type="button" class="button small textual --jb-notification-dismiss" onclick="hide()">Ocultar</button>
    </div>
  </div>
  @endif

  <div class="flex justify-center">
    <a href="{{route('declaration_options')}}" class="m-1 p-4 button bg-teal-900 text-white font-bold shadow hover:bg-teal-700"><span class="icon">
      <i class="fa-solid fa-file-contract"></i></span> Declarações
    </a>
    <a href="{{route('employee')}}" class="m-1 p-4 button bg-teal-900 text-white font-bold shadow hover:bg-teal-700"><span class="icon">
      <i class="fa-solid fa-arrows-down-to-people"></i></span> Servidores Ativos
    </a>
  </div>

  <div class="card has-table mt-10">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon"><i class="fa-solid fa-box-open"></i></span>
        Servidores Ativos
      </p>
      <a href="#" class="card-header-icon">
        <span class="icon"><i class="mdi mdi-reload"></i></span>
      </a>
    </header>
    <div class="card-content">
      <table class="text-xs">
        <thead>
        <tr>
          <th>Nº</th>
          <th>Nome</th>
          <th>Data de Nascimento</th>
          <th>CPF</th>
          <th>Histórico</th>
        </tr>
        </thead>
        <tbody>
          @foreach($employees as $employee)
          <tr class="uppercase">
            <td data-label="Ordem">{{$loop->index + 1}}</td>
            <td data-label="Nome">{{$employee->name}}</td>
            <td data-label="Data de Nascimento">{{$employee->date_birth->format('d/m/Y')}}</td>
            <td data-label="CPF">{{$employee->cpf}}</td>
            <td class="actions-cell">
              <button type="button" onclick="openModal('modal-{{$employee->id}}')" class="button small blue">
                <span class="icon"><i class="fa-solid fa-folder-open"></i></span> 
                Ver Vínculos ({{$employee->employment_bonds->count()}})
              </button>
            </td>
          </tr>
          @endforeach

          @if($employees->isEmpty())
          <tr>
            <td data-label="Sem caixas" colspan="5" class="text-center">
              Sem registros
            </td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

  @foreach($employees as $employee)
  <div id="modal-{{$employee->id}}" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 max-h-screen overflow-y-auto">
      
      <div class="flex justify-between items-center bg-gray-200 p-4 rounded-t-lg">
        <h2 class="text-lg font-bold text-gray-800">Vínculos Inativos: {{$employee->name}}</h2>
        <button type="button" onclick="closeModal('modal-{{$employee->id}}')" class="text-red-600 font-bold text-xl hover:text-red-800">&times;</button>
      </div>

<div class="p-4">
        <table class="text-xs w-full">
          <thead>
            <tr class="bg-gray-100">
              <th>Matrícula</th>
              <th>Cargo</th>
              <th>Função</th>
              <th>Carga Horária</th>
              <th>Ano de Saída</th> <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach($employee->employment_bonds as $bond)
            <tr class="uppercase">
              <td data-label="Matrícula">{{$bond->registration === '0' ? 'N/A' : $bond->registration}}</td>
              <td data-label="Cargo">{{$bond->post}}</td>
              <td data-label="Função">{{$bond->role}}</td>
              <td data-label="Carga Horária">{{$bond->workload}}h</td>
              
              <td data-label="Ano de Saída" class="font-bold text-red-600">
                {{ $bond->activity_end ? $bond->activity_end->format('Y') : 'N/A' }}
              </td>

              <td class="actions-cell">
                <div class="buttons right nowrap">
                  <a title="Editar" href="{{route('setUpdateEmployee', ['id'=>$bond->id])}}" class="button small green" type="button">
                    <span class="icon"><i class="fa-solid fa-pen-to-square"></i></span>
                  </a>
                  <a title="Mais Opções" href="{{route('manageEmployee', ['id'=>$bond->id])}}" class="button small blue" type="button">
                    <span class="icon"><i class="fa-solid fa-wrench"></i></span>
                  </a>
                  <a title="Reativar" href="{{route('setReactivate', ['id'=>$bond->id])}}" class="button small green" type="button">
                    <span class="icon"><i class="fa-solid fa-rotate-left"></i></span>
                  </a>
                  <a title="Excluir" href="{{route('deleteEmployee', ['id'=>$bond->id])}}" class="button small red" type="button">
                    <span class="icon"><i class="fa-solid fa-trash"></i></span>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <div class="p-4 border-t flex justify-end">
        <button type="button" onclick="closeModal('modal-{{$employee->id}}')" class="button bg-gray-500 text-white font-bold shadow hover:bg-gray-600">Fechar</button>
      </div>
    </div>
  </div>
  @endforeach

</section>
@endsection

@section('script')
<script>
  function hide(){
    let notification = document.querySelector('#notification');
    if(notification) notification.classList.add('hidden');
  }

  // Funções para gerenciar os Modais
  function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
  }

  function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
  }
</script>
@endsection