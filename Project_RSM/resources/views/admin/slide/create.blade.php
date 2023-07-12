@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <form method="post" action="/admin/slide/create" enctype="multipart/form-data" onsubmit="return CheckValueslide()"
                id="form-create-slide">
                @csrf
                <div class="row">
                    <div class="col-lg-10 col-xl-9 mx-auto">
                        <div class="pagetitle">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left"
                                            style="margin-right: 8px;"></i><a href="{{ back()->getTargetUrl() }}">Quay lại
                                            trang
                                            trước</a></li>
                                    <li class="breadcrumb-item active">Thêm mới slide</li>
                                </ol>
                            </nav>
                        </div><!-- End Page Title -->
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content pt-2" id="borderedTabJustifiedContent" style="margin-bottom: 28px;">
                                    <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="row mb-3">
                                            <div class="col-lg-12 mb-3 d-flex flex-column align-items-center">
                                                <div class="m-b-20" style="height: 22.5rem; width: 40rem;">
                                                    <img id="img-account"
                                                        src="{{ asset('files/images/slide/default.png') }}"
                                                        alt="Ảnh slide"
                                                        style="border: 5px solid #fff;box-shadow: 0 2px 10px #0123 ;width: 100%;height: 100%; object-fit: cover;cursor: pointer;">
                                                </div>

                                                <div class="input-group mb-3"
                                                    style="flex-direction: column; text-align: center;">
                                                    <div>
                                                        <label for="file_input" class="btn btn-light"
                                                            style="border-radius: 6px; margin-top: 20px; border: 1px solid #3333;">Tải ảnh slide</label>
                                                        <input autocomplete="off" type="file" class="form-control"
                                                            id="file_input" aria-describedby="button-addon2" name="ImageName"
                                                            onchange="document.getElementById('img-account').src = window.URL.createObjectURL(this.files[0])" />
                                                    </div>
                                                    {{-- <div class="m-t-12" style="color: #999; font-size: 14px">
                                                        <p style="margin: 16px auto 4px;">Dung lượng file tối đa 1 MB</p>
                                                        <p>Định dạng:.JPEG, .PNG</p>
                                                        <p>Nên sử dụng hình ảnh có tỉ lệ 1:1</p>
                                                    </div> --}}
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Tiêu đề chính</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="Title" class="form-control"
                                                        placeholder="Tiêu đề chính" value="{{ old('Title') }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Tiêu đề phụ</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="SubTitle" class="form-control"
                                                        placeholder="Tiêu đề phụ" value="{{ old('SubTitle') }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Vị trí</label>
                                                <div class="input-group has-validation">
                                                    <select class="form-select" name="Position">
                                                        <option value="1">1 - Phía sau form đặt bàn</option>
                                                        <option value="2">2 - Tại vùng show khuyến mãi</option>
                                                        <option value="3">3 - Tại vùng show combo nổi bật</option>
                                                    </select>
                                                </div>
                                                <label class="text-note form-text">Vị trí slide xuất hiện</label>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Thứ tự sắp xếp</label>
                                                <div class="input-group has-validation">
                                                    <input type="number" name="Order" id="Order" class="form-control"
                                                        placeholder="VD: 1" value="{{ old('Order') }}" pattern="[0-9]*">
                                                    <div class="invalid-feedback">Thứ tự sắp xếp phải là số nguyên > 0!
                                                    </div>
                                                </div>
                                                <label class="text-note form-text">Nhập số nguyên lớn hơn 0</label>
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
                                        <a style="margin-left: -12px;" href="{{ back()->getTargetUrl() }}"
                                            class="btn">
                                            <i class="fa-solid fa-angles-left"></i>
                                            Quay lại
                                        </a>
                                        <button autocomplete="off" type="submit" class="btn btn-primary">
                                            <i class="fa-solid fa-floppy-disk" style="padding-right: 8px"></i>Lưu lại
                                        </button>
                                    </div>
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
        function handleslideCha(selectElement) {
            const slideChaSelect = document.getElementById("slideCha");
            const options = slideChaSelect.options;
            const firstOption = options[0];

            if (selectElement.value === "1") {
                slideChaSelect.disabled = true;
                firstOption.classList.remove("d-none");
                slideChaSelect.selectedIndex = 0; // Chọn giá trị đầu tiên
            } else {

                if (options.length > 1) {
                    slideChaSelect.disabled = false;
                    slideChaSelect.selectedIndex = 1; // Chọn giá trị thứ 2

                    if (!firstOption.classList.contains("d-none")) {
                        firstOption.classList.add("d-none");
                    }
                }
            }
        }

        function CheckValueslide() {
            const orderInput = $('#Order');
            var isValid = true; // Biến flag mặc định là true

            if (orderInput.val().trim() != "") {
                if (orderInput.val().trim() <= 0) {
                    var invalidFeedback = orderInput.parent().find('.invalid-feedback');
                    invalidFeedback.show();
                    orderInput.addClass("is-invalid");
                    isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
                }
            }

            return isValid; // Trả về biến flag
        }
    </script>
@endsection

<!-- Apply Select2 to the select element -->
