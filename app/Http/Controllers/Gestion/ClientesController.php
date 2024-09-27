<?php

namespace App\Http\Controllers\Gestion;
use App\Models\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ClientesController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        // Obtener todos los nombres de las columnas de la tabla 'clientes'
        $atributos = Schema::getColumnListing('clientes');

        // Excluir las columnas que no quieres mostrar en el formulario
        $atributos = array_diff($atributos, ['id', 'id_profesional', 'created_at', 'updated_at']);
        $rows = Cliente::select('nombre','apellido','email','telefono','residencia','cedula')
        ->where('id_profesional',$userId)
        ->get();
        return view('gestion.clientes', compact('atributos','rows'));
    }



    public function guardar(Request $request)
    {
        // Validar los datos recibidos desde el formulario
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'email' => 'required|email|unique:clientes,email',
                'telefono' => 'nullable|string|max:15|unique:clientes,telefono',
                'residencia' => 'nullable|string|max:255',
                'cedula' => 'required|string|unique:clientes,cedula',
            ], [
                'nombre.required' => 'El campo nombre es obligatorio.',
                'apellido.required' => 'El campo apellido es obligatorio.',
                'email.required' => 'El campo email es obligatorio.',
                'email.email' => 'El campo email debe ser una dirección de correo válida.',
                'email.unique' => 'El correo electrónico ya está en uso.',
                'telefono.unique' => 'El número de teléfono ya está en uso.',
                'cedula.required' => 'El campo cédula es obligatorio.',
                'cedula.unique' => 'La cédula ya está en uso.',
            ]);

            $userId = Auth::id();
            Cliente::create(array_merge($validatedData, ['id_profesional' => $userId]));

            return redirect()->route('clientes')->with('success', 'Cliente guardado exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('clientes')->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->route('clientes')->with('error', 'Error al guardar el cliente: ' . $e->getMessage());
        }
    }

}
