<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'type',
    ];

    public function listBoxes(){
        return Box::paginate(50);
    }

    public function bond_students(){
        return $this->hasMany(Bond_student::class)->orderBy('order');
    }

    public function bond_employees(){
        return $this->hasMany(Bond_employee::class)->orderBy('order');
    }

    public function boxForType($type){
        return Box::where('type', $type)->orderBy('id')->get();
    }

    /*public function search($name){

        $students = Box::Join('bond_students', 'bond_students.box_id', '=', 'boxes.id')
        ->Join('students', 'bond_students.student_id', 'students.id')
        ->where('students.name', 'LIKE', '%'.$name.'%')
        ->select('boxes.id as box_id',
         'boxes.description',
         'students.id as student_id',
         'students.name',
         'students.date_birth',
         'students.mother',
         'bond_students.id as bond_students_id')
        ->get();

        dd($students);

        $employees = Box::Join('bond_employees', 'bond_employees.box_id', '=', 'boxes.id')
        ->Join('employees', 'bond_employees.employee_id', 'employees.id')
        ->where('employees.name', 'LIKE', '%'.$name.'%')
        ->select('boxes.id as box_id',
         'boxes.description',
         'employees.id as employee_id',
         'employees.name',
         'employees.date_birth',
         'employees.mother',
         'bond_employees.id as bond_employees_id')
        ->get();

        $result = $students->merge($employees);

        return $result;
    }*/
}
