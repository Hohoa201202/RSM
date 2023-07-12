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
                                <h4 class="breadcrumb-item active">Danh sách khách hàng</h4>

                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 600;" class="text"> Danh sách khách hàng
                                </h5>
                                <p style="font-size: 14px;" class="text">Có thể tạo tài khoản đăng nhập hệ thống cho khách
                                    hàng nếu khách hàng có nhu cầu</p>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body" style="padding: 50px ;">
                                    <div class="row m-b-30"
                                        style="justify-content: center; margin-bottom: 30px !important;">
                                        <div class="col-md-6">
                                            <a style="color: #fff;" class="btn btn-primary" href="/admin/customer/create">
                                                <i class="bi bi-plus-circle"></i>
                                                <span>Thêm mới khách hàng</span>
                                            </a>
                                        </div>

                                        <div class="col-md-6 d-flex" style="justify-content: end;">
                                            <form action="{{ url('admin/customer/import-csv') }}" method="POST"
                                                enctype="multipart/form-data" style="margin-right: 8px;">
                                                @csrf
                                                <input style="max-width: 100px" type="file" name="import_file">
                                                <input type="submit" value="Import" name="import_csv"
                                                    class="btn btn-success">
                                            </form>
                                            <form action="{{ url('admin/customer/export-csv') }}" method="POST">
                                                @csrf
                                                <input type="submit" value="Export" name="export_csv"
                                                    class="btn btn-success">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        @if ($listCustomer->isEmpty())
                                            <div class="col-lg-5" style="margin: 0 auto;">
                                                <img style="width: 100%;"
                                                    src="{{ asset('files/images/iconSystem/emp-customer.webp') }}"
                                                    alt="Khách hàng trống">
                                                <p class="text-center">Không có khách hàng nào</p>
                                            </div>
                                        @else
                                            <table class="table table-hover e-commerce-table table-borderless datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">STT</th>
                                                        <th scope="col">Họ và tên</th>
                                                        <th scope="col">Điện thoại</th>
                                                        <th scope="col">Trạng thái</th>
                                                        <th data-sortable="false"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="records_table"
                                                    style="vertical-align:-webkit-baseline-middle !important;">
                                                    <?php $i = 0; ?>
                                                    @foreach ($listCustomer as $item)
                                                        <?php $i++; ?>
                                                        <tr
                                                            onclick="window.location.href = '{{ '/admin/customer/show/' . $item->IdCustomer . '-' . Str::slug($item->LastName, '-') . '-' . Str::slug($item->FirstName, '-') . '.html' }}';">
                                                            <td>
                                                                {{ $i }}</td>

                                                            <td>
                                                                {{ $item->LastName . ' ' . $item->FirstName }}</td>

                                                            <td>
                                                                {{ $item->PhoneNumber }}</td>
                                                            <td>
                                                                <div class="form-check form-switch"
                                                                    style="padding-bottom: 8px !important;">
                                                                    <input
                                                                        @if ($item->Status) checked = "" @endif
                                                                        class="form-check-input" type="checkbox"
                                                                        id="flexSwitchCheckDefault" disabled data-val="true"
                                                                        data-val-required="The Active field is required."
                                                                        value="true">
                                                                    <label for="Active" class="form-check-label"></label>
                                                                </div>
                                                            </td>

                                                            <td class="text-end">
                                                                <a class="btn btn-success"
                                                                    href="{{ '/admin/customer/show/' . $item->IdCustomer . '-' . Str::slug($item->LastName, '-') . '-' . Str::slug($item->FirstName, '-') . '.html' }}">
                                                                    <i class="bi bi-eye"></i>
                                                                    View
                                                                </a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
    <!--End main-->
@endsection
