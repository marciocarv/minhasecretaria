@extends('layouts.site')

@section('content')

<section class="is-hero-bar mb-3">
  <div class="flex flex-col items-center justify-between space-y-6 md:flex-row md:space-y-0">
    <h1 class="title text-2xl font-bold text-gray-800">
      {{$title}}
    </h1>
  </div>
</section>

<div class="return mb-6">
  <a href="{{route('employee')}}" class="text-gray-500 font-bold hover:text-blue-800 transition-colors"> 
      <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
  </a>
</div>

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

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
      
      <div class="lg:col-span-3">
          <div class="bg-white rounded-xl shadow-sm p-6 text-center border-t-4 border-blue-600">
              <div class="w-24 h-24 mx-auto rounded-full bg-gray-100 flex items-center justify-center text-gray-400 text-4xl mb-4 border-2 border-gray-200 shadow-inner">
                  <i class="fa-solid fa-user"></i>
              </div>
              <h2 class="text-lg font-bold text-gray-800 mb-1">{{$employment_bond->employee->name}}</h2>
              <p class="text-sm text-blue-600 font-semibold mb-3">{{$employment_bond->post}}</p>
              
              <div class="border-t border-gray-100 pt-4 mt-2 text-left space-y-2">
                  <div class="flex justify-between text-sm">
                      <span class="text-gray-500">Matrícula:</span>
                      <span class="font-medium text-gray-800">{{$employment_bond->registration === '0' ? 'Não informada' : $employment_bond->registration}}</span>
                  </div>
                  <div class="flex justify-between text-sm">
                      <span class="text-gray-500">Vínculo:</span>
                      <span class="font-medium text-gray-800">{{$employment_bond->bond}}</span>
                  </div>
                  <div class="flex justify-between text-sm">
                      <span class="text-gray-500">Lotação:</span>
                      <span class="font-medium text-gray-800">{{$employment_bond->lotation->format('d/m/Y')}}</span>
                  </div>
              </div>
          </div>
      </div>

      <div class="lg:col-span-9 space-y-6">
          
          <div class="bg-white rounded-xl shadow-sm p-6">
              <h3 class="text-md font-bold text-gray-700 border-b pb-2 mb-4">Ações do Servidor</h3>
              
              <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                  <a href="{{route('functionalSheet', ['id'=>$employment_bond->id])}}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-gray-100 bg-gray-50 hover:bg-green-50 hover:border-green-300 transition-all group" target="_blank">
                      <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center text-lg mb-2 group-hover:scale-110 transition-transform">
                          <i class="fa-solid fa-file-lines"></i>
                      </div>
                      <span class="text-xs text-center font-semibold text-gray-600 group-hover:text-green-700">Ficha Funcional</span>
                  </a>

                  <a href="{{route('listActivityTime', ['id'=>$employment_bond->id])}}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-gray-100 bg-gray-50 hover:bg-blue-50 hover:border-blue-300 transition-all group">
                      <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-900 flex items-center justify-center text-lg mb-2 group-hover:scale-110 transition-transform">
                          <i class="fa-solid fa-clock"></i>
                      </div>
                      <span class="text-xs text-center font-semibold text-gray-600 group-hover:text-blue-900">Hora Ativ. / Folga</span>
                  </a>

                  <a href="{{route('leaves.index', ['id'=>$employment_bond->id])}}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-gray-100 bg-gray-50 hover:bg-purple-50 hover:border-purple-300 transition-all group">
                      <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center text-lg mb-2 group-hover:scale-110 transition-transform">
                          <i class="fa-solid fa-notes-medical"></i>
                      </div>
                      <span class="text-xs text-center font-semibold text-gray-600 group-hover:text-purple-700">Afastamento</span>
                  </a>

                  <a href="{{route('setChangeRole', ['id'=>$employment_bond->id])}}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-gray-100 bg-gray-50 hover:bg-gray-100 hover:border-gray-400 transition-all group">
                      <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-700 flex items-center justify-center text-lg mb-2 group-hover:scale-110 transition-transform">
                          <i class="fa-solid fa-users-gear"></i>
                      </div>
                      <span class="text-xs text-center font-semibold text-gray-600 group-hover:text-gray-900">Alterar Função</span>
                  </a>

                  <a href="{{route('setUpdateEmployee', ['id'=>$employment_bond->id])}}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-gray-100 bg-gray-50 hover:bg-blue-50 hover:border-blue-300 transition-all group">
                      <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-lg mb-2 group-hover:scale-110 transition-transform">
                          <i class="fa-solid fa-user-pen"></i>
                      </div>
                      <span class="text-xs text-center font-semibold text-gray-600 group-hover:text-blue-700">Editar Perfil</span>
                  </a>

                  <a href="{{route('closure_bond', ['id'=>$employment_bond->id])}}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-gray-100 bg-gray-50 hover:bg-red-50 hover:border-red-300 transition-all group">
                      <div class="w-10 h-10 rounded-full bg-red-100 text-red-700 flex items-center justify-center text-lg mb-2 group-hover:scale-110 transition-transform">
                          <i class="fa-solid fa-calendar-xmark"></i>
                      </div>
                      <span class="text-xs text-center font-semibold text-gray-600 group-hover:text-red-700">Encerrar Ativ.</span>
                  </a>
              </div>
          </div>

          <div class="bg-white rounded-xl shadow-sm overflow-hidden">
              <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                  <h3 class="text-md font-bold text-gray-700">Dados Cadastrais</h3>
                  <span class="icon text-gray-400 hover:text-blue-500 cursor-pointer" title="Atualizar"><i class="mdi mdi-reload text-xl"></i></span>
              </div>
              
              <div class="p-6 space-y-8">
                  
                  <div>
                      <h4 class="text-sm uppercase tracking-wider text-gray-400 font-bold mb-3">Informações Pessoais</h4>
                      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                          <div><p class="text-xs text-gray-500">Data de Nascimento</p><p class="text-sm font-medium">{{$employment_bond->employee->date_birth->format('d/m/Y')}}</p></div>
                          <div><p class="text-xs text-gray-500">CPF</p><p class="text-sm font-medium">{{$employment_bond->employee->cpf}}</p></div>
                          <div><p class="text-xs text-gray-500">RG</p><p class="text-sm font-medium">{{$employment_bond->employee->rg}}</p></div>
                          <div><p class="text-xs text-gray-500">Estado Civil</p><p class="text-sm font-medium">{{$employment_bond->employee->marital_status}}</p></div>
                          <div class="md:col-span-2"><p class="text-xs text-gray-500">Filiação</p><p class="text-sm font-medium">{{$employment_bond->employee->father}} e {{$employment_bond->employee->mother}}</p></div>
                          <div><p class="text-xs text-gray-500">Naturalidade</p><p class="text-sm font-medium">{{$employment_bond->employee->naturalness}}</p></div>
                          <div><p class="text-xs text-gray-500">Cor</p><p class="text-sm font-medium">{{$employment_bond->employee->color}}</p></div>
                      </div>
                  </div>

                  <hr class="border-gray-100">

                  <div>
                      <h4 class="text-sm uppercase tracking-wider text-gray-400 font-bold mb-3">Dados Funcionais</h4>
                      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                          <div><p class="text-xs text-gray-500">Função</p><p class="text-sm font-medium">{{$employment_bond->role}}</p></div>
                          <div><p class="text-xs text-gray-500">Carga Horária</p><p class="text-sm font-medium">{{$employment_bond->workload}}</p></div>
                          <div><p class="text-xs text-gray-500">Data de Admissão</p><p class="text-sm font-medium">{{$employment_bond->employee->admission == null ? 'Não informada' : $employment_bond->employee->admission->format('d/m/Y')}}</p></div>
                          <div><p class="text-xs text-gray-500">ID Censo</p><p class="text-sm font-medium">{{$employment_bond->employee->id_censo}}</p></div>
                      </div>
                  </div>

                  <hr class="border-gray-100">

                  <div>
                      <h4 class="text-sm uppercase tracking-wider text-gray-400 font-bold mb-3">Contato e Endereço</h4>
                      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                          <div><p class="text-xs text-gray-500">Telefone</p><p class="text-sm font-medium">{{$employment_bond->employee->phone}}</p></div>
                          <div><p class="text-xs text-gray-500">CEP</p><p class="text-sm font-medium">{{$employment_bond->employee->cep}}</p></div>
                          <div class="md:col-span-2"><p class="text-xs text-gray-500">Endereço</p><p class="text-sm font-medium">{{$employment_bond->employee->address}}</p></div>
                      </div>
                  </div>

                  <hr class="border-gray-100">

                  <div>
                      <h4 class="text-sm uppercase tracking-wider text-gray-400 font-bold mb-3">Formação Acadêmica</h4>
                      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                          <div><p class="text-xs text-gray-500">Escolaridade</p><p class="text-sm font-medium">{{$employment_bond->employee->schooling}}</p></div>
                          <div><p class="text-xs text-gray-500">Curso</p><p class="text-sm font-medium">{{$employment_bond->employee->course_name}}</p></div>
                          <div><p class="text-xs text-gray-500">Situação</p><p class="text-sm font-medium">{{$employment_bond->employee->course_status}}</p></div>
                          <div><p class="text-xs text-gray-500">Ano de Conclusão</p><p class="text-sm font-medium">{{$employment_bond->employee->conclusion}}</p></div>
                      </div>
                  </div>

                  <hr class="border-gray-100">

                  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                      <div>
                          <h4 class="text-sm uppercase tracking-wider text-gray-400 font-bold mb-3">Dados Bancários</h4>
                          <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                              <div><p class="text-xs text-gray-500">Banco</p><p class="text-sm font-medium">{{$employment_bond->employee->bank_name}}</p></div>
                              <div><p class="text-xs text-gray-500">Agência</p><p class="text-sm font-medium">{{$employment_bond->employee->bank_agency}}</p></div>
                              <div class="col-span-2"><p class="text-xs text-gray-500">Nº da Conta</p><p class="text-sm font-medium">{{$employment_bond->employee->bank_number}}</p></div>
                          </div>
                      </div>
                      
                      <div>
                          <h4 class="text-sm uppercase tracking-wider text-gray-400 font-bold mb-3">Certidão</h4>
                          <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                              <div><p class="text-xs text-gray-500">Tipo</p><p class="text-sm font-medium">{{$employment_bond->employee->certificate_type}}</p></div>
                              <div><p class="text-xs text-gray-500">Termo</p><p class="text-sm font-medium">{{$employment_bond->employee->certificate_term}}</p></div>
                              <div><p class="text-xs text-gray-500">Livro</p><p class="text-sm font-medium">{{$employment_bond->employee->certificate_book}}</p></div>
                              <div><p class="text-xs text-gray-500">Folha</p><p class="text-sm font-medium">{{$employment_bond->employee->certificate_sheet}}</p></div>
                          </div>
                      </div>
                  </div>

              </div>
          </div>

          <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-6">
              <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                  <h3 class="text-md font-bold text-gray-700">Histórico de Vínculos</h3>
              </div>
              <div class="p-6">
                  <div class="text-center text-gray-400 py-4">
                      <i class="fa-solid fa-clock-rotate-left text-3xl mb-2"></i>
                      <p class="text-sm">Nenhum histórico encontrado ou tabela em construção.</p>
                  </div>
              </div>
          </div>

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