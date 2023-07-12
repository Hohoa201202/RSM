<?php

namespace App\View\Components;

use App\Models\Booking;
use App\Models\Branchs;
use App\Models\TableType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookingComponent extends Component
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
        $listBranchs = Branchs::where('isActive', true)->get();
        $listTableType = TableType::where('isActive', true)->get();

        return view('components.booking-component', ['listBranchs' => $listBranchs, 'listTableType' => $listTableType]);
    }
}
