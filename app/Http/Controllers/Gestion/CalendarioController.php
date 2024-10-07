<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el mes y el año actuales o desde la petición
        $currentDate = Carbon::parse($request->get('date', now()));

        // Generar días del mes
        $months = [];
        $daysInMonth = $currentDate->daysInMonth;
        $startOfMonth = $currentDate->copy()->startOfMonth()->format('w');

        // Obtener las citas del mes
        $userId = Auth::id();
        $citas = Cita::where('id_profesional', $userId)
            ->whereMonth('fecha', $currentDate->month)
            ->whereYear('fecha', $currentDate->year)
            ->with(['cliente', 'servicio'])
            ->get();

        // Agrupar citas por fecha
        $citasPorDia = [];
        foreach ($citas as $cita) {
            $citasPorDia[$cita->fecha][] = [
                'nombre' => $cita->cliente->nombre . ' ' . $cita->cliente->apellido,
                'servicio' => $cita->servicio->nombre_servicio,
                'hora' => Carbon::parse($cita->hora)->format('H:i'), // Formato 24 horas
                'motivo' => $cita->motivo,
            ];
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($currentDate->year, $currentDate->month, $day);
            $months[] = [
                'date' => $date,
                'day' => $day,
                'dayOfWeek' => $date->format('l'),
                'citas' => $citasPorDia[$date->format('Y-m-d')] ?? [], // Citas del día
            ];
        }

        return view('gestion.calendario', compact('months', 'startOfMonth', 'currentDate'));
    }
}
