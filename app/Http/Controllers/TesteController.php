<?php

namespace App\Http\Controllers;

use App\Models\Bond_employee;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Box;
use App\Models\Bond_student;
use App\Models\Employment_bond;

class TesteController extends Controller
{
    public function teste(){
        $employment_bond = Employment_bond::all()->where('status', 'ATIVO');

        dd($employment_bond);
    }
}
