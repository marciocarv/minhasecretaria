<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SigeStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class_name',
        'transport_route',
        'special_need',
        'has_bolsa_familia',
    ];
}
