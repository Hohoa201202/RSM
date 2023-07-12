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
                                <h4 class="breadcrumb-item active">Thiết lập khu vực</h4>
                                <a style="color: #fff;" class="btn btn-primary" href="/admin/area/create">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Thêm khu vực</span>
                                </a>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 600;" class="text"> Danh sách khu vực
                                </h5>
                                <p class="text-sm">Quản lý các khu vực trong nhà hàng của bạn và các bàn nằm trong khu vực
                                    đó</p>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body" style="padding: 50px ;">
                                    <form method="post" action="/admin/area/delete/all">
                                        @csrf
                                        <div class="table-responsive">
                                            @if ($listArea->isEmpty())
                                                <div class="col-lg-5" style="margin: 0 auto;">
                                                    <img style="width: 100%;"
                                                        src="{{ asset('files/images/iconSystem/emp-customer.webp') }}"
                                                        alt="Danh sách trống trống">
                                                    <p class="text-center">Không có khu vực nào</p>
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
                                                            <th scope="col">STT</th>
                                                            <th scope="col">
                                                                Tên khu vực
                                                            </th>
                                                            <th scope="col" class="text-center">Số lượng
                                                                bàn
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="records_table"
                                                        style="vertical-align:-webkit-baseline-middle !important;">
                                                        @foreach ($listArea as $item)
                                                            <tr onclick="window.location.href = '{{ '/admin/area/show/' . $item->IdArea }}';">
                                                                <td><input style="height: 16px; width: 16px;"
                                                                        type="checkbox" name="ArrDel[]" id=""
                                                                        value="{{ $item->IdArea }}"
                                                                        onclick="event.stopPropagation();"></td>
                                                                <td>
                                                                    {{ $loop->iteration }}</td>
                                                                <td>
                                                                    {{ $item->AreaName }}</td>

                                                                <td class="text-center">
                                                                    {{ $item->TotalTable }}</td>
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
                                                {{ $listArea->links('pagination::bootstrap-4') }}
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
