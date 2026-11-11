@extends('layouts.page')

@section('title', 'ভিডিও লেকচার ও প্রামাণ্যচিত্র')
@section('category', 'গ্যালারি')
@section('subtitle', 'জাতীয় নেতৃবৃন্দের গুরুত্বপূর্ণ নসীহত, সম্মেলন আলোচনা, কুরআন তিলাওয়াত ও দাওয়াহ প্রামাণ্যচিত্র')

@section('meta_description', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর অফিসিয়াল ভিডিও গ্যালারি। জাতীয় সম্মেলন, আলোচনা সভা ও তাত্ত্বিক নসীহতের ভিডিওসমূহ।')
@section('meta_keywords', 'শুব্বান ভিডিও, আহলে হাদীস লেকচার, সম্মেলন বক্তব্য, ইসলামিক ভিডিও')

@section('page-content')
@php
    $toBn = function($number) {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, (string)$number);
    };
@endphp

<!-- Category Filter Strip -->
@if(isset($categories) && $categories->isNotEmpty())
    <div class="card border-0 shadow-sm rounded-4 mb-4 p-3 bg-white">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="small fw-bold text-muted me-2"><i class="fas fa-filter text-success me-1"></i>ক্যাটাগরি ফিল্টার:</span>
                <a href="{{ route('gallery.videos') }}" 
                   class="btn btn-sm rounded-pill px-3 {{ !request('category') ? 'btn-danger fw-bold text-white' : 'btn-outline-secondary' }}">
                    সকল ভিডিও
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('gallery.videos', ['category' => $category]) }}" 
                       class="btn btn-sm rounded-pill px-3 {{ request('category') == $category ? 'btn-danger fw-bold text-white' : 'btn-outline-secondary' }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
            <div>
                <a href="{{ route('gallery.photos') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                    <i class="fas fa-images text-success me-1"></i> ফটো গ্যালারি
                </a>
            </div>
        </div>
    </div>
@endif

<!-- Videos Grid -->
<div class="row g-4">
    @forelse($videos as $video)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden video-card-item bg-white">
                <a href="{{ $video->video_url }}" 
                   data-fancybox="video-gallery"
                   data-caption="{{ $video->title }}"
                   class="video-thumb-container text-decoration-none d-block position-relative">
                    @php
                        $videoId = '';
                        if (strpos($video->video_url, 'youtube.com') !== false) {
                            parse_str(parse_url($video->video_url, PHP_URL_QUERY), $params);
                            $videoId = $params['v'] ?? '';
                        } elseif (strpos($video->video_url, 'youtu.be') !== false) {
                            $videoId = basename(parse_url($video->video_url, PHP_URL_PATH));
                        }
                    @endphp
                    
                    <img src="{{ $videoId ? 'https://img.youtube.com/vi/'.$videoId.'/mqdefault.jpg' : asset('images/video-placeholder.jpg') }}" 
                         alt="{{ $video->title }}"
                         class="video-thumb-img" 
                         loading="lazy">
                    
                    <div class="video-play-pulse-btn">
                        <i class="fas fa-play"></i>
                    </div>

                    @if($video->category)
                        <span class="video-category-tag">
                            {{ $video->category }}
                        </span>
                    @endif
                </a>

                <div class="card-body p-3 p-md-4 d-flex flex-column flex-grow-1">
                    <h3 class="video-title fs-6 fw-bold mb-2">
                        <a href="{{ $video->video_url }}" data-fancybox="video-gallery-title" data-caption="{{ $video->title }}" class="text-decoration-none text-dark hover-green">
                            {{ $video->title }}
                        </a>
                    </h3>

                    @if($video->description)
                        <p class="video-desc text-secondary small mb-3 flex-grow-1" style="line-height: 1.5;">
                            {{ Str::limit(strip_tags($video->description), 90) }}
                        </p>
                    @else
                        <div class="flex-grow-1"></div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top text-muted small">
                        <span>
                            <i class="far fa-calendar-alt text-success me-1"></i>
                            {{ $video->date ? $video->date->format('d/m/Y') : '২০২৫' }}
                        </span>
                        <span class="text-danger fw-semibold">
                            <i class="fab fa-youtube me-1"></i> ইউটিউব প্লেয়ার
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-3">
                <i class="fab fa-youtube fa-3x text-muted mb-3 opacity-50"></i>
                <h4 class="fw-bold text-dark mb-2">কোনো ভিডিও পাওয়া যায়নি</h4>
                <p class="text-muted mb-3">নির্বাচিত ক্যাটাগরিতে এই মুহূর্তে কোনো ভিডিও নেই।</p>
                <div>
                    <a href="{{ route('gallery.videos') }}" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                        <i class="fas fa-undo me-1"></i> সকল ভিডিও দেখুন
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div>

<!-- Unified Pagination Component -->
{{ $videos->links() }}
@endsection

@section('page-styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
<style>
    .video-card-item {
        border: 1px solid rgba(12, 75, 54, 0.08) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .video-card-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 28px rgba(12, 75, 54, 0.12) !important;
        border-color: #0C4B36 !important;
    }
    .video-thumb-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: #111827;
    }
    .video-thumb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.45s ease;
    }
    .video-card-item:hover .video-thumb-img {
        transform: scale(1.06);
    }
    .video-play-pulse-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: rgba(220, 38, 38, 0.9);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        transition: all 0.3s ease;
        padding-left: 3px;
    }
    .video-card-item:hover .video-play-pulse-btn {
        transform: translate(-50%, -50%) scale(1.12);
        background: #dc2626;
    }
    .video-category-tag {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(4px);
        color: #FBB040;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 12px;
    }
    .video-title a {
        color: #1a202c;
        line-height: 1.45;
        transition: color 0.2s ease;
    }
    .hover-green:hover {
        color: #0C4B36 !important;
    }
</style>
@endsection

@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox]", {});
</script>
@endsection
