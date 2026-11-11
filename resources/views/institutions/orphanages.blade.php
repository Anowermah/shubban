@extends('layouts.app')

@section('title', __('messages.orphanages'))

@section('page-styles')
    @include('layouts.styles.institutions')
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <h2 class="section-title mb-4">{{ __('messages.orphanages') }}</h2>
            
            <!-- List of Orphanages -->
            <div class="orphanage-list">
                <!-- Orphanage Item -->
                <div class="orphanage-item mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">দারুল ইতাম শুব্বানিয়া</h3>
                            <div class="orphanage-info">
                                <p><i class="fas fa-map-marker-alt"></i> ঢাকা, বাংলাদেশ</p>
                                <p><i class="fas fa-phone"></i> +880 1234-567890</p>
                                <p><i class="fas fa-envelope"></i> info@example.com</p>
                            </div>
                            <div class="orphanage-details mt-3">
                                <h4>সুবিধাসমূহ</h4>
                                <ul>
                                    <li>আবাসিক সুবিধা</li>
                                    <li>শিক্ষা ব্যবস্থা</li>
                                    <li>খাবার ব্যবস্থা</li>
                                    <li>চিকিৎসা সেবা</li>
                                    <li>ক্রীড়া সুবিধা</li>
                                </ul>
                            </div>
                            <div class="orphanage-stats mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stat-item text-center">
                                            <h5>মোট শিশু</h5>
                                            <p class="mb-0">১৫০+</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-item text-center">
                                            <h5>শিক্ষক</h5>
                                            <p class="mb-0">২০+</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-item text-center">
                                            <h5>কর্মী</h5>
                                            <p class="mb-0">৩০+</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-primary mt-3">বিস্তারিত দেখুন</a>
                        </div>
                    </div>
                </div>

                <!-- Orphanage Item -->
                <div class="orphanage-item mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">মাদরাসাতুল ইতাম</h3>
                            <div class="orphanage-info">
                                <p><i class="fas fa-map-marker-alt"></i> চট্টগ্রাম, বাংলাদেশ</p>
                                <p><i class="fas fa-phone"></i> +880 1234-567890</p>
                                <p><i class="fas fa-envelope"></i> info@example.com</p>
                            </div>
                            <div class="orphanage-details mt-3">
                                <h4>সুবিধাসমূহ</h4>
                                <ul>
                                    <li>আবাসিক সুবিধা</li>
                                    <li>শিক্ষা ব্যবস্থা</li>
                                    <li>খাবার ব্যবস্থা</li>
                                    <li>চিকিৎসা সেবা</li>
                                    <li>ক্রীড়া সুবিধা</li>
                                </ul>
                            </div>
                            <div class="orphanage-stats mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stat-item text-center">
                                            <h5>মোট শিশু</h5>
                                            <p class="mb-0">১২০+</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-item text-center">
                                            <h5>শিক্ষক</h5>
                                            <p class="mb-0">১৫+</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-item text-center">
                                            <h5>কর্মী</h5>
                                            <p class="mb-0">২৫+</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-primary mt-3">বিস্তারিত দেখুন</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donation Section -->
            <div class="donation-section mt-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">দান-সাদকা</h3>
                        <p>এতিম শিশুদের জন্য আপনার দান-সাদকা প্রদান করুন। আল্লাহ তায়ালা আপনার মাল-সম্পদে বরকত দান করুন।</p>
                        <div class="bank-info mt-3">
                            <h5>ব্যাংক একাউন্ট</h5>
                            <p><strong>ব্যাংকের নাম:</strong> ইসলামী ব্যাংক বাংলাদেশ লিমিটেড</p>
                            <p><strong>একাউন্ট নাম:</strong> জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ</p>
                            <p><strong>একাউন্ট নম্বর:</strong> 123456789</p>
                        </div>
                        <a href="{{ route('contact.index') }}" class="btn btn-success mt-3">যোগাযোগ করুন</a>
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
                        <li><a href="{{ route('institutions.madrasas') }}" class="text-decoration-none">মাদরাসা সমূহ</a></li>
                        <li><a href="{{ route('institutions.mosques') }}" class="text-decoration-none">মসজিদ সমূহ</a></li>
                        <li><a href="{{ route('institutions.libraries') }}" class="text-decoration-none">লাইব্রেরি সমূহ</a></li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">স্বেচ্ছাসেবক হোন</h4>
                    <p>এতিম শিশুদের সেবায় স্বেচ্ছাসেবক হিসেবে যুক্ত হতে চাইলে যোগাযোগ করুন।</p>
                    <a href="{{ route('contact.index') }}" class="btn btn-primary">যোগাযোগ করুন</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
