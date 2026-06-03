<?php

namespace App\View\Components\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Reviews extends Component
{
    public $reviews;
    public $title;

    /**
     * Create a new component instance.
     */
    public function __construct($reviews, $title = null)
    {
        $this->reviews = $reviews;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blocks.reviews');
    }
}
