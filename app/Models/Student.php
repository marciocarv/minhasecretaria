<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mother'
    ];

    protected $dates = [
        'date_birth'
    ];

    public function bond_students(){
        return $this->HasMany(Bond_student::class);
    }

    public function check_student($name, $date_birth, $mother){
        $result = DB::table('students')
        ->where('name', '=', $name)
        ->where('date_birth', '=', $date_birth)
        ->where('mother', '=', $mother)
        ->get();

        if($result->isEmpty()){
            return false;
        }else{
            return true;
        }

    }
}
