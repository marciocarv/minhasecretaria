@extends('layouts.site')

@section('content')

<section class="is-hero-bar">
  <div class="flex flex-col items-center justify-between space-y-6 md:flex-row md:space-y-0">
    <h1 class="title">
      {{$title}}
    </h1>
  </div>
</section>

<section class="section main-section">
  <div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
    
    <form method="POST" action="{{ route('pointbook.print') }}" target="_blank">
      @csrf
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
          
        <div class="field">
          <label class="label font-bold text-gray-700">Mês de Referência</label>
          <div class="control">
            <input 
              class="input w-full border rounded p-2 focus:ring-2 focus:ring-blue-500" 
              type="month" 
              name="month" 
              required
            >
          </div>
        </div>

        <div class="field">
          <label class="label font-bold text-gray-700">Servidores</label>
          <div class="control">
            <div class="select w-full">
              <select name="employment_bonds[]" id="field2" multiple multiselect-search="true" multiselect-select-all="true" required class="w-full">
                @foreach($employment_bonds as $bond)
                  <option value="{{ $bond->id }}">
                    {{ $bond->employee->name }} - {{ $bond->post }} ({{ $bond->workload }}h)
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <p class="text-xs text-gray-500 mt-1">Você pode selecionar um, vários ou todos os servidores de uma vez.</p>
        </div>
      </div>

      <hr class="my-6">

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        
        <div class="field">
          <label class="label font-bold text-gray-700">Feriados / Recessos:</label>
          <div class="control" id="divHoliday">
              </div>
          <div class="mt-2 flex space-x-2">
            <button type="button" class="button bg-teal-900 text-white font-bold px-3 py-1 rounded shadow hover:bg-teal-700" id="addHoliday">
              <span class="icon"><i class="fa-solid fa-square-plus"></i></span> Adicionar
            </button>
            <button type="button" class="button bg-orange-500 text-white font-bold px-3 py-1 rounded shadow hover:bg-orange-700" id="removeHoliday">
              <span class="icon"><i class="fa-solid fa-square-xmark"></i></span> Remover
            </button>
          </div>
        </div>

        <div class="field">
          <label class="label font-bold text-gray-700">Sábados Letivos (Com aula):</label>
          <div class="control" id="divSaturday">
              </div>
          <div class="mt-2 flex space-x-2">
            <button type="button" class="button bg-teal-900 text-white font-bold px-3 py-1 rounded shadow hover:bg-teal-700" id="addSaturday">
              <span class="icon"><i class="fa-solid fa-square-plus"></i></span> Adicionar
            </button>
            <button type="button" class="button bg-orange-500 text-white font-bold px-3 py-1 rounded shadow hover:bg-orange-700" id="removeSaturday">
              <span class="icon"><i class="fa-solid fa-square-xmark"></i></span> Remover
            </button>
          </div>
        </div>
      </div>

      <div class="field mt-8 flex justify-end">
        <div class="control">
          <button type="submit" class="button green bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-2 rounded shadow text-lg">
            Gerar Folhas de Ponto
            <span class="icon right"><i class="fa-solid fa-print"></i></span>
          </button>
        </div>
      </div>

    </form>
  </div>
</section>

@endsection

@section('script')
<script src="{{asset('js/multiselect-dropdown.js')}}"></script>

<script>
  let contH = 1;
  let contS = 1;

  // Lógica de Feriados
  document.querySelector('#addHoliday').addEventListener('click', () => {
    let newInput = document.querySelector('#divHoliday');
    let inputHoliday = document.createElement('input');
    inputHoliday.className = 'holiday input w-full border rounded p-2 mb-2 focus:ring-2 focus:ring-blue-500';
    inputHoliday.setAttribute('type', 'date');
    inputHoliday.setAttribute('name', 'holidays[]');
    inputHoliday.setAttribute('id', 'holy' + contH);
    contH++;
    newInput.appendChild(inputHoliday);
  });

  document.querySelector('#removeHoliday').addEventListener('click', () => {
    if(contH > 1) {
      contH--;
      document.querySelector('#holy' + contH).remove();
    }
  });

  // Lógica de Sábados Letivos
  document.querySelector('#addSaturday').addEventListener('click', () => {
    let newInput = document.querySelector('#divSaturday');
    let inputSaturday = document.createElement('input');
    inputSaturday.className = 'saturday input w-full border rounded p-2 mb-2 focus:ring-2 focus:ring-blue-500';
    inputSaturday.setAttribute('type', 'date');
    inputSaturday.setAttribute('name', 'saturdays[]');
    inputSaturday.setAttribute('id', 'satu' + contS);
    contS++;
    newInput.appendChild(inputSaturday);
  });

  document.querySelector('#removeSaturday').addEventListener('click', () => {
    if(contS > 1) {
      contS--;
      document.querySelector('#satu' + contS).remove();
    }
  });
</script>
@endsection