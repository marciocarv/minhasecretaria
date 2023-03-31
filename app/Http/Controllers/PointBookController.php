<?php

namespace App\Http\Controllers;

use App\Models\Employment_bond;
use Illuminate\Http\Request;

class PointBookController extends Controller
{
    public function index(){
        $title = "Gerador de Livro de ponto";
        $pedagogico = new Employment_bond;
        $pedagogico
        return view('point.pointBook', ['title'=>$title]);
    }
}
