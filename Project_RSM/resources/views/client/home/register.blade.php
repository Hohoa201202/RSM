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
                                            <form action="{{ route('client.register.post') }}" method="post" onsubmit="return Check()" >
                                                @csrf
                                                <h3 class="mb-5 text-primary">ĐĂNG KÝ</h3>

                                                <div class="form-outline mb-4">
                                                    <input type="text" name="FullName" placeholder="Họ và tên" required value="{{ old("FullName") }}"
                                                        class="form-control form-control-lg">
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <input type="text" name="PhoneNumber" placeholder="Số điện thoại" value="{{ old("PhoneNumber") }}"
                                                        required class="form-control form-control-lg">
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <input type="password" name="Password" id="Password" placeholder="Tạo mật khẩu"
                                                        class="form-control form-control-lg" required>
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <input type="password" name="ConfirmPassword" id="ConfirmPassword"
                                                        placeholder="Xác nhận mật khẩu" class="form-control form-control-lg"
                                                        required>
                                                    <label class="text-danger text-start  mt-2 invalid-feedback">Xác nhận mật khẩu không trùng khớp</label>
                                                </div>

                                                @foreach ($errors->all() as $error)
                                                    <label class="text-danger font-italic mb-4"
                                                        for="form1Example3">{{ $error }}</label>
                                                @endforeach

                                                <button style="width: 100%;"
                                                    class="d-block btn btn-primary btn-lg btn-block" type="submit">ĐĂNG
                                                    KÝ</button>

                                                <label class="form-check-label mt-4" for="form1Example3">Bạn đã có tài
                                                    khoản? <a href="{{ route('client.login') }}">Đăng nhập</a></label>
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
    <script>
        function Check() {
            const Password = $("#Password");
            const ConfirmPassword = $("#ConfirmPassword");

            var isValid = true; // Biến flag mặc định là true

            if (Password.val().trim() !== ConfirmPassword.val().trim()) {
                var invalidFeedback = ConfirmPassword.parent().find('.invalid-feedback');
                invalidFeedback.show();
                ConfirmPassword.addClass("is-invalid");
                isValid = false;
            }

            return isValid; // Trả về biến flag
        }
    </script>
@endsection
