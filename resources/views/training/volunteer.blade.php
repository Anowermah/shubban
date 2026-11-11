@extends('layouts.page')

@section('title', 'ভলান্টিয়ার ট্রেনিং')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>ভলান্টিয়ার প্রশিক্ষণ প্রোগ্রাম</h2>
                
                <div class="volunteer-section">
                    <!-- বেসিক ভলান্টিয়ার ট্রেনিং -->
                    <div class="volunteer-category mb-5">
                        <h3 class="text-success mb-4">
                            <i class="fas fa-hands-helping me-2"></i>বেসিক ভলান্টিয়ার ট্রেনিং
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="volunteer-card">
                                    <div class="card-header">
                                        <h5>ভলান্টিয়ারিং ফান্ডামেন্টালস</h5>
                                        <span class="duration">১ সপ্তাহ</span>
                                    </div>
                                    <div class="card-content">
                                        <p>মৌলিক ভলান্টিয়ার দক্ষতা অর্জন</p>
                                        <ul class="feature-list">
                                            <li>ভলান্টিয়ারিং নীতিমালা</li>
                                            <li>দলগত কাজ</li>
                                            <li>যোগাযোগ দক্ষতা</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="volunteer-card">
                                    <div class="card-header">
                                        <h5>ইভেন্ট ম্যানেজমেন্ট</h5>
                                        <span class="duration">২ সপ্তাহ</span>
                                    </div>
                                    <div class="card-content">
                                        <p>ইভেন্ট পরিকল্পনা ও বাস্তবায়ন</p>
                                        <ul class="feature-list">
                                            <li>ইভেন্ট প্ল্যানিং</li>
                                            <li>টিম কোর্ডিনেশন</li>
                                            <li>রিসোর্স ম্যানেজমেন্ট</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- স্পেশালাইজড ট্রেনিং -->
                    <div class="volunteer-category mb-5">
                        <h3 class="text-primary mb-4">
                            <i class="fas fa-user-md me-2"></i>স্পেশালাইজড ট্রেনিং
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="volunteer-card">
                                    <div class="card-header">
                                        <h5>মেডিক্যাল ভলান্টিয়ারিং</h5>
                                        <span class="duration">১ মাস</span>
                                    </div>
                                    <div class="card-content">
                                        <p>মেডিক্যাল ক্যাম্প ম্যানেজমেন্ট</p>
                                        <ul class="feature-list">
                                            <li>প্রাথমিক চিকিৎসা</li>
                                            <li>হেলথ কেয়ার সাপোর্ট</li>
                                            <li>ইমারজেন্সি রেসপন্স</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="volunteer-card">
                                    <div class="card-header">
                                        <h5>এডুকেশন ভলান্টিয়ারিং</h5>
                                        <span class="duration">১ মাস</span>
                                    </div>
                                    <div class="card-content">
                                        <p>শিক্ষা কার্যক্রম পরিচালনা</p>
                                        <ul class="feature-list">
                                            <li>শিক্ষণ পদ্ধতি</li>
                                            <li>কোর্স প্ল্যানিং</li>
                                            <li>স্টুডেন্ট মেন্টরিং</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- লিডারশিপ ট্রেনিং -->
                    <div class="volunteer-category">
                        <h3 class="text-info mb-4">
                            <i class="fas fa-users me-2"></i>লিডারশিপ ট্রেনিং
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="volunteer-card">
                                    <div class="card-header">
                                        <h5>টিম লিডারশিপ</h5>
                                        <span class="duration">২ সপ্তাহ</span>
                                    </div>
                                    <div class="card-content">
                                        <p>ভলান্টিয়ার টিম পরিচালনা</p>
                                        <ul class="feature-list">
                                            <li>টিম বিল্ডিং</li>
                                            <li>কনফ্লিক্ট রেজোলিউশন</li>
                                            <li>মোটিভেশনাল স্কিলস</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="volunteer-card">
                                    <div class="card-header">
                                        <h5>প্রজেক্ট ম্যানেজমেন্ট</h5>
                                        <span class="duration">১ মাস</span>
                                    </div>
                                    <div class="card-content">
                                        <p>প্রকল্প পরিকল্পনা ও বাস্তবায়ন</p>
                                        <ul class="feature-list">
                                            <li>প্রজেক্ট প্ল্যানিং</li>
                                            <li>বাজেট ম্যানেজমেন্ট</li>
                                            <li>রিপোর্টিং</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">ভলান্টিয়ার রেজিস্ট্রেশন</h4>
                    <p>ভলান্টিয়ার হিসেবে যোগ দিন</p>
                    <div class="text-center">
                        <a href="{{ route('contact.index') }}" class="btn btn-success">রেজিস্টার করুন</a>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">অন্যান্য ট্রেনিং</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('training.courses') }}" class="text-decoration-none">ইসলামিক কোর্স</a></li>
                        <li><a href="{{ route('training.career') }}" class="text-decoration-none">ক্যারিয়ার ট্রেনিং</a></li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">আপকামিং প্রোগ্রাম</h4>
                    <p>আগামী ভলান্টিয়ার প্রোগ্রামের তথ্য জানুন</p>
                    <a href="#" class="btn btn-outline-primary">প্রোগ্রাম দেখুন</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .volunteer-card {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .volunteer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .card-header {
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h5 {
        color: #2c3e50;
        margin: 0;
    }

    .duration {
        background: #e1f5fe;
        color: #0288d1;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9em;
    }

    .feature-list {
        list-style: none;
        padding-left: 0;
        margin-top: 15px;
    }

    .feature-list li {
        padding: 5px 0;
        color: #666;
    }

    .feature-list li:before {
        content: "•";
        color: #28a745;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    .volunteer-category h3 {
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
</style>
@endsection
@endsection
