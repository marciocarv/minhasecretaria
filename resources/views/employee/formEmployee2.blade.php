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
      <input type="hidden" value="form2" name="form">
      <input type="hidden" value="{{$id_employee}}" name="id_employee">


      <div class="field">
        <label class="label">CEP</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="cep"
                id="uppercase_mother"
                placeholder="Nome da mãe"
                @if($action == 'update')
                value="{{$employee->cep}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-person-breastfeeding"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Endereço</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="address"
                id="uppercase_mother"
                placeholder="Nome do pai"
                @if($action == 'update')
                value="{{$employee->address}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-person"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">CPF</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="cpf"
                id="uppercase_student"
                placeholder="Número do CPF"
                @if($action == 'update')
                value="{{$employee->cpf}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-id-card"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">RG</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="rg"
                id="uppercase_student"
                placeholder="Número do RG"
                @if($action == 'update')
                value="{{$employee->rg}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-id-card"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Expedição do RG</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="date" 
                name="rg_expedition" 
                placeholder=""
                @if($action == 'update')
                value="{{$employee->rg_expedition->format('Y-m-d')}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Tipo de Certidão</label>
        <div class="control">
          <div class="select">
            <select name="certificate_type">
              <option value="">Escolha uma opção</option>
              <option value="SOLTEIRO">NASCIMENTO</option>
              <option value="CASADO">CASAMENTO</option>
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Termo da Certidão</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="certificate_term"
                id="uppercase_student"
                placeholder="Número do Termo da Certidão"
                @if($action == 'update')
                value="{{$employee->certificate_term}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-id-card"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Livro</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="certificate_book"
                id="uppercase_student"
                placeholder="Número do livro da Certidão"
                @if($action == 'update')
                value="{{$employee->certificate_book}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-id-card"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Folha</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="certificate_sheet"
                id="uppercase_student"
                placeholder="Número da folha da Certidão"
                @if($action == 'update')
                value="{{$employee->certificate_sheet}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-id-card"></i></span>
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