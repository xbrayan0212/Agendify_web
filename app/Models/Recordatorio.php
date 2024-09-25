<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_envio',
        'tipo',
        'estado',
        'id_cita',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }
}
