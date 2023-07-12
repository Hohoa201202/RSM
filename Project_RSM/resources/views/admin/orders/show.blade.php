@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left" style="margin-right: 8px;"></i><a
                            href="{{ back()->getTargetUrl() }}">Quay lại trang trước</a></li>
                    <li class="breadcrumb-item active">Chi tiết hóa đơn: {{ $order->IdOrder }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-10 col-xl-10 mx-auto">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="tab-content " id="borderedTabJustifiedContent">

                                <div class="accordion" id="">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Thông tin hóa đơn
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body px-5 py-4">

                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Thời gian lập hóa đơn</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">
                                                        {{ date_format(new DateTime($order->created_at), 'd/m/Y - H:i') }}
                                                    </div>
                                                </div>
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Thời gian khách vào</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">
                                                        {{ date_format(new DateTime($order->TimeIn), 'd/m/Y - H:i') }}
                                                    </div>
                                                </div>
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Thời gian khách ra</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">
                                                        {{ date_format(new DateTime($order->TimeOut), 'd/m/Y - H:i') }}
                                                    </div>
                                                </div>

                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Tổng tiền</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">
                                                        {{ number_format($order->TotalAmount, 0, '.', '.') }} đ</div>
                                                </div>

                                                @if ($order->Status != 3)
                                                    <div class="row align-items-center py-1 mb-3">
                                                        <div class="col-lg-4 col-md-4 label ">Phương thức thanh toán</div>
                                                        <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                        <div class="col-lg-7 col-md-7">{{ $order->PaymentMethod }}</div>
                                                    </div>

                                                    <div class="row align-items-center py-1 mb-3">
                                                        <div class="col-lg-4 col-md-4 label ">Thời gian thanh toán</div>
                                                        <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                        <div class="col-lg-7 col-md-7">
                                                            @if ($order->PaymentTime !== null && $order->PaymentTime !== '')
                                                                {{ date_format(new DateTime($order->PaymentTime), 'd/m/Y - H:i') }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label "> Tham chiếu</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">
                                                        @if ($order->IdBooking !== null && $order->IdBooking !== '')
                                                            Đặt bàn
                                                            <a href="{{ route('booking-show', ['IdBooking' => $order->IdBooking]) }}"
                                                                class="text-decoration-underline">{{ $order->IdBooking }}</a>
                                                        @else
                                                            <div class="label text-danger">Không</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row align-items-center py-1">
                                                    <div class="col-lg-4 col-md-4 label ">Trạng thái đơn</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">
                                                        @if ($order->Status == 1)
                                                            <span class="text-warning">
                                                                {{ $order->StatusName }} </span>
                                                        @elseif ($order->Status == 3)
                                                            <span class="text-danger">
                                                                {{ $order->StatusName }} </span>
                                                        @else
                                                            <span class="text-success">
                                                                {{ $order->StatusName }} </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Bàn và khu vực
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body px-5 py-4">
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Khu vực</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $order->AreaName }}</div>
                                                </div>
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label "> Bàn</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $order->TableName }}</div>
                                                </div>
                                                <div class="row align-items-center py-1">
                                                    <div class="col-lg-4 col-md-4 label "> Loại bàn</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $order->TypeName }} (Tối đa
                                                        {{ $order->MaxSeats }} người)</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Thông tin khách hàng
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body px-5 py-4">
                                                @if ($order->IdCustomer !== null && $order->IdCustomer !== '')
                                                    <div class="row align-items-center py-1 mb-3">
                                                        <div class="col-lg-4 col-md-4 label ">Họ và tên</div>
                                                        <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                        <div class="col-lg-7 col-md-7">{{ $order->FullNameCus }}</div>
                                                    </div>
                                                    <div class="row align-items-center py-1 mb-3">
                                                        <div class="col-lg-4 col-md-4 label ">Số điện thoại</div>
                                                        <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                        <div class="col-lg-7 col-md-7">{{ $order->PhoneNumber }}</div>
                                                    </div>
                                                    <div class="row align-items-center py-1 mb-3">
                                                        <div class="col-lg-4 col-md-4 label ">Email</div>
                                                        <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                        <div class="col-lg-7 col-md-7">{{ $order->Email }}</div>
                                                    </div>
                                                    <div class="row align-items-center py-1">
                                                        <div class="col-lg-4 col-md-4 label ">Địa chỉ</div>
                                                        <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                        <div class="col-lg-7 col-md-7">{{ $order->Address }}</div>
                                                    </div>
                                                @else
                                                    <div class="row align-items-center py-1">
                                                        <div class="col-lg-4 col-md-4 label ">Khách hàng</div>
                                                        <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                        <div class="col-lg-7 col-md-7">Khách lẻ</div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- List Items --}}
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading4">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse4"
                                                aria-expanded="false" aria-controls="collapse4">
                                                Chi tiết hóa đơn
                                            </button>
                                        </h2>
                                        <div id="collapse4" class="accordion-collapse collapse"
                                            aria-labelledby="heading4" data-bs-parent="#accordionExample">
                                            <div class="accordion-body px-5 py-4">
                                                @if ($listItems !== null)
                                                    <table class="table table-striped" style="border-collapse: initial;">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="text-center">STT</th>
                                                                <th scope="col">Mặt hàng</th>
                                                                <th scope="col" class="text-center">Giá bán</th>
                                                                <th scope="col" class="text-center">Số lượng</th>
                                                                <th scope="col" class="text-end">Thành tiền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($listItems as $item)
                                                                <tr>
                                                                    <th scope="row" class="align-middle text-center">{{ $loop->iteration }}</th>
                                                                    <td class="d-flex align-items-center align-middle">
                                                                        <div style="height: 3rem; width: 3rem;" class="me-3">
                                                                            <img id="img-account" src="{{ asset('files/images/items/' . $item->Avatar) }}"
                                                                                alt="Profile" class="rounded-circle-items" >
                                                                        </div>
                                                                        {{ $item->ItemsName }}
                                                                    </td>
                                                                    <td class="text-center align-middle">{{ number_format($item->PriceSale, 0, '.', '.') }} đ</td>
                                                                    <td class="text-center align-middle">{{ $item->Quantity }}</td>
                                                                    <td class="text-end align-middle">{{ number_format($item->Amount, 0, '.', '.') }} đ</td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                    <div class="row mt-4">
                                                        <div class="col-xl-7 col-lg-7 col-md-8 mb-3">
                                                        </div>
                                                        <div class="col-xl-5 col-lg-5 col-md-4">
                                                            <div class="d-flex flex-column justify-content-between">
                                                                <div class="flex-grow-1">
                                                                    <div class="d-flex mb-2">
                                                                        <p class="p-0 m-0">Tạm tính:</p>
                                                                        <p class="p-0 m-0 ms-auto" id="total-money">{{ number_format($order->TotalAmount, 0, '.', '.') }} đ</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="d-flex mb-2">
                                                                        <p class="p-0 m-0">Khuyến mãi:</p>
                                                                        <p class="p-0 m-0 ms-auto"></p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="d-flex mb-2">
                                                                        <p class="p-0 m-0">Tổng cộng (VAT):</p>
                                                                        <p class="p-0 m-0 ms-auto" id="total-amount">{{ number_format($order->TotalAmount, 0, '.', '.') }} đ</p>
                                                                        <input type="hidden" name="Total" value="{{ $order->TotalAmount }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row align-items-center py-1">
                                                        Trống
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="/admin/orders/orders-history" class="btn btn-light">
                                        <i class="bi bi-chevron-double-left"></i>
                                        Quay lại
                                    </a>
                                    @if ($order->Status === 2)
                                        <a href="{{ route('orders-print', ['IdOrder' => $order->IdOrder]) }}" class="btn btn-success">
                                            <i class="bi bi-printer"></i>
                                            In hóa đơn
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--End main-->

    <script></script>
@endsection
