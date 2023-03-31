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

  <div class="flex justify-center">
    <a href="{{route('manageBoxes')}}" class="p-4 button bg-teal-900 text-white font-bold shadow hover:bg-teal-700"><span class="icon">
      <i class="fa-solid fa-boxes-stacked"></i></span> Gerenciar Caixas
    </a> 
  </div>

  <div class="">
    <form method="POST" action="{{route('search')}}" class="w-96">
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
        <label class="label">Feriados / Recessos</label>
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
        <label class="label">Sábados Letivos</label>
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
            <select name="field2" id="field2" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="3" onchange="console.log(this.selectedOptions)">
              <option>Abarth</option>
              <option>Alfa Romeo</option>
              <option>Aston Martin</option>
              <option>Audi</option>
              <option>Bentley</option>
              <option>BMW</option>
              <option>Bugatti</option>
              <option>Cadillac</option>
              <option>Chevrolet</option>
              <option>Chrysler</option>
              <option>Citroën</option>
              <option>Dacia</option>
              <option>Daewoo</option>
              <option>Daihatsu</option>
              <option>Dodge</option>
              <option>Donkervoort</option>
              <option>DS</option>
              <option>Ferrari</option>
              <option>Fiat</option>
              <option>Fisker</option>
              <option>Ford</option>
              <option>Honda</option>
              <option>Hummer</option>
              <option>Hyundai</option>
              <option>Infiniti</option>
              <option>Iveco</option>
              <option>Jaguar</option>
              <option>Jeep</option>
              <option>Kia</option>
              <option>KTM</option>
              <option>Lada</option>
              <option>Lamborghini</option>
              <option>Lancia</option>
              <option>Land Rover</option>
              <option>Landwind</option>
              <option>Lexus</option>
              <option>Lotus</option>
              <option>Maserati</option>
              <option>Maybach</option>
              <option>Mazda</option>
              <option>McLaren</option>
              <option>Mercedes-Benz</option>
              <option>MG</option>
              <option>Mini</option>
              <option>Mitsubishi</option>
              <option>Morgan</option>
              <option>Nissan</option>
              <option>Opel</option>
              <option>Peugeot</option>
              <option>Porsche</option>
              <option>Renault</option>
              <option>Rolls-Royce</option>
              <option>Rover</option>
              <option>Saab</option>
              <option>Seat</option>
              <option>Skoda</option>
              <option>Smart</option>
              <option>SsangYong</option>
              <option>Subaru</option>
              <option>Suzuki</option>
              <option>Tesla</option>
              <option>Toyota</option>
              <option>Volkswagen</option>
              <option>Volvo</option>
            </select>
          </div>
        </div>
      </div>

      

      <div class="field">
        <label class="label">Pesquisar</label>
        <div class="control">
          <input class="input" id="name" name="name" type="text" placeholder="Nome do aluno, servidor etc.">
        </div>
      </div>
      <div class="field grouped">
        <div class="control">
          <button type="submit" class="button bg-teal-900 text-white font-bold shadow hover:bg-teal-700">
            <span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span> Pesquisar
          </button>
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
    inputHoliday.setAttribute('name', 'holiday');
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
    inputSaturday.setAttribute('name', 'saturday');
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