@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-10 col-xl-9 mx-auto">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left" style="margin-right: 8px;"></i><a
                                        href="{{ back()->getTargetUrl() }}">Quay lại
                                        trang
                                        trước</a></li>
                                <li class="breadcrumb-item active">Thông tin menu: {{ $menu->MenuName }}</li>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="/admin/menu/{{ $menu->IdMenu }}" enctype="multipart/form-data"
                                onsubmit="return CheckValueMenu()" id="form-create-menu">
                                @csrf
                                @method('PUT')
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
                                                        value="{{ $menu->MenuName }}">
                                                    <div class="invalid-feedback">Vui lòng nhập tên menu!</div>
                                                </div>
                                                <label class="text-note form-text">Tên hiển thị trên Website</label>
                                            </div>

                                            <div class="col-lg-6 mb-3" id="form-lever">
                                                <label class="form-label">Cấp menu</label>
                                                <div class="input-group has-validation">
                                                    <select class="form-select" name="Lever" id="Lever"
                                                        onchange="handleParentId(this)">
                                                        @for ($i = 1; $i <= 3; $i++)
                                                            <option @if ($i === $menu->Lever) selected @endif
                                                                value="{{ $i }}">Cấp {{ $i }}</option>
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
                                                        <select class="form-select" name="ParentId" id="ParentId" disabled>
                                                            <option value="-1">--Danh sách trống--</option>
                                                        </select>
                                                    @else
                                                        <select class="form-select" name="ParentId" id="ParentId" disabled>
                                                            <option value="-1">--Danh sách menu--</option>
                                                            @foreach ($listMenus as $item)
                                                                @if ($item->IdMenu === $menu->IdMenu)
                                                                    @continue
                                                                @endif
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
                                                    <select class="form-select" name="Position" id="Position">
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
                                                        placeholder="VD: 1" value="{{ $menu->Order }}" pattern="[0-9]*">
                                                    <div class="invalid-feedback">Thứ tự sắp xếp phải là số nguyên > 0!
                                                    </div>
                                                </div>
                                                <label class="text-note form-text">Nhập số nguyên lớn hơn 0</label>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Tên Controller</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="ControllerName" class="form-control"
                                                        placeholder="ControllerName" value="{{ $menu->ControllerName }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Tên Action</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="ActionName" class="form-control"
                                                        placeholder="ActionName" value="{{ $menu->ActionName }}">
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
                                            class="btn btn-danger js-show-modal">
                                            <i class="bi bi-trash3-fill"></i>
                                            Xóa
                                        </a>
                                        <button onclick="CheckValueItems()" autocomplete="off" type="submit"
                                            class="btn btn-primary" value="">
                                            <i class="fa-solid fa-floppy-disk" style="padding-right: 8px"></i>Lưu lại
                                        </button>
                                    </div>
                                    <!-- Xác nhận xóa -->
                                    <div class="d-flex wrap-modal1 js-modal">
                                        <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>

                                        <div class="d-flex container"
                                            style=" width: auto; max-width: 70%; align-items: center;">
                                            <div class="bg0 p-lr-15-lg how-pos3-parent"
                                                style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                                <div class="text-danger mb-3" style="text-align: left; font-size: 18px;">
                                                    Bạn
                                                    chắc chắn muốn xóa danh mục <strong>
                                                        {{ $menu->MenuName }}</strong> ?</div>
                                                <label for="" style=" margin-bottom: 28px;">Thao tác này sẽ không
                                                    thể khôi phục
                                                </label>

                                                <div class="m-t-32">
                                                    <div class="col-sm-12 d-flex"
                                                        style="padding: 0; justify-content: flex-end;">
                                                        <a class="btn btn-light js-hide-modal"
                                                            style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                                            <i class="bi bi-arrow-left-circle"></i>
                                                            Trở lại
                                                        </a>

                                                        <a href="/admin/menu/delete/{{ $menu->IdMenu }}"
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
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--End main-->

    <script>
        // window.addEventListener("load", function(e) {
        const LeverSelect = document.getElementById("Lever");
        const ParentIdSelect = document.getElementById("ParentId");
        const PositionSelect = document.getElementById("Position");
        const firstOption = ParentIdSelect.options[0]; //Option đầu tiên trong list menu
        const IdMenu = {{ $menu->ParentId }}; //Giá trị IdMenu cha
        const Position = {{ $menu->Position }}; //Giá trị Position

        for (let i = 0; i < PositionSelect.options.length; i++) {
            if (PositionSelect.options[i].value === Position.toString()) {
                PositionSelect.selectedIndex = i;
                break;
            }
        }

        if (LeverSelect.selectedIndex != 0) {
            ParentIdSelect.disabled = false;
            if (!firstOption.classList.contains("d-none")) {
                firstOption.classList.add("d-none");
            }
            for (let i = 0; i < ParentIdSelect.options.length; i++) {
                if (ParentIdSelect.options[i].value === IdMenu.toString()) {
                    ParentIdSelect.selectedIndex = i;
                    break;
                }
            }
        }
        // });

        function handleParentId(selectElement) {
            const ParentIdSelect = document.getElementById("ParentId");

            const options = ParentIdSelect.options;
            const firstOption = options[0];

            if (selectElement.value === "1") {
                ParentIdSelect.disabled = true;
                firstOption.classList.remove("d-none");
                ParentIdSelect.selectedIndex = 0; // Chọn giá trị đầu tiên
            } else {
                if (options.length > 1) {
                    ParentIdSelect.disabled = false;
                    ParentIdSelect.selectedIndex = 1; // Chọn giá trị thứ 2

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
