@extends('layouts.app')

@section('title', __('messages.libraries'))

@section('page-styles')
    @include('layouts.styles.institutions')
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <h2 class="section-title mb-4">{{ __('messages.libraries') }}</h2>
            
            <!-- Search Section -->
            <div class="search-section mb-4">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="GET" class="book-search-form">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="বই খুঁজুন...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search"></i> অনুসন্ধান
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Books Grid -->
            <div class="books-grid">
                <div class="row">
                    <!-- Book Item -->
                    <div class="col-md-6 mb-4">
                        <div class="book-item">
                            <div class="card h-100">
                                <img src="{{ asset('images/books/book1.jpg') }}" class="card-img-top" alt="বই">
                                <div class="card-body">
                                    <h3 class="book-title">সহীহ হাদীসের আলোকে নামাজ</h3>
                                    <p class="book-author">লেখক: মুহাম্মাদ আব্দুল্লাহ</p>
                                    <div class="book-meta">
                                        <span><i class="fas fa-book"></i> পৃষ্ঠা: ২৫০</span>
                                        <span><i class="fas fa-language"></i> ভাষা: বাংলা</span>
                                    </div>
                                    <div class="book-price mt-3">
                                        <span class="price">মূল্য: ৳৩৫০</span>
                                    </div>
                                    <div class="book-actions mt-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="#" class="btn btn-success btn-sm w-100">
                                                    <i class="fas fa-shopping-cart"></i> ক্রয় করুন
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" class="btn btn-info btn-sm w-100">
                                                    <i class="fas fa-book-reader"></i> পড়ুন
                                                </a>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-outline-primary btn-sm w-100 mt-2">
                                            <i class="fas fa-download"></i> ডাউনলোড
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Item -->
                    <div class="col-md-6 mb-4">
                        <div class="book-item">
                            <div class="card h-100">
                                <img src="{{ asset('images/books/book2.jpg') }}" class="card-img-top" alt="বই">
                                <div class="card-body">
                                    <h3 class="book-title">কুরআন ও হাদীসের আলোকে যাকাত</h3>
                                    <p class="book-author">লেখক: ড. আহমদ হোসাইন</p>
                                    <div class="book-meta">
                                        <span><i class="fas fa-book"></i> পৃষ্ঠা: ১৮০</span>
                                        <span><i class="fas fa-language"></i> ভাষা: বাংলা</span>
                                    </div>
                                    <div class="book-price mt-3">
                                        <span class="price">মূল্য: ৳২৮০</span>
                                    </div>
                                    <div class="book-actions mt-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="#" class="btn btn-success btn-sm w-100">
                                                    <i class="fas fa-shopping-cart"></i> ক্রয় করুন
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" class="btn btn-info btn-sm w-100">
                                                    <i class="fas fa-book-reader"></i> পড়ুন
                                                </a>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-outline-primary btn-sm w-100 mt-2">
                                            <i class="fas fa-download"></i> ডাউনলোড
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Item -->
                    <div class="col-md-6 mb-4">
                        <div class="book-item">
                            <div class="card h-100">
                                <img src="{{ asset('images/books/book3.jpg') }}" class="card-img-top" alt="বই">
                                <div class="card-body">
                                    <h3 class="book-title">ইসলামী আদর্শ ও মূল্যবোধ</h3>
                                    <p class="book-author">লেখক: মাওলানা মুহাম্মদ ইউসুফ</p>
                                    <div class="book-meta">
                                        <span><i class="fas fa-book"></i> পৃষ্ঠা: ৩২০</span>
                                        <span><i class="fas fa-language"></i> ভাষা: বাংলা</span>
                                    </div>
                                    <div class="book-price mt-3">
                                        <span class="price">মূল্য: ৳৪০০</span>
                                    </div>
                                    <div class="book-actions mt-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="#" class="btn btn-success btn-sm w-100">
                                                    <i class="fas fa-shopping-cart"></i> ক্রয় করুন
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" class="btn btn-info btn-sm w-100">
                                                    <i class="fas fa-book-reader"></i> পড়ুন
                                                </a>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-outline-primary btn-sm w-100 mt-2">
                                            <i class="fas fa-download"></i> ডাউনলোড
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination-section mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">পূর্ববর্তী</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">১</a></li>
                            <li class="page-item"><a class="page-link" href="#">২</a></li>
                            <li class="page-item"><a class="page-link" href="#">৩</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">পরবর্তী</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Categories -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">বিষয়সমূহ</h4>
                    <ul class="list-unstyled categories-list">
                        <li><a href="#" class="d-flex justify-content-between">আকীদাহ <span class="count">১২</span></a></li>
                        <li><a href="#" class="d-flex justify-content-between">ফিকাহ <span class="count">৮</span></a></li>
                        <li><a href="#" class="d-flex justify-content-between">হাদীস <span class="count">১৫</span></a></li>
                        <li><a href="#" class="d-flex justify-content-between">সীরাত <span class="count">১০</span></a></li>
                        <li><a href="#" class="d-flex justify-content-between">ইসলামী সাহিত্য <span class="count">২০</span></a></li>
                    </ul>
                </div>
            </div>

            <!-- Popular Books -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">জনপ্রিয় বই</h4>
                    <div class="popular-books">
                        <div class="popular-book-item d-flex mb-3">
                            <img src="{{ asset('images/books/book1-thumb.jpg') }}" alt="বই" class="popular-book-thumb">
                            <div class="popular-book-info ms-3">
                                <h5>সহীহ হাদীসের আলোকে নামাজ</h5>
                                <p class="mb-0">লেখক: মুহাম্মাদ আব্দুল্লাহ</p>
                                <span class="price">৳৩৫০</span>
                            </div>
                        </div>
                        <div class="popular-book-item d-flex mb-3">
                            <img src="{{ asset('images/books/book2-thumb.jpg') }}" alt="বই" class="popular-book-thumb">
                            <div class="popular-book-info ms-3">
                                <h5>কুরআন ও হাদীসের আলোকে যাকাত</h5>
                                <p class="mb-0">লেখক: ড. আহমদ হোসাইন</p>
                                <span class="price">৳২৮০</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reading Stats -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">পাঠক সংখ্যা</h4>
                    <div class="reading-stats">
                        <div class="stat-item d-flex justify-content-between mb-2">
                            <span>মোট পাঠক</span>
                            <span class="stat-value">১২,৫০০+</span>
                        </div>
                        <div class="stat-item d-flex justify-content-between mb-2">
                            <span>মোট ডাউনলোড</span>
                            <span class="stat-value">৮,২০০+</span>
                        </div>
                        <div class="stat-item d-flex justify-content-between">
                            <span>মোট বই</span>
                            <span class="stat-value">১৫০+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
