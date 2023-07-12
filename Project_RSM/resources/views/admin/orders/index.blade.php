@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12" style="margin: 0 auto;">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb" style="justify-content: space-between;">
                                <h4 class="breadcrumb-item active">Đơn hiện tại</h4>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        {{-- <div class="col-lg-3 col-xl-3 col-md-3">
                            <div class="card">
                                <div class="card-body" style="padding: 1rem ;">
                                    <div class="d-flex align-items-start">
                                        <div class="nav flex-column nav-pills w-100" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">

                                            <button class="nav-link btn-tabs text-start active" id="v-pills-xxx-tab"
                                                data-bs-toggle="pill" data-bs-target="#v-pills-xxx" type="button"
                                                role="tab" aria-controls="v-pills-xxx" aria-selected="true">
                                                <i class="bi bi-geo-alt-fill"></i>
                                                Tất cả</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" style="padding: 1rem ;">
                                    <div class="d-flex justify-content-start">
                                        <a style="color: #fff;" class="btn btn-primary mb-3" href="/admin/orders/create">
                                            <i class="bi bi-plus-circle"></i>
                                            <span>Tạo đơn mới</span>
                                        </a>
                                    </div>
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade active show" id="v-pills-xxx" role="tabpanel"
                                            aria-labelledby="v-pills-xxx-tab">
                                            <div class="row">
                                                @if ($listOrders->count() > 0)
                                                    @foreach ($listOrders as $item)
                                                        <div class="col col-lg-4 col-md-4 mb-4"
                                                            id="order-wrap-{{ $item->IdOrder }}" data-aos="zoom-in"
                                                            data-aos-delay="100">
                                                            <div style="border-radius: 0.5rem;"
                                                                class="cursor-pointer position-relative p-0 d-flex d-flex flex-column align-items-center form-setting">
                                                                <div onclick="window.location.href='{{ route('orders-select-items', ['IdOrder' => $item->IdOrder]) }}';"
                                                                    class="d-flex booking-customer border-bottom-line p-3 w-100 justify-content-between">
                                                                    <p class="m-0">
                                                                        {{ $item->AreaName }}
                                                                    </p>
                                                                    <p class="m-0">
                                                                        <i class="bi bi-people-fill"></i>
                                                                        {{ $item->NumberGuests }}
                                                                    </p>
                                                                </div>

                                                                <div class="border-top-line w-100 d-fl"
                                                                    onclick="window.location.href='{{ route('orders-select-items', ['IdOrder' => $item->IdOrder]) }}';">
                                                                    <div class="d-flex flex-column flex-grow-1">
                                                                        <div class="d-flex py-2 px-3">
                                                                            <h3 class="text-center m-0 fw-bold flex-grow-1 py-2">
                                                                                Bàn {{ empty($item->TableName) ? '?' : $item->TableName }}
                                                                            </h3>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex w-100 justify-content-between border-top-line px-3">
                                                                            <div class="m-0 py-3 d-flex align-items-center">
                                                                                <i
                                                                                    class="fs-5 pe-1 bi bi-stopwatch-fill"></i>
                                                                                <p class="m-0 p-0 time-current"
                                                                                    data-timein="{{ $item->TimeIn }}">
                                                                                    00:00:00 </p>
                                                                            </div>
                                                                            <div class="m-0 py-3 d-flex align-items-center">
                                                                                <i class="fs-5 pe-1 bi bi-coin"></i>
                                                                                {{ number_format($item->TotalAmount, 0, '.', '.') }} ₫
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="filter d-flex w-100 booking-form-btn align-items-center border-top-line">
                                                                    <a data-bs-toggle="dropdown" aria-expanded="false"
                                                                        class="flex-grow-1 fs-3 py-1 border-right-line icon-payment">
                                                                        <i class="bi bi-three-dots"></i>
                                                                    </a>
                                                                    <ul
                                                                        class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                        <li>
                                                                            <a class="dropdown-item text-success "
                                                                                href="{{ route('orders-select-items', ['IdOrder' => $item->IdOrder]) }}">
                                                                                <i class="bi bi-clipboard2-check-fill"></i>
                                                                                Chọn món
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('orders-select-table', ['IdOrder' => $item->IdOrder]) }}">
                                                                                <i class="bi bi-arrow-clockwise"></i>
                                                                                Chuyển bàn
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a class="dropdown-item text-danger js-show-modal2"
                                                                                data-idorder="{{ $item->IdOrder }}">
                                                                                <i class="bi bi-clipboard2-x-fill"></i>
                                                                                Hủy đơn
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    <a class="m-0 py-3 flex-grow-1 btn-payment js-show-modalxxx"
                                                                        data-idorder="{{ $item->IdOrder }}">Thanh toán</a>
                                                                </div>
                                                                {{-- <p class="position-absolute"><i class="bi bi-clipboard2-check-fill"></i></p> --}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-lg-6 mx-auto mt-5">
                                                        <div class="w-100 mx-auto text-center">
                                                            <img class="w-70  text-center"
                                                                src="{{ asset('files/images/iconSystem/filter-booking-null.svg') }}"
                                                                alt="Khách hàng trống">
                                                        </div>

                                                        <p class="mt-3 w-100 text-center fs-6 text-spacing-2">Không có hóa
                                                            đơn nào</p>
                                                    </div>
                                                @endif

                                                {{-- Xác nhận In hóa đơn --}}
                                                <div class="row wrap-modal1 js-modal3">
                                                    <div class="overlay-modal1 js-hide-modal3" style="opacity: 0.5;"></div>
                                                    <div class="d-flex container col-lg-4 col-xl-4"
                                                        style="max-width: 95%; align-items: center;">
                                                        <div class="bg0 p-lr-15-lg how-pos3-parent"
                                                            style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                                            <div class="text-center mb-3 fs-4">Thông báo</div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mb-3 fs-5">
                                                                    Đơn hàng đã được thanh toán
                                                                </div>
                                                            </div>

                                                            <div class="mt-2 d-flex">
                                                                <div class="col-sm-6 d-flex"
                                                                    style="padding: 0; justify-content: flex-end;">
                                                                    <a
                                                                        class="btn btn-light delete-confirm w-100 p-3 me-1 js-hide-modal3">
                                                                        <i class="bi bi-x-lg"></i>
                                                                        Đóng
                                                                    </a>
                                                                </div>
                                                                <div class="col-sm-6 d-flex"
                                                                    style="padding: 0; justify-content: flex-end;">
                                                                    <a id="print_order"
                                                                        class="btn btn-success delete-confirm w-100 p-3 ms-1 ">
                                                                        <i class="bi bi-printer"></i>
                                                                        In hóa đơn
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Xác nhận hủy đơn --}}
                                                <div class="row wrap-modal1 js-modal2">
                                                    <div class="overlay-modal1 js-hide-modal2" style="opacity: 0.5;">
                                                    </div>
                                                    <div class="d-flex container col-lg-5 col-xl-5"
                                                        style="max-width: 95%; align-items: center;">
                                                        <div class="bg0 p-lr-15-lg how-pos3-parent"
                                                            style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                                            <div class="text-center mb-3 fs-4">Hủy đơn</div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mb-3">
                                                                    <label class="form-label fw-bolder">Lý do hủy</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="form-check mt-3">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="CancellationReason" id="gridRadios1"
                                                                                value="Khách yêu cầu hủy" checked>
                                                                            <label class="form-check-label"
                                                                                for="gridRadios1">
                                                                                Khách yêu cầu hủy
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check mt-3">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="CancellationReason" id="gridRadios2"
                                                                                value="Hết bàn">
                                                                            <label class="form-check-label"
                                                                                for="gridRadios2">
                                                                                Hết bàn
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check mt-3">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="CancellationReason" id="gridRadios3"
                                                                                value="">
                                                                            <label class="form-check-label"
                                                                                for="gridRadios3">
                                                                                Lý do khác
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 mb-4">
                                                                    <div class="input-group has-validation">
                                                                        <textarea style="" type="text" name="Content" id="Content" class="form-control" id="Note"
                                                                            rows="4" placeholder="Nhập lý do hủy đơn"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mt-3">
                                                                <div class="col-sm-12 d-flex"
                                                                    style="padding: 0; justify-content: flex-end;">
                                                                    <a class="btn btn-light js-hide-modal2"
                                                                        style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                                                        <i class="bi bi-arrow-left-circle"></i>
                                                                        Đóng
                                                                    </a>

                                                                    <button type="submit" id="delete-confirm"
                                                                        class="btn btn-danger"
                                                                        style="border-radius: 50px; min-width: 100px; margin-left: 16px;">
                                                                        Xác nhận
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Thanh toán --}}
                                                <div class="row wrap-modal1 js-modal">
                                                    <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>
                                                    <div class="d-flex container col-lg-6 col-xl-5"
                                                        style="max-width: 95%; align-items: center;">
                                                        <div class="bg0 p-lr-15-lg how-pos3-parent position-relative"
                                                            style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                                            <div class="text-center mb-4 fs-5 fw-bold"
                                                                id="info-area-table">
                                                                Thanh toán</div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div
                                                                        class="col-sm-12 d-flex align-items-center form-input-payment mb-3">
                                                                        <label class="col-lg-4 flex-grow-1 p-3 ps-4"
                                                                            for="TotalAmount">Cần thanh toán</label>
                                                                        <p class="col-lg-8 flex-grow-1 p-2 px-3 m-0 fw-bold fs-5 text-center"
                                                                            id="TotalAmount"></p>
                                                                        <input type="hidden" value=""
                                                                            name="TotalAmount">
                                                                    </div>

                                                                    <div
                                                                        class="col-sm-12 d-flex align-items-center form-input-payment mb-3">
                                                                        <label class="col-lg-4 flex-grow-1 p-3 ps-4"
                                                                            for="CustomerPaying">Khách trả</label>
                                                                        <input
                                                                            class="col-lg-8 flex-grow-1 p-2 px-3 m-0 text-primary fs-5 text-center"
                                                                            type="text" value="" maxlength="10"
                                                                            name="CustomerPaying" id="CustomerPaying">
                                                                    </div>

                                                                    <div
                                                                        class="col-sm-12 d-flex align-items-center form-input-payment mb-3">
                                                                        <label class="col-lg-4 flex-grow-1 p-3 ps-4"
                                                                            for="ChangeAmount" id="text-ChangeAmount">Tiền
                                                                            thừa</label>
                                                                        <p class="col-lg-8 flex-grow-1 p-2 px-3 m-0 fw-bold fs-5 text-center"
                                                                            id="ChangeAmount"></p>
                                                                        <input type="hidden" value=""
                                                                            id="ChangeAmount" name="ChangeAmount">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <a
                                                                class="btn btn-light btn-round js-hide-modal position-absolute">
                                                                <i class="bi bi-x-lg"></i>
                                                            </a>

                                                            <div class="mt-2">
                                                                <div class="col-sm-12 d-flex"
                                                                    style="padding: 0; justify-content: flex-end;">
                                                                    <button id="btn-confirm-payment"
                                                                        class="btn btn-primary delete-confirm w-100 p-3">
                                                                        Xác nhận thanh toán
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
    <!--End main-->
    <script>
        const listOrders = {
            @foreach ($listOrders as $item)
                {{ $item->IdOrder }}: {
                    IdOrder: {{ $item->IdOrder }},
                    AreaName: "{{ $item->AreaName }}",
                    TableName: "{{ $item->TableName }}",
                    TotalAmount: {{ $item->TotalAmount }}
                },
            @endforeach
        }

        $('#CustomerPaying').on('focus', function() {
            $(this).val('');
            // tính tiền thừa
            $('#ChangeAmount').text((0 - parseInt($('input[name="TotalAmount"]').val()))
                .toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }));

            if ($('#ChangeAmount').val() < 0 || $('#ChangeAmount').val() == "") {
                $('#text-ChangeAmount').text('Còn thiếu');
            } else {
                $('#text-ChangeAmount').text('Tiền thừa');
            }
        });

        // Lấy giá trị TotalAmount từ hóa đơn hiện tại
        $('.btn-payment').click(function() {
            var idOrder = $(this).data('idorder');
            var orderWrap = $(`#order-wrap-${idOrder}`);

            const orderCurrent = listOrders[idOrder];
            var infoOrder = $('#info-area-table');

            infoOrder.text(`Thanh toán - Bàn ${orderCurrent.TableName} - ${orderCurrent.AreaName}`);
            $('input[name="TotalAmount"]').val(orderCurrent.TotalAmount);
            $('#TotalAmount').text(orderCurrent.TotalAmount.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }));

            // tính tiền thừa
            $('#ChangeAmount').text('0 ₫')

            $('#CustomerPaying').val(orderCurrent.TotalAmount.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }));

            $('.js-modal').addClass('show-modal');
            $(this).addClass('show-del');
        });

        // Xử lý khi người dùng nhập vào ô input tiền khách trả
        $('#CustomerPaying').on('input', function() {
            var totalAmount = parseInt($('input[name="TotalAmount"]').val());
            // var customerPaying = parseInt($('#CustomerPaying').val());
            var customerPaying = parseFloat($('#CustomerPaying').val().replace(/\D/g, ''));

            if ($(this).val() === "") {
                customerPaying = 0;
                // $('#CustomerPaying').val(0);
            } else {
                $('#CustomerPaying').val(customerPaying.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }));
            }

            if (!isNaN(totalAmount) && !isNaN(customerPaying)) {
                var changeAmount = customerPaying - totalAmount;
                $('#ChangeAmount').text(changeAmount.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }));

                if (changeAmount < 0) {
                    $('#text-ChangeAmount').text('Còn thiếu');
                } else {
                    $('#text-ChangeAmount').text('Tiền thừa');
                }
            }
        });

        // Lặp qua tất cả các thẻ HTML có class="time-current"
        var timeCurrents = document.querySelectorAll('.time-current');
        timeCurrents.forEach(function(timeCurrent) {

            let timein = $(timeCurrent).data('timein');
            var startTime = new Date(timein);

            // Cập nhật thời gian hiện tại
            setInterval(function() {
                var now = new Date();
                var elapsed = now - startTime; // Tính thời gian đã trôi qua từ khi bắt đầu phục vụ
                var hours = Math.floor(elapsed / 3600000); // Tính số giờ
                var minutes = Math.floor((elapsed - hours * 3600000) / 60000); // Tính số phút
                var seconds = Math.floor((elapsed - hours * 3600000 - minutes * 60000) /
                    1000); // Tính số giây
                var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' +
                    seconds).slice(-2); // Định dạng thời gian hh:mm:ss

                // Kiểm tra nếu thời gian tính được là quá 5 giờ, thay đổi màu sắc thành màu đỏ
                if (hours > 5) {
                    timeCurrent.style.color = 'red';
                } else {
                    timeCurrent.style.color = ''; // Đặt lại màu sắc mặc định nếu không quá 5 giờ
                }

                timeCurrent.textContent = formattedTime; // Cập nhật thời gian vào thẻ HTML
            }, 1000); // Cập nhật thời gian sau mỗi giây (1000 ms)
        });

        $("#btn-confirm-payment").click(function() {
            event.preventDefault();

            let IdOrder = idOrder = $(".show-del").data('idorder');

            $.ajax({
                url: "/admin/orders/payment/" + IdOrder,
                method: 'GET',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    const orderWrap = $(`#order-wrap-${IdOrder}`)
                    if (orderWrap) {
                        orderWrap.remove();
                    }
                    showSuccessNotification('rgba(0, 200, 81, 0.85)', response.success);
                    $('.js-modal3').addClass('show-modal').attr('data-id', IdOrder);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
                    backToTop();
                }
            });

            $('.js-modal').removeClass('show-modal');
            $('.show-del').removeClass('show-del');
        });

        // Xác nhận in hóa đơn
        $('#print_order').click(function() {
            const id = $('.js-modal3.show-modal').data('id');
            window.location.href = '/admin/order/print/' + id;
        });

        $("#delete-confirm").click(function() {
            event.preventDefault();

            let IdOrder = idOrder = $(".show-del2").data('idorder');

            let formData = new FormData();
            formData.append('CancellationReason', $('input[name="CancellationReason"]').filter(':checked').val());
            formData.append('Content', $('#Content').val());

            $.ajax({
                url: "/admin/order/delete/" + IdOrder,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    const orderWrap = $(`#order-wrap-${IdOrder}`)
                    if (orderWrap) {
                        orderWrap.remove();
                    }
                    showSuccessNotification('rgba(0, 200, 81, 0.85)', response.success);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
                    backToTop();
                }
            });

            $('.js-modal2').removeClass('show-modal');
            $('.show-del2').removeClass('show-del2');
        });
    </script>
@endsection
