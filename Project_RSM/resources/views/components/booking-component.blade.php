<div class="form-reservation position-relative">
    @csrf
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="input-group has-validation position-relative">
                <select name="IdBranch" id="IdBranch" class="form-select select-icon" required aria-invalid="true">
                    <option selected value="0">---Chọn nhà hàng---</option>
                    @foreach ($listBranchs as $item)
                        <option value="{{ $item->IdBranch }}">{{ $item->BranchName }} - {{ $item->Address }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Vui lòng chọn nhà hàng!</div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="input-group has-validation">
                <div class="input-group has-validation">
                    <input type="number" name="NumberGuests" class="form-control" min="1" max="50"
                        id="NumberGuests" placeholder="Số khách (*):" oninput="onInput(event)">
                    <div class="invalid-feedback">Vui lòng nhập số lượng khách</div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="input-group has-validation">
                <input type="text" name="FullName" class="form-control" id="FullName" placeholder="Họ tên (*):"
                    oninput="onInput(event)">
                <div class="invalid-feedback">Vui lòng nhập họ tên!</div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="input-group has-validation">
                <input type="text" name="PhoneNumber" class="form-control" id="PhoneNumber"
                    placeholder="Số điện thoại (*):" oninput="onInput(event)">
                <div class="invalid-feedback">Vui lòng nhập số điện thoại!</div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="input-group has-validation">
                <input class="form-control" placeholder="---Chọn ngày---" type="text" name="BookingDate"
                    id="BookingDate" readonly>
                <div class="invalid-feedback">Vui lòng chọn ngày nhận bàn!</div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="input-group has-validation">
                <select name="TimeSlot" id="TimeSlot" class="form-select select-icon" required aria-invalid="true">
                    <option selected value="0">---Khung giờ---</option>
                    @for ($i = 6; $i <= 20; $i += 2)
                        <option value="{{ $i }} - {{ $i + 2 }} giờ">
                            {{ $i }} -
                            {{ $i + 2 }} giờ</option>
                    @endfor
                </select>
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
    <a class="btn btn-reservation position-absolute text-lg btn-primary" type="submit" onclick="submit_booking()">
        <i class="bi bi-send-fill"></i>
        Đặt bàn ngay
    </a>
</div>
