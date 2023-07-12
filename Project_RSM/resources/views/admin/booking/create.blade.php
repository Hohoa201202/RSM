@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left" style="margin-right: 8px;"></i><a
                            href="{{ back()->getTargetUrl() }}">Quay lại trang trước</a></li>
                    <li class="breadcrumb-item active">Thêm mới lịch đặt bàn</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="tab-content pt-2" id="borderedTabJustifiedContent" style="margin-bottom: 28px;">
                                <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                    aria-labelledby="home-tab">

                                    <div class="row mb-3">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Họ tên khách hàng: <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="FullName" class="form-control" id="FullName"
                                                    placeholder="Nhập họ và tên" oninput="onInput(event)"
                                                    value="{{ old('FullName') }}">
                                                <div class="invalid-feedback">Vui lòng nhập gọ tên khách hàng!</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Số điện thoại: <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="PhoneNumber" class="form-control"
                                                    id="PhoneNumber" placeholder="Nhập số điện thoại"
                                                    oninput="onInput(event)" value="{{ old('PhoneNumber') }}">
                                                <div class="invalid-feedback">Vui lòng nhập số điện thoại khách hàng!</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Địa chỉ: </label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="Address" class="form-control" id="Address"
                                                    placeholder="Nhập địa chỉ" value="{{ old('Address') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <label class="form-label">Số lượng khách: <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation">
                                                <input type="number" name="NumberGuests" class="form-control"
                                                    min="1" max="50" id="NumberGuests"
                                                    placeholder="Số khách (*):" oninput="onInput(event)">
                                                <div class="invalid-feedback">Vui lòng nhập số lượng khách</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <label class="form-label">Ngày nhận bàn: <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation">
                                                <input class="form-control" placeholder="---Chọn ngày---" type="text"
                                                    name="BookingDate" id="BookingDate" readonly oninput="onInput(event)">
                                                <div class="invalid-feedback">Vui lòng chọn ngày nhận bàn!</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <label class="form-label">Giờ nhận bàn: <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation">
                                                <input name="TimeSlot" id="TimeSlot" placeholder="---Chọn giờ---"  type="text" readonly class="form-control select-icon">
                                                <div class="invalid-feedback">Vui lòng chọn giờ nhận bàn!</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Chọn trước bàn </label>
                                            <div class="input-group has-validation" id="IdCategory-wrapper"
                                                style="align-items: center;">
                                                <select name="IdTable " id="IdTable" class="form-select" required
                                                    aria-invalid="true" style="border-radius: 0.375rem;">
                                                    <option selected value="-1"> --Chọn trước bàn-- </option>
                                                    @foreach ($listTable as $item)
                                                        <option value="{{ $item->IdTable }}">
                                                            Bàn {{ $item->TableName }} - {{ $item->AreaName }} - Tối đa
                                                            {{ $item->MaxSeats }} người
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label class="text-note form-text">Danh sách các bàn chưa có người đặt</label>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Ghi chú: </label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="Note" class="form-control" id="Note"
                                                    placeholder="Ghi chú" value="{{ old('Note') }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mb-3" style="border-top: 2px solid #3333; padding-top: 24px; ">
                                        <div class="col-lg-12 mb-3">
                                            <div
                                                class="input-affix m-v-10 d-flex align-items-center form-serch js-show-modal">
                                                <i
                                                    class="bi bi-search prefix-icon anticon anticon-search opacity-04 fs-6"></i>
                                                <input id="keyword" autocomplete="off" name="keyword" type="text"
                                                    class="form-control-search" placeholder="Chọn trước món">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <div class="scroll-y-400">
                                                <table class="table e-commerce-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Mặt hàng
                                                            </th>
                                                            <th class="text-center" scope="col"> Giá bán
                                                            </th>
                                                            <th class="text-center" scope="col">Số lượng
                                                            </th>
                                                            <th class="text-center" scope="col">Thành tiền
                                                            </th>
                                                            <th scope="col"> </th>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table-items"
                                                        style="vertical-align:-webkit-baseline-middle !important;">

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="text-center js-show-modal" id="search-btn"
                                                style="color: #747c87; cursor: pointer;">
                                                <i class="bi bi-plus-circle-fill"
                                                    style="font-size: 5rem; opacity: 0.4;"></i>
                                                <p class="fs-6 m-0">Đặt trước món</p>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Bordered Tabs Justified -->
                                @if ($errors->any())
                                    <div>
                                        @foreach ($errors->all() as $error)
                                            <p class="text-danger" style="font-style:italic; letter-spacing: 1px;">
                                                {{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="group d-flex flex-column border-top-line pt-3">
                                    <div class="d-flex justify-content-end">
                                        <div class="col-lg-4 d-flex fs-5 justify-content-between">
                                            <p class="m-0 p-0">Tổng tiền: </p>
                                            <p class="m-0 p-0" id="total-money">0 đ</p>
                                            <input type="hidden" name="Total" value="0">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <a style="margin-left: -12px;" href="{{ back()->getTargetUrl() }}"
                                            class="btn btn-light">
                                            <i class="fa-solid fa-angles-left"></i>
                                            Quay lại
                                        </a>
                                        <a id="save-btn" class="btn btn-primary">
                                            <i class="fa-solid fa-floppy-disk" style="padding-right: 8px"></i>Lưu lại
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Thêm mặt hàng, combo cho combo-->
            <form class="">
                @csrf
                <div class="row wrap-modal1 js-modal">
                    <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>
                    <div class="d-flex container col-lg-6 col-xl-6 col-xs-10"
                        style="max-width: 95%; align-items: center;">
                        <div class="bg0 p-lr-15-lg how-pos3-parent"
                            style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                            <div class="text-center mb-3 fs-3">Chọn món </div>
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="input-affix m-v-10 d-flex align-items-center form-serch">
                                        <i class="bi bi-search prefix-icon anticon anticon-search opacity-04"></i>
                                        <input id="keyword" autocomplete="off" name="keyword" type="text"
                                            class="form-control-search" placeholder="Tìm kiếm mặt hàng, combo">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-3 scroll-y-400">
                                    <table class="table table-hover e-commerce-table">
                                        <tbody id="records_table" class="root-search-hah"
                                            style="vertical-align:-webkit-baseline-middle !important;">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="col-sm-12 d-flex" style="padding: 0; justify-content: flex-end;">
                                    <a class="btn btn-light js-hide-modal"
                                        style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                        <i class="bi bi-arrow-left-circle"></i>
                                        Hủy
                                    </a>

                                    <a type="submit" class="js-hide-modal btn btn-primary" id="btn-add"
                                        style="border-radius: 50px; min-width: 100px; margin-left: 16px;">
                                        Thêm
                                    </a>
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
            var today = moment();
            var maxDate = moment().add(30, 'days');

            const BookingDate = $("#BookingDate")
            if (BookingDate.length) {
                BookingDate.datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: today.toDate(),
                    maxDate: maxDate.toDate(),
                    monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                        'Tháng 7',
                        'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ],
                    monthNamesShort: ['Thg 1', 'Thg 2', 'Thg 3', 'Thg 4', 'Thg 5', 'Thg 6', 'Thg 7',
                        'Thg 8',
                        'Thg 9', 'Thg 10', 'Thg 11', 'Thg 12'
                    ],
                    dayNames: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],
                    dayNamesShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                    dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                });
            }
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
                    @endif ,
                },
            @endforeach
        }

        const root = $('.root-search-hah')
        const searchBtn = $('#search-btn')
        const itemsChecked = []

        function renderSearch() {
            htmlStr = ''

            $.each(listItems, function(index, item) {
                htmlStr += `
                            <tr id="search-item-${item.IdItems}" class="tr-checkbox" style="cursor: pointer;">

                                <td>
                                    <input style="height: 16px; width: 16px;"   type="checkbox" class="check-item-hah" data-id="${item.IdItems}" >
                                </td>
                                <td
                                    style="padding: 1rem !important; vertical-align:-webkit-baseline-middle !important; width: 10%;">
                                    <div class="m-b-20" style="height: 3rem; width: 3rem;">
                                        <img id="img-account"
                                            src="{{ asset('files/images/items/${item.Avatar}') }}"
                                            alt="Profile" class="rounded-circle-items"
                                            style="">
                                    </div>
                                </td>
                                <td
                                     >
                                    ${item.ItemsName}</td>
                                <td class="text-end"
                                     >
                                    ${item.Price.toLocaleString('vi-VN', { minimumFractionDigits: 0, maximumFractionDigits: 2, useGrouping: true, currency: 'VND' })} ₫</td>
                            </tr>
                            `
            })
            root.html(htmlStr)
        }

        renderSearch()

        $(document).ready(function() {
            $('.tr-checkbox').click(function(event) {
                if (event.target.type !== 'checkbox') {
                    $(':checkbox', this).trigger('click');
                }
            });
        });

        function deleteItem(item) {
            const id = $(item).data('id');

            //Xóa ptu khỏi itemsChecked
            var check = $.inArray(id, $.map(itemsChecked, function(item) {
                return item.IdItems;
            }));

            if (check !== -1) {
                const Items = itemsChecked.find(item => item.IdItems === id);
                itemsChecked.splice(check, 1);

                const row = $(item).closest("tr");
                row.remove();
                //Tính lại tổng cộng
                totalMoney();
            }

            $(`#search-item-${id} .check-item-hah`).prop('checked', false);

            if (itemsChecked.length === 0) {
                $('#search-btn').removeClass('d-none');
            }

            console.log(itemsChecked);
        }

        // Truy cập vào phần tử HTML có id là "table-tems"
        const table_checked = $("#table-items");

        const addButton = $("#btn-add");
        addButton.on("click", function() {
            const listItemsCheckbox = $("input.check-item-hah");
            listItemsCheckbox.each(function() {
                if ($(this).is(":checked")) {
                    var check = $.inArray($(this).data("id"), $.map(itemsChecked, function(item) {
                        return item.IdItems;
                    }));

                    //Nếu đã có thì chỉ tăng số lượng
                    if (check !== -1) {
                        return;
                    }

                    $(`#search-item-${$(this).data("id")} .check-item-hah`).prop("checked", true);
                    const itemInList = listItems[$(this).data("id")];
                    const newRow = table_checked[0].insertRow();
                    newRow.classList.add("items-selected");
                    newRow.innerHTML = `
                            <input class="d-none" checked type="checkbox" value="${itemInList.IdItems}" name="ArrItems[]">
                            <td class="d-flex align-items-center"
                                 >
                                <div class="m-b-20 me-3" style="height: 3rem; width: 3rem;">
                                    <img id="img-account"
                                        src="{{ asset('files/images/items/${itemInList.Avatar}') }}"
                                        alt="Profile" class="rounded-circle-items"
                                        style="">
                                </div>
                                ${itemInList.ItemsName}
                            </td>
                            <td class="text-center">
                                ${itemInList.Price.toLocaleString('vi-VN', { minimumFractionDigits: 0, maximumFractionDigits: 2, useGrouping: true, currency: 'VND' })} ₫
                            </td>
                            <td class="text-center">
                                <div onclick="subQuantity(this)" data-id="${itemInList.IdItems}" class="fs-5 me-2 btn btn-light py-0" href="">
                                    <i class="text-danger bi bi-dash"></i>
                                </div>
                                <p class="text-center m-0 px-2 d-inline quantity" id="quantity-${itemInList.IdItems}"> 1 </p>
                                <div onclick="addQuantity(this)" data-id="${itemInList.IdItems}" class="fs-5 btn btn-light py-0 ms-2" href="">
                                    <i class="text-success bi bi-plus"></i>
                                </div>
                            </td>
                            <td class="text-center">
                                <input type="hidden" name="Price" value="${itemInList.Price}">
                                <p class="text-center m-0 px-2 d-inline" id="total-of-item-${itemInList.IdItems}">${itemInList.Price.toLocaleString('vi-VN', { minimumFractionDigits: 0, maximumFractionDigits: 2, useGrouping: true, currency: 'VND' })} ₫</p>
                            </td>
                            <td class="text-end">
                                <a class="btn-delete-items" onclick="deleteItem(this)" data-price="${itemInList.CostPrice }" data-id="${itemInList.IdItems}"><i class="bi bi-x-lg"></i></a>
                            </td>
                            `;
                    searchBtn.addClass('d-none');

                    itemsChecked.push({
                        IdItems: itemInList.IdItems,
                        Quantity: 1,
                        Price: itemInList.Price,
                        PriceCost: itemInList.CostPrice
                    });
                }
                totalMoney();
            });
        });

        function addQuantity(item) {
            const id = $(item).data('id');
            const Items = itemsChecked.find(item => item.IdItems == id);
            Items.Quantity++;
            //Update số lượng và thành tiền
            updateQuanTotal(Items.IdItems, Items.Quantity, Items.Price)

            totalMoney();
        }

        function subQuantity(item) {
            const id = $(item).data('id');

            const Items = itemsChecked.find(item => item.IdItems == id);

            if (Items.Quantity <= 1) {
                return;
            }
            Items.Quantity--

            //Update số lượng và thành tiền
            updateQuanTotal(Items.IdItems, Items.Quantity, Items.Price)

            totalMoney();
        }

        function updateQuanTotal(IdItems, Quantity, Price) {
            $(`#quantity-${IdItems}`).text(Quantity);
            let totalOfItem = parseInt(Price) * parseInt(Quantity);

            $(`#total-of-item-${IdItems}`).text(totalOfItem.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }));
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

        $("#save-btn").click(function() {
            if (!(CheckValue())) {
                return;
            }

            let formData = new FormData();
            formData.append('FullName', $('#FullName').val());
            formData.append('PhoneNumber', $('#PhoneNumber').val());
            formData.append('Address', $('#Address').val());
            formData.append('IdTable', $('#IdTable').val());
            formData.append('NumberGuests', $("#NumberGuests").val());
            formData.append('TimeSlot', $("#TimeSlot").val());
            formData.append('BookingDate', $("#BookingDate").val());
            formData.append('Items', JSON.stringify(itemsChecked));

            console.log(formData.get('Items'));

            $.ajax({
                url: '/admin/booking/create',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.href = '/admin/booking/index';
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
                    backToTop()
                }
            });
        });

        function CheckValue() {
            const NumberGuests = $("#NumberGuests");
            const FullName = $("#FullName");
            const PhoneNumber = $("#PhoneNumber");
            const TimeSlot = $("#TimeSlot");
            const BookingDate = $("#BookingDate");
            var isValid = true; // Biến flag mặc định là true

            // Kiểm tra giá trị của input BookingDate
            if (BookingDate.val() === "") {
                var invalidFeedback = BookingDate.parent().find('.invalid-feedback');
                invalidFeedback.show();
                BookingDate.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            // Kiểm tra giá trị của input TimeSlot
            if (parseInt(TimeSlot.val()) === 0) {
                var invalidFeedback = TimeSlot.parent().find('.invalid-feedback');
                invalidFeedback.show();
                TimeSlot.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            // Kiểm tra giá trị của input NumberGuests
            if (NumberGuests.val().trim() === "") {
                var invalidFeedback = NumberGuests.parent().find('.invalid-feedback');
                invalidFeedback.show();
                NumberGuests.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            // Kiểm tra giá trị của input FullName
            if (FullName.val().trim() === "") {
                var invalidFeedback = FullName.parent().find('.invalid-feedback');
                invalidFeedback.show();
                FullName.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            // Kiểm tra giá trị của input PhoneNumber
            if (PhoneNumber.val().trim() === "") {
                var invalidFeedback = PhoneNumber.parent().find('.invalid-feedback');
                invalidFeedback.show();
                PhoneNumber.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            return isValid;
        }
    </script>
@endsection
