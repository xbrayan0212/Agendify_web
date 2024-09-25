<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'hora',
        'motivo',
        'estado',
        'id_profesional',
        'id_cliente',
        'id_servicio',
    ];

    public function profesional()
    {
        return $this->belongsTo(User::class, 'id_profesional');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

    public function historial()
    {
        return $this->hasOne(Historial::class, 'id_cita');
    }

    public function recordatorios()
    {
        return $this->hasMany(Recordatorio::class, 'id_cita');
    }
}
