<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Bond_student extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'status',
        'entry_year',
        'exit_year',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function box(){
        return $this->belongsTo(Box::class);
    }

    public function search($name){
        return DB::table('bond_students')
            ->join('boxes', 'boxes.id', 'bond_students.box_id')
            ->join('students', 'students.id', 'bond_students.student_id')
            ->where('students.name', 'LIKE', '%'.$name.'%')
            ->select('bond_students.*',
             'students.name', 
             'students.date_birth',
             'students.mother',
             'boxes.description',
             'boxes.type'
             )
            ->get();
    }
}
