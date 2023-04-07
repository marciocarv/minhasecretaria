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
    <p>Hora-atividade: <strong>
      @if($employment_bond->activityTime->description === "Monday")
      Segunda-Feira
      @elseif($employment_bond->activityTime->description === "Tuesday")
      Terça-Feira
      @elseif($employment_bond->activityTime->description === "Wednesday")
      Quarta-Feira
      @elseif($employment_bond->activityTime->description === "Thursday")
      Quinta-Feira
      @elseif($employment_bond->activityTime->description === "Friday")
      Sexta-Feira
      @endif
    </strong> <a href="{{route('defineActivityTime', ['id'=>$employment_bond->id])}}" class="text-gray-500 font-bold m-2 hover:text-blue-800">
               <i class="fa-solid fa-pen-to-square"></i> 
               Editar</a></p>

  </div>
</div>

@endsection

@section('script')
<script>
 function hide(){
    let notification = document.querySelector('#notification');

    notification.classList.add('hidden');
  }
</script>
  
@endsection