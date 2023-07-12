@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left" style="margin-right: 8px;"></i><a
                            href="{{ back()->getTargetUrl() }}">Quay lại trang trước</a></li>
                    <li class="breadcrumb-item active">Thêm mới combo</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-xl-4 col-lg-3">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <div class="m-b-20" style="height: 10.25rem; width: 10.25rem;">
                                <img id="img-account" src="{{ asset('files/images/combo/default.png') }}" alt="Ảnh mặt hàng"
                                    class="rounded-circle"
                                    style="border: 5px solid #fff;box-shadow: 0 2px 10px #0123 ;border-radius: 50%; width: 100%;height: 100%; object-fit: cover;cursor: pointer;">
                            </div>

                            <div class="input-group mb-3" style="flex-direction: column; text-align: center;">
                                <div>
                                    <label for="Avatar" class="btn btn-light"
                                        style="border-radius: 6px; margin-top: 20px; border: 1px solid #3333;">Chọn
                                        ảnh</label>
                                    <input autocomplete="off" type="file" class="form-control" id="Avatar"
                                        aria-describedby="button-addon2" name="Avatar"
                                        onchange="document.getElementById('img-account').src = window.URL.createObjectURL(this.files[0])" />
                                </div>
                                <div class="m-t-12" style="color: #999; font-size: 14px">
                                    <p style="margin: 16px auto 4px;">Dung lượng file tối đa 1 MB</p>
                                    <p>Định dạng:.JPEG, .PNG</p>
                                    <p>Nên sử dụng hình ảnh có tỉ lệ 1:1</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9 col-xl-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="tab-content pt-2" id="borderedTabJustifiedContent" style="margin-bottom: 28px;">
                                <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                    aria-labelledby="home-tab">

                                    <div class="row mb-3">
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Tên combo <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="ComboName" class="form-control" id="ComboName"
                                                    placeholder="VD: Combo ngon bổ rẻ" oninput="onInput(event)"
                                                    value="{{ old('ComboName') }}">
                                                <div class="invalid-feedback">Vui lòng nhập tên combo!</div>
                                            </div>
                                            <label class="text-note form-text">Được dùng để quản lý và hiển thị trên đơn
                                                bán hàng</label>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Giá bán combo <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation">
                                                <input type="number" name="Price" class="form-control" id="Price"
                                                    placeholder="VD: 100.000 đ" oninput="onInput(event)"
                                                    value="{{ old('Price') }}">
                                                <div class="invalid-feedback">Vui lòng nhập giá bán combo!</div>
                                            </div>
                                            <label class="text-note form-text">Combo được bán với giá thiết lập</label>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Giá gốc</label>
                                            <div class="input-group has-validation">
                                                <input type="number" name="CostPrice" value="0" id="TotalPrice"
                                                    readonly>
                                            </div>
                                            <label class="text-note form-text">Giá vốn bằng tổng giá vốn các mặt
                                                hàng</label>
                                        </div>

                                    </div>
                                    <div class="mb-3" style="border-top: 1px solid #3333; padding-top: 24px; ">
                                        <div class="col-lg-12 mb-3">
                                            <div
                                                class="input-affix m-v-10 d-flex align-items-center form-serch js-show-modal">
                                                <i
                                                    class="bi bi-search prefix-icon anticon anticon-search opacity-04 fs-6"></i>
                                                <input id="keyword" autocomplete="off" name="keyword" type="text"
                                                    class="form-control-search" placeholder="Thêm mặt hàng">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <div class="scroll-y-400">
                                                <table class="table e-commerce-table scroll-y-400">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Mặt hàng
                                                            </th>
                                                            <th class="text-center" scope="col"> Giá bán
                                                            </th>
                                                            <th class="text-center" scope="col">Số lượng
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
                                                <p class="fs-6 m-0">Thêm mặt hàng vào combo</p>
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
                                <div class="group"
                                    style="display: flex; justify-content: space-between; border-top: 1px solid #3333; padding-top: 24px;">
                                    <a style="margin-left: -12px;" href="/admin/combo/index" class="btn">
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
            <!-- Thêm mặt hàng, combo cho combo-->
            <form class="">
                @csrf
                <div class="row wrap-modal1 js-modal">
                    <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>
                    <div class="d-flex container col-lg-6 col-xl-6 col-xs-10"
                        style="max-width: 95%; align-items: center;">
                        <div class="bg0 p-lr-15-lg how-pos3-parent"
                            style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                            <div class="text-center mb-3 fs-3">Thêm mặt hàng </div>
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
                                    <table class="table table-hover e-commerce-table table-borderless datatable">
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
                    @endif,
                    CostPrice: @if ($listPrice->where('IdItems', $item->IdItems)->count() > 0)
                        {{ $listPrice->where('IdItems', $item->IdItems)->first()->CostPrice }}
                    @else
                        0
                    @endif ,
                },
            @endforeach
        }

        const root = $('.root-search-hah')
        const searchBtn = $('#search-btn')
        const itemsChecked = []
        let TotalPrice = $('#TotalPrice')

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
            const Price = parseInt($(item).data('price'));
            let Total = parseInt($('#TotalPrice').val());

            $('#TotalPrice').val(Total - Price);

            var index = itemsChecked.indexOf(id);
            if (index !== -1) {
                itemsChecked.splice(index, 1);
            }

            const row = $(item).closest("tr");
            row.remove();

            $(`#search-item-${id} .check-item-hah`).prop('checked', false);

            if (itemsChecked.length === 0) {
                $('#search-btn').removeClass('d-none');
            }
        }

        const table_checked = $("#table-items");
        const addButton = $("#btn-add");
        addButton.on("click", function() {

            let Total = parseInt(TotalPrice.val())

            const listItemsCheckbox = $("input.check-item-hah");
            listItemsCheckbox.each(function() {
                if ($(this).is(":checked")) {
                    if ($.inArray($(this).data("id"), itemsChecked) > -1) {
                        return;
                    }

                    itemsChecked.push($(this).data("id"));

                    $(`#search-item-${$(this).data("id")} .check-item-hah`).prop("checked", true);
                    const itemInList = listItems[$(this).data("id")];
                    const newRow = table_checked[0].insertRow();
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
                            <td class="text-center"
                                 >
                                ${itemInList.Price} ₫</td>
                            <td class="text-center"
                                 >
                                1</td>
                            <td class="text-end"
                                 >
                                <a class="btn-delete-items" onclick="deleteItem(this)" data-price="${itemInList.CostPrice }" data-id="${itemInList.IdItems}"><i
                                        class="bi bi-x-lg"></i></a>
                            </td>
                            `;
                    searchBtn.addClass('d-none');
                    // console.log(itemsChecked);
                    Total += parseInt(itemInList.CostPrice)
                }

            });
            TotalPrice.val(Total);
        });

        $("#save-btn").click(function() {
            const comboName = $("#ComboName");
            const price = $("#Price");
            const costPrice = $("#TotalPrice");
            const avatar = $("#Avatar");

            if (!(CheckValueCombo())) {
                return;
            }

            let formData = new FormData();
            formData.append('ComboName', comboName.val());
            formData.append('Price', price.val());
            formData.append('CostPrice', costPrice.val());
            formData.append('Avatar', avatar[0].files[0]);
            formData.append('Items', JSON.stringify(itemsChecked));

            console.log(formData.get('Items'));
            $.ajax({
                url: '/admin/combo/create',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showSuccessNotification('rgba(0, 200, 81, 0.85)', response.success);
                    backToTop()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
                    backToTop()
                }
            });
        });

        function CheckValueCombo() {
            const ComboName = $("#ComboName");
            const Price = $("#Price");
            var check = true;

            if (ComboName.val().trim() === "") {
                var invalidFeedback = ComboName.parent().find('.invalid-feedback');
                invalidFeedback.show();
                ComboName.addClass("is-invalid");
                check = false;
            }

            if (Price.val().trim() === "") {
                var invalidFeedback = Price.parent().find('.invalid-feedback');
                invalidFeedback.show();
                Price.addClass("is-invalid");
                check = false;
            }

            return check; // Trả về biến flag
        }
    </script>
@endsection
