@extends('layouts.page')

@section('title', 'প্রকাশিত বই ও কিতাব সম্ভার')
@section('category', 'প্রকাশনা')
@section('subtitle', 'কুরআন ও সুন্নাহর গবেষণামূলক গ্রন্থ, তাওহীদ-রিসালাত এবং সংগঠনের প্রশিক্ষণ সিলেবাসের প্রামাণ্য কিতাবসমূহ')

@section('meta_description', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ প্রকাশিত বই, পুস্তিকা ও প্রশিক্ষণ স্মরণিকা সম্ভার। অনলাইনে পড়ুন অথবা পিডিএফ সংগ্রহ করুন।')
@section('meta_keywords', 'শুব্বান বই, ইসলামিক বই, আহলে হাদীস বই, শুব্বান প্রকাশনা, স্মরণিকা, তাওহীদ, সালাত শিক্ষা')

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
    <form action="{{ route('publications.books') }}" method="GET" class="row g-3 align-items-end">
        <!-- Search Keyword -->
        <div class="col-12 col-md-4">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-search text-success me-1"></i> বইয়ের নাম বা লেখক খুঁজুন
            </label>
            <div class="input-group">
                <input type="text" name="search" class="form-control rounded-start-pill ps-3" 
                       placeholder="উদাঃ স্মরণিকা, কর্মপদ্ধতি, গঠনতন্ত্র..." 
                       value="{{ request('search') }}">
                @if(request('search'))
                    <a href="{{ route('publications.books', request()->except('search')) }}" class="btn btn-outline-secondary border-start-0" title="মুছে ফেলুন">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </div>

        <!-- Price Filter -->
        <div class="col-6 col-md-3">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-tag text-warning me-1"></i> মূল্য ফিল্টার
            </label>
            <select name="price" class="form-select rounded-pill">
                <option value="">সকল বই (মূল্য নির্বিশেষে)</option>
                <option value="free" {{ request('price') === 'free' ? 'selected' : '' }}>বিনামূল্যে / ফ্রি কিতাব</option>
                <option value="paid" {{ request('price') === 'paid' ? 'selected' : '' }}>মুদ্রিত / পেইড কিতাব</option>
            </select>
        </div>

        <!-- Sort Filter -->
        <div class="col-6 col-md-3">
            <label class="form-label small fw-bold text-secondary mb-1">
                <i class="fas fa-sort-amount-down text-info me-1"></i> সাজানো
            </label>
            <select name="sort" class="form-select rounded-pill">
                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>সর্বশেষ প্রকাশিত</option>
                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>প্রাচীনতম আগে</option>
                <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>শিরোনাম (ক - হ)</option>
                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>মূল্য: কম থেকে বেশি</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>মূল্য: বেশি থেকে কম</option>
            </select>
        </div>

        <!-- Submit & Reset Buttons -->
        <div class="col-12 col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-success rounded-pill w-100 fw-bold shadow-sm" style="background: #0C4B36; border-color: #0C4B36;">
                <i class="fas fa-filter me-1"></i> ফিল্টার
            </button>
            @if(request()->anyFilled(['search', 'price', 'sort']))
                <a href="{{ route('publications.books') }}" class="btn btn-outline-secondary rounded-pill" title="ফিল্টার রিসেট">
                    <i class="fas fa-undo"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Active Filter Pills Strip -->
@if(request()->anyFilled(['search', 'price', 'sort']))
    <div class="d-flex align-items-center gap-2 mb-4 flex-wrap">
        <span class="small text-muted fw-bold">সক্রিয় ফিল্টার:</span>
        @if(request('search'))
            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                কীওয়ার্ড: "{{ request('search') }}"
                <a href="{{ route('publications.books', request()->except('search')) }}" class="ms-1 text-danger text-decoration-none">&times;</a>
            </span>
        @endif
        @if(request('price'))
            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                মূল্য: {{ request('price') === 'free' ? 'বিনামূল্যে' : 'পেইড' }}
                <a href="{{ route('publications.books', request()->except('price')) }}" class="ms-1 text-danger text-decoration-none">&times;</a>
            </span>
        @endif
        <a href="{{ route('publications.books') }}" class="small text-danger text-decoration-none ms-2">
            <i class="fas fa-times-circle me-1"></i>সব রিসেট করুন
        </a>
    </div>
@endif

<!-- Books Grid -->
<div class="row g-3 g-md-4">
    @forelse($books as $book)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden book-library-card d-flex flex-column">
                <!-- Book Cover Container: 100% Full View Without Any Cropping -->
                <div class="book-cover-container position-relative">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#bookModal{{ $book->id }}" class="d-block w-100 h-100 text-decoration-none">
                        @if($book->cover_image && Storage::disk('public')->exists($book->cover_image))
                            <img src="{{ Storage::url($book->cover_image) }}" 
                                 alt="{{ $book->title }}" 
                                 class="book-cover-full" 
                                 loading="lazy">
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center text-muted h-100 p-3 text-center">
                                <i class="fas fa-book-open fa-3x text-success mb-2 opacity-50"></i>
                                <span class="small fw-bold">{{ $book->title }}</span>
                            </div>
                        @endif
                    </a>

                    <!-- Price Badge -->
                    <span class="position-absolute top-0 end-0 m-2 badge {{ $book->price ? 'bg-success' : 'bg-warning text-dark' }} rounded-pill px-2 py-1 shadow-sm font-sm fw-bold">
                        @if($book->price)
                            ৳ {{ $toBn(number_format($book->price, 0)) }}
                        @else
                            ফ্রি
                        @endif
                    </span>
                </div>

                <!-- Book Body Info -->
                <div class="card-body p-3 d-flex flex-column flex-grow-1">
                    <h3 class="book-title mb-1 fs-6 fw-bold" title="{{ $book->title }}">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#bookModal{{ $book->id }}" class="text-decoration-none text-dark hover-green">
                            {{ $book->title }}
                        </a>
                    </h3>
                    
                    <p class="book-author text-muted small mb-2 text-truncate" title="{{ $book->author ?? 'শুব্বান প্রকাশনী' }}">
                        <i class="fas fa-pen-nib text-warning me-1"></i> {{ $book->author ?? 'শুব্বান প্রকাশনী' }}
                    </p>

                    @if($book->description)
                        <p class="book-excerpt text-secondary small mb-3 flex-grow-1" style="line-height: 1.45;">
                            {{ Str::limit(strip_tags($book->description), 65) }}
                        </p>
                    @else
                        <div class="flex-grow-1"></div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="d-flex gap-1 mt-auto pt-2 border-top">
                        @if($book->pdf_file && Storage::disk('public')->exists($book->pdf_file))
                            <button type="button" class="btn btn-sm btn-success rounded-pill px-2 py-1 flex-grow-1 fw-semibold d-flex align-items-center justify-content-center gap-1 font-xs" 
                                    style="background: #0C4B36; border-color: #0C4B36;"
                                    onclick="openPdfViewer('{{ Storage::url($book->pdf_file) }}', '{{ addslashes($book->title) }}')">
                                <i class="fas fa-book-reader"></i> <span>পড়ুন</span>
                            </button>
                            <a href="{{ Storage::url($book->pdf_file) }}" class="btn btn-sm btn-outline-success rounded-circle p-1 d-flex align-items-center justify-content-center" 
                               style="width: 30px; height: 30px;" download title="PDF ডাউনলোড">
                                <i class="fas fa-download"></i>
                            </a>
                        @endif
                        <button type="button" class="btn btn-sm btn-light border rounded-circle p-1 d-flex align-items-center justify-content-center ms-auto" 
                                style="width: 30px; height: 30px;"
                                data-bs-toggle="modal" data-bs-target="#bookModal{{ $book->id }}" title="বিস্তারিত তথ্য">
                            <i class="fas fa-info text-secondary"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-3">
                <i class="fas fa-book-open fa-3x text-muted mb-3 opacity-50"></i>
                <h4 class="fw-bold text-dark mb-2">কোনো বই পাওয়া যায়নি</h4>
                <p class="text-muted mb-3">আপনার অনুসন্ধান বা ফিল্টারের সাথে মিলে এমন কোনো বই খুঁজে পাওয়া যায়নি।</p>
                <div>
                    <a href="{{ route('publications.books') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                        <i class="fas fa-undo me-1"></i> সকল বই দেখুন
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div>

<!-- Unified Pagination Component -->
{{ $books->links() }}

<!-- Book Detail Modals -->
@foreach($books as $book)
<div class="modal fade" id="bookModal{{ $book->id }}" tabindex="-1" aria-labelledby="bookModalLabel{{ $book->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #073123 0%, #0C4B36 100%);">
                <h5 class="modal-title fw-bold fs-6" id="bookModalLabel{{ $book->id }}">
                    <i class="fas fa-book-open text-warning me-2"></i> {{ $book->title }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center">
                        <div class="p-3 bg-light rounded-4 border d-inline-block shadow-sm">
                            @if($book->cover_image && Storage::disk('public')->exists($book->cover_image))
                                <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" 
                                     class="img-fluid rounded-3 shadow" style="max-height: 340px; width: auto; object-fit: contain;">
                            @else
                                <div class="py-5 px-4 text-muted">
                                    <i class="fas fa-book fa-4x text-success mb-2 opacity-50"></i>
                                    <div>কভার ছবি সংযুক্ত নেই</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h4 class="fw-bold text-success mb-1" style="color: #0C4B36;">{{ $book->title }}</h4>
                        <p class="text-muted mb-3">
                            <i class="fas fa-user-edit text-warning me-1"></i> লেখক / সংকলক: 
                            <span class="fw-semibold text-dark">{{ $book->author ?? 'শুব্বান প্রকাশনী' }}</span>
                        </p>

                        <div class="bg-light p-3 rounded-3 mb-3 border">
                            <div class="row g-2 small">
                                <div class="col-6">
                                    <span class="text-muted">মূল্য:</span> 
                                    <span class="fw-bold text-dark">{{ $book->price ? '৳ ' . $toBn(number_format($book->price, 0)) : 'বিনামূল্যে' }}</span>
                                </div>
                                @if($book->isbn)
                                    <div class="col-6">
                                        <span class="text-muted">ISBN:</span> 
                                        <span class="fw-bold text-dark">{{ $book->isbn }}</span>
                                    </div>
                                @endif
                                @if($book->publication_date)
                                    <div class="col-6">
                                        <span class="text-muted">প্রকাশকাল:</span> 
                                        <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($book->publication_date)->format('F, Y') }}</span>
                                    </div>
                                @endif
                                <div class="col-6">
                                    <span class="text-muted">স্ট্যাটাস:</span> 
                                    <span class="badge bg-success-subtle text-success">প্রকাশিত</span>
                                </div>
                            </div>
                        </div>

                        @if($book->description)
                            <div class="book-description text-secondary small lh-base mb-4" style="max-height: 220px; overflow-y: auto;">
                                {!! strip_tags($book->description) == $book->description ? nl2br(e($book->description)) : $book->description !!}
                            </div>
                        @endif

                        <div class="d-flex gap-2 flex-wrap">
                            @if($book->pdf_file && Storage::disk('public')->exists($book->pdf_file))
                                <button type="button" class="btn btn-success rounded-pill px-4 py-2 fw-semibold shadow-sm"
                                        style="background: #0C4B36; border-color: #0C4B36;"
                                        onclick="openPdfViewer('{{ Storage::url($book->pdf_file) }}', '{{ addslashes($book->title) }}')"
                                        data-bs-dismiss="modal">
                                    <i class="fas fa-book-reader me-1"></i> সরাসরি পড়ুন
                                </button>
                                <a href="{{ Storage::url($book->pdf_file) }}" class="btn btn-outline-success rounded-pill px-3 py-2 fw-semibold" download>
                                    <i class="fas fa-download me-1"></i> PDF ডাউনলোড
                                </a>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary py-2 px-3 rounded-pill">
                                    <i class="fas fa-info-circle me-1"></i> মুদ্রিত কপি সংগ্রহ করুন
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- PDF Viewer Modal -->
<div class="modal fade" id="pdfViewerModal" tabindex="-1" aria-labelledby="pdfViewerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content border-0">
            <div class="modal-header text-white py-2 px-3" style="background: linear-gradient(135deg, #073123 0%, #0C4B36 100%);">
                <h5 class="modal-title fs-6 fw-bold text-truncate" id="pdfViewerModalLabel">পিডিএফ ভিউয়ার</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="pdfViewer" style="width: 100%; height: calc(100vh - 54px); border: none;"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-styles')
<style>
    .book-library-card {
        background: #ffffff;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        border: 1px solid rgba(12, 75, 54, 0.08) !important;
    }
    .book-library-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(12, 75, 54, 0.12) !important;
        border-color: #0C4B36 !important;
    }
    /* Fixed Container with Aspect Ratio 3:4 for 100% Book Visibility */
    .book-cover-container {
        height: 270px;
        background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px;
        overflow: hidden;
    }
    .book-cover-full {
        max-height: 100%;
        max-width: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 4px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }
    .book-library-card:hover .book-cover-full {
        transform: scale(1.04) translateY(-2px);
        box-shadow: 0 10px 22px rgba(12, 75, 54, 0.22);
    }
    .book-title a {
        color: #1a202c;
        transition: color 0.2s ease;
    }
    .hover-green:hover {
        color: #0C4B36 !important;
    }
    .font-xs {
        font-size: 0.78rem;
    }
    .font-sm {
        font-size: 0.85rem;
    }
    @media (max-width: 575.98px) {
        .book-cover-container {
            height: 200px;
            padding: 8px;
        }
        .book-title {
            font-size: 0.9rem !important;
        }
    }
</style>
@endsection

@push('scripts')
<script>
function openPdfViewer(pdfUrl, title) {
    let fullPdfUrl = pdfUrl;
    if (!fullPdfUrl.startsWith('http')) {
        if (!fullPdfUrl.startsWith('/')) {
            fullPdfUrl = '/' + fullPdfUrl;
        }
        fullPdfUrl = window.location.origin + fullPdfUrl;
    }
    
    const viewerUrl = `/pdfjs/viewer.html?file=${encodeURIComponent(fullPdfUrl)}`;
    const pdfViewer = document.getElementById('pdfViewer');
    pdfViewer.src = viewerUrl;
    document.getElementById('pdfViewerModalLabel').innerHTML = '<i class="fas fa-book-open text-warning me-2"></i> ' + title;
    const modal = new bootstrap.Modal(document.getElementById('pdfViewerModal'));
    modal.show();
}
</script>
@endpush
