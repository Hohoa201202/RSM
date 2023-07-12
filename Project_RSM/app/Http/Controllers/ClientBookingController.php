<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Feedback;
use Carbon\Carbon;

class ClientBookingController extends Controller
{
    function index()
    {

        if (!session()->has('IdCustomer')) {
            return redirect('client.login');
        }
        $bookings = Booking::leftjoin('tbl_customer', 'tbl_customer.IdCustomer', '=', 'tbl_booking.IdCustomer')
            ->join('dm_tbl_bookingstatus', 'dm_tbl_bookingstatus.IdStatus', '=', 'tbl_booking.IdStatus')
            ->leftjoin('tbl_tables', 'tbl_tables.IdTable', '=', 'tbl_booking.IdTable')
            ->leftjoin('dm_tbl_area', 'dm_tbl_area.IdArea', '=', 'tbl_tables.IdArea')
            ->leftjoin('dm_tbl_branchs', 'dm_tbl_branchs.IdBranch', '=', 'tbl_booking.IdBranch')
            ->leftjoin('tbl_feedback', 'tbl_feedback.IdBooking', '=', 'tbl_booking.IdBooking')
            ->where('tbl_booking.isActive', true)
            ->where('tbl_customer.IdCustomer', session()->get('IdCustomer'))
            ->orderBy('tbl_booking.created_at', 'desc')
            ->select(
                'tbl_booking.*',
                'tbl_feedback.Id',
                'tbl_customer.LastName',
                'tbl_customer.FirstName',
                'tbl_customer.PhoneNumber',
                'dm_tbl_bookingstatus.StatusName',
                'dm_tbl_area.AreaName',
                'tbl_tables.TableName',
                'dm_tbl_branchs.BranchName',
                'dm_tbl_branchs.Address'
            )
            ->get();

        return view('client.booking.index', ['bookings' => $bookings]);
    }

    function feedback($IdBooking)
    {
        $Booking = Booking::find($IdBooking);
        return view('client.booking.feedback', ['Booking' => $Booking]);
    }

    function feedback_post(Request $request)
    {
        $check = Feedback::where('IdBooking', $request->input('IdBooking'))->get();

        if ($check->count() > 0) {
            return redirect()->back()->withErrors('Đơn đặt bàn này đã được đánh giá');
        }

        $feedback = Feedback::create([
            "IdCustomer" => session()->get("IdCustomer"),
            "IdBooking" => $request->input('IdBooking'),
            "NumStars" => $request->input('NumStars') ?? 5,
            "Content" => $request->input('Content'),
            "isApproved" => true,
            "FeedbackDate" => Carbon::now()
        ]);

        if ($feedback) {
            return redirect(route('client.booking.index'));
        }
        return redirect()->back()->withErrors('Đã có lỗi xảy ra');
    }
}
