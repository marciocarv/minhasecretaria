@extends('layouts.site')

@section('content')

<div class="return">
  <a href="{{route('employee')}}" class="text-gray-500 font-bold m-2 hover:text-blue-800"> <i class="fa-solid fa-arrow-left"></i> Voltar</a>
</div>

<section class="is-hero-bar">
  <div class="flex flex-col items-center justify-between space-y-6 md:flex-row md:space-y-0">
    <h1 class="title" id="form-title">
      {{$title}} - Passo 1: Dados Pessoais
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
    <form method="POST" action="{{route($route)}}" class="w-96" id="employeeForm">
      @csrf
      @if($action === "update")
        <input type="hidden" value="{{$employment_bond->id}}" name="employment_bond_id">
        <input type="hidden" value="{{$employee->id}}" name="employee_id">
      @endif

      <div id="step-1" class="form-step">
        <div class="field">
          <label class="label">Nome</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input uppercase-input" type="text" name="name" placeholder="Nome" required @if($action == 'update') value="{{$employee->name}}" @endif>
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
                <input class="input" type="date" name="date_birth" required @if($action == 'update') value="{{$employee->date_birth->format('Y-m-d')}}" @endif>
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
                <input class="input uppercase-input" type="text" name="mother" placeholder="Nome da mãe" required @if($action == 'update') value="{{$employee->mother}}" @endif>
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
                <input class="input uppercase-input" type="text" name="father" placeholder="Nome do pai" @if($action == 'update') value="{{$employee->father}}" @endif>
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
                <input class="input uppercase-input" type="text" name="naturalness" placeholder="Naturalidade" @if($action == 'update') value="{{$employee->naturalness}}" @endif>
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
                <option value="SOLTEIRO" @if($action == 'update' && $employee->marital_status == 'SOLTEIRO') selected @endif>SOLTEIRO</option>
                <option value="CASADO" @if($action == 'update' && $employee->marital_status == 'CASADO') selected @endif>CASADO</option>
                <option value="DIVORCIADO" @if($action == 'update' && $employee->marital_status == 'DIVORCIADO') selected @endif>DIVORCIADO</option>
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
                <option value="MASCULINO" @if($action == 'update' && $employee->sex == 'MASCULINO') selected @endif>MASCULINO</option>
                <option value="FEMININO" @if($action == 'update' && $employee->sex == 'FEMININO') selected @endif>FEMININO</option>
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
                <option value="BRANCO" @if($action == 'update' && $employee->color == 'BRANCO') selected @endif>BRANCO</option>
                <option value="PRETO" @if($action == 'update' && $employee->color == 'PRETO') selected @endif>PRETO</option>
                <option value="PARDO" @if($action == 'update' && $employee->color == 'PARDO') selected @endif>PARDO</option>
                <option value="AMARELO" @if($action == 'update' && $employee->color == 'AMARELO') selected @endif>AMARELO</option>
                <option value="INDIGENA" @if($action == 'update' && $employee->color == 'INDIGENA') selected @endif>INDÍGENA</option>
              </select>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Celular</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text" name="phone" id="phone" placeholder="Número do Celular" @if($action == 'update') value="{{$employee->phone}}" @endif>
                <span class="icon left"><i class="fa-solid fa-mobile-screen"></i></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="field grouped">
          <div class="control">
            <button type="button" class="button green" onclick="nextStep(1)">
              Próximo
              <span class="icon left"><i class="fa-solid fa-angles-right"></i></span>
            </button>
          </div>
        </div>
      </div>

      <div id="step-2" class="form-step hidden">
        <div class="field">
          <label class="label">CEP</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text" name="cep" id="cep" placeholder="Código Postal" @if($action == 'update') value="{{$employee->cep}}" @endif>
                <span class="icon left"><i class="fa-solid fa-map-location-dot"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Endereço</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input uppercase-input" type="text" name="address" placeholder="Endereço completo" @if($action == 'update') value="{{$employee->address}}" @endif>
                <span class="icon left"><i class="fa-solid fa-map-location-dot"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">CPF</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text" name="cpf" id="cpf" placeholder="Número do CPF" @if($action == 'update') value="{{$employee->cpf}}" @endif>
                <span class="icon left"><i class="fa-solid fa-address-card"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">RG</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text" name="rg" placeholder="Número do RG" @if($action == 'update') value="{{$employee->rg}}" @endif>
                <span class="icon left"><i class="fa-solid fa-address-card"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Expedição do RG</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="date" name="rg_expedition" @if($action == 'update' && $employee->rg_expedition) value="{{$employee->rg_expedition->format('Y-m-d')}}" @endif>
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
                <option value="NASCIMENTO" @if($action == 'update' && $employee->certificate_type == 'NASCIMENTO') selected @endif>NASCIMENTO</option>
                <option value="CASAMENTO" @if($action == 'update' && $employee->certificate_type == 'CASAMENTO') selected @endif>CASAMENTO</option>
              </select>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Termo da Certidão</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text" name="certificate_term" placeholder="Número do Termo da Certidão" @if($action == 'update') value="{{$employee->certificate_term}}" @endif>
                <span class="icon left"><i class="fa-solid fa-certificate"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Livro</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text" name="certificate_book" placeholder="Número do livro da Certidão" @if($action == 'update') value="{{$employee->certificate_book}}" @endif>
                <span class="icon left"><i class="fa-solid fa-book"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Folha</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text" name="certificate_sheet" placeholder="Número da folha da Certidão" @if($action == 'update') value="{{$employee->certificate_sheet}}" @endif>
                <span class="icon left"><i class="fa-solid fa-receipt"></i></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="field grouped">
          <div class="control">
            <button type="button" class="button blue" onclick="prevStep(2)">
              <span class="icon left"><i class="fa-solid fa-angles-left"></i></span> Voltar
            </button>
          </div>
          <div class="control">
            <button type="button" class="button green" onclick="nextStep(2)">
              Próximo <span class="icon left"><i class="fa-solid fa-angles-right"></i></span>
            </button>
          </div>
        </div>
      </div>

      <div id="step-3" class="form-step hidden">
        <div class="field">
          <label class="label">Banco</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input uppercase-input" type="text" name="bank_name" placeholder="Nome da Instituição Bancária" @if($action == 'update') value="{{$employee->bank_name}}" @endif>
                <span class="icon left"><i class="fa-solid fa-building-columns"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Agência</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text" name="bank_agency" placeholder="Número da agência" @if($action == 'update') value="{{$employee->bank_agency}}" @endif>
                <span class="icon left"><i class="fa-solid fa-building-columns"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Conta</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text" name="bank_number" placeholder="Número da conta" @if($action == 'update') value="{{$employee->bank_number}}" @endif>
                <span class="icon left"><i class="fa-solid fa-building-columns"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Escolaridade</label>
          <div class="control">
            <div class="select">
              <select name="schooling">
                <option value="">Escolha uma opção</option>
                <option value="FUNDAMENTAL" @if($action == 'update' && $employee->schooling == 'FUNDAMENTAL') selected @endif>FUNDAMENTAL</option>
                <option value="MEDIO" @if($action == 'update' && $employee->schooling == 'MEDIO') selected @endif>MÉDIO</option>
                <option value="MAGISTERIO" @if($action == 'update' && $employee->schooling == 'MAGISTERIO') selected @endif>MAGISTÉRIO</option>
                <option value="SUPERIOR" @if($action == 'update' && $employee->schooling == 'SUPERIOR') selected @endif>SUPERIOR</option>
                <option value="POS" @if($action == 'update' && $employee->schooling == 'POS') selected @endif>PÓS GRADUAÇÃO</option>
              </select>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Situação do curso</label>
          <div class="control">
            <div class="select">
              <select name="course_status">
                <option value="">Escolha uma opção</option>
                <option value="INCOMPLETO" @if($action == 'update' && $employee->course_status == 'INCOMPLETO') selected @endif>INCOMPLETO</option>
                <option value="COMPLETO" @if($action == 'update' && $employee->course_status == 'COMPLETO') selected @endif>COMPLETO</option>
                <option value="CURSANDO" @if($action == 'update' && $employee->course_status == 'CURSANDO') selected @endif>CURSANDO</option>
              </select>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Curso</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input uppercase-input" type="text" name="course_name" placeholder="Nome do Curso" @if($action == 'update') value="{{$employee->course_name}}" @endif>
                <span class="icon left"><i class="fa-solid fa-city"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Instituição</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input uppercase-input" type="text" name="name_college" placeholder="Nome da Instituição" @if($action == 'update') value="{{$employee->name_college}}" @endif>
                <span class="icon left"><i class="fa-solid fa-graduation-cap"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Ano de conclusão</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="number" name="conclusion" placeholder="Ano de conclusão" @if($action == 'update') value="{{$employee->conclusion}}" @endif>
                <span class="icon left"><i class="fa-solid fa-calendar"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field grouped">
          <div class="control">
            <button type="button" class="button blue" onclick="prevStep(3)">
              <span class="icon left"><i class="fa-solid fa-angles-left"></i></span> Voltar
            </button>
          </div>
          <div class="control">
            <button type="button" class="button green" onclick="nextStep(3)">
              Próximo <span class="icon left"><i class="fa-solid fa-angles-right"></i></span>
            </button>
          </div>
        </div>
      </div>

      <div id="step-4" class="form-step hidden">
        <div class="field">
          <label class="label">Vínculo Empregatício</label>
          <div class="control">
            <div class="select">
              <select name="bond">
                <option value="">Escolha uma opção</option>
                <option value="EFETIVO" @if($action == 'update' && $employment_bond->bond == 'EFETIVO') selected @endif>EFETIVO</option>
                <option value="CONTRATO" @if($action == 'update' && $employment_bond->bond == 'CONTRATO') selected @endif>CONTRATO</option>
                <option value="MENOR" @if($action == 'update' && $employment_bond->bond == 'MENOR') selected @endif>MENOR APRENDIZ</option>
                <option value="ESTAGIO" @if($action == 'update' && $employment_bond->bond == 'ESTAGIO') selected @endif>ESTÁGIO</option>
                <option value="PRESTADOR" @if($action == 'update' && $employment_bond->bond == 'PRESTADOR') selected @endif>PRESTADOR DE SERVIÇO COMUNITÁRIO</option>
              </select>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Data de Admissão (Concurso)</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="date" name="admission" @if($action == 'update' && $employee->admission) value="{{$employee->admission->format('Y-m-d')}}" @endif>
                <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Matrícula</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text" name="registration" placeholder="Número de matrícula" required @if($action == 'update') value="{{$employment_bond->registration}}" @endif>
                <span class="icon left"><i class="fa-solid fa-address-card"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">ID Censo</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text" name="id_censo" placeholder="ID Censo" @if($action == 'update') value="{{$employee->id_censo}}" @endif>
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
                <input class="input" type="date" name="lotation" required @if($action == 'update') value="{{$employment_bond->lotation->format('Y-m-d')}}" @endif>
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
                <input class="input" type="date" name="activity_start" required @if($action == 'update') value="{{$employment_bond->activity_start->format('Y-m-d')}}" @endif>
                <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Cargo (Post)</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input uppercase-input" type="text" name="post" placeholder="Cargo" required @if($action == 'update') value="{{$employment_bond->post}}" @endif>
                <span class="icon left"><i class="fa-solid fa-briefcase"></i></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="field">
          <label class="label">Função (Role)</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input uppercase-input" type="text" name="role" placeholder="Função" required @if($action == 'update') value="{{$employment_bond->role}}" @endif>
                <span class="icon left"><i class="fa-solid fa-user-tie"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field">
          <label class="label">Carga Horária (Workload)</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="number" name="workload" placeholder="Carga horária" required @if($action == 'update') value="{{$employment_bond->workload}}" @endif>
                <span class="icon left"><i class="fa-solid fa-clock"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="field grouped">
          <div class="control">
            <button type="button" class="button blue" onclick="prevStep(4)">
              <span class="icon left"><i class="fa-solid fa-angles-left"></i></span> Voltar
            </button>
          </div>
          <div class="control">
            <button type="submit" class="button bg-teal-900 text-white font-bold shadow hover:bg-teal-700">
              <span class="icon left"><i class="fa-solid fa-floppy-disk"></i></span> Salvar Servidor
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
@endsection

@section('script')
<script src="{{asset('js/vanilla-masker.min.js')}}" charset="utf-8"></script>
<script charset="utf-8" type="text/javascript">
  
  // 1. Iniciar as máscaras
  VMasker(document.querySelector("#phone")).maskPattern("(99) 99999-9999");
  VMasker(document.querySelector("#cep")).maskPattern("99.999-999");
  VMasker(document.querySelector("#cpf")).maskPattern("999.999.999-99");

  // 2. Ocultar Notificações
  function hide(){
    let notification = document.querySelector('#notification');
    if(notification) notification.classList.add('hidden');
  }

  // 3. Formatação de Texto (Maiúsculas e sem acentos)
  function uppercaseAndNormalize(ev){
    let input = ev.target;
    let val = input.value;
    val = val.toUpperCase();
    val = val.replace(/( )+/g, ' ');
    val = val.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
    input.value = val;
  }

  // Aplica a formatação em todos os campos com a classe 'uppercase-input'
  document.querySelectorAll('.uppercase-input').forEach(function(input) {
    input.addEventListener('keyup', uppercaseAndNormalize);
    input.addEventListener('blur', uppercaseAndNormalize);
  });

  // 4. Lógica de Navegação entre os Passos (Steps)
  const stepTitles = [
    "Dados Pessoais",
    "Endereço e Documentos",
    "Dados Bancários e Formação",
    "Dados Profissionais (Vínculo)"
  ];

  function nextStep(currentStep) {
    // Validação básica do HTML5 antes de avançar
    const stepDiv = document.getElementById('step-' + currentStep);
    const inputs = stepDiv.querySelectorAll('input[required], select[required]');
    let isValid = true;
    
    inputs.forEach(input => {
      if (!input.checkValidity()) {
        input.reportValidity();
        isValid = false;
      }
    });

    if (!isValid) return;

    // Ocultar atual, mostrar próximo
    document.getElementById('step-' + currentStep).classList.add('hidden');
    document.getElementById('step-' + (currentStep + 1)).classList.remove('hidden');
    
    // Atualizar título
    document.getElementById('form-title').innerText = "{{$title}} - Passo " + (currentStep + 1) + ": " + stepTitles[currentStep];
  }

  function prevStep(currentStep) {
    // Ocultar atual, mostrar anterior
    document.getElementById('step-' + currentStep).classList.add('hidden');
    document.getElementById('step-' + (currentStep - 1)).classList.remove('hidden');
    
    // Atualizar título
    document.getElementById('form-title').innerText = "{{$title}} - Passo " + (currentStep - 1) + ": " + stepTitles[currentStep - 2];
  }

</script>
@endsection