@extends('layouts.page')

@section('title', 'সেমিনার')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>সেমিনার</h2>
                
                <!-- আসন্ন সেমিনার -->
                <div class="upcoming-section mb-5">
                    <h3 class="text-success mb-4">
                        <i class="fas fa-calendar-alt me-2"></i>আসন্ন সেমিনার
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="seminar-card">
                                <div class="date-badge">
                                    <span class="date">১০</span>
                                    <span class="month">মার্চ</span>
                                </div>
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="সেমিনার" class="img-fluid rounded mb-3">
                                <div class="seminar-details">
                                    <h4>ইসলামি শিক্ষার গুরুত্ব</h4>
                                    <p class="text-muted">
                                        <i class="fas fa-map-marker-alt me-2"></i>শুবান প্রধান কার্যালয়
                                    </p>
                                    <p class="text-muted">
                                        <i class="fas fa-clock me-2"></i>সকাল ১০:০০ - দুপুর ২:০০
                                    </p>
                                    <p class="description">
                                        বর্তমান যুগে ইসলামি শিক্ষার প্রয়োজনীয়তা এবং এর প্রভাব নিয়ে আলোচনা।
                                    </p>
                                    <a href="#" class="btn btn-primary">রেজিস্ট্রেশন করুন</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="seminar-card">
                                <div class="date-badge">
                                    <span class="date">১৫</span>
                                    <span class="month">মার্চ</span>
                                </div>
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="সেমিনার" class="img-fluid rounded mb-3">
                                <div class="seminar-details">
                                    <h4>দাওয়াহ পদ্ধতি</h4>
                                    <p class="text-muted">
                                        <i class="fas fa-map-marker-alt me-2"></i>বায়তুল মোকাররম
                                    </p>
                                    <p class="text-muted">
                                        <i class="fas fa-clock me-2"></i>বিকাল ৩:০০ - সন্ধ্যা ৭:০০
                                    </p>
                                    <p class="description">
                                        আধুনিক যুগে দাওয়াহ পদ্ধতি এবং প্রযুক্তির ব্যবহার নিয়ে আলোচনা।
                                    </p>
                                    <a href="#" class="btn btn-primary">রেজিস্ট্রেশন করুন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- পূর্ববর্তী সেমিনার -->
                <div class="previous-section">
                    <h3 class="text-primary mb-4">
                        <i class="fas fa-history me-2"></i>পূর্ববর্তী সেমিনার
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="seminar-card">
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="সেমিনার" class="img-fluid rounded mb-3">
                                <div class="seminar-details">
                                    <h5>ইসলামি ব্যাংকিং</h5>
                                    <p class="text-muted small">
                                        <i class="fas fa-calendar-alt me-2"></i>১ ফেব্রুয়ারি, ২০২৫
                                    </p>
                                    <p class="description">
                                        ইসলামি ব্যাংকিং সিস্টেম এবং এর সুবিধা নিয়ে বিস্তারিত আলোচনা।
                                    </p>
                                    <a href="#" class="btn btn-outline-primary btn-sm">বিস্তারিত দেখুন</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="seminar-card">
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="সেমিনার" class="img-fluid rounded mb-3">
                                <div class="seminar-details">
                                    <h5>পারিবারিক জীবন</h5>
                                    <p class="text-muted small">
                                        <i class="fas fa-calendar-alt me-2"></i>১৫ জানুয়ারি, ২০২৫
                                    </p>
                                    <p class="description">
                                        ইসলামি পারিবারিক জীবন এবং সামাজিক মূল্যবোধ নিয়ে আলোচনা।
                                    </p>
                                    <a href="#" class="btn btn-outline-primary btn-sm">বিস্তারিত দেখুন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- বক্তাগণ -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">বক্তাগণ</h4>
                    <div class="speakers-list">
                        <div class="speaker-item d-flex align-items-center mb-3">
                            <img src="{{ asset('images/placeholder.jpg') }}" alt="বক্তা" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0">মাওলানা আব্দুল করিম</h6>
                                <small class="text-muted">ইসলামি গবেষক</small>
                            </div>
                        </div>
                        <div class="speaker-item d-flex align-items-center mb-3">
                            <img src="{{ asset('images/placeholder.jpg') }}" alt="বক্তা" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0">মাওলানা রফিক</h6>
                                <small class="text-muted">ইসলামি চিন্তাবিদ</small>
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
                        <li><i class="fas fa-ticket-alt me-2"></i>রেজিস্ট্রেশন ফি: ২০০৳</li>
                        <li><i class="fas fa-users me-2"></i>সর্বমোট আসন: ১০০</li>
                        <li><i class="fas fa-clock me-2"></i>শেষ তারিখ: ৮ মার্চ, ২০২৫</li>
                    </ul>
                    <a href="#" class="btn btn-success w-100">এখনই রেজিস্ট্রেশন করুন</a>
                </div>
            </div>

            <!-- যোগাযোগ -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">যোগাযোগ</h4>
                    <p>সেমিনার সংক্রান্ত তথ্যের জন্য যোগাযোগ করুন</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i>০১৭XXXXXXXX</li>
                        <li><i class="fas fa-envelope me-2"></i>seminar@shubban.org</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .seminar-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
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

    .seminar-details {
        padding: 15px 0;
    }

    .seminar-details h4 {
        color: #2c3e50;
        margin-bottom: 15px;
    }

    .seminar-details h5 {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .description {
        color: #666;
        margin: 15px 0;
    }

    .speaker-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
</style>
@endsection
@endsection
