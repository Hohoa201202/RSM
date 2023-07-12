<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orders;
use App\Models\OrderDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class HomeAdminController extends Controller
{


    public function index()
    {
        return view('admin.home.index');
    }

    public function statistical($filter = null)
    {
        /*
            1: Hôm nay
            2: Tháng này
            3: Năm nay
            null: Tất cả
        */

        $percentOrder = $percentCus = $percentDoanhThu = 0;
        $check = null;
        if ($filter == 1) {
            $revenue = Orders::where('Status', 2)
                ->selectRaw('SUM(TotalAmount) as Total')
                ->whereDate('OrderDate', Carbon::today())
                ->first();
            // Lấy tổng doanh thu hôm qua
            $revenueYesterday = Orders::where('Status', 2)
                ->selectRaw('SUM(TotalAmount) as Total')
                ->whereDate('OrderDate', Carbon::yesterday())
                ->first();
            $percentDoanhThu = $this->percentageChange($revenueYesterday->Total, $revenue->Total);


            $today = Carbon::today()->toDateString();
            $test = Orders::select(DB::raw('DATE_FORMAT(OrderDate, "%H:00") as DataTime'), DB::raw('SUM(TotalAmount) as Total'), DB::raw('SUM(TotalCost) as TotalCost'))
                ->where('Status', 2)
                ->whereDate('OrderDate', $today)
                ->groupBy('DataTime')
                ->get();
            // dd($test);

            $customer = Customer::selectRaw('COUNT(IdCustomer) as Customer')
                ->whereDate('created_at', Carbon::today())
                ->first();
            $customerYesterday = Customer::selectRaw('COUNT(IdCustomer) as Customer')
                ->whereDate('created_at', Carbon::yesterday())
                ->first();
            $percentCus = $this->percentageChange($customerYesterday->Customer, $customer->Customer);


            $order = Orders::where('Status', 2)
                ->selectRaw('COUNT(IdOrder) as CountOrder')
                ->whereDate('OrderDate', Carbon::today())
                ->first();
            $orderYesterday = Orders::where('Status', 2)
                ->selectRaw('COUNT(IdOrder) as CountOrder')
                ->whereDate('OrderDate', Carbon::today())
                ->first();
            $percentOrder = $this->percentageChange($orderYesterday->CountOrder, $order->CountOrder);

            $items = OrderDetails::join('tbl_items', 'tbl_items.IdItems', '=', 'tbl_orderDetails.IdItems')
                ->join('tbl_orders', 'tbl_orders.IdOrder', '=', 'tbl_OrderDetails.IdOrder')
                ->leftJoin('dm_tbl_categories', 'dm_tbl_categories.IdCategory', '=', 'tbl_items.IdCategory')
                ->leftJoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_items.IdItems')
                ->groupBy('tbl_items.IdItems', 'tbl_pricelist.SalePrice')
                ->orderByRaw('SUM(tbl_orderDetails.Quantity) DESC')
                ->whereDate('tbl_orders.OrderDate', Carbon::today())
                ->select(
                    'tbl_items.*',
                    'dm_tbl_categories.CategoryName',
                    'tbl_pricelist.SalePrice',
                    DB::raw('SUM(tbl_orderDetails.Quantity) as TotalQuantity')
                )
                ->get();
            $check = 1;
        } elseif ($filter == 2) { //Tháng này
            $today = Carbon::today();
            $lastMonth = $today->subMonth();

            $revenue = Orders::where('Status', 2)
                ->selectRaw('SUM(TotalAmount) as Total')
                ->whereBetween('OrderDate', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->first();
            // Lấy tổng doanh thu tháng trước đó
            $revenueLastMonth = Orders::where('Status', 2)
                ->selectRaw('SUM(TotalAmount) as Total')
                ->whereMonth('OrderDate', $lastMonth->month)
                ->whereYear('OrderDate', $lastMonth->year)
                ->first();
            $percentDoanhThu = $this->percentageChange($revenueLastMonth->Total, $revenue->Total);

            $test = Orders::select(DB::raw('DATE(OrderDate) as DataTime'), DB::raw('SUM(TotalAmount) as Total'), DB::raw('SUM(TotalCost) as TotalCost'))
                ->where('Status', 2)
                ->groupBy(DB::raw('DATE(OrderDate)'))
                ->whereBetween('OrderDate', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->get();


            $customer = Customer::selectRaw('COUNT(IdCustomer) as Customer')
                ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->first();
            $customerLastMonth = Customer::selectRaw('COUNT(IdCustomer) as Customer')
                ->whereMonth('created_at', $lastMonth->month)
                ->whereYear('created_at', $lastMonth->year)
                ->first();
            $percentCus = $this->percentageChange($customerLastMonth->Customer, $customer->Customer);


            $order = Orders::where('Status', 2)
                ->selectRaw('COUNT(IdOrder) as CountOrder')
                ->whereBetween('OrderDate', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->first();
            $orderLastMonth = Orders::where('Status', 2)
                ->selectRaw('COUNT(IdOrder) as CountOrder')
                ->whereMonth('OrderDate', $lastMonth->month)
                ->whereYear('OrderDate', $lastMonth->year)
                ->first();
            $percentOrder = $this->percentageChange($orderLastMonth->CountOrder, $order->CountOrder);


            $items = OrderDetails::join('tbl_items', 'tbl_items.IdItems', '=', 'tbl_orderDetails.IdItems')
                ->join('tbl_orders', 'tbl_orders.IdOrder', '=', 'tbl_OrderDetails.IdOrder')
                ->leftJoin('dm_tbl_categories', 'dm_tbl_categories.IdCategory', '=', 'tbl_items.IdCategory')
                ->leftJoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_items.IdItems')
                ->groupBy('tbl_items.IdItems', 'tbl_pricelist.SalePrice')
                ->orderByRaw('SUM(tbl_orderDetails.Quantity) DESC')
                ->whereBetween('tbl_orders.OrderDate', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->select(
                    'tbl_items.*',
                    'dm_tbl_categories.CategoryName',
                    'tbl_pricelist.SalePrice',
                    DB::raw('SUM(tbl_orderDetails.Quantity) as TotalQuantity')
                )
                ->get();
            $check = 2;
        } elseif ($filter == 3) {
            // Lọc theo năm hiện tại

            $today = Carbon::today();
            $lastYear = $today->subYear();

            $revenue = Orders::where('Status', 2)
                ->selectRaw('SUM(TotalAmount) as Total')
                ->whereBetween('OrderDate', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                ->first();
            // Lấy tổng doanh thu năm trước đó
            $revenueLastYear = Orders::where('Status', 2)
                ->selectRaw('SUM(TotalAmount) as Total')
                ->whereYear('OrderDate', $lastYear->year)
                ->first();
            $percentDoanhThu = $this->percentageChange($revenueLastYear->Total, $revenue->Total);

            $test = Orders::select(DB::raw('DATE_FORMAT(OrderDate, "%Y-%m") as DataTime'), DB::raw('SUM(TotalAmount) as Total'), DB::raw('SUM(TotalCost) as TotalCost'))
                ->where('Status', 2)
                ->groupBy(DB::raw('DATE_FORMAT(OrderDate, "%Y-%m")'), DB::raw('MONTH(OrderDate)'))
                ->whereYear('OrderDate', Carbon::now()->year)
                ->orderByRaw('MONTH(OrderDate)')
                ->get();
            // dd($test);

            $customer = Customer::selectRaw('COUNT(IdCustomer) as Customer')
                ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->first();
            $customerLastYear = Customer::selectRaw('COUNT(IdCustomer) as Customer')
                ->whereYear('created_at', $lastYear->year)
                ->first();
            $percentCus = $this->percentageChange($customerLastYear->Customer, $customer->Customer);


            $order = Orders::where('Status', 2)
                ->selectRaw('COUNT(IdOrder) as CountOrder')
                ->whereBetween('OrderDate', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                ->first();
            $orderLastYear = Orders::where('Status', 2)
                ->selectRaw('COUNT(IdOrder) as CountOrder')
                ->whereYear('OrderDate', $lastYear->year)
                ->first();
            $percentOrder = $this->percentageChange($orderLastYear->CountOrder, $order->CountOrder);


            $items = OrderDetails::join('tbl_items', 'tbl_items.IdItems', '=', 'tbl_orderDetails.IdItems')
                ->join('tbl_orders', 'tbl_orders.IdOrder', '=', 'tbl_OrderDetails.IdOrder')
                ->leftJoin('dm_tbl_categories', 'dm_tbl_categories.IdCategory', '=', 'tbl_items.IdCategory')
                ->leftJoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_items.IdItems')
                ->groupBy('tbl_items.IdItems', 'tbl_pricelist.SalePrice')
                ->orderByRaw('SUM(tbl_orderDetails.Quantity) DESC')
                ->whereBetween('tbl_orders.OrderDate', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                ->select(
                    'tbl_items.*',
                    'dm_tbl_categories.CategoryName',
                    'tbl_pricelist.SalePrice',
                    DB::raw('SUM(tbl_orderDetails.Quantity) as TotalQuantity')
                )
                ->get();
            $check = 3;
        } else {
            $revenue = Orders::where('Status', 2)
                ->selectRaw('SUM(TotalAmount) as Total')
                ->first();

            $test = Orders::select(DB::raw('DATE(OrderDate) as DataTime'), DB::raw('SUM(TotalAmount) as Total'), DB::raw('SUM(TotalCost) as TotalCost'))
                ->where('Status', 2)
                ->orderByRaw('DATE(OrderDate)')
                ->groupBy(DB::raw('DATE(OrderDate)'))
                ->get();

            $customer = Customer::selectRaw('COUNT(IdCustomer) as Customer')
                ->first();

            $order = Orders::where('Status', 2)
                ->selectRaw('COUNT(IdOrder) as CountOrder')
                ->first();

            $items = OrderDetails::join('tbl_items', 'tbl_items.IdItems', '=', 'tbl_orderDetails.IdItems')
                ->join('tbl_orders', 'tbl_orders.IdOrder', '=', 'tbl_OrderDetails.IdOrder')
                ->leftJoin('dm_tbl_categories', 'dm_tbl_categories.IdCategory', '=', 'tbl_items.IdCategory')
                ->leftJoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_items.IdItems')
                ->groupBy('tbl_items.IdItems', 'tbl_pricelist.SalePrice')
                ->orderByRaw('SUM(tbl_orderDetails.Quantity) DESC')
                ->select(
                    'tbl_items.*',
                    'dm_tbl_categories.CategoryName',
                    'tbl_pricelist.SalePrice',
                    DB::raw('SUM(tbl_orderDetails.Quantity) as TotalQuantity')
                )
                ->get();
        }

        return view('admin.home.statistical', [
            'revenue' => $revenue->Total, 'percentDoanhThu' => $percentDoanhThu, 'percentOrder' => $percentOrder,
            'test' => $test, 'customer' => $customer->Customer, 'percentCus' => $percentCus,
            'order' => $order->CountOrder, 'items' => $items, 'check' => $check
        ]);
    }

    function percentageChange($pre, $current)
    {
        if ($pre == null) {
            return round((($current - $pre)) * 100, 1);
        }
        if ($current == null) {
            $current = 0;
        }
        return round((($current - $pre) / $pre) * 100, 1);
    }

    public function login()
    {
        return view('admin.home.login');
    }

    public function login_post(Request $request)
    {

        $UserName = $request->input('UserName');
        $PassWord = $request->input('PassWord');

        $result = User::where('UserName', $UserName)->where('PassWord', MD5($PassWord))->first();

        if ($result) {
            if (!$result->isActive) {
                return redirect()->back()->withErrors(['error' => 'Tài khoản đã không còn hoạt động!']);
            }
            session()->put('IdUser', $result->IdUser);
            session()->put('UserName', $result->UserName);
            session()->put('LastName', $result->LastName);
            session()->put('FirstName', $result->FirstName);
            session()->put('Avatar', $result->Avatar);
            session()->put('IdGroup', $result->IdGroup);
            return redirect('/admin');
        }
        return redirect()->back()->withErrors(['error' => 'Tài khoản hoặc mật khẩu không chính xác!']);
    }

    public function logout()
    {
        session()->flush();
        if (!session()->has('UserName')) {
            return redirect('/admin/login.html');
        }
    }
}
