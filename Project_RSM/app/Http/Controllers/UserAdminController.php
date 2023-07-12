<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class UserAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    public function index()
    {
        $listUser = User::all();

        return view('admin.user.index', ['listUser' => $listUser]);
    }

    public function create()
    {
        $listGroupUser = GroupUser::all();
        return view('admin.user.create', ['listGroupUser' => $listGroupUser]);
    }

    public function create_post(Request $request)
    {

        $user = new User();
        $user->UserName = Str::slug($request->input('UserName'));
        $user->PassWord = md5($request->input('PassWord'));
        $user->BirthDay = Carbon::now();
        $user->LastLogin = Carbon::now();
        $user->isActive = true;
        $user->Description = '';
        $user->IdGroup = $request->input('IdGroup');

        if ($request->filled('PhoneNumber')) {
            $user->PhoneNumber = $request->input('PhoneNumber');
        } else {
            $user->PhoneNumber = '';
        }

        if ($request->filled('Email')) {
            $user->Email = $request->input('Email');
        } else {
            $user->Email = '';
        }

        $words = explode(" ", $request->input('FullName'));
        if (count($words) >= 2) {
            $user->FirstName = array_pop($words);
            $user->LastName = implode(" ", $words);
        } elseif (count($words) === 1) {
            $user->LastName = '';
            $user->FirstName = array_pop($words);
        }

        if ($request->hasFile('Avatar')) {
            // Có chọn tệp
            $fileName = Str::slug($request->input('FullName'), '') . '_' . Str::slug($request->input('UserName'), '') . '.' . $request->file('Avatar')->getClientOriginalExtension();
            $request->file('Avatar')->move(public_path('files/images/user'), $fileName);
            $user->Avatar = $fileName;
        } else {
            // Không chọn tệp
            $user->Avatar = "default.png";
        }

        $user->save();
        return redirect('/admin/user/index');
    }

    public function show($UserName)
    {

        $User = User::find($UserName);
        $listGroupUser = GroupUser::all();
        return view('admin.user.show', ['User' => $User, 'listGroupUser' => $listGroupUser]);
    }

    public function edit_put(Request $request, $UserName)
    {
        //Xử lý họ và tên nhân viên
        $words = explode(" ", $request->input('FullName'));
        if (count($words) >= 2) {
            $FirstName = array_pop($words);
            $LastName = implode(" ", $words);
        } elseif (count($words) === 1) {
            $LastName = '';
            $FirstName = array_pop($words);
        }

        //Xử lý ảnh đại diện
        $Avatar =  $request->input('Avatar');
        if ($request->hasFile('_Avatar')) { // Có chọn tệp
            //Xóa tệp cũ nếu tồn tại
            $oldImage = public_path('files/images/user/' . $Avatar);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }

            $fileName = Str::slug($request->input('FullName'), '') . '_' . Str::slug($request->input('UserName'), '') . '.' . $request->file('_Avatar')->getClientOriginalExtension();
            $request->file('_Avatar')->move(public_path('files/images/user'), $fileName);
            $Avatar = $fileName;
        }

        //Xử lý có thay đổi mật khẩu
        if ($request->filled('PassWord')) {
            User::where('UserName', $UserName)
                ->update([
                    'LastName' => $LastName,
                    'FirstName' => $FirstName,
                    'PassWord' => md5($request->input('PassWord')),
                    'Avatar' => $Avatar,
                    'IdGroup' => $request->input('IdGroup'),
                    'PhoneNumber' => $request->filled('PhoneNumber') ? $request->input('PhoneNumber') : "",
                    'Email' => $request->filled('Email') ? $request->input('Email') : "",
                ]);
        } else {
            User::where('UserName', $UserName)
                ->update([
                    'LastName' => $LastName,
                    'FirstName' => $FirstName,
                    'Avatar' => $Avatar,
                    'IdGroup' => $request->input('IdGroup'),
                    'PhoneNumber' => $request->filled('PhoneNumber') ? $request->input('PhoneNumber') : "",
                    'Email' => $request->filled('Email') ? $request->input('Email') : "",
                ]);
        }

        return Redirect('/admin/user/index');
    }

    function delete($UserName)
    {
        User::where('UserName', $UserName)->delete();

        return redirect('/admin/user/index');
    }
}
