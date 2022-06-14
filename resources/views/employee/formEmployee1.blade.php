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
                id="uppercase_1"
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
                id="uppercase_2"
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
                id="uppercase_3"
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
                id="uppercase_4"
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
              <option value="SOLTEIRO"@if($action == 'update' && $employee->marital_status == 'SOLTEIRO') selected @endif>SOLTEIRO</option>
              <option value="CASADO"@if($action == 'update' && $employee->marital_status == 'CASADO') selected @endif>CASADO</option>
              <option value="DIVORCIADO"@if($action == 'update' && $employee->marital_status == 'DIVORCIADO') selected @endif>DIVORCIADO</option>
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
              <option value="MASCULINO"@if($action == 'update' && $employee->sex == 'MASCULINO') selected @endif>MASCULINO</option>
              <option value="FEMININO"@if($action == 'update' && $employee->sex == 'FEMININO') selected @endif>FEMININO</option>
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
              <option value="BRANCO"@if($action == 'update' && $employee->color == 'BRANCO') selected @endif>BRANCO</option>
              <option value="PRETO"@if($action == 'update' && $employee->color == 'PRETO') selected @endif>PRETO</option>
              <option value="PARDO"@if($action == 'update' && $employee->color == 'PARDO') selected @endif>PARDO</option>
              <option value="AMARELO"@if($action == 'update' && $employee->color == 'AMARELO') selected @endif>AMARELO</option>
              <option value="INDIGENA"@if($action == 'update' && $employee->color == 'INDIGENA') selected @endif>INDÍGENA</option>
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
                id="phone"
                placeholder="Número do Celular"
                @if($action == 'update')
                value="{{$employee->phone}}"
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
<script src="{{asset('js/vanilla-masker.min.js')}}" charset="utf-8"></script>
<script charset="utf-8" type="text/javascript">

  /*VMasker(document.querySelector("#ph")).maskPattern("99.999.999/9999-99");
  VMasker(document.querySelector("#cep")).maskPattern("99.999-999");*/
  VMasker(document.querySelector("#phone")).maskPattern("(99) 9999-9999");

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

  for(let i = 1; i<=4; i++){
    document.querySelector('#uppercase_'+i).addEventListener('keyup', (ev) => {
    uppercase(ev);
    less_space(ev);
  });
  }

</script>

@endsection