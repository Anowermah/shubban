@extends('layouts.app')

@section('title', 'হাদীস শিক্ষা - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="content-wrapper">
                <h1 class="section-title mb-4">হাদীস শিক্ষা</h1>

                <!-- Course Overview -->
                <div class="course-overview mb-5">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-4">কোর্স পরিচিতি</h2>
                            <p>{{ __('messages.hadith_course_description') }}</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.hadith_course_feature1') }}</li>
                                <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.hadith_course_feature2') }}</li>
                                <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.hadith_course_feature3') }}</li>
                            </ul>
                            <a href="{{ route('contact.index') }}" class="btn btn-primary mt-3">ভর্তি হতে যোগাযোগ করুন</a>
                        </div>
                    </div>
                </div>

                <!-- Course Levels -->
                <div class="course-levels mb-5">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <i class="fas fa-book text-primary me-2"></i>
                                        প্রাথমিক স্তর
                                    </h3>
                                    <ul class="course-features mt-3">
                                        <li>মেয়াদ: ৬ মাস</li>
                                        <li>ক্লাস: সপ্তাহে ৩ দিন</li>
                                        <li>বই: রিয়াদুস সালেহীন</li>
                                        <li>ফি: ১২০০ টাকা</li>
                                    </ul>
                                    <a href="{{ route('contact.index') }}" class="btn btn-primary mt-3">ভর্তি হতে যোগাযোগ করুন</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <i class="fas fa-graduation-cap text-primary me-2"></i>
                                        উচ্চতর স্তর
                                    </h3>
                                    <p>{{ __('messages.hadith_advanced_description') }}</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.hadith_advanced_feature1') }}</li>
                                        <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.hadith_advanced_feature2') }}</li>
                                        <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.hadith_advanced_feature3') }}</li>
                                    </ul>
                                    <a href="{{ route('contact.index') }}" class="btn btn-primary mt-3">ভর্তি হতে যোগাযোগ করুন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Study Materials -->
                <div class="study-materials mb-5">
                    <h2 class="section-title mb-4">পাঠ্য বইসমূহ</h2>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card book-card">
                                <img src="{{ asset('images/books/bukhari.jpg') }}" class="card-img-top" alt="বুখারী শরীফ">
                                <div class="card-body">
                                    <h5 class="card-title">সহীহ বুখারী শরীফ</h5>
                                    <p class="card-text">ইমাম বুখারী (রহ.)</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card book-card">
                                <img src="{{ asset('images/books/muslim.jpg') }}" class="card-img-top" alt="মুসলিম শরীফ">
                                <div class="card-body">
                                    <h5 class="card-title">সহীহ মুসলিম শরীফ</h5>
                                    <p class="card-text">ইমাম মুসলিম (রহ.)</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card book-card">
                                <img src="{{ asset('images/books/riyadus.jpg') }}" class="card-img-top" alt="রিয়াদুস সালেহীন">
                                <div class="card-body">
                                    <h5 class="card-title">রিয়াদুস সালেহীন</h5>
                                    <p class="card-text">ইমাম নববী (রহ.)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Class Schedule -->
                <div class="class-schedule">
                    <h2 class="section-title mb-4">ক্লাস রুটিন</h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>দিন</th>
                                            <th>সময়</th>
                                            <th>বিষয়</th>
                                            <th>শিক্ষক</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>শনিবার</td>
                                            <td>সকাল ৯:০০ - ১১:০০</td>
                                            <td>সহীহ বুখারী</td>
                                            <td>মাওলানা আব্দুল্লাহ</td>
                                        </tr>
                                        <tr>
                                            <td>রবিবার</td>
                                            <td>সকাল ৯:০০ - ১১:০০</td>
                                            <td>সহীহ মুসলিম</td>
                                            <td>মাওলানা ইউসুফ</td>
                                        </tr>
                                        <tr>
                                            <td>মঙ্গলবার</td>
                                            <td>সকাল ৯:০০ - ১১:০০</td>
                                            <td>রিয়াদুস সালেহীন</td>
                                            <td>মাওলানা আহমাদ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sidebar">
                <!-- Contact Info -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-4">যোগাযোগ করুন</h3>
                        <div class="contact-info">
                            <p><i class="fas fa-phone text-primary me-2"></i> +880 1765812261</p>
                            <p><i class="fas fa-envelope text-primary me-2"></i> info@shubbanbd.org</p>
                            <p><i class="fas fa-map-marker-alt text-primary me-2"></i> ৭৯/ক/৩, উত্তর যাত্রাবাড়ি, ঢাকা-১২০৪</p>
                        </div>
                    </div>
                </div>

                <!-- Other Courses -->
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4">অন্যান্য কোর্স</h3>
                        <ul class="list-unstyled other-courses">
                            <li><a href="#"><i class="fas fa-angle-right me-2"></i>কুরআন শিক্ষা</a></li>
                            <li><a href="#"><i class="fas fa-angle-right me-2"></i>ফিকহ শিক্ষা</a></li>
                            <li><a href="#"><i class="fas fa-angle-right me-2"></i>আরবি ভাষা শিক্ষা</a></li>
                        </ul>
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

.features-list {
    list-style: none;
    padding: 0;
}

.features-list li {
    margin-bottom: 0.5rem;
}

.course-features {
    list-style: none;
    padding: 0;
}

.course-features li {
    margin-bottom: 0.5rem;
    color: #666;
}

.book-card {
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.book-card:hover {
    transform: translateY(-5px);
}

.book-card .card-img-top {
    height: 200px;
    object-fit: cover;
}

.book-card .card-title {
    color: #0C4B36;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.book-card .card-text {
    color: #666;
    font-size: 0.9rem;
}

.table th {
    background-color: #0C4B36;
    color: white;
}

.other-courses li {
    margin-bottom: 0.5rem;
}

.other-courses a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.other-courses a:hover {
    color: #0C4B36;
}
</style>
@endsection
