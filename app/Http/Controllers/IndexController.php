<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employment_bond;
use App\Models\HelpTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Leave;

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

        // Contando apenas as licenças médicas do mês atual
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');

        $monthlyMedicalLeavesCount = Leave::where('type', 'medical')
            ->where('start_date', '<=', $endOfMonth)
            ->where('end_date', '>=', $startOfMonth)
            ->count();
        
        $openTickets = HelpTicket::where('status', '!=', 'Finalizado')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('index.index', [
                    'title'=>$title, 
                    'employment_bonds'=>$employees,
                    'activeEmployeesCount' => $activeEmployeesCount,
                    'openTickets'          => $openTickets,
                    'monthlyLeavesCount' => $monthlyMedicalLeavesCount,]);
    }

    public function inactive(){
        $title = "Arquivo Inativo";
        return view('inactive.inactive', ['title'=>$title]);
    }
}
