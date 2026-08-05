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

  <div class="w-full max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <form method="POST" action="{{route($route)}}" id="employeeForm">
      @csrf
      @if($action === "update")
        <input type="hidden" value="{{$employment_bond->id}}" name="employment_bond_id">
        <input type="hidden" value="{{$employee->id}}" name="employee_id">
      @endif

      <div id="step-1" class="form-step">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          
          <div class="field">
            <label class="label">Nome</label>
            <div class="control icons-left">
              <input class="input uppercase-input" type="text" name="name" placeholder="Nome" required @if($action == 'update') value="{{$employee->name}}" @endif>
              <span class="icon left"><i class="fa-solid fa-id-card"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Data de Nascimento</label>
            <div class="control icons-left">
              <input class="input" type="date" name="date_birth" required @if($action == 'update') value="{{$employee->date_birth->format('Y-m-d')}}" @endif>
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Mãe</label>
            <div class="control icons-left">
              <input class="input uppercase-input" type="text" name="mother" placeholder="Nome da mãe" required @if($action == 'update') value="{{$employee->mother}}" @endif>
              <span class="icon left"><i class="fa-solid fa-person-breastfeeding"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Pai</label>
            <div class="control icons-left">
              <input class="input uppercase-input" type="text" name="father" placeholder="Nome do pai" @if($action == 'update') value="{{$employee->father}}" @endif>
              <span class="icon left"><i class="fa-solid fa-person"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Naturalidade</label>
            <div class="control icons-left">
              <input class="input uppercase-input" type="text" name="naturalness" placeholder="Naturalidade" @if($action == 'update') value="{{$employee->naturalness}}" @endif>
              <span class="icon left"><i class="fa-solid fa-city"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Estado Civil</label>
            <div class="control">
              <div class="select w-full">
                <select name="marital_status" class="w-full">
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
              <div class="select w-full">
                <select name="sex" class="w-full">
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
              <div class="select w-full">
                <select name="color" class="w-full">
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
            <div class="control icons-left">
              <input class="input" type="text" name="phone" id="phone" placeholder="Número do Celular" @if($action == 'update') value="{{$employee->phone}}" @endif>
              <span class="icon left"><i class="fa-solid fa-mobile-screen"></i></span>
            </div>
          </div>
        </div> <div class="field grouped mt-6 flex justify-end">
          <div class="control">
            <button type="button" class="button green" onclick="nextStep(1)">
              Próximo
              <span class="icon right"><i class="fa-solid fa-angles-right"></i></span>
            </button>
          </div>
        </div>
      </div>

      <div id="step-2" class="form-step hidden">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="field">
            <label class="label">CEP</label>
            <div class="control icons-left">
              <input class="input" type="text" name="cep" id="cep" placeholder="Código Postal" @if($action == 'update') value="{{$employee->cep}}" @endif>
              <span class="icon left"><i class="fa-solid fa-map-location-dot"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Endereço</label>
            <div class="control icons-left">
              <input class="input uppercase-input" type="text" name="address" placeholder="Endereço completo" @if($action == 'update') value="{{$employee->address}}" @endif>
              <span class="icon left"><i class="fa-solid fa-map-location-dot"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">CPF</label>
            <div class="control icons-left">
              <input class="input" type="text" name="cpf" id="cpf" placeholder="Número do CPF" @if($action == 'update') value="{{$employee->cpf}}" @endif>
              <span class="icon left"><i class="fa-solid fa-address-card"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">RG</label>
            <div class="control icons-left">
              <input class="input" type="text" name="rg" placeholder="Número do RG" @if($action == 'update') value="{{$employee->rg}}" @endif>
              <span class="icon left"><i class="fa-solid fa-address-card"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Expedição do RG</label>
            <div class="control icons-left">
              <input class="input" type="date" name="rg_expedition" @if($action == 'update' && $employee->rg_expedition) value="{{$employee->rg_expedition->format('Y-m-d')}}" @endif>
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Tipo de Certidão</label>
            <div class="control">
              <div class="select w-full">
                <select name="certificate_type" class="w-full">
                  <option value="">Escolha uma opção</option>
                  <option value="NASCIMENTO" @if($action == 'update' && $employee->certificate_type == 'NASCIMENTO') selected @endif>NASCIMENTO</option>
                  <option value="CASAMENTO" @if($action == 'update' && $employee->certificate_type == 'CASAMENTO') selected @endif>CASAMENTO</option>
                </select>
              </div>
            </div>
          </div>

          <div class="field">
            <label class="label">Termo da Certidão</label>
            <div class="control icons-left">
              <input class="input" type="text" name="certificate_term" placeholder="Número do Termo da Certidão" @if($action == 'update') value="{{$employee->certificate_term}}" @endif>
              <span class="icon left"><i class="fa-solid fa-certificate"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Livro</label>
            <div class="control icons-left">
              <input class="input" type="text" name="certificate_book" placeholder="Número do livro da Certidão" @if($action == 'update') value="{{$employee->certificate_book}}" @endif>
              <span class="icon left"><i class="fa-solid fa-book"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Folha</label>
            <div class="control icons-left">
              <input class="input" type="text" name="certificate_sheet" placeholder="Número da folha da Certidão" @if($action == 'update') value="{{$employee->certificate_sheet}}" @endif>
              <span class="icon left"><i class="fa-solid fa-receipt"></i></span>
            </div>
          </div>
        </div>
        
        <div class="field grouped mt-6 flex justify-between">
          <div class="control">
            <button type="button" class="button blue" onclick="prevStep(2)">
              <span class="icon left"><i class="fa-solid fa-angles-left"></i></span> Voltar
            </button>
          </div>
          <div class="control">
            <button type="button" class="button green" onclick="nextStep(2)">
              Próximo <span class="icon right"><i class="fa-solid fa-angles-right"></i></span>
            </button>
          </div>
        </div>
      </div>

      <div id="step-3" class="form-step hidden">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="field">
            <label class="label">Banco</label>
            <div class="control icons-left">
              <input class="input uppercase-input" type="text" name="bank_name" placeholder="Nome da Instituição Bancária" @if($action == 'update') value="{{$employee->bank_name}}" @endif>
              <span class="icon left"><i class="fa-solid fa-building-columns"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Agência</label>
            <div class="control icons-left">
              <input class="input" type="text" name="bank_agency" placeholder="Número da agência" @if($action == 'update') value="{{$employee->bank_agency}}" @endif>
              <span class="icon left"><i class="fa-solid fa-building-columns"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Conta</label>
            <div class="control icons-left">
              <input class="input" type="text" name="bank_number" placeholder="Número da conta" @if($action == 'update') value="{{$employee->bank_number}}" @endif>
              <span class="icon left"><i class="fa-solid fa-building-columns"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Escolaridade</label>
            <div class="control">
              <div class="select w-full">
                <select name="schooling" class="w-full">
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
              <div class="select w-full">
                <select name="course_status" class="w-full">
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
            <div class="control icons-left">
              <input class="input uppercase-input" type="text" name="course_name" placeholder="Nome do Curso" @if($action == 'update') value="{{$employee->course_name}}" @endif>
              <span class="icon left"><i class="fa-solid fa-city"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Instituição</label>
            <div class="control icons-left">
              <input class="input uppercase-input" type="text" name="name_college" placeholder="Nome da Instituição" @if($action == 'update') value="{{$employee->name_college}}" @endif>
              <span class="icon left"><i class="fa-solid fa-graduation-cap"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Ano de conclusão</label>
            <div class="control icons-left">
              <input class="input" type="number" name="conclusion" placeholder="Ano de conclusão" @if($action == 'update') value="{{$employee->conclusion}}" @endif>
              <span class="icon left"><i class="fa-solid fa-calendar"></i></span>
            </div>
          </div>
        </div>

        <div class="field grouped mt-6 flex justify-between">
          <div class="control">
            <button type="button" class="button blue" onclick="prevStep(3)">
              <span class="icon left"><i class="fa-solid fa-angles-left"></i></span> Voltar
            </button>
          </div>
          <div class="control">
            <button type="button" class="button green" onclick="nextStep(3)">
              Próximo <span class="icon right"><i class="fa-solid fa-angles-right"></i></span>
            </button>
          </div>
        </div>
      </div>

      <div id="step-4" class="form-step hidden">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="field">
            <label class="label">Vínculo Empregatício</label>
            <div class="control">
              <div class="select w-full">
                <select name="bond" class="w-full">
                  <option value="">Escolha uma opção</option>
                  <option value="EFETIVO" @if($action == 'update' && $employment_bond->bond == 'EFETIVO') selected @endif>EFETIVO</option>
                  <option value="CONTRATO" @if($action == 'update' && $employment_bond->bond == 'CONTRATO') selected @endif>CONTRATO</option>
                  <option value="MENOR" @if($action == 'update' && $employment_bond->bond == 'MENOR') selected @endif>MENOR APRENDIZ</option>
                  <option value="ESTAGIO" @if($action == 'update' && $employment_bond->bond == 'ESTAGIO') selected @endif>ESTÁGIO</option>
                </select>
              </div>
            </div>
          </div>

          <div class="field">
            <label class="label">Data de Admissão (Somente efetivos)</label>
            <div class="control icons-left">
              <input class="input" type="date" name="admission" @if($action == 'update' && $employee->admission) value="{{$employee->admission->format('Y-m-d')}}" @endif>
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Matrícula</label>
            <div class="control icons-left">
              <input class="input" type="text" name="registration" placeholder="Número de matrícula" required @if($action == 'update') value="{{$employment_bond->registration}}" @endif>
              <span class="icon left"><i class="fa-solid fa-address-card"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">ID Censo</label>
            <div class="control icons-left">
              <input class="input" type="text" name="id_censo" placeholder="ID Censo" @if($action == 'update') value="{{$employee->id_censo}}" @endif>
              <span class="icon left"><i class="fa-solid fa-address-card"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Data de Lotação</label>
            <div class="control icons-left">
              <input class="input" type="date" name="lotation" required @if($action == 'update') value="{{$employment_bond->lotation->format('Y-m-d')}}" @endif>
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Início de atividade</label>
            <div class="control icons-left">
              <input class="input" type="date" name="activity_start" required @if($action == 'update') value="{{$employment_bond->activity_start->format('Y-m-d')}}" @endif>
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>

          <div class="field">
            <label class="label">Cargo</label>
            <div class="control">
              <div class="select w-full">
                <select name="post" class="w-full">
                  <option value="">Escolha uma opção</option>
                  <option value="PROFESSOR I" @if($action == 'update' && $employment_bond->post == 'PROFESSOR I') selected @endif>PROFESSOR I</option>
                  <option value="PROFESSOR II" @if($action == 'update' && $employment_bond->post == 'PROFESSOR II') selected @endif>PROFESSOR II</option>
                  <option value="PROFESSOR SUBSTITUTO" @if($action == 'update' && $employment_bond->post == 'PROFESSOR SUBSTITUTO') selected @endif>PROFESSOR SUBSTITUTO</option>
                  <option value="AGENTE ADMINISTRATIVO EDUCACIONAL" @if($action == 'update' && $employment_bond->post == 'AGENTE ADMINISTRATIVO EDUCACIONAL') selected @endif>AAE</option>
                  <option value="TECNICO ADMINISTRATIVO EDUCACIONAL" @if($action == 'update' && $employment_bond->post == 'TECNICO ADMINISTRATIVO EDUCACIONAL') selected @endif>TAE</option>
                  <option value="ASSISTENTE DE SALA" @if($action == 'update' && $employment_bond->post == 'ASSISTENTE DE SALA') selected @endif>ASSISTENTE DE SALA</option>
                  <option value="ASSISTENTE GERAL" @if($action == 'update' && $employment_bond->post == 'ASSISTENTE GERAL') selected @endif>ASSISTENTE GERAL</option>
                  <option value="ASSISTENTE SOCIAL" @if($action == 'update' && $employment_bond->post == 'ASSISTENTE SOCIAL') selected @endif>ASSISTENTE SOCIAL</option>
                  <option value="PSICOLOGO" @if($action == 'update' && $employment_bond->post == 'PSICOLOGO') selected @endif>PSICOLOGO</option>
                </select>
              </div>
            </div>
          </div>
          
          <div class="field">
            <label class="label">Função</label>
            <div class="control">
              <div class="select w-full">
                <select name="role" class="w-full">
                  <option value="">Escolha uma opção</option>
                  <option value="DIRETOR" @if($action == 'update' && $employment_bond->role == 'DIRETOR') selected @endif>DIRETOR</option>
                  <option value="SECRETARIO GERAL" @if($action == 'update' && $employment_bond->role == 'SECRETARIO GERAL') selected @endif>SECRETARIO GERAL</option>
                  <option value="COORDENADOR ADMINISTRATIVO FINANCEIRO" @if($action == 'update' && $employment_bond->role == 'COORDENADOR ADMINISTRATIVO FINANCEIRO') selected @endif>CAF</option>
                  <option value="PROFESSOR - ANOS FINAIS" @if($action == 'update' && $employment_bond->role == 'PROFESSOR - ANOS FINAIS') selected @endif>PROFESSOR - ANOS FINAIS</option>
                  <option value="PROFESSOR - ANOS INICIAIS" @if($action == 'update' && $employment_bond->role == 'PROFESSOR - ANOS INICIAIS') selected @endif>PROFESSOR - ANOS INICIAIS</option>
                  <option value="PROFESSOR - SALA DE RECURSO" @if($action == 'update' && $employment_bond->role == 'PROFESSOR - SALA DE RECURSO') selected @endif>PROFESSOR - SALA DE RECURSO</option>
                  <option value="SUPERVISOR PEDAGOGICO" @if($action == 'update' && $employment_bond->role == 'SUPERVISOR PEDAGOGICO') selected @endif>SUPERVISOR PEDAGOGICO</option>
                  <option value="ORIENTADOR PEDAGOGICO" @if($action == 'update' && $employment_bond->role == 'ORIENTADOR PEDAGOGICO') selected @endif>ORIENTADOR PEDAGOGICO</option>
                  <option value="AUXILIAR DE SECRETARIA" @if($action == 'update' && $employment_bond->role == 'AUXILIAR DE SECRETARIA') selected @endif>AUXILIAR DE SECRETARIA</option>
                  <option value="AUXILIAR FINANCEIRO" @if($action == 'update' && $employment_bond->role == 'AUXILIAR FINANCEIRO') selected @endif>AUXILIAR FINANCEIRO</option>
                  <option value="AUXILIAR DA BIBLIOTECA" @if($action == 'update' && $employment_bond->role == 'AUXILIAR DA BIBLIOTECA') selected @endif>AUXILIAR DA BIBLIOTECA</option>
                  <option value="SUPORTE PEDAGOGICO" @if($action == 'update' && $employment_bond->role == 'SUPORTE PEDAGOGICO') selected @endif>SUPORTE PEDAGOGICO</option>
                  <option value="APOIO ESCOLAR" @if($action == 'update' && $employment_bond->role == 'APOIO ESCOLAR') selected @endif>APOIO ESCOLAR</option>
                  <option value="TECNICO EM MULTIMIDIAS" @if($action == 'update' && $employment_bond->role == 'TECNICO EM MULTIMIDIAS') selected @endif>TECNICO EM MULTIMIDIAS</option>
                  <option value="ASSISTENTE DE SALA" @if($action == 'update' && $employment_bond->role == 'ASSISTENTE DE SALA') selected @endif>ASSISTENTE DE SALA</option>
                  <option value="ASSISTENTE SOCIAL" @if($action == 'update' && $employment_bond->role == 'ASSISTENTE SOCIAL') selected @endif>ASSISTENTE SOCIAL</option>
                  <option value="PSICOLOGO" @if($action == 'update' && $employment_bond->role == 'PSICOLOGO') selected @endif>PSICOLOGO</option>
                  <option value="CUIDADOR" @if($action == 'update' && $employment_bond->role == 'CUIDADOR') selected @endif>CUIDADOR</option>
                  <option value="LIMPEZA" @if($action == 'update' && $employment_bond->role == 'LIMPEZA') selected @endif>LIMPEZA</option>
                  <option value="MERENDA" @if($action == 'update' && $employment_bond->role == 'MERENDA') selected @endif>MERENDA</option>
                  <option value="VIGIA DIURNO" @if($action == 'update' && $employment_bond->role == 'VIGIA DIURNO') selected @endif>VIGIA DIURNO</option>
                  <option value="VIGIA NOTURNO" @if($action == 'update' && $employment_bond->role == 'VIGIA NOTURNO') selected @endif>VIGIA NOTURNO</option>
                </select>
              </div>
            </div>
          </div>

          <div class="field">
            <label class="label">Carga Horária</label>
            <div class="control icons-left">
              <input class="input" type="number" name="workload" placeholder="Carga horária" required @if($action == 'update') value="{{$employment_bond->workload}}" @endif>
              <span class="icon left"><i class="fa-solid fa-clock"></i></span>
            </div>
          </div>
        </div>

        <div class="field mb-4">
          <label class="label font-bold text-gray-700">Turno de Trabalho:</label>
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

        <div class="field mb-4" id="scale_date_container" style="display: none;">
          <label class="label font-bold text-gray-700">Data de Início da Escala (12x36):</label>
          <div class="control">
            <input type="date" name="scale_start_date" id="scale_start_date" 
                  value="{{ old('scale_start_date', isset($employment_bond->scale_start_date) ? $employment_bond->scale_start_date->format('Y-m-d') : '') }}" 
                  class="input w-full border rounded p-2">
          </div>
          <p class="text-xs text-gray-500 mt-1">Informe um dia em que o servidor <strong>efetivamente trabalhou</strong> para servir de base matemática para o cálculo dos dias pares/ímpares do mês.</p>
        </div>

        <div class="field grouped mt-6 flex justify-between">
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

  document.querySelectorAll('.uppercase-input').forEach(function(input) {
    input.addEventListener('keyup', uppercaseAndNormalize);
    input.addEventListener('blur', uppercaseAndNormalize);
  });

  // 4. Lógica de Navegação entre os Passos
  const stepTitles = [
    "Dados Pessoais",
    "Endereço e Documentos",
    "Dados Bancários e Formação",
    "Dados Profissionais (Vínculo)"
  ];

  function nextStep(currentStep) {
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

    document.getElementById('step-' + currentStep).classList.add('hidden');
    document.getElementById('step-' + (currentStep + 1)).classList.remove('hidden');
    document.getElementById('form-title').innerText = "{{$title}} - Passo " + (currentStep + 1) + ": " + stepTitles[currentStep];
  }

  function prevStep(currentStep) {
    document.getElementById('step-' + currentStep).classList.add('hidden');
    document.getElementById('step-' + (currentStep - 1)).classList.remove('hidden');
    document.getElementById('form-title').innerText = "{{$title}} - Passo " + (currentStep - 1) + ": " + stepTitles[currentStep - 2];
  }

  function toggleScaleDate() {
    const workShiftSelect = document.getElementById('work_shift');
    const scaleContainer = document.getElementById('scale_date_container');
    const scaleInput = document.getElementById('scale_start_date');

    const selectedValue = workShiftSelect.value;

    // Se selecionar qualquer uma das opções 12x36, exibe a data âncora
    if (selectedValue === '12x36_diurno' || selectedValue === '12x36_noturno') {
      scaleContainer.style.display = 'block';
      scaleInput.setAttribute('required', 'required');
    } else {
      scaleContainer.style.display = 'none';
      scaleInput.removeAttribute('required');
      scaleInput.value = ''; // Limpa o campo se mudar de ideia
    }
  }

  // Executa ao carregar a página (caso venha preenchido do banco em uma edição)
  document.addEventListener('DOMContentLoaded', function() {
    toggleScaleDate();
  });
</script>
@endsection