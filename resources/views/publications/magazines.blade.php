@extends('layouts.page')

@section('title', 'মাসিক শুব্বান ও ম্যাগাজিন আর্কাইভ')
@section('category', 'প্রকাশনা')
@section('subtitle', 'দ্বিমাসিক ও মাসিক সাহিত্য-দাওয়াহ ম্যাগাজিন, সম্পাদকীয় ও বিশেষ সংখ্যা সম্ভার')

@section('meta_description', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর মুখপত্র ও মাসিক ম্যাগাজিন সংখ্যাসমূহ। অনলাইনে সরাসরি পড়ুন অথবা পিডিএফ কপি ডাউনলোড করুন।')
@section('meta_keywords', 'মাসিক শুব্বান, ম্যাগাজিন, আহলে হাদীস সাময়িকী, ইসলামিক ম্যাগাজিন, শুব্বান আর্কাইভ')

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
    <form action="{{ route('publications.magazines') }}" method="GET" class="row g-3 align-items-end">
        <!-- Search Keyword -->
        <div class="col-12 col-md-5">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-search text-success me-1"></i> সংখ্যা বা বিষয় দিয়ে খুঁজুন
            </label>
            <div class="input-group">
                <input type="text" name="search" class="form-control rounded-start-pill ps-3" 
                       placeholder="উদাঃ সংখ্যা নং, বিষয়, শিরোনাম..." 
                       value="{{ request('search') }}">
                @if(request('search'))
                    <a href="{{ route('publications.magazines', request()->except('search')) }}" class="btn btn-outline-secondary border-start-0" title="মুছে ফেলুন">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </div>

        <!-- Year Filter -->
        <div class="col-6 col-md-3">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-calendar-alt text-warning me-1"></i> প্রকাশের বছর
            </label>
            <select name="year" class="form-select rounded-pill">
                <option value="">সকল বছর</option>
                @foreach($years as $yr)
                    <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $toBn($yr) }} খ্রিষ্টাব্দ</option>
                @endforeach
            </select>
        </div>

        <!-- Sort Filter -->
        <div class="col-6 col-md-2">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-sort-amount-down text-info me-1"></i> সাজানো
            </label>
            <select name="sort" class="form-select rounded-pill">
                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>সর্বশেষ সংখ্যা</option>
                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>প্রাচীনতম আগে</option>
            </select>
        </div>

        <!-- Submit & Reset Buttons -->
        <div class="col-12 col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-success rounded-pill w-100 fw-bold shadow-sm" style="background: #0C4B36; border-color: #0C4B36;">
                <i class="fas fa-filter me-1"></i> ফিল্টার
            </button>
            @if(request()->anyFilled(['search', 'year', 'sort']))
                <a href="{{ route('publications.magazines') }}" class="btn btn-outline-secondary rounded-pill" title="ফিল্টার রিসেট">
                    <i class="fas fa-undo"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Active Filter Pills Strip -->
@if(request()->anyFilled(['search', 'year']))
    <div class="d-flex align-items-center gap-2 mb-4 flex-wrap">
        <span class="small text-muted fw-bold">সক্রিয় ফিল্টার:</span>
        @if(request('search'))
            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                কীওয়ার্ড: "{{ request('search') }}"
                <a href="{{ route('publications.magazines', request()->except('search')) }}" class="ms-1 text-danger text-decoration-none">&times;</a>
            </span>
        @endif
        @if(request('year'))
            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                বছর: {{ $toBn(request('year')) }}
                <a href="{{ route('publications.magazines', request()->except('year')) }}" class="ms-1 text-danger text-decoration-none">&times;</a>
            </span>
        @endif
        <a href="{{ route('publications.magazines') }}" class="small text-danger text-decoration-none ms-2">
            <i class="fas fa-times-circle me-1"></i>সব রিসেট করুন
        </a>
    </div>
@endif

<!-- Featured Latest Issue Banner (Only on Page 1 when no filter active) -->
@if(!request()->anyFilled(['search', 'year']) && $magazines->currentPage() == 1 && isset($latestMagazine))
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5 bg-white border-start-gold">
        <div class="row g-0 align-items-center">
            <div class="col-md-4 text-center p-4 bg-light">
                <div class="magazine-featured-cover-box d-inline-block position-relative">
                    @if($latestMagazine->cover_image && Storage::disk('public')->exists($latestMagazine->cover_image))
                        <img src="{{ Storage::url($latestMagazine->cover_image) }}" alt="{{ $latestMagazine->title }}" class="img-fluid rounded-3 shadow">
                    @else
                        <div class="p-5 text-muted">
                            <i class="fas fa-newspaper fa-4x text-success opacity-50 mb-2"></i>
                            <div>কভার ছবি সংযুক্ত নেই</div>
                        </div>
                    @endif
                    <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 px-3 py-2 rounded-pill fw-bold shadow-sm">
                        <i class="fas fa-star me-1"></i> সর্বশেষ প্রকাশিত সংখ্যা
                    </span>
                </div>
            </div>
            <div class="col-md-8 p-4 p-lg-5">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold">
                        সংখ্যা #{{ $toBn($latestMagazine->issue_number ?? '১') }}
                    </span>
                    @if($latestMagazine->publication_date)
                        <span class="text-muted small">
                            <i class="far fa-calendar-alt text-success me-1"></i>
                            {{ $latestMagazine->publication_date->format('F, Y') }}
                        </span>
                    @endif
                </div>
                <h3 class="fw-bold mb-3 fs-3" style="color: #0C4B36;">{{ $latestMagazine->title }}</h3>
                @if($latestMagazine->description)
                    <p class="text-secondary mb-4 lh-base" style="font-size: 0.95rem;">
                        {{ Str::limit(strip_tags($latestMagazine->description), 220) }}
                    </p>
                @endif
                <div class="d-flex flex-wrap gap-2">
                    @if($latestMagazine->pdf_file && Storage::disk('public')->exists($latestMagazine->pdf_file))
                        <a href="{{ route('publications.magazines.read', $latestMagazine) }}" class="btn btn-success rounded-pill px-4 py-2 fw-semibold shadow-sm" style="background: #0C4B36; border-color: #0C4B36;">
                            <i class="fas fa-book-reader me-1"></i> সরাসরি পড়ুন
                        </a>
                        <a href="{{ Storage::url($latestMagazine->pdf_file) }}" class="btn btn-outline-success rounded-pill px-3 py-2 fw-semibold" download>
                            <i class="fas fa-download me-1"></i> PDF ডাউনলোড
                        </a>
                    @endif
                    <a href="{{ route('publications.magazines.details', $latestMagazine) }}" class="btn btn-light border rounded-pill px-3 py-2 fw-semibold text-secondary">
                        <i class="fas fa-info-circle me-1"></i> সূচিপত্র ও বিস্তারিত
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Magazines Grid -->
<div class="row g-3 g-md-4">
    @forelse($magazines as $magazine)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden magazine-card-grid d-flex flex-column bg-white">
                <!-- Magazine Cover Container (Aspect Ratio 3:4, No Cutoff) -->
                <div class="magazine-cover-box position-relative">
                    <a href="{{ route('publications.magazines.details', $magazine) }}" class="d-block w-100 h-100 text-decoration-none">
                        @if($magazine->cover_image && Storage::disk('public')->exists($magazine->cover_image))
                            <img src="{{ Storage::url($magazine->cover_image) }}" 
                                 alt="{{ $magazine->title }}" 
                                 class="magazine-cover-full" 
                                 loading="lazy">
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center text-muted h-100 p-3 text-center">
                                <i class="fas fa-newspaper fa-3x text-success mb-2 opacity-50"></i>
                                <span class="small fw-bold">{{ $magazine->title }}</span>
                            </div>
                        @endif
                    </a>

                    <!-- Issue Number Badge -->
                    <span class="position-absolute top-0 start-0 m-2 badge bg-success text-white rounded-pill px-2 py-1 shadow-sm font-xs fw-bold">
                        সংখ্যা #{{ $toBn($magazine->issue_number ?? '১') }}
                    </span>
                </div>

                <!-- Body -->
                <div class="card-body p-3 d-flex flex-column flex-grow-1">
                    <div class="text-muted small mb-1" style="font-size: 0.8rem;">
                        <i class="far fa-calendar-alt text-success me-1"></i>
                        {{ $magazine->publication_date ? $magazine->publication_date->format('M, Y') : '২০২৫' }}
                    </div>

                    <h4 class="magazine-title fs-6 fw-bold mb-2" title="{{ $magazine->title }}">
                        <a href="{{ route('publications.magazines.details', $magazine) }}" class="text-decoration-none text-dark hover-green">
                            {{ $magazine->title }}
                        </a>
                    </h4>

                    @if($magazine->description)
                        <p class="magazine-excerpt text-secondary small mb-3 flex-grow-1" style="line-height: 1.45;">
                            {{ Str::limit(strip_tags($magazine->description), 65) }}
                        </p>
                    @else
                        <div class="flex-grow-1"></div>
                    @endif

                    <div class="d-flex gap-1 mt-auto pt-2 border-top">
                        @if($magazine->pdf_file && Storage::disk('public')->exists($magazine->pdf_file))
                            <a href="{{ route('publications.magazines.read', $magazine) }}" 
                               class="btn btn-sm btn-success rounded-pill px-2 py-1 flex-grow-1 fw-semibold d-flex align-items-center justify-content-center gap-1 font-xs"
                               style="background: #0C4B36; border-color: #0C4B36;">
                                <i class="fas fa-book-reader"></i> <span>পড়ুন</span>
                            </a>
                            <a href="{{ Storage::url($magazine->pdf_file) }}" 
                               class="btn btn-sm btn-outline-success rounded-circle p-1 d-flex align-items-center justify-content-center" 
                               style="width: 30px; height: 30px;" download title="PDF ডাউনলোড">
                                <i class="fas fa-download"></i>
                            </a>
                        @endif
                        <a href="{{ route('publications.magazines.details', $magazine) }}" 
                           class="btn btn-sm btn-light border rounded-circle p-1 d-flex align-items-center justify-content-center ms-auto" 
                           style="width: 30px; height: 30px;" title="বিস্তারিত">
                            <i class="fas fa-info text-secondary"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-3">
                <i class="fas fa-newspaper fa-3x text-muted mb-3 opacity-50"></i>
                <h4 class="fw-bold text-dark mb-2">কোনো ম্যাগাজিন বা সাময়িকী পাওয়া যায়নি</h4>
                <p class="text-muted mb-3">আপনার অনুসন্ধান ফিল্টারের সাথে মিলে এমন কোনো সংখ্যা খুঁজে পাওয়া যায়নি।</p>
                <div>
                    <a href="{{ route('publications.magazines') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                        <i class="fas fa-undo me-1"></i> সকল সংখ্যা দেখুন
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div>

<!-- Unified Pagination Component -->
{{ $magazines->links() }}
@endsection

@section('page-styles')
<style>
    .border-start-gold {
        border-left: 4px solid #FBB040 !important;
    }
    .magazine-card-grid {
        border: 1px solid rgba(12, 75, 54, 0.08) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .magazine-card-grid:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(12, 75, 54, 0.12) !important;
        border-color: #0C4B36 !important;
    }
    .magazine-cover-box {
        height: 270px;
        background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px;
        overflow: hidden;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    .magazine-cover-full {
        max-height: 100%;
        max-width: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 4px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.14);
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }
    .magazine-card-grid:hover .magazine-cover-full {
        transform: scale(1.04) translateY(-2px);
        box-shadow: 0 8px 20px rgba(12, 75, 54, 0.22);
    }
    .magazine-title a {
        color: #1a202c;
        transition: color 0.2s ease;
    }
    .hover-green:hover {
        color: #0C4B36 !important;
    }
    .font-xs {
        font-size: 0.78rem;
    }
    @media (max-width: 575.98px) {
        .magazine-cover-box {
            height: 200px;
            padding: 8px;
        }
    }
</style>
@endsection
