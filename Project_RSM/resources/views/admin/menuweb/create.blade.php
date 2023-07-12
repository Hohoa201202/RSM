@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <form method="post" action="/admin/menu/create" enctype="multipart/form-data" onsubmit="return CheckValueMenu()"
                id="form-create-menu">
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
                                    <li class="breadcrumb-item active">Thêm mới menu</li>
                                </ol>
                            </nav>
                        </div><!-- End Page Title -->
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content pt-2" id="borderedTabJustifiedContent" style="margin-bottom: 28px;">
                                    <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                        aria-labelledby="home-tab">

                                        <div class="row mb-3">
                                            <div class="col-lg-12 mb-3">
                                                <label class="form-label">Tên menu <label class="text-danger"> (*)
                                                    </label></label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="MenuName" class="form-control"
                                                        id="MenuName" placeholder="VD: Trang chủ" oninput="onInput(event)"
                                                        value="{{ old('MenuName') }}">
                                                    <div class="invalid-feedback">Vui lòng nhập tên menu!</div>
                                                </div>
                                                <label class="text-note form-text">Tên hiển thị trên Website</label>
                                            </div>

                                            <div class="col-lg-6 mb-3" id="form-lever">
                                                <label class="form-label">Cấp menu</label>
                                                <div class="input-group has-validation">
                                                    <select class="form-select" name="Lever"
                                                        onchange="handleMenuCha(this)">
                                                        @for ($i = 1; $i <= 3; $i++)
                                                            <option value="{{ $i }}">Cấp {{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <label class="text-note form-text">Mặc định cấp 1 - Tối đa cấp 3</label>
                                            </div>

                                            <div class="col-lg-6 mb-3" id="form-parent">
                                                <label class="form-label">Menu cha</label>
                                                <div class="input-group has-validation">
                                                    @php
                                                        // dd($listMenus->isEmpty())
                                                    @endphp
                                                    @if ($listMenus->isEmpty())
                                                        <select class="form-select" name="ParentId" id="menuCha" disabled>
                                                            <option value="-1">--Danh sách trống--</option>
                                                        </select>
                                                    @else
                                                        <select class="form-select" name="ParentId" id="menuCha" disabled>
                                                            <option value="-1">--Danh sách menu--</option>
                                                            @foreach ($listMenus as $item)
                                                                <option value="{{ $item->IdMenu }}">{{ $item->MenuName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>
                                                <label class="text-note form-text">Menu cấp 1 mặc định không có Menu
                                                    cha</label>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Vị trí</label>
                                                <div class="input-group has-validation">
                                                    <select class="form-select" name="Position">
                                                        <option value="1">1 - Header của website</option>
                                                        <option value="2">2 - Footer của website</option>
                                                        <option value="3">3 - ...................</option>
                                                    </select>
                                                </div>
                                                <label class="text-note form-text">Vị trí menu xuất hiện</label>
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

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Tên Controller</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="ControllerName" class="form-control"
                                                        placeholder="ControllerName" value="{{ old('ControllerName') }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Tên Action</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="ActionName" class="form-control"
                                                        placeholder="ActionName" value="{{ old('ActionName') }}">
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
        function handleMenuCha(selectElement) {
            const menuChaSelect = document.getElementById("menuCha");
            const options = menuChaSelect.options;
            const firstOption = options[0];

            if (selectElement.value === "1") {
                menuChaSelect.disabled = true;
                firstOption.classList.remove("d-none");
                menuChaSelect.selectedIndex = 0; // Chọn giá trị đầu tiên
            } else {

                if (options.length > 1) {
                    menuChaSelect.disabled = false;
                    menuChaSelect.selectedIndex = 1; // Chọn giá trị thứ 2

                    if (!firstOption.classList.contains("d-none")) {
                        firstOption.classList.add("d-none");
                    }
                }
            }
        }

        function CheckValueMenu() {
            const MenuName = $("#MenuName");

            var isValid = true; // Biến flag mặc định là true

            // Kiểm tra giá trị của input MenuName
            if (MenuName.val().trim() === "") {
                var invalidFeedback = MenuName.parent().find('.invalid-feedback');
                invalidFeedback.show();
                MenuName.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            const orderInput = $('#Order');
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
