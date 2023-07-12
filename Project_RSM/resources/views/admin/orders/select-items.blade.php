@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main p-3">
        <section class="section">
            <div class="row">
                <div class="col-lg-7 col-xl-7 pe-1">
                    <div class="card">
                        <div class="card-body p-4">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                @foreach ($listCategory as $Category)
                                    <li class="nav-item" role="presentation">
                                        <button
                                            @if ($loop->iteration === 1) class="nav-link text-start active"
                                                @else
                                                class="nav-link text-start" @endif
                                            id="v-pills-{{ $Category->IdCategory }}-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-{{ $Category->IdCategory }}" type="button"
                                            role="tab" aria-controls="v-pills-{{ $Category->IdCategory }}"
                                            aria-selected="true">
                                            {{ $Category->CategoryName }}
                                        </button>
                                    </li>
                                @endforeach
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-start" id="v-pills-combo-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-combo" type="button" role="tab"
                                        aria-controls="v-pills-combo" aria-selected="true">
                                        Combo
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @foreach ($listCategory as $Category)
                                    <div class="tab-pane fade {{ $loop->iteration === 1 ? 'active' : '' }} show"
                                        id="v-pills-{{ $Category->IdCategory }}" role="tabpanel"
                                        aria-labelledby="v-pills-{{ $Category->IdCategory }}-tab">
                                        <div class="row" style="padding: 0 12px;">
                                            @foreach ($listItems->where('IdCategory', $Category->IdCategory) as $items)
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 m-0 p-0 form-items border-item position-relative"
                                                    style="height: 9rem;">
                                                    <a class="form-item-items" data-idItems="{{ $items->IdItems }}">
                                                        <img id="img-account"
                                                            src="{{ asset('files/images/items/' . $items->Avatar) }}"
                                                            alt="Profile" class="rounded-circle-items img-items"
                                                            style="">
                                                        <div class="select-name-item position-absolute text-truncate">
                                                            {{ $items->ItemsName }}
                                                        </div>
                                                        {{-- <p class="m-0 select-quantity-item fw-bold position-absolute"></p> --}}
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <div class="tab-pane fade show" id="v-pills-combo" role="tabpanel"
                                    aria-labelledby="v-pills-combo-tab">
                                    <div class="row" style="padding: 0 12px;">
                                        @foreach ($listCombo as $combo)
                                            <div class="col col-lg-3 col-md-3 m-0 p-0 form-items border-item position-relative"
                                                style="min-height: 8.5rem;">
                                                <a href="{{ route('orders-selected-items', ['IdOrder' => $IdOrder]) }}">
                                                    <img id="img-account"
                                                        src="{{ asset('files/images/combo/' . $combo->Avatar) }}"
                                                        alt="Profile" class="rounded-circle-items img-items"
                                                        style="">
                                                    <div class="select-name-item position-absolute">
                                                        {{ $combo->ComboName }}
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div><!-- End Pills Tabs -->

                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-xl-5 ps-0">
                    <div class="card">
                        <div class="card-body h-100 p-0">
                            <div class="d-flex flex-column form-items-selected p-3">

                                <div class="m-0 pb-2 border-bottom-line-bold">
                                    <div class="d-flex">
                                        <p class="col-xl-5 m-0 fw-bold">Mặt hàng</p>
                                        <p class="col-xl-3 m-0 fw-bold text-center">SL</p>
                                        <p class="col-xl-3 m-0 fw-bold text-end">Thành tiền</p>
                                        <p class="col-xl-1 m-0 fw-bold text-end"></p>
                                    </div>
                                </div>
                                <div class="accordion accordion-flush scroll-y-400 border-bottom-line-bold"
                                    id="form-items-selected">
                                    {{-- List Items --}}
                                    @if (!$listItemsOfOrder->isEmpty())
                                        @foreach ($listItemsOfOrder as $item)
                                            <div class="items-selected" id="wrap-item-{{ $item->IdItems }}">
                                                <div class="d-flex collapsed align-items-center py-4 border-bottom-line">
                                                    <div class="col-xl-5 d-flex flex-column m-0 p-0">
                                                        <label class="m-0 fw-bold">{{ $item->ItemsName }}</label>
                                                        <input type="hidden" name="Price"
                                                            value="{{ $item->PriceSale }}">
                                                        <label
                                                            class="m-0">{{ number_format($item->PriceSale, 0, '.', '.') }}
                                                            ₫</label>
                                                    </div>
                                                    <div
                                                        class="col-xl-3 m-0 fw-bold d-flex justify-content-center align-items-center">
                                                        <a onclick="subQuantity(this)" data-id="{{ $item->IdItems }}"
                                                            class="fs-5 py-0 px-1 pe-1 btn btn-light"><i
                                                                class="text-danger bi bi-dash"></i></a>
                                                        <p class="m-0 fs-6 text-center px-3 quantity"
                                                            id="quantity-{{ $item->IdItems }}">{{ $item->Quantity }}</p>
                                                        <a onclick="addQuantity(this)" data-id="{{ $item->IdItems }}"
                                                            class="fs-5 py-0 px-1 ps-1 btn btn-light"><i
                                                                class="text-success bi bi-plus"></i></a>
                                                    </div>
                                                    <p class="col-xl-3 m-0 fw-bold text-end"
                                                        id="total-of-item-{{ $item->IdItems }}">
                                                        {{ number_format($item->PriceSale, 0, '.', '.') }} ₫</p>
                                                    <div class="col-xl-1 fs-3 py-0 text-end pe-2" onclick="deleteItem(this)"
                                                        data-id="{{ $item->IdItems }}"><i
                                                            class="text-danger bi bi-x"></i></i></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="py-3 border-top-line">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="m-0 fw-bold">Tổng tiền</p>
                                        <p class="m-0 fs-5 fw-bold text-end" id="total-money">
                                            @if (!$listItemsOfOrder->isEmpty())
                                                {{ number_format($listItemsOfOrder->first()->TotalAmount, 0, '.', '.') }}
                                            @else
                                                0
                                            @endif ₫
                                        </p>
                                        <input type="hidden" name="Total"
                                            value="@if (!$listItemsOfOrder->isEmpty()) {{ $listItemsOfOrder->first()->TotalAmount }} @else 0 @endif">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ url('/admin/orders/index') }}"
                                        class="btn btn-danger d-flex flex-column flex-grow-1 py-4">
                                        <i class="bi bi-arrow-90deg-left"></i>
                                        Quay lại
                                    </a>
                                    <a id="save-btn"
                                        class="btn btn-primary d-flex flex-column flex-grow-1 py-4 ms-1 me-1">
                                        <i class="bi bi-save"></i>
                                        Lưu lại
                                    </a>
                                    <a id="payment-btn"
                                        class="btn btn-success d-flex flex-column flex-grow-1 py-4 js-show-modalxxx"
                                        data-idorder="{{ $order->IdOrder }}">
                                        <i class="bi bi-wallet2"></i>
                                        Thanh toán
                                    </a>
                                </div>
                            </div>

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
                                            <div class="col-sm-6 d-flex" style="padding: 0; justify-content: flex-end;">
                                                <a class="btn btn-light delete-confirm w-100 p-3 me-1 js-hide-modal3">
                                                    <i class="bi bi-x-lg"></i>
                                                    Đóng
                                                </a>
                                            </div>
                                            <div class="col-sm-6 d-flex" style="padding: 0; justify-content: flex-end;">
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

                            {{-- Thanh toán --}}
                            <div class="row wrap-modal1 js-modal">
                                <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>
                                <div class="d-flex container col-lg-6 col-xl-5"
                                    style="max-width: 95%; align-items: center;">
                                    <div class="bg0 p-lr-15-lg how-pos3-parent position-relative"
                                        style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                        <div class="text-center mb-4 fs-5 fw-bold" id="info-area-table">
                                            Thanh toán</div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="col-sm-12 d-flex align-items-center form-input-payment mb-3">
                                                    <label class="col-lg-4 flex-grow-1 p-3 ps-4" for="TotalAmount">Cần
                                                        thanh toán</label>
                                                    <p class="col-lg-8 flex-grow-1 p-2 px-3 m-0 fw-bold fs-5 text-center"
                                                        id="TotalAmount"></p>
                                                    <input type="hidden" value="" name="TotalAmount">
                                                </div>

                                                <div class="col-sm-12 d-flex align-items-center form-input-payment mb-3">
                                                    <label class="col-lg-4 flex-grow-1 p-3 ps-4"
                                                        for="CustomerPaying">Khách trả</label>
                                                    <input
                                                        class="col-lg-8 flex-grow-1 p-2 px-3 m-0 text-primary fs-5 text-center"
                                                        type="text" value="" maxlength="10"
                                                        name="CustomerPaying" id="CustomerPaying">
                                                </div>

                                                <div class="col-sm-12 d-flex align-items-center form-input-payment mb-3">
                                                    <label class="col-lg-4 flex-grow-1 p-3 ps-4" for="ChangeAmount"
                                                        id="text-ChangeAmount">Tiền
                                                        thừa</label>
                                                    <p class="col-lg-8 flex-grow-1 p-2 px-3 m-0 fw-bold fs-5 text-center"
                                                        id="ChangeAmount"></p>
                                                    <input type="hidden" value="" id="ChangeAmount"
                                                        name="ChangeAmount">
                                                </div>
                                            </div>
                                        </div>

                                        <a class="btn btn-light btn-round js-hide-modal position-absolute">
                                            <i class="bi bi-x-lg"></i>
                                        </a>

                                        <div class="mt-2">
                                            <div class="col-sm-12 d-flex" style="padding: 0; justify-content: flex-end;">
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
        </section>
    </main>
    <!--End main-->
    <script>
        const listItems = {
            @foreach ($listItems as $item)
                {{ $item->IdItems }}: {
                    IdItems: {{ $item->IdItems }},
                    ItemsName: "{{ $item->ItemsName }}",
                    Avatar: "{{ $item->Avatar }}",
                    Price: @if ($listPrice->where('IdItems', $item->IdItems)->count() > 0)
                        {{ $listPrice->where('IdItems', $item->IdItems)->first()->SalePrice }}
                    @else
                        0
                    @endif ,
                    CostPrice: @if ($listPrice->where('IdItems', $item->IdItems)->count() > 0)
                        @if ($listPrice->where('IdItems', $item->IdItems)->first()->CostPrice > 0)
                            {{ $listPrice->where('IdItems', $item->IdItems)->first()->CostPrice }}
                        @else
                            0
                        @endif
                    @else
                        0
                    @endif
                },
            @endforeach
        }

        const itemsSelected = [
            @if (!$listItemsOfOrder->isEmpty())
                @foreach ($listItemsOfOrder as $item)
                    {
                        'IdItems': {{ $item->IdItems }},
                        'Quantity': {{ $item->Quantity }},
                        'Price': {{ $item->SalePrice }},
                        'PriceCost': {{ $item->CostPrice }}
                    },
                @endforeach
            @endif
        ];

        const formItemsSelected = $('#form-items-selected');
        const elementItems = $('.form-item-items');

        elementItems.each(function() {
            $(this).click(function() {
                const idItems = $(this).data('iditems');
                const itemCurrent = listItems[idItems];

                var check = $.inArray(idItems, $.map(itemsSelected, function(item) {
                    return item.IdItems;
                }));

                //Nếu đã có thì chỉ tăng số lượng
                if (check !== -1) {
                    const Items = itemsSelected.find(item => item.IdItems === idItems);
                    Items.Quantity++;
                    //Update số lượng và thành tiền
                    updateQuanTotal(Items.IdItems, Items.Quantity, Items.Price)
                    //Tính lại tổng cộng
                    totalMoney();
                    return;
                }

                let items = $('<div>', {
                    'class': 'items-selected',
                    'id': `wrap-item-${itemCurrent.IdItems}`,
                    html: `\n
                        <div class="d-flex collapsed align-items-center py-4 border-bottom-line">\n
                            <div class="col-xl-5 d-flex flex-column m-0 p-0">\n
                                <label class="m-0 fw-bold">${itemCurrent.ItemsName}</label>\n
                                <input type="hidden" name="Price" value="${itemCurrent.Price}">\n
                                <label class="m-0">${itemCurrent.Price.toLocaleString('vi-VN', { minimumFractionDigits: 0, maximumFractionDigits: 2, useGrouping: true, currency: 'VND' })} ₫</label>\n
                            </div>\n
                            <div class="col-xl-3 m-0 fw-bold d-flex justify-content-center align-items-center">\n
                                <a onclick="subQuantity(this)" data-id="${itemCurrent.IdItems}" class="fs-5 py-0 px-1 pe-1 btn btn-light"><i class="text-danger bi bi-dash"></i></a>\n
                                <p class="m-0 fs-6 text-center px-3 quantity" id="quantity-${itemCurrent.IdItems}">1</p>\n
                                <a onclick="addQuantity(this)" data-id="${itemCurrent.IdItems}" class="fs-5 py-0 px-1 ps-1 btn btn-light"><i class="text-success bi bi-plus"></i></a>\n
                            </div>\n
                            <p class="col-xl-3 m-0 fw-bold text-end" id="total-of-item-${itemCurrent.IdItems}">${itemCurrent.Price.toLocaleString('vi-VN', { minimumFractionDigits: 0, maximumFractionDigits: 2, useGrouping: true, currency: 'VND' })} ₫</p>\n
                            <div class="col-xl-1 fs-3 py-0 text-end pe-2" onclick="deleteItem(this)" data-id="${itemCurrent.IdItems}"><i class="text-danger bi bi-x"></i></i></div>\n
                        </div>`
                });
                formItemsSelected.append(items);

                //push vào list selected
                itemsSelected.push({
                    IdItems: itemCurrent.IdItems,
                    Quantity: 1,
                    Price: itemCurrent.Price,
                    PriceCost: itemCurrent.CostPrice
                });

                totalMoney();
            });
        });

        //Lưu lại
        $("#save-btn").click(function() {
            if (itemsSelected.length < 1) {
                alert("Chưa chọn món.");
                return;
            }

            let formData = new FormData();
            formData.append('Items', JSON.stringify(itemsSelected));

            $.ajax({
                url: '/admin/orders/selected-items/{{ $IdOrder }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showSuccessNotification('rgba(0, 200, 81, 0.85)', response.success);
                    // window.location.href = "/admin/booking/index";
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
                }
            });
        });

        function addQuantity(item) {
            const id = $(item).data('id');

            const Items = itemsSelected.find(item => item.IdItems == id);
            Items.Quantity++;

            //Update số lượng và thành tiền
            updateQuanTotal(Items.IdItems, Items.Quantity, Items.Price)

            //Tính lại tổng cộng
            totalMoney();
        }

        function subQuantity(item) {
            const id = $(item).data('id');

            const Items = itemsSelected.find(item => item.IdItems == id);

            if (Items.Quantity <= 1) {
                return;
            }
            Items.Quantity--

            //Update số lượng và thành tiền
            updateQuanTotal(Items.IdItems, Items.Quantity, Items.Price)

            //Tính lại tổng cộng
            totalMoney();
        }

        function deleteItem(item) {
            const id = $(item).data('id');
            //Xóa ptu khỏi itemsSelected
            var check = $.inArray(id, $.map(itemsSelected, function(item) {
                return item.IdItems;
            }));

            if (check !== -1) {
                const Items = itemsSelected.find(item => item.IdItems === id);
                itemsSelected.splice(check, 1);
                $(`#wrap-item-${id}`).remove();
                //Tính lại tổng cộng
                totalMoney();
            }
        }

        function totalMoney() {
            // const listItemsSelected = $('.items-selected');
            var total = 0;

            $('.items-selected').each(function() {
                let price = $(this).find('input[name="Price"]').val();
                let quantity = $(this).find('.quantity').text();
                let itemTotal = price * quantity;
                total += itemTotal;
            });

            $('#total-money').text(total.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }));
            $('input[name="Total"]').val(total);
        }

        function updateQuanTotal(IdItems, Quantity, Price) {
            $(`#quantity-${IdItems}`).text(Quantity);
            let totalOfItem = parseInt(Price) * parseInt(Quantity);

            $(`#total-of-item-${IdItems}`).text(totalOfItem.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }));
        }

        // Lấy giá trị TotalAmount từ hóa đơn hiện tại
        $('#payment-btn').click(function() {
            var infoOrder = $('#info-area-table');

            infoOrder.text(`Thanh toán - Bàn {{ $order->TableName }} - {{ $order->AreaName }}`);
            $('input[name="TotalAmount"]').val($('input[name="Total"]').val());
            $('#TotalAmount').text(parseInt($('input[name="Total"]').val()).toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }));

            // tính tiền thừa
            $('#ChangeAmount').text('0 ₫')

            $('#CustomerPaying').val(parseInt($('input[name="Total"]').val()).toLocaleString('vi-VN', {
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

        //Xác nhận thanh toán
        $("#btn-confirm-payment").click(function() {
            event.preventDefault();
            $.ajax({
                url: "/admin/orders/payment/{{ $order->IdOrder }}",
                method: 'GET',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    showSuccessNotification('rgba(0, 200, 81, 0.85)', response.success);
                    $('.js-modal3').addClass('show-modal');
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
            window.location.href = '/admin/order/print/{{ $order->IdOrder }}';
        });

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
    </script>
@endsection
