@extends('layouts.site')

@section('content')
<section class="is-title-bar mb-6">
  <div class="flex flex-col items-center justify-between space-y-6 md:flex-row md:space-y-0">
    <div class="flex items-center space-x-2 text-gray-500 font-semibold text-sm">
      <span class="hover:text-blue-600 cursor-pointer"><i class="fa-solid fa-house mr-1"></i> Início</span>
      <span><i class="fa-solid fa-chevron-right text-xs mx-1"></i></span>
      <span class="text-gray-800">Minha Secretaria</span>
    </div>
  </div>
</section>

<section class="section main-section">

  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
    <a href="{{route('inactive')}}" class="flex flex-col items-center justify-center p-6 rounded-xl bg-teal-800 text-white shadow-md hover:bg-teal-700 hover:shadow-lg transition-all group">
      <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-box-archive text-xl"></i>
      </div>
      <span class="text-sm font-bold uppercase tracking-wide text-center">Arquivo Inativo</span>
    </a>

    <a href="{{route('employee')}}" class="flex flex-col items-center justify-center p-6 rounded-xl bg-teal-800 text-white shadow-md hover:bg-teal-700 hover:shadow-lg transition-all group">
      <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-users text-xl"></i>
      </div>
      <span class="text-sm font-bold uppercase tracking-wide text-center">Servidores</span>
    </a>

    <a href="#" class="flex flex-col items-center justify-center p-6 rounded-xl bg-teal-800 text-white shadow-md hover:bg-teal-700 hover:shadow-lg transition-all group">
      <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-address-book text-xl"></i>
      </div>
      <span class="text-sm font-bold uppercase tracking-wide text-center">Livro de Ponto</span>
    </a>

    <a href="#" class="flex flex-col items-center justify-center p-6 rounded-xl bg-teal-800 text-white shadow-md hover:bg-teal-700 hover:shadow-lg transition-all group">
      <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-file-lines text-xl"></i>
      </div>
      <span class="text-sm font-bold uppercase tracking-wide text-center">Ofícios</span>
    </a>

    <a href="#" class="flex flex-col items-center justify-center p-6 rounded-xl bg-teal-800 text-white shadow-md hover:bg-teal-700 hover:shadow-lg transition-all group">
      <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-graduation-cap text-xl"></i>
      </div>
      <span class="text-sm font-bold uppercase tracking-wide text-center">Alunos</span>
    </a>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col h-full">
      <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50 rounded-t-xl">
        <h3 class="font-bold text-gray-700">Aniversariantes do Mês</h3>
        <i class="fa-solid fa-cake-candles text-green-500 text-xl"></i>
      </div>
      <div class="p-6 flex-grow overflow-y-auto max-h-64">
        <ul class="divide-y divide-gray-100">
          @foreach($employment_bonds as $employee)
            <li class="py-3 flex justify-between items-center">
              <span class="font-medium text-gray-700 text-sm"><i class="fa-solid fa-user text-gray-300 mr-2"></i> {{$employee->name}}</span>
              <span class="text-xs font-bold text-green-700 bg-green-100 px-2 py-1 rounded-full">{{$employee->date_birth->format('d/m')}}</span>
            </li>
          @endforeach
          
          @if(isset($employment_bonds) && $employment_bonds->isEmpty())
            <li class="py-4 text-center text-gray-400 text-sm">
              <i class="fa-solid fa-calendar-xmark text-2xl mb-2 block"></i>
              Nenhum aniversariante neste mês.
            </li>
          @endif
        </ul>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center items-center text-center">
      <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4">
        <i class="fa-solid fa-clipboard-user text-blue-500 text-2xl"></i>
      </div>
      <h3 class="text-gray-500 text-sm font-semibold uppercase tracking-wider mb-1">Servidores Ativos</h3>
      <h1 class="text-4xl font-bold text-gray-800">{{ $activeEmployeesCount }}</h1>
      <p class="text-xs text-gray-400 mt-2">No sistema atual</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center items-center text-center">
      <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mb-4">
        <i class="fa-solid fa-notes-medical text-red-500 text-2xl"></i>
      </div>
      <h3 class="text-gray-500 text-sm font-semibold uppercase tracking-wider mb-1">Licenças no Mês</h3>
      <h1 class="text-4xl font-bold text-gray-800">{{ $monthlyLeavesCount }}</h1>
      <p class="text-xs text-gray-400 mt-2">Afastamentos neste mês</p>
    </div>

  <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <header class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
      <p class="font-bold text-gray-700 flex items-center">
        <span class="icon text-teal-700 mr-2"><i class="fa-solid fa-bell"></i></span>
        Avisos ou Registros Recentes
      </p>
      <a href="#" class="text-gray-400 hover:text-teal-600 transition-colors" title="Atualizar">
        <i class="mdi mdi-reload text-xl"></i>
      </a>
    </header>
    
    <div class="p-8 text-center">
      <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-400 mb-4">
        <i class="fa-solid fa-table-list text-2xl"></i>
      </div>
      <h3 class="text-lg font-bold text-gray-700 mb-1">Área Pronta para Uso</h3>
      <p class="text-gray-500 text-sm max-w-md mx-auto">
        Esta tabela foi limpa e preparada. Você pode usá-la no futuro para listar as últimas alterações do sistema, servidores recém-cadastrados ou recados importantes da Secretaria.
      </p>
    </div>
  </div>

</section>
@endsection

@section('script')
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '658339141622648');
  fbq('track', 'PageView');
</script>
@endsection