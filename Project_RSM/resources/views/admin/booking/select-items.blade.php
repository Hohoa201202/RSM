@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main p-3">
        <section class="section">
            <div class="row">
                <div class="col-lg-8 col-xl-8 pe-1">
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
                                                <a href="{{ route('selected-items', ['IdBooking' => $IdBooking]) }}">
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

                <div class="col-lg-4 col-xl-4 ps-0">
                    <div class="card">
                        <div class="card-body h-100 p-0">
                            <div class="d-flex flex-column form-items-selected p-3">

                                <div class="m-0 pb-2 border-bottom-line-bold">
                                    <div class="d-flex">
                                        <p class="col-xl-7 m-0 fw-bold">Mặt hàng</p>
                                        <p class="col-xl-2 m-0 fw-bold text-center">SL</p>
                                        <p class="col-xl-3 m-0 fw-bold text-end">Thành tiền</p>
                                    </div>
                                </div>
                                <div class="accordion accordion-flush scroll-y-400 border-bottom-line-bold"
                                    id="form-items-selected">
                                    {{-- List Items --}}
                                    @php
                                        $total = 0;
                                    @endphp
                                    @if (!$listItemsOfOrder->isEmpty())
                                        @foreach ($listItemsOfOrder as $item)
                                            @php
                                                $total += $item->Quantity * $item->PriceSale;
                                            @endphp
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
                                        <p class="m-0 fs-5 fw-bold text-end" id="total-money">{{ number_format($total, 0, '.', '.') }} ₫</p>
                                        <input type="hidden" name="Total" value="{{ $total }}">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ back()->getTargetUrl() }}"
                                        class="btn btn-danger d-flex flex-column flex-grow-1 py-4">
                                        <i class="bi bi-arrow-90deg-left"></i>
                                        Quay lại
                                    </a>
                                    <a id="save-btn"
                                        class="btn btn-primary d-flex flex-column flex-grow-1 py-4 ms-1 me-1">
                                        <i class="bi bi-save"></i>
                                        Lưu lại
                                    </a>
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

                itemsSelected.push({
                    IdItems: itemCurrent.IdItems,
                    Quantity: 1,
                    Price: itemCurrent.Price,
                    PriceCost: itemCurrent.CostPrice
                });

                totalMoney();
                addHover()
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
                url: '/admin/booking/selected-items/{{ $IdBooking }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showSuccessNotification('rgba(0, 200, 81, 0.85)', response.success);
                    window.location.href = "/admin/booking/index";
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

        function addHover() {
            $('.items-selected').each(function() {
                $(this).hover(
                    function() { // Sự kiện mouseenter
                        $(this).find('.accordion-collapse').addClass('show');
                    },
                    function() { // Sự kiện mouseleave
                        $(this).find('.accordion-collapse').removeClass('show');
                    }
                );
            });
        }
    </script>
@endsection
