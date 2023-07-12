<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menus;
use App\Models\Items;
use App\Models\RestaurantInfo;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        return view('client.home.index');
    }

    public function menus()
    {
        $listMenus = Menus::where('isActive', true)
            ->get();

        $listItems = Items::join('tbl_menus_items', 'tbl_menus_items.IdItems', '=', 'tbl_items.IdItems')
            ->leftjoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_items.IdItems')
            ->where('tbl_items.isActive', true)
            ->select('tbl_items.*', 'tbl_menus_items.IdMenu', 'tbl_pricelist.SalePrice')
            ->get();

        return view('client.home.menus', ['listMenus' => $listMenus, 'listItems' => $listItems]);
    }

    function about()
    {
        $info = RestaurantInfo::first();
        return view('client.home.about', ['info' => $info]);
    }

    public function loadItems(Request $request)
    {
        $listItems = Items::join('tbl_menus_items', 'tbl_menus_items.IdItems', '=', 'tbl_items.IdItems')
            ->leftjoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_items.IdItems')
            ->where('tbl_items.isActive', true)
            ->select('tbl_items.*', 'tbl_menus_items.IdMenu', 'tbl_pricelist.SalePrice')
            ->get();

        $menuId = $request->input('menuId');
        $page = $request->input('page', 1);
        $perPage = 8;

        $itemsForCurrentPage = $listItems
            ->where('IdMenu', $menuId)
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        $itemsHtml = view('partials.items')->with('items', $itemsForCurrentPage)->render();
        $paginationHtml = $itemsForCurrentPage->links();

        return response()->json([
            'itemsHtml' => $itemsHtml,
            'paginationHtml' => $paginationHtml
        ]);
    }

    public function login()
    {
        if (session()->has('IdCustomer')) {
            return Redirect::intended(route('client.home'));
        }

        session()->put('redirectUrl', url()->previous());

        return view('client.home.login');
    }

    public function login_post(Request $request)
    {
        $UserName = trim($request->input('UserName'));
        $PassWord = $request->input('Password');

        $result = Customer::where('UserName', $UserName)->where('PassWord', MD5($PassWord))->first();

        if (!$result) {
            $result = Customer::where('Email', $UserName)->where('PassWord', MD5($PassWord))->first();

            if (!$result) {
                $result = Customer::where('PhoneNumber', $UserName)->where('PassWord', MD5($PassWord))->first();
                if (!$result) {
                    return redirect()->back()->withErrors(['error' => 'Tài khoản hoặc mật khẩu không chính xác!'])->withInput();
                }
            }
        }

        if ($result) {
            if (!$result->isActive) {
                return redirect()->back()->withErrors(['error' => 'Tài khoản đã bị vô hiệu hóa!'])->withInput();
            }
            session()->put('IdCustomer', $result->IdCustomer);
            session()->put('CusPhoneNumber', $result->PhoneNumber);
            session()->put('CusEmail', $result->Email);
            session()->put('CusUserName', $result->UserName);
            session()->put('CusLastName', $result->LastName);
            session()->put('CusFirstName', $result->FirstName);
            session()->put('CusAvatar', $result->Avatar);

            if (session()->has('redirectUrl')) {
                return redirect(session()->get('redirectUrl'));
            }
            return redirect(route('client.home'));
        }
    }

    public function register()
    {
        return view('client.home.register');
    }

    public function searchItems(Request $request)
    {
        $Key = $request->input('Key');
        $Items = Items::leftjoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_items.IdItems')
            ->where('tbl_items.isActive', true)
            ->where('tbl_items.ItemsName', 'like', '%' . $Key . '%')
            ->select('tbl_items.*', 'tbl_pricelist.SalePrice')->get();

        return view('client.home.search-item', ['Items' => $Items]);
    }

    public function register_post(Request $request)
    {

        $words = explode(" ", $request->input('FullName'));
        if (count($words) >= 2) {
            $FirstName = array_pop($words);
            $LastName = implode(" ", $words);
        } elseif (count($words) === 1) {
            $LastName = '';
            $FirstName = array_pop($words);
        }

        $PhoneNumber = $request->input("PhoneNumber");
        $Cus = Customer::where("PhoneNumber", $PhoneNumber);

        if ($Cus->count() > 0) {
            return redirect()->back()->withErrors(['error' => 'Số điện thoại đã được đăng ký bởi tài khoản khác!'])->withInput();
        }

        $customer = Customer::create([
            'UserName' => $request->input('UserName') ?? '',
            'PassWord' => MD5($request->input('Password')) ?? '',
            'LastName' => $LastName ?? '',
            'FirstName' => $FirstName ?? '',
            'PhoneNumber' => $request->input('PhoneNumber') ?? '',
            'Email' => $request->input('Email') ?? '',
            'Address' => $request->input('Address') ?? '',
        ]);

        if ($customer) {
            return redirect(route('client.login'))->with('message', 'Đăng ký tài khoản thành công');
        }

        return $request->input('Password');
    }

    public function logout()
    {
        session()->flush();
        if (!session()->has('IdCustomer')) {
            return redirect(route('client.login'));
        }
    }
}
