<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_censo',
        'name',
        'father',
        'mother',
        'naturalness',
        'marital_status',
        'sex',
        'color',
        'phone',
        'certificate_type',
        'certificate_term',
        'certificate_book',
        'certificate_sheet',
        'adress',
        'cep',
        'rg',
        'rg_expedition',
        'cpf',
        'bank_name',
        'bank_agency',
        'bank_number',
        'schooling',
        'course_name',
        'course_status',
        'name_college',
        'conclusion',
        'admission'
    ];

    protected $dates = [
        'date_birth',
        'rg_expedition',
        'admission'
    ];

    public function bond_employees(){
        $this->hasMany(Bond_employee::class);
    }

    public function employment_bonds(){
        $this->hasMany(Employment_bond::class);
    }
}
