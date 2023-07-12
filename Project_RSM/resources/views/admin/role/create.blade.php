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
                                <li class="breadcrumb-item active">Thêm mới vai trò</li>
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
                                    <form method="post" action="/admin/role/create" enctype="multipart/form-data"
                                        onsubmit="return CheckValueRole()" name="myForm">

                                        @csrf

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
                                                                oninput="onInput(event)" autocomplete="off">
                                                            <div class="invalid-feedback">Vui lòng nhập tên vai trò !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12 mb-4 text-center"
                                                        style="background: rgb(244, 246, 248); padding: 16px 10px; border-radius: 3px; margin-left: 12px; width: 95%;">
                                                        <label class="toggle-switch" style="width: auto;">
                                                            Quản lý nhà hàng (Website, ứng dụng Quản lý)
                                                        </label>
                                                    </div>
                                                    @foreach ($listMenu as $item)
                                                        <div class="d-flex col-lg-6 mb-4">
                                                            <label class="toggle-switch">
                                                                <input type="checkbox" name="ArrMenu[]"
                                                                    value="{{ $item->IdMenuAdmin }}">
                                                                <span class="toggle-slider"></span>
                                                            </label>
                                                            <label for="inputText" class="col-sm-2"
                                                                style="width: auto; margin-left: 12px;">{{ $item->MenuName }}</label>
                                                        </div>
                                                    @endforeach

                                                    <div class="invalid-feedback invalid-feedback-role" style="margin: 0 0 20px;">Vui lòng chọn ít
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
                                            <a style="margin-left: -12px;" href="/admin/role/index" class="btn">
                                                <i class="fa-solid fa-angles-left"></i>
                                                Quay lại
                                            </a>
                                            <button onclick="CheckValueRole()" autocomplete="off" type="submit"
                                                class="btn btn-primary" value="">
                                                <i class="fa-solid fa-floppy-disk" style="padding-right: 8px"></i>Lưu lại
                                            </button>
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
