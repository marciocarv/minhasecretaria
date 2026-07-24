<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // NEW: Eloquent Local Scope for searching by student name
    public function scopeSearchByName($query, $name)
    {
        if (!empty($name)) {
            // whereHas allows us to query the related 'students' table easily
            return $query->whereHas('student', function ($q) use ($name) {
                $q->where('name', 'LIKE', '%' . $name . '%');
            });
        }
        return $query;
    }
}



/*namespace App\Models;

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
}*/
