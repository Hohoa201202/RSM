<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SlideController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    public function index()
    {
        $listSlides = Slide::where('isActive', true)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('admin.slide.index', ['listSlides' => $listSlides]);
    }

    public function create()
    {
        return view('admin.slide.create');
    }

    function create_post(Request $request)
    {
        if ($request->hasFile('ImageName')) {
            // Có chọn tệp
            $fileName = 'slide-' . now()->format('Ymd-His') . '.' . $request->file('ImageName')->getClientOriginalExtension();
            $request->file('ImageName')->move(public_path('files/images/slide'), $fileName);
            $ImageName = $fileName;
        } else {
            // Không chọn tệp
            $ImageName = "default.png";
        }

        $slide = Slide::create([
            'IdMenu' => $request->input('IdMenu') ?? null,
            'Title' => $request->input('Title') ?? null,
            'SubTitle' => $request->input('SubTitle') ?? null,
            'ImageName' => $ImageName,
            'Position' => $request->input('Position') ?? null,
            'Order' => $request->input('Order') ?? null,
            'isActive' => true,
            'Description' => $request->input('Description') ?? null
        ]);

        if ($slide) {
            return redirect('/admin/slide/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi khi thêm slide']);
    }

    public function show($IdSlide)
    {
        $slide = Slide::find($IdSlide);
        if (!$slide) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy thông tin']);
        }

        return view('admin.slide.show', ['slide' => $slide]);
    }

    public function edit_put(Request $request, $IdSlide)
    {
        $ImageName = $request->input('ImageName');

        if ($request->hasFile('_ImageName')) { // Có chọn tệp
            //Xóa tệp cũ nếu tồn tại
            $oldImage = public_path('files/images/slide/' . $ImageName);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }

            $fileName = 'slide-' . now()->format('Ymd-His') . '.' . $request->file('_ImageName')->getClientOriginalExtension();
            $request->file('_ImageName')->move(public_path('files/images/slide'), $fileName);
            $ImageName = $fileName;
        }

        $slide = Slide::where('IdSlide', $IdSlide)
            ->update([
                'IdMenu' => $request->input('IdMenu') ?? null,
                'Title' => $request->input('Title') ?? null,
                'SubTitle' => $request->input('SubTitle') ?? null,
                'ImageName' => $ImageName,
                'Position' => $request->input('Position') ?? null,
                'Order' => $request->input('Order') ?? null,
                'isActive' => true,
                'Description' => $request->input('Description') ?? null
            ]);

        if ($slide) {
            return redirect('/admin/slide/index');
        }
        return redirect()->back()->withErrors(['error' => 'Cập nhật thất bại, đã có lỗi xảy ra!']);
    }

    function delete($IdSlide)
    {
        $slide = Slide::find($IdSlide);
        if ($slide) {
            //Xóa file ảnh
            $ImagePath = public_path('files/images/slide/' . $slide->ImageName);
            if (File::exists($ImagePath)) {
                File::delete($ImagePath);
            }

            //Xóa bản ghi
            $deleteCount = Slide::where('IdSlide', $IdSlide)
                ->delete();

            if ($deleteCount > 0) {
                return redirect('/admin/slide/index');
            }
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }

    function delete_all(Request $request)
    {
        $ArrDel = $request->input('ArrDel');
        $deleteCount = Slide::whereIn('IdSlide', $ArrDel)
            ->delete();

        if ($deleteCount > 0) {
            return redirect('/admin/slide/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }
}
