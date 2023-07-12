<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Category;
use App\Models\PriceList;
use App\Models\Units;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    public function index()
    {
        $listItems = Items::leftjoin('dm_tbl_Unit', 'dm_tbl_Unit.IdUnit', '=', 'tbl_items.Unit')
            ->join('dm_tbl_Categories', 'dm_tbl_Categories.IdCategory', '=', 'tbl_items.IdCategory')
            ->select('tbl_items.*', 'dm_tbl_Unit.UnitName', 'dm_tbl_unit.isActive as UnitActive', 'dm_tbl_Categories.CategoryName')
            ->where('tbl_items.isActive', true)
            ->orderBy('tbl_items.created_at', 'desc')->get();
        $listPrice = PriceList::where('isActive', true)->get();

        return view('admin.items.index', ['listItems' => $listItems, 'listPrice' => $listPrice]);
    }

    public function create()
    {
        $listCategory = Category::where('isActive', true)->get();
        $listUnit = Units::where('isActive', true)->get();
        return view('admin.items.create', ['listCategory' => $listCategory], ['listUnit' => $listUnit]);
    }

    public function create_post(Request $request)
    {
        $request->validate([
            'ItemsName' => 'required|string',
            'IdCategory' => 'required|exists:dm_tbl_categories,IdCategory'
            // 'TenSanPham' => 'required|string|unique:tbl_sanpham',
            // 'GiamGia' => 'required|integer|min:0|max:100',
            // 'GiaTien' => 'required|integer|min:0|max:10000000',
        ], [
            'ItemsName.required' => 'Tên mặt hàng không được để trống',
            'ItemsName.string' => 'Tên mặt hàng phải là dạng chuỗi',
            'IdCategory.required' => 'Vui lòng chọn loại mặt hàng',
            'IdCategory.exists' => 'Loại mặt hàng không tồn tại trong hệ thống'
        ]);
        if ($request->hasFile('Avatar')) {
            // Có chọn tệp
            $fileName =  Str::slug($request->input('ItemsName'), '') . '_' . now()->format('Ymd-His') . '.' . $request->file('Avatar')->getClientOriginalExtension();
            $request->file('Avatar')->move(public_path('files/images/items'), $fileName);
            $Avatar = $fileName;
        } else {
            // Không chọn tệp
            $Avatar = "default.png";
        }

        $Items = Items::create([
            'ItemsName' => $request->input('ItemsName') ?? '',
            'Unit' => $request->input('IdUnit'),
            'IdCategory' => $request->input('IdCategory'),
            'Avatar' => $Avatar,
            'isActive' => true,
            'Description' => $request->input('Description') ?? '',
        ]);

        if ($Items) {
            $data = [];
            if ($request->filled('Prices')) {
                foreach (json_decode($request->input('Prices')) as $Price) {
                    $data[] = [
                        'IdItems' => $Items->IdItems,
                        'PriceName' => $Price->PriceName ?? '',
                        'SalePrice' => $Price->SalePrice ?? 0,
                        'CostPrice' => $Price->CostPrice ?? '0',
                        'isActive' => true,
                    ];
                }
                PriceList::insert($data);
            }
        }
        return response()->json(['success' => 'Thêm mặt hàng thành công.']);
    }

    public function show($IdItems)
    {
        $Items = Items::find($IdItems);
        $listCategory = Category::where('isActive', true)->get();
        $listUnit = Units::where('isActive', true)->get();
        $listPrice = PriceList::where('isActive', true)->get();

        return view('admin.items.show', ['Items' => $Items, 'listCategory' => $listCategory, 'listUnit' => $listUnit, 'listPrice' => $listPrice]);
    }

    public function edit_put(Request $request, $IdItems)
    {
        $Avatar =  $request->input('Avatar');
        //Xử lý ảnh đại diện
        if ($request->hasFile('_Avatar')) { // Có chọn tệp
            //Xóa tệp cũ nếu tồn tại use Illuminate\Support\Facades\File;
            $oldImage = public_path('files/images/items/' . $Avatar);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }

            $fileName =  Str::slug($request->input('ItemsName'), '') . '_' . now()->format('Ymd-His') . '.' . $request->file('_Avatar')->getClientOriginalExtension();
            $request->file('_Avatar')->move(public_path('files/images/items'), $fileName);
            $Avatar = $fileName;
        }

        $Items = Items::where('IdItems', $IdItems)
            ->update([
                'ItemsName' => $request->input('ItemsName') ?? '',
                'Unit' => $request->input('IdUnit'),
                'IdCategory' => $request->input('IdCategory'),
                'Avatar' => $Avatar,
                'isActive' => true,
                'Description' => $request->input('Description') ?? '',
            ]);

        if ($Items) {
            PriceList::where('IdItems', $IdItems)->delete();
            $data = [];
            if ($request->filled('Prices')) {
                foreach (json_decode($request->input('Prices')) as $Price) {
                    $data[] = [
                        'IdItems' => $IdItems,
                        'PriceName' => $Price->PriceName ?? '',
                        'SalePrice' => $Price->SalePrice ?? 0,
                        'CostPrice' => $Price->CostPrice ?? '0',
                        'isActive' => true,
                    ];
                }
                PriceList::insert($data);
            }
        }
        return response()->json(['success' => 'Cập nhật mặt hàng thành công.', 'ItemsName' => $request->input('ItemsName')]);
    }

    function delete($IdItems)
    {
        $deleteCount = Items::where('IdItems', $IdItems)
            ->update([
                'isActive' => false
            ]);

        if ($deleteCount > 0) {
            return redirect('/admin/items/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }

    function delete_all(Request $request)
    {
        $ArrDel = $request->input('ArrDel');
        $deleteCount = Items::whereIn('IdItems', $ArrDel)
            ->update([
                'isActive' => false
            ]);

        if ($deleteCount > 0) {
            return redirect('/admin/items/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }
}
