@extends('layouts.page')

@section('title', 'পরীক্ষার ফলাফল')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>পরীক্ষার ফলাফল</h2>
                
                <div class="results-section">
                    <!-- ফলাফল অনুসন্ধান -->
                    <div class="search-section mb-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">
                                    <i class="fas fa-search me-2"></i>ফলাফল অনুসন্ধান
                                </h4>
                                <form action="#" method="GET" class="result-search-form">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <select class="form-select" name="exam_type">
                                                <option value="">পরীক্ষা নির্বাচন করুন</option>
                                                <option value="quran">কুরআন</option>
                                                <option value="hadith">হাদীস</option>
                                                <option value="fiqh">ফিকাহ</option>
                                                <option value="arabic">আরবি</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <select class="form-select" name="exam_year">
                                                <option value="">বছর নির্বাচন করুন</option>
                                                <option value="2025">২০২৫</option>
                                                <option value="2024">২০২৪</option>
                                                <option value="2023">২০২৩</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="text" class="form-control" name="roll_number" placeholder="রোল নম্বর">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search me-2"></i>অনুসন্ধান করুন
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- সর্বশেষ ফলাফল -->
                    <div class="recent-results mb-5">
                        <h3 class="text-success mb-4">
                            <i class="fas fa-chart-bar me-2"></i>সর্বশেষ ফলাফল
                        </h3>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>পরীক্ষার নাম</th>
                                        <th>তারিখ</th>
                                        <th>মোট পরীক্ষার্থী</th>
                                        <th>পাশের হার</th>
                                        <th>ফলাফল</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>কুরআন তিলাওয়াত (বেসিক)</td>
                                        <td>১ মার্চ, ২০২৫</td>
                                        <td>১২০</td>
                                        <td>৯৫%</td>
                                        <td><a href="#" class="btn btn-sm btn-outline-primary">দেখুন</a></td>
                                    </tr>
                                    <tr>
                                        <td>হাদীস শাস্ত্র (মধ্যম)</td>
                                        <td>২৮ ফেব্রুয়ারি, ২০২৫</td>
                                        <td>৮০</td>
                                        <td>৯০%</td>
                                        <td><a href="#" class="btn btn-sm btn-outline-primary">দেখুন</a></td>
                                    </tr>
                                    <tr>
                                        <td>আরবি ভাষা (উচ্চ)</td>
                                        <td>২৫ ফেব্রুয়ারি, ২০২৫</td>
                                        <td>৬০</td>
                                        <td>৮৫%</td>
                                        <td><a href="#" class="btn btn-sm btn-outline-primary">দেখুন</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- মেধাবী ছাত্র -->
                    <div class="top-students">
                        <h3 class="text-info mb-4">
                            <i class="fas fa-award me-2"></i>মেধাবী ছাত্র
                        </h3>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="student-card">
                                    <div class="text-center mb-3">
                                        <i class="fas fa-user-graduate fa-3x text-primary"></i>
                                    </div>
                                    <h5 class="text-center">আব্দুল্লাহ আল মামুন</h5>
                                    <p class="text-center text-muted">কুরআন বিভাগ</p>
                                    <div class="text-center">
                                        <span class="badge bg-success">প্রথম স্থান</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="student-card">
                                    <div class="text-center mb-3">
                                        <i class="fas fa-user-graduate fa-3x text-primary"></i>
                                    </div>
                                    <h5 class="text-center">মোহাম্মদ রাফি</h5>
                                    <p class="text-center text-muted">হাদীস বিভাগ</p>
                                    <div class="text-center">
                                        <span class="badge bg-success">প্রথম স্থান</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="student-card">
                                    <div class="text-center mb-3">
                                        <i class="fas fa-user-graduate fa-3x text-primary"></i>
                                    </div>
                                    <h5 class="text-center">আহমেদ হাসান</h5>
                                    <p class="text-center text-muted">আরবি বিভাগ</p>
                                    <div class="text-center">
                                        <span class="badge bg-success">প্রথম স্থান</span>
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
                    <h4 class="card-title">ফলাফল নোটিশ</h4>
                    <div class="notice-list">
                        <div class="notice-item">
                            <h6>পুনঃনিরীক্ষণ আবেদন</h6>
                            <p>শেষ তারিখ: ১৫ মার্চ, ২০২৫</p>
                        </div>
                        <div class="notice-item">
                            <h6>সনদপত্র বিতরণ</h6>
                            <p>শুরু: ২০ মার্চ, ২০২৫</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">গুরুত্বপূর্ণ লিংক</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('education-board.exam-schedule') }}" class="text-decoration-none">পরীক্ষার সময়সূচি</a></li>
                        <li><a href="{{ route('education-board.syllabus') }}" class="text-decoration-none">সিলেবাস</a></li>
                        <li><a href="#" class="text-decoration-none">পুনঃনিরীক্ষণ ফরম</a></li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">হেল্পলাইন</h4>
                    <p>ফলাফল সংক্রান্ত যেকোনো তথ্যের জন্য যোগাযোগ করুন</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i>০১৭XXXXXXXX</li>
                        <li><i class="fas fa-envelope me-2"></i>results@shubban.org</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .result-search-form {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }

    .student-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .student-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .notice-item {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .notice-item:last-child {
        border-bottom: none;
    }

    .notice-item h6 {
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .notice-item p {
        color: #666;
        margin-bottom: 0;
        font-size: 0.9em;
    }

    .table {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
</style>
@endsection
@endsection
