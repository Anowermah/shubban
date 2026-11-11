@extends('layouts.page')

@section('title', 'চিকিৎসা সেবা')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>চিকিৎসা সেবা</h2>
                
                <!-- আসন্ন মেডিকেল ক্যাম্প -->
                <div class="upcoming-camps mb-5">
                    <h3 class="text-success mb-4">
                        <i class="fas fa-clinic-medical me-2"></i>আসন্ন মেডিকেল ক্যাম্প
                    </h3>
                    <div class="medical-card featured">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ asset('images/medical/placeholder.jpg') }}" alt="মেডিকেল ক্যাম্প" class="img-fluid rounded">
                                <div class="date-badge">২৫ মার্চ</div>
                            </div>
                            <div class="col-md-7">
                                <div class="camp-details">
                                    <h4>বিনামূল্যে স্বাস্থ্য পরীক্ষা</h4>
                                    <div class="camp-meta">
                                        <p><i class="fas fa-map-marker-alt me-2"></i>স্থান: শুবান মেডিকেল সেন্টার, ঢাকা</p>
                                        <p><i class="fas fa-clock me-2"></i>সময়: সকাল ৯:০০ - বিকাল ৫:০০</p>
                                        <p><i class="fas fa-user-md me-2"></i>বিশেষজ্ঞ ডাক্তার: ১০ জন</p>
                                    </div>
                                    <div class="services-offered mt-3">
                                        <h5>সেবাসমূহ:</h5>
                                        <ul>
                                            <li>সাধারণ স্বাস্থ্য পরীক্ষা</li>
                                            <li>ডায়াবেটিস পরীক্ষা</li>
                                            <li>চক্ষু পরীক্ষা</li>
                                            <li>দাঁতের চিকিৎসা</li>
                                        </ul>
                                    </div>
                                    <div class="action-buttons mt-3">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fas fa-user-plus me-1"></i>রেজিস্ট্রেশন করুন
                                        </a>
                                        <a href="#" class="btn btn-outline-primary">
                                            <i class="fas fa-info-circle me-1"></i>বিস্তারিত
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- নিয়মিত সেবা -->
                <div class="regular-services mb-5">
                    <h3 class="text-primary mb-4">
                        <i class="fas fa-heartbeat me-2"></i>নিয়মিত সেবা
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="service-card">
                                <img src="{{ asset('images/medical/placeholder.jpg') }}" alt="সেবা" class="img-fluid rounded mb-3">
                                <div class="service-details">
                                    <h5>ফ্রি মেডিকেল কনসালটেশন</h5>
                                    <div class="schedule-info">
                                        <p><i class="fas fa-calendar-alt me-2"></i>প্রতি শুক্রবার</p>
                                        <p><i class="fas fa-clock me-2"></i>সকাল ১০:০০ - দুপুর ২:০০</p>
                                    </div>
                                    <div class="action-buttons mt-3">
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fas fa-calendar-check me-1"></i>অ্যাপয়েন্টমেন্ট
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="service-card">
                                <img src="{{ asset('images/medical/placeholder.jpg') }}" alt="সেবা" class="img-fluid rounded mb-3">
                                <div class="service-details">
                                    <h5>হোম কেয়ার সার্ভিস</h5>
                                    <div class="schedule-info">
                                        <p><i class="fas fa-home me-2"></i>বাড়িতে চিকিৎসা সেবা</p>
                                        <p><i class="fas fa-clock me-2"></i>২৪/৭ সেবা</p>
                                    </div>
                                    <div class="action-buttons mt-3">
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fas fa-phone me-1"></i>কল করুন
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ফার্মেসি -->
                <div class="pharmacy-section">
                    <h3 class="text-info mb-4">
                        <i class="fas fa-pills me-2"></i>ফার্মেসি
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="pharmacy-card">
                                <img src="{{ asset('images/medical/placeholder.jpg') }}" alt="ফার্মেসি" class="img-fluid rounded mb-3">
                                <div class="pharmacy-details">
                                    <h5>শুবান ফার্মেসি - মিরপুর</h5>
                                    <p class="schedule-info">
                                        <i class="fas fa-clock me-2"></i>খোলা: সকাল ৮:০০ - রাত ১১:০০
                                    </p>
                                    <p class="description">
                                        সকল ধরনের ঔষধ এবং মেডিকেল সরঞ্জাম পাওয়া যায়।
                                    </p>
                                    <div class="action-buttons">
                                        <a href="#" class="btn btn-success btn-sm">
                                            <i class="fas fa-shopping-cart me-1"></i>অনলাইন অর্ডার
                                        </a>
                                        <a href="#" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-map-marker-alt me-1"></i>লোকেশন
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="pharmacy-card">
                                <img src="{{ asset('images/medical/placeholder.jpg') }}" alt="ফার্মেসি" class="img-fluid rounded mb-3">
                                <div class="pharmacy-details">
                                    <h5>শুবান ফার্মেসি - মতিঝিল</h5>
                                    <p class="schedule-info">
                                        <i class="fas fa-clock me-2"></i>খোলা: সকাল ৮:০০ - রাত ১১:০০
                                    </p>
                                    <p class="description">
                                        সকল ধরনের ঔষধ এবং মেডিকেল সরঞ্জাম পাওয়া যায়।
                                    </p>
                                    <div class="action-buttons">
                                        <a href="#" class="btn btn-success btn-sm">
                                            <i class="fas fa-shopping-cart me-1"></i>অনলাইন অর্ডার
                                        </a>
                                        <a href="#" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-map-marker-alt me-1"></i>লোকেশন
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- জরুরি যোগাযোগ -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">জরুরি যোগাযোগ</h4>
                    <div class="emergency-contacts">
                        <div class="contact-item mb-3">
                            <h5><i class="fas fa-ambulance me-2"></i>অ্যাম্বুলেন্স</h5>
                            <p class="mb-0">হটলাইন: ০১৭XXXXXXXX</p>
                        </div>
                        <div class="contact-item mb-3">
                            <h5><i class="fas fa-user-md me-2"></i>ডাক্তার অন কল</h5>
                            <p class="mb-0">হটলাইন: ০১৮XXXXXXXX</p>
                        </div>
                        <div class="contact-item">
                            <h5><i class="fas fa-pills me-2"></i>২৪/৭ ফার্মেসি</h5>
                            <p class="mb-0">হটলাইন: ০১৯XXXXXXXX</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- অ্যাপয়েন্টমেন্ট -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">অ্যাপয়েন্টমেন্ট</h4>
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label class="form-label">বিভাগ নির্বাচন</label>
                            <select class="form-select">
                                <option>মেডিসিন</option>
                                <option>চক্ষু</option>
                                <option>দন্ত</option>
                                <option>শিশু</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">তারিখ</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">সময়</label>
                            <select class="form-select">
                                <option>সকাল (৯:০০ - ১২:০০)</option>
                                <option>দুপুর (২:০০ - ৫:০০)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-calendar-check me-1"></i>অ্যাপয়েন্টমেন্ট নিন
                        </button>
                    </form>
                </div>
            </div>

            <!-- অনলাইন কনসালটেশন -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">অনলাইন কনসালটেশন</h4>
                    <p>ঘরে বসে ডাক্তারের পরামর্শ নিন</p>
                    <div class="online-consultation-info">
                        <p><i class="fas fa-video me-2"></i>ভিডিও কল</p>
                        <p><i class="fas fa-comments me-2"></i>চ্যাট সাপোর্ট</p>
                        <p><i class="fas fa-file-prescription me-2"></i>ডিজিটাল প্রেসক্রিপশন</p>
                    </div>
                    <a href="#" class="btn btn-primary w-100 mt-3">
                        <i class="fas fa-video me-1"></i>কনসালটেশন শুরু করুন
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .medical-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        position: relative;
        padding: 20px;
    }

    .medical-card.featured {
        border: 2px solid #28a745;
    }

    .date-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #28a745;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .medical-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .camp-details {
        padding: 15px 0;
    }

    .camp-meta {
        color: #666;
        font-size: 0.9rem;
        margin: 15px 0;
    }

    .services-offered ul {
        list-style: none;
        padding-left: 0;
    }

    .services-offered ul li {
        margin-bottom: 5px;
        color: #666;
    }

    .services-offered ul li:before {
        content: "•";
        color: #28a745;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    .service-card, .pharmacy-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 15px;
    }

    .service-card img, .pharmacy-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .schedule-info {
        color: #666;
        font-size: 0.9rem;
        margin: 10px 0;
    }

    .description {
        color: #666;
        margin: 10px 0;
    }

    .action-buttons .btn {
        margin-right: 5px;
    }

    .emergency-contacts .contact-item {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .emergency-contacts h5 {
        color: #dc3545;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    .online-consultation-info p {
        color: #666;
        margin-bottom: 10px;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
</style>
@endsection
@endsection
