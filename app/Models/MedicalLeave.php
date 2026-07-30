<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employment_bond_id',
        'start_date',
        'end_date',
        'reason'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    // Relacionamento inverso: Uma licença pertence a um vínculo
    public function employment_bond()
    {
        return $this->belongsTo(Employment_bond::class);
    }
}