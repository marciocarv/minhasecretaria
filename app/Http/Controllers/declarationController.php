<?php

namespace App\Http\Controllers;

use App\Models\Bond_employee;
use App\Models\Box;
use App\Models\Employee;
use App\Models\Employment_bond;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class declarationController extends Controller
{
    public function declaration_options(){
        return view('declaration.declaration_options');
    }

    public function activity_start($id){
        $employment_bond = Employment_bond::findOrFail($id);

        \Carbon\Carbon::setlocale('pt_BR'); // LC_TIME é formatação de data e hora com strftime()

        $dt = Carbon::now();

        $dia = $dt->isoFormat('D');

        $mes = $dt->isoFormat('MMMM');

        $ano = $dt->isoFormat('Y');

        $pdf = PDF::loadView('employee.activityStart', compact('employment_bond', 'dia', 'mes', 'ano'));

        return $pdf->setPaper('a4')->stream('ficha_funcional.pdf');
    }

    public function functionalSheet($id){
        $employment_bond = Employment_bond::findOrFail($id);

        $pdf = PDF::loadView('employee.functionalSheet', compact('employment_bond'));

        return $pdf->setPaper('a4')->stream('ficha_funcional.pdf');
    }

    public function bond($id){

    }

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

        return redirect()->route('employee')->with('success', 'Servidor Arquivado com sucesso!');
    }

}
