<?php

namespace App\Http\Controllers;

use App\Models\Employment_bond;
use Illuminate\Http\Request;
use PDF;

class declarationController extends Controller
{
    public function activity_start($id){
        
    }

    public function functionalSheet($id){
        $employment_bond = Employment_bond::findOrFail($id);

        $pdf = PDF::loadView('employee.functionalSheet', compact('employment_bond'));

        return $pdf->setPaper('a4')->stream('ficha_funcional.pdf');
    }
}
