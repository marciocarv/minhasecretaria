<?php

namespace App\Http\Controllers;

use App\Models\Employment_bond;
use App\Models\MedicalLeave;
use Illuminate\Http\Request;

class MedicalLeaveController extends Controller
{
    /**
     * Exibe a tela de gerenciamento de licenças médicas para um vínculo específico.
     */
    public function index($employment_bond_id)
    {
        $title = "Licenças Médicas";
        $employment_bond = Employment_bond::with(['employee', 'medicalLeaves'])->findOrFail($employment_bond_id);

        return view('medical_leaves.index', compact('employment_bond', 'title'));
    }

    /**
     * Salva uma nova licença médica.
     */
    public function store(Request $request, $employment_bond_id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:255',
        ]);

        MedicalLeave::create([
            'employment_bond_id' => $employment_bond_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
        ]);

        return redirect()->route('medical.leaves.index', $employment_bond_id)
                         ->with('success', 'Licença médica cadastrada com sucesso!');
    }

    /**
     * Remove uma licença médica cadastrada.
     */
    public function destroy($id)
    {
        $medicalLeave = MedicalLeave::findOrFail($id);
        $bondId = $medicalLeave->employment_bond_id;
        
        $medicalLeave->delete();

        return redirect()->route('medical.leaves.index', $bondId)
                         ->with('success', 'Licença médica removida com sucesso!');
    }
}