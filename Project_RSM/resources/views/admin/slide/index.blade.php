@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12" style="margin: 0 auto;">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb" style="justify-content: space-between;">
                                <h4 class="breadcrumb-item active">Danh sách slide</h4>
                                <a style="color: #fff;" class="btn btn-primary" href="/admin/slide/create">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Thêm slide</span>
                                </a>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 600;" class="text"> Danh sách slide
                                </h5>
                                <p class="text-sm">Vị trí tương ứng</p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>1:</strong> Slide phía sau form đặt bàn</li>
                                    <li class="list-group-item"><strong>2:</strong> Slide tại vùng show khuyến mãi</li>
                                    <li class="list-group-item"><strong>3:</strong> Slide tại vùng show combo nổi bật</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body" style="padding: 50px ;">
                                    <div class="row m-b-30">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="input-affix m-v-10">
                                                        <i class="prefix-icon anticon anticon-search opacity-04"></i>
                                                        <input id="keyword" autocomplete="off" name="keyword"
                                                            type="text" class="form-control"
                                                            placeholder="Tìm kiếm mặt hàng">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <select class="form-select" data-val="true" name="MaDanhMuc">
                                                        <option value="Hello">Hello</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="post" action="/admin/slide/delete/all">
                                        @csrf
                                        <div class="table-responsive">
                                            @if ($listSlides->isEmpty())
                                                <div class="col-lg-5" style="margin: 0 auto;">
                                                    <img style="width: 100%;"
                                                        src="{{ asset('files/images/iconSystem/emp-customer.webp') }}"
                                                        alt="slide trống">
                                                    <p class="text-center">Không có slide nào</p>
                                                </div>
                                            @else
                                                <table class="table table-hover e-commerce-table table-borderless datatable"
                                                    id="table-checkbox-delete">
                                                    <thead>
                                                        <tr>
                                                            <th style="padding: 1rem 8px !important;" scope="col" data-sortable="false"><input
                                                                    style="height: 16px; width: 16px;" type="checkbox"
                                                                    id="select-all-checkbox"  onclick="toggleCheckboxes()">
                                                            </th>
                                                            <th style="padding: 1rem !important; width: 10%;"
                                                                scope="col">STT</th>
                                                            <th scope="col">Hình ảnh
                                                            <th scope="col" class="text-center">Vị trí</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="records_table" class="table-checkbox"
                                                        style="vertical-align:-webkit-baseline-middle !important;">
                                                        @foreach ($listSlides as $item)
                                                            <tr
                                                                onclick="window.location.href = '{{ '/admin/slide/show/' . $item->IdSlide }}';">
                                                                <td><input style="height: 16px; width: 16px;"
                                                                        type="checkbox" name="ArrDel[]" id=""
                                                                        value="{{ $item->IdSlide }}"
                                                                        onclick="event.stopPropagation();"></td>

                                                                <td>
                                                                    {{ $loop->iteration }}</td>

                                                                <td class="pe-0"
                                                                    style="padding: 1rem; vertical-align:-webkit-baseline-middle !important;">
                                                                    <div class="m-b-20" style="height: 6rem; width: 10rem;">
                                                                        <img id="img-account"
                                                                            src="{{ asset('files/images/slide/' . $item->ImageName) }}"
                                                                            alt="Profile" class="rounded-circle-items"
                                                                            style="">
                                                                    </div>
                                                                </td>

                                                                <td class="text-center">
                                                                    @if (empty($item->Position))
                                                                        Chưa đặt vị trí
                                                                    @else
                                                                        {{ $item->Position }}
                                                                    @endif
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
                                            <div class="pagination">
                                                {{ $listSlides->links('pagination::bootstrap-4') }}
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
        let checkboxes = document.querySelectorAll("#table-checkbox-delete input[type=checkbox]");
        const selectAllCheckbox = document.getElementById('select-all-checkbox');

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('click', (event) => {
                toggleDeleteButton();
                if (event.target.checked === false) {
                    selectAllCheckbox.checked = false;
                }
            });
        });

        function toggleDeleteButton() {
            const deleteButton = document.getElementById("delete-button");
            const checkboxes = document.querySelectorAll("input[name='ArrDel[]']");

            let isAnyCheckboxChecked = false;
            let allChecked = true;

            for (let i = 0; i < checkboxes.length; i++) {
                if (!checkboxes[i].checked) {
                    allChecked = false;
                } else {
                    isAnyCheckboxChecked = true;
                }
            }

            if (allChecked) {
                selectAllCheckbox.checked = true;
            }
            if (isAnyCheckboxChecked) {
                deleteButton.classList.remove('d-none');
            } else {
                deleteButton.classList.add('d-none');
            }
        }
    </script>
@endsection
