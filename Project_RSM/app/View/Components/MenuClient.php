<?php

namespace App\View\Components;

use App\Models\MenuWeb;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\MenuWebAdminModel;

class MenuClient extends Component
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

        $listMenu = MenuWeb::where('isActive', 1)
            ->where('Position', 1)
            ->orderBy('Order')
            ->get();

        return view('components.menu-client', ['listMenu' => $listMenu]);
    }
}
