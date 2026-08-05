@extends('layouts.site')

@section('content')

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

  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
    <a href="{{route('setStoreEmployee')}}" class="flex flex-col items-center justify-center p-4 rounded-xl bg-teal-800 text-white shadow-md hover:bg-teal-700 hover:shadow-lg transition-all group">
      <i class="fa-solid fa-square-plus text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
      <span class="text-sm font-semibold text-center">Cadastrar Servidor</span>
    </a>
    
    <a href="{{route('listOptions')}}" class="flex flex-col items-center justify-center p-4 rounded-xl bg-teal-800 text-white shadow-md hover:bg-teal-700 hover:shadow-lg transition-all group">
      <i class="fa-solid fa-list text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
      <span class="text-sm font-semibold text-center">Listas de Servidores</span>
    </a>
    
    <a href="{{route('declaration_options')}}" class="flex flex-col items-center justify-center p-4 rounded-xl bg-teal-800 text-white shadow-md hover:bg-teal-700 hover:shadow-lg transition-all group">
      <i class="fa-solid fa-file-contract text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
      <span class="text-sm font-semibold text-center">Declarações</span>
    </a>
    
    <a href="{{route('setStoreEmployee')}}" class="flex flex-col items-center justify-center p-4 rounded-xl bg-teal-800 text-white shadow-md hover:bg-teal-700 hover:shadow-lg transition-all group">
      <i class="fa-solid fa-clock text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
      <span class="text-sm font-semibold text-center">Banco de Horas</span>
    </a>
    
    <a href="{{route('inactiveEmployees')}}" class="flex flex-col items-center justify-center p-4 rounded-xl bg-teal-800 text-white shadow-md hover:bg-teal-700 hover:shadow-lg transition-all group">
      <i class="fa-solid fa-arrows-down-to-people text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
      <span class="text-sm font-semibold text-center">Servidores Inativos</span>
    </a>
  </div>

  <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <header class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
      <p class="font-bold text-gray-700 flex items-center">
        <span class="icon text-teal-700 mr-2"><i class="fa-solid fa-users"></i></span>
        Servidores Ativos
      </p>
      <a href="#" class="text-gray-400 hover:text-teal-600 transition-colors" title="Atualizar">
        <i class="mdi mdi-reload text-xl"></i>
      </a>
    </header>
    
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-gray-600">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
          <tr>
            <th class="px-6 py-3 font-semibold">Nº</th>
            <th class="px-6 py-3 font-semibold">Nome</th>
            <th class="px-6 py-3 font-semibold">Nascimento</th>
            <th class="px-6 py-3 font-semibold">CPF</th>
            <th class="px-6 py-3 font-semibold">Matrícula</th>
            <th class="px-6 py-3 font-semibold">Cargo</th>
            <th class="px-6 py-3 font-semibold">Função</th>
            <th class="px-6 py-3 font-semibold">Lotação</th>
            <th class="px-6 py-3 font-semibold text-center">Ações</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @foreach($employees as $employee)
          <tr class="hover:bg-gray-50 transition-colors uppercase text-xs">
            <td class="px-6 py-4" data-label="Ordem">{{$loop->index + 1}}</td>
            
            <td class="px-6 py-4 font-bold" data-label="Nome">
              <a href="{{route('manageEmployee', ['id'=>$employee->id])}}" class="text-blue-600 hover:text-blue-800 hover:underline transition-all">
                {{$employee->name}}
              </a>
            </td>
            
            <td class="px-6 py-4" data-label="Nascimento">{{date('d/m/Y', strtotime($employee->date_birth))}}</td>
            <td class="px-6 py-4" data-label="CPF">{{$employee->cpf}}</td>
            <td class="px-6 py-4 font-semibold text-gray-700" data-label="Matrícula">{{$employee->registration === '0' ? '-' : $employee->registration}}</td>
            <td class="px-6 py-4" data-label="Cargo">{{$employee->post}}</td>
            <td class="px-6 py-4" data-label="Função">{{$employee->role}}</td>
            <td class="px-6 py-4" data-label="Lotação">{{date('d/m/Y', strtotime($employee->lotation))}}</td>
            
            <td class="px-6 py-4 text-center">
              <div class="flex items-center justify-center space-x-2">
                <a title="Editar" 
                  href="{{route('setUpdateEmployee', ['id'=>$employee->id])}}" 
                  class="w-8 h-8 flex items-center justify-center rounded bg-green-100 text-green-700 hover:bg-green-600 hover:text-white transition-colors" 
                  type="button">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a title="Excluir" 
                  href="{{route('deleteEmployee', ['id'=>$employee->id])}}" onsubmit="return confirm('Deseja realmente excluir este registro?');"
                  class="w-8 h-8 flex items-center justify-center rounded bg-red-100 text-red-700 hover:bg-red-600 hover:text-white transition-colors" 
                  type="button">
                  <i class="fa-solid fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
          @endforeach
          
          @if($employees->isEmpty())
          <tr>
            <td colspan="10" class="px-6 py-8 text-center text-gray-500">
              <div class="flex flex-col items-center justify-center">
                <i class="fa-solid fa-folder-open text-3xl mb-2 text-gray-300"></i>
                <span>Nenhum servidor cadastrado ou encontrado.</span>
              </div>
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
  function hide(){
    let notification = document.querySelector('#notification');
    if(notification) {
      notification.classList.add('hidden');
    }
  }
</script>
@endsection