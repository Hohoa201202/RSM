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
                                <h4 class="breadcrumb-item active">Lịch sử đơn hàng</h4>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-start">
                                        <a style="color: #fff;" class="btn btn-primary mb-3" href="/admin/orders/create">
                                            <i class="bi bi-plus-circle"></i>
                                            <span>Tạo đơn mới</span>
                                        </a>
                                    </div>

                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="All-tab" data-bs-toggle="tab"
                                                data-bs-target="#bordered-All" type="button" role="tab"
                                                aria-controls="All" aria-selected="true">Tất cả</button>
                                        </li>

                                        @foreach ($listStatus as $item)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="{{ $item->IdStatus }}-tab" data-bs-toggle="tab"
                                                    data-bs-target="#bordered-{{ $item->IdStatus }}" type="button"
                                                    role="tab" aria-controls="{{ $item->IdStatus }}"
                                                    aria-selected="false" tabindex="-1">{{ $item->StatusName }}</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content pt-2" id="borderedTabContent">
                                        <div class="tab-pane fade show active" id="bordered-All" role="tabpanel"
                                            aria-labelledby="All-tab">

                                            @if (!empty($listOrder))
                                                <table class="table table-hover e-commerce-table table-borderless datatable">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">STT</th>
                                                            <th class="text-center" scope="col">Thu ngân</th>
                                                            <th class="text-center" scope="col">Khu vực/Bàn</th>
                                                            <th class="text-center" scope="col">Thông tin KH</th>
                                                            <th class="text-center" scope="col">Tổng tiền</th>
                                                            <th class="text-center" scope="col">Trạng thái</th>
                                                            <th class="text-center" scope="col">------------</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="records_table"
                                                        style="vertical-align:-webkit-baseline-middle !important;">
                                                        @foreach ($listOrder as $item)
                                                            <tr onclick="window.location.href='{{ route('orders-show', ['IdOrder' => $item->IdOrder]) }}';"
                                                                class="cursor-pointer">
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td class="text-center">{{ $item->FullNameCreate }}</td>
                                                                <td class="text-center">{{ $item->AreaName }}, bàn {{ $item->TableName }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex flex-column">
                                                                        <label>
                                                                            @if ($item->FullNameCus === null)
                                                                                Khách lẻ
                                                                            @else
                                                                                {{ $item->FullNameCus }}
                                                                            @endif
                                                                        </label>

                                                                        <label>
                                                                            {{ $item->PhoneNumber }}
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ number_format($item->TotalAmount, 0, '.', '.') }} ₫
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($item->Status === 1)
                                                                        <span class="text-center badge badge-warning">
                                                                            {{ $item->StatusName }} </span>
                                                                    @elseif ($item->Status === 2)
                                                                        <span class="text-center badge badge-success">
                                                                            {{ $item->StatusName }} </span>
                                                                    @else
                                                                        <span class="text-center badge badge-canceled">
                                                                            {{ $item->StatusName }} </span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="{{ route('orders-show', ['IdOrder' => $item->IdOrder]) }}"
                                                                        class="btn btn-success">
                                                                        <i class="bi bi-eye"></i>
                                                                        Chi tiết
                                                                    </a>
                                                                    @if ($item->Status === 2)
                                                                        <a href="{{ route('orders-print', ['IdOrder' => $item->IdOrder]) }}"
                                                                            class="btn btn-secondary">
                                                                            <i class="bi bi-printer"></i>
                                                                            In
                                                                        </a>
                                                                    @endif
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

                                        @foreach ($listStatus as $status)
                                            <div class="tab-pane fade" id="bordered-{{ $status->IdStatus }}"
                                                role="tabpanel" aria-labelledby="{{ $status->IdStatus }}-tab">
                                                @if ($listOrder->where('Status', $status->IdStatus)->count() > 0)
                                                    <table class="table table-hover e-commerce-table table-borderless datatable">
                                                        <thead>
                                                            {{-- Trạng thái hủy --}}
                                                            @if ($status->IdStatus === 3)
                                                                <tr>
                                                                    <th class="text-start" scope="col">Thời gian hủy
                                                                    </th>
                                                                    <th class="text-center" scope="col">Lý do hủy</th>
                                                                    <th class="text-center" scope="col">Tham chiếu</th>
                                                                    <th class="text-center" scope="col">Người hủy</th>
                                                                    <th class="text-center" scope="col">Khu vực/Bàn
                                                                    </th>
                                                                    <th class="text-center" scope="col">Thông tin KH
                                                                    </th>
                                                                    <th class="text-end" scope="col">Tổng tiền</th>
                                                                    <th class="text-center" scope="col">------------
                                                                    </th>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <th class="text-start" scope="col">Thời gian thanh
                                                                        toán
                                                                    </th>
                                                                    <th class="text-center" scope="col">Tham chiếu</th>
                                                                    <th class="text-center" scope="col">Thu ngân</th>
                                                                    <th class="text-center" scope="col">Khu vực/Bàn
                                                                    </th>
                                                                    <th class="text-center" scope="col">Thông tin KH
                                                                    </th>
                                                                    <th class="text-center" scope="col">Thanh toán</th>
                                                                    <th class="text-end" scope="col">Tổng tiền</th>
                                                                    <th class="text-center" scope="col">------------
                                                                    </th>
                                                                </tr>
                                                            @endif

                                                        </thead>
                                                        <tbody id="records_table"
                                                            style="vertical-align:-webkit-baseline-middle !important;">
                                                            @if ($status->IdStatus === 3)
                                                                @foreach ($listOrder->where('Status', $status->IdStatus) as $item)
                                                                    <tr onclick="window.location.href='{{ route('orders-show', ['IdOrder' => $item->IdOrder]) }}';"
                                                                        class="cursor-pointer">
                                                                        <td class="text-start">
                                                                            {{ Carbon::parse($item->CancellationDate)->format('d/m/Y H:i') }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $item->CancellationReason }}</td>
                                                                        <td class="text-center">
                                                                            @if ($item->IdBooking !== null && $item->IdBooking !== '')
                                                                                Mã đặt bàn
                                                                                <a class="text-decoration-underline"
                                                                                    href="{{ route('booking-show', ['IdBooking' => $item->IdBooking]) }}">{{ $item->IdBooking }}</a>
                                                                            @else
                                                                                Không
                                                                            @endif
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $item->FullNameCance }}
                                                                        </td>
                                                                        <td class="text-center">{{ $item->AreaName }}, bàn
                                                                            {{ $item->TableName }}</td>
                                                                        <td class="text-center">
                                                                            <div class="d-flex flex-column">
                                                                                <label>
                                                                                    @if ($item->FullNameCus === null)
                                                                                        Khách lẻ
                                                                                    @else
                                                                                        {{ $item->FullNameCus }}
                                                                                    @endif
                                                                                </label>

                                                                                <label>
                                                                                    {{ $item->PhoneNumber }}
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-end">
                                                                            {{ number_format($item->TotalAmount, 0, '.', '.') }}
                                                                            ₫
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="{{ route('orders-show', ['IdOrder' => $item->IdOrder]) }}"
                                                                                class="btn btn-success">
                                                                                <i class="bi bi-eye"></i>
                                                                                Chi tiết
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                @foreach ($listOrder->where('Status', $status->IdStatus) as $item)
                                                                    <tr onclick="window.location.href='{{ route('orders-show', ['IdOrder' => $item->IdOrder]) }}';"
                                                                        class="cursor-pointer">
                                                                        <td class="text-start">
                                                                            {{ Carbon::parse($item->PaymentTime)->format('d/m/Y H:i') }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            @if ($item->IdBooking !== null && $item->IdBooking !== '')
                                                                                Mã đặt bàn
                                                                                <a class="text-decoration-underline"
                                                                                    href="{{ route('booking-show', ['IdBooking' => $item->IdBooking]) }}">{{ $item->IdBooking }}</a>
                                                                            @else
                                                                                Không
                                                                            @endif
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $item->FullNameCreate }}
                                                                        </td>
                                                                        <td class="text-center">{{ $item->AreaName }}, bàn
                                                                            {{ $item->TableName }}</td>
                                                                        <td class="text-center">
                                                                            <div class="d-flex flex-column">
                                                                                <label>
                                                                                    @if ($item->FullNameCus === null)
                                                                                        Khách lẻ
                                                                                    @else
                                                                                        {{ $item->FullNameCus }}
                                                                                    @endif
                                                                                </label>

                                                                                <label>
                                                                                    {{ $item->PhoneNumber }}
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            @if ($item->PaymentMethod === null)
                                                                                Chờ thanh toán
                                                                            @else
                                                                                {{ $item->PaymentMethod }}
                                                                            @endif
                                                                        </td>
                                                                        <td class="text-end">
                                                                            {{ number_format($item->TotalAmount, 0, '.', '.') }}
                                                                            ₫
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="{{ route('orders-show', ['IdOrder' => $item->IdOrder]) }}"
                                                                                class="btn btn-success">
                                                                                <i class="bi bi-eye"></i>
                                                                                Chi tiết
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif

                                                        </tbody>
                                                    </table>
                                                @else
                                                    <div class="col-lg-4 mx-auto mt-5">
                                                        <img style="width: 100%;"
                                                            src="{{ asset('files/images/iconSystem/filter-booking-null.svg') }}"
                                                            alt="Trống">
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
