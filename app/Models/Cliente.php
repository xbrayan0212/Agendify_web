<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'residencia',
        'cedula',
        'id_profesional',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_cliente');
    }
}
