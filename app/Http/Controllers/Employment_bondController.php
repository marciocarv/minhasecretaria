<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bond_employee;
use App\Models\Box;
use App\Models\Employee;
use App\Models\Employment_bond;
use Carbon\Carbon;

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

        if($request->archiving === "y"){
            $bond_employee->box_id = $request->box_id;
            $bond_employee->order = $request->order;
            $bond_employee->status = "ARQUIVADO";
            $bond_employee->entry_year = $employment_bond->lotation->format('Y');
            $bond_employee->exit_year = $employment_bond->activity_end->format('Y');
            $bond_employee->employee_id = $employment_bond->employee->id;
            if(!$bond_employee->save()){
                return redirect()->route('employee')->with('error', 'Erro ao arquivar o servidor!');
            }
        }      

        return redirect()->route('employee')->with('success', 'Servidor Arquivado com sucesso');
    }

    public function setChangeRole($id){
        $employement_bond = Employment_bond::findOrFail($id);
        return view('employee.changeRole', [
            'employment_bond'=>$employement_bond,
            'title'=>'Alterar Função do Servidor',
            'route'=>'changeRole'
        ]);
    }

    public function changeRole(Request $request){

        $former_employment_bond = Employment_bond::findOrFail($request->employment_bond_id);

        $employment_bond = new Employment_bond();
        $employment_bond->employee_id = $request->employee_id;
        $employment_bond->registration = $former_employment_bond->registration;
        $employment_bond->activity_start = $request->activity_start;
        $employment_bond->post = $former_employment_bond->post;
        $employment_bond->role = $request->role;
        $employment_bond->workload = $request->workload;
        $employment_bond->bond = $former_employment_bond->bond;
        $employment_bond->lotation = $request->lotation;
        $employment_bond->status = 'ATIVO';

        $former_employment_bond->status = 'INATIVO';
        $former_employment_bond->activity_end = Carbon::create($request->lotation)->subDays(1);

        if($employment_bond->save() && $former_employment_bond->save()){
            return redirect()->route('employee')->with('sucecess', 'Função Alterada com sucesso');
        }else{
            return redirect()->route('employee')->with('error', 'Não foi possível alterar a função');
        }
    }

    public function setReactivate($id){
        $employee = Employment_bond::findOrFail($id)->employee;
        return view('employee.reactivate', [
            'employee'=>$employee,
            'title'=>'Reativar Servidor',
            'route'=>'reactivateEmployee'
        ]);
    }

    public function reactivate(Request $request){
        $employee = Employee::findOrFail($request->employee_id);

        $employment_bond = new Employment_bond();
        $employment_bond->employee_id = $request->employee_id;
        $employment_bond->registration = $request->registration;
        $employment_bond->activity_start = $request->activity_start;
        $employment_bond->post = $request->post;
        $employment_bond->role = $request->role;
        $employment_bond->workload = $request->workload;
        $employment_bond->bond = $request->bond;
        $employment_bond->lotation = $request->lotation;
        $employment_bond->status = 'ATIVO';

        if($employment_bond->save()){
            return redirect()->route('employee')->with('sucecess', 'Servidor Reativado com sucesso');
        }else{
            return redirect()->route('employee')->with('error', 'Não foi possível reativar a função');
        }

    }
}
