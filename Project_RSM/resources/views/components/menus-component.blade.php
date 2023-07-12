<section id="menus" class="portfolio next-section">
    <div class="container" data-aos="fade-up">

        <div class="d-flex justify-content-between align-items-center">
            <div class="section-title">
                <h2>Thực đơn</h2>
                <p> Bạn muốn ăn gì? </p>
            </div>
            <div class="d-flex justify-content-between pb-5">

                <div>
                    <a href="{{ route('show-menus') }}" class="btn btn-primary radius-zero ms-2">
                        <i class="bi bi-clipboard2-check"></i>
                        Xem tất cả
                    </a>
                </div>
            </div>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                    @if (!empty($listMenus))
                        @foreach ($listMenus as $key => $item)
                            <li data-filter=".filter-{{ $item->IdMenu }}">{{ $item->MenuName }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

            @if (!empty($listMenus))
                @foreach ($listMenus as $menu)
                    @if (!empty($listItems))
                        @foreach ($listItems->where('IdMenu', $menu->IdMenu)->take(8) as $item)
                            <div class="col-lg-3 col-md-4 portfolio-item filter-{{ $item->IdMenu }}">
                                <div class="portfolio-wrap">
                                    <div class="m-b-20" style="height: 17rem; width: 100%;">
                                        <img id="img-account" src="{{ asset('files/images/items/' . $item->Avatar) }}"
                                            alt="Profile" class="img-fluid"
                                            style="width: 100%;height: 100%; object-fit: cover;cursor: pointer;">
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
                @endforeach
            @endif
        </div>
    </div>
</section>
