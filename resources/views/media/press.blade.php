@extends('layouts.app')

@section('title', 'প্রেস রিলিজ - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="press-content">
                <h1 class="section-title mb-4">প্রেস রিলিজ</h1>

                <!-- Press Release List -->
                <div class="press-releases">
                    <!-- Press Release Item -->
                    <div class="press-item mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="press-meta mb-2">
                                    <span class="date"><i class="far fa-calendar-alt me-1"></i> ১৫ ফেব্রুয়ারি ২০২৫</span>
                                    <span class="category ms-3"><i class="fas fa-tag me-1"></i> সংবাদ বিজ্ঞপ্তি</span>
                                </div>
                                <h3 class="card-title">বার্ষিক সম্মেলন ২০২৫ উপলক্ষে প্রেস বিজ্ঞপ্তি</h3>
                                <p class="card-text">জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ এর বার্ষিক সম্মেলন আগামী ১ মার্চ ২০২৫ তারিখে অনুষ্ঠিত হবে...</p>
                                <div class="press-actions">
                                    <a href="#" class="btn btn-primary">বিস্তারিত পড়ুন</a>
                                    <a href="#" class="btn btn-outline-primary ms-2">
                                        <i class="fas fa-download me-1"></i> PDF ডাউনলোড
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="press-item mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="press-meta mb-2">
                                    <span class="date"><i class="far fa-calendar-alt me-1"></i> ১০ ফেব্রুয়ারি ২০২৫</span>
                                    <span class="category ms-3"><i class="fas fa-tag me-1"></i> বিবৃতি</span>
                                </div>
                                <h3 class="card-title">শীতার্ত মানুষের পাশে জমঈয়তের কার্যক্রম</h3>
                                <p class="card-text">দেশের বিভিন্ন অঞ্চলে শীতার্ত মানুষদের মাঝে শীতবস্ত্র বিতরণ কার্যক্রম শুরু করেছে জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ...</p>
                                <div class="press-actions">
                                    <a href="#" class="btn btn-primary">বিস্তারিত পড়ুন</a>
                                    <a href="#" class="btn btn-outline-primary ms-2">
                                        <i class="fas fa-download me-1"></i> PDF ডাউনলোড
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="press-item mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="press-meta mb-2">
                                    <span class="date"><i class="far fa-calendar-alt me-1"></i> ৫ ফেব্রুয়ারি ২০২৫</span>
                                    <span class="category ms-3"><i class="fas fa-tag me-1"></i> সংবাদ বিজ্ঞপ্তি</span>
                                </div>
                                <h3 class="card-title">নতুন শাখা উদ্বোধন অনুষ্ঠান</h3>
                                <p class="card-text">জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ এর নতুন শাখা কার্যালয় উদ্বোধন করা হয়েছে চট্টগ্রামের হালিশহরে...</p>
                                <div class="press-actions">
                                    <a href="#" class="btn btn-primary">বিস্তারিত পড়ুন</a>
                                    <a href="#" class="btn btn-outline-primary ms-2">
                                        <i class="fas fa-download me-1"></i> PDF ডাউনলোড
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">পূর্ববর্তী</a>
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

        <div class="col-lg-4">
            <div class="sidebar">
                <!-- Search Box -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">প্রেস রিলিজ খুঁজুন</h3>
                        <form action="#" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="খুঁজুন...">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Categories -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">বিভাগ সমূহ</h3>
                        <ul class="list-unstyled categories">
                            <li><a href="#"><i class="fas fa-angle-right me-2"></i>সংবাদ বিজ্ঞপ্তি (১২)</a></li>
                            <li><a href="#"><i class="fas fa-angle-right me-2"></i>বিবৃতি (৮)</a></li>
                            <li><a href="#"><i class="fas fa-angle-right me-2"></i>সাংবাদিক সম্মেলন (৫)</a></li>
                            <li><a href="#"><i class="fas fa-angle-right me-2"></i>অন্যান্য (৩)</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Archive -->
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-3">আর্কাইভ</h3>
                        <ul class="list-unstyled archive">
                            <li><a href="#"><i class="fas fa-folder me-2"></i>জানুয়ারি ২০২৫ (১০)</a></li>
                            <li><a href="#"><i class="fas fa-folder me-2"></i>ডিসেম্বর ২০২৪ (১২)</a></li>
                            <li><a href="#"><i class="fas fa-folder me-2"></i>নভেম্বর ২০২৪ (৮)</a></li>
                            <li><a href="#"><i class="fas fa-folder me-2"></i>অক্টোবর ২০২৪ (১৫)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.press-content {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.press-item .card {
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.press-item .card:hover {
    transform: translateY(-5px);
}

.press-item .card-title {
    color: #0C4B36;
    font-size: 1.25rem;
}

.press-meta {
    color: #666;
    font-size: 0.9rem;
}

.press-actions {
    margin-top: 1.5rem;
}

.categories li, .archive li {
    margin-bottom: 0.5rem;
}

.categories a, .archive a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.categories a:hover, .archive a:hover {
    color: #0C4B36;
}

.pagination .page-link {
    color: #0C4B36;
}

.pagination .page-item.active .page-link {
    background-color: #0C4B36;
    border-color: #0C4B36;
}
</style>
@endsection
