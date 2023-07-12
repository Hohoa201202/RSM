<?php

namespace App\View\Components;

use App\Models\Items;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menus;

class MenusComponent extends Component
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
        $listMenus = Menus::where('isActive', true)
            ->get();

        $listItems = Items::join('tbl_menus_items', 'tbl_menus_items.IdItems', '=', 'tbl_items.IdItems')
            ->leftjoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_items.IdItems')
            ->where('tbl_items.isActive', true)
            ->select('tbl_items.*', 'tbl_menus_items.IdMenu', 'tbl_pricelist.SalePrice')
            ->get();

        if ($listMenus->count() > 0) {
            return view('components.menus-component', ['listMenus' => $listMenus, 'listItems' => $listItems]);
        }
        return view('components.menus-component', ['listMenus' => '', 'listItems' => '']);
    }
}
