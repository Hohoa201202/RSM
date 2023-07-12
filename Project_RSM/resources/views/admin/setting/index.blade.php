@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12" style="margin: 0 auto;">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb" style="justify-content: space-between;">
                                <h4 class="breadcrumb-item active text-uppercase">thiết lập nhà hàng</h4>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="fw-bold">Thiết lập thông tin</p>
                                    <div class="row ">
                                        <div class="col col-lg-4 col-md-6 mb-3 "
                                            data-aos="zoom-in" data-aos-delay="100">
                                            <a href="{{ route('create-res-info') }}">
                                                <div class="d-flex d-flex flex-column align-items-center form-setting">
                                                    <div class="icon setting-icon">
                                                        <i class=" bi bi-shop"></i>
                                                    </div>
                                                    <h4 class="setting-title mt-2">Thông tin nhà hàng</h4>
                                                    <p class="setting-subtitle">Xem và điều chỉnh thông tin nhà hàng của bạn</p>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col col-lg-4 col-md-6 mb-3"
                                            data-aos="zoom-in" data-aos-delay="100">
                                            <a href="/admin/branchs/index">
                                                <div class="d-flex d-flex flex-column align-items-center form-setting">
                                                    <div class="icon setting-icon">
                                                        <i class="bi bi-building"></i>
                                                    </div>
                                                    <h4 class="setting-title mt-2">Thiết lập cơ sở</h4>
                                                    <p class="setting-subtitle">Xem và điều chỉnh thông tin nhà hàng của bạn</p>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col col-lg-4 col-md-6 mb-3"
                                            data-aos="zoom-in" data-aos-delay="100">
                                            <a href="/admin/area/index">
                                                <div class="d-flex d-flex flex-column align-items-center form-setting">
                                                    <div class="icon setting-icon">
                                                        <i class="bi bi-geo-fill"></i>
                                                    </div>
                                                    <h4 class="setting-title mt-2">Thiết lập khu vực và bàn</h4>
                                                    <p class="setting-subtitle">Xem và điều chỉnh thông tin nhà hàng của bạn</p>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col col-lg-4 col-md-6 mb-3"
                                            data-aos="zoom-in" data-aos-delay="100">
                                            <a href="/admin/tabletype/index">
                                                <div class="d-flex d-flex flex-column align-items-center form-setting">
                                                    <div class="icon setting-icon">
                                                        <i class="bi bi-geo-fill"></i>
                                                    </div>
                                                    <h4 class="setting-title mt-2">Thiết lập loại bàn</h4>
                                                    <p class="setting-subtitle">Xem và điều chỉnh thông tin nhà hàng của bạn</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>
    <!--End main-->
@endsection
