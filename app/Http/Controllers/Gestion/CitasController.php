<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Obtener cédulas y servicios del profesional autenticado
        $cedulas = Cliente::where('id_profesional', $userId)->pluck('cedula');
        $servicios = Servicio::where('id_profesional', $userId)->pluck('nombre_servicio');
        $clientes = Cliente::where('id_profesional', $userId)->get(['cedula', 'nombre', 'apellido']);

        // Obtener citas y asegurarse de que se carguen las relaciones de cliente y servicio
        $citas = Cita::with(['cliente', 'servicio'])->where('id_profesional', $userId)->get();

        // Concatenar nombre y apellido del cliente y obtener el nombre del servicio
        $citas = $citas->map(function($cita) {
            $cita->nombre = $cita->cliente->nombre . ' ' . $cita->cliente->apellido;
            $cita->nombre_servicio = $cita->servicio->nombre_servicio;
            return $cita;
        });

        // Obtener las filas necesarias para la tabla de citas
        $rows = $citas->map(function($cita) {
            return [
                'fecha' => $cita->fecha,
                'hora' => $cita->hora,
                'motivo' => $cita->motivo,
                'estado' => $cita->estado,
                'nombre_servicio' => $cita->nombre_servicio,
                'nombre' => $cita->nombre,
            ];
        });

        // Definir los atributos que se usarán en la vista
        $atributos = ['fecha', 'hora', 'motivo', 'estado', 'nombre_servicio', 'nombre'];

        return view('gestion.citas', compact('citas', 'cedulas', 'clientes', 'servicios', 'atributos', 'rows'));
    }

    //agndar/guardarcita

    public function guardar(Request $request){

        

    }
}
