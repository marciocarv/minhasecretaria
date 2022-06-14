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
    <a href="{{route('setStoreEmployee')}}" class="m-1 p-4 button bg-teal-900 text-white font-bold shadow hover:bg-teal-700"><span class="icon">
      <i class="fa-solid fa-square-plus"></i></span> Cadastrar Servidor
    </a>
    <a href="{{route('setStoreEmployee')}}" class="m-1 p-4 button bg-teal-900 text-white font-bold shadow hover:bg-teal-700"><span class="icon">
      <i class="fa-solid fa-list"></i></span> Listas de Servidores
    </a>
    <a href="{{route('setStoreEmployee')}}" class="m-1 p-4 button bg-teal-900 text-white font-bold shadow hover:bg-teal-700"><span class="icon">
      <i class="fa-solid fa-file-contract"></i></span> Declarações
    </a>
    <a href="{{route('setStoreEmployee')}}" class="m-1 p-4 button bg-teal-900 text-white font-bold shadow hover:bg-teal-700"><span class="icon">
      <i class="fa-solid fa-clock"></i></span> Banco de Horas
    </a>
    <a href="{{route('setStoreEmployee')}}" class="m-1 p-4 button bg-teal-900 text-white font-bold shadow hover:bg-teal-700"><span class="icon">
      <i class="fa-solid fa-arrows-down-to-people"></i></span> Servidores Inativos
    </a>
  </div>

  <div class="card has-table mt-10">
    <header class="card-header">
      
      <a href="#" class="card-header-icon">
        <span class="icon"><i class="mdi mdi-reload"></i></span>
      </a>
    </header>
    <div class="card-content">
      <table>
        <thead>
          <tr>
            <th>nome</th>
            <th>Data de Nascimento</th>
            <th>CPF</th>
            <th>RG</th>
          </tr>
          <tr class="text-2xl">
            <th>{{$employment_bond->employee->name}}</th>
            <th>{{$employment_bond->employee->date_birth->format('d/m/Y')}}</th>
            <th>{{$employment_bond->employee->cpf}}</th>
            <th>{{$employment_bond->employee->rg}}</th>
          </tr>
          <tr>
            <th colspan="2">Filiação</th>
            <th>Naturalidade</th>
            <th>Estado Civil</th>
          </tr>
          <tr class="text-2xl">
            <th colspan="2">{{$employment_bond->employee->father}} e {{$employment_bond->employee->mother}}</th>
            <th>{{$employment_bond->employee->naturalness}}</th>
            <th>{{$employment_bond->employee->marital_status}}</th>
          </tr>
          <tr>
            <th>CEP</th>
            <th>endereço</th>
            <th>cor</th>
            <th>telefone</th>
          </tr>
          <tr class="text-2xl">
            <th>{{$employment_bond->employee->cep}}</th>
            <th>{{$employment_bond->employee->address}}</th>
            <th>{{$employment_bond->employee->color}}</th>
            <th>{{$employment_bond->employee->phone}}</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

</section>
  
          
@endsection

@section('script')

<script>
  function hide(){
    let notification = document.querySelector('#notification');

    notification.classList.add('hidden');
  }

</script>

@endsection