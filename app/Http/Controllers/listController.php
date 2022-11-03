<?php

namespace App\Http\Controllers;

use App\Models\Employment_bond;
use Illuminate\Http\Request;
use PDF;

class listController extends Controller
{
    public function listOptions(){
        $title = 'Opções de listas para impressão';

        return view('list.listOptions', ['title'=>$title]);
    }

    public function generateList(Request $request){
        $employment_bonds = Employment_bond::all()->where('status', 'ATIVO');

        $pdf = PDF::loadView('list.listEmployee', compact('employment_bonds', 'request'));

        return $pdf->setPaper('a4')->stream('lista_servidores.pdf');
    }
}
