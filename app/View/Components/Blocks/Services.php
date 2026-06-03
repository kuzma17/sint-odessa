<?php

namespace App\View\Components\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Services extends Component
{
    public $services;
    public $mode;
    /**
     * Create a new component instance.
     */
    public function __construct($services, $mode='all')
    {
        $this->services = $services;
        $this->mode = $mode;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blocks.services');
    }
}
