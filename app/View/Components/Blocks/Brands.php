<?php

namespace App\View\Components\Blocks;

use App\Models\Brand;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Brands extends Component
{

    public $brands;
    /**
     * Create a new component instance.
     */
    public function __construct($brands)
    {
        $this->brands = $brands;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blocks.brands');
    }
}
