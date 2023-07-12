@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-1 col-md-1">
                </div>
                <div class="col-lg-10 col-md-10">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left"
                                        style="margin-right: 8px;"></i><a href="{{ back()->getTargetUrl() }}">Quay lại trang trước</a></li>
                                <li class="breadcrumb-item active">Vai trò: {{ $GroupUser->GroupName }}</li>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-xl-4 col-lg-3">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 600;" class="text"> Vai trò nhân viên
                                </h5>
                                <p class="text-sm">Quyền hạn vai trò của nhân viên khi đăng nhập
                                    quản trị web hoặc ứng dụng bán hàng</p>
                            </div>
                        </div>
                        <div class="col-lg-9 col-xl-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="post" action="/admin/role/{{ $GroupUser->IdGroup }}"
                                        enctype="multipart/form-data" onsubmit="return CheckValueRole()" name="myForm">

                                        @csrf
                                        @method('PUT')

                                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                            <div class="tab-pane fade show active" id="bordered-justified-home"
                                                role="tabpanel" aria-labelledby="home-tab">

                                                <div class="row mb-4">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Tên vai trò <label class="text-danger">
                                                                (*)
                                                            </label></label>
                                                        <div class="input-group has-validation">
                                                            <input type="text" name="GroupName" class="form-control"
                                                                id="RoleName" placeholder="Nhập tên vai trò"
                                                                oninput="onInput(event)" autocomplete="off"
                                                                value="{{ $GroupUser->GroupName }}">
                                                            <div class="invalid-feedback">Vui lòng nhập tên vai trò !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    @foreach ($listMenu as $menu)
                                                        @php
                                                            $checked = false;
                                                            foreach ($listRole as $role) {
                                                                if ($menu->IdMenuAdmin === $role->IdMenuAdmin) {
                                                                    $checked = true;
                                                                    break;
                                                                }
                                                            }
                                                        @endphp

                                                        <div class="d-flex col-lg-6 mb-4">
                                                            <label class="toggle-switch">
                                                                <input type="checkbox" {{ $checked ? 'checked' : '' }}
                                                                    name="ArrMenu[]" value="{{ $menu->IdMenuAdmin }}">
                                                                <span class="toggle-slider"></span>
                                                            </label>
                                                            <label for="inputText" class="col-sm-2"
                                                                style="width: auto; margin-left: 12px;">{{ $menu->MenuName }}</label>
                                                        </div>
                                                    @endforeach

                                                    <div class="invalid-feedback invalid-feedback-role"
                                                        style="margin: 0 0 20px;">Vui lòng chọn ít
                                                        nhất một quyền trong các quyền trên! </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Mô tả thêm </label>
                                                        <div class="input-group has-validation">
                                                            <textarea type="text" name="Description" class="form-control" placeholder="Tối đa 255 ký tự" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Bordered Tabs Justified -->
                                        <div class="col-12">
                                            @foreach ($errors->all() as $error)
                                                <p class="text-danger text-center"
                                                    style="font-style:italic; letter-spacing: 1px;">
                                                    {{ $error }}</p>
                                            @endforeach
                                        </div>
                                        <div class="group"
                                            style="display: flex; justify-content: space-between; border-top: 1px solid #3333; padding-top: 24px;">
                                            <a class="btn btn-danger js-show-modal" class="confirm-dialog">
                                                <i class="fa-solid fa-trash"></i>
                                                Xóa
                                            </a>
                                            <button onclick="CheckValueRole()" autocomplete="off" type="submit"
                                                class="btn btn-primary" value=""> Lưu lại
                                            </button>
                                        </div>
                                        <!-- Xác nhận xóa -->
                                        <div class="d-flex wrap-modal1 js-modal">
                                            <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>

                                            <div class="d-flex container"
                                                style=" width: auto; max-width: 70%; align-items: center;">
                                                <div class="bg0 p-lr-15-lg how-pos3-parent"
                                                    style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                                    <div class="text-danger mb-3"
                                                        style="text-align: left; font-size: 18px;">Bạn
                                                        chắc chắn muốn xóa
                                                        vai trò <strong> {{ $GroupUser->GroupName}}</strong>
                                                        ?</div>
                                                    <label for="" style=" margin-bottom: 28px;">Thao tác này sẽ
                                                        không thể khôi phục
                                                    </label>

                                                    <div class="m-t-32">
                                                        <div class="col-sm-12 d-flex"
                                                            style="padding: 0; justify-content: flex-end;">
                                                            <a class="btn btn-light js-hide-modal"
                                                                style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                                                <i class="bi bi-arrow-left-circle"></i>
                                                                Trở lại
                                                            </a>

                                                            <a href="/admin/role/delete/{{ $GroupUser->IdGroup }}"
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1">
                </div>

            </div>
            </form>
        </section>
    </main>
    <!--End main-->
    <script>
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', function() {
                var checked = false;
                for (var j = 0; j < checkboxes.length; j++) {
                    if (checkboxes[j].checked) {
                        checked = true;
                        break;
                    }
                }
                var invalidFeedback = document.querySelector('.invalid-feedback-role');
                if (checked) {
                    invalidFeedback.classList.add('d-none');
                } else {
                    invalidFeedback.classList.remove('d-none');
                }
            });
        }
    </script>
@endsection
