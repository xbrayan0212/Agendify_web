<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $table = 'historial'; 
    protected $fillable = [
        'fecha_consulta',
        'observaciones',
        'id_cita',
        'id_profesional'
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }
    public function profesional()
    {
        return $this->belongsTo(User::class, 'id_profesional');
    }
}

