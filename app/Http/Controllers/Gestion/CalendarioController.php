<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Historial;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el mes y el año actuales o desde la petición
        $fechaActual = Carbon::parse($request->get('date', now()));

        // Generar días del mes
        $meses = [];
        $diasEnElMes = $fechaActual->daysInMonth;
        $inicioDelMes = $fechaActual->copy()->startOfMonth()->format('w');

        // Obtener las citas del mes
        $userId = Auth::id();
        $citas = Cita::where('id_profesional', $userId)
            ->whereMonth('fecha', $fechaActual->month)
            ->whereYear('fecha', $fechaActual->year)
            ->with(['cliente', 'servicio'])
            ->get();


        // Agrupar citas por fecha
        $citasPorDia = [];
        foreach ($citas as $cita) {
            // Obtener la primera observación, si existe
            $observaciones_cita = Historial::where('id_profesional', $userId)
                ->where('id_cita', $cita->id)
                ->pluck('observaciones')
                ->first(); // Obtiene el primer valor de la colección o null si no hay registros
            
            $citasPorDia[$cita->fecha][] = [
                'id' => $cita->id,
                'nombre' => $cita->cliente->nombre . ' ' . $cita->cliente->apellido,
                'servicio' => $cita->servicio->nombre_servicio,
                'estado' => $cita->estado,
                'hora' => Carbon::parse($cita->hora)->format('H:i'), // Formato 24 horas
                'motivo' => $cita->motivo,
                'observaciones' => $observaciones_cita, // Puede ser una cadena o null
            ];
        }


        for ($dia = 1; $dia <= $diasEnElMes; $dia++) {
            $fecha = Carbon::create($fechaActual->year, $fechaActual->month, $dia);
            $meses[] = [
                'fecha' => $fecha,
                'dia' => $dia,
                'diaDeLaSemana' => $fecha->format('l'),
                'citas' => $citasPorDia[$fecha->format('Y-m-d')] ?? [], // Citas del día
            ];
        }

        return view('gestion.calendario', compact('meses', 'inicioDelMes', 'fechaActual'));
    }
    public function change_cita_details(Request $request){
        $userId = Auth::id();
        try{

            $validatedData = $request->validate([
                'id' => 'required|integer|exists:citas,id',
               'estado' => 'required|string',
               'observaciones'=>'nullable|string|max:255',
            ]);

            //actualizar campo de estado en la Tabla Cita//
    
            Cita::where('id_profesional', $userId)
            ->where('id', $validatedData['id'])
            ->update([
                'estado' => $validatedData['estado'],
            ]);

            //actualizar el campo de observaciones de la Tabla Historial

            Historial::where('id_profesional',$userId)
            ->where('id_cita',$validatedData['id'])
            ->update([
                'observaciones'=>$validatedData['observaciones']
            ]);

            //retorna exito :)
            return redirect()->route('calendario')->with('succes','Actualizacion de  campos de la Cita exitoso');


        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('calendario')->withErrors('Error ');
        } catch (\Exception $e) {
            return redirect()->route('calendario')->withErrors(['error' => 'Ocurrió un error al actualizar estado de la Cita: ' . $e->getMessage()]);
        }
}
}