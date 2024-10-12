<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Cita;
use App\Models\Historial;
use App\Models\Servicio;
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
            ->where('estado','Pendiente')
            ->get()
            ->map(function ($cita) {
                $cita->hora = Carbon::parse($cita->hora)->format('g:i A'); // Formatear la hora a 'g:i A'
                return $cita;
            });
    
        // Obtener los servicios
        $servicios = Servicio::select('nombre_servicio', 'descripcion', 'id')
            ->where('id_profesional', $userId)
            ->get();
        
        $historial = Historial::with(['cita' => function ($query) {
            $query->select('id', 'estado', 'id_cliente'); // Incluye 'estado' en los datos de la cita
        }, 'cita.cliente'])
        ->whereHas('cita', function ($query) use ($userId) {
            $query->where('id_profesional', $userId);
        })
        ->get();
    
        // Datos para la grafica
        $citasPorEstado = Cita::select('estado', Cita::raw('count(*) as total'))
        ->where('id_profesional', $userId)
        ->groupBy('estado')
        ->pluck('total', 'estado');
    
        $labels = $citasPorEstado->keys();
        $totales = $citasPorEstado->values();
    
        // Pasar las variables a la vista
        return view('dashboard', compact('clientes', 'citas', 'historial', 'clientesRegistradosMes', 'citasPendientesMes', 'citasFinalizadasMes', 'labels', 'totales', 'servicios'));
    }
    

    public function gServicio(Request $request){

        //obtenemos id
        $userId = Auth::id(); 

        $validate = $request->validate([
            'nombre_servicio'=> 'required|string|max:250',
            'descripcion'=> 'required|string|max:250',
        ],[
            'nombre_servicio.requered'=>'EL campo nombre-Servicio Obligatorio'
        ]);


        try {
            //guardamos el Servicio
            $servicio = new Servicio();
            $servicio->nombre_servicio =$request->input('nombre_servicio');
            $servicio->descripcion= $request->input('descripcion');
            $servicio->id_profesional = Auth::id();
            $servicio->save();

            //redirijimos correctamente
            return redirect()->route('dashboard')->with('success', 'Cita guardada exitosamente.');


        }catch(\Illuminate\Validation\ValidationException $e){
            return redirect()->route('dashboard')->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Manejo de error
            return back()->withErrors(['error' => 'Ocurrió un error al guardar la cita.' . $e->getMessage()]);
        }
    }

    public function eServicio($id)
    {
        $servicio = Servicio::find($id);
        if ($servicio) {
            $servicio->delete();
            return redirect()->route('dashboard')->with('success', 'Servicio eliminado correctamente.');
        }
    
        return redirect()->route('dashboard')->with('error', 'Servicio no encontrado.');
    }

    public function uServicio(Request $request){
        try{
            $userId = Auth::id();

            $validate = $request->validate([
                'nombre_servicio'=> 'required|string|max:250',
                'descripcion'=> 'required|string|max:250',
            ],[
                'nombre_servicio.requered'=>'EL campo nombre-Servicio Obligatorio'
            ]);
    
            $servicio = Servicio::where('id',$request->id)->where('id_profesional',$userId)->firstOrFail();
            $servicio->update(array_merge($validate, ['id_profesional' => Auth::id()]));

            return redirect()->route('dashboard')->with('success', 'Servicio actualizado exitosamente.');
        }catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('dashboard')->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Error al guardar el Servicio: ' . $e->getMessage());
        }

    }
    
}
