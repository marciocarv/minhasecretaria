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
        $title = "Declarações";
        return view('declaration.declaration_options', ['title'=>$title]);
    }

    public function employeeForType($status){
        $employment_bond = Employment_bond::with('employee')->where('status', $status)->get();
        return response()->json($employment_bond);
    }

    public function showDeclaration(Request $request){

        if($request->type == 'work'){
            return redirect()->route('work_declaration', ['id'=>$request->employee_select]);
        }elseif($request->type == 'bond'){
            return redirect()->route('bond_declaration', ['id'=>$request->employee_select]);
        }elseif($request->type == 'activity_start'){
            return redirect()->route('activity_start', ['id'=>$request->employee_select]);
        }elseif($request->type == 'end'){
            return redirect()->route('activity_end', ['id'=>$request->employee_select]);
        }
    }

    public function activity_end($id){
        $employment_bond = Employment_bond::findOrFail($id);

        \Carbon\Carbon::setlocale('pt_BR'); // LC_TIME é formatação de data e hora com strftime()

        $dt = Carbon::now();

        $dia = $dt->isoFormat('D');

        $mes = $dt->isoFormat('MMMM');

        $ano = $dt->isoFormat('Y');

        $pdf = PDF::loadView('declaration.activityEnd', compact('employment_bond', 'dia', 'mes', 'ano'));

        return $pdf->setPaper('a4')->stream('encerramento_de_atividade.pdf');
    }

    public function bond_declaration($id){
        $employee = Employment_bond::findOrFail($id)->employee;
        $employment_bonds = $employee->Employment_bonds;

        \Carbon\Carbon::setlocale('pt_BR'); // LC_TIME é formatação de data e hora com strftime()

        $dt = Carbon::now();

        $dia = $dt->isoFormat('D');

        $mes = $dt->isoFormat('MMMM');

        $ano = $dt->isoFormat('Y');

        $pdf = PDF::loadView('declaration.bond_declaration', compact('employment_bonds', 'dia', 'mes', 'ano', 'employee'));

        return $pdf->setPaper('a4')->stream('vinculo.pdf');
    }

    public function work_declaration($id){
        $employment_bond = Employment_bond::findOrFail($id);

        \Carbon\Carbon::setlocale('pt_BR'); // LC_TIME é formatação de data e hora com strftime()

        $dt = Carbon::now();

        $dia = $dt->isoFormat('D');

        $mes = $dt->isoFormat('MMMM');

        $ano = $dt->isoFormat('Y');

        $pdf = PDF::loadView('declaration.work_declaration', compact('employment_bond', 'dia', 'mes', 'ano'));

        return $pdf->setPaper('a4')->stream('trabalho.pdf');
    }

    public function activity_start($id){
        $employment_bond = Employment_bond::findOrFail($id);

        \Carbon\Carbon::setlocale('pt_BR'); // LC_TIME é formatação de data e hora com strftime()

        $dt = Carbon::now();

        $dia = $dt->isoFormat('D');

        $mes = $dt->isoFormat('MMMM');

        $ano = $dt->isoFormat('Y');

        $pdf = PDF::loadView('employee.activityStart', compact('employment_bond', 'dia', 'mes', 'ano'));

        return $pdf->setPaper('a4')->stream('inicio_de_atividade.pdf');
    }

    public function functionalSheet($id){
        $employment_bond = Employment_bond::findOrFail($id);

        $pdf = PDF::loadView('employee.functionalSheet', compact('employment_bond'));

        return $pdf->setPaper('a4')->stream('ficha_funcional.pdf');
    }

    public function bond($id){

    }

}