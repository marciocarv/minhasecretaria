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
      <input type="hidden" value="form4" name="form">
      <input type="hidden" value="{{$id_employee}}" name="id_employee">

      <div class="field">
        <label class="label">Vínculo Empregatício</label>
        <div class="control">
          <div class="select">
            <select name="bond">
              <option value="">Escolha uma opção</option>
              <option value="EFETIVO"@if($action == 'update' && $employment_bond->bond == 'EFETIVO') selected @endif>EFETIVO</option>
              <option value="CONTRATO"@if($action == 'update' && $employment_bond->bond == 'CONTRATO') selected @endif>CONTRATO</option>
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Data de Admissão no concurso</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="date" 
                name="admission" 
                placeholder=""
                @if($action == 'update')
                value="{{$employee->admission->format('Y-m-d')}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Matrícula</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="registration"
                placeholder="Número de matrícula"
                @if($action == 'update')
                value="{{$employment_bond->registration}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-address-card"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">ID censo</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="id_censo"
                placeholder="Número de matrícula"
                @if($action == 'update')
                value="{{$employee->id_censo}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-address-card"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Início de atividade</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="date" 
                name="activity_start" 
                placeholder=""
                @if($action == 'update')
                value="{{$employment_bond->activity_start->format('Y-m-d')}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>
        </div>
      </div> 

      <div class="field">
        <label class="label">Cargo</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="post"
                id="uppercase_1"
                placeholder="Cargo"
                @if($action == 'update')
                value="{{$employment_bond->post}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-city"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Função</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="role"
                id="uppercase_2"
                placeholder="Função"
                @if($action == 'update')
                value="{{$employment_bond->role}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-id-badge"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Carga Horária</label>
        <div class="control">
          <div class="select">
            <select name="workload">
              <option value="">Escolha uma opção</option>
              <option value="40"@if($action == 'update' && $employment_bond->workload == '40') selected @endif>40 H</option>
              <option value="20"@if($action == 'update' && $employment_bond->workload == '20') selected @endif>20 H</option>
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

  for(let i = 1; i<=2; i++){
    document.querySelector('#uppercase_'+i).addEventListener('keyup', (ev) => {
    uppercase(ev);
    less_space(ev);
  });
  }


</script>

@endsection