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
    <a href="{{route('functionalSheet', ['id'=>$employment_bond->id])}}" class="m-1 p-4 button bg-green-800 text-white font-bold shadow hover:bg-teal-700" target="_blank">
      <span class="icon">
      <i class="fa-solid fa-print"></i>
      </span> Ficha Funcional
    </a>
    <a href="{{route('activity_start', ['id'=>$employment_bond->id])}}" class="m-1 p-4 button bg-blue-900 text-white font-bold shadow hover:bg-teal-700"><span class="icon">
      <i class="fa-solid fa-print"></i></span> Início de Atividade
    </a>
    <a href="{{route('setStoreEmployee')}}" class="m-1 p-4 button bg-red-900 text-white font-bold shadow hover:bg-teal-700"><span class="icon">
      <i class="fa-solid fa-calendar-xmark"></i></span> Encerramento de atividade
    </a>
    <a href="{{route('setUpdateEmployee', ['id'=>$employment_bond->id])}}" class="m-1 p-4 button bg-blue-700 text-white font-bold shadow hover:bg-teal-700"><span class="icon">
      <i class="fa-solid fa-pen-to-square"></i></span> Editar
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
            <th>Matrícula</th>
            <th>Vínculo</th>
            <th>Cargo</th>
            <th>Função</th>
          </tr>
          <tr class="text-2xl">
            <th>{{$employment_bond->registration}}</th>
            <th>{{$employment_bond->bond}}</th>
            <th>{{$employment_bond->post}}</th>
            <th>{{$employment_bond->role}}</th>
          </tr>
          <tr>
            <th>Data de Admissão</th>
            <th>Data de lotação</th>
            <th>Carga Horária</th>
            <th>ID censo</th>
          </tr>
          <tr class="text-2xl">
            <th>{{$employment_bond->employee->admission->format('d/m/Y')}}</th>
            <th>{{$employment_bond->activity_start->format('d/m/Y')}}</th>
            <th>{{$employment_bond->workload}}</th>
            <th>{{$employment_bond->employee->id_censo}}</th>
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
          <tr>
            <th>Tipo de Certidão</th>
            <th>Termo</th>
            <th>Livro</th>
            <th>folha</th>
          </tr>
          <tr class="text-2xl">
            <th>{{$employment_bond->employee->certificate_type}}</th>
            <th>{{$employment_bond->employee->certificate_term}}</th>
            <th>{{$employment_bond->employee->certificate_book}}</th>
            <th>{{$employment_bond->employee->certificate_sheet}}</th>
          </tr>
          <tr>
            <th>Banco</th>
            <th>Agência</th>
            <th>Nº da Conta</th>
            <th>Escolaridade</th>
          </tr>
          <tr class="text-2xl">
            <th>{{$employment_bond->employee->bank_name}}</th>
            <th>{{$employment_bond->employee->bank_agency}}</th>
            <th>{{$employment_bond->employee->bank_number}}</th>
            <th>{{$employment_bond->employee->schooling}}</th>
          </tr>
          <tr>
            <th>Curso</th>
            <th>Situação</th>
            <th>Instituição</th>
            <th>Ano de Conclusão</th>
          </tr>
          <tr class="text-2xl">
            <th>{{$employment_bond->employee->course_name}}</th>
            <th>{{$employment_bond->employee->course_status}}</th>
            <th>{{$employment_bond->employee->bank_number}}</th>
            <th>{{$employment_bond->employee->schooling}}</th>
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