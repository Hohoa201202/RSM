<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\Branchs;
use App\Models\Tables;
use App\Models\TableType;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    public function index()
    {
        $listArea = Area::leftJoin('tbl_Tables', 'tbl_Tables.IdArea', '=', 'dm_tbl_Area.IdArea')
            ->select('dm_tbl_Area.AreaName', 'dm_tbl_Area.IdArea', DB::raw('COALESCE(COUNT(tbl_Tables.IdTable), 0) as TotalTable'))
            ->where('dm_tbl_Area.isActive', true)
            ->groupBy('dm_tbl_Area.AreaName', 'dm_tbl_Area.IdArea')
            ->orderBy('dm_tbl_Area.created_at', 'desc')
            ->paginate(5);

        return view('admin.area.index', ['listArea' => $listArea]);
    }

    public function create()
    {
        $listBranchs = Branchs::where('isActive', true)->get();
        $listTableTypes = TableType::where('isActive', true)->get();
        return view('admin.area.create', ['listBranchs' => $listBranchs, 'listTableTypes' => $listTableTypes]);
    }

    public function create_post(Request $request)
    {
        $Area = Area::create([
            'AreaName' => $request->input('AreaName'),
            'IdBranch' => $request->input('IdBranch'),
            'isActive' => true,
            'Description' => $request->input('Description') ?? '',
        ]);

        if ($Area) {
            $data = [];
            if ($request->filled('Tables')) {
                foreach ($request->input('Tables') as $item) {
                    $data[] = [
                        'TableName' => $item['TableName'],
                        'IdType' => $item['IdType'],
                        'IdArea' => $Area->IdArea,
                        'IdStatus' => 1,
                        'isActive' => true
                    ];
                }
                Tables::insert($data);
            }
        }
        return response()->json(['succes' => 'Thêm khu vực thành công']);
    }

    public function show($IdArea)
    {
        $Areas = Area::find($IdArea);
        $listBranchs = Branchs::where('isActive', true)->get();
        $listTableTypes = TableType::where('isActive', true)->get();
        $TableOfAreas = Tables::join('dm_tbl_tabletype', 'dm_tbl_tabletype.IdType', '=', 'tbl_tables.IdType')
            ->where('tbl_tables.IdArea', $IdArea)
            ->where('tbl_tables.isActive', true)
            ->get()
            ->sortBy(function ($table) {
                $tableNameNumber = intval($table->TableName);
                return $tableNameNumber;
            });

        return view('admin.area.show', ['Areas' => $Areas, 'TableOfAreas' => $TableOfAreas, 'listBranchs' => $listBranchs, 'listTableTypes' => $listTableTypes]);
    }

    public function edit_post(Request $request, $IdArea)
    {

        Area::find($IdArea)
            ->update([
                'AreaName' => $request->input('AreaName'),
                'IdBranch' => $request->input('IdBranch'),
                'isActive' => true
            ]);

        $data = [];
        if ($request->filled('Tables')) {

            foreach ($request->input('Tables') as $items) {

                $data[] = [
                    'IdTable' => $items['IdTable'] ?? null,
                    'TableName' => $items['TableName'] ?? null,
                    'IdType' => $items['IdType'] ?? null,
                    'IdArea' => $IdArea,
                    'IdStatus' => 1,
                    'isActive' => true
                ];
            }

            // Xóa các bàn không có trong dữ liệu đưa vào
            Tables::where('IdArea', $IdArea)
                ->whereNotIn('IdTable', array_column($data, 'IdTable'))
                ->delete();

            foreach ($data as $item) {

                Tables::updateOrCreate(
                    [
                        'TableName' => $item['TableName'],
                        'IdType' => $item['IdType'],
                        'IdArea' => $item['IdArea'],
                        'IdStatus' => $item['IdStatus'],
                        'isActive' => $item['isActive']
                    ],
                    $item
                );
            }
        }

        return response()->json(['succes' => 'Cập nhật thành công']);
    }

    function delete($IdArea)
    {
        Tables::where('IdArea', $IdArea)->delete();
        $deleteCount = Area::where('IdArea', $IdArea)->delete();

        if ($deleteCount > 0) {
            return redirect('/admin/area/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }

    function delete_all(Request $request)
    {
        $ArrDel = $request->input('ArrDel');

        Tables::whereIn('IdArea', $ArrDel)->delete();
        $deleteCount = Area::whereIn('IdArea', $ArrDel)->delete();

        if ($deleteCount > 0) {
            return redirect('/admin/area/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }
}
