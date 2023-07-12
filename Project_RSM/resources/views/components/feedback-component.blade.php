<section id="testimonials" class="testimonials" style="background-color: #fef9e8;">
    <div class="container" data-aos="zoom-in">

        <div class="section-title">
            <p class="text-center">Cảm nhận của khách hàng</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">

                @foreach ($listFeedback as $feedback)
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="mb-2 mx-auto" style="height: 9rem; width: 9rem;">
                                <img id="img-account" src="{{ asset('files/images/customer/' . $feedback->Avatar) }}"
                                    alt="Ảnh combo" class="rounded-circle">
                            </div>
                            <h3 class="my-3">{{ $feedback->FullName }}</h3>
                            {{-- <h4>Ceo &amp; Founder</h4> --}}
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                {{ $feedback->Content }}
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>
