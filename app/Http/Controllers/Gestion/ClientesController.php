<?php

namespace App\Http\Controllers\Gestion;
use App\Models\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

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

}
