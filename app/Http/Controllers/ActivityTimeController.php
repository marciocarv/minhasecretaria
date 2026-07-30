<?php

namespace App\Http\Controllers;

use App\Models\ActivityTime;
use App\Models\Employment_bond;
use Illuminate\Http\Request;

class ActivityTimeController extends Controller
{
    // Método único que carrega a página com a Lista e o Formulário
    public function list($id){
        // Carrega o vínculo já com os horários e dados do funcionário para evitar N+1 queries
        $employment_bond = Employment_bond::with(['activityTimes', 'employee'])->findOrFail($id);

        $title = "Gerenciar Hora-Atividade e Folgas";
        $route = "storeActivityTime";

        return view('activityTime.list', [
            'title' => $title, 
            'employment_bond' => $employment_bond,
            'route' => $route
        ]);
    }

    // Método para salvar um NOVO registro (Agora é 1:N, então apenas adicionamos)
    public function store(Request $request){
        $request->validate([
            'description' => 'required',
            'type' => 'required',
            'shift' => 'required',
            'employment_bond_id' => 'required'
        ]);

        $activityTime = new ActivityTime;
        $activityTime->description = $request->description; // Ex: 'Monday'
        $activityTime->type = $request->type;             // Ex: 'activity_time' ou 'fixed_off'
        $activityTime->shift = $request->shift;           // Ex: 'matutino' ou 'vespertino'
        $activityTime->employment_bond_id = $request->employment_bond_id;

        if(!$activityTime->save()){
            return redirect()->route('listActivityTime', ['id'=>$request->employment_bond_id])
                ->with('error', 'Não foi possível salvar o registro!');
        }

        return redirect()->route('listActivityTime', ['id'=>$request->employment_bond_id])
            ->with('success', 'Registro salvo com sucesso!');
    }

    // NOVO: Método para excluir um registro caso o usuário erre
    public function destroy($id){
        $activityTime = ActivityTime::findOrFail($id);
        $bond_id = $activityTime->employment_bond_id;
        
        $activityTime->delete();

        return redirect()->route('listActivityTime', ['id'=>$bond_id])
            ->with('success', 'Registro removido com sucesso!');
    }
}