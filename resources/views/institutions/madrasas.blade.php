@extends('layouts.app')

@section('title', __('messages.madrasas'))

@section('page-styles')
    @include('layouts.styles.institutions')
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <h2 class="section-title mb-4">{{ __('messages.madrasas') }}</h2>
            
            <!-- List of Madrasas -->
            <div class="madrasa-list">
                <!-- Madrasa Item -->
                <div class="madrasa-item mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">জামিয়া শুব্বানিয়া</h3>
                            <div class="madrasa-info">
                                <p><i class="fas fa-map-marker-alt"></i> ঢাকা, বাংলাদেশ</p>
                                <p><i class="fas fa-phone"></i> +880 1234-567890</p>
                                <p><i class="fas fa-envelope"></i> info@example.com</p>
                            </div>
                            <div class="madrasa-details mt-3">
                                <h4>শিক্ষা কার্যক্রম</h4>
                                <ul>
                                    <li>হিফজুল কুরআন</li>
                                    <li>কিতাব দিরাসাহ</li>
                                    <li>তাজবীদ শিক্ষা</li>
                                    <li>আরবি ভাষা শিক্ষা</li>
                                </ul>
                            </div>
                            <a href="#" class="btn btn-primary mt-3">বিস্তারিত দেখুন</a>
                        </div>
                    </div>
                </div>

                <!-- Madrasa Item -->
                <div class="madrasa-item mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">দারুল উলূম শুব্বানিয়া</h3>
                            <div class="madrasa-info">
                                <p><i class="fas fa-map-marker-alt"></i> চট্টগ্রাম, বাংলাদেশ</p>
                                <p><i class="fas fa-phone"></i> +880 1234-567890</p>
                                <p><i class="fas fa-envelope"></i> info@example.com</p>
                            </div>
                            <div class="madrasa-details mt-3">
                                <h4>শিক্ষা কার্যক্রম</h4>
                                <ul>
                                    <li>হিফজুল কুরআন</li>
                                    <li>কিতাব দিরাসাহ</li>
                                    <li>তাজবীদ শিক্ষা</li>
                                    <li>আরবি ভাষা শিক্ষা</li>
                                </ul>
                            </div>
                            <a href="#" class="btn btn-primary mt-3">বিস্তারিত দেখুন</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">গুরুত্বপূর্ণ লিংক</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('institutions.mosques') }}" class="text-decoration-none">মসজিদ সমূহ</a></li>
                        <li><a href="{{ route('institutions.orphanages') }}" class="text-decoration-none">এতিমখানা সমূহ</a></li>
                        <li><a href="{{ route('institutions.libraries') }}" class="text-decoration-none">লাইব্রেরি সমূহ</a></li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">যোগাযোগ করুন</h4>
                    <p>আরও তথ্যের জন্য যোগাযোগ করুন:</p>
                    <a href="{{ route('contact.index') }}" class="btn btn-primary">যোগাযোগ করুন</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
