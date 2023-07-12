@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-10" style="margin: 0 auto;">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb" style="justify-content: space-between;">
                                <h4 class="breadcrumb-item active">Danh sách loại bàn</h4>
                                <a style="color: #fff;" class="btn btn-primary js-show-modal">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Thêm loại bàn</span>
                                </a>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 600;" class="text"> Danh sách loại bàn
                                </h5>
                                <p class="text-sm">Quản lý các loại bàn</p>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body" style="padding: 50px ;">
                                    <div class="row m-b-30" style=" margin-bottom: 30px !important;">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="input-affix m-v-10">
                                                        <i class="prefix-icon anticon anticon-search opacity-04"></i>
                                                        <input id="keyword" autocomplete="off" name="keyword"
                                                            type="text" class="form-control"
                                                            placeholder="Tìm kiếm loại bàn">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <form method="post" action="/admin/tabletype/delete/all">
                                        @csrf
                                        <div class="table-responsive">

                                            @if ($listTableType->isEmpty())
                                                <div class="col-lg-5" style="margin: 0 auto;">
                                                    <img style="width: 100%;"
                                                        src="{{ asset('files/images/iconSystem/emp-customer.webp') }}"
                                                        alt="Trống">
                                                    <p class="text-center">Không có loại bàn nào</p>
                                                </div>
                                            @else
                                                <table
                                                    class="table table-hover e-commerce-table table-borderless datatable">
                                                    <thead>
                                                        <tr>
                                                            <th style="padding: 1rem 8px !important;" scope="col" data-sortable="false"><input
                                                                    style="height: 16px; width: 16px;" type="checkbox"
                                                                    id="select-all-checkbox"  onclick="toggleCheckboxes()">
                                                            </th>
                                                            <th scope="col">Tên loại
                                                                bàn
                                                            </th>
                                                            <th class="text-center" style="padding: 1rem !important;"
                                                                scope="col">Số ghế tối đa</th>
                                                            <th class="text-end" style="padding: 1rem !important;"
                                                                scope="col">Số lượng bàn hiện có</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="records_table"
                                                        style="vertical-align:-webkit-baseline-middle !important;">
                                                        @foreach ($listTableType as $item)
                                                            <tr
                                                                onclick="window.location.href = '{{ '/admin/tabletype/show/' . $item->IdType }}';">
                                                                <td><input style="height: 16px; width: 16px;"
                                                                        type="checkbox" name="ArrDel[]" id=""
                                                                        value="{{ $item->IdType }}"
                                                                        onclick="event.stopPropagation();"></td>
                                                                <td>
                                                                    {{ $item->TypeName }}</td>

                                                                <td class="text-center">
                                                                    {{ $item->MaxSeats }} ghế</td>

                                                                <td class="text-end">
                                                                    {{ $item->TotalTable }}
                                                                </td>

                                                            </tr>
                                                        @endforeach
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
                                            @endif

                                            {{-- Phân trang --}}
                                            {{-- <div class="pagination">
                                                {{ $listTableType->links('pagination::bootstrap-4') }}
                                            </div> --}}

                                        </div>
                                    </form>
                                    <!-- Form thêm loại bàn -->
                                    <form class="" action="/admin/tabletype/create" method="post"
                                        onsubmit="return CheckValuetabletype()">
                                        @csrf
                                        <div class="row wrap-modal1 js-modal">
                                            <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>

                                            <div class="d-flex container col-lg-5 col-xl-5"
                                                style="max-width: 95%; align-items: center;">
                                                <div class="bg0 p-lr-15-lg how-pos3-parent position-relative"
                                                    style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                                                    <div class="text-center mb-4 fs-4">Thêm loại bàn</div>
                                                    <div class="row">
                                                        <div class="col-lg-6 mb-3">
                                                            <label class="form-label">Tên loại bàn <label
                                                                    class="text-danger">
                                                                    (*)
                                                                </label></label>
                                                            <div class="input-group has-validation">
                                                                <input type="text" name="TypeName" class="form-control"
                                                                    id="TypeName" placeholder="VD: Bàn đơn"
                                                                    oninput="onInput(event)">
                                                                <div class="invalid-feedback">Vui lòng nhập tên loại bàn!
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-3">
                                                            <label class="form-label">Số ghế tối đa <label
                                                                    class="text-danger">
                                                                    (*)
                                                                </label></label>
                                                            <div class="input-group has-validation">
                                                                <select type="text" name="MaxSeats"
                                                                    class="form-select" id="MaxSeats">
                                                                    @for ($i = 1; $i < 16; $i++)
                                                                        <option value="{{ $i }}">
                                                                            {{ $i }} ghế </option>
                                                                    @endfor
                                                                </select>
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
        function CheckValuetabletype() {
            const TypeName = $("#TypeName");

            var isValid = true; // Biến flag mặc định là true

            // Kiểm tra giá trị của input TypeName
            if (TypeName.val().trim() === "") {
                var invalidFeedback = TypeName.parent().find('.invalid-feedback');
                invalidFeedback.show();
                TypeName.addClass("is-invalid");
                isValid = false; // Nếu giá trị rỗng, đặt biến flag thành false
            }

            return isValid; // Trả về biến flag
        }
    </script>
@endsection
