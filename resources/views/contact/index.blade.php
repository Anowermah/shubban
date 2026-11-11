@extends('layouts.app')

@section('title', 'যোগাযোগ')

@section('page-styles')
    @include('layouts.styles.contact')
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="section-title text-center mb-5">যোগাযোগ করুন</h1>
        </div>
    </div>

    <div class="row">
        <!-- Contact Information -->
        <div class="col-lg-4 mb-4">
            <div class="contact-info-card">
                <div class="card-body">
                    <h3 class="card-title mb-4">
                        <i class="fas fa-info-circle me-2"></i>যোগাযোগের তথ্য
                    </h3>

                    <div class="info-section mb-4">
                        <h4><i class="fas fa-map-marker-alt me-2"></i>ঠিকানা</h4>
                        <p>কেন্দ্রয় কার্যালয়: ৭৯/ক/৩, উত্তর যাত্রাবাড়ি,<br>ঢাকা-১২০৪<br>বাংলাদেশ</p>
                    </div>

                    <div class="info-section mb-4">
                        <h4><i class="fas fa-phone me-2"></i>ফোন</h4>
                        <p>অফিস: 01765-812261<br>মোবাইল: ০১৭৬৫-৮১২২৬১</p>
                    </div>

                    <div class="info-section mb-4">
                        <h4><i class="fas fa-envelope me-2"></i>ইমেইল</h4>
                        <p>info.shubban@gmail.com<br>inf@shubbanbd.org</p>
                    </div>

                    <div class="info-section">
                        <h4><i class="fas fa-clock me-2"></i>অফিস সময়</h4>
                        <p>শনিবার - বৃহস্পতিবার<br>সকাল ৯:০০ - বিকাল ৬:০০</p>
                    </div>
                </div>
            </div>

            <div class="social-links mt-4">
                <h4 class="mb-3">সামাজিক মাধ্যম</h4>
                <div class="d-flex gap-3">
                    <a href="https://www.facebook.com/shubban" class="social-link facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.youtube.com/@ShubbanDawah" class="social-link youtube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="social-link twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-8">
            <div class="contact-form-card">
                <div class="card-body">
                    <h3 class="card-title mb-4">
                        <i class="fas fa-paper-plane me-2"></i>বার্তা পাঠান
                    </h3>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">নাম</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">মোবাইল নাম্বার</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                       id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">ইমেইল (ঐচ্ছিক)</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label">বিষয়</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                       id="subject" name="subject" value="{{ old('subject') }}" required>
                                @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label">বার্তা</label>
                            <textarea class="form-control @error('message') is-invalid @enderror"
                                      id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>বার্তা পাঠান
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="map-card">
                <div class="card-body p-0">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3653.030260317309!2d90.4349656!3d23.7106134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9ded9748413%3A0x48ffd63a757c11f2!2z4Kac4Kau4KaI4Kav4Ka84KakIOCmtuCngeCmrOCnjeCmrOCmvuCmqOCnhyDgpobgprngprLgp4cg4Ka54Ka-4Kam4KeA4Ka4IOCmrOCmvuCmguCmsuCmvuCmpuCnh-Cmtg!5e0!3m2!1sen!2sbd!4v1743838915196!5m2!1sen!2sbd"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
