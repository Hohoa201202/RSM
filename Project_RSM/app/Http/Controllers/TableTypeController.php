<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableType;
use Illuminate\Support\Facades\DB;

class TableTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    function index()
    {
        $listTableType = TableType::leftJoin('tbl_Tables', 'tbl_Tables.IdType', '=', 'dm_tbl_tabletype.IdType')
            ->select('dm_tbl_tabletype.TypeName', 'dm_tbl_tabletype.IdType', 'dm_tbl_tabletype.MaxSeats', DB::raw('COALESCE(COUNT(tbl_Tables.IdTable), 0) as TotalTable'))
            ->where('dm_tbl_tabletype.isActive', true)
            ->groupBy('dm_tbl_tabletype.TypeName', 'dm_tbl_tabletype.MaxSeats', 'dm_tbl_tabletype.IdType')
            ->orderByRaw('MAX(dm_tbl_tabletype.created_at) desc') // Sử dụng hàm tổng hợp MAX
            ->get();
        // ->paginate(5);

        return view('admin.tabletype.index', ['listTableType' => $listTableType]);
    }

    function create_post(Request $request)
    {
        $request->validate([
            'TypeName' => 'required|string',
        ], [
            'TypeName.required' => 'Tên loại bàn không được để trống',
            'TypeName.string' => 'Tên loại bàn phải là dạng chuỗi',
        ]);

        $TableType = TableType::create([
            'TypeName' => $request->input('TypeName'),
            'MaxSeats' => $request->input('MaxSeats'),
            'isActive' => true,
            'Description' => $request->input('Description') ?? ''
        ]);

        if ($TableType) {
            return redirect()->back()->withInput();
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi khi thêm loại bàn']);
    }

    public function show($IdType)
    {
        $TableType = TableType::find($IdType);
        if (!$TableType) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy thông tin']);
        }
        return view('admin.tabletype.show', ['TableType' => $TableType]);
    }

    public function edit_put(Request $request, $IdType)
    {
        $TableType = TableType::where('IdType', $IdType)
            ->update([
                'TypeName' => $request->input('TypeName'),
                'MaxSeats' => $request->input('MaxSeats'),
                'isActive' => true,
                'Description' => $request->input('Description') ?? ''
            ]);
        if ($TableType) {
            return redirect('/admin/tabletype/index');
        }
        return redirect()->back()->withErrors(['error' => 'Cập nhật thất bại, đã có lỗi xảy ra!']);
    }

    function delete($IdType)
    {
        $deleteCount = TableType::where('IdType', $IdType)->update([
            'isActive' => false
        ]);

        if ($deleteCount > 0) {
            return redirect('/admin/tabletype/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }

    function delete_all(Request $request)
    {
        $ArrDel = $request->input('ArrDel');
        $deleteCount = TableType::whereIn('IdType', $ArrDel)
            ->update([
                'isActive' => false
            ]);

        if ($deleteCount > 0) {
            return redirect('/admin/tabletype/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }
}
