@extends('layouts.site')

@section('content')
  <div class="card mb-6 mx-auto max-w-3xl shadow-sm border border-gray-200">
    <header class="card-header bg-white">
      <p class="card-header-title">
        <span class="icon"><i class="fa-solid fa-pen text-blue-600"></i></span>
        Editar Chamado
      </p>
    </header>
    <div class="card-content">
      <form method="POST" action="{{ route('help.update', $ticket->id) }}">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div class="field">
            <label class="label">Responsável pelo chamado</label>
            <div class="control">
              <input type="text" name="responsible" class="input w-full" value="{{ $ticket->responsible }}" required>
            </div>
          </div>
          
          <div class="field">
            <label class="label">Assunto</label>
            <div class="control">
              <div class="select w-full">
                <select name="subject" class="w-full" required>
                  <option value="Sige" {{ $ticket->subject == 'Sige' ? 'selected' : '' }}>Sige</option>
                  <option value="Sim palmas" {{ $ticket->subject == 'Sim palmas' ? 'selected' : '' }}>Sim palmas</option>
                  <option value="Email institucional" {{ $ticket->subject == 'Email institucional' ? 'selected' : '' }}>Email institucional</option>
                  <option value="Censo escolar" {{ $ticket->subject == 'Censo escolar' ? 'selected' : '' }}>Censo escolar</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        
        <div class="field mb-6">
          <label class="label">Relato do Problema</label>
          <div class="control">
            <textarea name="report" class="textarea w-full" rows="4" required>{{ $ticket->report }}</textarea>
          </div>
        </div>
        
        <div class="flex justify-between items-center">
          <a href="{{ route('help.index') }}" class="button bg-gray-200 hover:bg-gray-300 text-gray-700">
            <span class="icon"><i class="fa-solid fa-arrow-left"></i></span>
            <span>Voltar</span>
          </a>
          <button type="submit" class="button bg-blue-600 text-white font-bold hover:bg-blue-500">
            <span class="icon"><i class="fa-solid fa-save"></i></span>
            <span>Salvar Alterações</span>
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection