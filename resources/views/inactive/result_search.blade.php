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

  @if(session('stored'))
  <div id="notification" class="notification blue">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
      <div>
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>{{session('stored')}}</b>
      </div>
      <button type="button" class="button small textual --jb-notification-dismiss" onclick="hide()">Ocultar</button>
    </div>
  </div>
  @endif

  <div class="">
    <form method="GET" action="{{route('search')}}">
      <div class="field">
        <label class="label">Pesquisar</label>
        <div class="control">
          <input class="input" id="name" name="name" type="text" value="{{$name}}" placeholder="Nome do aluno, servidor etc.">
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

  <div class="card has-table mt-10">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon"><i class="fa-solid fa-box-open"></i></span>
        Resultados
      </p>
      <a href="#" class="card-header-icon">
        <span class="icon"><i class="mdi mdi-reload"></i></span>
      </a>
    </header>
    <div class="card-content">
      <table>
        <thead>
        <tr>
          <th class="checkbox-cell">
            <label class="checkbox">
              <input type="checkbox">
              <span class="check"></span>
            </label>
          </th>
          <th>Caixa</th>
          <th>Ordem</th>
          <th>Nome</th>
          <th>Data de Nascimento</th>
          <th>Mãe</th>
          <th>Período</th>
          <th>Situação</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          @foreach($search as $result)
          <tr class="uppercase">
            <td class="checkbox-cell">
              <label class="checkbox">
                <input name="id_box" value="{{$result->id}}" type="checkbox" >
                <span class="check"></span>
              </label>
            </td>
            <td data-label="Ordem" class="font-bold">{{$result->description}}</td>
            <td data-label="Ordem">{{$result->order}}</td>
            <td data-label="Nome">{{$result->name}}</td>
            <td data-label="Nome">{{date('m/d/Y', strtotime($result->date_birth))}}</td>
            <td data-label="Nome">{{$result->mother}}</td>
            <td data-label="Nome">{{$result->entry_year}} - {{$result->exit_year}} </td>
            <td data-label="Situação">
              <small class="font-bold {{$result->status == 'ARQUIVADO' ? 'text-gray-500' : 'text-blue-500'}}" title="{{$result->status}}">{{$result->status}}</small>
            </td>
            <td class="actions-cell">
              <div class="buttons right nowrap">
                <a title="Editar" 
                  href="{{route($result->type == 'Servidor' ? 'setUpdateBoxEmployee' : 'setUpdateStudent', ['id'=>$result->id])}}" 
                  class="button small green" 
                  type="button">
                  <span class="icon"><i class="fa-solid fa-pen-to-square"></i></span>
                </a>
                <a title="Excluir" 
                  href="{{route($result->type == 'Servidor' ? 'deleteEmployee' : 'deleteStudent', ['id'=>$result->id])}}" 
                  class="button small red" 
                  type="button">
                  <span class="icon"><i class="fa-solid fa-trash"></i></span>
                </a>
                <a title="Transferir" 
                  href="{{route($result->type == 'Servidor' ? 'setTransferEmployee' : 'setTransferStudent', ['id'=>$result->id])}}" 
                  class="{{$result->status == 'ARQUIVADO' ? 'button small blue' : 'button small bg-gray-400 pointer-events-none'}}" 
                  type="button">
                  <span class="icon"><i class="fa-solid fa-arrow-right-arrow-left"></i></span>
                </a>
                @if(substr_compare($result->status, "RESGATADO", 0, 8) == 0)
                <a title="Arquivar"
                  href="{{route($result->type == 'Servidor' ? 'rescueEmployee' : 'rescueStudent', ['id'=>$result->id])}}" 
                  class="button small text-white bg-teal-900" 
                  type="button">
                  <span class="icon"><i class="fa-solid fa-circle-down"></i></span>
                </a>
                @else
                <a title="Resgatar"
                  href="{{route($result->type == 'Servidor' ? 'rescueEmployee' : 'rescueStudent', ['id'=>$result->id])}}" 
                  class="{{$result->status == 'ARQUIVADO' ? 'button small text-white bg-black' : 'button small bg-gray-400 '}}" 
                  type="button">
                  <span class="icon"><i class="fa-solid fa-reply"></i></span>
                </a>
                @endif
              </div>
            </td>
          </tr>
          @endforeach
          @if($search->isEmpty())
          <tr>
            <td data-label="Sem caixas" colspan="7" class="text-center">
              Nenhum resultado para sua pesquisa
            </td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

</section>
  
          
@endsection

@section('script')

<script>
  function uppercase(ev){
    const input = ev.target;
	  input.value = input.value.toUpperCase();
  }

  function less_space(ev){
    const input = ev.target;
	  input.value = input.value.replace(/( )+/g, ' ');
    input.value = input.value.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
  }

  document.querySelector('#name').addEventListener('keyup', (ev) => {
    uppercase(ev);
  });

  document.querySelector('#name').addEventListener('blur', (ev) => {
    less_space(ev);
  });


</script>

@endsection