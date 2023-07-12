@extends('Layouts.Admin._Layout')

@php
    use Carbon\Carbon;
    $now = Carbon::now();
@endphp

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12" style="margin: 0 auto;">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb" style="justify-content: space-between;">
                                <h4 class="breadcrumb-item active">Lịch sử đặt bàn</h4>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body p-4">
                                    <a style="color: #fff;" class="btn btn-primary mb-3" href="/admin/booking/create">
                                        <i class="bi bi-plus-circle"></i>
                                        <span>Tạo đơn đặt bàn</span>
                                    </a>

                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="All-tab" data-bs-toggle="tab"
                                                data-bs-target="#bordered-All" type="button" role="tab"
                                                aria-controls="All" aria-selected="true">Tất cả</button>
                                        </li>

                                        @foreach ($listBookingStatus as $item)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="{{ $item->IdStatus }}-tab" data-bs-toggle="tab"
                                                    data-bs-target="#bordered-{{ $item->IdStatus }}" type="button"
                                                    role="tab" aria-controls="{{ $item->IdStatus }}"
                                                    aria-selected="false" tabindex="-1">{{ $item->StatusName }}</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content pt-2" id="borderedTabContent">
                                        <div class="tab-pane fade active show" id="bordered-All" role="tabpanel"
                                            aria-labelledby="All-tab">

                                            @if (!empty($listBooking))
                                                <table class="table table-hover e-commerce-table table-borderless datatable">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-start" scope="col" >Dự kiến nhận bàn</th>
                                                            <th class="text-center" scope="col" >Khách hàng</th>
                                                            <th class="text-end" scope="col">Đặt cọc</th>
                                                            <th class="text-center" scope="col">Số khách</th>
                                                            <th class="text-center" scope="col" data-sortable="false">Khu vực/Bàn</th>
                                                            <th class="text-center" scope="col">Trạng thái</th>
                                                            <th class="text-center" scope="col" data-sortable="false">----------</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="records_table"
                                                        style="vertical-align:-webkit-baseline-middle !important;">
                                                        @foreach ($listBooking as $item)
                                                            <tr onclick="window.location.href='{{ route('booking-show', ['IdBooking' => $item->IdBooking]) }}';" class="cursor-pointer">
                                                                <td class="text-start">
                                                                    {{ $now->format('d/m/Y') . ' (' . $item->TimeSlot }})
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="d-flex flex-column">
                                                                        <label>
                                                                            {{ $item->LastName . ' ' . $item->FirstName }}
                                                                        </label>
                                                                        <label>
                                                                            {{ $item->PhoneNumber }}
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td class="text-end">0 đ</td>
                                                                <td class="text-center">{{ $item->NumberGuests }}</td>
                                                                <td class="text-center">{{ $item->AreaName }}, bàn {{ $item->TableName }}</td>
                                                                <td class="text-center">
                                                                    @if ($item->IdStatus === 1)
                                                                        <span class="text-center badge badge-warning">
                                                                            {{ $item->StatusName }} </span>
                                                                    @elseif ($item->IdStatus === 2)
                                                                        <span class="text-center badge badge-success">
                                                                            {{ $item->StatusName }} </span>
                                                                    @elseif ($item->IdStatus === 3)
                                                                        <span class="text-center badge badge-canceled">
                                                                            {{ $item->StatusName }} </span>
                                                                    @else
                                                                        <span class="text-center badge badge-success">
                                                                            {{ $item->StatusName }} </span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="{{ route('booking-show', ['IdBooking' => $item->IdBooking]) }}" class="btn btn-success">
                                                                        <i class="bi bi-eye"></i>
                                                                        Chi tiết
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <div class="col-lg-4 mx-auto mt-5">
                                                    <img style="width: 100%;"
                                                        src="{{ asset('files/images/iconSystem/filter-booking-null.svg') }}"
                                                        alt="Khách hàng trống">
                                                </div>
                                            @endif
                                        </div>

                                        @foreach ($listBookingStatus as $status)
                                            <div class="tab-pane fade" id="bordered-{{ $status->IdStatus }}"
                                                role="tabpanel" aria-labelledby="{{ $status->IdStatus }}-tab">
                                                @if ($listBooking->where('IdStatus', $status->IdStatus)->count() > 0)
                                                    <table class="table table-hover e-commerce-table table-borderless datatable">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-start" scope="col">Dự kiến nhận bàn</th>
                                                                <th class="text-center" scope="col">Khách hàng</th>
                                                                <th class="text-end" scope="col">Đặt cọc</th>
                                                                <th class="text-center" scope="col">Số khách</th>
                                                                <th class="text-center" scope="col">Khu vực/Bàn</th>
                                                                <th class="text-center" scope="col" data-sortable="false">Trạng thái</th>
                                                                <th class="text-center" scope="col" data-sortable="false">----------</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="records_table"
                                                            style="vertical-align:-webkit-baseline-middle !important;">
                                                            @foreach ($listBooking->where('IdStatus', $status->IdStatus) as $item)
                                                                <tr onclick="window.location.href='{{ route('booking-show', ['IdBooking' => $item->IdBooking]) }}';" class="cursor-pointer">
                                                                    <td class="text-start">
                                                                        {{ $now->format('d/m/Y') . ' (' . $item->TimeSlot }})
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="d-flex flex-column">
                                                                            <label>
                                                                                {{ $item->LastName . ' ' . $item->FirstName }}
                                                                            </label>
                                                                            <label>
                                                                                {{ $item->PhoneNumber }}
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-end">0 đ</td>
                                                                    <td class="text-center">{{ $item->NumberGuests }}</td>
                                                                    <td class="text-center">{{ $item->AreaName }}, bàn {{ $item->TableName }}</td>
                                                                    <td class="text-center">
                                                                        @if ($item->IdStatus === 1)
                                                                            <span class="text-center badge badge-warning">
                                                                                {{ $item->StatusName }} </span>
                                                                        @elseif ($item->IdStatus === 2)
                                                                            <span class="text-center badge badge-success">
                                                                                {{ $item->StatusName }} </span>
                                                                        @elseif ($item->IdStatus === 3)
                                                                            <span class="text-center badge badge-canceled">
                                                                                {{ $item->StatusName }} </span>
                                                                        @else
                                                                            <span class="text-center badge badge-success">
                                                                                {{ $item->StatusName }} </span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="{{ route('booking-show', ['IdBooking' => $item->IdBooking]) }}" class="btn btn-success">
                                                                            <i class="bi bi-eye"></i>
                                                                            Chi tiết
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <div class="col-lg-4 mx-auto mt-5">
                                                        <img style="width: 100%;"
                                                            src="{{ asset('files/images/iconSystem/filter-booking-null.svg') }}"
                                                            alt="Khách hàng trống">
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div><!-- End Bordered Tabs -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>
    <!--End main-->
@endsection
