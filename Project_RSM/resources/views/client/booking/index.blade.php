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
                    <h2 class="m-0 text-primary">Quản lý đơn đặt bàn</h2>
                    <ol>
                        <li><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li>Đơn đặt bàn</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped p-4" style="border: 1px solid #3333;">
                            <thead>
                                <tr>
                                    <th class="py-4 text-start" scope="col">Dự kiến nhận bàn</th>
                                    <th class="py-4 text-center" scope="col">Nhà hàng</th>
                                    <th class="py-4 text-center" scope="col">Đã cọc</th>
                                    <th class="py-4 text-center" scope="col">Số người</th>
                                    <th class="py-4 text-center" scope="col" data-sortable="false">Khu vực/Bàn</th>
                                    <th class="py-4 text-center" scope="col">Trạng thái</th>
                                    <th class="py-4 text-center" scope="col" data-sortable="false">Ghi chú</th>
                                    <th class="py-4 text-center" scope="col" data-sortable="false">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="records_table" style="vertical-align:-webkit-baseline-middle !important;">

                                @if ($bookings->count() < 1)
                                    <tr>
                                        <td class="py-4 text-center py-5 fs-5" colspan="8">
                                            Bạn chưa có đơn đặt bàn nào!
                                            <a class="text-decoration-underline ms-1" href="{{ route('show-cart') }}"> Đặt
                                                bàn ngay</a>
                                        </td>
                                    </tr>
                                @endif

                                @foreach ($bookings as $item)
                                    {{-- <tr class="py-2" onclick="window.location.href='{{ route('booking-show', ['IdBooking' => $item->IdBooking]) }}';" class="cursor-pointer"> --}}
                                    <tr>
                                        <td class="py-3 text-start">
                                            {{ Carbon::parse($item->BookingDate)->format('d/m/Y') }}
                                            @if ($item->TimeSlot !== null)
                                                {{ ' (' . Carbon::parse($item->TimeSlot)->format('H:i') . ')' }}
                                            @else
                                                {{ ' (--:--)' }}
                                            @endif
                                        </td>
                                        <td class="py-3 text-center">
                                            {{ $item->BranchName }} - {{ $item->Address }}
                                        </td>
                                        <td class="py-3 text-center">{{ number_format($item->PrePayment, 0, '.', '.') }} đ
                                        </td>
                                        <td class="py-3 text-center">{{ $item->NumberGuests }}</td>
                                        <td class="py-3 text-center">
                                            @if ($item->AreaName !== null)
                                                {{ $item->AreaName }}, bàn {{ $item->TableName }}
                                            @endif
                                        </td>
                                        <td class="py-3 text-center">
                                            @if ($item->IdStatus === 1)
                                                <span class="text-center badge badge-warning">
                                                    {{ $item->StatusName }} </span>
                                            @elseif ($item->IdStatus === 3)
                                                <span class="text-center badge badge-canceled">
                                                    {{ $item->StatusName }} </span>
                                            @else
                                                <span class="text-center badge badge-success">
                                                    {{ $item->StatusName }} </span>
                                            @endif
                                        </td>
                                        <td class="py-3 text-center">
                                            @if ($item->IdStatus === 4 && $item->Id !== null)
                                                <div class="text-success">
                                                    Đã đánh giá
                                                </div>
                                            @elseif($item->IdStatus === 1)
                                                @if (Carbon::parse($item->BookingDate)->format('Y-m-d') === now()->format('Y-m-d'))
                                                    @if (Carbon::parse($item->TimeSlot)->format('H:i:s') < now()->format('H:i:s'))
                                                        <div class="text-danger">
                                                            Đã quá giờ nhận bàn
                                                        </div>
                                                    @endif
                                                @elseif (Carbon::parse($item->BookingDate)->format('Y-m-d') < now()->format('Y-m-d'))
                                                    <div class="text-danger">
                                                        Đã quá giờ nhận bàn
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="py-3 text-center">
                                            {{-- <a href="{{ route('booking-show', ['IdBooking' => $item->IdBooking]) }}"
                                                class="btn btn-success">
                                                <i class="bi bi-eye"></i>
                                                Chi tiết
                                            </a> --}}
                                            @if ($item->IdStatus === 1)
                                                <a class="btn btn-danger js-show-modal"
                                                    data-IdBooking="{{ $item->IdBooking }}">
                                                    <i class="bi bi-clipboard2-x-fill"></i>
                                                    Hủy đơn
                                                </a>
                                            @elseif ($item->IdStatus === 4 && $item->Id === null)
                                                <a href="{{ route('client.booking.feedback', ['IdBooking' => $item->IdBooking]) }}"
                                                    class="btn btn-success">
                                                    <i class="bi bi-star-fill me-1"></i>
                                                    Đánh giá
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Xác nhận hủy đơn --}}
                        <div class="row wrap-modal1 js-modal">
                            <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>
                            <div class="d-flex container col-lg-5 col-xl-5" style="max-width: 95%; align-items: center;">
                                <div class="bg0 p-lr-15-lg how-pos3-parent"
                                    style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                    <div class="text-center mb-3 fs-4">Hủy đơn đặt bàn</div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label fw-bolder">Lý do hủy</label>
                                            <div class="col-sm-10">
                                                <div class="form-check mt-3">
                                                    <input class="form-check-input" type="radio" name="gridRadios"
                                                        id="gridRadios1" value="option1" checked="">
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Không còn có nhu cầu sử dụng dịch vụ
                                                    </label>
                                                </div>
                                                <div class="form-check mt-3">
                                                    <input class="form-check-input" type="radio" name="gridRadios"
                                                        id="gridRadios2" value="option2">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Đã chọn được nhà hàng ưng ý hơn
                                                    </label>
                                                </div>
                                                <div class="form-check mt-3">
                                                    <input class="form-check-input" type="radio" name="gridRadios"
                                                        id="gridRadios3" value="option3">
                                                    <label class="form-check-label" for="gridRadios3">
                                                        Lý do khác
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <div class="input-group has-validation">
                                                <textarea style="" type="text" name="Note" class="form-control" id="Note" rows="4"
                                                    placeholder="Nhập lý do hủy đơn"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="col-sm-12 d-flex" style="padding: 0; justify-content: flex-end;">
                                            <a class="btn btn-light js-hide-modal"
                                                style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                                <i class="bi bi-arrow-left-circle"></i>
                                                Đóng
                                            </a>

                                            <button type="submit" id="delete-confirm" class="btn btn-danger"
                                                style="border-radius: 50px; min-width: 100px; margin-left: 16px;">
                                                Xác nhận
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
