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
                                <h4 class="breadcrumb-item active">Danh sách combo</h4>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 600;" class="text"> Danh sách combo
                                </h5>
                                <p class="text-sm">Quản lý các combo, thêm món ăn cho các combo tại nhà hàng</p>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="row m-b-30 mb-3">
                                        <div class="col-md-6">
                                            <a style="color: #fff;" class="btn btn-primary" href="/admin/combo/create">
                                                <i class="bi bi-plus-circle"></i>
                                                <span>Thêm combo</span>
                                            </a>
                                        </div>
                                    </div>
                                    <form method="post" action="/admin/combo/delete/all">
                                        @csrf
                                        <div class="table-responsive">
                                            @if ($listCombo->isEmpty())
                                                <div class="col-lg-5" style="margin: 0 auto;">
                                                    <img style="width: 100%;"
                                                        src="{{ asset('files/images/iconSystem/emp-customer.webp') }}"
                                                        alt="combo trống">
                                                    <p class="text-center">Không có combo nào</p>
                                                </div>
                                            @else
                                                <table
                                                    class="table table-hover e-commerce-table table-borderless datatable">
                                                    <thead>
                                                        <tr>
                                                            <th style="padding: 1rem 8px !important;" scope="col"
                                                                data-sortable="false"><input
                                                                    style="height: 16px; width: 16px;" type="checkbox"
                                                                    id="select-all-checkbox" onclick="toggleCheckboxes()">
                                                            </th>
                                                            <th scope="col">STT</th>
                                                            <th scope="col" colspan="2">
                                                                Tên combo
                                                            </th>
                                                            <th scope="col">Giá bán
                                                            </th>
                                                            <th class="text-center" data-sortable="false">
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="records_table"
                                                        style="vertical-align:-webkit-baseline-middle !important;">
                                                        @foreach ($listCombo as $item)
                                                            <tr
                                                                onclick="window.location.href = '{{ '/admin/combo/show/' . $item->IdCombo . '-' . Str::slug($item->ComboName, '-') . '.html' }}';">
                                                                <td><input style="height: 16px; width: 16px;"
                                                                        type="checkbox" name="ArrData[]" id=""
                                                                        value="{{ $item->IdCombo }}"
                                                                        onclick="event.stopPropagation();"></td>
                                                                <td>
                                                                    {{ $loop->iteration }}</td>
                                                                <td class="pe-0"
                                                                    style="padding: 1rem; vertical-align:-webkit-baseline-middle !important; width: 10%;">
                                                                    <div class="m-b-20" style="height: 3rem; width: 3rem;">
                                                                        <img id="img-account"
                                                                            src="{{ asset('files/images/combo/' . $item->Avatar) }}"
                                                                            alt="Profile" class="rounded-circle-items"
                                                                            style="">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{ $item->ComboName }}</td>

                                                                <td>
                                                                    {{ number_format($item->Price, 0, ',') }} ₫</td>
                                                                <td class="text-end">
                                                                    <a class="btn btn-success"
                                                                        href="{{ '/admin/combo/show/' . $item->IdCombo . '-' . Str::slug($item->ComboName, '-') . '.html' }}">
                                                                        <i class="bi bi-eye"></i>
                                                                        View
                                                                    </a>
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
                                                {{ $listCombo->links('pagination::bootstrap-4') }}
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
