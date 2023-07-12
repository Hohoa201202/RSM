@extends('Layouts.Admin._Layout')

@section('content')
    <!--Start main-->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12" style="margin: 0 auto;">
                    <div class="pagetitle">
                        <nav>
                            <ol class="breadcrumb" style="justify-content: space-between;">
                                <h4 class="breadcrumb-item active">Chọn bàn cho {{ $booking->NumberGuests }} người</h4>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-3 col-xl-3 col-md-3">
                            <div class="card">
                                <div class="card-body" style="padding: 1rem ;">
                                    <div class="d-flex align-items-start">
                                        <div class="nav flex-column nav-pills w-100" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">

                                            @foreach ($listArea as $area)
                                                <button
                                                    @if ($loop->iteration === 1) class="nav-link btn-tabs text-start active"
                                                @else
                                                class="nav-link btn-tabs text-start" @endif
                                                    id="v-pills-{{ $area->IdArea }}-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-{{ $area->IdArea }}" type="button"
                                                    role="tab" aria-controls="v-pills-{{ $area->IdArea }}"
                                                    aria-selected="true">
                                                    <i class="bi bi-geo-alt-fill"></i>
                                                    {{ $area->AreaName }}</button>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-xl-9 col-md-9">
                            <div class="card">
                                <div class="card-body" style="padding: 1rem ;">
                                    <div class="tab-content" id="v-pills-tabContent">

                                        @foreach ($listArea as $area)
                                            <div class="tab-pane fade {{ $loop->iteration === 1 ? 'active' : '' }} show"
                                                id="v-pills-{{ $area->IdArea }}" role="tabpanel"
                                                aria-labelledby="v-pills-{{ $area->IdArea }}-tab">
                                                <div class="row">
                                                    @foreach ($listTable->where('IdArea', $area->IdArea) as $table)
                                                        <div class="col col-lg-3 col-md-4 mb-4" data-aos="zoom-in"
                                                            data-aos-delay="100">
                                                            <a class="position-relative"
                                                                @if ($table->IdStatus === 1) {{-- Trống --}}
                                                                    style="border-radius: 1rem;"
                                                                    href="{{ route('selected-table', ['IdTable' => $table->IdTable, 'IdBooking' => $booking->IdBooking]) }}"
                                                                    @else
                                                                    style="cursor: not-allowed; border-radius: 1rem;" @endif>
                                                                <div
                                                                    class="d-flex d-flex flex-column align-items-center form-setting">
                                                                    <div class="icon setting-icon fs-5 mb-2 fw-bold"
                                                                        @if ($table->IdStatus === 1) {{-- Trống --}}
                                                                            style="color: #fff; background: #0db473;"
                                                                        @elseif($table->IdStatus === 2)
                                                                        {{-- Đã đặt trước --}}
                                                                            style="color: #fff; background: #ffc451;"
                                                                        @else
                                                                            style="color: #fff; background: #ee4747;" @endif>
                                                                        {{ $table->TableName }}
                                                                    </div>
                                                                    <div class="w-100 py-1">
                                                                        <p class="m-0">{{ $table->StatusName }}</p>
                                                                    </div>
                                                                    <div class="border-top-line w-100 pt-2">
                                                                        <p class="m-0">
                                                                            {{ $table->TypeName . ' (Tối đa ' . $table->MaxSeats . ')' }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                @if ($table->IdTable === $booking->IdTable)
                                                                    <div class="position-absolute table-check">
                                                                        <i class="bi bi-check-circle-fill"></i>
                                                                    </div>
                                                                @endif
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="d-flex justify-content-between border-top-line pt-3">
                                            <a href="{{ back()->getTargetUrl() }}" class="btn btn-light">
                                                <i class="fa-solid fa-angles-left"></i>
                                                Quay lại
                                            </a>
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
