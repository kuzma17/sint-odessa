<?php

namespace App\View\Components;

use App\Models\Office;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PhonesDropdown extends Component
{
    public $offices;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->offices = Office::getOffices();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.phones-dropdown');
    }
}
