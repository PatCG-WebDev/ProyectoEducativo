<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $bgColor;

    public function __construct($type)
    {
        $this->type = $type;
        $this->bgColor = $type === 'success' ? '#34D399' : '#EF4444';
    }

    public function render()
    {
        return view('components.alert');
    }
}
