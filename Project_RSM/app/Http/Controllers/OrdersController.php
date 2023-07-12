<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Tables;
use App\Models\Area;
use App\Models\CancelledOrder;
use App\Models\Items;
use App\Models\PriceList;
use App\Models\Category;
use App\Models\Combo;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\OrderStatus;
use App\Models\RestaurantInfo;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    function index()
    {
        $listOrders = Orders::leftjoin('tbl_Booking', 'tbl_Booking.IdBooking', '=', 'tbl_Orders.IdBooking')
            ->leftjoin('tbl_tables', 'tbl_tables.IdTable', '=', 'tbl_Orders.IdTable')
            ->leftjoin('dm_tbl_Area', 'dm_tbl_Area.IdArea', '=', 'tbl_tables.IdArea')
            ->whereIn('tbl_Orders.Status', ['1'])
            ->orderBy('tbl_Orders.TimeIn', 'desc')
            ->select('tbl_Orders.*', 'tbl_tables.TableName', 'dm_tbl_Area.AreaName', 'tbl_booking.NumberGuests')
            ->get();

        return view('admin.orders.index', ['listOrders' => $listOrders]);
    }

    function create()
    {
        $listItems = Items::where('isActive', true)->orderBy('created_at', 'desc')->get();
        $listPrice = PriceList::where('isActive', true)->get();
        $listCombo = Combo::where('isActive', true)->get();
        $listCategory = Category::where('isActive', true)->get();
        $listCustomer = Customer::all();
        $listTable = Tables::join('dm_tbl_area', 'dm_tbl_area.IdArea', '=', 'tbl_tables.IdArea')
            ->join('dm_tbl_tabletype', 'dm_tbl_tabletype.IdType', '=', 'tbl_tables.IdType')
            ->where('dm_tbl_area.isActive', true)
            ->whereIn('tbl_tables.IdStatus', ['1', '2'])
            ->select('dm_tbl_area.AreaName', 'tbl_tables.*', 'dm_tbl_tabletype.MaxSeats')
            ->get();

        return view('admin.orders.create', ['listTable' => $listTable, 'listCombo' => $listCombo, 'listItems' => $listItems, 'listCategory' => $listCategory, 'listPrice' => $listPrice, 'listCustomer' => $listCustomer]);
    }

    function create_post(Request $request)
    {
        //Cập nhật trạng thái bàn: Đang phục vụ
        $idTable = $request->input('IdTable');
        if (!empty($idTable)) {
            Tables::find($idTable)
                ->update([
                    'IdStatus' => 3
                ]);
        }

        $listItems = json_decode($request->input('Items'));
        $Total = 0;
        $TotalCost = 0;
        //Tính tổng tiền bán và tổng tiền gốc để lưu hóa đơn
        if (count($listItems) > 0) {
            foreach ($listItems as $items) {
                $Total += $items->Quantity * $items->Price;
                $TotalCost += $items->Quantity * $items->PriceCost;
            }
        }

        $order = Orders::create([
            'IdCustomer' => $request->input('IdCustomer') > 0 ? $request->input('IdCustomer') : null,
            'IdBooking' => null,
            'IdTable' => $idTable,
            'Discount' => null,
            'IdUser' => session()->get('IdUser') ?? null,
            'OrderDate' => Carbon::now(),
            'TimeIn' => Carbon::now(),
            'TimeOut' => null,
            'TotalCost' => $TotalCost,
            'TotalAmount' => $Total,
            'PaymentMethod' => null,
            'PaymentTime' => null,
            'Status' => '1',
            'Notes' => null
        ]);

        if ($order) {
            $data = [];
            if ($request->filled('Items')) {
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
        return response()->json(['success' => 'Lưu thành công']);
    }

    function orders_history()
    {
        $listOrder = Orders::leftjoin('tbl_cancelledorder', 'tbl_cancelledorder.IdOrder', '=', 'tbl_orders.IdOrder')
            ->join('tbl_tables', 'tbl_tables.IdTable', '=', 'tbl_orders.IdTable')
            ->join('dm_tbl_area', 'dm_tbl_area.IdArea', '=', 'tbl_tables.IdArea')
            ->join('dm_tbl_orderstatus', 'dm_tbl_orderstatus.IdStatus', '=', 'tbl_orders.Status')
            ->leftjoin('tbl_customer', 'tbl_customer.IdCustomer', '=', 'tbl_orders.IdCustomer')
            ->leftjoin('tbl_user', 'tbl_user.IdUser', '=', 'tbl_orders.IdUser')
            ->leftjoin('tbl_user AS tbl_user_cancel', 'tbl_user_cancel.IdUser', '=', 'tbl_cancelledorder.CancelledBy')
            ->orderBy('tbl_Orders.created_at', 'desc')
            ->select(
                'tbl_orders.*',
                'tbl_tables.TableName',
                'dm_tbl_area.AreaName',
                'tbl_customer.PhoneNumber',
                'dm_tbl_orderstatus.StatusName',
                'tbl_cancelledorder.CancellationDate',
                'tbl_cancelledorder.CancellationReason',
                DB::raw('CONCAT(tbl_customer.LastName, " ", tbl_customer.FirstName) AS `FullNameCus`'),
                DB::raw('CONCAT(tbl_user.LastName, " ", tbl_user.FirstName) AS `FullNameCreate`'),
                DB::raw('CONCAT(tbl_user_cancel.LastName, " ", tbl_user_cancel.FirstName) AS `FullNameCance`')
            )
            ->get();

        $listStatus = OrderStatus::where('isActive', true)->get();

        return view('admin.orders.orders-history', ['listOrder' => $listOrder, 'listStatus' => $listStatus]);
    }

    function table_list()
    {
        $listTable = Tables::join('dm_tbl_tablestatus', 'dm_tbl_tablestatus.IdStatus', '=', 'tbl_tables.IdStatus')
            ->select('dm_tbl_tablestatus.StatusName', 'tbl_tables.*')
            ->where('tbl_tables.isActive', true)
            ->get();

        $listArea = Area::where('isActive', true)->get();

        return view('admin.orders.table-list', ['listTable' => $listTable, 'listArea' => $listArea]);
    }

    function select_items($IdOrder) //Chọn món ăn
    {
        $listItems = Items::where('isActive', true)->orderBy('created_at', 'desc')->get();
        $listPrice = PriceList::where('isActive', true)->get();
        $listCombo = Combo::where('isActive', true)->get();
        $listCategory = Category::where('isActive', true)->get();
        $order = Orders::join('tbl_tables', 'tbl_tables.IdTable', '=', 'tbl_Orders.IdTable')
            ->join('dm_tbl_Area', 'dm_tbl_Area.IdArea', '=', 'tbl_tables.IdArea')
            ->select('tbl_Orders.*', 'tbl_tables.TableName', 'dm_tbl_Area.AreaName')
            ->find($IdOrder);

        $listItemsOfOrder = Orders::join('tbl_OrderDetails', 'tbl_OrderDetails.IdOrder', '=', 'tbl_Orders.IdOrder')
            ->join('tbl_Items', 'tbl_Items.IdItems', '=', 'tbl_OrderDetails.IdItems')
            ->leftjoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_Items.IdItems')
            ->select('tbl_OrderDetails.*', 'tbl_Items.ItemsName', 'tbl_Orders.TotalAmount', 'tbl_pricelist.SalePrice', 'tbl_pricelist.CostPrice')
            ->where('tbl_Orders.IdOrder', $IdOrder)->get();

        return view('admin.orders.select-items', ['order' => $order, 'listCombo' => $listCombo, 'listItems' => $listItems, 'listCategory' => $listCategory, 'listPrice' => $listPrice, 'IdOrder' => $IdOrder, 'listItemsOfOrder' => $listItemsOfOrder]);
    }

    function selected_items(Request $request, $IdOrder)
    {
        $order = Orders::find($IdOrder);

        //Cập nhật trạng thái bàn: Đang phục vụ
        if (!empty($order->IdTable)) {
            Tables::find($order->IdTable)
                ->update([
                    'IdStatus' => 3
                ]);
        }

        $listItems = json_decode($request->input('Items'));
        $Total = 0;
        $TotalCost = 0;
        //Tính tổng tiền bán và tổng tiền gốc để lưu hóa đơn
        if (count($listItems) > 0) {
            foreach ($listItems as $items) {
                $Total += $items->Quantity * $items->Price;
                $TotalCost += $items->Quantity * $items->PriceCost;
            }
        }

        $order->update([
            'IdUser' => session()->get('IdUser'),
            'TotalCost' => $TotalCost,
            'TotalAmount' => $Total
        ]);

        $data = [];
        if ($request->filled('Items')) {
            foreach (json_decode($request->input('Items')) as $items) {
                $data[] = [
                    'IdOrder' => $order->IdOrder,
                    'IdItems' => $items->IdItems,
                    'IdCombo' => null,
                    'Quantity' => $items->Quantity,
                    'PriceSale' => $items->Price,
                    'Amount' => $items->Quantity * $items->Price
                ];
            }

            // Xóa các mặt hàng không có trong dữ liệu đưa vào
            OrderDetails::where('IdOrder', $order->IdOrder)
                ->whereNotIn('IdItems', array_column($data, 'IdItems'))
                ->delete();

            foreach ($data as $item) {
                OrderDetails::updateOrCreate(
                    ['IdOrder' => $item['IdOrder'], 'IdItems' => $item['IdItems']],
                    $item
                );
            }
        }
        return response()->json(['success' => 'Thành công']);
    }

    function handlePayment($IdOrder)
    {
        $order = Orders::find($IdOrder);

        if ($order !== null) {
            $order->update([
                'Status' => "2",
                'PaymentMethod' => 'Tiền mặt',
                'PaymentTime' => Carbon::now(),
                'TimeOut' => Carbon::now()
            ]);

            Tables::find($order->IdTable)
                ->update([
                    'IdStatus' => 1
                ]);

            if ($order->IdBooking !== null && $order->IdBooking !== '') {
                Booking::find($order->IdBooking)
                    ->update([
                        'IdStatus' => 4
                    ]);
            }
            return response()->json(['success' => 'Thành công']);
        }

        return response()->json(['success' => 'Đã có lỗi xảy ra']);
    }

    function select_table($IdOrder) //Chuyển bàn
    {
        $listTable = Tables::leftjoin('dm_tbl_tablestatus', 'dm_tbl_tablestatus.IdStatus', '=', 'tbl_tables.IdStatus')
            ->leftjoin('dm_tbl_tabletype', 'dm_tbl_tabletype.IdType', '=', 'tbl_tables.IdType')
            ->select('dm_tbl_tablestatus.StatusName', 'tbl_tables.*', 'dm_tbl_tabletype.TypeName', 'dm_tbl_tabletype.MaxSeats')
            ->where('tbl_tables.isActive', true)
            ->get();

        $listArea = Area::where('isActive', true)->get();
        $order = Orders::find($IdOrder);

        return view('admin.orders.select-table', ['listTable' => $listTable, 'listArea' => $listArea, 'order' => $order]);
    }

    function selected_table($IdOrder, $IdTable) //xác nhận chuyển bàn
    {
        $order = Orders::find($IdOrder);

        if ($order !== null) {
            //Bàn cũ -> 'Trống'
            if (!empty($order->IdTable)) {
                $tableOld = Tables::find($order->IdTable);
                if ($tableOld) {
                    $tableOld->update([
                        'IdStatus' => 1
                    ]);
                }
            }

            if ($order->IdBooking !== null) {
                Booking::find($order->IdBooking)
                    ->update([
                        'IdTable' => $IdTable
                    ]);
            }

            $order->update([
                'IdTable' => $IdTable
            ]);

            //Bàn mới -> 'Đang phục vụ'
            Tables::find($IdTable)
                ->update([
                    'IdStatus' => 3
                ]);
        }
        return redirect('/admin/orders/index');
    }

    //Hủy đơn hàng
    function delete(Request $request, $IdOrder)
    {

        $order = Orders::find($IdOrder);

        if ($order) {
            $order->update([
                'Status' => 3
            ]);

            if ($order->IdBooking !== null && $order->IdBooking !== '') {
                Booking::find($order->IdBooking)
                    ->update([
                        'IdStatus' => 3
                    ]);
            }

            if ($order->IdTable !== null) {
                Tables::find($order->IdTable)
                    ->update([
                        'IdStatus' => 1
                    ]);
            }

            $save = CancelledOrder::create([
                'IdOrder' => $IdOrder,
                'CancellationReason' => $request->input('CancellationReason') ?? $request->input('Content'),
                'CancellationDate' => Carbon::now(),
                'CancelledBy' => session()->get('IdUser') ?? null
            ]);

            if ($save) {
                return response()->json(['success' => "Đã hủy đơn"]);
            }
        }

        return response()->json(['success' => "Có lỗi xảy ra"]);
    }

    function show($IdOrder)
    {
        $order = Orders::leftjoin('tbl_booking', 'tbl_Orders.IdBooking', '=', 'tbl_booking.IdBooking')
            ->leftjoin('tbl_user', 'tbl_user.IdUser', '=', 'tbl_Orders.IdUser')
            ->leftjoin('tbl_tables', 'tbl_tables.IdTable', '=', 'tbl_Orders.IdTable')
            ->leftjoin('dm_tbl_Area', 'dm_tbl_Area.IdArea', '=', 'tbl_tables.IdArea')
            ->leftjoin('dm_tbl_orderstatus', 'dm_tbl_orderstatus.IdStatus', '=', 'tbl_Orders.Status')
            ->leftjoin('tbl_customer', 'tbl_customer.IdCustomer', '=', 'tbl_Orders.IdCustomer')
            ->leftjoin('dm_tbl_tabletype', 'dm_tbl_tabletype.IdType', '=', 'tbl_tables.IdType')
            ->select(
                'dm_tbl_orderstatus.StatusName',
                'tbl_Orders.*',
                'dm_tbl_Area.AreaName',
                'tbl_tables.TableName',
                'tbl_booking.IdBooking',
                'dm_tbl_tabletype.TypeName',
                'dm_tbl_tabletype.MaxSeats',
                'tbl_customer.PhoneNumber',
                'tbl_customer.Address',
                'tbl_customer.Email',
                DB::raw('CONCAT(tbl_customer.LastName, " ", tbl_customer.FirstName) AS `FullNameCus`'),
                DB::raw('CONCAT(tbl_user.LastName, " ", tbl_user.FirstName) AS `FullNameCreate`')
            )
            ->find($IdOrder);

        $listItems = OrderDetails::join('tbl_Items', 'tbl_Items.IdItems', '=', 'tbl_orderdetails.IdItems')
            ->where('IdOrder', $IdOrder)
            ->select('tbl_Items.*', 'tbl_orderdetails.Quantity', 'tbl_orderdetails.PriceSale', 'tbl_orderdetails.Amount')
            ->get();
        return view('admin.orders.show', ['order' => $order, 'listItems' => $listItems]);
    }

    //In đơn hàng
    function print($IdOrder)
    {

        $order = Orders::leftjoin('tbl_user', 'tbl_user.IdUser', '=', 'tbl_Orders.IdUser')
            ->join('tbl_tables', 'tbl_tables.IdTable', '=', 'tbl_Orders.IdTable')
            ->join('dm_tbl_Area', 'dm_tbl_Area.IdArea', '=', 'tbl_tables.IdArea')
            ->leftjoin('tbl_customer', 'tbl_customer.IdCustomer', '=', 'tbl_Orders.IdCustomer')
            ->select(
                'tbl_Orders.*',
                'dm_tbl_Area.AreaName',
                'tbl_tables.TableName',
                DB::raw('CONCAT(tbl_customer.LastName, " ", tbl_customer.FirstName) AS `FullNameCus`'),
                DB::raw('CONCAT(tbl_user.LastName, " ", tbl_user.FirstName) AS `FullNameCreate`')
            )
            ->find($IdOrder);

        $listItems = OrderDetails::join('tbl_Items', 'tbl_Items.IdItems', '=', 'tbl_orderdetails.IdItems')
            ->where('IdOrder', $IdOrder)
            ->select('tbl_Items.*', 'tbl_orderdetails.Quantity', 'tbl_orderdetails.PriceSale', 'tbl_orderdetails.Amount')
            ->get();

        $info = RestaurantInfo::first();

        $pdf = PDF::loadView('pdf.print-order', [
            'IdOrder' => $IdOrder,
            'order' => $order,
            'listItems' => $listItems,
            'info' => $info
        ]);

        // Tùy chỉnh tệp PDF
        $pdf->setPaper('A5')->setOptions(['filename' => "HoaDon-$IdOrder.pdf"]);

        return $pdf->stream();
    }
}
