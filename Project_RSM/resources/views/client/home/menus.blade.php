@extends('layouts.client._Layout')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="m-0 text-primary">Thực đơn</h2>
                    <ol>
                        <li><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li>Thực đơn</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3 list-menu" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical" style="min-width: 20%;">
                        <p class="nav-link block-title text-center">
                            Thực đơn
                        </p>

                        @if (!empty($listMenus))
                            @foreach ($listMenus as $menu)
                                <button
                                    class="nav-link menus-name text-start @if ($loop->iteration === 1) active @endif"
                                    id="v-pills-{{ $menu->IdMenu }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-{{ $menu->IdMenu }}" type="button" role="tab"
                                    aria-controls="v-pills-{{ $menu->IdMenu }}"
                                    aria-selected="true">{{ $menu->MenuName }}</button>
                            @endforeach
                        @endif
                    </div>

                    <div class="tab-content flex-grow-1" id="v-pills-tabContent">
                        @if (!empty($listMenus))
                            @foreach ($listMenus as $menu)
                                <div class="tab-pane fade show @if ($loop->iteration === 1) active @endif"
                                    id="v-pills-{{ $menu->IdMenu }}" role="tabpanel"
                                    aria-labelledby="v-pills-{{ $menu->IdMenu }}-tab">
                                    <div class="row ">
                                        @if (!empty($listItems))
                                            @foreach ($listItems->where('IdMenu', $menu->IdMenu)->take(8) as $item)
                                                <div
                                                    class="col-lg-3 mb-4 col-md-4 portfolio-item filter-{{ $item->IdMenu }}">
                                                    <div class="portfolio-wrap">
                                                        <div class="m-b-20" style="height: 12rem; width: 100%;">
                                                            <img id="img-account"
                                                                src="{{ asset('files/images/items/' . $item->Avatar) }}"
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
                                                            <a class="btn btn-primary btn-add-cart"
                                                                data-id="{{ $item->IdItems }}"
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
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        // // Xử lý khi người dùng chuyển tab
        // $('.menus-name').click(function() {
        //     var menuId = $(this).attr('data-menu-id');
        //     loadItems(menuId);
        // });

        // // Hàm tải dữ liệu phân trang cho tab hiện tại
        // function loadItems(menuId, page = 1) {
        //     $.ajax({
        //         url: '/load-items',
        //         type: 'GET',
        //         data: {
        //             menuId: menuId,
        //             page: page
        //         },
        //         success: function(response) {
        //             var itemsContainer = $('#items-container-' + menuId);
        //             var paginationContainer = $('#pagination-container-' + menuId);

        //             itemsContainer.html(response.itemsHtml);
        //             paginationContainer.html(response.paginationHtml);
        //         },
        //         error: function(xhr, status, error) {
        //             console.log(error);
        //         }
        //     });
        // }
    </script>
@endsection
