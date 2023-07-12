@extends('layouts.client._Layout')
@section('content')
    @php
        use Carbon\Carbon;
        $now = Carbon::now();
    @endphp
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="m-0 text-primary">Đánh giá</h2>
                    <ol>
                        <li><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li>Đánh giá</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-6 mx-auto">
                        <form method="post" action="{{ route('client.booking.feedback-post') }}">
                            @csrf
                            @foreach ($errors->all() as $error)
                                <label class="text-danger font-italic mb-4" for="form1Example3">{{ $error }}</label>
                            @endforeach

                            <h5 class="fs-5 text-uppercase">
                                Đánh giá đơn đặt bàn ngày {{ Carbon::parse($Booking->BookingDate)->format('d-m-Y') }} lúc
                                {{ Carbon::parse($Booking->TimeSlot)->format('H:i') }}
                            </h5>

                            <input type="hidden" name="IdBooking" value="{{ $Booking->IdBooking }}">

                            <div class="flex-w flex-m p-b-4">
                                <span class="wrap-rating fs-4 pointer" style="color: #f9ba48; cursor: pointer;">
                                    <i class="item-rating pointer zmdi zmdi-star"></i>
                                    <i class="item-rating pointer zmdi zmdi-star"></i>
                                    <i class="item-rating pointer zmdi zmdi-star"></i>
                                    <i class="item-rating pointer zmdi zmdi-star"></i>
                                    <i class="item-rating pointer zmdi zmdi-star"></i>
                                    <input class="d-none" type="number" name="NumStars">
                                </span>
                            </div>

                            <div class="row ">
                                <div class="col-12 p-b-5">
                                    <textarea name="Content" class="form-control" id="Content" rows="5"
                                        placeholder="Mời bạn nhập nội dung đánh giá..." required></textarea>
                                </div>
                            </div>

                            <div class="text-danger" style="text-align: center;"></div>

                            <button class="btn btn-primary px-4 mt-3">
                                Đánh giá
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        $("#delete-confirm").click(function() {
            event.preventDefault();

            let IdBooking = $(".show-del").attr("data-IdBooking");
            $.ajax({
                url: "/admin/booking/delete/" + IdBooking,
                method: 'GET',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    const bookingWrap = $(`#booking-wrap-${IdBooking}`)
                    if (bookingWrap) {
                        bookingWrap.remove();
                    }
                    showSuccessNotification('rgba(0, 200, 81, 0.85)', response.success);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
                    backToTop();
                }
            });

            $('.js-modal').removeClass('show-modal');
            $('.show-del').removeClass('show-del');
        });
    </script>
@endsection
