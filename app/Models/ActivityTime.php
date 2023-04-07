<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'description'
    ];

    public function employment_bond(){
        return $this->belongsTo(Employment_bond::class);
    }
}
