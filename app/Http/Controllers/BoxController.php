<?php

namespace App\Http\Controllers;

use App\Models\Bond_employee;
use App\Models\Bond_student;
use Illuminate\Http\Request;
use App\Models\Box;

use function PHPUnit\Framework\isEmpty;

class BoxController extends Controller
{
    public function manageBoxes($id=null){

        $title = "Gerenciar Caixa";

        $box = new Box;

        $boxes = $box->listBoxes();

        if($id===null){
            return view('box.manageBoxes', ['title'=>$title, 'route'=>'storeBox', 'boxes'=>$boxes, 'action'=>'store', 'boxUpdate'=>$box]);
        }else{
            $box = Box::findOrFail($id);
            return view('box.manageBoxes', ['title'=>$title, 'route'=>'updateBox', 'boxes'=>$boxes, 'action'=>'update', 'boxUpdate'=>$box]);
        }

    }

    public function store(Request $request){
        $request->validate([
            'description'=> 'required',
            'type'=>'required|min:2'
        ]);

        if(Box::create($request->all())){
            return redirect()->route('manageBoxes')->with('success', 'A caixa foi salva com sucesso!');
        }else{
            return redirect()->route('manageBoxes')->with('error', 'Não foi possível salvar a caixa!');
        }
    }

    public function delete($id){

        $box = Box::findOrFail($id);

        $bond_students = $box->bond_students;

        if(!$bond_students->isEmpty()){
            $studentController = new StudentController;
            foreach($bond_students as $bond_student){
                $studentController->deleteLoose($bond_student->student->id);
            }
        }

        if(!$box->delete()){
            return redirect()->route('manageBoxes')->with('error', 'Não foi possível excluir a caixa!');
        }

        return redirect()->route('manageBoxes')->with('success', 'A caixa foi excluída com sucesso!');
    }

    public function update(Request $request){
        
        $request->validate([
            'description'=> 'required',
            'type'=>'required|min:2'
        ]);

        $box = Box::findOrFail($request->id);

        $box->description = $request->description;
        $box->type = $request->type;

        if($box->save()){
            return redirect()->route('manageBoxes')->with('success', 'A caixa foi Editada com sucesso!');
        }else{
            return redirect()->route('manageBoxes')->with('error', 'Não foi possível Editar a caixa!');
        }
    }

    public function view($id){
        $box = Box::findOrFail($id);

        $title = "Gerenciar Caixa ".$box->description;


        if($box->type == 'Aluno' || $box->type == 'devendo'){
            $bond_students = $box->bond_students;
            return view('box.viewBox', ['title'=>$title, 'bonds'=>$bond_students, 'box'=>$box]);
        }else{
            $bond_employees = $box->bond_employees;
            return view('box.viewBox', ['title'=>$title, 'bonds'=>$bond_employees, 'box'=>$box]);
        }

    }

    public function show($type){
        $box = new Box;

        $boxes = $box->boxForType($type);

        $title = 'CAIXAS';

        if($type != 'Aluno' && $type != 'Servidor' && $type != 'devendo'){
            return redirect()->route('inactive');
        }

        return view('box.showBoxes', ['boxes'=>$boxes, 'title'=>$title]);
    }

    public function print($id){
        $box = Box::findOrFail($id);
        $title = 'Imprimir Caixa';

        if($box->type == 'Servidor'){

            $bonds = $box->bond_employees;

            return view('box.print', ['bonds'=>$bonds, 'box'=>$box, 'title'=>$title]);
        }else{
            $bonds = $box->bond_students;

            return view('box.print', ['bonds'=>$bonds, 'box'=>$box, 'title'=>$title]);
        }

    }

    public function search(Request $request){

        $title = "Resultado da pesquisa";

        $bond_employee = new Bond_employee;

        $search_employee = $bond_employee->search($request->name);

        $bond_student = new Bond_student;

        $search_student = $bond_student->search($request->name);

        $search = $search_employee->merge($search_student);

        return view('inactive.result_search', ['search'=>$search, 'title'=>$title, 'name'=>$request->name]);

    }

    public function getOrderEmployee($id_box){
        $box = Box::findOrfail($id_box);
        $order = $box->bond_employees->count() + 1;
        return response()->json($order);
    }

    public function getOrderStudent($id_box){
        $box = Box::findOrfail($id_box);
        $order = $box->bond_students->count() + 1;
        return response()->json($order);
    }

}
