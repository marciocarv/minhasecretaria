@extends('layouts.site')

@section('content')

<div class="return mb-4">
  <a href="{{route('employee')}}" class="text-gray-500 font-bold m-2 hover:text-blue-800 transition-colors"> 
    <i class="fa-solid fa-arrow-left mr-1"></i> Voltar
  </a>
</div>

<section class="is-hero-bar mb-6">
  <div class="flex flex-col items-center justify-between space-y-6 md:flex-row md:space-y-0">
    <h1 class="title text-2xl font-bold text-gray-800">
      {{$title}}
    </h1>
  </div>
</section>

<section class="section main-section">

  @if(session('success'))
  <div id="notification" class="notification bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm mb-6 flex justify-between items-center">
    <div>
      <span class="icon mr-2"><i class="fa-solid fa-check-circle"></i></span>
      <b>{{session('success')}}</b>
    </div>
    <button type="button" class="text-green-700 hover:text-green-900 font-bold" onclick="hide()"><i class="fa-solid fa-xmark"></i></button>
  </div>
  @endif

  @if(session('error'))
  <div id="notification" class="notification bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm mb-6 flex justify-between items-center">
    <div>
      <span class="icon mr-2"><i class="fa-solid fa-circle-exclamation"></i></span>
      <b>{{session('error')}}</b>
    </div>
    <button type="button" class="text-red-700 hover:text-red-900 font-bold" onclick="hide()"><i class="fa-solid fa-xmark"></i></button>
  </div>
  @endif

  <div class="w-full max-w-xl mx-auto">
    <div class="bg-white p-6 rounded-lg shadow">

      <div class="mb-6 p-4 bg-gray-50 rounded-md border border-gray-200">
        <p class="text-gray-700"><strong>Servidor:</strong> {{$employee->name}}</p>
        <p class="text-gray-700"><strong>Data de Nascimento:</strong> {{$employee->date_birth->format('d/m/Y')}}</p>
      </div>

      <form method="POST" action="{{route($route)}}">
        @csrf
        <input type="hidden" value="{{$employee->id}}" name="employee_id">

        <div class="field mb-4">
          <label class="label font-semibold text-gray-700">Vínculo Empregatício</label>
          <div class="control">
            <div class="select w-full">
              <select name="bond" class="w-full border rounded p-2">
                <option value="">Escolha uma opção</option>
                <option value="EFETIVO">EFETIVO</option>
                <option value="CONTRATO">CONTRATO</option>
              </select>
            </div>
          </div>
        </div>

        <div class="field mb-4">
          <label class="label font-semibold text-gray-700">Matrícula</label>
          <div class="control icons-left">
            <input 
              class="input w-full border rounded p-2" 
              type="text" 
              name="registration"
              placeholder="Número de matrícula"
              >
            <span class="icon left"><i class="fa-solid fa-address-card"></i></span>
          </div>
        </div>

        <div class="field mb-4">
          <label class="label font-semibold text-gray-700">Data de Lotação</label>
          <div class="control icons-left">
            <input 
              class="input w-full border rounded p-2" 
              type="date" 
              name="lotation" 
              >
            <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
          </div>
        </div>

        <div class="field mb-4">
          <label class="label font-semibold text-gray-700">Início de atividade</label>
          <div class="control icons-left">
            <input 
              class="input w-full border rounded p-2" 
              type="date" 
              name="activity_start" 
              >
            <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
          </div>
        </div> 

        <div class="field mb-4">
          <label class="label font-semibold text-gray-700">Cargo</label>
          <div class="control icons-left">
            <input 
              class="input w-full border rounded p-2" 
              type="text" 
              name="post"
              id="uppercase_1"
              placeholder="Cargo"
              >
            <span class="icon left"><i class="fa-solid fa-city"></i></span>
          </div>
        </div>

        <div class="field mb-4">
          <label class="label font-semibold text-gray-700">Função</label>
          <div class="control icons-left">
            <input 
              class="input w-full border rounded p-2" 
              type="text" 
              name="role"
              id="uppercase_2"
              placeholder="Função"
              >
            <span class="icon left"><i class="fa-solid fa-id-badge"></i></span>
          </div>
        </div>

        <div class="field mb-4">
          <label class="label font-semibold text-gray-700">Carga Horária</label>
          <div class="control">
            <div class="select w-full">
              <select name="workload" class="w-full border rounded p-2">
                <option value="">Escolha uma opção</option>
                <option value="40">40 H</option>
                <option value="20">20 H</option>
              </select>
            </div>
          </div>
        </div>

        <div class="field mb-4">
          <label class="label font-semibold text-gray-700">Turno de Trabalho</label>
          <div class="control">
            <div class="select w-full">
              <select name="work_shift" id="work_shift" class="w-full border rounded p-2">
                <option value="">Escolha um turno</option>
                <option value="Matutino">Matutino</option>
                <option value="Vespertino">Vespertino</option>
                <option value="Noturno">Noturno</option>
                <option value="Integral">Integral</option>
                <option value="12x36 - Dia">12x36 - Dia</option>
                <option value="12x36 - Noite">12x36 - Noite</option>
              </select>
            </div>
          </div>
        </div>

        <div class="field mb-4 hidden" id="scale-date-field">
          <label class="label font-semibold text-gray-700">Data de Início da Escala (12x36)</label>
          <div class="control icons-left">
            <input 
              class="input w-full border rounded p-2" 
              type="date" 
              name="scale_start_date" 
              id="scale_start_date"
              >
            <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
          </div>
        </div>

        <div class="field grouped mt-6 flex justify-end">
          <div class="control">
            <button type="submit" class="button green px-6">
              <span class="icon left"><i class="fa-solid fa-floppy-disk mr-1"></i></span> Salvar
            </button>
          </div>
        </div>

      </form>
    </div>
  </div>

</section>

@endsection

@section('script')
<script>
  function hide(){
    let notification = document.querySelector('#notification');
    if(notification){
      notification.classList.add('hidden');
    }
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
    let el = document.querySelector('#uppercase_'+i);
    if(el){
      el.addEventListener('keyup', (ev) => {
        uppercase(ev);
        less_space(ev);
      });
    }
  }

  // Lógica dinâmica para exibir o campo de escala 12x36
  const workShiftSelect = document.querySelector('#work_shift');
  const scaleDateField = document.querySelector('#scale-date-field');

  if(workShiftSelect && scaleDateField){
    workShiftSelect.addEventListener('change', () => {
      if(workShiftSelect.value.includes('12x36')){
        scaleDateField.classList.remove('hidden');
      } else {
        scaleDateField.classList.add('hidden');
        document.querySelector('#scale_start_date').value = '';
      }
    });
  }
</script>
@endsection