<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = 'leaves';

    protected $fillable = [
        'employment_bond_id', // <-- ADICIONADO AQUI
        'start_date',
        'end_date',
        'type',
        'description',   
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    public function getTypeNameAttribute()
    {
        $types = [
            'medical'  => 'Licença Médica',
            'vacation' => 'Férias',
            'recess'   => 'Recesso',
            'off_tre'  => 'Folga TRE',
        ];

        return $types[$this->type] ?? 'Outros';
    }

    public function employee()
    {
        return $this->belongsTo(Employment_bond::class);
    }
}