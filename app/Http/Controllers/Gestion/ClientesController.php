<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class ClientesController extends Controller
{
    public function index()
    {
        // Obtener todos los nombres de las columnas de la tabla 'clientes'
        $atributos = Schema::getColumnListing('clientes');

        // Excluir las columnas que no quieres mostrar en el formulario
        $atributos = array_diff($atributos, ['id', 'id_profesional', 'created_at', 'updated_at']);

        // Pasar los nombres de las columnas filtradas a la vista
        return view('gestion.clientes', compact('atributos'));
    }

}
