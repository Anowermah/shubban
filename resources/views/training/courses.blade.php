@extends('layouts.page')

@section('title', 'প্রশিক্ষণ কোর্স')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>আমাদের প্রশিক্ষণ কোর্সসমূহ</h2>
                
                <div class="courses-section">
                    <!-- ইসলামিক স্টাডিজ কোর্স -->
                    <div class="course-category mb-5">
                        <h3 class="text-success mb-4">
                            <i class="fas fa-book-reader me-2"></i>ইসলামিক স্টাডিজ
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="course-card">
                                    <div class="course-header">
                                        <h5>কুরআন শিক্ষা কোর্স</h5>
                                        <span class="duration">৬ মাস</span>
                                    </div>
                                    <div class="course-content">
                                        <p>সঠিক কুরআন তিলাওয়াত ও তাজবীদ শিক্ষা</p>
                                        <ul class="course-features">
                                            <li>তাজবীদ নিয়ম</li>
                                            <li>মাখরাজ শিক্ষা</li>
                                            <li>কুরআন হিফজ</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="course-card">
                                    <div class="course-header">
                                        <h5>হাদীস শিক্ষা কোর্স</h5>
                                        <span class="duration">১ বছর</span>
                                    </div>
                                    <div class="course-content">
                                        <p>হাদীস অধ্যয়ন ও গবেষণা</p>
                                        <ul class="course-features">
                                            <li>হাদীস শাস্ত্র পরিচিতি</li>
                                            <li>বুখারী শরীফ</li>
                                            <li>মুসলিম শরীফ</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- দাওয়াহ ট্রেনিং -->
                    <div class="course-category mb-5">
                        <h3 class="text-primary mb-4">
                            <i class="fas fa-bullhorn me-2"></i>দাওয়াহ ট্রেনিং
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="course-card">
                                    <div class="course-header">
                                        <h5>দাঈ প্রশিক্ষণ</h5>
                                        <span class="duration">৩ মাস</span>
                                    </div>
                                    <div class="course-content">
                                        <p>দাওয়াহ পদ্ধতি ও কৌশল শিক্ষা</p>
                                        <ul class="course-features">
                                            <li>দাওয়াহ পদ্ধতি</li>
                                            <li>যোগাযোগ দক্ষতা</li>
                                            <li>প্রেজেন্টেশন স্কিল</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="course-card">
                                    <div class="course-header">
                                        <h5>খতিব প্রশিক্ষণ</h5>
                                        <span class="duration">৬ মাস</span>
                                    </div>
                                    <div class="course-content">
                                        <p>জুমার খুতবা ও ওয়াজ প্রশিক্ষণ</p>
                                        <ul class="course-features">
                                            <li>খুতবা প্রস্তুতি</li>
                                            <li>বক্তৃতা কৌশল</li>
                                            <li>শ্রোতা ব্যবস্থাপনা</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- লাইফ স্কিল ট্রেনিং -->
                    <div class="course-category">
                        <h3 class="text-info mb-4">
                            <i class="fas fa-user-graduate me-2"></i>লাইফ স্কিল ট্রেনিং
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="course-card">
                                    <div class="course-header">
                                        <h5>লিডারশিপ ট্রেনিং</h5>
                                        <span class="duration">১ মাস</span>
                                    </div>
                                    <div class="course-content">
                                        <p>ইসলামী নেতৃত্ব বিকাশ প্রশিক্ষণ</p>
                                        <ul class="course-features">
                                            <li>নেতৃত্বের গুণাবলী</li>
                                            <li>সংগঠন ব্যবস্থাপনা</li>
                                            <li>সিদ্ধান্ত গ্রহণ</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="course-card">
                                    <div class="course-header">
                                        <h5>যুব প্রশিক্ষণ</h5>
                                        <span class="duration">২ মাস</span>
                                    </div>
                                    <div class="course-content">
                                        <p>যুব সমাজের জন্য বিশেষ প্রশিক্ষণ</p>
                                        <ul class="course-features">
                                            <li>ব্যক্তিত্ব বিকাশ</li>
                                            <li>সময় ব্যবস্থাপনা</li>
                                            <li>কমিউনিকেশন স্কিল</li>
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
                    <h4 class="card-title">কোর্স রেজিস্ট্রেশন</h4>
                    <p>আপনার পছন্দের কোর্সে ভর্তি হতে যোগাযোগ করুন</p>
                    <div class="text-center">
                        <a href="{{ route('contact.index') }}" class="btn btn-primary">যোগাযোগ করুন</a>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">অন্যান্য প্রশিক্ষণ</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('training.career') }}" class="text-decoration-none">ক্যারিয়ার ট্রেনিং</a></li>
                        <li><a href="{{ route('training.volunteer') }}" class="text-decoration-none">ভলান্টিয়ার ট্রেনিং</a></li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">প্রশিক্ষণ ক্যালেন্ডার</h4>
                    <p>আগামী প্রশিক্ষণ সেশনের সময়সূচী দেখুন</p>
                    <a href="#" class="btn btn-outline-primary">ক্যালেন্ডার দেখুন</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .course-card {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .course-header {
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .course-header h5 {
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

    .course-features {
        list-style: none;
        padding-left: 0;
        margin-top: 15px;
    }

    .course-features li {
        padding: 5px 0;
        color: #666;
    }

    .course-features li:before {
        content: "•";
        color: #28a745;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    .course-category h3 {
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
