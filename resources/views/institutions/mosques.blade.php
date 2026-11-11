@extends('layouts.app')

@section('title', __('messages.mosques'))

@section('page-styles')
    @include('layouts.styles.institutions')
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <h2 class="section-title mb-4">{{ __('messages.mosques') }}</h2>
            
            <!-- List of Mosques -->
            <div class="mosque-list">
                <!-- Mosque Item -->
                <div class="mosque-item mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">মসজিদুল আকসা</h3>
                            <div class="mosque-info">
                                <p><i class="fas fa-map-marker-alt"></i> ঢাকা, বাংলাদেশ</p>
                                <p><i class="fas fa-phone"></i> +880 1234-567890</p>
                                <p><i class="fas fa-clock"></i> ফজর: ৫:০০ AM | যোহর: ১:৩০ PM | আসর: ৪:৩০ PM | মাগরিব: সূর্যাস্ত | ইশা: ৮:০০ PM</p>
                            </div>
                            <div class="mosque-details mt-3">
                                <h4>সুবিধাসমূহ</h4>
                                <ul>
                                    <li>নামাযের হল</li>
                                    <li>ওযুখানা</li>
                                    <li>লাইব্রেরি</li>
                                    <li>মাদরাসা</li>
                                </ul>
                            </div>
                            <a href="#" class="btn btn-primary mt-3">বিস্তারিত দেখুন</a>
                        </div>
                    </div>
                </div>

                <!-- Mosque Item -->
                <div class="mosque-item mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">বায়তুল মামুর</h3>
                            <div class="mosque-info">
                                <p><i class="fas fa-map-marker-alt"></i> চট্টগ্রাম, বাংলাদেশ</p>
                                <p><i class="fas fa-phone"></i> +880 1234-567890</p>
                                <p><i class="fas fa-clock"></i> ফজর: ৫:০০ AM | যোহর: ১:৩০ PM | আসর: ৪:৩০ PM | মাগরিব: সূর্যাস্ত | ইশা: ৮:০০ PM</p>
                            </div>
                            <div class="mosque-details mt-3">
                                <h4>সুবিধাসমূহ</h4>
                                <ul>
                                    <li>নামাযের হল</li>
                                    <li>ওযুখানা</li>
                                    <li>লাইব্রেরি</li>
                                    <li>মাদরাসা</li>
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
                        <li><a href="{{ route('institutions.madrasas') }}" class="text-decoration-none">মাদরাসা সমূহ</a></li>
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
