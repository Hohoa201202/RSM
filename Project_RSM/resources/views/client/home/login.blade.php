@extends('layouts.client._Layout')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">
            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <div class="form-login">
                    <section class=" p-0">
                        <div class="container p-0">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                        <div class="card-body p-5 text-center">
                                            @if (session('message'))
                                                <div class="alert alert-success mb-4">
                                                    Đăng ký thành công
                                                </div>
                                                @php
                                                    session()->forget('message');
                                                @endphp
                                            @endif

                                            <form action="{{ route('client.login.post') }}" method="post">
                                                @csrf
                                                <h3 class="mb-5 text-primary">ĐĂNG NHẬP</h3>

                                                <div class="form-outline mb-4">
                                                    <input type="text" name="UserName" id="typeEmailX-2"
                                                        placeholder="Email hoặc số điện thoại" required value="{{ old('UserName') }}"
                                                        class="form-control form-control-lg">
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <input type="password" name="Password" id="typePasswordX-2"
                                                        placeholder="Mật khẩu" class="form-control form-control-lg"
                                                        required>
                                                </div>

                                                <!-- Checkbox -->
                                                <div class="form-check d-flex justify-content-between mb-4 p-0">
                                                    <div class="form-check d-flex justify-content-start p-0">
                                                        <input class=" me-2" checked type="checkbox" id="form1Example3">
                                                        <label class="form-check-label" for="form1Example3">Nhớ mật
                                                            khẩu</label>
                                                    </div>
                                                    <a class="" href="#">Quên mật khẩu?</a>
                                                </div>

                                                @foreach ($errors->all() as $error)
                                                    <label class="text-danger font-italic mb-4"
                                                        for="form1Example3">{{ $error }}</label>
                                                @endforeach

                                                <button style="width: 100%;"
                                                    class="d-block btn btn-primary btn-lg btn-block" type="submit">ĐĂNG
                                                    NHẬP</button>

                                                <label class="form-check-label mt-4" for="form1Example3">Bạn chưa có tài
                                                    khoản? <a href="{{ route('client.register') }}">Đăng ký</a></label>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </main>
@endsection
