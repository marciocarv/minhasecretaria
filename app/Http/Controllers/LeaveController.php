<?php

namespace App\Http\Controllers;

use App\Models\Employment_bond;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Exibe a tela de gerenciamento de afastamentos para um vínculo específico.
     */
    public function index($employment_bond_id)
    {
        $title = "Afastamentos";
        $employment_bond = Employment_bond::with(['employee', 'leaves'])->findOrFail($employment_bond_id);

        return view('leaves.index', compact('employment_bond', 'title'));
    }

    /**
     * Salva um novo afastamento.
     */
    public function store(Request $request, $employment_bond_id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:255',
        ],[
            // Array de traduções personalizadas
            'end_date.after_or_equal' => 'A data final não pode ser anterior à data inicial.',
            'end_date.after'          => 'A data final deve ser posterior à data inicial.',
            'end_date.required'       => 'O campo de data final é obrigatório.',
            'start_date.required'     => 'O campo de data inicial é obrigatório.',
            'start_date.date'         => 'Informe uma data inicial válida.',
            'end_date.date'           => 'Informe uma data final válida.'
        ]);

        Leave::create([
            'employment_bond_id' => $employment_bond_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return redirect()->route('leaves.index', $employment_bond_id)
                         ->with('success', 'Afastamento cadastrado com sucesso!');
    }

    /**
     * Remove um afastamento cadastrado.
     */
    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);
        $bondId = $leave->employment_bond_id;
        
        $leave->delete();

        return redirect()->route('leaves.index', $bondId)
                         ->with('success', 'Afastamento removido com sucesso!');
    }
}