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
          <th class="checkbox-cell">
            <label class="checkbox">
              <input type="checkbox">
              <span class="check"></span>
            </label>
          </th>
          <th>Nº</th>
          <th>Nome</th>
          <th>Data de Nascimento</th>
          <th>CPF</th>
          <th>Matrícula</th>
          <th>Cargo</th>
          <th>Função</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          @foreach($employees as $employee)
          <tr class="uppercase">
            <td class="checkbox-cell">
              <label class="checkbox">
                <input name="id_box" value="{{$employee->id}}" type="checkbox" >
                <span class="check"></span>
              </label>
            </td>
            <td data-label="Ordem">{{$loop->index + 1}}</td>
            <td data-label="Nome">{{$employee->name}}</td>
            <td data-label="Nome">{{date('d/m/Y', strtotime($employee->date_birth))}}</td>
            <td data-label="Nome">{{$employee->cpf}}</td>
            <td data-label="Nome">{{$employee->registration === '0' ? ' ' : $employee->registration}} </td>
            <td data-label="Nome">{{$employee->post}} </td>
            <td data-label="Nome">{{$employee->role}} </td>
            <td class="actions-cell">
              <div class="buttons right nowrap">
                <a title="Editar" 
                  href="{{route('setUpdateEmployee', ['id'=>$employee->id])}}"
                  class="button small green" 
                  type="button">
                  <span class="icon"><i class="fa-solid fa-pen-to-square"></i></span>
                </a>
                <a title="Excluir" 
                  href="{{route('deleteEmployee', ['id'=>$employee->id])}}" 
                  class="button small red" 
                  type="button">
                  <span class="icon"><i class="fa-solid fa-trash"></i></span>
                </a>
                <a title="Mais Opções" 
                  href="{{route('manageEmployee', ['id'=>$employee->id])}}" 
                  class="button small blue" 
                  type="button">
                  <span class="icon"><i class="fa-solid fa-wrench"></i></span>
                </a>
                <a title="Reativar" 
                  href="{{route('setReactivate', ['id'=>$employee->id])}}" 
                  class="button small green" 
                  type="button">
                  <span class="icon"><i class="fa-solid fa-rotate-left"></i></span>
                </a>
              </div>
            </td>
          </tr>
          @endforeach
          @if($employees->isEmpty())
          <tr>
            <td data-label="Sem caixas" colspan="7" class="text-center">
              Sem registros
            </td>
          </tr>
          @endif
        </tbody>
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