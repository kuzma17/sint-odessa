<?php

namespace App\View\Components\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Problems extends Component
{
    public $problems;
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($problems, $title)
    {
        $this->problems = $problems;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blocks.problems');
    }
}
