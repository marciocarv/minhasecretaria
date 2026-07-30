@extends('layouts.site')

@section('content')

<div class="return">
  <a href="{{route('manageEmployee', ['id'=>$employment_bond->id])}}" class="text-gray-500 font-bold m-2 hover:text-blue-800"> 
    <i class="fa-solid fa-arrow-left"></i> Voltar
  </a>
</div>

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

  <div class="mb-6 bg-white p-4 rounded shadow">
    <p>Servidor: <strong>{{$employment_bond->employee->name}}</strong></p>
    <p>Cargo: <strong>{{$employment_bond->post}}</strong></p>
    <p>Função: <strong>{{$employment_bond->role}}</strong></p>
  </div>

  <div class="card has-table mb-8">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon"><i class="fa-solid fa-clock"></i></span>
        Registros Atuais
      </p>
    </header>
    <div class="card-content">
      <table>
        <thead>
          <tr>
            <th>Tipo</th>
            <th>Dia da Semana</th>
            <th>Turno</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($employment_bond->activityTimes as $time)
          <tr>
            <td data-label="Tipo" class="font-bold">
              {{ $time->type === 'activity_time' ? 'Hora-Atividade' : 'Folga Fixa' }}
            </td>
            <td data-label="Dia">
              @php
                $dias = [
                  'Monday' => 'Segunda-feira',
                  'Tuesday' => 'Terça-feira',
                  'Wednesday' => 'Quarta-feira',
                  'Thursday' => 'Quinta-feira',
                  'Friday' => 'Sexta-feira',
                ];
              @endphp
              {{ $dias[$time->description] ?? $time->description }}
            </td>
            <td data-label="Turno" class="uppercase">
              {{ $time->shift }}
            </td>
            <td class="actions-cell">
              <a href="{{ route('deleteActivityTime', ['id' => $time->id]) }}" class="button small red" title="Excluir Registro" onclick="return confirm('Tem certeza que deseja remover este registro?')">
                <span class="icon"><i class="fa-solid fa-trash"></i></span>
              </a>
            </td>
          </tr>
          @endforeach
          
          @if($employment_bond->activityTimes->isEmpty())
          <tr>
            <td colspan="4" class="text-center text-gray-500 py-4">
              Nenhum horário registrado para este servidor.
            </td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

  <div class="bg-white p-6 rounded shadow max-w-2xl">
    <h3 class="text-lg font-bold mb-4 border-b pb-2">Adicionar Novo Registro</h3>
    
    <form method="POST" action="{{route($route)}}">
      @csrf
      <input type="hidden" value="{{$employment_bond->id}}" name="employment_bond_id">

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="field">
          <label class="label">Tipo:</label>
          <div class="control">
            <div class="select w-full">
              <select name="type" required class="w-full">
                <option value="">Escolha o tipo</option>
                <option value="activity_time">Hora-Atividade</option>
                <option value="fixed_off">Folga Fixa</option>
              </select>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Dia da Semana:</label>
          <div class="control">
            <div class="select w-full">
              <select name="description" required class="w-full">
                <option value="">Escolha o dia</option>
                <option value="Monday">Segunda-feira</option>
                <option value="Tuesday">Terça-feira</option>
                <option value="Wednesday">Quarta-feira</option>
                <option value="Thursday">Quinta-feira</option>
                <option value="Friday">Sexta-feira</option>
              </select>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Turno:</label>
          <div class="control">
            <div class="select w-full">
              <select name="shift" required class="w-full">
                <option value="">Escolha o turno</option>
                <option value="matutino">Matutino</option>
                <option value="vespertino">Vespertino</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="field mt-4">
        <div class="control">
          <button type="submit" class="button green">
            <span class="icon"><i class="fa-solid fa-plus"></i></span> Adicionar
          </button>
        </div>
      </div>
    </form>
  </div>

</section>

@endsection

@section('script')
<script>
  function hide(){
    let notification = document.querySelector('#notification');
    if(notification) notification.classList.add('hidden');
  }
</script>
@endsection