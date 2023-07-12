@extends('layouts.client._Layout')
@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="m-0 text-primary">Kết quả thanh toán</h2>
                    <ol>
                        <li><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li>Thanh toán</li>
                        <li>Kết quả</li>
                    </ol>
                </div>
            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-12 py-5 my-5">
                        @if ($check === 0)
                            <h2 class="text-center text-success">
                                Đặt bàn thành công
                            </h2>
                            <p class="text-center font-italic mt-3">
                                Cảm ơn quý khách đã đặt bàn tại nhà hàng của chúng tôi.
                            </p>
                        @elseif ($check === 1)
                            <h2 class="text-center text-success">
                                Thanh toán thành công
                            </h2>
                            <p class="text-center font-italic mt-3">
                                Cảm ơn quý khách đã đặt bàn tại nhà hàng của chúng tôi.
                            </p>
                        @else
                            <h2 class="text-center text-danger">
                                Thanh toán thất bại! Đã có lỗi xảy ra
                            </h2>
                        @endif
                    </div>
                    <div class="col-12 d-flex justify-content-between">
                        <a href="/" class="btn btn-light">
                            <i class="bi bi-caret-left-fill"></i>
                            Quay về trang chủ</a>
                        <a href="{{ route('show-menus') }}" class="btn btn-light">
                            Tiếp tục chọn món
                            <i class="bi bi-caret-right-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
