@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb" style="justify-content: space-between;">
                                <h4 class="breadcrumb-item active">Danh sách mặt hàng</h4>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body" style="padding: 50px ;">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <a style="color: #fff;" class="btn btn-primary" href="/admin/items/create">
                                                <i class="bi bi-plus-circle"></i>
                                                <span>Thêm mặt hàng</span>
                                            </a>
                                        </div>
                                        <div class="col-md-6" style="text-align: right !important;">
                                            <form method="post" enctype="multipart/form-data" action="">
                                                <input style="max-width: 100px" type="file" name="import_file">
                                                <a class="btn btn-success" href="/admin/user/create">
                                                    <i class="bi bi-cloud-arrow-up"></i>
                                                    <span>Import</span>
                                                </a>
                                                <a class="btn btn-success" href="/admin/user/create">
                                                    <i class="bi bi-cloud-download"></i>
                                                    <span>Export</span>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                    <form method="post" action="/admin/items/delete/all">
                                        @csrf
                                        <div class="table-responsive">

                                            @if ($listItems->isEmpty())
                                                <div class="col-lg-5" style="margin: 0 auto;">
                                                    <img style="width: 100%;"
                                                        src="{{ asset('files/images/iconSystem/emp-customer.webp') }}"
                                                        alt="Khách hàng trống">
                                                    <p class="text-center">Không có mặt hàng nào </p>
                                                    </p>
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
                                                            <th scope="col">
                                                                Mặt hàng</th>
                                                            <th class="text-center" style="padding: 1rem !important;"
                                                                scope="col">Danh mục
                                                            </th>
                                                            <th class="text-center" style="padding: 1rem !important;"
                                                                scope="col">Giá thành
                                                            </th>
                                                            <th class="text-center" style="padding: 1rem !important;"
                                                                scope="col">Đơn vị tính
                                                            </th>
                                                            <th scope="col">Ghi chú
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="records_table"
                                                        style="vertical-align:-webkit-baseline-middle !important;">

                                                        @foreach ($listItems as $item)
                                                            <tr
                                                                onclick="window.location.href = '{{ '/admin/items/show/' . $item->IdItems . '-' . Str::slug($item->ItemsName, '-') . '.html' }}';">
                                                                <td><input style="height: 16px; width: 16px;"
                                                                        type="checkbox" name="ArrDel[]" id=""
                                                                        value="{{ $item->IdItems }}"
                                                                        onclick="event.stopPropagation();"></td>
                                                                <td class=" d-flex align-items-center"
                                                                    style="padding: 1rem; vertical-align:-webkit-baseline-middle !important;">
                                                                    <div class="m-b-20 me-3"
                                                                        style="height: 3rem; width: 3rem;">
                                                                        <img id="img-account"
                                                                            src="{{ asset('files/images/items/' . $item->Avatar) }}"
                                                                            alt="Profile" class="rounded-circle-items"
                                                                            style="">
                                                                    </div>
                                                                    {{ $item->ItemsName }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $item->CategoryName }}
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($listPrice->where('IdItems', $item->IdItems)->count() > 1)
                                                                        {{ $listPrice->where('IdItems', $item->IdItems)->count() }}
                                                                        giá
                                                                    @elseif ($listPrice->where('IdItems', $item->IdItems)->count() == 1)
                                                                        {{ number_format($listPrice->where('IdItems', $item->IdItems)->first()->SalePrice, 0, ',') }}
                                                                        ₫
                                                                    @else
                                                                        0 ₫
                                                                    @endif
                                                                </td>

                                                                <td class="text-center">
                                                                    @if ($item->UnitActive)
                                                                        {{ $item->UnitName }}
                                                                    @else
                                                                        -----
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    {{ $item->Description }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                            <div class="alert alert-danger alert-dismissible fade show d-none"
                                                role="alert" id="alert-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                Vui lòng chọn ít nhất một mục!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
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
                                            {{-- <div class="pagination">
                                                {{ $listItems->links('pagination::bootstrap-4') }}
                                            </div> --}}

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
        const checkboxes = document.querySelectorAll("#table-checkbox-delete input[type=checkbox]");
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
