@extends('layouts.site')

@section('content')

<div class="return">
  <a href="{{route('employee')}}" class="text-gray-500 font-bold m-2 hover:text-blue-800"> <i class="fa-solid fa-arrow-left"></i> Voltar</a>
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
    <form method="POST" action="{{route($route)}}" class="w-96">
      @csrf
      @if($action === "update")
        <input type="hidden" value="{{$employment_bond->id}}" name="employment_bond_id">
      @endif
      <input type="hidden" value="form3" name="form">
      <input type="hidden" value="{{$id_employee}}" name="id_employee">

      <div class="field">
        <label class="label">Banco</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="bank_name"
                id="uppercase_1"
                placeholder="Nome da Instituição Bancária"
                @if($action == 'update')
                value="{{$employee->bank_name}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-building-columns"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Agência</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="bank_agency"
                placeholder="Número da agência"
                @if($action == 'update')
                value="{{$employee->bank_agency}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-building-columns"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Conta</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="bank_number"
                placeholder="Número da conta"
                @if($action == 'update')
                value="{{$employee->bank_number}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-building-columns"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Escolaridade</label>
        <div class="control">
          <div class="select">
            <select name="schooling">
              <option value="">Escolha uma opção</option>
              <option value="FUNDAMENTAL"@if($action == 'update' && $employee->schooling == 'FUNDAMENTAL') selected @endif>FUNDAMENTAL</option>
              <option value="MEDIO" @if($action == 'update' && $employee->schooling == 'MEDIO') selected @endif>MÉDIO</option>
              <option value="MAGISTERIO" @if($action == 'update' && $employee->schooling == 'MAGISTERIO') selected @endif>MAGISTÉRIO</option>
              <option value="SUPERIOR"@if($action == 'update' && $employee->schooling == 'SUPERIOR') selected @endif>SUPERIOR</option>
              <option value="POS"@if($action == 'update' && $employee->schooling == 'POS') selected @endif>PÓS GRADUAÇÃO</option>
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Situação do curso</label>
        <div class="control">
          <div class="select">
            <select name="course_status">
              <option value="">Escolha uma opção</option>
              <option value="INCOMPLETO"@if($action == 'update' && $employee->course_status == 'INCOMPLETO') selected @endif>INCOMPLETO</option>
              <option value="COMPLETO"@if($action == 'update' && $employee->course_status == 'COMPLETO') selected @endif>COMPLETO</option>
              <option value="CURSANDO"@if($action == 'update' && $employee->course_status == 'CURSANDO') selected @endif>CURSANDO</option>
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Curso</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="course_name"
                id="uppercase_2"
                placeholder="Nome do Curso"
                @if($action == 'update')
                value="{{$employee->course_name}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-city"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Instituição</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="name_college"
                id="uppercase_3"
                placeholder="Nome da Instituição"
                @if($action == 'update')
                value="{{$employee->name_college}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-graduation-cap"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Ano de conclusão</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="number" 
                name="conclusion"
                placeholder="Ano de conclusão"
                @if($action == 'update')
                value="{{$employee->conclusion}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-calendar"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field grouped">
        <div class="control">
          <button type="submit" class="button green">
            Próximo
            <span class="icon left"><i class="fa-solid fa-angles-right"></i></span>
          </button>
        </div>
      </div>

    </form>

  </div>
</div>

@endsection

@section('script')
<script>
  function hide(){
    let notification = document.querySelector('#notification');

    notification.classList.add('hidden');
  }

  function uppercase(ev){
    const input = ev.target;
	  input.value = input.value.toUpperCase();
  }

  function less_space(ev){
    const input = ev.target;
	  input.value = input.value.replace(/( )+/g, ' ');
    input.value = input.value.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
  }

  for(let i = 1; i<=3; i++){
    document.querySelector('#uppercase_'+i).addEventListener('keyup', (ev) => {
    uppercase(ev);
    less_space(ev);
  });
  }

</script>

@endsection