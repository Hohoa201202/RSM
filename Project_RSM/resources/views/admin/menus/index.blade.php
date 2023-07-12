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
                                <h4 class="breadcrumb-item active">Danh sách thực đơn</h4>
                                {{-- <a style="color: #fff;" class="btn btn-primary" href="/admin/menus/create">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Thêm thực đơn</span>
                                </a> --}}
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 600;" class="text"> Danh sách thực đơn
                                </h5>
                                <p class="text-sm">Quản lý các thực đơn, thêm món ăn cho các thực đơn tại nhà hàng</p>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="row m-b-30">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <a style="color: #fff;" class="btn btn-primary d-inherit"
                                                        href="/admin/menus/create">
                                                        <i class="bi bi-plus-circle"></i>
                                                        <span>Thêm thực đơn</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="post" action="/admin/menus/delete/all">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="table table-hover e-commerce-table table-borderless datatable">
                                                <thead>
                                                    <tr>
                                                        <th style="padding: 1rem 8px !important;" scope="col" data-sortable="false"><input
                                                                style="height: 16px; width: 16px;" type="checkbox"
                                                                id="select-all-checkbox"  onclick="toggleCheckboxes()"></th>
                                                        <th scope="col">STT</th>
                                                        <th scope="col">Tên thực đơn
                                                        <th scope="col">Sắp xếp
                                                        </th>
                                                        <th scope="col" class="text-center" data-sortable="false"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="records_table"
                                                    style="vertical-align:-webkit-baseline-middle !important;">

                                                    @if ($listMenus->isEmpty())
                                                        <div class="col-lg-5" style="margin: 0 auto;">
                                                            <img style="width: 100%;"
                                                                src="{{ asset('files/images/iconSystem/emp-customer.webp') }}"
                                                                alt="Thực đơn trống">
                                                            <p class="text-center">Không có thực đơn nào</p>
                                                        </div>
                                                    @else
                                                        @foreach ($listMenus as $item)
                                                            <tr
                                                                onclick="window.location.href = '{{ '/admin/menus/show/' . $item->IdMenu . '-' . Str::slug($item->MenuName, '-') . '.html' }}';">
                                                                <td><input style="height: 16px; width: 16px;"
                                                                        type="checkbox" name="ArrData[]" id=""
                                                                        value="{{ $item->IdMenu }}"
                                                                        onclick="event.stopPropagation();"></td>

                                                                <td>
                                                                    {{ $loop->iteration }}</td>

                                                                <td>
                                                                    {{ $item->MenuName }}</td>

                                                                <td>
                                                                    {{ $item->OrderMenu }}</td>

                                                                <td class="text-end">
                                                                    <a class="btn btn-success"
                                                                        href="{{ '/admin/menus/show/' . $item->IdMenu . '-' . Str::slug($item->MenuName, '-') . '.html' }}">
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
@endsection
