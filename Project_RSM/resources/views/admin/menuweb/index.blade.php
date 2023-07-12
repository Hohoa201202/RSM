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
                                <h4 class="breadcrumb-item active">Danh sách menu</h4>
                                <a style="color: #fff;" class="btn btn-primary" href="/admin/menu/create">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Thêm menu</span>
                                </a>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 600;" class="text"> Danh sách menu
                                </h5>
                                <p class="text-sm">Quản lý các menu, thêm menu bên phía website khách hàng sử dụng</p>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body" style="padding: 50px ;">
                                    <div class="row m-b-30">
                                    </div>
                                    <form method="post" action="/admin/menu/delete/all">
                                        @csrf
                                        <div class="table-responsive">


                                            @if ($listMenus->isEmpty())
                                                <div class="col-lg-5" style="margin: 0 auto;">
                                                    <img style="width: 100%;"
                                                        src="{{ asset('files/images/iconSystem/emp-customer.webp') }}"
                                                        alt="menu trống">
                                                    <p class="text-center">Không có menu nào</p>
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
                                                            <th scope="col" class="text-center">STT</th>
                                                            <th scope="col">Tên menu
                                                            <th scope="col" class="text-center">Cấp
                                                            </th>
                                                            <th scope="col" class="text-center">Vị trí</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="records_table" class="table-checkbox"
                                                        style="vertical-align:-webkit-baseline-middle !important;">
                                                        @foreach ($listMenus as $item)
                                                            <tr
                                                                onclick="window.location.href = '{{ '/admin/menu/show/' . $item->IdMenu . '-' . Str::slug($item->MenuName, '-') . '.html' }}';">
                                                                <td><input style="height: 16px; width: 16px;"
                                                                        type="checkbox" name="ArrDel[]" id=""
                                                                        value="{{ $item->IdMenu }}"
                                                                        onclick="event.stopPropagation();"></td>

                                                                <td class="text-center">
                                                                    {{ $loop->iteration }}</td>

                                                                <td>
                                                                    {{ $item->MenuName }}</td>

                                                                <td class="text-center">
                                                                    {{ $item->Lever }}</td>

                                                                <td class="text-center">
                                                                    {{ $item->Position }}
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
                                                {{ $listMenus->links('pagination::bootstrap-4') }}
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
