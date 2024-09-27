<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Cita;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Obtiene el ID del usuario que ha iniciado sesión

        // Obtener el inicio y fin del mes actual
        $inicioDelMes = Carbon::now()->startOfMonth();
        $finDelMes = Carbon::now()->endOfMonth();

        // Consultas combinadas para obtener datos necesarios
        $clientes = Cliente::select('nombre', 'apellido', 'telefono')
            ->where('id_profesional', $userId)
            ->get();

        $citasPendientesMes = Cita::where('id_profesional', $userId)
            ->where('estado', 'pendiente')
            ->whereBetween('fecha', [$inicioDelMes, $finDelMes])
            ->count();

        $citasFinalizadasMes = Cita::where('id_profesional', $userId)
            ->where('estado', 'finalizada')
            ->whereBetween('fecha', [$inicioDelMes, $finDelMes])
            ->count();

        $clientesRegistradosMes = Cliente::where('id_profesional', $userId)
            ->whereBetween('created_at', [$inicioDelMes, $finDelMes])
            ->distinct('id')
            ->count('id');

        // Obtener las citas agendadas y el historial
        $citas = Cita::select('fecha', 'hora', 'estado')
            ->where('id_profesional', $userId)
            ->get();

        $historial = Historial::with(['cita.cliente'])
            ->whereHas('cita', function ($query) use ($userId) {
                $query->where('id_profesional', $userId);
            })
            ->get();


            // Datos para la grafica
        $citasPorEstado = Cita::select('estado', \DB::raw('count(*) as total'))
        ->where('id_profesional', $userId)
        ->groupBy('estado')
        ->pluck('total', 'estado');

        $labels = $citasPorEstado->keys();
        $totales = $citasPorEstado->values();


        // Pasar las variables a la vista
      return view('dashboard', compact('clientes', 'citas', 'historial', 'clientesRegistradosMes', 'citasPendientesMes', 'citasFinalizadasMes', 'labels', 'totales'));

    }
}
