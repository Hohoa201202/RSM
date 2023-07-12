<?php

namespace App\Http\Controllers;

use App\Models\Branchs;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Tables;
use App\Models\Items;
use App\Models\OrderDetails;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    function index()
    {
        $listBranchs = Branchs::where('isActive', true)->get();

        return view('client.cart.index', ['listBranchs' => $listBranchs]);
    }

    function add_cart($IdItems)
    {
        $items = Items::leftjoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_Items.IdItems')
            ->select('tbl_pricelist.SalePrice', 'tbl_pricelist.CostPrice', 'tbl_Items.*')
            ->find($IdItems);

        if ($items !== null) {
            if (session()->has("ArrItems.$IdItems")) {
                $item = session()->get("ArrItems.$IdItems");
                $item['Quantity']++;
                session()->put("ArrItems.$IdItems", $item);
                return true;
            } else {
                $item = [
                    'IdItems' => $IdItems,
                    'ItemsName' => $items->ItemsName,
                    'Avatar' => $items->Avatar,
                    'Price' => $items->SalePrice ?? 0,
                    'PriceCost' => $items->CostPrice ?? 0,
                    'Quantity' => 1
                ];

                session()->put("ArrItems.$IdItems", $item);
            }
        }
        return true;
    }

    function sub_cart($IdItems)
    {
        $items = Items::leftjoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_Items.IdItems')
            ->select('tbl_pricelist.SalePrice', 'tbl_pricelist.CostPrice', 'tbl_Items.*')
            ->find($IdItems);

        if ($items !== null) {
            if (session()->has("ArrItems.$IdItems")) {
                $item = session()->get("ArrItems.$IdItems");
                $item['Quantity']--;
                session()->put("ArrItems.$IdItems", $item);
                return true;
            } else {
                $item = [
                    'IdItems' => $IdItems,
                    'ItemsName' => $items->ItemsName,
                    'Avatar' => $items->Avatar,
                    'Price' => $items->SalePrice ?? 0,
                    'PriceCost' => $items->CostPrice ?? 0,
                    'Quantity' => 1
                ];

                session()->put("ArrItems.$IdItems", $item);
            }
        }
        return true;
    }

    function delete_cart($IdItems)
    {
        session()->forget("ArrItems.$IdItems");
        return true;
    }

    //Gửi đơn
    function booking(Request $request)
    {
        $words = explode(" ", $request->input('FullName'));
        if (count($words) >= 2) {
            $FirstName = array_pop($words);
            $LastName = implode(" ", $words);
        } elseif (count($words) === 1) {
            $LastName = '';
            $FirstName = array_pop($words);
        }

        $PhoneNumber = $request->input('PhoneNumber');

        if (!empty($PhoneNumber)) {
            $checkCustomer = Customer::where('PhoneNumber', $PhoneNumber)->first();

            if ($checkCustomer === null) {
                $customer = Customer::create([
                    'LastName' => $LastName ?? '',
                    'FirstName' => $FirstName ?? '',
                    'PhoneNumber' => $PhoneNumber ?? '',
                    'Address' => $request->input('Address') ?? null
                ]);

                $IdCus = $customer->IdCustomer;
            } else {
                $IdCus = $checkCustomer->IdCustomer;
            }
        }

        $booking = Booking::create([
            'IdCustomer' => $IdCus,
            'IdBranch' => $request->input('IdBranch') ?? null,
            'Discount' => null,
            'IdTable' => $request->input('IdTable') ?? null,
            'BookingDate' => Carbon::createFromFormat('d-m-Y', $request->input('BookingDate')),
            'TimeSlot' => $request->input('TimeSlot'),
            'NumberGuests' => $request->input('NumberGuests'),
            'IdStatus' => 1,
            'isActive' => true,
            'Note' => $request->input('Note') ?? ''
        ]);

        $listItems = json_decode($request->input('Items'));
        if (count($listItems) > 0) {
            $Total = 0;
            $TotalCost = 0;
            //Tính tổng tiền bán và tổng tiền gốc để lưu hóa đơn
            foreach ($listItems as $items) {
                $Total += $items->Quantity * $items->Price;
                $TotalCost += $items->Quantity * $items->PriceCost;
            }

            if ($booking) {
                $order = Orders::create([
                    'IdCustomer' => $IdCus,
                    'IdBooking' => $booking->IdBooking,
                    'IdTable' => $booking->IdTable,
                    'Discount' => null,
                    'IdUser' => session()->get('IdUser') ?? null,
                    'OrderDate' => Carbon::now(),
                    'TimeIn' => Carbon::now(),
                    'TimeOut' => null,
                    'TotalCost' => $TotalCost,
                    'TotalAmount' => $Total,
                    'PaymentMethod' => null,
                    'PaymentTime' => null,
                    'Status' => null,
                    'Notes' => null
                ]);

                if ($order) {
                    $data = [];
                    foreach ($listItems as $items) {
                        $data[] = [
                            'IdOrder' => $order->IdOrder,
                            'IdItems' => $items->IdItems,
                            'IdCombo' => null,
                            'Quantity' => $items->Quantity,
                            'PriceSale' => $items->Price,
                            'Amount' => $items->Quantity * $items->Price
                        ];
                    }
                    OrderDetails::insert($data);
                }
            }
        } else {
            $order = Orders::create([
                'IdCustomer' => $IdCus,
                'IdBooking' => $booking->IdBooking,
                'IdTable' => $request->input('IdTable') ?? null,
                'Discount' => null,
                'IdUser' => session()->get('IdUser') ?? null,
                'OrderDate' => Carbon::now(),
                'TimeIn' => null,
                'TimeOut' => null,
                'TotalCost' => 0,
                'TotalAmount' => 0,
                'PaymentMethod' => null,
                'PaymentTime' => null,
                'Status' => null,
                'Notes' => null
            ]);
        }
        return response()->json(['success' => $booking->IdBooking]);
    }

    //Thanh toán trước
    function payment($IdBooking)
    {
        $booking = Booking::join('tbl_customer', 'tbl_customer.IdCustomer', '=', 'tbl_booking.IdCustomer')
            ->leftjoin('tbl_orders', 'tbl_orders.IdBooking', '=', 'tbl_booking.IdBooking')
            ->leftjoin('dm_tbl_branchs', 'dm_tbl_branchs.IdBranch', '=', 'tbl_booking.IdBranch')
            ->select(
                'tbl_booking.*',
                DB::raw('CONCAT(tbl_customer.LastName, " ", tbl_customer.FirstName) AS `FullNameCus`'),
                'tbl_customer.PhoneNumber',
                'dm_tbl_branchs.BranchName',
                'dm_tbl_branchs.Address',
                'tbl_Orders.TotalAmount',
                'tbl_Orders.IdOrder'
            )
            ->find($IdBooking);
        return view('client.cart.payment', ['booking' => $booking]);
    }

    //Thanh toán VNPay thành công
    public function checkoutResult()
    {
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $vnp_HashSecret = env('vnp_HashSecret');
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {

                $order = Orders::find($_GET['vnp_TxnRef']);
                if ($order) {

                    Booking::find($order->IdBooking)
                        ->update([
                            'PrePayment' => $_GET['vnp_Amount'] / 100
                        ]);
                }
                $check = 1;
            } else {
                $check = 0;
            }
        } else {
            $check = 3;
        }
        return view('client.cart.checkout-result', ['check' => $check]);
    }

    public function processVNPay($IdOrder, Request $request)
    {
        //https://sandbox.vnpayment.vn/apis/docs/huong-dan-tich-hop
        if ($request->input('method') != 1) {
            return view('client.cart.checkout-result', ['check' => 0]);
        }
        $order = Orders::find($IdOrder);

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = 'http://127.0.0.1:8000/cart/checkout/result';
        $vnp_TmnCode = env('vnp_TmnCode'); //Mã website tại VNPAY
        $vnp_HashSecret = env('vnp_HashSecret'); //Chuỗi bí mật

        $vnp_TxnRef = $order->IdOrder; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toan hoa don $order->IdOrder";
        $vnp_OrderType = "orther";
        $vnp_Amount = $order->TotalAmount * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        //Billing
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
