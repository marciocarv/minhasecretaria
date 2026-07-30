@extends('layouts.site') @section('content')
<div class="container mx-auto px-4 py-6 max-w-4xl">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Gerenciamento de Licenças Médicas</h1>
            <p class="text-gray-600">Servidor: <strong>{{ $employment_bond->employee->name ?? 'N/A' }}</strong> | Matrícula/Vínculo: <strong>{{ $employment_bond->registration }}</strong></p>
        </div>
        <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm font-bold">
            Voltar
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Adicionar Novo Período de Afastamento</h3>
        
        <form action="{{ route('medical.leaves.store', $employment_bond->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Data de Início:</label>
                    <input type="date" name="start_date" required class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Data de Término:</label>
                    <input type="date" name="end_date" required class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Motivo / Observação / CID (Opcional):</label>
                <input type="text" name="reason" placeholder="Ex: Tratamento de saúde prolongado" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded shadow">
                Salvar Licença Médica
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Histórico de Licenças Médicas Cadastradas</h3>

        @if($employment_bond->medicalLeaves->isEmpty())
            <p class="text-gray-500 italic">Nenhuma licença médica registrada para este vínculo até o momento.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600 text-sm">
                            <th class="border border-gray-200 p-3">Início</th>
                            <th class="border border-gray-200 p-3">Término</th>
                            <th class="border border-gray-200 p-3">Motivo / Descrição</th>
                            <th class="border border-gray-200 p-3 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employment_bond->medicalLeaves as $leave)
                            <tr class="hover:bg-gray-50 text-sm">
                                <td class="border border-gray-200 p-3">{{ $leave->start_date->format('d/m/Y') }}</td>
                                <td class="border border-gray-200 p-3">{{ $leave->end_date->format('d/m/Y') }}</td>
                                <td class="border border-gray-200 p-3">{{ $leave->reason ?? '-' }}</td>
                                <td class="border border-gray-200 p-3 text-center">
                                    <form action="{{ route('medical.leaves.destroy', $leave->id) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir este registro de licença médica?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs bg-red-100 hover:bg-red-200 px-3 py-1 rounded">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection