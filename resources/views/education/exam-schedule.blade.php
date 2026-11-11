@extends('layouts.app')

@section('title', __('messages.exam_schedule'))

@section('page-styles')
    @include('layouts.styles.education')
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2 class="section-title mb-4">{{ __('messages.exam_schedule') }}</h2>
                
                <div class="exam-schedule-section">
                    <!-- Upcoming Exams -->
                    <div class="schedule-category mb-5">
                        <h3 class="text-primary mb-4">
                            <i class="fas fa-clock me-2"></i>{{ __('messages.upcoming_exams') }}
                        </h3>
                        
                        @foreach($examSchedules as $schedule)
                        <div class="exam-card mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $schedule['title'] }}</h4>
                                    <div class="exam-info">
                                        <p><i class="fas fa-calendar"></i> {{ $schedule['date'] }}</p>
                                        <p><i class="fas fa-clock"></i> {{ $schedule['time'] }}</p>
                                        <p><i class="fas fa-map-marker-alt"></i> {{ $schedule['venue'] }}</p>
                                    </div>
                                    <div class="subjects mt-3">
                                        <h5>পরীক্ষার বিষয়সমূহ:</h5>
                                        <ul class="list-unstyled">
                                            @foreach($schedule['subjects'] as $subject)
                                            <li><i class="fas fa-book me-2"></i>{{ $subject }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Exam Guidelines -->
                    <div class="exam-guidelines mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-primary">
                                    <i class="fas fa-info-circle me-2"></i>পরীক্ষার নির্দেশনা
                                </h3>
                                <ul class="guidelines-list">
                                    <li>পরীক্ষা শুরুর ৩০ মিনিট আগে পরীক্ষা কেন্দ্রে উপস্থিত থাকতে হবে</li>
                                    <li>প্রবেশপত্র ছাড়া কোন পরীক্ষার্থীকে পরীক্ষায় অংশগ্রহণ করতে দেওয়া হবে না</li>
                                    <li>পরীক্ষার হলে মোবাইল ফোন নিষিদ্ধ</li>
                                    <li>পরীক্ষার প্রয়োজনীয় সামগ্রী সাথে আনতে হবে</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Important Dates -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">গুরুত্বপূর্ণ তারিখ</h4>
                    <ul class="important-dates">
                        <li>
                            <span class="date">১৫ মার্চ</span>
                            <span class="event">রেজিস্ট্রেশন শেষ</span>
                        </li>
                        <li>
                            <span class="date">২০ মার্চ</span>
                            <span class="event">প্রবেশপত্র বিতরণ</span>
                        </li>
                        <li>
                            <span class="date">২৫ মার্চ</span>
                            <span class="event">পরীক্ষা শুরু</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">যোগাযোগ</h4>
                    <p>পরীক্ষা সংক্রান্ত তথ্যের জন্য যোগাযোগ করুন:</p>
                    <ul class="contact-info">
                        <li><i class="fas fa-phone"></i> +880 1234-567890</li>
                        <li><i class="fas fa-envelope"></i> exam@shubban.org</li>
                    </ul>
                    <a href="{{ route('contact.index') }}" class="btn btn-primary mt-3 w-100">যোগাযোগ করুন</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
