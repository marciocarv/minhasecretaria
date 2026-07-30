<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', // Day of week like 'Monday'
        'type',        // 'activity_time' or 'fixed_off'
        'shift',       // 'matutino', 'vespertino'
        'employment_bond_id'
    ];

    public function employment_bond(){
        return $this->belongsTo(Employment_bond::class);
    }
}
