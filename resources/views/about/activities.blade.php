@extends('layouts.page')

@section('title', 'কার্যক্রম')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>আমাদের কার্যক্রম</h2>
                
                <div class="activities-section">
                    <!-- শিক্ষা কার্যক্রম -->
                    <div class="activity-category mb-5">
                        <h3 class="text-success mb-4">
                            <i class="fas fa-graduation-cap me-2"></i>শিক্ষা কার্যক্রম
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="activity-card">
                                    <h5>কুরআন শিক্ষা</h5>
                                    <p>সঠিক কুরআন তিলাওয়াত ও তাজবীদ শিক্ষা প্রদান</p>
                                    <ul class="activity-features">
                                        <li>তাজবীদ ক্লাস</li>
                                        <li>হিফজ প্রোগ্রাম</li>
                                        <li>তাফসীর শিক্ষা</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="activity-card">
                                    <h5>হাদীস শিক্ষা</h5>
                                    <p>হাদীস শিক্ষা ও গবেষণা কার্যক্রম</p>
                                    <ul class="activity-features">
                                        <li>হাদীস দরস</li>
                                        <li>সীরাত চর্চা</li>
                                        <li>ফিকহ শিক্ষা</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- সামাজিক কার্যক্রম -->
                    <div class="activity-category mb-5">
                        <h3 class="text-primary mb-4">
                            <i class="fas fa-hands-helping me-2"></i>সামাজিক কার্যক্রম
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="activity-card">
                                    <h5>দান-সদকা</h5>
                                    <p>গরীব ও অসহায়দের সহায়তা প্রদান</p>
                                    <ul class="activity-features">
                                        <li>যাকাত বিতরণ</li>
                                        <li>এতিম সেবা</li>
                                        <li>গরীব সহায়তা</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="activity-card">
                                    <h5>স্বাস্থ্যসেবা</h5>
                                    <p>বিনামূল্যে চিকিৎসা সেবা প্রদান</p>
                                    <ul class="activity-features">
                                        <li>মেডিকেল ক্যাম্প</li>
                                        <li>স্বাস্থ্য পরামর্শ</li>
                                        <li>ঔষধ বিতরণ</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- দাওয়াতি কার্যক্রম -->
                    <div class="activity-category mb-5">
                        <h3 class="text-info mb-4">
                            <i class="fas fa-mosque me-2"></i>দাওয়াতি কার্যক্রম
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="activity-card">
                                    <h5>ওয়াজ মাহফিল</h5>
                                    <p>নিয়মিত ওয়াজ মাহফিল আয়োজন</p>
                                    <ul class="activity-features">
                                        <li>সাপ্তাহিক দরস</li>
                                        <li>মাসিক মাহফিল</li>
                                        <li>বিশেষ প্রোগ্রাম</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="activity-card">
                                    <h5>প্রকাশনা</h5>
                                    <p>ইসলামী বই ও পত্রিকা প্রকাশনা</p>
                                    <ul class="activity-features">
                                        <li>মাসিক পত্রিকা</li>
                                        <li>ইসলামী বই</li>
                                        <li>অনলাইন কনটেন্ট</li>
                                    </ul>
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
                    <h4 class="card-title">দ্রুত লিঙ্ক</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about.introduction') }}" class="text-decoration-none">পরিচিতি</a></li>
                        <li><a href="{{ route('about.history') }}" class="text-decoration-none">ইতিহাস</a></li>
                        <li><a href="{{ route('about.committee') }}" class="text-decoration-none">কমিটি</a></li>
                        <li><a href="{{ route('about.goals') }}" class="text-decoration-none">লক্ষ্য ও উদ্দেশ্য</a></li>
                    </ul>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">আপনার অংশগ্রহণ</h4>
                    <p>আমাদের কার্যক্রমে অংশ নিতে চাইলে যোগাযোগ করুন:</p>
                    <div class="text-center">
                        <a href="{{ route('contact.index') }}" class="btn btn-primary">যোগাযোগ করুন</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">সহযোগিতা করুন</h4>
                    <p>আমাদের কার্যক্রমে সহযোগিতা করুন:</p>
                    <a href="{{ route('donate.index') }}" class="btn btn-success">দান করুন</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .activity-card {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .activity-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .activity-card h5 {
        color: #2c3e50;
        margin-bottom: 15px;
    }

    .activity-features {
        list-style: none;
        padding-left: 0;
        margin-top: 15px;
    }

    .activity-features li {
        padding: 5px 0;
        color: #666;
    }

    .activity-features li:before {
        content: "•";
        color: #28a745;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    .activity-category h3 {
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
