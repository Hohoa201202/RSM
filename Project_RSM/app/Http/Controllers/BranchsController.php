<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branchs;

class BranchsController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    function index()
    {
        $listBranchs = Branchs::where('isActive', true)->paginate(5);

        return view('admin.branchs.index', ['listBranchs' => $listBranchs]);
    }

    function create_post(Request $request)
    {
        $request->validate([
            'BranchName' => 'required|string',
        ], [
            'BranchName.required' => 'Tên cơ sở không được để trống',
            'BranchName.string' => 'Tên cơ sở phải là dạng chuỗi',
        ]);

        $Branch = Branchs::create([
            'BranchName' => $request->input('BranchName'),
            'Address' => $request->input('Address') ?? '',
            'PhoneNumber' => $request->input('PhoneNumber') ?? '',
            'Email' => $request->input('Email') ?? '',
            'isActive' => true,
            'Description' => $request->input('Description') ?? ''
        ]);

        if ($Branch) {
            return redirect()->back()->withInput();
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi khi thêm cơ sở']);
    }

    public function show($IdBranch)
    {
        $Branch = Branchs::find($IdBranch);
        if (!$Branch) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy thông tin']);
        }
        return view('admin.branchs.show', ['Branch' => $Branch]);
    }

    public function edit_put(Request $request, $IdBranch)
    {
        $Branch = Branchs::where('IdBranch', $IdBranch)
            ->update([
                'BranchName' => $request->input('BranchName'),
                'Address' => $request->input('Address') ?? '',
                'PhoneNumber' => $request->input('PhoneNumber') ?? '',
                'Email' => $request->input('Email') ?? '',
                'isActive' => true,
                'Description' => $request->input('Description') ?? ''
            ]);
        if ($Branch) {
            return redirect('/admin/branchs/index');
        }
        return redirect()->back()->withErrors(['error' => 'Cập nhật thất bại, đã có lỗi xảy ra!']);
    }

    function delete($IdBranch)
    {
        $deleteCount = Branchs::where('IdBranch', $IdBranch)->update([
            'isActive' => false
        ]);

        if ($deleteCount > 0) {
            return redirect('/admin/branchs/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }

    function delete_all(Request $request)
    {
        $ArrDel = $request->input('ArrDel');
        $deleteCount = Branchs::whereIn('IdBranch', $ArrDel)
            ->update([
                'isActive' => false
            ]);

        if ($deleteCount > 0) {
            return redirect('/admin/branchs/index');
        }
        return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình xóa']);
    }
}
