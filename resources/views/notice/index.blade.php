@extends('layouts.page')

@section('title', 'প্রাতিষ্ঠানিক ডিজিটাল নোটিশ বোর্ড')
@section('category', 'বিজ্ঞপ্তি')
@section('subtitle', 'কেন্দ্রীয় ও শাখা পর্যায়ের সকল সাংগঠনিক নোটিশ, দিকনির্দেশনা, সার্কুলার ও জরুরি বিজ্ঞপ্তি')

@section('meta_description', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর ডিজিটাল নোটিশ বোর্ড। সম্মেলন, প্রশিক্ষণ ও সাংগঠনিক নোটিশসমূহ দেখুন ও ডাউনলোড করুন।')
@section('meta_keywords', 'শুব্বান নোটিশ, সাংগঠনিক বিজ্ঞপ্তি, প্রশিক্ষণ নোটিশ, আহলে হাদীস সার্কুলার')

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
    <form action="{{ route('notice.index') }}" method="GET" class="row g-3 align-items-end">
        <!-- Search Keyword -->
        <div class="col-12 col-md-5">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-search text-success me-1"></i> নোটিশ খুঁজুন
            </label>
            <div class="input-group">
                <input type="text" name="search" class="form-control rounded-start-pill ps-3" 
                       placeholder="উদাঃ সম্মেলন, সভা, প্রশিক্ষণ, সার্কুলার..." 
                       value="{{ request('search') }}">
                @if(request('search'))
                    <a href="{{ route('notice.index', request()->except('search')) }}" class="btn btn-outline-secondary border-start-0" title="মুছে ফেলুন">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </div>

        <!-- Category Filter -->
        <div class="col-6 col-md-3">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-folder text-warning me-1"></i> ক্যাটাগরি
            </label>
            <select name="category" class="form-select rounded-pill">
                <option value="">সকল ক্যাটাগরি</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                        {{ ucfirst($cat) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Year Filter -->
        <div class="col-6 col-md-2">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-calendar-alt text-info me-1"></i> বছর
            </label>
            <select name="year" class="form-select rounded-pill">
                <option value="">সকল বছর</option>
                @for($y = date('Y'); $y >= 2023; $y--)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $toBn($y) }}</option>
                @endfor
            </select>
        </div>

        <!-- Submit & Reset Buttons -->
        <div class="col-12 col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-success rounded-pill w-100 fw-bold shadow-sm" style="background: #0C4B36; border-color: #0C4B36;">
                <i class="fas fa-filter me-1"></i> ফিল্টার
            </button>
            @if(request()->anyFilled(['search', 'category', 'year']))
                <a href="{{ route('notice.index') }}" class="btn btn-outline-secondary rounded-pill" title="ফিল্টার রিসেট">
                    <i class="fas fa-undo"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Active Filter Pills Strip -->
@if(request()->anyFilled(['search', 'category', 'year']))
    <div class="d-flex align-items-center gap-2 mb-4 flex-wrap">
        <span class="small text-muted fw-bold">সক্রিয় ফিল্টার:</span>
        @if(request('search'))
            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                কীওয়ার্ড: "{{ request('search') }}"
                <a href="{{ route('notice.index', request()->except('search')) }}" class="ms-1 text-danger text-decoration-none">&times;</a>
            </span>
        @endif
        @if(request('category'))
            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                ক্যাটাগরি: {{ ucfirst(request('category')) }}
                <a href="{{ route('notice.index', request()->except('category')) }}" class="ms-1 text-danger text-decoration-none">&times;</a>
            </span>
        @endif
        @if(request('year'))
            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                বছর: {{ $toBn(request('year')) }}
                <a href="{{ route('notice.index', request()->except('year')) }}" class="ms-1 text-danger text-decoration-none">&times;</a>
            </span>
        @endif
        <a href="{{ route('notice.index') }}" class="small text-danger text-decoration-none ms-2">
            <i class="fas fa-times-circle me-1"></i>সব রিসেট করুন
        </a>
    </div>
@endif

<!-- Notices List Grid -->
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0 fs-5" style="color: #0C4B36;">
                    <i class="fas fa-clipboard-list text-warning me-2"></i>বিজ্ঞপ্তিসমূহ
                </h4>
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 font-sm">
                    মোট {{ $toBn($notices->total()) }} টি নোটিশ
                </span>
            </div>
            <div class="card-body p-3 p-md-4">
                @forelse($notices as $notice)
                    <div class="notice-item-card p-3 p-md-4 mb-3 rounded-4 border bg-white transition-card">
                        <div class="d-flex align-items-center justify-content-between mb-2 flex-wrap gap-2">
                            <span class="badge px-3 py-1 rounded-pill bg-success-subtle text-success small fw-bold">
                                <i class="fas fa-tag me-1"></i> {{ ucfirst($notice->category ?? 'সাধারণ') }}
                            </span>
                            <span class="text-muted small">
                                <i class="far fa-calendar-alt text-success me-1"></i>
                                {{ $notice->created_at ? $notice->created_at->format('d F, Y') : '২০২৫' }}
                            </span>
                        </div>

                        <h3 class="notice-title fs-5 fw-bold mb-2">
                            <a href="javascript:void(0)" class="text-decoration-none text-dark hover-green" data-bs-toggle="modal" data-bs-target="#noticeModal{{ $notice->id }}">
                                {{ $notice->title }}
                            </a>
                        </h3>

                        @if($notice->description)
                            <p class="notice-excerpt text-secondary mb-3 lh-base" style="font-size: 0.94rem;">
                                {{ Str::limit(strip_tags($notice->description), 140) }}
                            </p>
                        @endif

                        <div class="d-flex flex-wrap align-items-center gap-2 pt-2 border-top">
                            <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1 fw-semibold font-xs" data-bs-toggle="modal" data-bs-target="#noticeModal{{ $notice->id }}">
                                <i class="fas fa-eye me-1"></i> বিস্তারিত দেখুন
                            </button>
                            @if($notice->file && Storage::disk('public')->exists($notice->file))
                                <a href="{{ asset('storage/' . $notice->file) }}" class="btn btn-sm btn-success rounded-pill px-3 py-1 fw-semibold font-xs shadow-sm" style="background: #0C4B36; border-color: #0C4B36;" download>
                                    <i class="fas fa-file-pdf me-1"></i>
                                    {{ $notice->isPDF() ? 'PDF ডাউনলোড' : 'ফাইল ডাউনলোড' }}
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-bell-slash fa-3x mb-3 text-secondary opacity-50 d-block"></i>
                        <h5 class="fw-bold text-dark">কোনো বিজ্ঞপ্তি পাওয়া যায়নি</h5>
                        <p class="small text-muted mb-3">আপনার অনুসন্ধান ফিল্টারের সাথে মিলে এমন কোনো নোটিশ এই মুহূর্তে নেই।</p>
                        <a href="{{ route('notice.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                            <i class="fas fa-undo me-1"></i> সকল নোটিশ দেখুন
                        </a>
                    </div>
                @endforelse

                <!-- Unified Pagination Component -->
                {{ $notices->links() }}
            </div>
        </div>
    </div>

    <!-- Sidebar Quick Navigation -->
    <div class="col-lg-4">
        <!-- Categories Widget -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden bg-white">
            <div class="card-header bg-white border-bottom p-3">
                <h5 class="fw-bold mb-0 fs-6" style="color: #0C4B36;">
                    <i class="fas fa-folder text-warning me-2"></i>বিজ্ঞপ্তির ধরণসমূহ
                </h5>
            </div>
            <div class="card-body p-3">
                <div class="list-group list-group-flush">
                    <a href="{{ route('notice.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3 rounded-2 mb-1 border-0 {{ !request('category') ? 'bg-success-subtle text-success fw-bold' : '' }}">
                        <span><i class="fas fa-border-all text-success me-2"></i>সকল নোটিশ</span>
                    </a>
                    <a href="{{ route('notice.index', ['category' => 'general']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3 rounded-2 mb-1 border-0 {{ request('category') === 'general' ? 'bg-success-subtle text-success fw-bold' : '' }}">
                        <span><i class="fas fa-chevron-right text-success me-2" style="font-size: 0.8rem;"></i>সাধারণ নোটিশ</span>
                    </a>
                    <a href="{{ route('notice.index', ['category' => 'events']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3 rounded-2 mb-1 border-0 {{ request('category') === 'events' ? 'bg-success-subtle text-success fw-bold' : '' }}">
                        <span><i class="fas fa-chevron-right text-success me-2" style="font-size: 0.8rem;"></i>আয়োজন ও সম্মেলন</span>
                    </a>
                    <a href="{{ route('notice.index', ['category' => 'meetings']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3 rounded-2 border-0 {{ request('category') === 'meetings' ? 'bg-success-subtle text-success fw-bold' : '' }}">
                        <span><i class="fas fa-chevron-right text-success me-2" style="font-size: 0.8rem;"></i>সাংগঠনিক সভা</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact Support Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-4 text-center">
            <div class="mb-3">
                <div class="stat-icon-wrap mx-auto" style="width: 50px; height: 50px; border-radius: 50%; background: #e8f5ee; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-headset fa-lg text-success"></i>
                </div>
            </div>
            <h5 class="fw-bold mb-2 text-dark">নোটিশ সংক্রান্ত জিজ্ঞাসা?</h5>
            <p class="text-secondary small mb-3">সাংগঠনিক তথ্যাদি বা বিজ্ঞপ্তি বিষয়ে তথ্যের জন্য কেন্দ্রীয় কার্যালয়ে যোগাযোগ করুন।</p>
            <a href="{{ route('contact.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-4 py-2 fw-semibold">
                যোগাযোগ পৃষ্ঠা <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

<!-- Notice Modals -->
@foreach($notices as $notice)
<div class="modal fade" id="noticeModal{{ $notice->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #073123 0%, #0C4B36 100%);">
                <h5 class="modal-title fw-bold fs-6">
                    <i class="fas fa-bell text-warning me-2"></i> {{ $notice->title }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex align-items-center gap-3 text-muted small mb-3 pb-2 border-bottom flex-wrap">
                    <span><i class="far fa-calendar-alt text-success me-1"></i> প্রকাশের তারিখ: {{ $notice->created_at ? $notice->created_at->format('d F, Y') : '২০২৫' }}</span>
                    @if($notice->category)
                        <span><i class="fas fa-tag text-warning me-1"></i> {{ ucfirst($notice->category) }}</span>
                    @endif
                </div>

                @if($notice->image && Storage::disk('public')->exists($notice->image))
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $notice->image) }}" alt="{{ $notice->title }}" class="img-fluid rounded-3 shadow-sm" style="max-height: 380px;">
                    </div>
                @endif
                
                <div class="notice-content text-secondary lh-base mb-4" style="font-size: 0.95rem;">
                    {!! strip_tags($notice->description) == $notice->description ? nl2br(e($notice->description)) : $notice->description !!}
                </div>

                @if($notice->file && Storage::disk('public')->exists($notice->file))
                    <div class="mt-4 p-3 bg-light rounded-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <span class="fw-semibold text-dark small"><i class="fas fa-paperclip text-success me-1"></i>সংযুক্ত ফাইল / নোটিশ কপি:</span>
                        <a href="{{ asset('storage/' . $notice->file) }}" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm" style="background: #0C4B36; border-color: #0C4B36;" download>
                            <i class="fas fa-download me-1"></i>
                            {{ $notice->isPDF() ? 'PDF কপি ডাউনলোড' : 'ফাইল ডাউনলোড' }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('page-styles')
<style>
    .notice-item-card {
        border-color: rgba(12, 75, 54, 0.08) !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }
    .notice-item-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 22px rgba(12, 75, 54, 0.08) !important;
        border-color: #0C4B36 !important;
    }
    .notice-title a {
        color: #1a202c;
        transition: color 0.2s ease;
    }
    .hover-green:hover {
        color: #0C4B36 !important;
    }
    .font-xs {
        font-size: 0.8rem;
    }
    .font-sm {
        font-size: 0.88rem;
    }
</style>
@endsection
