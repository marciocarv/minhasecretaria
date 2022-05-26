<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'activity_end'
    ];

    public function Employee(){
        return $this->belongsTo(Employee::class);
    }
}
