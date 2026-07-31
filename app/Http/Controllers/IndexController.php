<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employment_bond;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MedicalLeave;

class IndexController extends Controller
{
    public function index(){
        $title = "Sistema de Gestão de Secretaria Escolar";

        $current_month = Carbon::now()->month;
        $employee = new Employee;
        $employees = $employee->birthdays_month($current_month);

        // 1. Sua busca original (que também serve para os aniversariantes)
        $employment_bonds = Employment_bond::with('employee')
            ->where('status', 'ATIVO')
            ->get();

        // 2. Contando os Servidores Ativos
        $activeEmployeesCount = $employment_bonds->count();

        // 3. Contando as Licenças Médicas do Mês Atual
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $monthlyLeavesCount = MedicalLeave::where(function($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('start_date', $currentMonth)
                  ->whereYear('start_date', $currentYear);
        })->orWhere(function($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('end_date', $currentMonth)
                  ->whereYear('end_date', $currentYear);
        })->count();

        return view('index.index', [
                    'title'=>$title, 
                    'employment_bonds'=>$employees,
                    'activeEmployeesCount' => $activeEmployeesCount,
                    'monthlyLeavesCount' => $monthlyLeavesCount,]);
    }

    public function inactive(){
        $title = "Arquivo Inativo";
        return view('inactive.inactive', ['title'=>$title]);
    }
}
