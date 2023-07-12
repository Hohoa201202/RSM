<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Combo;
use App\Models\ComboItems;
use App\Models\Items;
use App\Models\PriceList;
use Illuminate\Support\Facades\File;

class ComboController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    public function index()
    {
        $listCombo = Combo::where('isActive', true)->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.combo.index', ['listCombo' => $listCombo]);
    }

    public function create()
    {
        $listItems = Items::where('isActive', true)->get();
        $listPrice = PriceList::where('isActive', true)->get();

        return view('admin.combo.create', ['listItems' => $listItems, 'listPrice' => $listPrice]);
    }

    public function create_post(Request $request)
    {
        $request->validate([
            'ComboName' => 'required|string',
        ], [
            'ComboName.required' => 'Tên combo không được để trống',
            'ComboName.string' => 'Tên combo phải là dạng chuỗi',
        ]);
        if ($request->hasFile('Avatar')) {
            // Có chọn tệp
            $fileName =  Str::slug($request->input('ComboName'), '') . '_' . now()->format('Ymd-His') . '.' . $request->file('Avatar')->getClientOriginalExtension();
            $request->file('Avatar')->move(public_path('files/images/combo'), $fileName);
            $Avatar = $fileName;
        } else {
            // Không chọn tệp
            $Avatar = "default.png";
        }

        $Combo = Combo::create([
            'ComboName' => $request->input('ComboName'),
            'Price' => $request->input('Price') ?? 0,
            'CostPrice' => $request->input('CostPrice') ?? 0,
            'Avatar' => $Avatar,
            'isActive' => true,
            'Description' => $request->input('Description') ?? '',
        ]);
        if ($Combo) {
            $data = [];
            if ($request->filled('Items')) {
                foreach (json_decode($request->input('Items')) as $items) {
                    $data[] = [
                        'IdCombo' => $Combo->IdCombo,
                        'IdItems' => $items,
                    ];
                }
                ComboItems::insert($data);
            }
        }
        return response()->json(['success' => 'Thêm combo thành công.']);
    }

    public function show($IdCombo)
    {
        $listItems = Items::where('isActive', true)->get();
        $listPrice = PriceList::where('isActive', true)->get();
        $Combo = Combo::find($IdCombo);
        $ItemsOfCombo = ComboItems::join('tbl_items', 'tbl_items.IdItems', '=', 'tbl_combo_items.IdItems')
            ->select('tbl_items.*')
            ->where('tbl_combo_items.IdCombo', $IdCombo)->get();

        return view('admin.combo.show', ['Combo' => $Combo, 'listItems' => $listItems, 'ItemsOfCombo' => $ItemsOfCombo, 'listPrice' => $listPrice]);
    }

    public function edit_put(Request $request, $IdCombo)
    {
        $Avatar =  $request->input('Avatar');
        //Xử lý ảnh đại diện
        if ($request->hasFile('_Avatar')) { // Có chọn tệp
            //Xóa tệp cũ nếu tồn tại use Illuminate\Support\Facades\File;
            $oldImage = public_path('files/images/combo/' . $Avatar);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }

            $fileName =  Str::slug($request->input('ComboName'), '') . '_' . now()->format('Ymd-His') . '.' . $request->file('_Avatar')->getClientOriginalExtension();
            $request->file('_Avatar')->move(public_path('files/images/combo'), $fileName);
            $Avatar = $fileName;
        }

        $Combo = Combo::where('IdCombo', $IdCombo)
            ->update([
                'ComboName' => $request->input('ComboName'),
                'Price' => $request->input('Price') ?? 0,
                'CostPrice' => $request->input('CostPrice') ?? 0,
                'Avatar' => $Avatar,
            ]);

        if ($Combo) {
            ComboItems::where('IdCombo', $IdCombo)->delete();
            $data = [];
            if ($request->filled('Items')) {
                foreach (json_decode($request->input('Items')) as $items) {
                    $data[] = [
                        'IdCombo' => $IdCombo,
                        'IdItems' => $items,
                    ];
                }
                ComboItems::insert($data);
            }
        }
        return response()->json(['success' => 'Cập nhật combo thành công.']);
    }

    function delete($IdCombo)
    {
        ComboItems::where('IdCombo', $IdCombo)->update([
            'isActive' => false
        ]);
        $deleteCount = Combo::where('IdCombo', $IdCombo)->update([
            'isActive' => false
        ]);
        if ($deleteCount > 0) {
            return redirect('/admin/combo/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }

    function delete_all(Request $request)
    {
        $ArrData = $request->input('ArrData');

        ComboItems::whereIn('IdCombo', $ArrData)
            ->update([
                'isActive' => false
            ]);
        $deleteCount = Combo::whereIn('IdCombo', $ArrData)
            ->update([
                'isActive' => false
            ]);
        if ($deleteCount > 0) {
            return redirect('/admin/combo/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }
}
