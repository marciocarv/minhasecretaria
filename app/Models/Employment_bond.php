<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employment_bond extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration',
        'post',
        'role',
        'workload',
        'status'
    ];

    protected $dates = [
        'activity_start',
        'lotation',
        'activity_end'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function active_employees(){
        return DB::table('employment_bonds')
        ->join('employees', 'employees.id', 'employment_bonds.employee_id')
        ->where('employment_bonds.status', '=', 'ATIVO')
        ->select('employment_bonds.id', 
                'employment_bonds.registration', 
                'employment_bonds.post', 
                'employment_bonds.role', 
                'employees.name', 
                'employees.date_birth',
                'employment_bonds.lotation',
                'employees.cpf')
        ->orderBy('employees.name')
        ->get();
    }

    public function inactive_employees(){
        return DB::table('employment_bonds')
        ->join('employees', 'employees.id', 'employment_bonds.employee_id')
        ->where('employment_bonds.status', '=', 'INATIVO')
        ->select('employment_bonds.id', 
                'employment_bonds.registration', 
                'employment_bonds.post', 
                'employment_bonds.role', 
                'employees.name', 
                'employees.date_birth',
                'employees.cpf')
        ->orderBy('employees.name')
        ->get();
    }

    public function employeeBySector($option){

        return Employment_bond::select('employment_bonds.*', 
        'employees.id as employees_id', 
        'employees.name',
        'employees.phone')
        ->join('employees', 'employees.id', '=', 'employment_bonds.employee_id')
        ->where('employment_bonds.status', 'ativo')
        ->where('employment_bonds.role', $option, 'pro%')
        ->orderBy('employees.name')
        ->get();
    }
}
