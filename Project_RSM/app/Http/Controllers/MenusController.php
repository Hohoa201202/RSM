<?php

namespace App\Http\Controllers;

use App\Models\MenusItems;
use App\Models\Items;
use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\PriceList;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    public function index()
    {
        $listMenus = Menus::where('isActive', true)->orderBy('OrderMenu', 'asc')->paginate(5);

        return view('admin.menus.index', ['listMenus' => $listMenus]);
    }

    public function create()
    {
        $listItems = Items::leftjoin('dm_tbl_categories', 'dm_tbl_categories.IdCategory', '=', 'tbl_items.IdCategory')
            ->where('tbl_items.isActive', true)
            ->select('tbl_items.*', 'dm_tbl_categories.CategoryName')
            ->get();

        $listPrice = PriceList::where('isActive', true)->get();

        return view('admin.menus.create', ['listItems' => $listItems, 'listPrice' => $listPrice]);
    }

    public function create_post(Request $request)
    {
        if ($request->hasFile('Avatar')) {
            // Có chọn tệp
            $fileName =  Str::slug($request->input('MenuName'), '') . '_' . now()->format('Ymd-His') . '.' . $request->file('Avatar')->getClientOriginalExtension();
            $request->file('Avatar')->move(public_path('files/images/menus'), $fileName);
            $Avatar = $fileName;
        } else {
            // Không chọn tệp
            $Avatar = "default.png";
        }

        $Menus = Menus::create([
            'MenuName' => $request->input('MenuName'),
            'OrderMenu' => $request->input('OrderMenu') ?? 1,
            'Avatar' => $Avatar,
            'isActive' => true,
            'Description' => $request->input('Description') ?? ''
        ]);

        if ($Menus) {
            $data = [];
            if ($request->filled('Items')) {
                foreach (json_decode($request->input('Items')) as $items) {
                    $data[] = [
                        'IdMenu' => $Menus->IdMenu,
                        'IdItems' => $items
                    ];
                }
                MenusItems::insert($data);
            }
        }
        return response()->json(['success' => 'Thêm thực đơn thành công.']);
    }

    public function show($IdMenu)
    {
        $Menu = Menus::find($IdMenu);
        $listItems = Items::leftjoin('dm_tbl_categories', 'dm_tbl_categories.IdCategory', '=', 'tbl_items.IdCategory')
            ->where('tbl_items.isActive', true)
            ->select('tbl_items.*', 'dm_tbl_categories.CategoryName')
            ->get();
        $listPrice = PriceList::where('isActive', true)->get();
        $ItemsOfMenu = MenusItems::join('tbl_items', 'tbl_items.IdItems', '=', 'tbl_menus_items.IdItems')
            ->leftjoin('dm_tbl_categories', 'dm_tbl_categories.IdCategory', '=', 'tbl_items.IdCategory')
            ->select('tbl_items.*', 'dm_tbl_categories.CategoryName')
            ->where('tbl_menus_items.IdMenu', $IdMenu)->get();

        return view('admin.menus.show', ['Menu' => $Menu, 'listItems' => $listItems, 'listPrice' => $listPrice, 'ItemsOfMenu' => $ItemsOfMenu]);
    }

    public function edit_put(Request $request, $IdMenu)
    {
        $Avatar =  $request->input('Avatar');
        //Xử lý ảnh đại diện
        if ($request->hasFile('_Avatar')) { // Có chọn tệp
            //Xóa tệp cũ nếu tồn tại use Illuminate\Support\Facades\File;
            $oldImage = public_path('files/images/menus/' . $Avatar);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }

            $fileName =  Str::slug($request->input('MenuName'), '') . '_' . now()->format('Ymd-His') . '.' . $request->file('_Avatar')->getClientOriginalExtension();
            $request->file('_Avatar')->move(public_path('files/images/menus'), $fileName);
            $Avatar = $fileName;
        }

        $Menu = Menus::where('IdMenu', $IdMenu)
            ->update([
                'MenuName' => $request->input('MenuName'),
                'OrderMenu' => $request->input('OrderMenu') ?? 1,
                'Avatar' => $Avatar,
                'isActive' => true,
                'Description' => $request->input('Description') ?? ''
            ]);

        if ($Menu) {

            if ($request->filled('Items')) {
                foreach (json_decode($request->input('Items')) as $items) {
                    $data[] = [
                        'IdMenu' => $IdMenu,
                        'IdItems' => $items,
                    ];
                }

                // Xóa các mặt hàng không có trong dữ liệu đưa vào
                MenusItems::where('IdMenu', $IdMenu)
                    ->whereNotIn('IdItems', array_column($data, 'IdItems'))
                    ->delete();

                foreach ($data as $item) {
                    MenusItems::updateOrCreate(
                        ['IdMenu' => $item['IdMenu'], 'IdItems' => $item['IdItems']],
                        $item
                    );
                }
            }
        }
        return response()->json(['success' => 'Cập nhật thực đơn thành công.']);
    }

    function delete($IdMenu)
    {
        MenusItems::where('IdMenu', $IdMenu)->delete();
        $deleteCount = Menus::where('IdMenu', $IdMenu)->delete();

        if ($deleteCount > 0) {
            return redirect('/admin/menus/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }

    function delete_all(Request $request)
    {
        $ArrData = $request->input('ArrData');
        MenusItems::whereIn('IdMenu', $ArrData)->delete();
        $deleteCount = Menus::whereIn('IdMenu', $ArrData)->delete();

        if ($deleteCount > 0) {
            return redirect('/admin/menus/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }
}
