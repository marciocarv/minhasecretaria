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
    <form action="{{route('generateList')}}" method="post">
      @csrf
        <div class="field">
            <label class="label">Título da Lista</label>
            <div class="field-body">
                <div class="field">
                    <div class="control icons-left">
                        <input 
                        class="input"
                        type="text"
                        name="title"
                        id="uppercase_1"
                        placeholder="Título da Lista"
                        required
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="field">
          <label class="label">Opções</label>
          <div class="field-body">
              <div class="field">
                <div class="control icons-left">
                  <table>
                    <tr>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="name"
                        checked
                        > Nome
                      </td>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="cpf"
                        > CPF
                      </td>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="lotation"
                        > Data de Lotação
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="registration"
                        > Matrícula
                      </td>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="post"
                        > Cargo
                      </td>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="role"
                        > Função
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="phone"
                        > Telefone
                      </td>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="workload"
                        > Carga Horária
                      </td>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="date_birth"
                        > Data de Nascimento

                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="id_censo"
                        > Id censo.
                      </td>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="schooling"
                        > Escolaridade
                      </td>
                      <td>
                        <input 
                        type="checkbox"
                        name="options[]"
                        value="signature"
                        > Assinatura
                      </td>
                    </tr>
                  </table>
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