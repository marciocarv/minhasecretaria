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
        <input type="hidden" value="{{$employee->id}}" name="employee_id">
      @endif

      <div class="field">
        <label class="label">Matrícula</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="registration"
                id="uppercase_mother"
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
        <label class="label">Nome</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="name"
                id="uppercase_student"
                placeholder="Nome"
                @if($action == 'update')
                value="{{$employee->name}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-id-card"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Data de Nascimento</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="date" 
                name="date_birth" 
                placeholder=""
                @if($action == 'update')
                value="{{$employee->date_birth->format('Y-m-d')}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Mãe</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="mother"
                id="uppercase_mother"
                placeholder="Nome da mãe"
                @if($action == 'update')
                value="{{$employee->mother}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-person-breastfeeding"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Pai</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="father"
                id="uppercase_mother"
                placeholder="Nome do pai"
                @if($action == 'update')
                value="{{$employee->father}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-person"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Naturalidade</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="naturalness"
                id="uppercase_mother"
                placeholder="Nome do pai"
                @if($action == 'update')
                value="{{$employee->naturalness}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-city"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Admissão no concurso</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="date" 
                name="activity_start" 
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
        <label class="label">Início de Atividade</label>
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
        <label class="label">Vínculo Empregatício</label>
        <div class="control">
          <div class="select">
            <select name="bond">
              <option value="">Escolha uma opção</option>
              <option value="EFETIVO">EFETIVO</option>
              <option value="CONTRATO">CONTRATO</option>
            </select>
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
                id="uppercase_mother"
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
                id="uppercase_mother"
                placeholder="Função"
                @if($action == 'update')
                value="{{$employment_bond->role}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-city"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Ano de Entrada</label>
        <div class="field-body">
          <div class="field flex flex-wrap">
            <div class="control icons-left">
                <input 
                class="input w-56" 
                type="number" 
                name="entry_year" 
                placeholder=""
                @if($action == 'update')
                value="{{$employment_bond->entry_year}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-right-to-bracket"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Ano de Saída</label>
        <div class="field-body">
          <div class="field flex flex-wrap">
            <div class="control icons-left">
                <input 
                class="input w-56" 
                type="number" 
                name="exit_year" 
                placeholder=""
                @if($action == 'update')
                value="{{$bond_employee->exit_year}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-right-from-bracket"></i></span>
            </div>
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
          <button type="reset" class="button red">
            Limpar
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

  document.querySelector('#uppercase_student').addEventListener('keyup', (ev) => {
    uppercase(ev);
  });

  document.querySelector('#uppercase_mother').addEventListener('keyup', (ev) => {
    uppercase(ev);
  });

  document.querySelector('#uppercase_student').addEventListener('blur', (ev) => {
    less_space(ev);
  });

  document.querySelector('#uppercase_mother').addEventListener('blur', (ev) => {
    less_space(ev);
  });


</script>

@endsection