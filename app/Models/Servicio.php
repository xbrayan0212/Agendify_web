<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_servicio',
        'descripcion',
        'id_profesional',
    ];

    public function profesional()
    {
        return $this->belongsTo(User::class, 'id_profesional');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_servicio');
    }
}
