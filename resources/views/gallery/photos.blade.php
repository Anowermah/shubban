@extends('layouts.page')

@section('title', 'দৃষ্টিজুড়ানো স্থিরচিত্র ও ফটো গ্যালারি')
@section('category', 'গ্যালারি')
@section('subtitle', 'জাতীয় সম্মেলন, কেন্দ্রীয় সমাবেশ, যুব প্রশিক্ষণ ও সমাজকল্যাণমূলক আয়োজনের মুহূর্তসমূহ')

@section('meta_description', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর ফটো গ্যালারি। জাতীয় সম্মেলন ও বিভিন্ন ঐতিহাসিক কর্মসূচির আলোকচিত্র।')
@section('meta_keywords', 'শুব্বান ফটো গ্যালারি, জাতীয় সম্মেলন ছবি, যুব সমাবেশ স্থিরচিত্র, আহলে হাদীস ছবি')

@section('page-content')
@php
    $toBn = function($number) {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, (string)$number);
    };
@endphp

<!-- Category Filters -->
@if(isset($categories) && $categories->isNotEmpty())
    <div class="card border-0 shadow-sm rounded-4 mb-4 p-3 bg-white">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="small fw-bold text-muted me-2"><i class="fas fa-filter text-success me-1"></i>ক্যাটাগরি ফিল্টার:</span>
                <a href="{{ route('gallery.photos') }}" 
                   class="btn btn-sm rounded-pill px-3 {{ !request('category') ? 'btn-success fw-bold' : 'btn-outline-secondary' }}">
                    সকল ছবি
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('gallery.photos', ['category' => $category]) }}" 
                       class="btn btn-sm rounded-pill px-3 {{ request('category') == $category ? 'btn-success fw-bold' : 'btn-outline-secondary' }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
            <div>
                <a href="{{ route('gallery.videos') }}" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                    <i class="fab fa-youtube text-danger me-1"></i> ভিডিও গ্যালারি
                </a>
            </div>
        </div>
    </div>
@endif

<!-- Gallery Grid -->
<div class="row g-3 g-md-4">
    @forelse($photos as $photo)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden photo-card-item bg-white">
                <div class="photo-thumb-container position-relative">
                    <a href="{{ asset($photo->image_url) }}" 
                       data-fancybox="gallery" 
                       data-caption="{{ $photo->title }}">
                        <img src="{{ asset($photo->image_url) }}" 
                             class="photo-thumb-img" 
                             alt="{{ $photo->title }}" 
                             loading="lazy">
                        <div class="photo-hover-overlay">
                            <div class="zoom-pill">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                    </a>
                    @if($photo->category)
                        <span class="photo-category-tag">
                            {{ $photo->category }}
                        </span>
                    @endif
                </div>
                <div class="card-body p-3 d-flex flex-column">
                    <h4 class="photo-card-title fs-6 fw-bold mb-1 text-truncate" title="{{ $photo->title }}">
                        {{ $photo->title }}
                    </h4>
                    @if($photo->date)
                        <div class="text-muted small mt-auto pt-1">
                            <i class="far fa-calendar-alt text-success me-1"></i> 
                            {{ $photo->date->format('d/m/Y') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-3">
                <i class="fas fa-images fa-3x text-muted mb-3 opacity-50"></i>
                <h4 class="fw-bold text-dark mb-2">কোনো ছবি পাওয়া যায়নি</h4>
                <p class="text-muted mb-3">নির্বাচিত ক্যাটাগরিতে এই মুহূর্তে কোনো ছবি নেই।</p>
                <div>
                    <a href="{{ route('gallery.photos') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                        <i class="fas fa-undo me-1"></i> সকল ছবি দেখুন
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div>

<!-- Unified Pagination Component -->
{{ $photos->links() }}
@endsection

@section('page-styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
<style>
    .photo-card-item {
        border: 1px solid rgba(12, 75, 54, 0.08) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .photo-card-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(12, 75, 54, 0.12) !important;
        border-color: #0C4B36 !important;
    }
    .photo-thumb-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: #f1f5f9;
    }
    .photo-thumb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.45s ease;
    }
    .photo-card-item:hover .photo-thumb-img {
        transform: scale(1.08);
    }
    .photo-hover-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(7, 49, 35, 0.45);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .photo-card-item:hover .photo-hover-overlay {
        opacity: 1;
    }
    .zoom-pill {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.95);
        color: #0C4B36;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
    .photo-category-tag {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(7, 49, 35, 0.85);
        backdrop-filter: blur(4px);
        color: #FBB040;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 12px;
    }
    .photo-card-title {
        color: #1a202c;
    }
</style>
@endsection

@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox]", {});
</script>
@endsection
