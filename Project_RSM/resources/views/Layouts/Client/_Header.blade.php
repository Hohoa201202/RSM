<!-- ======= Header ======= -->
<header id="header" class="fixed-top" style="background-color: rgba(0, 0, 0, 0.5)">
    <div class="container d-flex align-items-center justify-content-lg-between">

        <h1 class="logo me-auto me-lg-0"><a href="index.html">hah<span>.</span></a></h1>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <x-MenuClient />
                <li class="ms-5 search-mobile">
                    <form action="{{ route('client.search') }}"
                        class="input-affix m-v-10 d-flex align-items-center form-serch">
                        <input id="Key" autocomplete="off" name="Key" type="text"
                            class="form-control-search" placeholder="Tìm kiếm món ăn">
                        <button class="prefix-icon anticon anticon-search opacity-04 btn-primary" style="border-radius: 0 0.375rem 0.375rem 0; padding: 5.4px 13px; cursor: pointer;">
                            <i class="bi bi-search "></i>
                        </button>
                    </form>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- navbar -->

        <div class="d-flex align-items-center">
            <a class="get-started-btn scrollto xxxicon-header-noti js-show-cart" data-notify="2">
                <i class="bi bi-cart"></i>
            </a>

            @if (session()->has('IdCustomer'))
                <div class="nav-item dropdown pe-3 ms-3 h-100">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <div style="height: 2.45rem; width: 2.45rem;">
                            <img src="{{ asset('files/images/customer/' . session()->get('CusAvatar')) }}"
                                alt="Profile" class="rounded-circle"
                                style="width: 100%;height: 100%; object-fit: cover;cursor: pointer;">
                        </div>
                        <span style="color: #fff;"
                            class="d-none d-md-block dropdown-toggle ps-2">{{ session()->get('CusLastName') . ' ' . session()->get('CusFirstName') }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ session()->get('CusLastName') . ' ' . session()->get('CusFirstName') }}</h6>
                            <span>{{ session()->get('CusUserName') }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>Tài khoản của tôi</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ route('client.booking.index') }}">
                                <i class="bi bi-gear"></i>
                                <span>Đơn đặt bàn</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Trợ giúp ?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('client.logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('client.login') }}" class="ms-3 get-started-btn scrollto">Đăng nhập</a>
            @endif

        </div>
    </div>
</header><!-- End Header -->
