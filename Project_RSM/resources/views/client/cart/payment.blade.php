@extends('layouts.client._Layout')
@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="m-0 text-primary">Thanh toán</h2>
                    <ol>
                        <li><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li>Thanh toán</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="d-flex justify-content-between mb-4 align-items-center">
                        <a href="/" class="btn btn-light">
                            <i class="bi bi-chevron-left"></i>Quay lại</a>
                        <div class="text-center text-uppercase text-primary fw-bold fs-5">
                            thanh toán trước cho đơn đặt bàn
                        </div>
                        <div></div>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content " id="borderedTabJustifiedContent">
                            <div class="accordion" id="">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button text-primary fw-bold fs-6" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Thông tin đơn đặt bàn
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-4">
                                            <div class="row align-items-center py-1 mb-3">
                                                <div class="col-lg-4 col-4 label ">Tên người đặt bàn: </div>
                                                <div class="col-lg-1 col-1 label text-end">:</div>
                                                <div class="col-lg-6 col-7">
                                                    {{ $booking->FullNameCus }}
                                                </div>
                                            </div>
                                            <div class="row align-items-center py-1 mb-3">
                                                <div class="col-lg-4 col-4 label ">Điện thoại</div>
                                                <div class="col-lg-1 col-1 label text-end">:</div>
                                                <div class="col-lg-6 col-7">
                                                    {{ $booking->PhoneNumber }}
                                                </div>
                                            </div>
                                            <div class="row align-items-center py-1 mb-3">
                                                <div class="col-lg-4 col-4 label ">Thời gian dùng bữa dự kiến: </div>
                                                <div class="col-lg-1 col-1 label text-end">:</div>
                                                <div class="col-lg-6 col-7">
                                                    {{ date_format(new DateTime($booking->BookingDate), 'd/m/Y') . ' (' . $booking->TimeSlot . ')' }}
                                                </div>
                                            </div>
                                            <div class="row align-items-center py-1">
                                                <div class="col-lg-4 col-4 label ">Địa điểm dùng bữa:</div>
                                                <div class="col-lg-1 col-1 label text-end">:</div>
                                                <div class="col-lg-6 col-7">
                                                    {{ $booking->BranchName . ' - ' . $booking->Address }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- List Items --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading4">
                                        <button class="accordion-button text-primary fw-bold fs-6" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true"
                                            aria-controls="collapse4">
                                            Thực đơn đặt trước
                                        </button>
                                    </h2>
                                    <div id="collapse4" class="accordion-collapse collapse show" aria-labelledby="heading4"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-4">
                                            @if (session()->has('ArrItems') && count(session('ArrItems')) > 0)
                                                <table class="table table-bordered m-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">STT</th>
                                                            <th class="text-start" scope="col">Món ăn</th>
                                                            <th class="text-center" scope="col">Giá bán</th>
                                                            <th class="text-center" scope="col">Số lượng</th>
                                                            <th class="text-center" scope="col">Thành tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $Quantity = 0;
                                                        @endphp
                                                        @foreach ($itemsCart = session()->get('ArrItems') as $item)
                                                            @php
                                                                $Quantity += $item['Quantity'];
                                                            @endphp
                                                            <tr class="items-cart wrap-cart-{{ $item['IdItems'] }}"
                                                                data-id="{{ $item['IdItems'] }}">
                                                                <input type="hidden" name="Price"
                                                                    value="{{ $item['Price'] }}">
                                                                <td class="text-center fw-bold">
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td class="d-flex align-items-center">
                                                                    <div class="m-b-20 me-3"
                                                                        style="height: 3rem; width: 3rem;">
                                                                        <img id="img-account"
                                                                            src="{{ asset('files/images/items/' . $item['Avatar']) }}"
                                                                            alt="Profile" class="rounded-circle-items"
                                                                            style="">
                                                                    </div>
                                                                    {{ $item['ItemsName'] }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ number_format($item['Price'], 0, '.', '.') }} ₫</td>
                                                                <td
                                                                    class="text-center quantity m-0 d-flex justify-content-center align-items-center">
                                                                    <p
                                                                        class="m-0 fs-6 text-center px-3 quantity-{{ $item['IdItems'] }}">
                                                                        {{ $item['Quantity'] }}
                                                                    </p>
                                                                </td>
                                                                <td
                                                                    class="text-center total-of-item-{{ $item['IdItems'] }}">
                                                                    {{ number_format($item['Price'] * $item['Quantity'], 0, '.', '.') }}
                                                                    ₫
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="3" class="text-center fw-bold">
                                                                Tổng cộng
                                                            </td>

                                                            <td class="text-center fw-bold">
                                                                {{ $Quantity }}
                                                            </td>

                                                            <td class="text-center fw-bold">
                                                                {{ number_format($booking->TotalAmount, 0, '.', '.') }} ₫
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @else
                                                <div class="col-lg-4 mx-auto mt-5">
                                                    <img style="width: 100%;"
                                                        src="{{ asset('files/images/iconSystem/filter-booking-null.svg') }}"
                                                        alt="Trống">
                                                    <h4 class="text-center mt-4 text-primary">Không đặt trước món</a>
                                                    </h4>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row ">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <form action="/cart/checkout/{{ $booking->IdOrder }}" method="post">
                                    @csrf
                                    <div class="d-flex flex-column justify-content-between form-payment-cart">
                                        <p class="m-0 text-center text-uppercase text-primary fw-bold title-payment">Thanh
                                            toán
                                        </p>
                                        <div class="p-4">
                                            <div class="flex-grow-1 mb-3">
                                                <div class="d-flex">
                                                    <p class="p-0 m-0">Tạm tính:</p>
                                                    <p class="p-0 m-0 ms-auto fw-bold" id="total-money"></p>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 mb-3">
                                                <div class="d-flex">
                                                    <p class="p-0 m-0">Khuyến mãi:</p>
                                                    <p class="p-0 m-0 ms-auto"></p>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 pt-3 mb-3 border-top-line">
                                                <div class="d-flex">
                                                    <p class="p-0 m-0">Tổng cộng (VAT):</p>
                                                    <p class="p-0 m-0 ms-auto fw-bold text-danger" id="total-amount"></p>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3 pt-3 border-top-line-bold">
                                                <label class="form-check-label mb-3">
                                                    Phương thức thanh toán
                                                </label>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="method"
                                                        id="method1" value="0" checked="">
                                                    <label class="form-check-label" for="method1">
                                                        Thanh toán tại nhà hàng
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="method"
                                                        id="method2" value="1">
                                                    <label class="form-check-label" for="method2">
                                                        Thanh toán qua ví VNPAY
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="method"
                                                        id="method3" value="3">
                                                    <label class="form-check-label" for="method3">
                                                        Chuyển khoản ngân hàng
                                                    </label>
                                                </div>
                                                <div class="d-none" id="stk-atm">
                                                    <ul class="list-group ">
                                                        <li class="list-group-item">STK: 9704198526191432198</li>
                                                        <li class="list-group-item">Chủ TK: HO ANH HOA</li>
                                                        <li class="list-group-item">Ngân hàng: BIDV</li>
                                                        <li class="list-group-item">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput" placeholder="Mã tham chiếu"
                                                                    name="idbank">
                                                                <label for="floatingInput">Mã tham chiếu</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-4 pt-3 border-top-line-bold d-none" id="HinhThuc">
                                                <label class="form-check-label mb-3">
                                                    Hình thức thanh toán
                                                </label>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="check"
                                                        id="gridRadios1" value="0" checked="">
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Thanh toán toàn bộ
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="check"
                                                        id="gridRadios2" value="1">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Đặt cọc một phần
                                                    </label>
                                                </div>
                                                <div class="form-floating d-none" id="input-money">
                                                    <input type="number" class="form-control" id="floatingInput"
                                                        placeholder="100.000" name="Total">
                                                    <label for="floatingInput">Nhập số tiền cọc</label>
                                                </div>
                                            </div>
                                            <div class="d-gri gap-2">
                                                <input type="hidden" name="redirect" value="1">
                                                <button class="btn btn-success btn-block text-uppercase w-100 p-2">
                                                    Thanh toán
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    <script>
        $('input[name="check"]').change(function() {
            if ($(this).val() === "1") {
                $('#input-money').removeClass('d-none');
            } else {
                $('#input-money').addClass('d-none');
            }
        });

        $('input[name="method"]').change(function() {
            if ($(this).val() === "1") {
                $('#HinhThuc').removeClass('d-none');
                $('#stk-atm').addClass('d-none');
            } else if ($(this).val() === "3") {
                $('#stk-atm').removeClass('d-none');
                $('#HinhThuc').addClass('d-none');
            } else {
                $('#HinhThuc').addClass('d-none');
                $('#stk-atm').addClass('d-none');
            }
        });
    </script>
@endsection
