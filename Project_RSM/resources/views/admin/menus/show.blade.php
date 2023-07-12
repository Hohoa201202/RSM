@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left" style="margin-right: 8px;"></i><a
                            href="{{ back()->getTargetUrl() }}">Quay lại trang trước</a></li>
                    <li class="breadcrumb-item active">Cập nhật thực đơn</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div id="form-create-menu">
                <div class="row">
                    <div class="col-xl-4 col-lg-3">
                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <div class="m-b-20" style="height: 10.25rem; width: 10.25rem;">
                                    <img id="img-account" src="{{ asset("files/images/menus/$Menu->Avatar") }}"
                                        alt="Ảnh mặt hàng" class="rounded-circle"
                                        style="border: 5px solid #fff;box-shadow: 0 2px 10px #0123 ;border-radius: 50%; width: 100%;height: 100%; object-fit: cover;cursor: pointer;">
                                </div>

                                <div class="input-group mb-3" style="flex-direction: column; text-align: center;">
                                    <div>
                                        <label for="_Avatar" class="btn btn-light"
                                            style="border-radius: 6px; margin-top: 20px; border: 1px solid #3333;">Chọn
                                            ảnh</label>
                                        <input type="hidden" name="Avatar" id="Avatar" value="{{ $Menu->Avatar }}">
                                        <input autocomplete="off" type="file" class="form-control" id="_Avatar"
                                            aria-describedby="button-addon2" name="_Avatar"
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
                            <div class="card-body p-4">
                                <div class="tab-content pt-2" id="borderedTabJustifiedContent" style="margin-bottom: 28px;">
                                    <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                        aria-labelledby="home-tab">

                                        <div class="row mb-3">
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Tên thực đơn <label class="text-danger"> (*)
                                                    </label></label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="MenuName" class="form-control"
                                                        id="MenuName" placeholder="VD: Khai vị" oninput="onInput(event)"
                                                        value="{{ $Menu->MenuName }}">
                                                    <div class="invalid-feedback">Vui lòng nhập tên thực đơn!</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Thứ tự sắp xếp</label>
                                                <div class="input-group has-validation">
                                                    <input type="number" name="OrderMenu" class="form-control"
                                                        min="0" id="OrderMenu" placeholder="VD: 1"
                                                        oninput="onInput(event)" value="{{ $Menu->OrderMenu }}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mb-3" style="border-top: 1px solid #3333; padding-top: 24px; ">
                                            <div class="col-lg-12 mb-3">
                                                <div class="btn btn-light js-show-modal" id="search-btn">
                                                    Thêm mặt hàng
                                                </div>
                                                <div class="scroll-y-400">
                                                    <table class="table e-commerce-table scroll-400-x ">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Mặt hàng
                                                                </th>
                                                                <th class="text-center" scope="col"> Giá bán
                                                                </th>
                                                                <th class="text-center" scope="col">Danh mục
                                                                </th>
                                                                <th scope="col"> </th>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table-items" class="scroll-y-400"
                                                            style="vertical-align:-webkit-baseline-middle !important;">
                                                            @foreach ($ItemsOfMenu as $item)
                                                                <tr>
                                                                    <input class="d-none" checked type="checkbox"
                                                                        value="{{ $item->IdItems }}" name="ArrItems[]">
                                                                    <td class="d-flex align-items-center">
                                                                        <div class="m-b-20 me-3"
                                                                            style="height: 3rem; width: 3rem;">
                                                                            <img id="img-account"
                                                                                src="{{ asset("files/images/items/$item->Avatar") }}"
                                                                                alt="Profile"
                                                                                class="rounded-circle-items">
                                                                        </div>
                                                                        {{ $item->ItemsName }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @if ($listPrice->where('IdItems', $item->IdItems)->count() > 0)
                                                                            {{ number_format($listPrice->where('IdItems', $item->IdItems)->first()->SalePrice, 0, '.', '.') }}
                                                                            ₫
                                                                        @else
                                                                            0 ₫
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">{{ $item->CategoryName }}</td>
                                                                    <td class="text-end">
                                                                        <a class="btn-delete-items"
                                                                            onclick="deleteItem(this)"
                                                                            data-id="{{ $item->IdItems }}"><i
                                                                                class="bi bi-x-lg"></i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="text-center @if ($ItemsOfMenu->count() > 0) d-none @endif"
                                                    id="menu-empty">
                                                    <div class="">
                                                        <img style="max-width: 120px;"
                                                            src="{{ asset('files/images/iconsystem/items_empty.png') }}"
                                                            alt="" class="img-items-empty">
                                                    </div>
                                                    <p class="fs-6 pt-3 m-0">Thực đơn chưa có mặt hàng nào</p>
                                                    <p class="fs-7 p-2 m-0">Bạn hãy thêm mới mặt hàng cho thực đơn này nhé
                                                    </p>
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
                                        <a class="btn btn-danger js-show-modal2">
                                            <i class="fa-solid fa-trash"></i>
                                            Xóa
                                        </a>
                                        <a class="btn btn-primary" id="save-btn">
                                            <i class="fa-solid fa-floppy-disk" style="padding-right: 8px"></i>Lưu lại
                                        </a>
                                    </div>
                                    <!-- Xác nhận xóa -->
                                    <div class="d-flex wrap-modal1 js-modal2">
                                        <div class="overlay-modal1 js-hide-modal2" style="opacity: 0.5;"></div>
                                        <div class="d-flex container"
                                            style=" width: auto; max-width: 70%; align-items: center;">
                                            <div class="bg0 p-lr-15-lg how-pos3-parent position-relative"
                                                style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                                <div class="text-danger mb-3 mt-4"
                                                    style="text-align: left; font-size: 18px;">
                                                    Bạn chắc chắn muốn xóa thực đơn<strong>
                                                        {{ $Menu->MenuName }}</strong> ?</div>
                                                <label for="" style=" margin-bottom: 28px;">Thao tác này sẽ không
                                                    thể khôi phục
                                                </label>
                                                <div class="m-t-32">
                                                    <div class="col-sm-12 d-flex"
                                                        style="padding: 0; justify-content: flex-end;">
                                                        <a class="btn btn-light js-hide-modal2"
                                                            style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                                            <i class="bi bi-arrow-left-circle"></i>
                                                            Hủy
                                                        </a>

                                                        <a href="/admin/menus/delete/{{ $Menu->IdMenu }}"
                                                            class="btn btn-danger delete-confirm"
                                                            style="border-radius: 50px; min-width: 100px; margin-left: 16px;">
                                                            Xóa
                                                        </a>
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
                </form>

                <!-- Thêm mặt hàng-->
                <form class="">
                    @csrf
                    <div class="row wrap-modal1 js-modal">
                        <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>
                        <div class="d-flex container col-lg-6 col-xl-6 col-xs-10"
                            style="max-width: 95%; align-items: center;">
                            <div class="bg0 p-lr-15-lg how-pos3-parent"
                                style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                <div class="text-center mb-3 fs-3">Thêm mặt hàng </div>
                                {{-- <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="input-affix m-v-10 d-flex align-items-center form-serch">
                                            <i class="bi bi-search prefix-icon anticon anticon-search opacity-04"></i>
                                            <input id="keyword" autocomplete="off" name="keyword" type="text"
                                                class="form-control-search" placeholder="Tìm kiếm mặt hàng, combo">
                                        </div>
                                    </div>
                                </div> --}}

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
        const itemsChecked = [
            @if (!$ItemsOfMenu->isEmpty())
                @foreach ($ItemsOfMenu as $item)
                    {{ $item->IdItems }},
                @endforeach
            @endif
        ]

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
                    CategoryName: @if ($item->IdCategory != null)
                        "{{ $item->CategoryName }}"
                    @else
                        0
                    @endif ,
                },
            @endforeach
        }

        const root = $('.root-search-hah')
        const searchBtn = $('#search-btn')

        function renderSearch() {
            htmlStr = ''
            $.each(listItems, function(index, item) {
                const isChecked = itemsChecked.includes(item.IdItems);
                htmlStr += `
                            <tr id="search-item-${item.IdItems}" class="tr-checkbox" style="cursor: pointer;">

                                <td>
                                    <input style="height: 16px; width: 16px;"   type="checkbox" class="check-item-hah" data-id="${item.IdItems}" ${isChecked ? 'checked' : ''}>
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
                                <td>${item.ItemsName}</td>
                                <td class="text-end">
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

            var index = itemsChecked.indexOf(id);
            if (index !== -1) {
                itemsChecked.splice(index, 1);
            }

            const row = $(item).closest("tr");
            row.remove();

            $(`#search-item-${id} .check-item-hah`).prop('checked', false);

            if (itemsChecked.length === 0) {
                $('#menu-empty').removeClass('d-none');
            }
            console.log(itemsChecked);
        }

        const table_checked = $("#table-items");

        $("#btn-add").on("click", function() {
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
                            <td class="d-flex align-items-center">
                                <div class="m-b-20 me-3" style="height: 3rem; width: 3rem;">
                                    <img id="img-account" src="{{ asset('files/images/items/${itemInList.Avatar}') }}" alt="Profile" class="rounded-circle-items">
                                </div>
                                ${itemInList.ItemsName}
                            </td>
                            <td class="text-center">
                                ${itemInList.Price.toLocaleString('vi-VN', { minimumFractionDigits: 0, maximumFractionDigits: 2, useGrouping: true, currency: 'VND' })} ₫
                            </td>
                            <td class="text-center">${itemInList.CategoryName}</td>
                            <td class="text-end">
                                <a class="btn-delete-items" onclick="deleteItem(this)" data-id="${itemInList.IdItems}"><i class="bi bi-x-lg"></i></a>
                            </td>
                            `;
                    $('#menu-empty').addClass('d-none');
                }
            });
        });

        $("#save-btn").click(function() {
            const MenuName = $("#MenuName");
            const OrderMenu = $("#OrderMenu");
            const avatar = $("#Avatar");
            const _avatar = $("#_Avatar");

            if (!(CheckValue())) {
                return;
            }

            let formData = new FormData();
            formData.append('MenuName', MenuName.val());
            formData.append('OrderMenu', OrderMenu.val());
            formData.append('Avatar', avatar.val());
            formData.append('_Avatar', _avatar[0].files[0]);
            formData.append('Items', JSON.stringify(itemsChecked));

            $.ajax({
                url: '/admin/menus/{{ $Menu->IdMenu }}',
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

        function CheckValue() {
            const MenuName = $("#MenuName");
            var check = true;

            if (MenuName.val().trim() === "") {
                var invalidFeedback = MenuName.parent().find('.invalid-feedback');
                invalidFeedback.show();
                MenuName.addClass("is-invalid");
                check = false;
            }

            return check; // Trả về biến flag
        }
    </script>
@endsection
