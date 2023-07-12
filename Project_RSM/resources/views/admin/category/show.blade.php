@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">


            <div class="row">
                <div class="col-lg-10 col-xl-10 mx-auto">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><i class="bi bi-arrow-90deg-left" style="margin-right: 8px;"></i><a
                                        href="{{ back()->getTargetUrl() }}">Quay lại trang trước</a></li>
                                <li class="breadcrumb-item active">Thông tin danh mục: {{ $Category->CategoryName }}
                                </li>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="/admin/category/{{ $Category->IdCategory }}"
                                enctype="multipart/form-data" onsubmit="return CheckValueItems()">
                                @csrf
                                @method('PUT')
                                <div class="tab-content pt-2 mb-2" id="borderedTabJustifiedContent">
                                    <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                        aria-labelledby="home-tab">

                                        <div class="row">
                                            <div class="col-lg-12 mb-4">
                                                <label class="form-label">Tên danh mục <label class="text-danger">
                                                        (*)
                                                    </label></label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="CategoryName" class="form-control"
                                                        value="{{ $Category->CategoryName }}" id="CategoryName"
                                                        placeholder="VD: Đồ ăn" oninput="onInput(event)">
                                                    <div class="invalid-feedback">Vui lòng nhập tên danh mục!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3 border-top-line">
                                            @if (!$listItems->isEmpty())
                                                <p class="form-label mb-3">Danh sách các mặt hàng thuộc danh mục</p>
                                                <div class="scroll-y-400">
                                                    <table class="table e-commerce-table table-hover" id="table-items">
                                                        @foreach ($listItems as $item)
                                                            <tr
                                                                onclick="window.location.href = '{{ '/admin/items/show/' . $item->IdItems . '-' . Str::slug($item->ItemsName, '-') . '.html' }}';">
                                                                <td
                                                                    style="vertical-align:-webkit-baseline-middle !important; width: 10%;">
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td
                                                                    style="vertical-align:-webkit-baseline-middle !important; width: 10%;">
                                                                    <div class="m-b-20" style="height: 3rem; width: 3rem;">
                                                                        <img id="img-account"
                                                                            src="{{ asset('files/images/items/' . $item->Avatar) }}"
                                                                            alt="Profile" class="rounded-circle-items"
                                                                            style="">
                                                                    </div>
                                                                </td>
                                                                <td
                                                                    style="vertical-align:-webkit-baseline-middle !important;">
                                                                    {{ $item->ItemsName }}</td>
                                                                <td class="text-end"
                                                                    style="vertical-align:-webkit-baseline-middle !important;">
                                                                    {{ $item->Price }} đ</td>
                                                                <td class="text-end"
                                                                    style="vertical-align:-webkit-baseline-middle !important;">
                                                                    {{-- <a class="btn-delete-items" onclick="deleteItem(this)"
                                                                data-id="{{ $item->IdItems }}"><i
                                                                    class="bi bi-x-lg"></i></a> --}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            @else
                                                <div class="text-center">
                                                    <div class="">
                                                        <img style="max-width: 120px;"
                                                            src="{{ asset('files/images/iconsystem/items_empty.png') }}"
                                                            alt="" class="img-items-empty">
                                                    </div>
                                                    <p class="fs-6 pt-3 m-0">Chưa có mặt hàng nào thuộc danh mục này</p>
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div><!-- End Bordered Tabs Justified -->
                                @if ($errors->any())
                                    <div>
                                        @foreach ($errors->all() as $error)
                                            <p class="text-danger" style="font-style:italic; letter-spacing: 1px;">
                                                {{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="group border-top-line" style="display: flex; justify-content: space-between;">
                                    <a class="btn btn-danger js-show-modal">
                                        <i class="fa-solid fa-trash"></i>
                                        Xóa
                                    </a>
                                    <button onclick="CheckValueItems()" autocomplete="off" type="submit"
                                        class="btn btn-primary" value="">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        Lưu lại
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Xác nhận xóa -->
            <div class="d-flex wrap-modal1 js-modal">
                <div class="overlay-modal1 js-hide-modal" style="opacity: 0.5;"></div>

                <div class="d-flex container" style=" width: auto; max-width: 70%; align-items: center;">
                    <div class="bg0 p-lr-15-lg how-pos3-parent"
                        style="padding: 32px; box-shadow: 0px 0px 4px rgb(0 0 0 / 22%); border-radius: 10px;  background-color: #fff;   width: 100%;">
                        <div class="text-danger mb-3" style="text-align: left; font-size: 18px;">Bạn
                            chắc chắn muốn xóa danh mục <strong> {{ $Category->CategoryName }}</strong> ?</div>
                        <label for="" style=" margin-bottom: 28px;">Thao tác này sẽ không thể khôi phục
                        </label>

                        <div class="m-t-32">
                            <div class="col-sm-12 d-flex" style="padding: 0; justify-content: flex-end;">
                                <a class="btn btn-light js-hide-modal"
                                    style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                    <i class="bi bi-arrow-left-circle"></i>
                                    Trở lại
                                </a>

                                <a href="/admin/category/delete/{{ $Category->IdCategory }}"
                                    class="btn btn-danger delete-confirm"
                                    style="border-radius: 50px; min-width: 100px; margin-left: 16px;">
                                    Xác nhận xóa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--End main-->
@endsection
