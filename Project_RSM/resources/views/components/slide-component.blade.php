<!-- ======= Hero Section ======= -->
<section id="hero" style="background-image: url({{ asset('') }}) top center;"
    class="d-flex align-items-center justify-content-center position-relative flex-column">
    <div class="container" data-aos="fade-up">
        @php
            use App\Models\RestaurantInfo;
            $ResName = RestaurantInfo::first()->ResName;
        @endphp

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1>{{ $ResName }}<span>.</span></h1>
                <h2>Chúng tôi rất hân hạnh được phục vụ quý thực khách</h2>
            </div>
        </div>

        <div class="row gy-4 mt-1 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
            <div class="col-xl-8 col-md-12">

                {{-- <x-BookingComponent /> --}}
                <a href="{{ route('show-menus') }}" class="btn btn-primary text-uppercase btnOnSlide me-2">Thực đơn</a>
                <a href="{{ route('show-cart') }}" class="btn btn-primary text-uppercase btnOnSlide ms-2">Đặt bàn</a>

            </div>
        </div>
    </div>

    <button class="button-down" onclick="scrollToBottom()">
        <i class="bi bi-chevron-double-down"></i>
    </button>
</section>
<!-- End Hero -->
<script>
    function scrollToBottom() {
        window.scrollTo({
            top: 710,
            behavior: 'smooth'
        });
    }

    // Lưu các hình nền vào một mảng
    var slides = [
        @foreach ($slides as $slide)
            'files/images/slide/{{ $slide->ImageName }}',
        @endforeach
    ];

    var currentSlide = 0;
    var heroElement = document.getElementById('hero');
    heroElement.style.backgroundImage = `url(${slides[currentSlide]})`;

    function loadSlide() {
        var img = new Image();
        img.onload = function() {
            heroElement.style.backgroundImage = `url(${slides[currentSlide]})`;
        };
        img.src = slides[currentSlide];
    }

    setInterval(() => {
        currentSlide = (currentSlide + 1) % slides.length;
        loadSlide();
    }, 3000);
</script>
