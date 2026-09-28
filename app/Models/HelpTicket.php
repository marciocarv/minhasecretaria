<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'responsible', 
        'subject', 
        'report', 
        'status', 
        'attended_at', 
        'finished_at'
    ];

    protected $dates = ['attended_at', 'finished_at'];
}
