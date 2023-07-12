<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Units;
use App\Models\Items;

class UnitsControler extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    public function index()
    {
        $listCategories = Units::leftJoin('tbl_items', 'tbl_items.IdUnit', '=', 'dm_tbl_categories.IdUnit')
            ->select('dm_tbl_categories.UnitName', 'dm_tbl_categories.IdUnit', DB::raw('COALESCE(COUNT(tbl_items.IdItems), 0) as TotalItems'))
            ->where('dm_tbl_categories.isActive', true)
            ->groupBy('dm_tbl_categories.UnitName', 'dm_tbl_categories.IdUnit')
            ->orderBy('dm_tbl_categories.created_at', 'desc')
            ->paginate(5);

        return view('admin.unit.index', ['listCategories' => $listCategories]);
    }

    public function create()
    {
        return view('admin.unit.create');
    }

    function create_post(Request $request)
    {
        $request->validate([
            'UnitName' => 'required|string'
        ], [
            'UnitName.required' => 'Tên đơn vị tính không được để trống',
            'UnitName.string' => 'Tên đơn vị tính phải là dạng chuỗi'
        ]);

        $Unit = Units::create([
            'UnitName' => $request->input('UnitName') ?? '',
            'isActive' => true,
            'Description' => $request->input('Description') ?? ''
        ]);

        if ($Unit) {
            return redirect()->back()->withInput();
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi khi thêm đơn vị tính mặt hàng']);
    }

    public function show($IdUnit)
    {
        $Unit = Units::find($IdUnit);
        if (!$Unit) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy thông tin']);
        }
        $listItems = Items::where('IdUnit', $IdUnit)->get();
        return view('admin.unit.show', ['Unit' => $Unit, 'listItems' => $listItems]);
    }

    public function edit_put(Request $request, $IdUnit)
    {
        $Unit = Units::where('IdUnit', $IdUnit)
            ->update([
                'UnitName' => $request->input('UnitName'),
            ]);
        if ($Unit) {
            return redirect('/admin/Unit/index');
        }
        return redirect()->back()->withErrors(['error' => 'Cập nhật thất bại, đã có lỗi xảy ra!']);
    }

    function delete($IdUnit)
    {
        $deleteCount = Units::where('IdUnit', $IdUnit)->update([
            'isActive' => false
        ]);

        if ($deleteCount > 0) {
            return redirect('/admin/Unit/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }

    function delete_all(Request $request)
    {
        $ArrDel = $request->input('ArrDel');
        $deleteCount = Units::whereIn('IdUnit', $ArrDel)
            ->update([
                'isActive' => false
            ]);

        if ($deleteCount > 0) {
            return redirect('/admin/Unit/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }
}
