<?php

namespace App\View\Components\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WorkFlow extends Component
{

    public $title;
    public $steps;
    /**
     * Create a new component instance.
     */
    public function __construct($steps, $title)
    {
        $this->steps = $steps;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blocks.workflow');
    }
}
