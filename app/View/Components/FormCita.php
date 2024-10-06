<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormCita extends Component
{
    public $clientes;
    public $servicios;
    public $atributos;

    public function __construct($clientes, $servicios, $atributos)
    {
        $this->clientes = $clientes;
        $this->servicios = $servicios;
        $this->atributos = $atributos;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-cita');
    }
}
