<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Tables;
use App\Models\Area;
use App\Models\Items;
use App\Models\PriceList;
use App\Models\BookingStatus;
use App\Models\Category;
use App\Models\Combo;
use App\Models\OrderDetails;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    function index()
    {
        $listBooking = Booking::leftjoin('tbl_tables', 'tbl_tables.IdTable', '=', 'tbl_booking.IdTable')
            ->join('tbl_customer', 'tbl_customer.IdCustomer', '=', 'tbl_booking.IdCustomer')
            ->select('tbl_booking.*', 'tbl_customer.LastName', 'tbl_customer.FirstName', 'tbl_customer.PhoneNumber', 'tbl_tables.TableName')
            ->whereIn('tbl_booking.IdStatus', ['1'])
            ->orderBy('tbl_booking.BookingDate', 'desc')
            ->orderBy('tbl_booking.TimeSlot', 'desc')
            ->get();

        return view('admin.booking.index', ['listBooking' => $listBooking]);
    }

    function booking_history()
    {
        $listBooking = Booking::leftjoin('tbl_customer', 'tbl_customer.IdCustomer', '=', 'tbl_booking.IdCustomer')
            ->join('dm_tbl_bookingstatus', 'dm_tbl_bookingstatus.IdStatus', '=', 'tbl_booking.IdStatus')
            ->leftjoin('tbl_tables', 'tbl_tables.IdTable', '=', 'tbl_booking.IdTable')
            ->leftjoin('dm_tbl_area', 'dm_tbl_area.IdArea', '=', 'tbl_tables.IdArea')
            ->where('tbl_booking.isActive', true)
            ->orderBy('tbl_booking.created_at', 'desc')
            ->select(
                'tbl_booking.*',
                'tbl_customer.LastName',
                'tbl_customer.FirstName',
                'tbl_customer.PhoneNumber',
                'dm_tbl_bookingstatus.StatusName',
                'dm_tbl_area.AreaName',
                'tbl_tables.TableName'
            )
            ->get();
        $listBookingStatus = BookingStatus::where('isActive', true)->get();

        return view('admin.booking.booking-history', ['listBooking' => $listBooking, 'listBookingStatus' => $listBookingStatus]);
    }

    function create()
    {
        $listItems = Items::where('isActive', true)->get();
        $listPrice = PriceList::where('isActive', true)->get();
        $listTable = Tables::join('dm_tbl_area', 'dm_tbl_area.IdArea', '=', 'tbl_tables.IdArea')
            ->join('dm_tbl_tabletype', 'dm_tbl_tabletype.IdType', '=', 'tbl_tables.IdType')
            ->where('dm_tbl_area.isActive', true)
            ->whereIn('tbl_tables.IdStatus', ['1'])
            ->select('dm_tbl_area.AreaName', 'tbl_tables.*', 'dm_tbl_tabletype.MaxSeats')
            ->get();

        return view('admin.booking.create', ['listItems' => $listItems, 'listPrice' => $listPrice, 'listTable' => $listTable]);
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

        if ($booking) {
            if ($booking->IdTable > 0) {
                Tables::find($booking->IdTable)
                    ->update([
                        'IdStatus' => 2
                    ]);
            }
        }

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

    function select_table($IdBooking)
    {
        $listTable = Tables::leftjoin('dm_tbl_tablestatus', 'dm_tbl_tablestatus.IdStatus', '=', 'tbl_tables.IdStatus')
            ->leftjoin('dm_tbl_tabletype', 'dm_tbl_tabletype.IdType', '=', 'tbl_tables.IdType')
            ->select('dm_tbl_tablestatus.StatusName', 'tbl_tables.*', 'dm_tbl_tabletype.TypeName', 'dm_tbl_tabletype.MaxSeats')
            ->where('tbl_tables.isActive', true)
            ->get();

        $listArea = Area::where('isActive', true)->get();
        $booking = Booking::find($IdBooking);

        return view('admin.booking.select-table', ['listTable' => $listTable, 'listArea' => $listArea, 'booking' => $booking]);
    }

    function selected_table($IdBooking, $IdTable)
    {
        $booking = Booking::find($IdBooking);

        //Nếu tồn tại thì bàn cũ -> trống
        if (!empty($booking->IdTable)) {
            $tableOld = Tables::find($booking->IdTable);
            if ($tableOld) {
                $tableOld->update([
                    'IdStatus' => 1
                ]);
            }
        }

        //Set bàn mới
        $booking->update([
            'IdTable' => $IdTable
        ]);

        $orderCheck = Orders::where('IdBooking', $IdBooking)->first();
        if ($orderCheck !== null) {
            $orderCheck->update([
                'IdUser' => session()->get('IdUser'),
                'IdTable' => $IdTable,
                'OrderDate' => Carbon::now(),
                'TimeIn' => Carbon::now(),
                'Status' => null,
                'IdTable' => $IdTable
            ]);
        }

        if ($booking) {
            $table = Tables::find($IdTable)
                ->update([
                    'IdStatus' => 2
                ]);

            if ($table) {
                if (session()->has('redirect_url')) {
                    $redirectUrl = session()->get('redirect_url');
                    session()->forget('redirect_url'); // Xóa URL tạm thời
                    return redirect($redirectUrl);
                }
                return redirect(route('booking'));
            }
        }
    }

    function delete($IdBooking) //hủy đơn
    {
        $booking = Booking::find($IdBooking);

        $order = Orders::where('IdBooking', $IdBooking)->first();

        if ($order !== null) {
            $order->update([
                'Status' => '3'
            ]);
        }

        $booking->update([
            'IdStatus' => 3,
            'isActive' => true
        ]);

        if (!empty($booking->IdTable)) {
            Tables::find($booking->IdTable)
                ->update([
                    'IdStatus' => 1
                ]);
        }

        if ($booking) {
            return response()->json(['success' => "Đã hủy đơn $IdBooking"]);
        }
    }

    function select_items($IdBooking) //Chọn món ăn
    {
        $listItems = Items::where('isActive', true)
            ->orderBy('created_at', 'desc')->get();
        $listPrice = PriceList::where('isActive', true)->get();
        $listCombo = Combo::where('isActive', true)->get();
        $listCategory = Category::where('isActive', true)->get();

        $listItemsOfOrder = Orders::join('tbl_OrderDetails', 'tbl_OrderDetails.IdOrder', '=', 'tbl_Orders.IdOrder')
            ->join('tbl_Items', 'tbl_Items.IdItems', '=', 'tbl_OrderDetails.IdItems')
            ->leftjoin('tbl_pricelist', 'tbl_pricelist.IdItems', '=', 'tbl_Items.IdItems')
            ->select('tbl_OrderDetails.*', 'tbl_Items.ItemsName', 'tbl_Orders.TotalAmount', 'tbl_pricelist.SalePrice', 'tbl_pricelist.CostPrice')
            ->where('tbl_Orders.IdBooking', $IdBooking)->get();

        return view('admin.booking.select-items', ['listCombo' => $listCombo, 'listItems' => $listItems, 'listCategory' => $listCategory, 'listPrice' => $listPrice, 'IdBooking' => $IdBooking, 'listItemsOfOrder' => $listItemsOfOrder]);
    }

    function selected_items(Request $request, $IdBooking)
    {

        $booking = Booking::find($IdBooking);
        $orderCheck = Orders::where('IdBooking', $IdBooking)->first();

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

        if ($orderCheck === null) {
            $order = Orders::create([
                'IdCustomer' => $booking->IdCustomer,
                'IdBooking' => $IdBooking,
                'IdTable' => $booking->IdTable,
                'Discount' => null,
                'IdUser' => session()->get('IdUser'),
                'OrderDate' => Carbon::now(),
                'TimeIn' => null,
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
        } else {
            $orderCheck->update([
                'IdUser' => session()->get('IdUser'),
                'TotalCost' => $TotalCost,
                'TotalAmount' => $Total
            ]);

            $data = [];
            if ($request->filled('Items')) {
                foreach ($listItems as $items) {
                    $data[] = [
                        'IdOrder' => $orderCheck->IdOrder,
                        'IdItems' => $items->IdItems,
                        'IdCombo' => null,
                        'Quantity' => $items->Quantity,
                        'PriceSale' => $items->Price,
                        'Amount' => $items->Quantity * $items->Price
                    ];
                }

                // Xóa các mặt hàng không có trong dữ liệu đưa vào
                OrderDetails::where('IdOrder', $orderCheck->IdOrder)
                    ->whereNotIn('IdItems', array_column($data, 'IdItems'))
                    ->delete();

                foreach ($data as $item) {
                    OrderDetails::updateOrCreate(
                        ['IdOrder' => $item['IdOrder'], 'IdItems' => $item['IdItems']],
                        $item
                    );
                }
            }
        }

        return true;
    }

    function receive($IdBooking)
    {
        $booking = Booking::find($IdBooking);

        $booking->update([
            'IdStatus' => 2
        ]);

        if (!empty($booking->IdTable)) {
            Tables::find($booking->IdTable)
                ->update([
                    'IdStatus' => 3
                ]);
        }

        $orderCheck = Orders::where('IdBooking', $IdBooking)->first();
        if ($orderCheck === null) {
            $order = Orders::create([
                'IdCustomer' => $booking->IdCustomer,
                'IdBooking' => $IdBooking,
                'IdTable' => $booking->IdTable > 0 ? $booking->IdTable : null,
                'Discount' => null,
                'IdUser' => session()->get('IdUser'),
                'OrderDate' => Carbon::now(),
                'TimeIn' => Carbon::now(),
                'TimeOut' => null,
                'TotalCost' => 0,
                'TotalAmount' => 0,
                'PaymentMethod' => null,
                'PaymentTime' => null,
                'Status' => '1',
                'Notes' => null
            ]);

            if ($order) {
                if ($booking->IdTable === null) {
                    session()->put('redirect_url', route('orders-select-items', ['IdOrder' => $order->IdOrder]));
                    return redirect(route('select-table', ['IdBooking' => $IdBooking]));
                }
            }
            return redirect(route('orders-select-items', ['IdOrder' => $order->IdOrder]));
        } else {
            $orderCheck->update([
                'IdUser' => session()->get('IdUser'),
                'OrderDate' => Carbon::now(),
                'TimeIn' => Carbon::now(),
                'Status' => '1',
                'Idtable' => $booking->IdTable > 0 ? $booking->IdTable : null
            ]);

            if ($booking->IdTable === null) {
                session()->put('redirect_url', route('orders-select-items', ['IdOrder' => $orderCheck->IdOrder]));
                return redirect(route('select-table', ['IdBooking' => $IdBooking]));
            }
            return redirect(route('orders-select-items', ['IdOrder' => $orderCheck->IdOrder]));
        }
    }

    function show($IdBooking)
    {
        $booking = Booking::leftjoin('tbl_Orders', 'tbl_Orders.IdBooking', '=', 'tbl_booking.IdBooking')
            ->leftjoin('tbl_tables', 'tbl_tables.IdTable', '=', 'tbl_booking.IdTable')
            ->leftjoin('dm_tbl_Area', 'dm_tbl_Area.IdArea', '=', 'tbl_tables.IdArea')
            ->leftjoin('dm_tbl_bookingstatus', 'dm_tbl_bookingstatus.IdStatus', '=', 'tbl_booking.IdStatus')
            ->leftjoin('tbl_customer', 'tbl_customer.IdCustomer', '=', 'tbl_booking.IdCustomer')
            ->leftjoin('dm_tbl_tabletype', 'dm_tbl_tabletype.IdType', '=', 'tbl_tables.IdType')
            ->select(
                'dm_tbl_bookingstatus.StatusName',
                'tbl_booking.*',
                'dm_tbl_Area.AreaName',
                'tbl_tables.TableName',
                'tbl_Orders.IdOrder',
                'dm_tbl_tabletype.TypeName',
                'dm_tbl_tabletype.MaxSeats',
                'tbl_customer.PhoneNumber',
                'tbl_customer.Address',
                'tbl_customer.Email',
                DB::raw('CONCAT(tbl_customer.LastName, " ", tbl_customer.FirstName) AS `FullNameCus`'),
            )
            ->find($IdBooking);

        return view('admin.booking.show', ['booking' => $booking]);
    }
}
