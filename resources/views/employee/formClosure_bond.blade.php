@extends('layouts.site')

@section('content')

<div class="return">
  <a href="{{route('manageEmployee', ['id'=>$employment_bond->id])}}" class="text-gray-500 font-bold m-2 hover:text-blue-800"> <i class="fa-solid fa-arrow-left"></i> Voltar</a>
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
    <form method="POST" action="{{route($route)}}" class="w-96">
      @csrf
      <input type="hidden" value="{{$employment_bond->id}}" name="employment_bond_id">

      <div class="field">
        <label class="label">Data de Encerramento</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="date" 
                name="activity_end" 
                placeholder=""
                required
                @if($employment_bond->activity_end)
                value="{{$employee->activity_end->format('Y-m-d')}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Arquivamento</label>
        <div class="control">
          <div class="select">
            <select name="archiving">
              <option value="y">Arquivo Inativo</option>
              <option value="n">Apenas encerrar</option>
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Caixa de destino</label>
        <div class="control">
          <div class="select">
            <select name="box_id">
              <option value="">Escolha uma caixa</option>
              @foreach($boxes as $box)
              <option value="{{$box->id}}">Caixa {{$box->description}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Ordem</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="number" 
                name="order" 
                placeholder="Ordem"
                >
              <span class="icon left"><i class="fa-solid fa-list"></i></span>
            </div>
          </div>
        </div>
      </div>

      
      <div class="field grouped">
        <div class="control">
          <button type="submit" class="button green">
            Salvar
          </button>
        </div>
        <div class="control">
        </div>
      </div>

    </form>

  </div>
</div>

@endsection

@section('script')
  

@endsection