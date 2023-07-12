@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12" style="margin: 0 auto;">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb ustify-content-between">
                                <h4 class="breadcrumb-item active text-uppercase">Thông tin nhà hàng</h4>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('update-res-info') }}" method="post" class="row"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="Logo" value="{{ $info->Logo }}">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <p class="fw-bold m-0">
                                                Thông tin chung
                                            </p>
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa-solid fa-floppy-disk pe-1"></i>
                                                Lưu lại
                                            </button>
                                        </div>

                                        <div class="col-lg-4 d-flex flex-column align-items-center justify-content-center">
                                            <div class="m-b-20" style="height: 8rem; width: 8rem;">
                                                <img id="img-account"
                                                    src="{{ asset('files/images/iconSystem/' . $info->Logo) }}"
                                                    alt="Logo" class="rounded-circle"
                                                    style="border: 2px solid #fff;box-shadow: 0 2px 10px #0123 ;border-radius: 50%; width: 100%;height: 100%; object-fit: cover;cursor: pointer;">
                                            </div>

                                            <div class="input-group mb-3"
                                                style="flex-direction: column; text-align: center;">
                                                <div>
                                                    <label for="_Logo" class="btn btn-light mt-3"
                                                        style="border-radius: 6px; border: 1px solid #3333;">Chọn
                                                        logo</label>
                                                    <input autocomplete="off" type="file" class="form-control"
                                                        id="_Logo" aria-describedby="button-addon2" name="_Logo"
                                                        onchange="document.getElementById('img-account').src = window.URL.createObjectURL(this.files[0])" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <label class="form-label">
                                                        Tên nhà hàng của bạn:
                                                        <label class="text-danger">
                                                            (*)
                                                        </label>
                                                    </label>
                                                    <div class="input-group has-validation">
                                                        <input type="text" name="ResName" class="form-control"
                                                            id="ResName" placeholder="Tên nhà hàng"
                                                            oninput="onInput(event)" value="{{ $info->ResName}}">
                                                        @if ($errors->any())
                                                            @foreach ($errors->all() as $error)
                                                                <div class=" ps-2 invalid-feedback d-block">{{ $error }}
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label class="form-label">Hotline 1: </label>
                                                    <div class="input-group has-validation">
                                                        <input type="text" name="Hotline1" class="form-control"
                                                            id="Hotline1" placeholder="Hotline 1"
                                                            value="{{ $info->Hotline1}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 mb-3">
                                                    <label class="form-label">Hotline 2: </label>
                                                    <div class="input-group has-validation">
                                                        <input type="text" name="Hotline2" class="form-control"
                                                            id="Hotline2" placeholder="Hotline 2"
                                                            value="{{ $info->Hotline2}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 mb-3">
                                                    <label class="form-label">Email: </label>
                                                    <div class="input-group has-validation">
                                                        <input type="text" name="Email" class="form-control"
                                                            id="Email" placeholder="Email" value="{{ $info->Email}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <label class="form-label">Giới thiệu ngắn: </label>
                                                    <div class="input-group has-validation">
                                                        <input type="text" name="ShortDescription" class="form-control"
                                                            id="ShortDescription" placeholder="Tối đa 255 ký tự"
                                                            value="{{ $info->ShortDescription}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">Ngày mở cửa trong tuần: </label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="OpeningDay" class="form-control" id="OpeningDay"
                                                    placeholder="VD: Thứ 2 - CN" value="{{ $info->OpeningDay}}">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">Thời gian mở cửa trong ngày: </label>
                                            <div class="input-group has-validation">
                                                <input type="time" class="form-control " name="OpenTime" value="{{ $info->OpenTime }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label">Thời gian đóng cửa trong ngày: </label>
                                            <div class="input-group has-validation">
                                                <input type="time" class="form-control" name="CloseTime" value="{{ $info->CloseTime }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Bài giới thiệu: </label>
                                            <textarea name="LongDescription" id="summernote" style="width: 100% !important; ">
                                            {{ $info->LongDescription }}
                                            </textarea>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div></div>
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa-solid fa-floppy-disk pe-1"></i>
                                                Lưu lại
                                            </button>
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

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Mời bạn nhập nội dung ...',
                tabsize: 2,
                height: 500,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
