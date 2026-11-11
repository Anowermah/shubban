@extends('layouts.page')

@section('title', 'প্রবন্ধ')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>প্রবন্ধ</h2>
                
                <!-- নতুন প্রবন্ধ -->
                <div class="new-articles mb-5">
                    <h3 class="text-success mb-4">
                        <i class="fas fa-feather-alt me-2"></i>নতুন প্রবন্ধ
                    </h3>
                    <div class="article-card featured">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('images/articles/placeholder.jpg') }}" alt="প্রবন্ধ" class="img-fluid rounded">
                                <div class="new-badge">নতুন</div>
                            </div>
                            <div class="col-md-8">
                                <div class="article-details">
                                    <h4>ইসলামি অর্থনীতির মূলনীতি</h4>
                                    <p class="author">
                                        <i class="fas fa-user me-2"></i>লেখক: মাওলানা আব্দুল করিম
                                    </p>
                                    <div class="article-meta">
                                        <span><i class="fas fa-calendar me-2"></i>প্রকাশ: ২০ ফেব্রুয়ারি, ২০২৫</span>
                                        <span><i class="fas fa-clock me-2"></i>পড়তে সময় লাগবে: ১৫ মিনিট</span>
                                    </div>
                                    <p class="description">
                                        বর্তমান বিশ্বে ইসলামি অর্থনীতির প্রাসঙ্গিকতা এবং এর মৌলিক নীতিমালা নিয়ে বিস্তারিত আলোচনা।
                                    </p>
                                    <div class="action-buttons">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fas fa-shopping-cart me-1"></i>ক্রয় করুন
                                        </a>
                                        <a href="#" class="btn btn-success">
                                            <i class="fas fa-download me-1"></i>ডাউনলোড
                                        </a>
                                        <a href="#" class="btn btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>পড়ুন
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- বিষয়ভিত্তিক প্রবন্ধ -->
                <div class="category-articles">
                    <!-- আকিদা বিষয়ক -->
                    <div class="article-category mb-5">
                        <h3 class="text-primary mb-4">
                            <i class="fas fa-book me-2"></i>আকিদা বিষয়ক
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="article-card">
                                    <img src="{{ asset('images/articles/placeholder.jpg') }}" alt="প্রবন্ধ" class="img-fluid rounded mb-3">
                                    <div class="article-details">
                                        <h5>তাওহীদের গুরুত্ব</h5>
                                        <p class="author small">
                                            <i class="fas fa-user me-2"></i>লেখক: মাওলানা আহমেদ
                                        </p>
                                        <p class="description">
                                            ইসলামের মৌলিক বিষয় তাওহীদ এবং এর গুরুত্ব নিয়ে বিস্তারিত আলোচনা।
                                        </p>
                                        <div class="action-buttons">
                                            <a href="#" class="btn btn-primary btn-sm">
                                                <i class="fas fa-shopping-cart me-1"></i>ক্রয় করুন
                                            </a>
                                            <a href="#" class="btn btn-success btn-sm">
                                                <i class="fas fa-download me-1"></i>ডাউনলোড
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="article-card">
                                    <img src="{{ asset('images/articles/placeholder.jpg') }}" alt="প্রবন্ধ" class="img-fluid rounded mb-3">
                                    <div class="article-details">
                                        <h5>শিরক থেকে মুক্তি</h5>
                                        <p class="author small">
                                            <i class="fas fa-user me-2"></i>লেখক: মাওলানা কামাল
                                        </p>
                                        <p class="description">
                                            শিরক এর প্রকারভেদ এবং এ থেকে মুক্তির উপায় নিয়ে আলোচনা।
                                        </p>
                                        <div class="action-buttons">
                                            <a href="#" class="btn btn-primary btn-sm">
                                                <i class="fas fa-shopping-cart me-1"></i>ক্রয় করুন
                                            </a>
                                            <a href="#" class="btn btn-success btn-sm">
                                                <i class="fas fa-download me-1"></i>ডাউনলোড
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ফিকাহ বিষয়ক -->
                    <div class="article-category">
                        <h3 class="text-info mb-4">
                            <i class="fas fa-book me-2"></i>ফিকাহ বিষয়ক
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="article-card">
                                    <img src="{{ asset('images/articles/placeholder.jpg') }}" alt="প্রবন্ধ" class="img-fluid rounded mb-3">
                                    <div class="article-details">
                                        <h5>যাকাতের মাসায়েল</h5>
                                        <p class="author small">
                                            <i class="fas fa-user me-2"></i>লেখক: মাওলানা জামাল
                                        </p>
                                        <p class="description">
                                            যাকাত সংক্রান্ত বিভিন্ন মাসআলা নিয়ে বিস্তারিত আলোচনা।
                                        </p>
                                        <div class="action-buttons">
                                            <a href="#" class="btn btn-primary btn-sm">
                                                <i class="fas fa-shopping-cart me-1"></i>ক্রয় করুন
                                            </a>
                                            <a href="#" class="btn btn-success btn-sm">
                                                <i class="fas fa-download me-1"></i>ডাউনলোড
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="article-card">
                                    <img src="{{ asset('images/articles/placeholder.jpg') }}" alt="প্রবন্ধ" class="img-fluid rounded mb-3">
                                    <div class="article-details">
                                        <h5>হজ্জের মাসায়েল</h5>
                                        <p class="author small">
                                            <i class="fas fa-user me-2"></i>লেখক: মাওলানা ইমরান
                                        </p>
                                        <p class="description">
                                            হজ্জ সংক্রান্ত গুরুত্বপূর্ণ মাসআলা নিয়ে আলোচনা।
                                        </p>
                                        <div class="action-buttons">
                                            <a href="#" class="btn btn-primary btn-sm">
                                                <i class="fas fa-shopping-cart me-1"></i>ক্রয় করুন
                                            </a>
                                            <a href="#" class="btn btn-success btn-sm">
                                                <i class="fas fa-download me-1"></i>ডাউনলোড
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- অনুসন্ধান -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">প্রবন্ধ অনুসন্ধান</h4>
                    <form action="#" method="GET">
                        <div class="mb-3">
                            <select class="form-select" name="category">
                                <option value="">বিষয় নির্বাচন করুন</option>
                                <option value="aqidah">আকিদা</option>
                                <option value="fiqh">ফিকাহ</option>
                                <option value="hadith">হাদীস</option>
                                <option value="tafsir">তাফসীর</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="লেখক অথবা শিরোনাম">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>অনুসন্ধান করুন
                        </button>
                    </form>
                </div>
            </div>

            <!-- জনপ্রিয় প্রবন্ধ -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">জনপ্রিয় প্রবন্ধ</h4>
                    <div class="popular-articles">
                        <div class="popular-article d-flex align-items-center mb-3">
                            <img src="{{ asset('images/articles/placeholder.jpg') }}" alt="প্রবন্ধ" class="me-3" width="60">
                            <div>
                                <h6 class="mb-1">ইসলামে পরিবার</h6>
                                <p class="mb-0 small">পাঠক সংখ্যা: ১০,০০০</p>
                            </div>
                        </div>
                        <div class="popular-article d-flex align-items-center">
                            <img src="{{ asset('images/articles/placeholder.jpg') }}" alt="প্রবন্ধ" class="me-3" width="60">
                            <div>
                                <h6 class="mb-1">ইসলামে শিক্ষা</h6>
                                <p class="mb-0 small">পাঠক সংখ্যা: ৮,০০০</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- যোগাযোগ -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">যোগাযোগ</h4>
                    <p>প্রবন্ধ সংক্রান্ত তথ্যের জন্য যোগাযোগ করুন</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i>০১৭XXXXXXXX</li>
                        <li><i class="fas fa-envelope me-2"></i>articles@shubban.org</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>প্রকাশনা অফিস, ঢাকা</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .article-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        position: relative;
        padding: 20px;
    }

    .article-card.featured {
        border: 2px solid #28a745;
    }

    .new-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #28a745;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .article-card img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
    }

    .article-details {
        padding: 15px 0;
    }

    .article-meta {
        color: #666;
        font-size: 0.9rem;
        margin: 10px 0;
    }

    .article-meta span {
        margin-right: 15px;
    }

    .description {
        color: #666;
        margin: 15px 0;
    }

    .action-buttons .btn {
        margin-right: 5px;
    }

    .popular-article img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .article-category h3 {
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
    }
</style>
@endsection
@endsection
