@extends('layouts.client._Layout')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="m-0 text-primary">Kết quả tìm kiếm</h2>
                    <ol>
                        <li><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li>Tìm kiếm mặt hàng</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <div class="row">

                    @if (!empty($Items))
                        @foreach ($Items as $item)
                            <div class="col-lg-3 mb-4 col-md-4 mb-5 portfolio-item ">
                                <div class="portfolio-wrap">
                                    <div class="m-b-20" style="height: 16rem; width: 100%;">
                                        <img id="img-account" src="{{ asset('files/images/items/' . $item->Avatar) }}"
                                             alt="Profile" class="img-fluid"
                                            style="width: 100%;height: 100%; object-fit: cover;cursor: pointer; border-radius: 1rem;">
                                    </div>
                                </div>
                                <div class="info-menus mt-4" style="">
                                    <div class="info-items">
                                        <label class="items-name"> {{ $item->ItemsName }} </label>
                                        <div class="d-flex">
                                            <span class="items-price">
                                                {{ number_format($item->SalePrice, 0, '.', '.') }} ₫
                                            </span>
                                        </div>
                                    </div>
                                    <div class="list-btn d-flex">
                                        <a class="btn btn-primary btn-add-cart" data-id="{{ $item->IdItems }}"
                                            data-price="{{ $item->SalePrice != null ? $item->SalePrice : 0 }}"
                                            data-pricecost="{{ $item->CostPrice != null ? $item->CostPrice : 0 }}"
                                            data-name="{{ $item->ItemsName }}">
                                            Đặt món
                                        </a>
                                        {{-- <a class="btn btn-primary">
                                            Xem chi tiết
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
