@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">

                <div class="col-lg-1 col-md-1">
                </div>
                <div class="col-lg-10 col-md-10">

                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb">
                                <h4 class="breadcrumb-item active">Phân quyền người dùng</h4>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 600;" class="text"> Phân quyền vai trò chi tiết</h5>
                                <p class="text-sm">Thêm mới vai trò để quản lý nhân viên trong nhà
                                    hàng</p>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body" style="padding: 50px ;">
                                    <div class="row m-b-30"
                                        style="justify-content: flex-end; margin-bottom: 30px !important;">
                                        <div class="col-md-6" style="text-align: left !important;">
                                            <h5 style="font-size: 18px; font-weight: 600; padding-left: 1rem" class="">Danh sách vai trò</h5>
                                        </div>
                                        <div class="col-md-6" style="text-align: right !important;">
                                            <a class="btn btn-primary" href="/admin/role/create">
                                                <i class="bi bi-plus-circle"></i>
                                                <span>Thêm vai trò</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover e-commerce-table table-borderless datatable"
                                            style="margin-bottom: 50px !important;">
                                            <tbody id="records_table"
                                                style="vertical-align:-webkit-baseline-middle !important;">

                                                @if ($listGroupUser->isEmpty())
                                                    <p>Không có vai trò nào</p>
                                                @else
                                                    @foreach ($listGroupUser as $item)
                                                        <tr
                                                            onclick="window.location.href = '{{ '/admin/role/show/' . $item->IdGroup . '-' . Str::slug($item->GroupName, '-') . '.html' }}';">
                                                            <td
                                                                  class="text-primary">
                                                                {{ $item->GroupName }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-lg-1 col-md-1">
                </div>
            </div>
        </section>
    </main>
    <!--End main-->
@endsection
