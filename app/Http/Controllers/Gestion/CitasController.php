<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    public function index()
    {

        $userId = Auth::id();
        $cedulas = Cliente::where('id_profesional', $userId)->pluck('cedula');
        $servicios = Servicio::where('id_profesional',$userId)->pluck('nombre_servicio');
        $clientes = Cliente::where('id_profesional', $userId)->get(['cedula', 'nombre', 'apellido']);

        $citas = Cita::all();
        return view('gestion.citas', compact('citas','cedulas','clientes','servicios'));
    }

}


