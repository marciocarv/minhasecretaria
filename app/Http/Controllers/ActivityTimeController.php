<?php

namespace App\Http\Controllers;

use App\Models\ActivityTime;
use App\Models\Employment_bond;
use Illuminate\Http\Request;

class ActivityTimeController extends Controller
{
    public function define($id){
        $employment_bond = Employment_bond::findOrFail($id);

            $title = "Definir Hora-atividade";
            $route = "storeActivityTime";

            return view('activityTime.define', ['title'=>$title, 'employment_bond'=>$employment_bond, 'route'=>$route]);
    }

    public function store(Request $request){
        $activityTime = new ActivityTime;
        $employment_bond = Employment_bond::findOrFail($request->employment_bond_id);

        if($employment_bond->activityTime){
            $activityTime = $employment_bond->activityTime;
        }

        $activityTime->description = $request->description;
        $activityTime->employment_bond_id = $request->employment_bond_id;

        if(!$activityTime->save()){
            return redirect()->route('manageEmployee', ['id'=>$employment_bond->id])->with('error', 'Não foi possível definir a Hora-atividade!');
        }

        return redirect()->route('listActivityTime', ['id'=>$employment_bond->id])->with('success', 'Hora-atividade definida com sucesso!');
    }

    public function list($id){
        $employment_bond = Employment_bond::findOrFail($id);

        if(!$employment_bond->activityTime){
            return redirect()->route('defineActivityTime', ['id'=>$employment_bond->id]);
        }

        $title = "Hora-atividade";

        return view('activityTime.list', ['title'=>$title, 'employment_bond'=>$employment_bond]);
    }
}
