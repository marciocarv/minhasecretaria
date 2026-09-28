@extends('layouts.site')

@section('content')

  @if(session('success'))
  <div id="notification" class="notification green mb-5">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
      <div>
        <span class="icon"><i class="fa-solid fa-check"></i></span>
        <b>{{ session('success') }}</b>
      </div>
      <button type="button" class="button small textual --jb-notification-dismiss" onclick="hide()">Ocultar</button>
    </div>
  </div>
  @endif

  <!-- Formulário de Abertura -->
  <div class="card mb-6 shadow-sm border border-gray-200">
    <header class="card-header bg-white">
      <p class="card-header-title">
        <span class="icon"><i class="fa-solid fa-headset text-teal-700"></i></span>
        Abrir Novo Chamado
      </p>
    </header>
    <div class="card-content">
      <form method="POST" action="{{ route('help.store') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div class="field">
            <label class="label">Responsável pelo chamado</label>
            <div class="control">
              <input type="text" name="responsible" class="input w-full" required>
            </div>
          </div>
          <div class="field">
            <label class="label">Assunto</label>
            <div class="control">
              <div class="select w-full">
                <select name="subject" class="w-full" required>
                  <option value="">Selecione...</option>
                  <option value="Sige">Sige</option>
                  <option value="Sim palmas">Sim palmas</option>
                  <option value="Email institucional">Email institucional</option>
                  <option value="Censo escolar">Censo escolar</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="field mb-4">
          <label class="label">Relato do Problema</label>
          <div class="control">
            <textarea name="report" class="textarea w-full" rows="2" required></textarea>
          </div>
        </div>
        <button type="submit" class="button bg-teal-900 text-white font-bold hover:bg-teal-700">
          Registrar Chamado
        </button>
      </form>
    </div>
  </div>

  <h2 class="text-xl font-bold text-gray-700 mb-4"><i class="fa-solid fa-list-check"></i> Acompanhamento de Chamados</h2>

  <!-- Grid de Chamados em Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($tickets as $ticket)
      
      @php
          // Lógica de Cores por Status
          $bgColor = 'bg-white';
          $borderColor = 'border-gray-200';
          $iconColor = 'text-gray-500';

          if($ticket->status == 'Solicitado') {
              $bgColor = 'bg-yellow-50';
              $borderColor = 'border-yellow-400';
              $iconColor = 'text-yellow-600';
          } elseif($ticket->status == 'Atendido') {
              $bgColor = 'bg-blue-50';
              $borderColor = 'border-blue-400';
              $iconColor = 'text-blue-600';
          } elseif($ticket->status == 'Finalizado') {
              $bgColor = 'bg-green-50 opacity-80';
              $borderColor = 'border-green-500';
              $iconColor = 'text-green-600';
          }
      @endphp

      <div class="card flex flex-col h-full {{ $bgColor }} border-t-4 {{ $borderColor }} shadow-md hover:shadow-lg transition-shadow duration-200">
        <div class="card-content flex-grow">
          
          <div class="flex justify-between items-start mb-3">
            <div>
              <h3 class="font-bold text-lg text-gray-800">{{ $ticket->subject }}</h3>
              <p class="text-xs text-gray-500"><i class="fa-regular fa-user mr-1"></i> {{ $ticket->responsible }}</p>
            </div>
            <span class="font-semibold text-sm {{ $iconColor }} bg-white px-2 py-1 rounded shadow-sm border border-gray-100">
              {{ $ticket->status }}
            </span>
          </div>

          <div class="text-sm text-gray-700 bg-white bg-opacity-60 p-3 rounded border border-gray-200 mb-4 min-h-[60px]">
            {{ $ticket->report }}
          </div>

          <div class="text-xs space-y-1">
            <div class="text-gray-600"><b>Solicitado:</b> {{ $ticket->created_at->format('d/m/Y H:i') }}</div>
            @if($ticket->attended_at)
              <div class="text-blue-600"><b>Atendido:</b> {{ $ticket->attended_at->format('d/m/Y H:i') }}</div>
            @endif
            @if($ticket->finished_at)
              <div class="text-green-600"><b>Finalizado:</b> {{ $ticket->finished_at->format('d/m/Y H:i') }}</div>
            @endif
          </div>
        </div>

        <!-- Rodapé do Card com Ações -->
        <footer class="card-footer bg-white border-t border-gray-200 flex flex-col space-y-2 sm:space-y-0 sm:flex-row justify-between items-center p-3">
          
          <form method="POST" action="{{ route('help.updateStatus', $ticket->id) }}" class="w-full sm:w-auto">
            @csrf
            <div class="select is-small w-full">
              <select name="status" onchange="this.form.submit()" class="w-full font-bold {{ $iconColor }}">
                <option value="Solicitado" {{ $ticket->status == 'Solicitado' ? 'selected' : '' }}>Mudar p/ Solicitado</option>
                <option value="Atendido" {{ $ticket->status == 'Atendido' ? 'selected' : '' }}>Mudar p/ Atendido</option>
                <option value="Finalizado" {{ $ticket->status == 'Finalizado' ? 'selected' : '' }}>Mudar p/ Finalizado</option>
              </select>
            </div>
          </form>

          <div class="flex space-x-2 w-full sm:w-auto justify-end mt-2 sm:mt-0">
            <a href="{{ route('help.edit', $ticket->id) }}" class="button small blue" title="Editar">
              <span class="icon"><i class="fa-solid fa-pen"></i></span>
            </a>
            
            <form method="POST" action="{{ route('help.destroy', $ticket->id) }}" onsubmit="return confirm('Tem certeza que deseja excluir este chamado?');">
              @csrf
              <button type="submit" class="button small red" title="Excluir">
                <span class="icon"><i class="fa-solid fa-trash"></i></span>
              </button>
            </form>
          </div>

        </footer>
      </div>
    @empty
      <div class="col-span-full bg-white p-6 rounded shadow text-center text-gray-500">
        Nenhum chamado registrado no momento.
      </div>
    @endforelse
  </div>

@endsection

@section('script')
<script>
  function hide() {
      const notification = document.getElementById('notification');
      if(notification) {
          notification.style.display = 'none';
      }
  }
</script>
@endsection