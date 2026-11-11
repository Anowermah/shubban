@extends('layouts.page')

@section('title', 'ওয়ার্কশপ')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>ওয়ার্কশপ</h2>
                
                <!-- আসন্ন ওয়ার্কশপ -->
                <div class="upcoming-section mb-5">
                    <h3 class="text-success mb-4">
                        <i class="fas fa-calendar-alt me-2"></i>আসন্ন ওয়ার্কশপ
                    </h3>
                    <div class="workshop-card featured">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="ওয়ার্কশপ" class="img-fluid rounded">
                                <div class="date-badge">
                                    <span class="date">২০</span>
                                    <span class="month">মার্চ</span>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="workshop-details">
                                    <h4>ডিজিটাল দাওয়াহ</h4>
                                    <div class="meta-info">
                                        <p><i class="fas fa-map-marker-alt me-2"></i>শুবান ডিজিটাল ল্যাব</p>
                                        <p><i class="fas fa-clock me-2"></i>সকাল ১০:০০ - বিকাল ৪:০০</p>
                                        <p><i class="fas fa-users me-2"></i>সর্বোচ্চ ২০ জন</p>
                                    </div>
                                    <div class="workshop-topics mt-3">
                                        <h5>আলোচ্য বিষয়:</h5>
                                        <ul class="topics-list">
                                            <li>সোশ্যাল মিডিয়া ব্যবহার</li>
                                            <li>ভিডিও কনটেন্ট তৈরি</li>
                                            <li>অনলাইন প্লাটফর্ম ব্যবস্থাপনা</li>
                                            <li>ডিজিটাল মার্কেটিং</li>
                                        </ul>
                                    </div>
                                    <a href="#" class="btn btn-primary mt-3">রেজিস্ট্রেশন করুন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- চলমান ওয়ার্কশপ -->
                <div class="ongoing-section mb-5">
                    <h3 class="text-info mb-4">
                        <i class="fas fa-play-circle me-2"></i>চলমান ওয়ার্কশপ
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="workshop-card">
                                <div class="progress-badge">৭৫% সম্পন্ন</div>
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="ওয়ার্কশপ" class="img-fluid rounded mb-3">
                                <div class="workshop-details">
                                    <h5>ইসলামি ক্যালিগ্রাফি</h5>
                                    <p class="text-muted small">
                                        <i class="fas fa-calendar-alt me-2"></i>১ মার্চ - ৩০ মার্চ, ২০২৫
                                    </p>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <a href="#" class="btn btn-outline-primary btn-sm">বিস্তারিত দেখুন</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="workshop-card">
                                <div class="progress-badge">৫০% সম্পন্ন</div>
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="ওয়ার্কশপ" class="img-fluid rounded mb-3">
                                <div class="workshop-details">
                                    <h5>ইসলামি সঙ্গীত</h5>
                                    <p class="text-muted small">
                                        <i class="fas fa-calendar-alt me-2"></i>১৫ ফেব্রুয়ারি - ১৫ মার্চ, ২০২৫
                                    </p>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <a href="#" class="btn btn-outline-primary btn-sm">বিস্তারিত দেখুন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- সম্পন্ন ওয়ার্কশপ -->
                <div class="completed-section">
                    <h3 class="text-primary mb-4">
                        <i class="fas fa-check-circle me-2"></i>সম্পন্ন ওয়ার্কশপ
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="workshop-card">
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="ওয়ার্কশপ" class="img-fluid rounded mb-3">
                                <div class="workshop-details">
                                    <h5>ইসলামি আর্কিটেকচার</h5>
                                    <p class="text-muted small">
                                        <i class="fas fa-calendar-alt me-2"></i>জানুয়ারি ২০২৫
                                    </p>
                                    <p class="description">
                                        ইসলামি স্থাপত্য শিল্প এবং এর ঐতিহ্য সংরক্ষণ বিষয়ক ওয়ার্কশপ।
                                    </p>
                                    <a href="#" class="btn btn-outline-primary btn-sm">গ্যালারি দেখুন</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="workshop-card">
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="ওয়ার্কশপ" class="img-fluid rounded mb-3">
                                <div class="workshop-details">
                                    <h5>ইসলামি চিত্রকলা</h5>
                                    <p class="text-muted small">
                                        <i class="fas fa-calendar-alt me-2"></i>ডিসেম্বর ২০২৪
                                    </p>
                                    <p class="description">
                                        ইসলামি আর্ট এবং ডিজাইন প্রিন্সিপাল নিয়ে ব্যবহারিক ওয়ার্কশপ।
                                    </p>
                                    <a href="#" class="btn btn-outline-primary btn-sm">গ্যালারি দেখুন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- প্রশিক্ষক -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">প্রশিক্ষক</h4>
                    <div class="trainer-list">
                        <div class="trainer-item d-flex align-items-center mb-3">
                            <img src="{{ asset('images/placeholder.jpg') }}" alt="প্রশিক্ষক" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0">মাওলানা ইমরান</h6>
                                <small class="text-muted">ডিজিটাল মিডিয়া বিশেষজ্ঞ</small>
                            </div>
                        </div>
                        <div class="trainer-item d-flex align-items-center">
                            <img src="{{ asset('images/placeholder.jpg') }}" alt="প্রশিক্ষক" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0">মাওলানা হাসান</h6>
                                <small class="text-muted">ক্যালিগ্রাফি বিশেষজ্ঞ</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- রেজিস্ট্রেশন তথ্য -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">রেজিস্ট্রেশন তথ্য</h4>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-ticket-alt me-2"></i>রেজিস্ট্রেশন ফি: ১০০০৳</li>
                        <li><i class="fas fa-users me-2"></i>সর্বমোট আসন: ২০</li>
                        <li><i class="fas fa-clock me-2"></i>শেষ তারিখ: ১৮ মার্চ, ২০২৫</li>
                    </ul>
                    <div class="facilities mt-3">
                        <h5>সুবিধাসমূহ:</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>সার্টিফিকেট</li>
                            <li><i class="fas fa-check text-success me-2"></i>প্রয়োজনীয় সামগ্রী</li>
                            <li><i class="fas fa-check text-success me-2"></i>খাবার</li>
                        </ul>
                    </div>
                    <a href="#" class="btn btn-success w-100">এখনই রেজিস্ট্রেশন করুন</a>
                </div>
            </div>

            <!-- যোগাযোগ -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">যোগাযোগ</h4>
                    <p>ওয়ার্কশপ সংক্রান্ত তথ্যের জন্য যোগাযোগ করুন</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i>০১৭XXXXXXXX</li>
                        <li><i class="fas fa-envelope me-2"></i>workshop@shubban.org</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .workshop-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }

    .workshop-card.featured {
        border: 2px solid #28a745;
    }

    .date-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #28a745;
        color: white;
        padding: 10px;
        border-radius: 8px;
        text-align: center;
        min-width: 60px;
    }

    .date-badge .date {
        font-size: 1.5rem;
        font-weight: bold;
        display: block;
        line-height: 1;
    }

    .date-badge .month {
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .progress-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #17a2b8;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .workshop-details {
        padding: 15px 0;
    }

    .workshop-details h4 {
        color: #2c3e50;
        margin-bottom: 15px;
    }

    .workshop-details h5 {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .meta-info p {
        color: #666;
        margin-bottom: 5px;
    }

    .topics-list {
        list-style: none;
        padding-left: 0;
    }

    .topics-list li {
        padding: 5px 0;
        color: #666;
    }

    .topics-list li:before {
        content: "•";
        color: #28a745;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    .description {
        color: #666;
        margin: 15px 0;
    }

    .trainer-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .progress {
        height: 8px;
        border-radius: 4px;
    }
</style>
@endsection
@endsection
