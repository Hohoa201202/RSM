<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\RestaurantInfo;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login');
    }

    function index()
    {
        return view('admin.setting.index');
    }

    function show_res_info()
    {
        $info = RestaurantInfo::first();
        if ($info) {
            return view('admin.setting.show-res-info', ['info' => $info]);
        }
        return view('admin.setting.create-res-info');
    }

    function res_info_post()
    {
        $info = RestaurantInfo::first();
        if ($info) {
            return redirect(route('show-res-info'));
        }
        return view('admin.setting.create-res-info');
    }

    function create_res_info()
    {
        $info = RestaurantInfo::first();
        if ($info) {
            return redirect(route('show-res-info'));
        }
        return view('admin.setting.create-res-info');
    }

    function create_post(Request $request)
    {
        $info = RestaurantInfo::first();
        if ($info) {
            return redirect(route('show-res-info'));
        }

        if ($request->hasFile('Logo')) {
            // Có chọn tệp
            $fileName =  Str::slug($request->input('ResName'), '') . '_' . now()->format('Ymd-His') . '.' . $request->file('Logo')->getClientOriginalExtension();
            $request->file('Logo')->move(public_path('files/images/iconSystem'), $fileName);
            $Logo = $fileName;
        } else {
            // Không chọn tệp
            $Logo = "default.png";
        }

        $request->validate([
            'ResName' => 'required'
        ], [
            'ResName.required' => 'Tên nhà hàng không được trống.'
        ]);

        RestaurantInfo::create([
            'ResName' => $request->input('ResName'),
            'Hotline1' => $request->input('Hotline1'),
            'Hotline2' => $request->input('Hotline2'),
            'Email' => $request->input('Email'),
            'Logo' => $Logo,
            'OpeningDay' => $request->input('OpeningDay'),
            'OpenTime' => $request->input('OpenTime'),
            'CloseTime' => $request->input('CloseTime'),
            'ShortDescription' => $request->input('ShortDescription'),
            'LongDescription' => $request->input('LongDescription')
        ]);
        return view('admin.setting.index');
    }

    function update_post(Request $request)
    {
        $info = RestaurantInfo::first();

        if ($info->count() > 0) {
            $Logo =  $request->input('Logo');
            if ($request->hasFile('_Logo')) { // Có chọn tệp
                $fileName =  Str::slug($request->input('ResName'), '') . '_' . now()->format('Ymd-His') . '.' . $request->file('_Logo')->getClientOriginalExtension();
                $request->file('_Logo')->move(public_path('files/images/iconSystem'), $fileName);
                $Logo = $fileName;
            }

            $request->validate([
                'ResName' => 'required'
            ], [
                'ResName.required' => 'Tên nhà hàng không được trống.'
            ]);

            $info->update([
                'ResName' => $request->input('ResName'),
                'Hotline1' => $request->input('Hotline1'),
                'Hotline2' => $request->input('Hotline2'),
                'Email' => $request->input('Email'),
                'Logo' => $Logo,
                'OpeningDay' => $request->input('OpeningDay'),
                'OpenTime' => $request->input('OpenTime'),
                'CloseTime' => $request->input('CloseTime'),
                'ShortDescription' => $request->input('ShortDescription'),
                'LongDescription' => $request->input('LongDescription')
            ]);
            return view('admin.setting.index');
        }
        return redirect(route('create-res-info'));
    }
}
