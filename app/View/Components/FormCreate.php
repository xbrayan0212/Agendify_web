<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormCreate extends Component
{
    public $title;
    public $ruta;

    public function __construct($title, $ruta)
    {
        $this->title = $title;
        $this->ruta = $ruta;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-create');
    }

}
