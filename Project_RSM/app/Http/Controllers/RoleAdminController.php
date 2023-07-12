<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupUser;
use App\Models\Role;
use App\Models\User;
use App\Models\MenuWebAdminModel;

use function PHPUnit\Framework\isNull;

class RoleAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    function index()
    {
        $listGroupUser = GroupUser::all();

        return view('admin.role.index', ['listGroupUser' => $listGroupUser]);
    }

    function create()
    {
        $listMenu = MenuWebAdminModel::where('Lever', 0)->orderby('Order')->get();
        return view('admin.role.create', ['listMenu' => $listMenu]);
    }

    function create_post(Request $request)
    {
        $GroupUser = GroupUser::create([
            'GroupName' => $request->input('GroupName'),
            'Description' =>  $request->input('Description') ?? ''
        ]);

        if ($GroupUser) {
            $data = [];

            foreach ($request->input('ArrMenu') as $item) {
                $data[] = [
                    'IdGroup' => $GroupUser->IdGroup,
                    'IdMenuAdmin' => $item,
                    'Description' => $request->input('Description') ?? ''
                ];
            }

            Role::insert($data);
        } else {
            return redirect()->back()->withErrors(['error' => 'Thêm mới thất bại! Đã có lỗi xảy ra!']);
        }

        return redirect('admin/role/index');
    }

    function show($IdGroup)
    {
        $GroupUser = GroupUser::find($IdGroup);

        $listMenu = MenuWebAdminModel::where('Lever', 0)->orderby('Order')->get();

        $listRole = Role::join('ht_tbl_adminwebmenu', 'ht_tbl_adminwebmenu.IdMenuAdmin', '=', 'ht_tbl_Role.IdMenuAdmin')
            ->select('ht_tbl_Role.*', 'ht_tbl_adminwebmenu.MenuName')
            ->where('IdGroup', $IdGroup)
            ->get();

        return view('admin.role.show', ['GroupUser' => $GroupUser, 'listRole' => $listRole, 'listMenu' => $listMenu]);
    }

    function edit_put(Request $request, $IdGroup)
    {
        $GroupUser = GroupUser::where('IdGroup', $IdGroup)
            ->update([
                'GroupName' => $request->input('GroupName'),
                'Description' => $request->input('Description')
            ]);

        if ($GroupUser) {
            Role::Where('IdGroup', $IdGroup)
                ->delete();

            $data = [];
            foreach ($request->input('ArrMenu') as $item) {
                $data[] = [
                    'IdGroup' => $IdGroup,
                    'IdMenuAdmin' => $item
                ];
            }
            Role::insert($data);
        } else {
            return redirect()->back()->withErrors(['error' => 'Cập nhật thất bại! Đã có lỗi xảy ra!']);
        }

        return redirect('admin/role/index');
    }

    function delete($IdGroup)
    {
        Role::where('IdGroup', $IdGroup)->delete();
        GroupUser::where('IdGroup', $IdGroup)->delete();
        return redirect('admin/role/index');
    }
}
