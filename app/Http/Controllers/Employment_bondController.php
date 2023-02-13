<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bond_employee;
use App\Models\Box;
use App\Models\Employment_bond;

class Employment_bondController extends Controller
{
    public function closure_bond($id){
        $employment_bond = Employment_bond::findOrFail($id);
        $box = new Box;
        $boxes = $box->boxForType('Servidor');

        return view('employee.formClosure_bond', [  'employment_bond' => $employment_bond,
                                                    'title'=>'Encerramento de Atividade',
                                                    'route'=>'close_bond',
                                                    'boxes'=>$boxes
                                                 ]);
    }

    public function close_bond(Request $request){

        $bond_employee = new Bond_employee;
        $employment_bond = Employment_bond::findOrFail($request->employment_bond_id);
        $employment_bond->activity_end = $request->activity_end;
        $employment_bond->status = 'INATIVO';
        if(!$employment_bond->save()){
            return redirect()->route('employee')->with('error', 'Erro ao arquivar o servidor!');
        }

        $bond_employee->box_id = $request->box_id;
        $bond_employee->order = $request->order;
        $bond_employee->status = "ARQUIVADO";
        $bond_employee->entry_year = $employment_bond->lotation->format('Y');
        $bond_employee->exit_year = $employment_bond->activity_end->format('Y');
        $bond_employee->employee_id = $employment_bond->employee->id;
        if(!$bond_employee->save()){
            return redirect()->route('employee')->with('error', 'Erro ao arquivar o servidor!');
        }

        return redirect()->route('employee')->with('success', 'Servidor Arquivado com sucesso na caixa '.Box::findOrFail($bond_employee->box_id)->description);
    }
}
