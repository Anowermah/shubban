<!-- ========================================================================
     13. INSPIRING DONATION CTA BANNER (সাদকায়ে জারিয়া ও অনুদান)
     ======================================================================== -->
<section class="py-4 py-lg-5">
    <div class="container">
        <div class="donation-banner-wrap">
            <div class="row align-items-center gy-4">
                <div class="col-lg-8 text-center text-lg-start">
                    @if($section->badge_text)
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-2">
                            <i class="fas fa-hand-holding-heart me-1"></i> {{ $section->badge_text }}
                        </span>
                    @endif
                    <h2 class="fw-bold fs-2 mb-2 text-white">{{ $section->title ?? 'দ্বীনের প্রসার ও মানবতার সেবায় আপনার দান' }}</h2>
                    @if($section->subtitle)
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem; max-width: 600px;">
                            {{ $section->subtitle }}
                        </p>
                    @endif
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-lg-end">
                        <a href="{{ route('donate.index') }}" class="btn-donate-gold">
                            <i class="fas fa-donate"></i> অনলাইনে দান করুন
                        </a>
                        <a href="{{ route('contact.index') }}" class="btn-contact-outline">
                            <i class="fas fa-phone-alt"></i> যোগাযোগ করুন
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
