@extends('layouts.site')

@section('content')

<div class="return">
  <a href="{{route('manageEmployee', ['id'=>$employment_bond->id])}}" class="text-gray-500 font-bold m-2 hover:text-blue-800"> <i class="fa-solid fa-arrow-left"></i> Voltar</a>
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

  <div>
    <p>Servidor: <strong>{{$employment_bond->employee->name}}</strong></p>
    <p>Cargo: <strong>{{$employment_bond->post}}</strong></p>
    <p>Função: <strong>{{$employment_bond->role}}</strong></p>
    <form method="POST" action="{{route($route)}}" class="w-96">
      @csrf
      <input type="hidden" value="{{$employment_bond->id}}" name="employment_bond_id">

      <div class="field">
        <label class="label">Hora-atividade:</label>
        <div class="control">
          <div class="select">
            <select name="description" id="description">
              <option value="-">Escolha uma opção</option>
              <option value="Monday">Segunda-feira</option>
              <option value="Tuesday">Terça-Feira</option>
              <option value="Wednesday">Quarta-Feira</option>
              <option value="Thursday">Quinta-Feira</option>
              <option value="Friday">Sexta-Feira</option>
            </select>
          </div>
        </div>
      </div>

      <div class="field grouped">
        <div class="control">
          <button type="submit" class="button green">
            Salvar
          </button>
        </div>
        <div class="control">
        </div>
      </div>

    </form>

  </div>
</div>

@endsection

@section('script')
<script>

</script>
  
@endsection