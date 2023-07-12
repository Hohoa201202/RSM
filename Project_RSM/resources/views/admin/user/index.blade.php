@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb" style="justify-content: space-between;">
                    <h4 class="breadcrumb-item active">Danh sách nhân viên</h4>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" style="padding: 50px ;">
                            <div class="row m-b-30" style="    justify-content: center; margin-bottom: 30px !important;">
                                <div class="col-md-6">
                                    <a style="color: #fff;" class="btn btn-primary" href="/admin/user/create">
                                        <i class="bi bi-plus-circle"></i>
                                        <span>Thêm nhân viên</span>
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
                            <div class="table-responsive">
                                <table class="table table-hover e-commerce-table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tài khoản</th>
                                            <th scope="col">Họ và tên</th>
                                            <th scope="col">Ngày sinh</th>
                                            <th scope="col">Điện thoại</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Trạng thái</th>
                                            <th data-sortable="false"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="records_table" style="vertical-align:-webkit-baseline-middle !important;">

                                        @if ($listUser->isEmpty())
                                            <p>Không có nhân viên nào</p>
                                        @else
                                            @foreach ($listUser as $item)
                                                <tr
                                                    onclick="window.location.href = '{{ '/admin/user/show/' . $item->UserName . '-' . Str::slug($item->LastName, '-') . '-' . Str::slug($item->FirstName, '-') . '.html' }}';">
                                                    <td>{{ $item->UserName }}</td>
                                                    <td>{{ $item->LastName . ' ' . $item->FirstName }}</td>
                                                    <td>{{ $item->BirthDay }}</td>
                                                    <td>{{ $item->PhoneNumber }}</td>
                                                    <td>{{ $item->Email }}</td>
                                                    <td>
                                                        <div class="form-check form-switch"
                                                            style="padding-bottom: 8px !important;">
                                                            <input @if ($item->Status) checked = "" @endif
                                                                class="form-check-input" type="checkbox"
                                                                id="flexSwitchCheckDefault" disabled data-val="true"
                                                                data-val-required="The Active field is required."
                                                                value="true">
                                                            <label for="Active" class="form-check-label"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        <a class="btn btn-success"
                                                            href="{{ '/admin/user/show/' . $item->UserName . '-' . Str::slug($item->LastName, '-') . '-' . Str::slug($item->FirstName, '-') . '.html' }}">
                                                            <i class="bi bi-eye"></i>
                                                            View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                                {{-- <nav aria-label="Page navigation example">

                                    <nav class="pager-container">
                                        <ul class="pagination">
                                            <li class="active page-item"><span class="page-link">1</span></li>
                                            <li class="page-item"><a class="page-link"
                                                    href="/Admin/AdminProducts?CategoryID=0&amp;page=2">2</a></li>
                                        </ul>
                                    </nav>

                                </nav> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--End main-->
@endsection
