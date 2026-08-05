@extends('layouts.site')

@section('content')

<div class="return mb-4">
  <a href="{{route('manageEmployee', ['id'=>$employment_bond->id])}}" class="text-gray-500 font-bold m-2 hover:text-blue-800 transition-colors"> 
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

  <div class="w-full max-w-xl mx-auto">
    <div class="bg-white p-6 rounded-lg shadow">
      <form method="POST" action="{{route($route)}}">
        @csrf
        <input type="hidden" value="{{$employment_bond->id}}" name="employment_bond_id">

        <div class="field mb-4">
          <label class="label font-semibold text-gray-700">Data de Encerramento</label>
          <div class="control icons-left">
            <input 
              class="input w-full border rounded p-2" 
              type="date" 
              name="activity_end" 
              required
              @if($employment_bond->activity_end)
              value="{{$employment_bond->activity_end->format('Y-m-d')}}"
              @endif
              >
            <span class="icon left"><i class="fa-solid fa-calendar-days"></i></span>
          </div>
        </div>

        <div class="field mb-4">
          <label class="label font-semibold text-gray-700">Arquivamento</label>
          <div class="control">
            <div class="select w-full">
              <select name="archiving" id="archiving" class="w-full border rounded p-2">
                <option value="y">Arquivo Inativo</option>
                <option value="n">Apenas encerrar</option>
              </select>
            </div>
          </div>
        </div>

        <div class="field mb-4" id="box">
          <label class="label font-semibold text-gray-700">Caixa de destino</label>
          <div class="control">
            <div class="select w-full">
              <select name="box_id" id="box_id" class="w-full border rounded p-2">
                <option value="-">Escolha uma caixa</option>
                @foreach($boxes as $box)
                <option value="{{$box->id}}">Caixa {{$box->description}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="field mb-4" id="order-field">
          <label class="label font-semibold text-gray-700">Ordem</label>
          <div class="control icons-left">
            <input 
              class="input w-full border rounded p-2" 
              type="number" 
              name="order"
              id="order"
              placeholder="Ordem"
              >
            <span class="icon left"><i class="fa-solid fa-list"></i></span>
          </div>
        </div>

        <div class="field grouped mt-6 flex justify-end">
          <div class="control">
            <button type="submit" class="button green px-6">
              <span class="icon left"><i class="fa-solid fa-floppy-disk mr-1"></i></span> Salvar
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

  const archiving = document.querySelector('#archiving');
  const box = document.querySelector('#box_id');
  const boxField = document.querySelector('#box');
  const order = document.querySelector('#order');
  const orderField = document.querySelector('#order-field');

  archiving.addEventListener("change", ()=>{
    if(archiving.value === "y"){
      boxField.classList.remove('hidden');
      orderField.classList.remove('hidden');
    }else{
      boxField.classList.add('hidden');
      orderField.classList.add('hidden');
    }
  });

  box.addEventListener("change", ()=>{
    get_order(box.value);
  });

  function get_order(id_box){
    if(id_box == '-'){
      return 0;
    }
    let url = "http://secretario/minhasecretaria/public/api/getOrderEmployee/"+id_box;
    fetch(url)
    .then((response)=>{
      return response.json();
    })
    .then((data)=>{
     order.value = data;
    })
    .catch((err)=>{
      console.log(err);
    })
  }
</script>
@endsection