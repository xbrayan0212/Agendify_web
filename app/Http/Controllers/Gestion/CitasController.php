<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Historial;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CitasController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
    
        // Obtener cédulas y servicios del profesional autenticado
        $cedulas = Cliente::where('id_profesional', $userId)->pluck('cedula');
        $servicios = Servicio::where('id_profesional', $userId)->get(['id', 'nombre_servicio']);
        $clientes = Cliente::where('id_profesional', $userId)->get(['id', 'cedula', 'nombre', 'apellido']);
    
        // Obtener citas y asegurarse de que se carguen las relaciones de cliente y servicio
        $citas = Cita::with(['cliente', 'servicio'])->where('id_profesional', $userId)->get();
    
        // Concatenar nombre y apellido del cliente y obtener el nombre del servicio
        $citas = $citas->map(function($cita) {
            $cita->nombre = $cita->cliente->nombre . ' ' . $cita->cliente->apellido;
            $cita->nombre_servicio = $cita->servicio->nombre_servicio;
            $cita->hora = Carbon::parse($cita->hora)->format('g:i A'); // Formatear la hora a 'g:i A'
            return $cita;
        });
    
        // Obtener las filas necesarias para la tabla de citas
        $rows = $citas->map(function($cita) {
            return [
                'fecha' => $cita->fecha,
                'hora' => $cita->hora,
                'id' => $cita->id,
                'motivo' => $cita->motivo,
                'estado' => $cita->estado,
                'nombre_servicio' => $cita->nombre_servicio,
                'nombre' => $cita->nombre,
            ];
        });
    
        $sort = $request->input('sort', 'fecha');
        // Ordenar las filas según el parámetro recibido
        $rows = $rows->sortBy($sort);
    
        // Definir los atributos que se usarán en la vista
        $atributos = ['fecha', 'hora', 'motivo', 'estado', 'nombre_servicio', 'nombre'];
    
        return view('gestion.citas', compact('citas', 'cedulas', 'clientes', 'servicios', 'atributos', 'rows'));
    }
    

    //agndar/guardarcita
    public function guardar(Request $request)
    {
        // Validar los datos del formulario
        $validate = $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'servicio' => 'required|exists:servicios,id',
            'motivo' => 'string|max:255',
        ], [
            'fecha.required' => 'El campo fecha es obligatorio.',
            'hora.required' => 'El campo hora es obligatorio.',
            'servicio.required' => 'Debes seleccionar un servicio.',
            'servicio.exists' => 'El servicio seleccionado no existe. Debes crear un servicio primero.',
        ]);

        try {
            // Crear una nueva cita
            $cita = new Cita();
            $cita->fecha = $request->input('fecha');
            $cita->hora = $request->input('hora');
            $cita->motivo = $request->input('motivo');
            $cita->estado = "Pendiente";
            $cita->id_cliente=$request->input('cedula');
            $cita->id_servicio = $request->input('servicio');
            $cita->id_profesional = Auth::id();
            $cita->save();

             // Crear un nuevo registro en el historial
            Historial::create([
                'fecha_consulta' => $cita->fecha,
                'observaciones' => '-', 
                'id_cita' => $cita->id,
                'id_profesional'=>Auth::id(),
            ]);

            // Redireccionar con éxito
            return redirect()->route('citas')->with('success', 'Cita guardada exitosamente.');

        } catch (\Illuminate\Validation\ValidationException $e){
            return redirect()->route('citas')->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Manejo de error
            return back()->withErrors(['error' => 'Ocurrió un error al guardar la cita.' . $e->getMessage()]);
        }
    }

    public function eliminar($id)
    {
        $userId = Auth::id();
    
        // Buscar la cita por su ID y asegurarse de que pertenece al profesional autenticado
        $cita = Cita::where('id', $id)->where('id_profesional', $userId)->first();
    
        if (!$cita) {
            // Redireccionar con error si la cita no se encuentra o no pertenece al usuario
            return redirect()->route('citas')->withErrors(['error' => 'Cita no encontrada o no autorizada para eliminar.']);
        }
    
        try {
            // Eliminar el registro correspondiente en el historial si existe
            $historial = Historial::where('id_cita', $cita->id)->first();
            if ($historial) {
                $historial->delete();
            }
    
            // Eliminar la cita
            $cita->delete();
    
            // Redireccionar con éxito
            return redirect()->route('citas')->with('success', 'Cita eliminada exitosamente.');
    
        } catch (\Exception $e) {
            // Manejo de error
            return back()->withErrors(['error' => 'Ocurrió un error al eliminar la cita. ' . $e->getMessage()]);
        }
    }
    
public function update(Request $request)
{
    $userId = Auth::id();

    // Validar los datos del formulario
    $validatedData = $request->validate([
        'idCita' => 'required|exists:citas,id',
        'fecha' => 'required|date',
        'hora' => 'required',
        'servicio' => 'required|exists:servicios,id',
        'motivo' => 'nullable|string|max:255',
        'estado' => 'required|string',
    ], [
        'idCita.required' => 'El ID de la cita es obligatorio.',
        'idCita.exists' => 'La cita no existe.',
        'fecha.required' => 'El campo fecha es obligatorio.',
        'hora.required' => 'El campo hora es obligatorio.',
        'servicio.required' => 'El campo servicio es obligatorio.',
        'servicio.exists' => 'El servicio seleccionado no es válido.',
        'estado.required' => 'El campo estado es obligatorio.',
    ]);

    try {
        // Encontrar la cita por ID y asegurarse de que pertenece al profesional autenticado
        $cita = Cita::where('id', $validatedData['idCita'])->where('id_profesional', $userId)->firstOrFail();

        // Actualizar la cita con los datos validados
        $cita->fecha = $validatedData['fecha'];
        $cita->hora = $validatedData['hora'];
        $cita->motivo = $validatedData['motivo'];
        $cita->estado = $validatedData['estado'];
        $cita->id_servicio = $validatedData['servicio'];
        $cita->save();

        // Actualizar o crear un registro en el historial
        Historial::updateOrCreate(
            ['id_cita' => $cita->id], // Condición para encontrar el historial existente
            [
                'fecha_consulta' => $validatedData['fecha'],
            ]
        );

        // Redireccionar con éxito
        return redirect()->route('citas')->with('success', 'Cita y historial actualizados exitosamente.');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('citas')->withErrors(['error' => 'Cita no encontrada o no tienes permiso para editarla.']);
    } catch (\Exception $e) {
        return redirect()->route('citas')->withErrors(['error' => 'Ocurrió un error al actualizar la cita: ' . $e->getMessage()]);
    }
}
}
