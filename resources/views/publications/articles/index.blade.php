@extends('layouts.page')

@section('title', 'প্রকাশিত নিবন্ধ ও গবেষণামূলক প্রবন্ধ')
@section('category', 'প্রকাশনা')
@section('subtitle', 'ইসলামি ব্যক্তিত্ব, ইতিহাস, আক্বীদা ও সমকালীন বিষয়ে শুব্বানের বিজ্ঞ গবেষকদের তাত্ত্বিক ও সমকালীন প্রবন্ধাবলী')

@section('meta_description', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর তাত্ত্বিক ও গবেষণামূলক প্রবন্ধ সম্ভার। আকীদাহ, ইতিহাস ও সমকালীন বিষয়ে প্রামাণ্য রচনা পড়ুন।')
@section('meta_keywords', 'শুব্বান প্রবন্ধ, ইসলামিক নিবন্ধ, আহলে হাদীস গবেষণা, সালাফি প্রবন্ধ, আকীদাহ ও ইতিহাস')

@section('page-content')
@php
    $toBn = function($number) {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, (string)$number);
    };
@endphp

<!-- Filter & Search Bar -->
<div class="card border-0 shadow-sm rounded-4 mb-4 p-3 p-md-4 bg-white">
    <form action="{{ route('publications.articles') }}" method="GET" class="row g-3 align-items-end">
        <!-- Search Keyword -->
        <div class="col-12 col-md-5">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-search text-success me-1"></i> প্রবন্ধের শিরোনাম বা লেখক দিয়ে খুঁজুন
            </label>
            <div class="input-group">
                <input type="text" name="search" class="form-control rounded-start-pill ps-3" 
                       placeholder="উদাঃ বালাকোট, শাহাদাতগাহ, তাযিয়া মিছিল..." 
                       value="{{ request('search') }}">
                @if(request('search'))
                    <a href="{{ route('publications.articles', request()->except('search')) }}" class="btn btn-outline-secondary border-start-0" title="মুছে ফেলুন">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </div>

        <!-- Category Filter -->
        <div class="col-6 col-md-3">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-folder text-warning me-1"></i> বিষয় / ক্যাটাগরি
            </label>
            <select name="category" class="form-select rounded-pill">
                <option value="">সকল বিষয়</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sort Filter -->
        <div class="col-6 col-md-2">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-sort-amount-down text-info me-1"></i> সাজানো
            </label>
            <select name="sort" class="form-select rounded-pill">
                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>সর্বশেষ আগে</option>
                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>প্রাচীনতম আগে</option>
            </select>
        </div>

        <!-- Submit & Reset Buttons -->
        <div class="col-12 col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-success rounded-pill w-100 fw-bold shadow-sm" style="background: #0C4B36; border-color: #0C4B36;">
                <i class="fas fa-filter me-1"></i> ফিল্টার
            </button>
            @if(request()->anyFilled(['search', 'category', 'sort']))
                <a href="{{ route('publications.articles') }}" class="btn btn-outline-secondary rounded-pill" title="ফিল্টার রিসেট">
                    <i class="fas fa-undo"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Active Filter Pills Strip -->
@if(request()->anyFilled(['search', 'category']))
    <div class="d-flex align-items-center gap-2 mb-4 flex-wrap">
        <span class="small text-muted fw-bold">সক্রিয় ফিল্টার:</span>
        @if(request('search'))
            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                কীওয়ার্ড: "{{ request('search') }}"
                <a href="{{ route('publications.articles', request()->except('search')) }}" class="ms-1 text-danger text-decoration-none">&times;</a>
            </span>
        @endif
        @if(request('category'))
            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                বিষয়: {{ request('category') }}
                <a href="{{ route('publications.articles', request()->except('category')) }}" class="ms-1 text-danger text-decoration-none">&times;</a>
            </span>
        @endif
        <a href="{{ route('publications.articles') }}" class="small text-danger text-decoration-none ms-2">
            <i class="fas fa-times-circle me-1"></i>সব রিসেট করুন
        </a>
    </div>
@endif

<!-- Articles Grid -->
<div class="row g-4">
    @forelse($articles as $article)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden article-modern-card d-flex flex-column">
                <!-- 1:1 Aspect Ratio Feature Image (ফিচার ইমেজ 1:1 অনুপাত) -->
                <a href="{{ route('publications.articles.read', $article->id) }}" class="article-square-thumb-wrap text-decoration-none d-block position-relative">
                    @if($article->cover_image && Storage::disk('public')->exists($article->cover_image))
                        <img src="{{ Storage::url($article->cover_image) }}" 
                             alt="{{ $article->title }}" 
                             class="article-square-img" 
                             loading="lazy">
                    @else
                        <div class="article-fallback-banner d-flex flex-column align-items-center justify-content-center text-white h-100 p-4 text-center">
                            <i class="fas fa-feather-alt fa-3x text-warning mb-2"></i>
                            <span class="fw-bold fs-6">গবেষণামূলক প্রবন্ধ</span>
                        </div>
                    @endif
                    
                    <!-- Floating Category Badge -->
                    <span class="article-badge-floating">
                        <i class="fas fa-book-reader me-1"></i> {{ $article->category ?? 'গবেষণামূলক প্রবন্ধ' }}
                    </span>
                </a>

                <!-- Card Body -->
                <div class="card-body p-3 p-md-4 d-flex flex-column flex-grow-1">
                    <div class="d-flex align-items-center gap-2 text-muted small mb-2 flex-wrap">
                        <span>
                            <i class="far fa-calendar-alt text-success me-1"></i>
                            {{ $article->publication_date ? $article->publication_date->format('d M, Y') : ($article->created_at ? $article->created_at->format('d M, Y') : '২০২৫') }}
                        </span>
                        @if($article->author)
                            <span>•</span>
                            <span class="text-truncate" style="max-width: 170px;">
                                <i class="fas fa-pen-nib text-warning me-1"></i> {{ $article->author }}
                            </span>
                        @endif
                    </div>

                    <h3 class="article-title fs-5 fw-bold mb-2">
                        <a href="{{ route('publications.articles.read', $article->id) }}" class="text-decoration-none text-dark hover-green">
                            {{ $article->title }}
                        </a>
                    </h3>

                    @if($article->description)
                        <p class="article-excerpt text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            {{ Str::limit(strip_tags($article->description), 125) }}
                        </p>
                    @else
                        <div class="flex-grow-1"></div>
                    @endif

                    <div class="mt-auto pt-3 border-top d-flex align-items-center gap-2">
                        <a href="{{ route('publications.articles.read', $article->id) }}" 
                           class="btn btn-sm btn-success rounded-pill px-3 py-2 fw-semibold flex-grow-1 d-flex align-items-center justify-content-center gap-1"
                           style="background: #0C4B36; border-color: #0C4B36;">
                            <span>সম্পূর্ণ প্রবন্ধ পড়ুন</span> <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                        @if($article->pdf_file && Storage::disk('public')->exists($article->pdf_file))
                            <a href="{{ Storage::url($article->pdf_file) }}" 
                               class="btn btn-sm btn-outline-success rounded-circle p-2 d-flex align-items-center justify-content-center" 
                               style="width: 36px; height: 36px;" download title="PDF কপি ডাউনলোড">
                                <i class="fas fa-download"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-3">
                <i class="fas fa-feather-alt fa-3x text-muted mb-3 opacity-50"></i>
                <h4 class="fw-bold text-dark mb-2">কোনো প্রবন্ধ বা আর্টিকেল পাওয়া যায়নি</h4>
                <p class="text-muted mb-3">অনুগ্রহ করে ভিন্ন কোনো শব্দ বা ক্যাটাগরি দিয়ে চেষ্টা করুন।</p>
                <div>
                    <a href="{{ route('publications.articles') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                        <i class="fas fa-undo me-1"></i> সকল প্রবন্ধ দেখুন
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div>

<!-- Unified Pagination Component -->
{{ $articles->links() }}
@endsection

@section('page-styles')
<style>
    .article-modern-card {
        background: #ffffff;
        border: 1px solid rgba(12, 75, 54, 0.08) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .article-modern-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 30px rgba(12, 75, 54, 0.12) !important;
        border-color: #0C4B36 !important;
    }
    
    /* 1:1 Exact Aspect Ratio Thumbnail Wrapper */
    .article-square-thumb-wrap {
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: #f1f5f9;
    }
    .article-square-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.45s ease;
    }
    .article-modern-card:hover .article-square-img {
        transform: scale(1.05);
    }
    .article-fallback-banner {
        background: linear-gradient(135deg, #072d20 0%, #0C4B36 50%, #176B4E 100%);
    }
    .article-badge-floating {
        position: absolute;
        top: 14px;
        right: 14px;
        background: rgba(7, 49, 35, 0.88);
        backdrop-filter: blur(4px);
        color: #FBB040;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }
    .article-title a {
        color: #1a202c;
        line-height: 1.45;
        transition: color 0.2s ease;
    }
    .hover-green:hover {
        color: #0C4B36 !important;
    }
</style>
@endsection
