<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BoardGestion extends Component
{

    public $title;
    public $ruta;
    public $atributos;
    public $rows;
    public $orders;
    public function __construct($title, $atributos, $rows,$ruta,$orders)
    {
        $this->title = $title;
        $this->atributos = $atributos;
        $this->rows = $rows;
        $this->ruta= $ruta;
        $this->orders=$orders;
    }

    public function render(): View|Closure|string
    {
        return view('components.board-gestion');
    }
}
