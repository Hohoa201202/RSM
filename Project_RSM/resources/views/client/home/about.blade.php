@extends('layouts.client._Layout')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="m-0 text-primary">Giới thiệu</h2>
                    <ol>
                        <li><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li>Giới thiệu</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="col-12 mt-3">
                                {{ $info->OpeningDay }}
                            </div>
                            <div class="col-12 mt-3">
                                Giờ mở cửa: {{ $info->OpenTime }}
                            </div>
                            <div class="col-12 mt-3">
                                Giờ mở cửa: {{ $info->CloseTime }}
                            </div>
                            <div class="col-12 mt-3">
                                Liên hệ: {{ $info->Hotline1 }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        {!! $info->LongDescription !!}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
