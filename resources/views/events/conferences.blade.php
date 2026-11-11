@extends('layouts.app')

@section('title', __('messages.conferences'))

@section('page-styles')
    @include('layouts.styles.events')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>কনফারেন্স</h2>
                
                <!-- আসন্ন কনফারেন্স -->
                <div class="upcoming-section mb-5">
                    <h3 class="text-success mb-4">
                        <i class="fas fa-calendar-alt me-2"></i>আসন্ন কনফারেন্স
                    </h3>
                    <div class="conference-card">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="কনফারেন্স" class="img-fluid rounded">
                                <div class="date-badge">
                                    <span class="date">২৫</span>
                                    <span class="month">মার্চ</span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="conference-details">
                                    <h4>ইসলামি শিক্ষা ও সমাজ উন্নয়ন</h4>
                                    <p class="text-muted">
                                        <i class="fas fa-map-marker-alt me-2"></i>ঢাকা ইন্টারন্যাশনাল কনভেনশন সেন্টার
                                    </p>
                                    <p class="text-muted">
                                        <i class="fas fa-clock me-2"></i>সকাল ৯:০০ - বিকাল ৫:০০
                                    </p>
                                    <p class="description">
                                        বর্তমান সমাজে ইসলামি শিক্ষার প্রভাব এবং সামাজিক উন্নয়নে এর ভূমিকা নিয়ে আলোচনা।
                                    </p>
                                    <a href="#" class="btn btn-primary">রেজিস্ট্রেশন করুন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- পূর্ববর্তী কনফারেন্স -->
                <div class="previous-section">
                    <h3 class="text-primary mb-4">
                        <i class="fas fa-history me-2"></i>পূর্ববর্তী কনফারেন্স
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="conference-card">
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="কনফারেন্স" class="img-fluid rounded mb-3">
                                <div class="conference-details">
                                    <h5>ইসলামি অর্থনীতি</h5>
                                    <p class="text-muted small">
                                        <i class="fas fa-calendar-alt me-2"></i>১৫ ফেব্রুয়ারি, ২০২৫
                                    </p>
                                    <p class="description">
                                        ইসলামি অর্থনীতির মূলনীতি এবং বর্তমান বিশ্বে এর প্রাসঙ্গিকতা নিয়ে আলোচনা।
                                    </p>
                                    <a href="#" class="btn btn-outline-primary btn-sm">বিস্তারিত দেখুন</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="conference-card">
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="কনফারেন্স" class="img-fluid rounded mb-3">
                                <div class="conference-details">
                                    <h5>যুব সমাজের চ্যালেঞ্জ</h5>
                                    <p class="text-muted small">
                                        <i class="fas fa-calendar-alt me-2"></i>১ জানুয়ারি, ২০২৫
                                    </p>
                                    <p class="description">
                                        বর্তমান যুব সমাজের সামনে বিভিন্ন চ্যালেঞ্জ এবং তার সমাধান নিয়ে আলোচনা।
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
            <!-- কনফারেন্স স্থান -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">কনফারেন্স স্থান</h4>
                    <div class="venue-info">
                        <p><i class="fas fa-map-marker-alt me-2"></i>ঢাকা ইন্টারন্যাশনাল কনভেনশন সেন্টার</p>
                        <address>
                            প্লট: ১/বি, আগারগাঁও<br>
                            শেরে বাংলা নগর<br>
                            ঢাকা-১২০৭
                        </address>
                    </div>
                </div>
            </div>

            <!-- রেজিস্ট্রেশন তথ্য -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">রেজিস্ট্রেশন তথ্য</h4>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-ticket-alt me-2"></i>রেজিস্ট্রেশন ফি: ৫০০৳</li>
                        <li><i class="fas fa-users me-2"></i>সর্বমোট আসন: ৫০০</li>
                        <li><i class="fas fa-clock me-2"></i>শেষ তারিখ: ২০ মার্চ, ২০২৫</li>
                    </ul>
                    <a href="#" class="btn btn-success w-100">এখনই রেজিস্ট্রেশন করুন</a>
                </div>
            </div>

            <!-- যোগাযোগ -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">যোগাযোগ</h4>
                    <p>কনফারেন্স সংক্রান্ত তথ্যের জন্য যোগাযোগ করুন</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i>০১৭XXXXXXXX</li>
                        <li><i class="fas fa-envelope me-2"></i>conference@shubban.org</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
