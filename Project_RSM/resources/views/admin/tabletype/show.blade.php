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
                                <li class="breadcrumb-item active">Thông tin danh mục: {{ $TableType->TypeName }}
                                </li>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="/admin/tabletype/{{ $TableType->IdType }}"
                                enctype="multipart/form-data" onsubmit="return CheckValueItems()">
                                @csrf
                                @method('PUT')
                                <div class="tab-content pt-2 mb-2" id="borderedTabJustifiedContent">
                                    <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                        aria-labelledby="home-tab">

                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Tên loại bàn <label class="text-danger">
                                                        (*)
                                                    </label></label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="TypeName" class="form-control"
                                                        value="{{ $TableType->TypeName }}" id="TypeName"
                                                        placeholder="VD: Bàn đơn" oninput="onInput(event)">
                                                    <div class="invalid-feedback">Vui lòng nhập tên loại bàn!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label">Số ghế tối đa <label class="text-danger">
                                                        (*)
                                                    </label></label>
                                                <div class="input-group has-validation">
                                                    <select type="text" name="MaxSeats" class="form-select"
                                                        id="MaxSeats">
                                                        @for ($i = 1; $i < 16; $i++)
                                                            <option @if ($TableType->MaxSeats === $i) selected  @endif
                                                                value="{{ $i }}"> {{ $i }} ghế
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label class="form-label">Mô tả thêm </label>
                                                <div class="input-group has-validation">
                                                    <textarea name="Desscription" class="form-control text-start" rows="5">
                                                        {{ $TableType->Description }}
                                                    </textarea>
                                                </div>
                                            </div>
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
                                <div class="group border-top-line pt-3" style="display: flex; justify-content: space-between;">
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
                            chắc chắn muốn xóa danh mục <strong> {{ $TableType->TypeName }}</strong> ?</div>
                        <label for="" style=" margin-bottom: 28px;">Thao tác này sẽ không thể khôi phục
                        </label>

                        <div class="m-t-32">
                            <div class="col-sm-12 d-flex" style="padding: 0; justify-content: flex-end;">
                                <a class="btn btn-light js-hide-modal"
                                    style="border-radius: 50px; min-width: 100px; border: 1px solid #3333;">
                                    <i class="bi bi-arrow-left-circle"></i>
                                    Trở lại
                                </a>

                                <a href="/admin/tabletype/delete/{{ $TableType->IdType }}"
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
