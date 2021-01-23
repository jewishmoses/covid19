<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Column extends Component
{
    public $name;
    public $value;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.column');
    }
}
