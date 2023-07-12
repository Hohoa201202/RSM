<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    public function index()
    {
        $listCategories = Category::leftJoin('tbl_items', 'tbl_items.IdCategory', '=', 'dm_tbl_categories.IdCategory')
            ->select('dm_tbl_categories.CategoryName', 'dm_tbl_categories.IdCategory', DB::raw('COALESCE(COUNT(tbl_items.IdItems), 0) as TotalItems'))
            ->where('dm_tbl_categories.isActive', true)
            ->groupBy('dm_tbl_categories.CategoryName', 'dm_tbl_categories.IdCategory')
            ->orderBy('dm_tbl_categories.created_at', 'desc')
            ->paginate(5);

        return view('admin.category.index', ['listCategories' => $listCategories]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    function create_post(Request $request)
    {
        $request->validate([
            'CategoryName' => 'required|string',
        ], [
            'CategoryName.required' => 'Tên danh mục không được để trống',
            'CategoryName.string' => 'Tên danh mục phải là dạng chuỗi',
        ]);

        $Category = Category::create([
            'CategoryName' => $request->input('CategoryName') ?? '',
            'Description' => $request->input('Description') ?? '',
        ]);

        if ($Category) {
            return redirect()->back()->withInput();
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi khi thêm danh mục mặt hàng']);
    }

    public function show($IdCategory)
    {
        $Category = Category::find($IdCategory);
        if (!$Category) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy thông tin']);
        }
        $listItems = Items::where('IdCategory', $IdCategory)->get();
        return view('admin.category.show', ['Category' => $Category, 'listItems' => $listItems]);
    }

    public function edit_put(Request $request, $IdCategory)
    {
        $Category = Category::where('IdCategory', $IdCategory)
            ->update([
                'CategoryName' => $request->input('CategoryName'),
            ]);
        if ($Category) {
            return redirect('/admin/category/index');
        }
        return redirect()->back()->withErrors(['error' => 'Cập nhật thất bại, đã có lỗi xảy ra!']);
    }

    function delete($IdCategory)
    {
        $deleteCount = Category::where('IdCategory', $IdCategory)->update([
            'isActive' => false
        ]);

        if ($deleteCount > 0) {
            return redirect('/admin/category/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }

    function delete_all(Request $request)
    {
        $ArrDel = $request->input('ArrDel');
        $deleteCount = Category::whereIn('IdCategory', $ArrDel)
            ->update([
                'isActive' => false
            ]);

        if ($deleteCount > 0) {
            return redirect('/admin/category/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }
}
