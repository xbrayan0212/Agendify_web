<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableComponent extends Component
{

    public $title;
    public $headers;
    public $rows;

    public function __construct($title, $headers, $rows)
    {
        $this->title = $title;
        $this->headers = $headers;
        $this->rows = $rows;
    }

    public function render(): View|Closure|string
    {
        return view('components.table-component');
    }
}
