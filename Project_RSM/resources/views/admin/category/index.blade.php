@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-12" style="margin: 0 auto;">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb" style="justify-content: space-between;">
                                <h4 class="breadcrumb-item active">Danh sách danh mục</h4>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 600;" class="text"> Danh sách danh mục
                                </h5>
                                <p class="text-sm">Quản lý các danh mục mặt hàng</p>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body p-5">
                                    <a style="color: #fff;" class="btn btn-primary js-show-modal mb-3">
                                        <i class="bi bi-plus-circle"></i>
                                        <span>Thêm danh mục</span>
                                    </a>
                                    <form method="post" action="/admin/category/delete/all">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="table table-hover e-commerce-table table-borderless datatable">
                                                <thead>
                                                    <tr>
                                                        <th style="padding: 1rem 8px !important;" scope="col" data-sortable="false"><input
                                                                style="height: 16px; width: 16px;" type="checkbox"
                                                                id="select-all-checkbox"  onclick="toggleCheckboxes()"></th>
                                                        <th scope="col">STT</th>
                                                        <th scope="col">Tên danh mục
                                                        </th>
                                                        <th class="text-center" style="padding: 1rem !important;"
                                                            scope="col">Số lượng mặt hàng</th>
                                                            <th data-sortable="false"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="records_table"
                                                    style="vertical-align:-webkit-baseline-middle !important;">

                                                    @if ($listCategories->isEmpty())
                                                        <div class="col-lg-5" style="margin: 0 auto;">
                                                            <img style="width: 100%;"
                                                                src="{{ asset('files/images/iconSystem/emp-customer.webp') }}"
                                                                alt="Trống">
                                                            <p class="text-center">Không có danh mục nào</p>
                                                        </div>
                                                    @else
                                                        @foreach ($listCategories as $item)
                                                            <tr
                                                                onclick="window.location.href = '{{ '/admin/category/show/' . $item->IdCategory . '-' . Str::slug($item->CategoryName, '-') . '.html' }}';">
                                                                <td><input style="height: 16px; width: 16px;"
                                                                        type="checkbox" name="ArrDel[]" id=""
                                                                        value="{{ $item->IdCategory }}"
                                                                        onclick="event.stopPropagation();"></td>

                                                                <td>
                                                                    {{ $loop->iteration }}</td>

                                                                <td>
                                                                    {{ $item->CategoryName }}</td>

                                                                <td class="text-center">
                                                                    {{ $item->TotalItems }}
                                                                </td>

                                                                <td class="text-end">
                                                                    <a class="btn btn-success"
                                                                        href="{{ '/admin/category/show/' . $item->IdCategory . '-' . Str::slug($item->CategoryName, '-') . '.html' }}">
                                                                        <i class="bi bi-eye"></i>
                                                                        View
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <div class="alert alert-danger alert-dismissible fade show d-none"
                                                role="alert" id="alert-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                Vui lòng chọn ít nhất một mục!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                            <button class="btn btn-danger " id="delete-button" type="submit">
                                                Xóa mục đã chọn
                                            </button>
                                            {{-- Phân trang --}}
                                            <div class="pagination">
                                                {{ $listCategories->links('pagination::bootstrap-4') }}
                                            </div>

                                        </div>
                                    </form>
                                    <!-- Form thêm danh mục mặt hàng -->
                                    <form class="" action="/admin/category/create" method="post"
                                        onsubmit="return CheckValueCategory()">
                                        @csrf
                                        <div class="row wrap-modal1 js-modal">
                                            <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>

                                            <div class="d-flex container col-lg-5 col-xl-5"
                                                style="max-width: 95%; align-items: center;">
                                                <div class="bg0 p-lr-15-lg how-pos3-parent position-relative"
                                                    style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                                    <div class="text-center mb-5 fs-4">Thêm danh mục mặt hàng</div>
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-3">
                                                            <label class="form-label">Tên danh mục <label
                                                                    class="text-danger">
                                                                    (*)
                                                                </label></label>
                                                            <div class="input-group has-validation">
                                                                <input type="text" name="CategoryName"
                                                                    class="form-control" id="CategoryName"
                                                                    placeholder="VD: Đồ ăn" oninput="onInput(event)">
                                                                <div class="invalid-feedback">Vui lòng nhập tên danh mục!
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 mb-3">
                                                            <label class="form-label">Mô tả thêm </label>
                                                            <div class="input-group has-validation">
                                                                <textarea type="text" name="Description" class="form-control" placeholder="Tối đa 255 ký tự" rows="5"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a class="btn btn-light btn-round js-hide-modal position-absolute">
                                                        <i class="bi bi-x-lg"></i>
                                                    </a>

                                                    <div class="mt-3">
                                                        <div class="col-sm-12 d-flex"
                                                            style="padding: 0; justify-content: flex-end;">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>
    <!--End main-->

    <script>
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
    </script>
@endsection
