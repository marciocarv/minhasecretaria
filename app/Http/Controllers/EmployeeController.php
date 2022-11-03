<?php

namespace App\Http\Controllers;

use App\Models\Bond_employee;
use App\Models\Box;
use App\Models\Employee;
use App\Models\Employment_bond;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function setStoreBox($id){
        $title = "Cadastrar Servidor";

        $box = Box::findOrFail($id);

        $order = $box->bond_employees->count() + 1;

        return view('employee.formEmployeeBox', ['box_id'=>$box->id, 'title'=>$title, 'action'=>'store', 'route'=>'storeBoxEmployee', 'order'=>$order]);
    }

    public function setStore(){
        $title = "Cadastrar Servidor - Dados Pessoais";

        return view('employee.formEmployee1', ['title'=>$title, 'action'=>'store', 'route'=>'storeEmployee']);
    }

    public function storeEmployee(Request $request){

        if($request->form == 'form1'){
            
            $request->validate([
                'name'=>'required',
                'date_birth'=>'required',
                'mother'=>'required'
            ]);

            $employee = new Employee;

            $employee->name = $request->name;
            $employee->date_birth = $request->date_birth;
            $employee->mother = $request->mother;
            $employee->father = $request->father;
            $employee->naturalness = $request->naturalness;
            $employee->marital_status = $request->marital_status;
            $employee->sex = $request->sex;
            $employee->color = $request->color;
            $employee->phone = $request->phone;

            if($employee->save()){
                $title = 'Cadastrar Servidor - Endereço e Documentos';
                return view('employee.formEmployee2', ['id_employee'=>$employee->id, 'title'=>$title, 'route'=>'storeEmployee', 'action'=>'store'])
                ->with('success', 'Dados Salvos com sucesso!');
            }else{
                return redirect()->route('employee')->with('error', 'Não foi possível cadastrar o servidor');
            }

            

        }elseif($request->form == 'form2'){
            $employee = Employee::findOrFail($request->id_employee);
            $employee->cep = $request->cep;
            $employee->address = $request->address;
            $employee->cpf = $request->cpf;
            $employee->rg = $request->rg;
            $employee->rg_expedition = $request->rg_expedition;
            $employee->certificate_type = $request->certificate_type;
            $employee->certificate_term = $request->certificate_term;
            $employee->certificate_book = $request->certificate_book;
            $employee->certificate_sheet = $request->certificate_sheet;

            if($employee->save()){
                $title = 'Cadastrar Servidor - Dados Bancários e Formação';
                return view('employee.formEmployee3', ['id_employee'=>$employee->id, 'title'=>$title, 'route'=>'storeEmployee', 'action'=>'store'])
                ->with('success', 'Dados Salvos com sucesso!');
            }else{
                return redirect()->route('employee')->with('error', 'Não foi possível cadastrar o servidor');
            }

            

        }elseif($request->form == 'form3'){
            $employee = Employee::findOrFail($request->id_employee);
            $employee->bank_name = $request->bank_name;
            $employee->bank_agency = $request->bank_agency;
            $employee->bank_number = $request->bank_number;
            $employee->schooling = $request->schooling;
            $employee->course_status = $request->course_status;
            $employee->course_name = $request->course_name;
            $employee->name_college = $request->name_college;
            $employee->conclusion = $request->conclusion;

            if($employee->save()){
                $title = 'Cadastrar Servidor - Dados profissionais';
                return view('employee.formEmployee4', ['id_employee'=>$employee->id, 'title'=>$title, 'route'=>'storeEmployee', 'action'=>'store'])
                ->with('success', 'Dados Salvos com sucesso!');
            }else{
                return redirect()->route('employee')->with('error', 'Não foi possível cadastrar o servidor');
            }

            

        }elseif($request->form == 'form4'){
            $employee = Employee::findOrFail($request->id_employee);
            $employment_bond = new Employment_bond;

            $employee->admission = $request->admission;
            $employee->id_censo = $request->id_censo;
            $employee->save();

            $request->validate([
                'registration'=>'numeric|required',
                'activity_start'=>'required',
                'post'=>'required',
                'role'=>'required',
                'workload'=>'required'
            ]);

            $employment_bond->employee_id = $employee->id;
            $employment_bond->registration = $request->registration;
            $employment_bond->activity_start = $request->activity_start;
            $employment_bond->post = $request->post;
            $employment_bond->role = $request->role;
            $employment_bond->workload = $request->workload;
            $employment_bond->bond = $request->bond;
            $employment_bond->lotation = $request->lotation;
            $employment_bond->status = 'ATIVO';

            if($employment_bond->save()){
                return redirect()->route('employee')->with('success', 'Servidor Salvo com sucesso!');
            }else{
                return redirect()->route('employee')->with('error', 'Não foi possível completar o cadastro!');
            }
           
        }

    }

    public function storeBox(Request $request){
        $request->validate([
            'order'=>'required|numeric',
            'name'=>'required',
            'date_birth'=>'required',
            'exit_year'=>'required|numeric',
            'mother'=>'required',
        ]);

        $employee = new Employee;

        $box = Box::findOrFail($request->box_id);

        $employee->name = $request->name;
        $employee->date_birth = $request->date_birth;
        $employee->mother = $request->mother;

        if(!$employee->save()){
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível salvar o servidor!');
        }

        $bond_employee = new Bond_employee;

        $bond_employee->order = $request->order;
        $bond_employee->employee_id = $employee->id;
        $bond_employee->box_id = $box->id;
        $bond_employee->entry_year = $request->entry_year;
        $bond_employee->exit_year = $request->exit_year;

        if(!$bond_employee->save()){
            $employee->delete();
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível salvar o servidor!');
        }

        return redirect()->route('viewBox', ['id'=>$box->id])->with('success', 'Servidor Salvo com sucesso!');
    }

    public function deleteBox($id){

        $bond_employee = Bond_employee::findOrFail($id);
        $employee = $bond_employee->employee;
        $box = $bond_employee->box;

        if(!$bond_employee->delete()){
            return redirect()->route('viewBox', ['id'=>$bond_employee->box->id])->with('error', 'Não foi possível excluir o servidor!');
        }

        if(!$this->checkBond($employee->id)){
            if(!$employee->delete()){
                return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível excluir o servidor!');
            }
            return redirect()->route('viewBox', ['id'=>$box->id])->with('success', 'Servidor excluído com sucesso!');
        }
        return redirect()->route('viewBox', ['id'=>$box->id])->with('success', 'Servidor excluído com sucesso!');
    }

    public function delete($id){

        $employment_bond = Employment_bond::findOrFail($id);
        $employee = $employment_bond->employee;

        if(!$employment_bond->delete()){
            return redirect()->route('employee')->with('error', 'Não foi possível excluir o servidor!');
        }

        if(!$this->checkBond($employee->id)){
            if(!$employee->delete()){
                return redirect()->route('employee')->with('error', 'Não foi possível excluir o servidor!');
            }
            return redirect()->route('employee')->with('success', 'Servidor excluído com sucesso!');
        }
        return redirect()->route('employee')->with('success', 'Servidor excluído com sucesso!');
    }

    public function checkBond($id){
        $employee = Employee::find($id);

        if($employee->bond_employees->isEmpty() && $employee->employment_bonds->isEmpty()){
            return false;
        }else{
            return true;
        }
    }

    public function setUpdateBoxEmployee($id){
        $bond_employee = Bond_employee::findOrFail($id);

        $employee = $bond_employee->employee;

        $box = $bond_employee->box;

        $title = 'Editar Servidor';

        return view('employee.formEmployeeBox', ['bond_employee'=>$bond_employee, 'box_id'=>$box->id, 'employee'=>$employee, 'title'=>$title,
                    'action'=>'update', 'route'=>'updateBoxEmployee']);
    }

    public function updateBox(Request $request){

        $request->validate([
            'order'=>'required|numeric',
            'name'=>'required',
            'date_birth'=>'required',
            'exit_year'=>'required|numeric',
            'mother'=>'required',
        ]);

        $employee = Employee::findOrFail($request->employee_id);

        $box = Box::findOrFail($request->box_id);

        $employee->name = $request->name;
        $employee->date_birth = $request->date_birth;
        $employee->mother = $request->mother;

        if(!$employee->save()){
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível alterar o Servidor!');
        }

        $bond_employee = Bond_employee::findOrFail($request->bond_employee_id);

        $bond_employee->order = $request->order;
        $bond_employee->employee_id = $employee->id;
        $bond_employee->box_id = $box->id;
        $bond_employee->entry_year = $request->entry_year;
        $bond_employee->exit_year = $request->exit_year;

        if(!$bond_employee->save()){
            $employee->delete();
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível alterar o servidor!');
        }

        return redirect()->route('viewBox', ['id'=>$box->id])->with('success', 'Servidor Alterado com sucesso!');

    }

    public function setTransfer($id){
        $bond_employee = Bond_employee::findOrFail($id);

        $employee = $bond_employee->employee;

        $box = new Box;

        $title = 'Trasferir Servidor';

        $boxes = $box->boxForType('Servidor');


        return view('employee.transferEmployee', ['employee'=>$employee, 'boxes'=>$boxes, 'title'=>$title, 'bond_employee'=>$bond_employee]);
    }

    public function transfer(Request $request){
        $employee = Employee::findOrFail($request->employee_id);

        $formerBond_employee = Bond_employee::findOrFail($request->bond_employee_id);

        $box = Box::findOrFail($request->box_id);

        $bond_employee = new Bond_employee;
        $bond_employee->employee_id = $employee->id;
        $bond_employee->box_id = $box->id;
        $bond_employee->order = $request->order;
        $bond_employee->entry_year = $request->entry_year;
        $bond_employee->exit_year = $request->exit_year;

        if(!$bond_employee->save()){
            return redirect()->route('viewBox', ['id'=>$formerBond_employee->box_id])->with('error', 'Não foi possível transferir o aluno!');
        }

        $formerBond_employee->status = "TRANSFERIDO - ".now()->format('d/m/Y');

        $formerBond_employee->save();

        return redirect()->route('viewBox', ['id'=>$box->id])
            ->with('success', 'Aluno transferido da caixa '.$formerBond_employee->box->description.' para a caixa '.$box->description.'!');

    }

    public function employee(){
        $title = 'Gerenciamento de Servidores';
        $employment_bond = new Employment_bond;

        $employees = $employment_bond->active_employees();

        return view('employee.employee', ['title'=>$title, 'employees'=>$employees]);
    }

    public function setUpdateEmployee($id){
        $employment_bond = Employment_bond::findOrFail($id);
        $employee = $employment_bond->employee;

        $title = "Editar Servidor - Dados Pessoais";

        return view('employee.formEmployee1', ['title'=>$title, 
                    'action'=>'update', 
                    'route'=>'updateEmployee', 
                    'employment_bond'=>$employment_bond, 
                    'employee'=>$employee]);
    }

    public function update(Request $request){
        $employment_bond = Employment_bond::findOrFail($request->employment_bond_id);
        $employee = $employment_bond->employee;

        if($request->form == 'form1'){
            
            $request->validate([
                'name'=>'required',
                'date_birth'=>'required',
                'mother'=>'required'
            ]);

            $employee->name = $request->name;
            $employee->date_birth = $request->date_birth;
            $employee->mother = $request->mother;
            $employee->father = $request->father;
            $employee->naturalness = $request->naturalness;
            $employee->marital_status = $request->marital_status;
            $employee->sex = $request->sex;
            $employee->color = $request->color;
            $employee->phone = $request->phone;

            if($employee->save()){
                $title = 'Editar Servidor - Endereço e Documentos';
                return view('employee.formEmployee2',
                             ['id_employee'=>$employee->id, 
                            'title'=>$title, 
                            'route'=>'updateEmployee', 
                            'action'=>'update', 
                            'employee'=>$employee,
                            'employment_bond'=>$employment_bond])
                ->with('success', 'Dados editados com sucesso!');
            }else{
                return redirect()->route('employee')->with('error', 'Não foi possível Editar o servidor');
            }

        }elseif($request->form == 'form2'){
            $employee->cep = $request->cep;
            $employee->address = $request->address;
            $employee->cpf = $request->cpf;
            $employee->rg = $request->rg;
            $employee->rg_expedition = $request->rg_expedition;
            $employee->certificate_type = $request->certificate_type;
            $employee->certificate_term = $request->certificate_term;
            $employee->certificate_book = $request->certificate_book;
            $employee->certificate_sheet = $request->certificate_sheet;

            if($employee->save()){
                $title = 'Editar Servidor - Dados Bancários e Formação';
                return view('employee.formEmployee3', ['id_employee'=>$employee->id, 
                                                        'title'=>$title, 
                                                        'route'=>'updateEmployee', 
                                                        'action'=>'update',
                                                        'employee'=>$employee,
                                                        'employment_bond'=>$employment_bond])
                ->with('success', 'Dados Editados com sucesso!');
            }else{
                return redirect()->route('employee')->with('error', 'Não foi possível editar o servidor');
            }

            

        }elseif($request->form == 'form3'){
            $employee->bank_name = $request->bank_name;
            $employee->bank_agency = $request->bank_agency;
            $employee->bank_number = $request->bank_number;
            $employee->schooling = $request->schooling;
            $employee->course_status = $request->course_status;
            $employee->course_name = $request->course_name;
            $employee->name_college = $request->name_college;
            $employee->conclusion = $request->conclusion;

            if($employee->save()){
                $title = 'Editar Servidor - Dados profissionais';
                return view('employee.formEmployee4', ['id_employee'=>$employee->id, 
                                                        'title'=>$title, 
                                                        'route'=>'updateEmployee', 
                                                        'action'=>'update',
                                                        'employee'=>$employee,
                                                        'employment_bond'=>$employment_bond])
                ->with('success', 'Dados editados com sucesso!');
            }else{
                return redirect()->route('employee')->with('error', 'Não foi possível editar o servidor');
            }

        }elseif($request->form == 'form4'){
           
            $employee->admission = $request->admission;
            $employee->id_censo = $request->id_censo;
            $employee->save();

            $request->validate([
                'registration'=>'numeric|required',
                'activity_start'=>'required',
                'post'=>'required',
                'role'=>'required',
                'workload'=>'required'
            ]);

            $employment_bond->registration = $request->registration;
            $employment_bond->activity_start = $request->activity_start;
            $employment_bond->post = $request->post;
            $employment_bond->role = $request->role;
            $employment_bond->workload = $request->workload;
            $employment_bond->bond = $request->bond;
            $employment_bond->status = 'ATIVO';

            if($employment_bond->save()){
                return redirect()->route('employee')->with('success', 'Servidor editado com sucesso!');
            }else{
                return redirect()->route('employee')->with('error', 'Não foi possível editar o cadastro!');
            }
        }
    }

    public function deleteEmployee($id){
        $employment_bond = Employment_bond::findOrFail($id);

        $employee = $employment_bond->employee;

        if($employee->delete()){
            return redirect()->route('employee')->with('success', 'Servidor apagado com sucesso!');
        }else{
            return redirect()->route('employee')->with('error', 'Não foi possível apagar o registro!');
        }

    }

    public function manageEmployee($id){
        $employment_bond = Employment_bond::findOrFail($id);

        $title = 'Gerenciamento de servidor';

        return view('employee.manage', ['employment_bond'=>$employment_bond, 'title'=>$title]);
    }

    public function rescue($id){
        $bond_employee = Bond_employee::findOrFail($id);

        $bond_employee->status = 'RESGATADO - '.now()->format('d/m/Y');

        if(!$bond_employee->save()){
            return redirect()->route('viewBox', ['id'=>$bond_employee->box_id])->with('error', 'Não foi possível resgatar esse servidor!');
        }
        
        return view('employee.storeEmployment_bond', [
            'employee'=>$bond_employee->employee,
            'title'=> 'Novo Vínculo do Servidor',
            'route'=> 'storeEmployment_bond'
            ])->with('success', 'Servidor resgatado com sucesso!');
    }

    public function storeEmployment_bond(Request $request){
        $employee = Employee::findOrFail($request->employee_id);

        $employment_bond = new Employment_bond;

        $employment_bond->employee_id = $employee->id;
        $employment_bond->registration = $request->registration;
        $employment_bond->activity_start = $request->activity_start;
        $employment_bond->post = $request->post;
        $employment_bond->role = $request->role;
        $employment_bond->workload = $request->workload;
        $employment_bond->bond = $request->bond;
        $employment_bond->lotation = $request->lotation;
        $employment_bond->status = 'ATIVO';

        if(!$employment_bond->save()){
            return redirect()->route('employee')->with('error', 'Não foi possível resgatar o servidor!');
        }

        return redirect()->route('employee')->with('success', 'Servidor Vinculado com sucesso!');
    }
}
