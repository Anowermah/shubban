@extends('layouts.app')

@section('title', __('messages.quran_education'))

@section('page-styles')
    @include('layouts.styles.education')
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="content-wrapper">
                <h1 class="section-title mb-4">কুরআন শিক্ষা</h1>

                <!-- Course Overview -->
                <div class="course-overview mb-5">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-4">কোর্স পরিচিতি</h2>
                            <p>{{ __('messages.quran_course_description') }}</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.quran_course_feature1') }}</li>
                                <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.quran_course_feature2') }}</li>
                                <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.quran_course_feature3') }}</li>
                            </ul>
                            <a href="{{ route('contact.index') }}" class="btn btn-primary mt-3">ভর্তি হতে যোগাযোগ করুন</a>
                        </div>
                    </div>
                </div>

                <!-- Course Details -->
                <div class="course-details mb-5">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <i class="fas fa-book-open text-primary me-2"></i>
                                        বেসিক কোর্স
                                    </h3>
                                    <p>{{ __('messages.quran_hifz_description') }}</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.quran_hifz_feature1') }}</li>
                                        <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.quran_hifz_feature2') }}</li>
                                        <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.quran_hifz_feature3') }}</li>
                                    </ul>
                                    <a href="{{ route('contact.index') }}" class="btn btn-primary mt-3">ভর্তি হতে যোগাযোগ করুন</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <i class="fas fa-award text-primary me-2"></i>
                                        অ্যাডভান্সড কোর্স
                                    </h3>
                                    <ul class="course-features mt-3">
                                        <li>কোর্সের মেয়াদ: ১ বছর</li>
                                        <li>ক্লাস: সপ্তাহে ৫ দিন</li>
                                        <li>সময়: সকাল ৮টা - ১২টা</li>
                                        <li>ভর্তি ফি: ২০০০ টাকা</li>
                                    </ul>
                                    <a href="{{ route('contact.index') }}" class="btn btn-primary mt-3">ভর্তি হতে যোগাযোগ করুন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teachers -->
                <div class="teachers mb-5">
                    <h2 class="section-title mb-4">শিক্ষকমণ্ডলী</h2>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card teacher-card">
                                <div class="card-body">
                                    <div class="teacher-info">
                                        <img src="{{ asset('images/teachers/teacher1.jpg') }}" alt="Teacher" class="teacher-image">
                                        <div class="teacher-details">
                                            <h4>মাওলানা আব্দুল্লাহ</h4>
                                            <p>হিফজ বিভাগ প্রধান</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card teacher-card">
                                <div class="card-body">
                                    <div class="teacher-info">
                                        <img src="{{ asset('images/teachers/teacher2.jpg') }}" alt="Teacher" class="teacher-image">
                                        <div class="teacher-details">
                                            <h4>মাওলানা ইউসুফ</h4>
                                            <p>তাজবীদ বিভাগ প্রধান</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Registration Process -->
                <div class="registration-process">
                    <h2 class="section-title mb-4">ভর্তি প্রক্রিয়া</h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="process-steps">
                                <div class="step">
                                    <div class="step-number">১</div>
                                    <div class="step-content">
                                        <h5>যোগাযোগ করুন</h5>
                                        <p>অফিসে এসে বা ফোনে যোগাযোগ করুন</p>
                                    </div>
                                </div>
                                <div class="step">
                                    <div class="step-number">২</div>
                                    <div class="step-content">
                                        <h5>ফরম পূরণ</h5>
                                        <p>ভর্তি ফরম পূরণ করুন</p>
                                    </div>
                                </div>
                                <div class="step">
                                    <div class="step-number">৩</div>
                                    <div class="step-content">
                                        <h5>ফি জমা</h5>
                                        <p>ভর্তি ফি জমা দিন</p>
                                    </div>
                                </div>
                                <div class="step">
                                    <div class="step-number">৪</div>
                                    <div class="step-content">
                                        <h5>ক্লাস শুরু</h5>
                                        <p>নির্ধারিত তারিখে ক্লাস শুরু</p>
                                    </div>
                                </div>
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
                            <li><a href="#"><i class="fas fa-angle-right me-2"></i>হাদীস শিক্ষা</a></li>
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

.teacher-card {
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.teacher-card:hover {
    transform: translateY(-5px);
}

.teacher-info {
    display: flex;
    align-items: center;
}

.teacher-image {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-right: 1rem;
    object-fit: cover;
}

.teacher-details h4 {
    margin: 0;
    color: #0C4B36;
    font-size: 1.1rem;
}

.teacher-details p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.process-steps .step {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1.5rem;
}

.step-number {
    width: 40px;
    height: 40px;
    background: #0C4B36;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
}

.step-content h5 {
    margin: 0;
    color: #0C4B36;
}

.step-content p {
    margin: 0;
    color: #666;
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
