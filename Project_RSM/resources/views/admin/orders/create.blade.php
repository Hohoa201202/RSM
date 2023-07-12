@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main p-3">
        <section class="section">
            <div class="row">
                <div class="col-lg-7 col-xl-7 pe-1">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="input-group mb-3">
                                        <select name="IdCustomer" id="IdCustomer" required class="form-select"
                                            aria-invalid="true">
                                            <option value="-1" selected> Khách lẻ </option>
                                            @foreach ($listCustomer as $customer)
                                                <option value="{{ $customer->IdCustomer }}">
                                                    {{ $customer->LastName . ' ' . $customer->FirstName }} -
                                                    {{ $customer->PhoneNumber }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <a class="input-group-text btn-primary js-show-modal" id="CreateCustomer"><i
                                                class="bi bi-person-plus-fill"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="input-group mb-3" id="IdCategory-wrapper">
                                        <span class="input-group-text"><i class="bi bi-table"></i></span>
                                        <select name="IdTable " id="IdTable" class="form-select" required
                                            aria-invalid="true">
                                            <option selected value="0"> --Chọn bàn-- </option>
                                            @foreach ($listTable as $item)
                                                <option value="{{ $item->IdTable }}">
                                                    Bàn {{ $item->TableName }} - {{ $item->AreaName }} - Tối đa
                                                    {{ $item->MaxSeats }} người
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
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
                                                <a href="">
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
                                </div>
                                <div class="py-3 border-top-line">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="m-0 fw-bold">Tổng tiền</p>
                                        <p class="m-0 fs-5 fw-bold text-end" id="total-money">0 ₫</p>
                                        <input type="hidden" name="Total" value="0">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ url('/admin/orders/index') }}"
                                        class="btn btn-danger d-flex flex-column flex-grow-1 py-4">
                                        <i class="bi bi-x-circle"></i>
                                        Quay lại
                                    </a>
                                    <a id="save-btn"
                                        class="btn btn-primary d-flex flex-column flex-grow-1 py-4 ms-1 me-1">
                                        <i class="bi bi-save"></i>
                                        Lưu lại
                                    </a>
                                    <a id="payment-btn" class="btn btn-success d-flex flex-column flex-grow-1 py-4">
                                        <i class="bi bi-wallet2"></i>
                                        Thanh toán
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Thêm khách hàng -->
                <form method="post" action="/admin/customer/create" enctype="multipart/form-data"
                    onsubmit="return CheckValue()">
                    @csrf
                    <div class="row wrap-modal1 js-modal">
                        <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>

                        <div class="d-flex container col-lg-6 col-xl-6" style="max-width: 95%; align-items: center;">
                            <div class="bg0 p-lr-15-lg how-pos3-parent"
                                style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                <div class="text-center mb-5 fs-4">Thêm mới khách hàng</div>
                                <div class="row">
                                    <div class="row mb-3">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Họ tên khách hàng <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="FullName" class="form-control"
                                                    id="FullName" placeholder="VD: Hồ Anh Hòa" oninput="onInput(event)">
                                                <div class="invalid-feedback">Vui lòng nhập họ tên khách hàng!</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Số điện thoại <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="PhoneNumber" class="form-control"
                                                    id="PhoneNumber" placeholder="VD: 0865.787.333"
                                                    oninput="onInput(event)">
                                                <div class="invalid-feedback">Vui lòng nhập số điện thoại!</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Email </label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="Email" class="form-control"
                                                    placeholder="VD: Hohoa201202@gmail.com">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Địa chỉ</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="Address" class="form-control"
                                                    placeholder="VD: Thành phố Vinh, Nghệ An">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="col-sm-12 d-flex" style="padding: 0; justify-content: flex-end;">
                                        <a class="btn btn-light js-hide-modal"
                                            style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                            <i class="bi bi-arrow-left-circle"></i>
                                            Trở lại
                                        </a>

                                        <button type="submit" class="btn btn-primary delete-confirm"
                                            style="border-radius: 50px; min-width: 100px; margin-left: 16px;">
                                            Lưu lại
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </section>
    </main>
    <!--End main-->
    <script>
        $(document).ready(function() {
            $('#IdCustomer').select2({
                placeholder: 'Nhập để tìm kiếm',
                maximumSelectionLength: 10,
                // theme: "classic",
            });
        });

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

        const itemsSelected = [];

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
            const select = $('#IdTable');
            if (select.val() == "0") {
                select.addClass("is-invalid");
                return;
            }
            if (itemsSelected.length < 1) {
                alert("Chưa chọn món.");
                return;
            }

            let formData = new FormData();
            formData.append('IdTable', $('#IdTable').val());
            formData.append('IdCustomer', $('#IdCustomer').val());
            formData.append('Items', JSON.stringify(itemsSelected));

            $.ajax({
                url: '/admin/orders/create',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showSuccessNotification('rgba(0, 200, 81, 0.85)', response.success);
                    // window.location.href = "/admin/orders/index";
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

        function CheckValue() {
            var inputFullName = $("#FullName");
            var inputPhoneNumber = $("#PhoneNumber");
            var isValid = true; // Biến flag mặc định là true

            // Kiểm tra giá trị của input FullName
            if (inputFullName.val().trim() === "") {
                var invalidFeedback = inputFullName.parent().find('.invalid-feedback');
                invalidFeedback.show();
                inputFullName.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            // Kiểm tra giá trị của input PhoneNumber
            if (inputPhoneNumber.val().trim() === "") {
                var invalidFeedback = inputPhoneNumber.parent().find('.invalid-feedback');
                invalidFeedback.show();
                inputPhoneNumber.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            return isValid; // Trả về biến flag
        }
    </script>
@endsection
