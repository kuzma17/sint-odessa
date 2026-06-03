<?php

namespace App\View\Components\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Price extends Component
{
    public $prices;
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($prices, $title)
    {
        $this->prices = $prices;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blocks.price');
    }
}
