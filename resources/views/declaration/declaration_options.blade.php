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
    <form action="{{route('showDeclaration')}}" method="post" class="w-96" target="_blank">
      @csrf
        <div class="field">
          <label class="label">Situação do Servidor</label>
          <div class="control">
            <div class="select">
              <select name="status" id="status">
                <option value="-">Escolha uma opção</option>
                <option value="ATIVO">Ativo</option>
                <option value="INATIVO">Inativo</option>
              </select>
            </div>
          </div>
        </div>
        <div class="field">
          <label class="label">Servidor</label>
          <div class="control">
            <div class="select" id="select_area">
              <select name="employee" id="employee_select">
                <option value="-" id="chose" selected>Escolha a situação do servidor</option>
              </select>
            </div>
          </div>
        </div>
        <div class="field">
          <label class="label">Tipo de Declaração</label>
          <div class="control">
            <div class="select">
              <select name="employee" id="employee_select">
                <option value="trabalho">TRABALHO</option>
                <option value="vinculo">VÍNCULO</option>
                <option value="inicio">INÍCIO DE ATIVIDADE</option>
                <option value="encerramento">ENCERRAMENTO DE ATIVIDADE</option>
              </select>
            </div>
          </div>
        </div>
        <div class="field">
          <label class="label">Data</label>
          <div class="field-body">
            <div class="field">
              <div class="control icons-left">
                <input 
                  class="input" 
                  type="date" 
                  name="date" 
                  placeholder=""
                  required
                  >
                <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
              </div>
            </div>
          </div>
        </div>
      <div class="field grouped">
        <div class="control">
          <button type="submit" class="button green">
            Gerar
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
<script src="{{asset('js/vanilla-masker.min.js')}}" charset="utf-8"></script>
<script charset="utf-8" type="text/javascript">

  const status = document.querySelector('#status');
  let employee_select = document.querySelector('#employee_select');
  const select_area = document.querySelector('#select_area');

  status.addEventListener('change', ()=>{
      var value = status.options[status.selectedIndex].value;
      get_employee(value);
    });

  function get_employee(status){
    if(status == '-'){
      return 0;
    }
    let url = "http://secretario/minhasecretaria/public/api/getEmployeeForType/"+status;
    fetch(url)
    .then((response)=>{
      return response.json();
    })
    .then((data)=>{
      employee_select.parentNode.removeChild(employee_select);
      employee_select = document.createElement('select');
      employee_select.setAttribute('class', 'select');
      employee_select.setAttribute('id', 'employee_select');
      select_area.appendChild(employee_select);

      let option_title = document.createElement('option');
      option_title.setAttribute('value', '-');
      option_title.innerText = "Escolha uma Opção";
      employee_select.appendChild(option_title);

      data.map((employee)=>{
        setSelect(employee);
      })
    })
    .catch((err)=>{
      console.log(err);
    })
  }

  function setSelect(employee){
    console.log(employee);
    let option = document.createElement('option');
    option.setAttribute('value', employee.id);
    option.innerText = employee.employee.name;
    employee_select.appendChild(option);
  }


</script>

@endsection