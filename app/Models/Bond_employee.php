<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bond_employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'order',
        'status',
        'entry_year',
        'exit_year'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function box(){
        return $this->belongsTo(Box::class);
    }

    public function search($name){
        return DB::table('bond_employees')
            ->join('boxes', 'boxes.id', 'bond_employees.box_id')
            ->join('employees', 'employees.id', 'bond_employees.employee_id')
            ->where('employees.name', 'LIKE', '%'.$name.'%')
            ->select('bond_employees.*',
             'employees.name', 
             'employees.date_birth',
             'employees.mother',
             'boxes.description',
             'boxes.type'
             )
            ->get();
    }
}
