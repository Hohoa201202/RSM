@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left" style="margin-right: 8px;"></i><a href="{{ back()->getTargetUrl() }}">Quay lại trang trước</a></li>
                    <li class="breadcrumb-item active">Thông tin nhân viên: {{ $User->LastName . ' ' . $User->FirstName }}
                    </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <form method="post" action="/admin/user/{{ $User->UserName }}" enctype="multipart/form-data"
                onsubmit="return CheckValue()">

                @csrf
                @method('PUT')

                <input type="hidden" name="Avatar" value="{{ $User->Avatar }}">

                <div class="row">
                    <div class="col-xl-4 col-lg-3">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <div class="m-b-20" style="height: 10.25rem; width: 10.25rem;">
                                    <img id="img-account" src="{{ asset('files/images/user/' . $User->Avatar) }}"
                                        alt="Profile" class="rounded-circle"
                                        style="border: 5px solid #fff;box-shadow: 0 2px 10px #0123 ;border-radius: 50%; width: 100%;height: 100%; object-fit: cover;cursor: pointer;">
                                </div>

                                <div class="input-group mb-3" style="flex-direction: column; text-align: center;">
                                    <div>
                                        <label for="file_input" class="btn btn-light"
                                            style="border-radius: 6px; margin-top: 20px; border: 1px solid #3333;">Chọn
                                            ảnh</label>
                                        <input autocomplete="off" type="file" class="form-control" id="file_input"
                                            aria-describedby="button-addon2" name="_Avatar"
                                            onchange="document.getElementById('img-account').src = window.URL.createObjectURL(this.files[0])" />
                                    </div>
                                    <div class="m-t-12" style="color: #999; font-size: 14px">
                                        <p style="margin: 16px auto 4px;">Dung lượng file tối đa 1 MB</p>
                                        <p>Định dạng:.JPEG, .PNG</p>
                                        <p>Nên sử dụng hình ảnh có tỉ lệ  1:1</p>
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
                                            <div class="col-lg-6">
                                                <label class="form-label">Họ tên nhân viên <label class="text-danger"> (*)
                                                    </label></label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="FullName" class="form-control"
                                                        id="myInput"
                                                        value="{{ $User->LastName . ' ' . $User->FirstName }}"
                                                        placeholder="VD: Hồ Anh Hòa" oninput="onInput(event)">
                                                    <div class="invalid-feedback">Vui lòng nhập họ tên nhân viên!</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label">Tài khoản đăng nhập </label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="UserName" class="form-control"
                                                        placeholder="" oninput="onInput(event)" readonly
                                                        value="{{ $User->UserName }}"
                                                        style="background: #fafcff; color: #919eab; cursor: default;">
                                                    <div class="invalid-feedback">Vui lòng nhập tài khoản!</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <label class="form-label">Địa chỉ Email </label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="Email" class="form-control"
                                                        value="{{ $User->Email }}" placeholder="VD: Hohoa201202@gmail.com">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label">Số điện thoại </label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="PhoneNumber" class="form-control"
                                                        value="{{ $User->PhoneNumber }}" placeholder="VD: 0865787333">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="group" style="border-top: 1px solid #3333; padding-top: 24px;">
                                            <p> ĐỔI MẬT KHẨU </p>
                                            <p> Đổi mật khẩu đăng nhập cho tài khoản
                                                <strong>{{ $User->LastName . ' ' . $User->FirstName }} </strong>
                                            </p>
                                            <a class="btn btn-light" onclick="toggleInputs(this)"
                                                style="border-radius: 6px; margin-bottom: 20px; border: 1px solid #3333;">
                                                Đổi mật khẩu
                                            </a>

                                            <div class="row mb-3 d-none" id="password-fields">
                                                <div class="col-lg-6">
                                                    <label class="form-label">Mật khẩu đăng nhập <label
                                                            class="text-danger">
                                                            (*)
                                                        </label></label>
                                                    <div class="input-group has-validation">

                                                        <input type="password" name="PassWord" class="form-control"
                                                            id="Pass" oninput="onInput(event)"
                                                            onkeypress="return isCharacterKey(event)"
                                                            onpaste="return false" placeholder="Tối thiểu 6 ký tự">
                                                        <span class="input-group-text" onclick="event.stopPropagation();"
                                                            id="show-hide-pass">
                                                            <i class="bi bi-eye-slash-fill" style=""></i></span>

                                                        <div class="invalid-feedback">Vui lòng nhập mật khẩu đăng nhập!
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label class="form-label">Xác nhận mật khẩu<label class="text-danger">
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
                                                        <div class="invalid-feedback">Vui lòng xác nhận lại mật khẩu!</div>
                                                        <div class="invalid-feedback-passconfirm">Mật khẩu không khớp !
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <label class="form-label">----------------- </label>
                                                    <div class="input-group has-validation">

                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label class="form-label">Vai trò <label class="text-danger">
                                                            (*)
                                                        </label></label>
                                                    <div class="input-group has-validation">
                                                        <select name="IdGroup" id="IdGroup" class="form-select"
                                                            required aria-invalid="true">
                                                            @foreach ($listGroupUser as $item)
                                                                @if ($item->IdGroup === $User->IdGroup)
                                                                    <option selected value="{{ $item->IdGroup }}">
                                                                        {{ $item->GroupName }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $item->IdGroup }}">
                                                                        {{ $item->GroupName }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Vui lòng chọn vai trò!</div>
                                                    </div>
                                                </div>
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
                                    <a class="btn btn-danger js-show-modal" {{-- onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" --}} class="confirm-dialog">
                                        <i class="fa-solid fa-trash"></i>
                                        Xóa
                                    </a>
                                    <button onclick="CheckValue()" autocomplete="off" type="submit"
                                        class="btn btn-primary" value="">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        Lưu lại
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Xác nhận xóa người dùng -->
                <div class="d-flex wrap-modal1 js-modal">
                    <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>

                    <div class="d-flex container" style=" width: auto; max-width: 70%; align-items: center;">
                        <div class="bg0 p-lr-15-lg how-pos3-parent"
                            style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                            <div class="text-danger mb-3" style="text-align: left; font-size: 18px;">Bạn
                                chắc chắn muốn xóa
                                nhân viên <strong> {{ $User->LastName . ' ' . $User->FirstName }}</strong> ?</div>
                            <label for="" style=" margin-bottom: 28px;">Thao tác này sẽ không thể khôi phục
                            </label>

                            <div class="m-t-32">
                                <div class="col-sm-12 d-flex" style="padding: 0; justify-content: flex-end;">
                                    <a class="btn btn-light js-hide-modal"
                                        style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                        <i class="bi bi-arrow-left-circle"></i>
                                        Trở lại
                                    </a>

                                    <a href="/admin/user/delete/{{ $User->UserName }}"
                                        class="btn btn-danger delete-confirm"
                                        style="border-radius: 50px; min-width: 100px; margin-left: 16px;">
                                        Xác nhận xóa
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
        function toggleInputs(btn) {
            const passwordFields = document.getElementById("password-fields");
            passwordFields.classList.toggle("d-none");
            btn.classList.toggle("d-none");
        }

        function CheckValue() {
            const inputmyInput = $("#myInput");
            const inputUsername = $("#Username");
            const inputPass = $("#Pass");
            const inputPassConfirm = $("#PassConfirm");
            var isValid = true; // Biến flag mặc định là true

            // Kiểm tra giá trị của input myInput
            if (inputmyInput.val().trim() === "") {
                var invalidFeedback = inputmyInput.parent().find('.invalid-feedback');
                invalidFeedback.show();
                inputmyInput.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            if (inputPass.val() !== inputPassConfirm.val()) {
                // Nếu không khớp, đặt thông báo lỗi và đặt border màu đỏ cho trường "Xác nhận mật khẩu"
                var invalidFeedback = inputPassConfirm.parent().find('.invalid-feedback-passconfirm');
                invalidFeedback.show();
                inputPassConfirm.addClass("is-invalid");
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
    </script>
@endsection
