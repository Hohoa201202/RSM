<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuWeb;

class MenuWebController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    public function index()
    {
        $listMenus = MenuWeb::where('isActive', true)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('admin.menuweb.index', ['listMenus' => $listMenus]);
    }

    public function create()
    {
        $listMenus = MenuWeb::where('isActive', true)
            ->orderBy('Lever', 'asc')
            ->get();
        return view('admin.menuweb.create', ['listMenus' => $listMenus]);
    }

    function create_post(Request $request)
    {
        $request->validate([
            'MenuName' => 'required|string',
            'Order' => 'nullable|integer|min:1',
        ], [
            'MenuName.required' => 'Tên danh mục không được để trống',
            'MenuName.string' => 'Tên danh mục phải là dạng chuỗi',
            'Order.integer' => 'Thứ tự sắp xếp phải là số nguyên lớn hơn 0',
            'Order.min' => 'Thứ tự sắp xếp phải là số nguyên lớn hơn 0'
        ]);

        $menu = MenuWeb::create([
            'MenuName' => $request->input('MenuName') ?? '',
            'ControllerName' => $request->input('ControllerName') ?? null,
            'ActionName' => $request->input('ActionName') ?? null,
            'Lever' => $request->input('Lever') ?? 0,
            'ParentId' => $request->input('ParentId') ?? 0,
            'Position' => $request->input('Position') ?? '',
            'Order' => $request->input('Order') ?? null,
            'UserCreated' => '',
            'UserEdit' => '',
            'Icon' => '',
            'isActive' => true,
        ]);

        if ($menu) {
            return redirect('/admin/menu/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi khi thêm danh mục mặt hàng']);
    }

    public function show($IdMenu)
    {
        $menu = MenuWeb::find($IdMenu);
        if (!$menu) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy thông tin']);
        }

        $listMenus = MenuWeb::where('isActive', true)
            ->orderBy('Lever', 'asc')
            ->get();

        return view('admin.menuweb.show', ['menu' => $menu, 'listMenus' => $listMenus, 'listMenus' => $listMenus]);
    }

    public function edit_put(Request $request, $IdMenu)
    {
        $request->validate([
            'MenuName' => 'required|string',
            'Order' => 'nullable|integer|min:1',
        ], [
            'MenuName.required' => 'Tên danh mục không được để trống',
            'MenuName.string' => 'Tên danh mục phải là dạng chuỗi',
            'Order.integer' => 'Thứ tự sắp xếp phải là số nguyên lớn hơn 0',
            'Order.min' => 'Thứ tự sắp xếp phải là số nguyên lớn hơn 0'
        ]);

        $menu = MenuWeb::where('IdMenu', $IdMenu)
            ->update([
                'MenuName' => $request->input('MenuName') ?? '',
                'ControllerName' => $request->input('ControllerName') ?? null,
                'ActionName' => $request->input('ActionName') ?? null,
                'Lever' => $request->input('Lever') ?? 0,
                'ParentId' => $request->input('ParentId') ?? 0,
                'Position' => $request->input('Position') ?? '',
                'Order' => $request->input('Order') ?? null,
                'UserCreated' => '',
                'UserEdit' => '',
                'Icon' => '',
                'isActive' => true,
            ]);

        if ($menu) {
            return redirect('/admin/menu/index');
        }
        return redirect()->back()->withErrors(['error' => 'Cập nhật thất bại, đã có lỗi xảy ra!']);
    }

    function delete($IdMenu)
    {
        $deleteCount = MenuWeb::where('IdMenu', $IdMenu)->update([
            'isActive' => false
        ]);

        if ($deleteCount > 0) {
            return redirect('/admin/menu/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }

    function delete_all(Request $request)
    {
        $ArrDel = $request->input('ArrDel');
        $deleteCount = MenuWeb::whereIn('IdMenu', $ArrDel)
            ->update([
                'isActive' => false
            ]);

        if ($deleteCount > 0) {
            return redirect('/admin/menu/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }
}
