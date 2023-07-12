@extends('layouts.client._Layout')
@section('content')
    <main id="main">

        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="m-0 text-primary">Đặt bàn</h2>
                    <ol>
                        <li><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li>Đặt bàn</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section id="features" class="inner-page">
            <div class="container" data-aos="fade-up">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">STT</th>
                            <th class="text-start" scope="col">Món ăn</th>
                            <th class="text-center" scope="col">Giá bán</th>
                            <th class="text-center" scope="col">Số lượng</th>
                            <th class="text-center" scope="col">Thành tiền</th>
                            <th class="text-center" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (session()->has('ArrItems') && count(session('ArrItems')) > 0)
                            @foreach ($itemsCart = session()->get('ArrItems') as $item)
                                <tr class="items-cart wrap-cart-{{ $item['IdItems'] }}" data-id="{{ $item['IdItems'] }}">
                                    <input type="hidden" name="Price" value="{{ $item['Price'] }}">
                                    <td class="text-center fw-bold">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="m-b-20 me-3" style="height: 3rem; width: 3rem;">
                                            <img id="img-account" src="{{ asset('files/images/items/' . $item['Avatar']) }}"
                                                alt="Profile" class="rounded-circle-items" style="">
                                        </div>
                                        {{ $item['ItemsName'] }}
                                    </td>
                                    <td class="text-center">{{ number_format($item['Price'], 0, '.', '.') }} ₫</td>
                                    <td
                                        class="text-center quantity m-0 fw-bold d-flex justify-content-center align-items-center">
                                        <div onclick="subQuantity(this)" data-id="{{ $item['IdItems'] }}"
                                            class="fs-5 py-0 px-1 pe-1 btn btn-light"><i class="text-danger bi bi-dash"></i>
                                        </div>
                                        <p class="m-0 fs-6 text-center px-3 quantity-{{ $item['IdItems'] }}">
                                            {{ $item['Quantity'] }}
                                        </p>
                                        <div onclick="addQuantity(this)" data-id="{{ $item['IdItems'] }}"
                                            class="fs-5 py-0 px-1 ps-1 btn btn-light" href=""><i
                                                class="text-success bi bi-plus"></i></div>
                                    </td>
                                    <td class="text-center total-of-item-{{ $item['IdItems'] }}">
                                        {{ number_format($item['Price'] * $item['Quantity'], 0, '.', '.') }} ₫
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-danger" onclick="deleteItemCartView(this)"
                                            data-id="{{ $item['IdItems'] }}">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                    </td>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center p-3">
                                    Bạn không đặt trước món.
                                    <a class="text- text-decoration-underline" href="{{ route('show-menus') }}">Đến thực
                                        đơn</a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @if (session()->has('ArrItems') && count(session('ArrItems')) > 0)
                    <div class="row">
                        <div class="col-xl-9 col-lg-9 col-md-8 mb-3">
                            <a href="{{ route('show-menus') }}" class="btn btn-light">
                                <i class="bi bi-caret-left-fill"></i>
                                Tiếp tục chọn món</a>
                            <a class="btn btn-danger" id="btn-del-all-cart">Xóa hết</a>
                            <a onclick="submit_booking()" class="btn btn-success">
                                Thanh toán
                                <i class="bi bi-caret-right-fill"></i>
                            </a>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4">
                            <div class="d-flex flex-column justify-content-between">
                                <div class="flex-grow-1">
                                    <div class="d-flex mb-2">
                                        <p class="p-0 m-0">Tạm tính:</p>
                                        <p class="p-0 m-0 ms-auto fw-bold" id="total-money"></p>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex mb-2">
                                        <p class="p-0 m-0">Khuyến mãi:</p>
                                        <p class="p-0 m-0 ms-auto"></p>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex mb-2">
                                        <p class="p-0 m-0">Tổng cộng (VAT):</p>
                                        <p class="p-0 m-0 ms-auto fw-bold text-danger" id="total-amount"></p>
                                        <input type="hidden" name="Total">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mt-4 p-4 form-borking-cart col-12">
                    @csrf
                    <div class="row">
                        <p class="fs-4 text-center text-primary">Thông tin đặt bàn</p>

                        <div class="col-lg-4 mb-4">
                            <div class="input-group has-validation position-relative">
                                <select name="IdBranch" id="IdBranch" class="form-select select-icon" required
                                    aria-invalid="true">
                                    <option selected value="0">---Chọn nhà hàng---</option>
                                    @foreach ($listBranchs as $item)
                                        <option value="{{ $item->IdBranch }}">{{ $item->BranchName }} -
                                            {{ $item->Address }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Vui lòng chọn nhà hàng!</div>
                            </div>
                        </div>

                        @if (session()->has('IdCustomer'))
                            <div class="col-lg-4 mb-4">
                                <div class="input-group has-validation">
                                    <input type="text" name="FullName" class="form-control" id="FullName"
                                        placeholder="Họ tên (*):" oninput="onInput(event)"
                                        value="{{ session()->get('CusLastName') . ' ' . session()->get('CusFirstName') }}">
                                    <div class="invalid-feedback">Vui lòng nhập họ tên!</div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-4 mb-4">
                                <div class="input-group has-validation">
                                    <input type="text" name="FullName" class="form-control" id="FullName"
                                        placeholder="Họ tên (*):" oninput="onInput(event)">
                                    <div class="invalid-feedback">Vui lòng nhập họ tên!</div>
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-4 mb-4">
                            <div class="input-group has-validation">
                                <input class="form-control" placeholder="---Chọn ngày---" type="text"
                                    name="BookingDate" id="BookingDate" readonly>
                                <div class="invalid-feedback">Vui lòng chọn ngày nhận bàn!</div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-4">
                            <div class="input-group has-validation">
                                <input type="number" name="NumberGuests" class="form-control" min="1" style="border-radius: .375rem;"
                                    max="50" id="NumberGuests" placeholder="Số khách (*):"
                                    oninput="onInput(event)">
                                <div class="invalid-feedback">Vui lòng nhập số lượng khách</div>
                                <div class="check-value">Số khách tối thiểu 1 và tối đa 50</div>
                            </div>
                        </div>

                        @if (session()->has('IdCustomer'))
                            <div class="col-lg-4 mb-4">
                                <div class="input-group has-validation">
                                    <input type="text" name="PhoneNumber" class="form-control" id="PhoneNumber"
                                        placeholder="Số điện thoại (*):" oninput="onInput(event)" value="{{ session()->get('CusPhoneNumber') }}">
                                    <div class="invalid-feedback">Vui lòng nhập số điện thoại!</div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-4 mb-4">
                                <div class="input-group has-validation">
                                    <input type="text" name="PhoneNumber" class="form-control" id="PhoneNumber"
                                        placeholder="Số điện thoại (*):" oninput="onInput(event)">
                                    <div class="invalid-feedback">Vui lòng nhập số điện thoại!</div>
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-4 mb-4">
                            <div class="input-group has-validation">
                                <input name="TimeSlot" placeholder="---Chọn giờ---" id="TimeSlot" type="text" class="form-control select-icon" readonly>
                                <div class="invalid-feedback">Vui lòng chọn giờ nhận bàn!</div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <div class="input-group has-validation">
                                <textarea style="" type="text" name="Note" class="form-control" id="Note" rows="4"
                                    placeholder="Lời nhắn với nhà hàng"></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn p-2 text-lg btn-primary mx-auto d-block" id="save-btn"
                        onclick="submit_booking()">
                        <i class="bi bi-send-fill"></i>
                        Gửi đơn đặt bàn
                    </button>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
