<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nhà hàng</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href={{ asset('files/images/favicon.png') }} rel="icon">
    <link href={{ asset('files/images/apple-touch-icon.png') }} rel="apple-touch-icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/8a67f7fd97.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href={{ asset('assets/fonts/iconic/css/material-design-iconic-font.min.css')}}>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href={{ asset('assets/fonts/linearicons-v1.0.0/icon-font.min.css')}}>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">


    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Thư viện jQuery UI -->

    <!-- Plugin jQuery Timepicker -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <!-- Vendor CSS Files -->
    <link href={{ asset('assets/vendor/aos/aos.css') }} rel="stylesheet">
    <link href={{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href={{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }} rel="stylesheet">
    <link href={{ asset('assets/vendor/boxicons/css/boxicons.min.css') }} rel="stylesheet">
    <link href={{ asset('assets/vendor/glightbox/css/glightbox.min.css') }} rel="stylesheet">
    <link href={{ asset('assets/vendor/remixicon/remixicon.css') }} rel="stylesheet">
    <link href={{ asset('assets/vendor/swiper/swiper-bundle.min.css') }} rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href={{ asset('assets/css/style.css') }} rel="stylesheet">
    <link href={{ asset('assets/css/mycss.css') }} rel="stylesheet">

    <!-- Summer Note -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Gp
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    @include('Layouts.client._Header')
    <!-- End Header -->

    @yield('content')
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('Layouts.client._Footer')
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <!-- Account -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart d-flex flex-column p-4">
            <div class="header-cart-title d-flex pb-3 w-100 justify-content-between align-items-center">
                <span class="fs-5 cl2 text-primary  text-uppercase">
                    Thực đơn bạn đã chọn
                </span>
                <div class="fs-3 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="bi bi-x-lg"></i>
                </div>
            </div>

            <div class="sidebar-content flex-w w-full p-lr-65 js-pscroll p-0" id="form-items-selected">
                @if (session()->has('ArrItems'))
                    @foreach ($itemsCart = session()->get('ArrItems') as $item)
                        <div class="accordion-item items-selected wrap-cart-{{ $item['IdItems'] }}">
                            <div class="accordion-header pt-3 pb-2">
                                <div class="d-flex collapsed justify-content-between align-items-center">
                                    <div class="col-xl-5 d-flex flex-column m-0 p-0">
                                        <p class="m-0 fw-bold">{{ $item['ItemsName'] }}</p>
                                        <p class="m-0">{{ number_format($item['Price'], 0, '.', '.') }} ₫</p>
                                    </div>

                                    <div class="col-xl-3 m-0 fw-bold d-flex justify-content-center align-items-center">
                                        <a onclick="subQuantity(this)" data-id="{{ $item['IdItems'] }}"
                                            class="fs-5 py-0 px-1 pe-1 btn btn-light"><i
                                                class="text-danger bi bi-dash"></i></a>

                                        <p class="m-0 fs-6 text-center px-2 quantity quantity-{{ $item['IdItems'] }}">
                                            {{ $item['Quantity'] }}
                                        </p>

                                        <a onclick="addQuantity(this)" data-id="{{ $item['IdItems'] }}"
                                            class="fs-5 py-0 px-1 ps-1 btn btn-light"><i
                                                class="text-success bi bi-plus"></i></a>
                                    </div>

                                    <p class="col-xl-3 m-0 fw-bold text-end total-of-item-{{ $item['IdItems'] }}">
                                        {{ number_format($item['Price'] * $item['Quantity'], 0, '.', '.') }} ₫</p>

                                    <div class="col-xl-1 fs-3 py-0 text-end ps-2" onclick="deleteItemCartView(this)"
                                        data-id="{{ $item['IdItems'] }}"><i class="text-danger fs-5 bi bi-trash3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <a class="btn btn-primary mt-4 py-2" href="{{ route('show-cart') }}">Đặt bàn ngay</a>
        </div>
    </div>
    <!-- Account -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <!-- Vendor JS Files -->
    <script src={{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}></script>
    <script src={{ asset('assets/vendor/aos/aos.js') }}></script>
    <script src={{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}></script>
    <script src={{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}></script>
    <script src={{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}></script>
    <script src={{ asset('assets/vendor/php-email-form/validate.js') }}></script>

    <!-- Template Main JS File -->
    <script src={{ asset('assets/js/main.js') }}></script>
    <script src={{ asset('assets/js/myjs.js') }}></script>
    <script>
        // [Cart]
        $('.js-show-cart').on('click', function() {
            $('.js-panel-cart').addClass('show-header-cart');
        });

        $('.js-hide-cart').on('click', function() {
            $('.js-panel-cart').removeClass('show-header-cart');
        });
    </script>

    <script>
        const itemsCart = [
            @if (session()->has('ArrItems'))
                @foreach ($itemsCart = session()->get('ArrItems') as $item)
                    {
                        'IdItems': {{ $item['IdItems'] }},
                        'Quantity': {{ $item['Quantity'] }},
                        'Price': {{ $item['Price'] }},
                        'PriceCost': {{ $item['PriceCost'] }}
                    },
                @endforeach
            @endif
        ];

        function submit_booking() {
            if (!CheckValueBooking()) {
                return;
            }

            let formData = new FormData();
            // formData.append('Total', $('input[name="Total"]').val());
            formData.append('NumberGuests', $("#NumberGuests").val());
            formData.append('FullName', $("#FullName").val());
            formData.append('PhoneNumber', $("#PhoneNumber").val());
            formData.append('TimeSlot', $("#TimeSlot").val());
            formData.append('BookingDate', $("#BookingDate").val());
            formData.append('IdBranch', $("#IdBranch").val());
            formData.append('Items', JSON.stringify(itemsCart));

            $.ajax({
                url: '{{ route('cart.booking') }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // showSuccessNotification('rgba(0, 200, 81, 0.85)', response.success);
                    window.location.href = '/cart/payment/' + response.success;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
                }
            });
        };
    </script>

    <script>
        $('.wrap-rating').each(function() {
            var item = $(this).find('.item-rating');
            var rated = -1;
            var input = $(this).find('input');
            $(input).val(5);

            $(item).on('mouseenter', function() {
                var index = item.index(this);
                var i = 0;
                for (i = 0; i <= index; i++) {
                    $(item[i]).removeClass('zmdi-star-outline');
                    $(item[i]).addClass('zmdi-star');
                }

                for (var j = i; j < item.length; j++) {
                    $(item[j]).addClass('zmdi-star-outline');
                    $(item[j]).removeClass('zmdi-star');
                }
            });

            $(item).on('click', function() {
                var index = item.index(this);
                rated = index;
                $(input).val(index + 1);
            });

            $(this).on('mouseleave', function() {
                var i = 0;
                for (i = 0; i <= rated; i++) {
                    $(item[i]).removeClass('zmdi-star-outline');
                    $(item[i]).addClass('zmdi-star');
                }

                for (var j = i; j < item.length; j++) {
                    $(item[j]).addClass('zmdi-star-outline');
                    $(item[j]).removeClass('zmdi-star');
                }
            });
        });
    </script>
</body>

</html>
