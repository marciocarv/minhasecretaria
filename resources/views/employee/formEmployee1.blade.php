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
      <input type="hidden" value="form1" name="form">

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
                required
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
                required
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
                required
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
                placeholder="Naturalidade"
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
        <label class="label">Estado Civil</label>
        <div class="control">
          <div class="select">
            <select name="marital_status">
              <option value="">Escolha uma opção</option>
              <option value="SOLTEIRO">SOLTEIRO</option>
              <option value="CASADO">CASADO</option>
              <option value="DIVORCIADO">DIVORCIADO</option>
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Sexo</label>
        <div class="control">
          <div class="select">
            <select name="sex">
              <option value="">Escolha uma opção</option>
              <option value="MASCULINO">MASCULINO</option>
              <option value="FEMININO">FEMININO</option>
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Cor</label>
        <div class="control">
          <div class="select">
            <select name="color">
              <option value="">Escolha uma opção</option>
              <option value="BRANCO">BRANCO</option>
              <option value="PRETO">PRETO</option>
              <option value="PARDO">PARDO</option>
              <option value="AMARELO">AMARELO</option>
              <option value="INDIGENA">INDÍGENA</option>
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Celular</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="phone"
                id="uppercase_student"
                placeholder="Número do Celular"
                @if($action == 'update')
                value="{{$employee->cpf}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-mobile-screen"></i></span>
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
        <div class="control">
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