@extends('layouts.site')

@section('css')
  
@endsection

@section('content')

<section class="is-hero-bar">
  <div class="flex flex-col items-center justify-between space-y-6 md:flex-row md:space-y-0">
    <h1 class="title">
      {{$title}}
    </h1>
  </div>
</section>

<section class="section main-section">
  <div class="">
    <form method="POST" action="{{route('makePointBook')}}" class="w-1/2">
      @csrf
      <div class="field">
        <label class="label">Mês</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input w-60" 
                type="month" 
                name="month" 
                placeholder="Mês"
                >
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Feriados / Recessos:</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left" id="divHoliday">
            </div>
            <button type="button" class="button bg-teal-900 text-white font-bold shadow hover:bg-teal-700" id="addHoliday">
              <span class="icon"><i class="fa-solid fa-square-plus"></i></span> Adicionar
            </button>
            <button type="button" class="button bg-orange-500 text-white font-bold shadow hover:bg-orange-700" id="removeHoliday">
              <span class="icon"><i class="fa-solid fa-square-xmark"></i></span> Remover
            </button>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Sábados Letivos:</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left" id="divSaturday">
            </div>
            <button type="button" class="button bg-teal-900 text-white font-bold shadow hover:bg-teal-700" id="addSaturday">
              <span class="icon"><i class="fa-solid fa-square-plus"></i></span> Adicionar
            </button>
            <button type="button" class="button bg-orange-500 text-white font-bold shadow hover:bg-orange-700" id="removeSaturday">
              <span class="icon"><i class="fa-solid fa-square-xmark"></i></span> Remover
            </button>
          </div>
        </div>
      </div>
      
      <div class="field">
        <label class="label">Servidor</label>
        <div class="control">
          <div class="select">
            <select name="employee[]" id="field2" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="3" onchange="console.log(this.selectedOptions)">
              @foreach($employees as $employee)
                <option value="{{$employee->id}}">{{$employee->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="field grouped">
        <div class="control">
          <button type="submit" class="button green">
            Gerar
            <span class="icon left"><i class="fa-solid fa-angles-right"></i></span>
          </button>
        </div>
        <div class="control">
        </div>
      </div>

    </form>
  </div>
</section>
  
          
@endsection

@section('script')
<script src="{{asset('js/multiselect-dropdown.js')}}" ></script>
<script>
  var contH = 1;
  var contS = 1;
  function uppercase(ev){
    const input = ev.target;
	  input.value = input.value.toUpperCase();
  }

  function less_space(ev){
    const input = ev.target;
	  input.value = input.value.replace(/( )+/g, ' ');
    input.value = input.value.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
  }

  document.querySelector('#addHoliday').addEventListener('click', ()=>{
    var newInput = document.querySelector('#divHoliday')
    var inputHoliday = document.createElement('input');
    inputHoliday.classList.add('holiday');
    inputHoliday.classList.add('input');
    inputHoliday.classList.add('my-2');
    inputHoliday.setAttribute('type', 'date');
    inputHoliday.setAttribute('name', 'holidays[]');
    inputHoliday.setAttribute('id', 'holy'+contH);
    contH++;
    newInput.appendChild(inputHoliday);
  });

  document.querySelector('#removeHoliday').addEventListener('click', ()=>{
    contH--;
    var inputHoliday = document.querySelector('#holy'+contH);
    inputHoliday.remove();
  });

  document.querySelector('#addSaturday').addEventListener('click', ()=>{
    var newInput = document.querySelector('#divSaturday')
    var inputSaturday = document.createElement('input');
    inputSaturday.classList.add('saturday');
    inputSaturday.classList.add('input');
    inputSaturday.classList.add('my-2');
    inputSaturday.setAttribute('type', 'date');
    inputSaturday.setAttribute('name', 'saturdays[]');
    inputSaturday.setAttribute('id', 'satu'+contS);
    contS++;
    newInput.appendChild(inputSaturday);
  });

  document.querySelector('#removeSaturday').addEventListener('click', ()=>{
    contS--;
    var inputHoliday = document.querySelector('#satu'+contS);
    inputHoliday.remove();
  });

  document.querySelector('#name').addEventListener('keyup', (ev) => {
    uppercase(ev);
  });

  document.querySelector('#name').addEventListener('blur', (ev) => {
    less_space(ev);
  });


</script>

@endsection