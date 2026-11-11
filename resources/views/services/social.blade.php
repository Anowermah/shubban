@extends('layouts.app')

@section('title', 'সামাজিক সেবা - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="content-wrapper">
                <h1 class="section-title mb-4">সামাজিক সেবা কার্যক্রম</h1>

                <!-- Services Overview -->
                <div class="services-overview mb-5">
                    <div class="card">
                        <div class="card-body">
                            <p class="lead">{{ __('messages.social_service_description') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Current Projects -->
                <div class="current-projects mb-5">
                    <h2 class="section-title mb-4">চলমান প্রকল্প সমূহ</h2>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card project-card h-100">
                                <img src="{{ asset('images/services/orphan.jpg') }}" class="card-img-top" alt="ইয়াতিম সেবা">
                                <div class="card-body">
                                    <h3 class="card-title">ইয়াতিম সেবা</h3>
                                    <p class="card-text">{{ __('messages.charity_description') }}</p>
                                    <div class="project-stats mt-3">
                                        <div class="stat">
                                            <span class="stat-value">১৫০+</span>
                                            <span class="stat-label">ইয়াতিম</span>
                                        </div>
                                        <div class="stat">
                                            <span class="stat-value">৫</span>
                                            <span class="stat-label">আবাসিক কেন্দ্র</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('donate.index') }}" class="btn btn-primary mt-3">দান করুন</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card project-card h-100">
                                <img src="{{ asset('images/services/education.jpg') }}" class="card-img-top" alt="শিক্ষা সহায়তা">
                                <div class="card-body">
                                    <h3 class="card-title">শিক্ষা সহায়তা</h3>
                                    <p class="card-text">{{ __('messages.education_service_description') }}</p>
                                    <div class="project-stats mt-3">
                                        <div class="stat">
                                            <span class="stat-value">৫০০+</span>
                                            <span class="stat-label">শিক্ষার্থী</span>
                                        </div>
                                        <div class="stat">
                                            <span class="stat-value">২০</span>
                                            <span class="stat-label">শিক্ষা প্রতিষ্ঠান</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('donate.index') }}" class="btn btn-primary mt-3">দান করুন</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card project-card h-100">
                                <img src="{{ asset('images/services/medical.jpg') }}" class="card-img-top" alt="স্বাস্থ্য সেবা">
                                <div class="card-body">
                                    <h3 class="card-title">স্বাস্থ্য সেবা</h3>
                                    <p class="card-text">{{ __('messages.medical_service_description') }}</p>
                                    <div class="project-stats mt-3">
                                        <div class="stat">
                                            <span class="stat-value">১০০০+</span>
                                            <span class="stat-label">রোগী</span>
                                        </div>
                                        <div class="stat">
                                            <span class="stat-value">৩</span>
                                            <span class="stat-label">স্বাস্থ্য কেন্দ্র</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('donate.index') }}" class="btn btn-primary mt-3">দান করুন</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card project-card h-100">
                                <img src="{{ asset('images/services/relief.jpg') }}" class="card-img-top" alt="ত্রাণ সহায়তা">
                                <div class="card-body">
                                    <h3 class="card-title">ত্রাণ সহায়তা</h3>
                                    <p class="card-text">প্রাকৃতিক দুর্যোগে ক্ষতিগ্রস্তদের সহায়তা প্রদান করা হয়।</p>
                                    <div class="project-stats mt-3">
                                        <div class="stat">
                                            <span class="stat-value">৫০০০+</span>
                                            <span class="stat-label">পরিবার</span>
                                        </div>
                                        <div class="stat">
                                            <span class="stat-value">১০</span>
                                            <span class="stat-label">জেলা</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('donate.index') }}" class="btn btn-primary mt-3">দান করুন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Projects -->
                <div class="upcoming-projects mb-5">
                    <h2 class="section-title mb-4">আগামী প্রকল্প সমূহ</h2>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <i class="fas fa-hospital text-primary me-2"></i>
                                        মেডিকেল কমপ্লেক্স
                                    </h3>
                                    <p class="card-text">ঢাকার যাত্রাবাড়িতে একটি আধুনিক মেডিকেল কমপ্লেক্স নির্মাণ করা হবে।</p>
                                    <div class="project-timeline">
                                        <p><i class="fas fa-calendar-alt me-2"></i>সম্ভাব্য শুরু: জানুয়ারি ২০২৬</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <i class="fas fa-school text-primary me-2"></i>
                                        টেকনিক্যাল ইনস্টিটিউট
                                    </h3>
                                    <p class="card-text">যুব সমাজের কর্মসংস্থানের জন্য একটি কারিগরি প্রশিক্ষণ কেন্দ্র স্থাপন করা হবে।</p>
                                    <div class="project-timeline">
                                        <p><i class="fas fa-calendar-alt me-2"></i>সম্ভাব্য শুরু: মার্চ ২০২৬</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Get Involved -->
                <div class="get-involved">
                    <h2 class="section-title mb-4">যেভাবে সহযোগিতা করতে পারেন</h2>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <i class="fas fa-hand-holding-heart fa-3x text-primary mb-3"></i>
                                    <h4>দান করুন</h4>
                                    <p>{{ __('messages.donate_description') }}</p>
                                    <a href="{{ route('donate.index') }}" class="btn btn-primary mt-2">দান করুন</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                    <h4>স্বেচ্ছাসেবক হোন</h4>
                                    <p>{{ __('messages.contact_description') }}</p>
                                    <a href="{{ route('contact.index') }}" class="btn btn-primary mt-2">যোগাযোগ করুন</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <i class="fas fa-bullhorn fa-3x text-primary mb-3"></i>
                                    <h4>প্রচার করুন</h4>
                                    <p>আমাদের কার্যক্রম সম্পর্কে অন্যদের জানান</p>
                                    <a href="#" class="btn btn-primary mt-2">শেয়ার করুন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sidebar">
                <!-- Donation Info -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-4">দান করুন</h3>
                        <div class="donation-info">
                            <p><strong>ব্যাংক একাউন্ট:</strong></p>
                            <p>ইসলামী ব্যাংক বাংলাদেশ লিমিটেড</p>
                            <p>একাউন্ট নং: 20501234567</p>
                            <p>শাখা: যাত্রাবাড়ী, ঢাকা</p>
                            <a href="{{ route('donate.index') }}" class="btn btn-primary w-100 mt-3">{{ __('messages.donate_project_description') }}</a>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4">যোগাযোগ করুন</h3>
                        <div class="contact-info">
                            <p><i class="fas fa-phone text-primary me-2"></i> +880 1765812261</p>
                            <p><i class="fas fa-envelope text-primary me-2"></i> info@shubbanbd.org</p>
                            <p><i class="fas fa-map-marker-alt text-primary me-2"></i> ৭৯/ক/৩, উত্তর যাত্রাবাড়ি, ঢাকা-১২০৪</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.content-wrapper {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.project-card {
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.project-card:hover {
    transform: translateY(-5px);
}

.project-card .card-img-top {
    height: 200px;
    object-fit: cover;
}

.project-stats {
    display: flex;
    justify-content: space-around;
    text-align: center;
    border-top: 1px solid #eee;
    padding-top: 1rem;
}

.stat-value {
    display: block;
    font-size: 1.5rem;
    font-weight: bold;
    color: #0C4B36;
}

.stat-label {
    display: block;
    font-size: 0.9rem;
    color: #666;
}

.project-timeline {
    margin-top: 1rem;
    color: #666;
}

.donation-info p {
    margin-bottom: 0.5rem;
}

.contact-info p {
    margin-bottom: 1rem;
}
</style>
@endsection
