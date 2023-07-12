@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left" style="margin-right: 8px;"></i><a
                            href="{{ back()->getTargetUrl() }}">Quay lại trang trước</a></li>
                    <li class="breadcrumb-item active">Chi tiết đặt bàn: {{ $booking->IdBooking }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-10 col-xl-10 mx-auto">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="tab-content " id="borderedTabJustifiedContent" >

                                <div class="accordion" id="">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Thông tin đặt bàn
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body px-5 py-4">

                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Ngày đặt bàn</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">
                                                        {{ date_format(new DateTime($booking->created_at), 'd/m/Y - H:i') }}
                                                    </div>
                                                </div>
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Ngày dự kiến nhận bàn</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">
                                                        {{ date_format(new DateTime($booking->BookingDate), 'd/m/Y') }}
                                                    </div>
                                                </div>
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Giờ nhận bàn dự kiến</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $booking->TimeSlot }}</div>
                                                </div>
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Số khách hàng</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $booking->NumberGuests }} người</div>
                                                </div>
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label "> Ghi chú</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $booking->Note }}</div>
                                                </div>

                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label "> Tham chiếu</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">
                                                        @if ($booking->IdOrder !== null && $booking->IdOrder !== '')
                                                            Hóa đơn
                                                            <a href="{{ route('orders-show', ['IdOrder' => $booking->IdOrder]) }}" class="text-decoration-underline">{{ $booking->IdOrder }}</a>
                                                        @else
                                                            <div class="label text-danger">Không</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row align-items-center py-1">
                                                    <div class="col-lg-4 col-md-4 label ">Trạng thái đơn</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">
                                                        @if ($booking->IdStatus === 1)
                                                            <span class="text-warning">
                                                                {{ $booking->StatusName }} </span>
                                                        @elseif ($booking->IdStatus === 3)
                                                            <span class="text-danger">
                                                                {{ $booking->StatusName }} </span>
                                                        @else
                                                            <span class="text-success">
                                                                {{ $booking->StatusName }} </span>
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
                                                    <div class="col-lg-7 col-md-7">{{ $booking->AreaName }}</div>
                                                </div>
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label "> Bàn</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $booking->TableName }}</div>
                                                </div>
                                                <div class="row align-items-center py-1">
                                                    <div class="col-lg-4 col-md-4 label "> Loại bàn</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $booking->TypeName }} (Tối đa {{ $booking->MaxSeats }} người)</div>
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
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Họ và tên</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $booking->FullNameCus }}</div>
                                                </div>
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Số điện thoại</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $booking->PhoneNumber }}</div>
                                                </div>
                                                <div class="row align-items-center py-1 mb-3">
                                                    <div class="col-lg-4 col-md-4 label ">Email</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $booking->Email }}</div>
                                                </div>
                                                <div class="row align-items-center py-1">
                                                    <div class="col-lg-4 col-md-4 label ">Địa chỉ</div>
                                                    <div class="col-lg-1 col-md-1 label text-end">:</div>
                                                    <div class="col-lg-7 col-md-7">{{ $booking->Address }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/admin/booking/booking-history" class="mt-3 btn btn-light">
                                    <i class="bi bi-chevron-double-left"></i>
                                    Quay lại
                                </a>
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
