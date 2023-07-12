@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left" style="margin-right: 8px;"></i><a
                            href="{{ back()->getTargetUrl() }}">Quay lại trang trước</a></li>
                    <li class="breadcrumb-item active">Thông tin mặt hàng: {{ $Items->ItemsName }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-xl-4 col-lg-3">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <div class="m-b-20" style="height: 10.25rem; width: 10.25rem;">
                                <img id="img-account" src="{{ asset('files/images/items/' . $Items->Avatar) }}"
                                    alt="Ảnh mặt hàng" class="rounded-circle"
                                    style="border: 5px solid #fff;box-shadow: 0 2px 10px #0123 ;border-radius: 50%; width: 100%;height: 100%; object-fit: cover;cursor: pointer;">
                            </div>

                            <div class="input-group mb-3" style="flex-direction: column; text-align: center;">
                                <div>
                                    <label for="_Avatar" class="btn btn-light"
                                        style="border-radius: 6px; margin-top: 20px; border: 1px solid #3333;">Chọn
                                        ảnh mặt hàng</label>
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
                        <div class="card-body">

                            <div class="tab-content pt-2" id="borderedTabJustifiedContent" style="margin-bottom: 28px;">
                                <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="row mb-3">
                                        <input type="hidden" name="Avatar" id="Avatar" value="{{ $Items->Avatar }}">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Tên mặt hàng <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="ItemsName" class="form-control" id="ItemsName"
                                                    placeholder="VD: Cá hồi nướng muối ớt" oninput="onInput(event)"
                                                    value="{{ $Items->ItemsName }}">
                                                <div class="invalid-feedback">Vui lòng nhập tên mặt hàng!</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Loại mặt hàng <label class="text-danger">
                                                    (*)
                                                </label></label>
                                            <div class="input-group has-validation" id="IdCategory-wrapper"
                                                style="align-items: center;">
                                                <select name="IdCategory" id="IdCategory" class="form-select" required
                                                    aria-invalid="true" style="border-radius: 0.375rem;">
                                                    <option value="0">--Chọn loại--</option>
                                                    @foreach ($listCategory as $item)
                                                        <option @if ($Items->IdCategory === $item->IdCategory) selected @endif
                                                            value="{{ $item->IdCategory }}">
                                                            {{ $item->CategoryName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <a class="js-show-modal">
                                                    <i style="font-size: 24.6px; margin-left: 8px"
                                                        class="bi bi-plus-circle-fill"></i>
                                                </a>
                                                <div class="invalid-feedback">Vui lòng chọn loại mặt hàng!</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Đơn vị tính <label class="text-danger">
                                                    (*)
                                                </label></label>
                                            <div class="input-group has-validation" id="IdUnit-wrapper"
                                                style="align-items: center;">
                                                <select name="IdUnit" id="IdUnit" class="form-select" required
                                                    aria-invalid="true" style="border-radius: 0.375rem;">
                                                    <option value="0">--Chọn đơn vị--</option>
                                                    @foreach ($listUnit as $item)
                                                        <option @if ($Items->Unit === $item->IdUnit) selected @endif
                                                            value="{{ $item->IdUnit }}">
                                                            {{ $item->UnitName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <a class="js-show-modal2">
                                                    <i style="font-size: 24.6px; margin-left: 8px"
                                                        class="bi bi-plus-circle-fill"></i>
                                                </a>
                                                <div class="invalid-feedback">Vui lòng chọn đơn vị!</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Ghi chú </label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="Description" class="form-control"
                                                    id="Description" placeholder="VD: Được tùy chọn"
                                                    value="{{ $Items->Description }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top-line" id="form-price">
                                        <p class="pt-3 fs-5">Giá mặt hàng</p>
                                        @if ($listPrice->where('IdItems', $Items->IdItems)->count() > 0)
                                            @foreach ($listPrice->where('IdItems', $Items->IdItems) as $item)
                                                <div class="row price-form align-items-center">
                                                    <div class="col-lg-5 mb-3">
                                                        <label class="form-label">Tên giá <label class="text-danger"> (*)
                                                            </label></label>
                                                        <div class="input-group has-validation">
                                                            <input type="text" name="PriceName" class="form-control"
                                                                placeholder="Nhập tên giá" oninput="onInput(event)"
                                                                value="{{ $item->PriceName }}">
                                                            <div class="invalid-feedback">Vui lòng nhập tên giá!</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-3">
                                                        <label class="form-label">Giá bán <label class="text-danger"> (*)
                                                            </label></label>
                                                        <div class="input-group has-validation">
                                                            <input type="text" name="SalePrice" class="form-control"
                                                                id="" placeholder="0 ₫" oninput="onInput(event)"
                                                                value="{{ $item->SalePrice }}">
                                                            <div class="invalid-feedback">Vui lòng nhập giá bán!</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-3">
                                                        <label class="form-label">Giá vốn <label class="text-danger"> (*)
                                                            </label></label>
                                                        <div class="input-group has-validation">
                                                            <input type="text" name="CostPrice" class="form-control"
                                                                id="" placeholder="0 ₫" oninput="onInput(event)"
                                                                value="{{ $item->CostPrice }}">
                                                            <div class="invalid-feedback">Vui lòng nhập giá vốn!</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 mb-3">
                                                        <label class="form-label"></label>
                                                        <div class="input-group has-validation">
                                                            <a class="d-flex align-items-center" id="btn-del-price">
                                                                @if ($loop->iteration != 1)
                                                                    <i class="bi bi-x-lg"></i>
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <a class="d-flex align-items-center" id="btn-add-price">
                                            <i class="fs-5 bi bi-plus"></i>
                                            <label for="">Thêm giá</label>
                                        </a>
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
                                    <a class="btn btn-danger js-show-modal3">
                                        <i class="fa-solid fa-trash"></i>
                                        Xóa
                                    </a>
                                    <a class="btn btn-primary" id="save-btn">
                                        <i class="fa-solid fa-floppy-disk" style="padding-right: 8px"></i>Lưu lại
                                    </a>
                                </div>
                                <!-- Xác nhận xóa -->
                                <div class="d-flex wrap-modal1 js-modal3">
                                    <div class="overlay-modal1 js-hide-modal3" style="opacity: 0.5;"></div>
                                    <div class="d-flex container"
                                        style=" width: auto; max-width: 70%; align-items: center;">
                                        <div class="bg0 p-lr-15-lg how-pos3-parent position-relative"
                                            style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                            <div class="text-danger mb-3 mt-4"
                                                style="text-align: left; font-size: 18px;">
                                                Bạn chắc chắn muốn xóa mặt hàng<strong>
                                                    {{ $Items->ItemsName }}</strong> ?</div>
                                            <label for="" style=" margin-bottom: 28px;">Thao tác này sẽ không
                                                thể khôi phục
                                            </label>
                                            <div class="m-t-32">
                                                <div class="col-sm-12 d-flex"
                                                    style="padding: 0; justify-content: flex-end;">
                                                    <a class="btn btn-light js-hide-modal3"
                                                        style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                                        <i class="bi bi-arrow-left-circle"></i>
                                                        Hủy
                                                    </a>

                                                    <a href="/admin/items/delete/{{ $Items->IdItems }}"
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

                <!-- Thêm loại mặt hàng -->
                <form class="" action="/admin/category/create" method="post"
                    onsubmit="return CheckValueCategory()">
                    @csrf
                    <div class="row wrap-modal1 js-modal">
                        <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>

                        <div class="d-flex container col-lg-5 col-xl-5" style="max-width: 95%; align-items: center;">
                            <div class="bg0 p-lr-15-lg how-pos3-parent"
                                style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                <div class="text-center mb-5 fs-4">Thêm mới danh mục mặt hàng</div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Tên danh mục <label class="text-danger">
                                                (*)
                                            </label></label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="CategoryName" class="form-control"
                                                id="CategoryName" placeholder="VD: Đồ ăn" oninput="onInput(event)">
                                            <div class="invalid-feedback">Vui lòng nhập tên danh mục!</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Mô tả thêm</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="Description" class="form-control"
                                                placeholder="Tối đa 255 ký tự">
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

                <!-- Thêm đơn vị tính -->
                <form class="" action="/admin/unit/create" method="post" onsubmit="return CheckValueUnit()">
                    @csrf
                    <div class="row wrap-modal1 js-modal2">
                        <div class="overlay-modal1 js-hide-modal2" style="opacity: 0.5;"></div>

                        <div class="d-flex container col-lg-5 col-xl-5" style="max-width: 95%; align-items: center;">
                            <div class="bg0 p-lr-15-lg how-pos3-parent"
                                style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                <div class="text-center mb-5 fs-4">Thêm mới đơn vị tính</div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Tên đơn vị tính <label class="text-danger">
                                                (*)
                                            </label></label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="UnitName" class="form-control" id="UnitName"
                                                placeholder="VD: Đĩa" oninput="onInput(event)">
                                            <div class="invalid-feedback">Vui lòng nhập tên đơn vị tính!</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Mô tả thêm</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="Description" class="form-control"
                                                placeholder="Tối đa 255 ký tự">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="col-sm-12 d-flex" style="padding: 0; justify-content: flex-end;">
                                        <a class="btn btn-light js-hide-modal2"
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
        const itemsName = $("#ItemsName");
        const idCategory = $("#IdCategory");
        const idUnit = $("#IdUnit");
        const avatar = $("#Avatar");
        const _avatar = $("#_Avatar");
        const description = $("#Description");

        $("#save-btn").click(function() {
            if (!(CheckValueItems())) {
                return;
            }
            var prices = [];
            $(".price-form").each(function() {
                if ($(this).find("input[name='SalePrice']").val() != "") {
                    prices.push({
                        'PriceName': $(this).find("input[name='PriceName']").val(),
                        'SalePrice': $(this).find("input[name='SalePrice']").val() ?? 0,
                        'CostPrice': $(this).find("input[name='CostPrice']").val() ?? 0
                    });
                }

            });

            let formData = new FormData();
            formData.append('ItemsName', itemsName.val());
            formData.append('IdCategory', idCategory.val());
            formData.append('IdUnit', idUnit.val());
            formData.append('Avatar', avatar.val());
            formData.append('_Avatar', _avatar[0].files[0]);
            formData.append('Description', description.val());
            formData.append('Prices', JSON.stringify(prices));

            console.log(formData.get('Prices'));
            $.ajax({
                url: '/admin/items/{{ $Items->IdItems }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    showSuccessNotification('rgba(0, 200, 81, 0.85)', response.success);
                    backToTop();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
                    backToTop();
                }
            });
        });

        function CheckValueItems() {
            var check = true;

            if (idCategory.val() === "0") {
                idCategory.addClass("is-invalid");
                var check = false;
            } else {
                idCategory.removeClass("is-invalid"); // Xóa class is-invalid
            }

            if (idUnit.val() === "0") {
                idUnit.addClass("is-invalid");
                var check = false;
            } else {
                idUnit.removeClass("is-invalid"); // Xóa class is-invalid
            }

            // Kiểm tra giá trị của input ItemsName
            if (itemsName.val().trim() === "") {
                var invalidFeedback = itemsName.parent().find('.invalid-feedback');
                invalidFeedback.show();
                itemsName.addClass("is-invalid");
                check = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            return check; // Trả về biến flag
        }

        let listPrice = [];

        $("#btn-add-price").on('click', function() {
            let formPrice = $('#form-price');
            if (formPrice.length) {
                let item = $('<div>', {
                    'class': 'row price-form align-items-center',
                    html: ' <div class="col-lg-5 mb-3">\
                                    <label class="form-label">Tên giá <label class="text-danger"> (*)\
                                        </label></label>\
                                    <div class="input-group has-validation">\
                                        <input type="text" name="PriceName" class="form-control"\
                                            id="" value="Giá thường" placeholder="Nhập tên giá"\
                                            oninput="onInput(event)" value="{{ $Items->PriceName }}">\
                                        <div class="invalid-feedback">Vui lòng nhập tên giá!</div>\
                                    </div>\
                                </div>\
                                <div class="col-lg-3 mb-3">\
                                    <label class="form-label">Giá bán <label class="text-danger"> (*)\
                                        </label></label>\
                                    <div class="input-group has-validation">\
                                        <input type="text" name="SalePrice" class="form-control"\
                                            id="" placeholder="0 ₫" oninput="onInput(event)"\
                                            value="{{ $Items->SalePrice }}">\
                                        <div class="invalid-feedback">Vui lòng nhập giá bán!</div>\
                                    </div>\
                                </div>\
                                <div class="col-lg-3 mb-3">\
                                    <label class="form-label">Giá vốn <label class="text-danger"> (*)\
                                        </label></label>\
                                    <div class="input-group has-validation">\
                                        <input type="text" name="CostPrice" class="form-control"\
                                            id="" placeholder="0 ₫" oninput="onInput(event)"\
                                            value="{{ $Items->CostPrice }}">\
                                        <div class="invalid-feedback">Vui lòng nhập giá vốn!</div>\
                                    </div>\
                                </div>\
                                <div class="col-lg-1 mb-3">\
                                    <label class="form-label"></label>\
                                    <div class="input-group has-validation">\
                                        <a class="d-flex align-items-center" id="btn-del-price">\
                                            <i class="bi bi-x-lg"></i>\
                                        </a>\
                                    </div>\
                                </div>'
                });
                formPrice.append(item);
            }
        });

        $('body').on('click', '#btn-del-price', function() {
            $(this).closest('div.row').remove();
        });

        function CheckValueCategory() {
            const CategoryName = $("#CategoryName");

            var isValid = true; // Biến flag mặc định là true

            // Kiểm tra giá trị của input CategoryName
            if (CategoryName.val().trim() === "") {
                var invalidFeedback = CategoryName.parent().find('.invalid-feedback');
                invalidFeedback.show();
                CategoryName.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            return isValid; // Trả về biến flag
        }

        function CheckValueUnit() {
            const UnitName = $("#UnitName");

            var isValid = true; // Biến flag mặc định là true

            // Kiểm tra giá trị của input UnitName
            if (UnitName.val().trim() === "") {
                var invalidFeedback = UnitName.parent().find('.invalid-feedback');
                invalidFeedback.show();
                UnitName.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            return isValid; // Trả về biến flag
        }
    </script>
@endsection
