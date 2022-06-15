<?php

namespace App\Http\Controllers;

use App\Models\Employment_bond;
use Illuminate\Http\Request;

class declarationController extends Controller
{
    public function activity_start($id){
        
    }

    public function functionalSheet($id){
        $employment_bond = Employment_bond::findOrFail($id);

        return view('employee.functionalSheet', ['employment_bond'=>$employment_bond]);
    }
}
