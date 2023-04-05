<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employment_bond;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Carbon\CarbonPeriod;

class PointBookController extends Controller
{
    public function index(){
        $title = "Gerar Livro de ponto";
        $employee = new Employment_bond();
        $pedagogico = $employee->employeeBySector('like');
        $administrativo = $employee->employeeBySector('not like');
        $employees = $administrativo->merge($pedagogico);

        return view('point.pointBook', ['title'=>$title, 'employees'=>$employees]);
    }

    public function makePointBook(Request $request){
        // Get the current month
        // Set the locale to Portuguese
        Carbon::setLocale('pt_BR');

        // Get the current month
        $currentMonth = Carbon::createFromFormat('Y-m', $request->month);
        // Create a Carbon instance for the first day of the month
        $firstDayOfMonth = Carbon::createFromDate(null, $currentMonth->month, 1);
        // Create a Carbon instance for the last day of the month
        $lastDayOfMonth = Carbon::createFromDate(null, $currentMonth->month, $firstDayOfMonth->daysInMonth);
        // Create a CarbonPeriod instance for the month
        $monthPeriod = CarbonPeriod::create($firstDayOfMonth, $lastDayOfMonth);
        
        $employees = collect();
        $employment_bond = new Employment_bond;
        foreach($request->employee as $employee){
            $employees->push($employment_bond->find($employee));
        }
  
        $saturdays = $request->saturdays;
        $holidays = $request->holidays;

        $fileName = "Ponto_".$currentMonth->isoFormat('MMMM');

        $pdf = PDF::loadView('point.printPointBook', compact('employees', 'currentMonth', 'saturdays', 'holidays', 'monthPeriod'));

        return $pdf->setPaper('a4', 'landscape')->stream($fileName);
    } 
}
