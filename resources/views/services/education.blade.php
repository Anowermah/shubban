@extends('layouts.page')

@section('title', 'শিক্ষা সেবা')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>শিক্ষা সেবা</h2>
                
                <!-- চলমান কোর্স -->
                <div class="ongoing-courses mb-5">
                    <h3 class="text-success mb-4">
                        <i class="fas fa-graduation-cap me-2"></i>চলমান কোর্স
                    </h3>
                    <div class="course-card featured">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ asset('images/education/placeholder.jpg') }}" alt="কোর্স" class="img-fluid rounded">
                                <div class="status-badge">ভর্তি চলছে</div>
                            </div>
                            <div class="col-md-7">
                                <div class="course-details">
                                    <h4>আরবি ভাষা শিক্ষা</h4>
                                    <div class="course-meta">
                                        <p><i class="fas fa-clock me-2"></i>সময়কাল: ৬ মাস</p>
                                        <p><i class="fas fa-users me-2"></i>শিক্ষার্থী: ৫০ জন</p>
                                        <p><i class="fas fa-chalkboard-teacher me-2"></i>শিক্ষক: ৫ জন</p>
                                    </div>
                                    <div class="course-features mt-3">
                                        <h5>কোর্সের বৈশিষ্ট্য:</h5>
                                        <ul>
                                            <li>মৌলিক আরবি ব্যাকরণ</li>
                                            <li>কথোপকথন</li>
                                            <li>লিখন দক্ষতা</li>
                                            <li>অনুবাদ</li>
                                        </ul>
                                    </div>
                                    <div class="action-buttons mt-3">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fas fa-user-plus me-1"></i>ভর্তি হোন
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

                <!-- আসন্ন কোর্স -->
                <div class="upcoming-courses mb-5">
                    <h3 class="text-primary mb-4">
                        <i class="fas fa-calendar-alt me-2"></i>আসন্ন কোর্স
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="course-card">
                                <img src="{{ asset('images/education/placeholder.jpg') }}" alt="কোর্স" class="img-fluid rounded mb-3">
                                <div class="course-details">
                                    <h5>ইসলামি ফিকাহ</h5>
                                    <div class="schedule-info">
                                        <p><i class="fas fa-calendar-day me-2"></i>শুরু: ১ এপ্রিল ২০২৫</p>
                                        <p><i class="fas fa-clock me-2"></i>সময়কাল: ৩ মাস</p>
                                    </div>
                                    <div class="action-buttons mt-3">
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fas fa-bell me-1"></i>রিমাইন্ডার সেট করুন
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="course-card">
                                <img src="{{ asset('images/education/placeholder.jpg') }}" alt="কোর্স" class="img-fluid rounded mb-3">
                                <div class="course-details">
                                    <h5>হাদিস শিক্ষা</h5>
                                    <div class="schedule-info">
                                        <p><i class="fas fa-calendar-day me-2"></i>শুরু: ১৫ এপ্রিল ২০২৫</p>
                                        <p><i class="fas fa-clock me-2"></i>সময়কাল: ৪ মাস</p>
                                    </div>
                                    <div class="action-buttons mt-3">
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fas fa-bell me-1"></i>রিমাইন্ডার সেট করুন
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- শিক্ষা উপকরণ -->
                <div class="educational-materials">
                    <h3 class="text-info mb-4">
                        <i class="fas fa-book me-2"></i>শিক্ষা উপকরণ
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="material-card">
                                <img src="{{ asset('images/education/placeholder.jpg') }}" alt="শিক্ষা উপকরণ" class="img-fluid rounded mb-3">
                                <div class="material-details">
                                    <h5>আরবি ব্যাকরণ বই</h5>
                                    <p class="material-info">
                                        <i class="fas fa-file-pdf me-2"></i>PDF ফরম্যাট
                                    </p>
                                    <p class="description">
                                        সহজ পদ্ধতিতে আরবি ব্যাকরণ শিক্ষার বই
                                    </p>
                                    <div class="action-buttons">
                                        <a href="#" class="btn btn-success btn-sm">
                                            <i class="fas fa-download me-1"></i>ডাউনলোড
                                        </a>
                                        <a href="#" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i>প্রিভিউ
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="material-card">
                                <img src="{{ asset('images/education/placeholder.jpg') }}" alt="শিক্ষা উপকরণ" class="img-fluid rounded mb-3">
                                <div class="material-details">
                                    <h5>কুরআন শিক্ষা ভিডিও</h5>
                                    <p class="material-info">
                                        <i class="fas fa-video me-2"></i>ভিডিও সিরিজ
                                    </p>
                                    <p class="description">
                                        সহজ পদ্ধতিতে কুরআন শিক্ষার ভিডিও টিউটোরিয়াল
                                    </p>
                                    <div class="action-buttons">
                                        <a href="#" class="btn btn-success btn-sm">
                                            <i class="fas fa-play me-1"></i>দেখুন
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
            <!-- কোর্স রেজিস্ট্রেশন -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">কোর্স রেজিস্ট্রেশন</h4>
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label class="form-label">কোর্স নির্বাচন</label>
                            <select class="form-select">
                                <option>আরবি ভাষা শিক্ষা</option>
                                <option>ইসলামি ফিকাহ</option>
                                <option>হাদিস শিক্ষা</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ব্যাচ</label>
                            <select class="form-select">
                                <option>সকাল ব্যাচ (৯:০০ - ১২:০০)</option>
                                <option>বিকাল ব্যাচ (৩:০০ - ৬:০০)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-user-plus me-1"></i>রেজিস্ট্রেশন করুন
                        </button>
                    </form>
                </div>
            </div>

            <!-- অনলাইন ক্লাস -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">অনলাইন ক্লাস</h4>
                    <div class="online-class-info">
                        <p><i class="fas fa-video me-2"></i>লাইভ ক্লাস</p>
                        <p><i class="fas fa-file-video me-2"></i>রেকর্ডেড ক্লাস</p>
                        <p><i class="fas fa-question-circle me-2"></i>প্রশ্নোত্তর সেশন</p>
                    </div>
                    <a href="#" class="btn btn-primary w-100 mt-3">
                        <i class="fas fa-laptop me-1"></i>ক্লাসে যোগ দিন
                    </a>
                </div>
            </div>

            <!-- যোগাযোগ -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">যোগাযোগ</h4>
                    <p>শিক্ষা সংক্রান্ত তথ্যের জন্য যোগাযোগ করুন</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i>০১৭XXXXXXXX</li>
                        <li><i class="fas fa-envelope me-2"></i>education@shubban.org</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>শিক্ষা বিভাগ, শুবান</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .course-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        position: relative;
        padding: 20px;
    }

    .course-card.featured {
        border: 2px solid #28a745;
    }

    .status-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #28a745;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .course-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .course-details {
        padding: 15px 0;
    }

    .course-meta {
        color: #666;
        font-size: 0.9rem;
        margin: 15px 0;
    }

    .course-features ul {
        list-style: none;
        padding-left: 0;
    }

    .course-features ul li {
        margin-bottom: 5px;
        color: #666;
    }

    .course-features ul li:before {
        content: "•";
        color: #28a745;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    .material-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 15px;
    }

    .material-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .material-info {
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

    .online-class-info p {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 10px;
        color: #666;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
</style>
@endsection
@endsection
