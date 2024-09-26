<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Cita;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Obtiene el ID del usuario que ha iniciado sesión

        // Obtén la lista de clientes relacionados con el profesional
        $clientes = Cliente::select('nombre', 'telefono')
            ->where('id_profesional', $userId)
            ->get();

        // Obtén las citas agendadas para el profesional
        $citas = Cita::select('fecha', 'hora', 'estado')
            ->where('id_profesional', $userId)
            ->get();

        // Obtén el historial de citas con el nombre del cliente
        $historial = Historial::with(['cita.cliente'])
            ->whereHas('cita', function ($query) use ($userId) {
                $query->where('id_profesional', $userId);
            })
            ->get();

        foreach ($historial as $item) {
            $item->cliente_nombre = $item->cita->cliente->nombre;
        }

        return view('dashboard', compact('clientes', 'citas', 'historial'));
    }
}
