@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-xl-10 mx-auto">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb align-items-center" style="justify-content: space-between;">
                                <li class="breadcrumb-item d-flex align-items-center;"><i class="bi bi-arrow-90deg-left"
                                        style="margin-right: 8px;">
                                    </i>
                                    <a href="{{ back()->getTargetUrl() }}">Quay lại trang trước</a>
                                    <label class="breadcrumb-item active"> / Thêm mới khu vực </label>
                                </li>
                                <div>
                                    <a style="color: #fff;" class="btn btn-primary js-show-modal2 me-2">
                                        <i class="bi bi-plus-circle"></i>
                                        <span>Thêm nhiều bàn</span>
                                    </a>
                                    <a style="color: #fff;" class="btn btn-primary js-show-modal">
                                        <i class="bi bi-plus-circle"></i>
                                        <span>Thêm bàn mới</span>
                                    </a>
                                </div>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content pt-2" id="borderedTabJustifiedContent" style="margin-bottom: 28px;">
                                <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                    aria-labelledby="home-tab">

                                    <div class="row ">
                                        <div class="col-lg-6 col-xl-6 col-md-6 mb-3">
                                            <label class="form-label">Tên khu vực <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="AreaName" class="form-control" id="AreaName"
                                                    placeholder="VD: Khu vực sảnh chính" oninput="onInput(event)"
                                                    value="{{ old('AreaName') }}">
                                                <div class="invalid-feedback">Vui lòng nhập tên khu vực!</div>
                                            </div>
                                            <label class="text-note form-text">Tên khu vực trong cơ sở</label>
                                        </div>

                                        <div class="col-lg-6 col-xl-6 col-md-6 mb-3">
                                            <label class="form-label">Thuộc cơ sở <label class="text-danger"> (*)
                                                </label></label>
                                            <div class="input-group has-validation" id="IdCategory-wrapper"
                                                style="align-items: center;">
                                                <select name="IdBranch " id="IdBranch" class="form-select" required
                                                    aria-invalid="true" style="border-radius: 0.375rem;">
                                                    @foreach ($listBranchs as $item)
                                                        <option value="{{ $item->IdBranch }}">
                                                            {{ $item->BranchName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">Vui lòng chọn loại mặt hàng!</div>
                                            </div>
                                            <label class="text-note form-text">Khu vực thuộc cơ sở nào ?</label>
                                        </div>
                                    </div>
                                    <div class="border-top-line mb-3"></div>
                                    <div class="row mb-3 " id="form-item-table">
                                        {{--  --}}

                                        <div class="text-center js-show-modal" id="search-btn">
                                            <i class="bi bi-plus-circle-fill" style="font-size: 5rem; opacity: 0.4;"></i>
                                            <p class="fs-6 m-0">Khu vực này chưa có bàn</p>
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
                                <a style="margin-left: -12px;" href="/admin/area/index" class="btn">
                                    <i class="fa-solid fa-angles-left"></i>
                                    Quay lại
                                </a>
                                <button autocomplete="off" type="submit" class="btn btn-primary" id="btn-submit"
                                    value="">
                                    <i class="fa-solid fa-floppy-disk" style="padding-right: 8px"></i>Lưu lại
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thêm nhiều bàn-->
            <div class="row wrap-modal1 js-modal2">
                <div class="overlay-modal1 js-hide-modal2" style="opacity: 0.5;"></div>
                <div class="d-flex container col-lg-7 col-xl-7 col-xs-10 align-items-center" style="max-width: 95%;">
                    <div class="bg0 p-lr-15-lg how-pos3-parent position-relative form-modal">
                        <div class="text-center mb-3 fs-4 border-bottom-line pb-3">Thêm nhiều bàn </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 pb-4">
                                        <label class="form-label">Số lượng bàn <label class="text-danger"> (*)
                                            </label></label>
                                        <div class="input-group has-validation">
                                            <input type="number" name="TableQuantity" class="form-control" pattern="[0-9]*"
                                                id="TableQuantity" placeholder="Tối đa 50 bàn" oninput="onInput(event)"
                                                value="{{ old('TableQuantity') }}">
                                            <div class="invalid-feedback">Dữ liệu không hợp lệ!</div>
                                        </div>
                                        <div class="form-text text-note">Không quá 50 bàn mỗi lần thêm</div>
                                    </div>
                                    <div class="col-lg-6 pb-4">
                                        <label class="form-label">Số bàn bắt đầu <label class="text-danger"> (*)
                                            </label></label>
                                        <div class="input-group has-validation">
                                            <input type="number" name="TableStart" class="form-control" id="TableStart"
                                                pattern="[0-9]*" placeholder="[? : Số lượng bàn]"
                                                oninput="onInput(event)" value="{{ old('TableStart') }}">
                                            <div class="invalid-feedback">Vui lòng nhập tên bàn!</div>
                                        </div>
                                        <div class="form-text text-note">ok!</div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap pt-4 border-top-line">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6 pe-3">
                                        <label class="form-label">Loại bàn</label>
                                        <div class="input-group has-validation flex-column">
                                            @foreach ($listTableTypes as $item)
                                                <div
                                                    class="d-flex mb-3 custom-radio table-type {{ $loop->iteration === 1 ? 'active' : '' }}">
                                                    <input type="radio" {{ $loop->iteration === 1 ? 'checked' : '' }}
                                                        class="d-none" value="{{ $item->IdType }}"
                                                        id="{{ 'TableType' . $item->IdType }}" name="TableType"
                                                        class="form-controlzzz">
                                                    <label class="flex-grow-1"
                                                        for="{{ 'TableType' . $item->IdType }}">{{ $item->TypeName }}
                                                        ({{ $item->MaxSeats }} chỗ)
                                                    </label>
                                                    <i
                                                        class="{{ $loop->iteration === 1 ? '' : 'd-none' }} icon-check bi bi-check-circle-fill"></i>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6 ps-3">
                                        <label class="form-label">Kiểu dáng</label>
                                        <div class="input-group has-validation flex-column ">
                                            <div class="d-flex mb-3 custom-radio table-style active">
                                                <input type="radio" checked class="d-none" id="square"
                                                    value="1" name="TableStyle" class="form-controlzzz">
                                                <label class="fs-4 flex-grow-1" for="square"><i
                                                        class="bi bi-square"></i></label>
                                                <i class="icon-check bi bi-check-circle-fill"></i>
                                            </div>
                                            <div class="d-flex mb-3 custom-radio table-style">
                                                <input type="radio" class="d-none" id="circle" name="TableStyle"
                                                    value="2" class="form-controlzzz">
                                                <label class="fs-4 flex-grow-1" for="circle"><i
                                                        class="bi bi-circle"></i></label>
                                                <i class="icon-check d-none bi bi-check-circle-fill"></i>
                                            </div>
                                            <div class="d-flex mb-3 custom-radio table-style">
                                                <input type="radio" class="d-none" id="rectangle" name="TableStyle"
                                                    value="3" class="form-controlzzz">
                                                <label class="fs-4 flex-grow-1" for="rectangle"><i
                                                        class="bi bi-square"></i></label>
                                                <i class="icon-check d-none bi bi-check-circle-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 border-left-line ">
                            </div>
                        </div>
                        <a class="btn btn-light btn-round js-hide-modal2 position-absolute">
                            <i class="bi bi-x-lg"></i>
                        </a>
                        <div class="border-top-line pt-3 mt-3">
                            <div class="col-sm-12 d-flex" style="padding: 0; justify-content: flex-end;">
                                <a type="submit" class="btn btn-primary" id="btn-add-tables"
                                    style="border-radius: 50px; min-width: 100px; margin-left: 16px;">
                                    Lưu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thêm bàn-->
            {{-- <div class="row wrap-modal1 js-modal">
                <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>
                <div class="d-flex container col-lg-7 col-xl-7 col-xs-10 align-items-center" style="max-width: 95%;">
                    <div class="bg0 p-lr-15-lg how-pos3-parent position-relative form-modal">
                        <div class="text-center mb-3 fs-4 border-bottom-line pb-3">Thêm bàn </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-12 pb-4">
                                        <label class="form-label">Tên bàn <label class="text-danger"> (*)
                                            </label></label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="TableName" class="form-control" id="TableName"
                                                placeholder="VD: Bàn 001" oninput="onInput(event)"
                                                value="{{ old('TableName') }}">
                                            <div class="invalid-feedback">Vui lòng nhập tên bàn!</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap pt-4 border-top-line">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6 pe-3">
                                        <label class="form-label">Loại bàn</label>
                                        <div class="input-group has-validation flex-column">
                                            @foreach ($listTableTypes as $item)
                                                <div
                                                    class="d-flex mb-3 custom-radio table-type {{ $loop->iteration === 1 ? 'active' : '' }}">
                                                    <input type="radio" {{ $loop->iteration === 1 ? 'checked' : '' }}
                                                        class="d-none" value="{{ $item->IdType }}"
                                                        id="{{ 'TableType' . $item->IdType }}" name="TableType"
                                                        class="form-controlzzz">
                                                    <label class="flex-grow-1"
                                                        for="{{ 'TableType' . $item->IdType }}">{{ $item->TypeName }}
                                                        ({{ $item->MaxSeats }} chỗ)
                                                    </label>
                                                    <i
                                                        class="{{ $loop->iteration === 1 ? '' : 'd-none' }} icon-check bi bi-check-circle-fill"></i>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6 ps-3">
                                        <label class="form-label">Kiểu dáng</label>
                                        <div class="input-group has-validation flex-column ">
                                            <div class="d-flex mb-3 custom-radio table-style active">
                                                <input type="radio" checked class="d-none" id="square"
                                                    value="1" name="TableStyle" class="form-controlzzz">
                                                <label class="fs-4 flex-grow-1" for="square"><i
                                                        class="bi bi-square"></i></label>
                                                <i class="icon-check bi bi-check-circle-fill"></i>
                                            </div>
                                            <div class="d-flex mb-3 custom-radio table-style">
                                                <input type="radio" class="d-none" id="circle" name="TableStyle"
                                                    value="2" class="form-controlzzz">
                                                <label class="fs-4 flex-grow-1" for="circle"><i
                                                        class="bi bi-circle"></i></label>
                                                <i class="icon-check d-none bi bi-check-circle-fill"></i>
                                            </div>
                                            <div class="d-flex mb-3 custom-radio table-style">
                                                <input type="radio" class="d-none" id="rectangle" name="TableStyle"
                                                    value="3" class="form-controlzzz">
                                                <label class="fs-4 flex-grow-1" for="rectangle"><i
                                                        class="bi bi-square"></i></label>
                                                <i class="icon-check d-none bi bi-check-circle-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 border-left-line ">
                            </div>
                        </div>
                        <a class="btn btn-light btn-round js-hide-modal position-absolute">
                            <i class="bi bi-x-lg"></i>
                        </a>
                        <div class="border-top-line pt-3 mt-3">
                            <div class="col-sm-12 d-flex" style="padding: 0; justify-content: flex-end;">
                                <a type="submit" class="btn btn-primary" id="btn-add-table"
                                    style="border-radius: 50px; min-width: 100px; margin-left: 16px;">
                                    Lưu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </section>
    </main>
    <!--End main-->

    <script>
        let tables = [];

        //Thêm từng bàn 1
        $("#btn-add-table").on('click', function() {
            // Lấy giá trị các trường thông tin
            let tableName = $("#TableName");
            let tableType = $("input[name='TableType']:checked");
            let tableStyle = $("input[name='TableStyle']:checked");

            if (tableName.val().trim() === "") {
                var invalidFeedback = tableName.parent().find('.invalid-feedback');
                invalidFeedback.show();
                tableName.addClass("is-invalid");
                return;
            }
            var table = $('#form-item-table');
            if (table.length) {
                var tableItem = $('<div>', {
                    'class': 'col-lg-3 mb-3',
                    html: '<div class="item-table"><p class="m-0 d-0 text-center">' + tableName.val() +
                        '</p></div>'
                });
                table.append(tableItem);
            }

            // Thêm thông tin mới vào mảng tables
            tables.push({
                TableName: tableName.val(),
                IdType: tableType.val(),
                Style: tableStyle.val()
            });

            $('#search-btn').hide();
            $('.js-modal').removeClass('show-modal');
        });

        function check(tableQuantity) {
            var check = true;
            if (tableQuantity.val().trim() === "" || tableQuantity.val() > 50 || tableQuantity.val() < 1) {
                var invalidFeedback = tableQuantity.parent().find('.invalid-feedback');
                invalidFeedback.show();
                tableQuantity.addClass("is-invalid");
                check = false;
            }

            return check;
        }
        //Thêm nhiều bàn
        $("#btn-add-tables").on('click', function() {
            // Lấy giá trị các trường thông tin TableQuantity
            let tableQuantity = $("#TableQuantity");
            let tableStart = $("#TableStart");
            let tableType = $("input[name='TableType']:checked");
            let tableStyle = $("input[name='TableStyle']:checked");

            if (!check(tableQuantity)) {
                return;
            };

            let table = $('#form-item-table');

            if (tableQuantity.val() != "") {
                let count = 1;

                if (tableStart.val() != "") {
                    count = tableStart.val();
                }
                for (let i = 1; i <= tableQuantity.val(); i++) {
                    if (table.length) {
                        let tableItem = $('<div>', {
                            'class': 'col-lg-3 mb-3',
                            html: '<div class="item-table"><p class="m-0 d-0 text-center">Bàn ' + count +
                                '</p></div>'
                        });
                        table.append(tableItem);
                    }
                    // Thêm thông tin mới vào mảng tables
                    tables.push({
                        TableName: count,
                        IdType: tableType.val(),
                        Style: tableStyle.val()
                    });
                    count++;
                }
            }
            $('#search-btn').hide();
            $('.js-modal2').removeClass('show-modal');
        });

        $("#btn-submit").on('click', function() {
            let areaName = $("#AreaName");
            let idBranch = $("#IdBranch");

            if (areaName.val().trim() === "") {
                var invalidFeedback = areaName.parent().find('.invalid-feedback');
                invalidFeedback.show();
                areaName.addClass("is-invalid");
                return;
            }

            // Đóng gói dữ liệu thành một đối tượng JSON
            let data = {
                AreaName: areaName.val(),
                IdBranch: idBranch.val(),
                Tables: tables
            };
            $.ajax({
                url: '/admin/area/create',
                method: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showSuccessNotification('rgba(0, 200, 81, 0.85)', response.succes);
                    backToTop()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showSuccessNotification('rgba(255, 0, 0, 0.7)', 'Thất bại');
                    backToTop()
                }
            });
        });

        $(document).ready(function() {
            const TypeModal2 = $('.js-modal2 input[name="TableType"]');
            const StyleModal2 = $('.js-modal2 input[name="TableStyle"]')
            wrapRadion(TypeModal2, StyleModal2);

            // const TypeModal = $('.js-modal input[name="TableType"]');
            // const StyleModal = $('.js-modal input[name="TableStyle"]')
            // wrapRadion(TypeModal, StyleModal);
        });

        function wrapRadion(TableType, TableStyle) {
            TableType.on('click', function() {
                $('.custom-radio.table-type').removeClass('active');
                $('.custom-radio.table-type .icon-check').addClass('d-none');

                // Thêm lớp CSS 'active' cho phần tử được chọn và hiển thị biểu tượng tương ứng
                const selectedRadioContainer = $(this).closest('.custom-radio.table-type');
                selectedRadioContainer.addClass('active');
                selectedRadioContainer.find('.icon-check').removeClass('d-none');
            });

            TableStyle.on('click', function() {
                $('.custom-radio.table-style').removeClass('active');
                $('.custom-radio.table-style .icon-check').addClass('d-none');

                // Thêm lớp CSS 'active' cho phần tử được chọn và hiển thị biểu tượng tương ứng
                const selectedRadioContainer = $(this).closest('.custom-radio.table-style');
                selectedRadioContainer.addClass('active');
                selectedRadioContainer.find('.icon-check').removeClass('d-none');
            });
        };
    </script>
@endsection
