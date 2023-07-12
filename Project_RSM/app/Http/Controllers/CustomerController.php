<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Customer;
use Illuminate\Validation\Rule;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    function index()
    {
        $listCustomer = Customer::all();
        return view('admin.customer.index', ['listCustomer' => $listCustomer]);
    }

    function create()
    {
        return view('admin.customer.create');
    }

    function create_post(Request $request)
    {
        $words = explode(" ", $request->input('FullName'));
        if (count($words) >= 2) {
            $FirstName = array_pop($words);
            $LastName = implode(" ", $words);
        } elseif (count($words) === 1) {
            $LastName = '';
            $FirstName = array_pop($words);
        }

        $customer = Customer::create([
            'UserName' => $request->input('UserName') ?? '',
            'PassWord' => MD5($request->input('PassWord')) ?? '',
            'LastName' => $LastName ?? '',
            'FirstName' => $FirstName ?? '',
            'PhoneNumber' => $request->input('PhoneNumber') ?? '',
            'Email' => $request->input('Email') ?? '',
            'Address' => $request->input('Address') ?? '',
        ]);

        if ($customer) {
            return redirect()->back();
            return redirect('admin/customer/index');
        }
        return redirect()->back();
    }

    function show($IdCustomer)
    {
        $customer = Customer::find($IdCustomer);

        if (!$customer) {
            return redirect()->back()->withErrors(['error' => 'Thông tin khách hàng không tồn tại !']);
        }

        return view('admin.customer.show', ['customer' => $customer]);
    }

    function edit_put(Request $request, $IdCustomer)
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

        //Nếu tạo mới tài khoản
        if ($request->filled('_UserName')) {
            $UserName = $request->input('_UserName');

            $checkUnique = Customer::where('UserName', $UserName);
            if ($checkUnique->count() > 0) {
                return redirect()->back()->withErrors(['error' => 'Tài khoản đã tồn tại! Vui lòng nhập tên tài khoản khác']);
            }
        } else {
            $UserName = $request->input('UserName') ?? "";
        }

        //Xử lý có thay đổi mật khẩu
        if ($request->filled('PassWord')) {
            Customer::where('IdCustomer', $IdCustomer)
                ->update([
                    'LastName' => $LastName,
                    'FirstName' => $FirstName,
                    'UserName' => $UserName,
                    'PassWord' => md5($request->input('PassWord')),
                    'PhoneNumber' => $request->input('PhoneNumber') ?? "",
                    'Email' => $request->input('Email') ?? "",
                ]);
        } else {
            Customer::where('IdCustomer', $IdCustomer)
                ->update([
                    'LastName' => $LastName,
                    'FirstName' => $FirstName,
                    'UserName' => $UserName,
                    'PhoneNumber' => $request->input('PhoneNumber') ?? "",
                    'Email' => $request->input('Email') ?? "",
                ]);
        }

        return Redirect('/admin/customer/index');
    }

    function delete($IdCustomer)
    {
        $deleteCount = Customer::where('IdCustomer', $IdCustomer)->delete();

        if ($deleteCount > 0) {
            return redirect('/admin/customer/index');
        }
        return redirect()->back()->withErrors(['error' => 'Có lỗi trong quá trình xóa, vui lòng thử lại !']);
    }

    function export_csv()
    {
        return Excel::download(new ExcelExports, 'Data.xlsx');
    }

    function import_csv()
    {
    }
}
