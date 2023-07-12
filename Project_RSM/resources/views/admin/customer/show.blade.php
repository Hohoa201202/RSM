@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left" style="margin-right: 8px;"></i><a href="{{ back()->getTargetUrl() }}">Quay lại trang trước</a></li>
                    <li class="breadcrumb-item active">Thông tin khách hàng:
                        {{ $customer->LastName . ' ' . $customer->FirstName }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <form method="post" action="/admin/customer/{{ $customer->IdCustomer }}" enctype="multipart/form-data"
                onsubmit="return CheckValue()">

                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8 col-xl-9" style="margin: 0 auto;">
                        <div class="card">
                            <div class="card-body">

                                <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                    <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                        aria-labelledby="home-tab">

                                        <div class="row mb-3">
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Họ tên khách hàng <label class="text-danger"> (*)
                                                    </label></label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="FullName" class="form-control"
                                                        id="FullName" placeholder="VD: Hồ Anh Hòa" oninput="onInput(event)"
                                                        value="{{ $customer->LastName . ' ' . $customer->FirstName }}">
                                                    <div class="invalid-feedback">Vui lòng nhập họ tên khách hàng!</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Số điện thoại <label class="text-danger"> (*)
                                                    </label></label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="PhoneNumber" class="form-control"
                                                        id="PhoneNumber" placeholder="VD: 0865.787.333"
                                                        oninput="onInput(event)" value="{{ $customer->PhoneNumber }}">
                                                    <div class="invalid-feedback">Vui lòng nhập số điện thoại!</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Email </label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="Email" class="form-control"
                                                        placeholder="VD: Hohoa201202@gmail.com"
                                                        value="{{ $customer->Email }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Địa chỉ</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="Address" class="form-control"
                                                        placeholder="VD: Thành phố Vinh, Nghệ An"
                                                        value="{{ $customer->Address }}">
                                                </div>
                                            </div>
                                        </div>
                                        @if (empty($customer->UserName))
                                            <div class="group" style="border-top: 1px solid #3333; padding-top: 24px;">
                                                <p style="text-transform: uppercase;"> Tạo tài khoản </p>
                                                <p> Tạo tài khoản cho khách hàng đăng nhập hệ thống
                                                    <strong> </strong>
                                                </p>
                                                <a class="btn btn-light" onclick="toggleInputs(this)"
                                                    id="button-create-account"
                                                    style="border-radius: 6px; margin-bottom: 20px; border: 1px solid #3333;">
                                                    Tạo tài khoản
                                                </a>

                                                <div class="row mb-3 d-none" id="create-account">
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Tài khoản <label class="text-danger">
                                                                (*)
                                                            </label></label>
                                                        <div class="input-group has-validation">

                                                            <input type="text" name="_UserName" class="form-control"
                                                                id="UserName" oninput="onInput(event)"
                                                                placeholder="Tối thiểu 6 ký tự">
                                                            <div class="invalid-feedback">Vui lòng nhập tài khoản!
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 mb-3">

                                                    </div>

                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Mật khẩu đăng nhập <label
                                                                class="text-danger">
                                                                (*)
                                                            </label></label>
                                                        <div class="input-group has-validation">

                                                            <input type="password" name="PassWord" class="form-control"
                                                                id="Pass" oninput="onInput(event)"
                                                                onkeypress="return isCharacterKey(event)"
                                                                onpaste="return false" placeholder="Tối thiểu 6 ký tự">
                                                            <span class="input-group-text"
                                                                onclick="event.stopPropagation();" id="show-hide-pass">
                                                                <i class="bi bi-eye-slash-fill" style=""></i></span>

                                                            <div class="invalid-feedback">Vui lòng nhập mật khẩu đăng nhập!
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Xác nhận mật khẩu <label
                                                                class="text-danger">
                                                                (*)
                                                            </label></label>
                                                        <div class="input-group has-validation">
                                                            <input type="password" name="Confirm" class="form-control"
                                                                id="PassConfirm" oninput="onInput(event)"
                                                                onkeypress="return isCharacterKey(event)"
                                                                onpaste="return false"
                                                                placeholder="Nhập lại chính xác mật khẩu">
                                                            <span class="input-group-text" id="show-hide-passs"
                                                                onclick="event.stopPropagation();">
                                                                <i class="bi bi-eye-slash-fill" style=""></i></span>
                                                            <div class="invalid-feedback">Mật khẩu không khớp !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @else
                                            <input type="hidden" name="UserName" id="UserName"
                                                value="{{ $customer->UserName }}">
                                            <div class="group" style="border-top: 1px solid #3333; padding-top: 24px;">
                                                <p style="text-transform: uppercase;"> ĐỔI MẬT KHẨU </p>
                                                <p> Đổi mật khẩu đăng nhập cho khách hàng có tài khoản:
                                                    <strong> {{ $customer->UserName }} </strong>
                                                </p>
                                                <a class="btn btn-light" onclick="toggleInputs(this)"
                                                    id="button-create-account"
                                                    style="border-radius: 6px; margin-bottom: 20px; border: 1px solid #3333;">
                                                    Đổi mật khẩu
                                                </a>

                                                <div class="row mb-3 d-none" id="create-account">
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Mật khẩu đăng nhập <label
                                                                class="text-danger">
                                                                (*)
                                                            </label></label>
                                                        <div class="input-group has-validation">

                                                            <input type="password" name="PassWord" class="form-control"
                                                                id="Pass" oninput="onInput(event)"
                                                                onkeypress="return isCharacterKey(event)"
                                                                onpaste="return false" placeholder="Tối thiểu 6 ký tự">
                                                            <span class="input-group-text"
                                                                onclick="event.stopPropagation();" id="show-hide-pass">
                                                                <i class="bi bi-eye-slash-fill" style=""></i></span>

                                                            <div class="invalid-feedback">Vui lòng nhập mật khẩu đăng nhập!
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Xác nhận mật khẩu <label
                                                                class="text-danger">
                                                                (*)
                                                            </label></label>
                                                        <div class="input-group has-validation">
                                                            <input type="password" name="Confirm" class="form-control"
                                                                id="PassConfirm" oninput="onInput(event)"
                                                                onkeypress="return isCharacterKey(event)"
                                                                onpaste="return false"
                                                                placeholder="Nhập lại chính xác mật khẩu">
                                                            <span class="input-group-text" id="show-hide-passs"
                                                                onclick="event.stopPropagation();">
                                                                <i class="bi bi-eye-slash-fill" style=""></i></span>
                                                            <div class="invalid-feedback">Mật khẩu không khớp !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
                                    <a class="btn btn-danger js-show-modal" {{-- onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" --}} class="confirm-dialog">
                                        <i class="fa-solid fa-trash"></i>
                                        Xóa
                                    </a>
                                    <button onclick="CheckValue()" autocomplete="off" type="submit"
                                        class="btn btn-primary" value="">
                                        <i class="fa-solid fa-floppy-disk" style="padding-right: 8px"></i>Lưu lại
                                    </button>
                                </div>
                                <!-- Xác nhận XÓA -->
                                <div class="d-flex wrap-modal1 js-modal">
                                    <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>

                                    <div class="d-flex container"
                                        style=" width: auto; max-width: 70%; align-items: center;">
                                        <div class="bg0 p-lr-15-lg how-pos3-parent"
                                            style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                            <div class="text-danger mb-3" style="text-align: left; font-size: 18px;">Bạn
                                                chắc chắn muốn xóa
                                                nhân viên <strong>
                                                    {{ $customer->LastName . ' ' . $customer->FirstName }}</strong> ?
                                            </div>
                                            <label for="" style=" margin-bottom: 28px;">Thao tác này sẽ không thể
                                                khôi phục
                                            </label>

                                            <div class="m-t-32">
                                                <div class="col-sm-12 d-flex"
                                                    style="padding: 0; justify-content: flex-end;">
                                                    <a class="btn btn-light js-hide-modal"
                                                        style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                                        <i class="bi bi-arrow-left-circle"></i>
                                                        Trở lại
                                                    </a>

                                                    <a href="/admin/customer/delete/{{ $customer->IdCustomer }}"
                                                        class="btn btn-danger delete-confirm"
                                                        style="border-radius: 50px; min-width: 100px; margin-left: 16px;">
                                                        Xác nhận xóa
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
            </form>
        </section>
        {{-- <form>
            <div class="form-group">
                <label for="province">Tỉnh/Thành phố:</label>
                <select class="form-select" id="province">
                    <option value="">--Chọn tỉnh/thành phố--</option>
                </select>
            </div>
            <div class="form-group">
                <label for="district">Quận/Huyện:</label>
                <select class="form-select" id="district" disabled>
                    <option value="">--Chọn quận/huyện--</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ward">Xã/Phường:</label>
                <select class="form-select" id="ward" disabled>
                    <option value="">--Chọn xã/phường--</option>
                </select>
            </div>
        </form> --}}
    </main>

    <script>
        function toggleInputs(btn) {
            const passwordFields = $("#create-account");
            var userNameValue = $('#UserName').val();

            passwordFields.toggleClass("d-none");
            if (btn.innerHTML === "Tạo tài khoản") {
                btn.innerHTML = "Hủy tạo tài khoản";
            } else if (btn.innerHTML === "Hủy tạo tài khoản") {
                $("#create-account input").val("");
                btn.innerHTML = "Tạo tài khoản";
            } else if (btn.innerHTML === "Đổi mật khẩu") {
                btn.innerHTML = "Hủy bỏ";
            } else if (btn.innerHTML === "Hủy bỏ") {
                $("#create-account input").val("");
                btn.innerHTML = "Đổi mật khẩu";
            }
        }

        function CheckValue() {
            var inputFullName = $("#FullName");
            var inputPhoneNumber = $("#PhoneNumber");
            var inputUserName = $("#UserName");
            var inputPass = $("#Pass");
            var inputPassConfirm = $("#PassConfirm");
            var isValid = true; // Biến flag mặc định là true
            var buttonText = $('#button-create-account').text();

            if (inputPass.val() !== inputPassConfirm.val()) {
                // Nếu không khớp, đặt thông báo lỗi và đặt border màu đỏ cho trường "Xác nhận mật khẩu"
                var invalidFeedback = inputPassConfirm.parent().find('.invalid-feedback');
                invalidFeedback.show();
                inputPassConfirm.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

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

        function isCharacterKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode == 32 || charCode == 9 || charCode == 13) {
                return false;
            }
            return true;
        }

        document.getElementById("show-hide-pass").addEventListener("click", function() {
            var passInput = document.getElementById("Pass");
            var Icont = document.getElementById("show-hide-pass");
            if (passInput.type === "password") {
                Icont.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
                passInput.type = "text";
            } else {
                Icont.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
                passInput.type = "password";
            }
        });

        document.getElementById("show-hide-passs").addEventListener("click", function() {
            var passConfirmInput = document.getElementById("PassConfirm");
            var Icont = document.getElementById("show-hide-passs");
            if (passConfirmInput.type === "password") {
                Icont.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
                passConfirmInput.type = "text";
            } else {
                Icont.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
                passConfirmInput.type = "password";
            }
        });

        $(document).ready(function() {
            // Lấy danh sách tỉnh/thành phố
            $.ajax({
                url: "/provinces",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#province').append('<option value="' + value['code'] + '">' + value[
                            'name'] + '</option>');
                    });
                }
            });

            // Khi chọn tỉnh/thành phố, lấy danh sách quận/huyện tương ứng
            $('#province').on('change', function() {
                var province_id = $(this).val();
                if (province_id) {
                    $('#district').attr('disabled', false);
                    $('#district').html('<option value="">--Chọn quận/huyện--</option>');
                    $.ajax({
                        url: "/districts/" + province_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#district').append('<option value="' + value[
                                        'code'] + '">' + value['name'] +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#district').attr('disabled', true);
                    $('#district').html('<option value="">--Chọn quận/huyện--</option>');
                }
            });

            // Khi chọn quận/huyện, lấy danh sách xã/phường tương ứng
            $('#district').on('change', function() {
                var district_id = $(this).val();
                $('#ward').empty().append('<option value="">--Chọn xã/phường--</option>').prop('disabled',
                    true);
                if (district_id) {
                    $.ajax({
                        url: '/wards/' + district_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#ward').append('<option value="' + value['code'] +
                                    '">' + value['name'] + '</option>');
                            });
                            $('#ward').prop('disabled', false);
                        }
                    });
                }
            });
        });
    </script>
@endsection
