<?php

namespace App\View\Components;

use App\Models\Slide;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SlideComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $slides = Slide::where('isActive', true)
            ->where('Position', 1)
            ->orderby('Order')
            ->get();
        return view('components.slide-component', ['slides' => $slides]);
    }
}
