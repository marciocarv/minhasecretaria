@extends('layouts.site')

@section('content')

<div class="return mb-4">
  <a href="{{route('manageEmployee', ['id'=>$employment_bond])}}" class="text-gray-500 font-bold m-2 hover:text-blue-800 transition-colors"> 
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

  <div class="w-full max-w-5xl mx-auto">
    
    <div class="bg-blue-50 border border-blue-100 p-4 rounded-lg shadow-sm mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
      <div>
        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Servidor</p>
        <p class="font-semibold text-gray-800">{{$employment_bond->employee->name}}</p>
      </div>
      <div>
        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Data de Nascimento</p>
        <p class="font-semibold text-gray-800">{{$employment_bond->employee->date_birth->format('d/m/Y')}}</p>
      </div>
      <div>
        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Matrícula</p>
        <p class="font-semibold text-gray-800">{{$employment_bond->registration}}</p>
      </div>
      <div>
        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Cargo Atual</p>
        <p class="font-semibold text-gray-800">{{$employment_bond->post}}</p>
      </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
      <form method="POST" action="{{route($route)}}">
        @csrf
        <input type="hidden" value="{{$employment_bond->employee->id}}" name="employee_id">
        <input type="hidden" value="{{$employment_bond->id}}" name="employment_bond_id">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          
          <div class="field">
            <label class="label font-semibold text-gray-700">Data de Lotação</label>
            <div class="control icons-left">
              <input class="input" type="date" name="lotation" required>
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label font-semibold text-gray-700">Início de Atividade</label>
            <div class="control icons-left">
              <input class="input" type="date" name="activity_start" required>
              <span class="icon left"><i class="fa-solid fa-calendar-check"></i></span>
            </div>
          </div> 

          <div class="field">
            <label class="label font-semibold text-gray-700">Nova Função</label>
            <div class="control">
              <div class="select w-full">
                <select name="role" class="w-full" required>
                  <option value="">Escolha uma opção</option>
                  <option value="DIRETOR">DIRETOR</option>
                  <option value="SECRETARIO GERAL">SECRETÁRIO GERAL</option>
                  <option value="COORDENADOR ADMINISTRATIVO FINANCEIRO">CAF</option>
                  <option value="PROFESSOR - ANOS FINAIS">PROFESSOR - ANOS FINAIS</option>
                  <option value="PROFESSOR - ANOS INICIAIS">PROFESSOR - ANOS INICIAIS</option>
                  <option value="PROFESSOR - SALA DE RECURSO">PROFESSOR - SALA DE RECURSO</option>
                  <option value="SUPERVISOR PEDAGOGICO">SUPERVISOR PEDAGÓGICO</option>
                  <option value="ORIENTADOR PEDAGOGICO">ORIENTADOR PEDAGÓGICO</option>
                  <option value="AUXILIAR DE SECRETARIA">AUXILIAR DE SECRETARIA</option>
                  <option value="AUXILIAR FINANCEIRO">AUXILIAR FINANCEIRO</option>
                  <option value="AUXILIAR DA BIBLIOTECA">AUXILIAR DA BIBLIOTECA</option>
                  <option value="SUPORTE PEDAGOGICO">SUPORTE PEDAGÓGICO</option>
                  <option value="APOIO ESCOLAR">APOIO ESCOLAR</option>
                  <option value="TECNICO EM MULTIMIDIAS">TÉCNICO EM MULTIMÍDIAS</option>
                  <option value="ASSISTENTE DE SALA">ASSISTENTE DE SALA</option>
                  <option value="ASSISTENTE SOCIAL">ASSISTENTE SOCIAL</option>
                  <option value="PSICOLOGO">PSICÓLOGO</option>
                  <option value="CUIDADOR">CUIDADOR</option>
                  <option value="LIMPEZA">LIMPEZA</option>
                  <option value="MERENDA">MERENDA</option>
                  <option value="VIGIA DIURNO">VIGIA DIURNO</option>
                  <option value="VIGIA NOTURNO">VIGIA NOTURNO</option>
                </select>
              </div>
            </div>
          </div>

          <div class="field">
            <label class="label font-semibold text-gray-700">Carga Horária</label>
            <div class="control">
              <div class="select w-full">
                <select name="workload" class="w-full" required>
                  <option value="">Escolha uma opção</option>
                  <option value="40">40 HORAS</option>
                  <option value="20">20 HORAS</option>
                </select>
              </div>
            </div>
          </div>

          <div class="field">
            <label class="label font-semibold text-gray-700">Turno de Trabalho</label>
            <div class="control">
              <div class="select w-full">
                <select name="work_shift" id="work_shift" required class="w-full" onchange="toggleScaleDate()">
                  <option value="">Selecione o turno ou escala</option>
                  <option value="matutino" {{ old('work_shift', $employment_bond->work_shift ?? '') == 'matutino' ? 'selected' : '' }}>Matutino (20h)</option>
                  <option value="vespertino" {{ old('work_shift', $employment_bond->work_shift ?? '') == 'vespertino' ? 'selected' : '' }}>Vespertino (20h)</option>
                  <option value="integral" {{ old('work_shift', $employment_bond->work_shift ?? '') == 'integral' ? 'selected' : '' }}>Integral / Matutino e Vespertino (40h)</option>
                  <option value="12x36_diurno" {{ old('work_shift', $employment_bond->work_shift ?? '') == '12x36_diurno' ? 'selected' : '' }}>Vigia 12x36 - Diurno (06:30 às 18:30)</option>
                  <option value="12x36_noturno" {{ old('work_shift', $employment_bond->work_shift ?? '') == '12x36_noturno' ? 'selected' : '' }}>Vigia 12x36 - Noturno (18:30 às 06:30)</option>
                </select>
              </div>
            </div>
            <p class="text-xs text-gray-500 mt-1">Define como o Livro de Ponto irá gerar os dias trabalhados automaticamente.</p>
          </div>

          <div class="field" id="scale_date_container" style="display: none;">
            <label class="label font-semibold text-gray-700">Data de Início da Escala (12x36)</label>
            <div class="control icons-left">
              <input type="date" name="scale_start_date" id="scale_start_date" 
                     value="{{ old('scale_start_date', isset($employment_bond->scale_start_date) ? $employment_bond->scale_start_date->format('Y-m-d') : '') }}" 
                     class="input w-full border rounded p-2">
              <span class="icon left"><i class="fa-solid fa-calendar-day"></i></span>
            </div>
            <p class="text-xs text-gray-500 mt-1">Informe um dia em que o servidor <strong>efetivamente trabalhou</strong>.</p>
          </div>

        </div>

        <div class="field grouped mt-8 flex justify-end">
          <div class="control">
            <button type="submit" class="button green px-6">
              <span class="icon left"><i class="fa-solid fa-floppy-disk"></i></span>
              Salvar Alteração
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
    if(notification) {
      notification.classList.add('hidden');
    }
  }

  function toggleScaleDate() {
    const shiftSelect = document.getElementById('work_shift');
    const scaleContainer = document.getElementById('scale_date_container');
    
    // Mostra o campo apenas se a opção selecionada contiver "12x36"
    if (shiftSelect.value.includes('12x36')) {
      scaleContainer.style.display = 'block';
    } else {
      scaleContainer.style.display = 'none';
    }
  }

  // Executa a função assim que a página carrega para verificar se já há um turno 12x36 salvo
  window.addEventListener('load', toggleScaleDate);
</script>
@endsection