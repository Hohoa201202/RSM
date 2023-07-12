<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\MenuWebAdminModel;

class MenuAdmin extends Component
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
        if (session()->has('UserName')) { //Nếu có đăng nhập
            $listMenuOfRole = MenuWebAdminModel::join('ht_tbl_Role', 'ht_tbl_adminwebmenu.IdMenuAdmin', '=', 'ht_tbl_Role.IdMenuAdmin') //Join với bảng phân quyền đề lấy ra các menu cho phép
                ->select('ht_tbl_adminwebmenu.*', 'ht_tbl_Role.IdGroup')
                ->where('IdGroup', session()->get('IdGroup'))
                ->where('isActive', 1)
                ->where('Position', 1)
                ->orderBy('Order')
                ->get();

            $listMenu = MenuWebAdminModel::where('isActive', 1)->where('Position', 1)->get();

            return view('components.menu-admin', ['listMenuOfRole' => $listMenuOfRole, 'listMenu' => $listMenu]);
        }
        return view('components.menu-admin');
    }
}
