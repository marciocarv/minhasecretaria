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

  <div class="mb-5">
    <p><strong>Servidor:</strong> {{$employee->name}}</p>
    <p><strong>Data de Nascimento:</strong> {{$employee->date_birth->format('d/m/Y')}}</p>
  </div>

  <div>
    <form method="POST" action="{{route($route)}}" class="w-96">
      @csrf
        <input type="hidden" value="{{$employee->id}}" name="employee_id">

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
        <label class="label">Matrícula</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="registration"
                placeholder="Número de matrícula"
                >
              <span class="icon left"><i class="fa-solid fa-address-card"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Data de Lotação</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="date" 
                name="lotation" 
                placeholder=""
                >
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
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
              <option value="40">40 H</option>
              <option value="20">20 H</option>
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