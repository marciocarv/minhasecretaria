<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employment_bond;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $title = "Sistema de Gestão de Secretaria Escolar";

        $current_month = Carbon::now()->month;
        $employment_bond = new Employment_bond;

        $employment_bonds = $employment_bond->birthdays_month($current_month);

        return view('index.index', ['title'=>$title, 'employment_bonds'=>$employment_bonds]);
    }

    public function inactive(){
        $title = "Arquivo Inativo";
        return view('inactive.inactive', ['title'=>$title]);
    }
}
