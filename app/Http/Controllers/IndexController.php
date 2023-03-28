<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $title = "Sistema de Gestão de Secretaria Escolar";

        $current_month = Carbon::now()->month;
        return view('index.index', ['title'=>$title]);
    }

    public function inactive(){
        $title = "Arquivo Inativo";
        return view('inactive.inactive', ['title'=>$title]);
    }
}
