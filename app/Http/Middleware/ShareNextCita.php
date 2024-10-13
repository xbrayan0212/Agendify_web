<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;
use Carbon\Carbon;

class ShareNextCita
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $nextCita = Cita::where('id_profesional', Auth::id())
                ->where('estado', 'Pendiente')
                ->whereDate('fecha', '>=', Carbon::today())
                ->orderBy('fecha', 'asc')
                ->first();

            if ($nextCita) {
                $fechaCita = Carbon::parse($nextCita->fecha);

                // Calcula la diferencia en días, incluyendo fracciones.
                $diasFaltantes = now()->diffInDays($fechaCita, false);

                // Asegura que los días faltantes sean 0 si es el mismo día
                if (now()->isSameDay($fechaCita)) {
                    $diasFaltantes = 0;
                } elseif ($diasFaltantes < 0) {
                    $diasFaltantes = ceil(abs(now()->floatDiffInHours($fechaCita) / 24));
                } else {
                    $diasFaltantes = ceil($diasFaltantes);
                }
            } else {
                $diasFaltantes = null;
            }

            view()->share('diasFaltantes', $diasFaltantes);
        } else {
            view()->share('diasFaltantes', null);
        }

        return $next($request);
    }
}
