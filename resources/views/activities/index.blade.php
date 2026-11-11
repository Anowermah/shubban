@extends('layouts.page')

@section('title', 'আমাদের সামগ্রিক দাওয়াহ ও সাংগঠনিক কার্যক্রম')
@section('category', 'কার্যক্রম')
@section('subtitle', 'কুরআন ও সুন্নাহর প্রচার, যুব সমাজের প্রশিক্ষণ, নৈতিক মানোন্নয়ন এবং সমাজকল্যাণমূলক বহুমুখী কর্মসূচি')

@section('meta_description', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর সাংগঠনিক ও সমাজকল্যাণমূলক কার্যক্রম। জেলা সমাবেশ, প্রশিক্ষণ কোর্স ও ত্রাণ বিতরণ কর্মসূচি।')
@section('meta_keywords', 'শুব্বান কার্যক্রম, দাওয়াহ কর্মসূচি, যুব প্রশিক্ষণ, ইসলামী সমাজ সংস্কার, আহলে হাদীস কার্যক্রম')

@section('page-content')
@php
    $toBn = function($number) {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, (string)$number);
    };
@endphp

<!-- Search Filter Bar -->
<div class="card border-0 shadow-sm rounded-4 mb-4 p-3 p-md-4 bg-white">
    <form action="{{ route('activities.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-9">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-search text-success me-1"></i> কার্যক্রম বা কর্মসূচির বিষয় খুঁজুন
            </label>
            <div class="input-group">
                <input type="text" name="search" class="form-control rounded-start-pill ps-3" 
                       placeholder="উদাঃ সম্মেলন, কর্মশালা, কোর্স, ত্রাণ বিতরণ..." 
                       value="{{ request('search') }}">
                @if(request('search'))
                    <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary border-start-0" title="মুছে ফেলুন">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-success rounded-pill w-100 fw-bold shadow-sm" style="background: #0C4B36; border-color: #0C4B36;">
                <i class="fas fa-filter me-1"></i> খুঁজুন
            </button>
            @if(request('search'))
                <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary rounded-pill" title="ফিল্টার রিসেট">
                    <i class="fas fa-undo"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Active Filter Pills Strip -->
@if(request('search'))
    <div class="d-flex align-items-center gap-2 mb-4 flex-wrap">
        <span class="small text-muted fw-bold">সক্রিয় ফিল্টার:</span>
        <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
            কীওয়ার্ড: "{{ request('search') }}"
            <a href="{{ route('activities.index') }}" class="ms-1 text-danger text-decoration-none">&times;</a>
        </span>
        <a href="{{ route('activities.index') }}" class="small text-danger text-decoration-none ms-2">
            <i class="fas fa-times-circle me-1"></i>রিসেট করুন
        </a>
    </div>
@endif

<!-- Activities Grid -->
<div class="row g-4">
    @forelse($activities as $activity)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden activity-modern-card d-flex flex-column bg-white">
                <a href="{{ route('activities.show', $activity) }}" class="activity-thumb-box text-decoration-none d-block position-relative">
                    @if($activity->image && Storage::disk('public')->exists($activity->image))
                        <img src="{{ asset('storage/' . $activity->image) }}" 
                             alt="{{ $activity->title }}" 
                             class="activity-img" 
                             loading="lazy">
                    @else
                        <div class="activity-fallback d-flex flex-column align-items-center justify-content-center text-white h-100 p-4 text-center">
                            <i class="fas fa-calendar-check fa-3x text-warning mb-2"></i>
                            <span class="fw-bold fs-6">সাংগঠনিক কার্যক্রম</span>
                        </div>
                    @endif
                    
                    <span class="activity-date-badge">
                        <i class="far fa-calendar-alt me-1 text-warning"></i>
                        {{ $activity->created_at ? $activity->created_at->format('d M, Y') : '২০২৫' }}
                    </span>
                </a>

                <div class="card-body p-3 p-md-4 d-flex flex-column flex-grow-1">
                    <h3 class="activity-title fs-5 fw-bold mb-2">
                        <a href="{{ route('activities.show', $activity) }}" class="text-decoration-none text-dark hover-green">
                            {{ $activity->title }}
                        </a>
                    </h3>

                    @if($activity->description)
                        <p class="activity-excerpt text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            {{ Str::limit(strip_tags($activity->description), 130) }}
                        </p>
                    @else
                        <div class="flex-grow-1"></div>
                    @endif

                    <div class="mt-auto pt-3 border-top">
                        <a href="{{ route('activities.show', $activity) }}" 
                           class="btn btn-sm btn-outline-success rounded-pill px-3 py-2 fw-semibold w-100 d-flex align-items-center justify-content-center gap-1">
                            <span>বিস্তারিত দেখুন</span> <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-3">
                <i class="fas fa-folder-open fa-3x text-muted mb-3 opacity-50"></i>
                <h4 class="fw-bold text-dark mb-2">কোনো কার্যক্রম পাওয়া যায়নি</h4>
                <p class="text-muted mb-3">আপনার অনুসন্ধান ফিল্টারের সাথে মিলে এমন কোনো কার্যক্রম খুঁজে পাওয়া যায়নি।</p>
                <div>
                    <a href="{{ route('activities.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                        <i class="fas fa-undo me-1"></i> সকল কার্যক্রম দেখুন
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div>

<!-- Unified Pagination Component -->
{{ $activities->links() }}
@endsection

@section('page-styles')
<style>
    .activity-modern-card {
        border: 1px solid rgba(12, 75, 54, 0.08) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .activity-modern-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px rgba(12, 75, 54, 0.12) !important;
        border-color: #0C4B36 !important;
    }
    .activity-thumb-box {
        width: 100%;
        height: 220px;
        overflow: hidden;
        background: #f1f5f9;
    }
    .activity-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.4s ease;
    }
    .activity-modern-card:hover .activity-img {
        transform: scale(1.06);
    }
    .activity-fallback {
        background: linear-gradient(135deg, #072d20 0%, #0C4B36 50%, #176B4E 100%);
    }
    .activity-date-badge {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(7, 49, 35, 0.9);
        backdrop-filter: blur(4px);
        color: #ffffff;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }
    .activity-title a {
        color: #1a202c;
        line-height: 1.45;
        transition: color 0.2s ease;
    }
    .hover-green:hover {
        color: #0C4B36 !important;
    }
</style>
@endsection
