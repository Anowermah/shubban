@extends('layouts.app')

@section('title', $book->title . ' (অনলাইনে পাঠ) - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')
@section('meta_description', Str::limit($book->description ?? ($book->title . ' - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ প্রকাশিত বই।'), 160))

@section('content')
<div class="book-reader-wrapper py-4 bg-light min-vh-100">
    <div class="container-fluid px-lg-5">
        <!-- Breadcrumb & Top Bar -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 p-3 bg-white">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 small">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">হোম</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('publications.books') }}" class="text-decoration-none text-muted">বই সম্ভার</a></li>
                            <li class="breadcrumb-item active text-success fw-semibold" aria-current="page">{{ Str::limit($book->title, 30) }}</li>
                        </ol>
                    </nav>
                    <h1 class="h4 fw-bold text-dark mb-1 d-flex align-items-center flex-wrap gap-2">
                        <i class="fas fa-book-reader text-success"></i>
                        <span>{{ $book->title }}</span>
                        @if($book->author)
                            <span class="badge bg-success bg-opacity-10 text-success fw-normal fs-6 px-3 py-1 rounded-pill">
                                <i class="fas fa-pen-nib me-1"></i>{{ $book->author }}
                            </span>
                        @endif
                    </h1>
                </div>

                <!-- Action Controls -->
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    @php
                        $pdfPath = $book->pdf_file ? asset('storage/' . $book->pdf_file) : null;
                    @endphp

                    @if($pdfPath)
                        <a href="{{ $pdfPath }}" class="btn btn-success rounded-pill px-3 py-2 fw-semibold" download target="_blank">
                            <i class="fas fa-download me-1"></i>ডাউনলোড
                        </a>
                        <button type="button" class="btn btn-outline-success rounded-pill px-3 py-2 fw-semibold d-none d-md-inline-flex align-items-center" id="toggleFullscreenBtn">
                            <i class="fas fa-expand me-1"></i>পূর্ণ পর্দা
                        </button>
                    @endif

                    <a href="{{ route('publications.books') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2">
                        <i class="fas fa-arrow-left me-1"></i>সকল বই
                    </a>
                </div>
            </div>
        </div>

        <!-- Main PDF Reader Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" id="readerContainerCard">
            @if($book->pdf_file && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->pdf_file))
                <!-- Toolbar Notice for Mobile -->
                <div class="bg-success bg-opacity-10 py-2 px-3 border-bottom d-flex align-items-center justify-content-between d-md-none small">
                    <span class="text-dark"><i class="fas fa-mobile-alt me-1 text-success"></i>মোবাইলে পিডিএফ দেখতে অসুবিধা হলে:</span>
                    <a href="{{ asset('storage/' . $book->pdf_file) }}" target="_blank" class="btn btn-sm btn-success rounded-pill px-2 py-0">
                        সরাসরি খুলুন
                    </a>
                </div>

                <div class="pdf-viewer-frame position-relative bg-dark" style="min-height: 82vh;">
                    <object data="{{ asset('storage/' . $book->pdf_file) }}" type="application/pdf" width="100%" height="100%" class="w-100" style="min-height: 82vh;">
                        <iframe src="{{ asset('storage/' . $book->pdf_file) }}#toolbar=1" width="100%" height="800px" style="border: none;">
                            <div class="p-5 text-center bg-white">
                                <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                <h4 class="fw-bold">আপনার ব্রাউজারে ইনলাইন পিডিএফ লোড হচ্ছে না</h4>
                                <p class="text-muted">পিডিএফ ফাইলটি সরাসরি দেখতে বা ডাউনলোড করতে নিচের বাটনে চাপ দিন:</p>
                                <a href="{{ asset('storage/' . $book->pdf_file) }}" class="btn btn-success rounded-pill px-4 py-2" target="_blank" download>
                                    <i class="fas fa-download me-1"></i>পিডিএফ ডাউনলোড করুন
                                </a>
                            </div>
                        </iframe>
                    </object>
                </div>
            @else
                <div class="p-5 text-center bg-white my-4">
                    <div class="mb-3">
                        <i class="fas fa-file-excel fa-3x text-warning opacity-75"></i>
                    </div>
                    <h3 class="fw-bold text-dark mb-2">এই বইয়ের অনলাইন পিডিএফ ফাইলটি প্রক্রিয়াধীন রয়েছে</h3>
                    <p class="text-muted mb-4" style="max-width: 500px; margin: 0 auto;">
                        বইটির পিডিএফ ফাইল বর্তমানে আমাদের সার্ভারে আপলোড করা হচ্ছে। অনুগ্রহ করে কিছুক্ষণ পর আবার চেষ্টা করুন।
                    </p>
                    <a href="{{ route('publications.books') }}" class="btn btn-success rounded-pill px-4 py-2">
                        <i class="fas fa-book me-1"></i>অন্যান্য বইসমূহ দেখুন
                    </a>
                </div>
            @endif
        </div>

        <!-- Book Meta & Overview Details -->
        <div class="row g-4 mb-5">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                    <h3 class="h5 fw-bold text-dark mb-3 border-bottom pb-2">
                        <i class="fas fa-info-circle text-success me-2"></i>বই পরিচিতি ও বিবরণ
                    </h3>
                    
                    @if($book->description)
                        <div class="book-description text-secondary mb-4 leading-relaxed fs-6">
                            {!! nl2br(e($book->description)) !!}
                        </div>
                    @else
                        <p class="text-muted fst-italic mb-4">এই বইটির জন্য কোনো সংক্ষিপ্ত বিবরণ যুক্ত করা হয়নি।</p>
                    @endif

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-3 rounded-3 bg-light border">
                                <small class="text-muted d-block mb-1">লেখক / গবেষক</small>
                                <strong class="text-dark">{{ $book->author ?? 'জমঈয়ত শুব্বান প্রকাশনা' }}</strong>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 rounded-3 bg-light border">
                                <small class="text-muted d-block mb-1">প্রকাশনার তারিখ</small>
                                <strong class="text-dark">
                                    {{ $book->publication_date ? \Carbon\Carbon::parse($book->publication_date)->format('d F, Y') : 'প্রকাশিত' }}
                                </strong>
                            </div>
                        </div>
                        @if($book->isbn && $book->isbn !== 'নেই')
                            <div class="col-sm-6">
                                <div class="p-3 rounded-3 bg-light border">
                                    <small class="text-muted d-block mb-1">আইএসবিএন (ISBN)</small>
                                    <strong class="text-dark font-monospace">{{ $book->isbn }}</strong>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-6">
                            <div class="p-3 rounded-3 bg-light border">
                                <small class="text-muted d-block mb-1">মূল্য / প্রাপ্তি</small>
                                @if(!$book->price || $book->price == 0)
                                    <span class="badge bg-success-subtle text-success fs-6 fw-bold">বিনামূল্যে (ফ্রি পিডিএফ)</span>
                                @else
                                    <strong class="text-dark fs-6">৳{{ number_format($book->price, 0) }}</strong>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cover Card -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="h6 fw-bold text-dark mb-3 text-start">
                            <i class="fas fa-image text-success me-2"></i>বইয়ের প্রচ্ছদ
                        </h4>
                        <div class="book-cover-preview mx-auto shadow rounded-3 overflow-hidden mb-3" style="max-width: 240px;">
                            <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-book.png') }}" 
                                 alt="{{ $book->title }}" 
                                 class="img-fluid w-100"
                                 onerror="this.src='{{ asset('images/default-book.png') }}'"
                                 style="aspect-ratio: 1/1.4; object-fit: cover;">
                        </div>
                    </div>

                    <div class="pt-3 border-top">
                        @if($book->pdf_file)
                            <a href="{{ asset('storage/' . $book->pdf_file) }}" download class="btn btn-success w-100 rounded-pill py-2 fw-semibold mb-2">
                                <i class="fas fa-file-pdf me-1"></i>পিডিএফ ডাউনলোড করুন
                            </a>
                        @endif
                        <a href="{{ route('publications.books') }}" class="btn btn-outline-secondary w-100 rounded-pill py-2">
                            <i class="fas fa-th-large me-1"></i>অন্যান্য সকল বই
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Books Recommendations -->
        @if(isset($relatedBooks) && count($relatedBooks) > 0)
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 fw-bold text-dark mb-0">
                        <i class="fas fa-layer-group text-success me-2"></i>আরও প্রকাশিত বইসমূহ
                    </h3>
                    <a href="{{ route('publications.books') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                        সবগুলো দেখুন &rarr;
                    </a>
                </div>

                <div class="row g-3">
                    @foreach($relatedBooks as $rel)
                        <div class="col-6 col-md-3">
                            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden text-center p-3 bg-white">
                                <a href="{{ route('publications.books.read', $rel->id) }}" class="text-decoration-none">
                                    <div class="rounded-3 overflow-hidden shadow-sm mb-3 mx-auto" style="max-width: 140px; aspect-ratio: 1/1.4;">
                                        <img src="{{ $rel->cover_image ? asset('storage/' . $rel->cover_image) : asset('images/default-book.png') }}" 
                                             class="w-100 h-100 object-fit-cover" 
                                             alt="{{ $rel->title }}"
                                             onerror="this.src='{{ asset('images/default-book.png') }}'">
                                    </div>
                                    <h4 class="fs-6 fw-bold text-dark text-truncate mb-1">{{ $rel->title }}</h4>
                                    <small class="text-muted d-block text-truncate mb-2">{{ $rel->author ?? 'শুব্বান প্রকাশনা' }}</small>
                                </a>
                                <div class="mt-auto pt-2">
                                    <a href="{{ route('publications.books.read', $rel->id) }}" class="btn btn-sm btn-outline-success rounded-pill w-100 py-1">
                                        <i class="fas fa-book-reader me-1"></i>পড়ুন
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .book-reader-wrapper {
        background-color: #f8fafc;
    }
    .pdf-viewer-frame {
        border-radius: 0 0 16px 16px;
        overflow: hidden;
    }
    .pdf-viewer-fullscreen {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        z-index: 999999 !important;
        border-radius: 0 !important;
        background: #000 !important;
    }
    .pdf-viewer-fullscreen .pdf-viewer-frame,
    .pdf-viewer-fullscreen object,
    .pdf-viewer-fullscreen iframe {
        height: 100vh !important;
        min-height: 100vh !important;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fullscreenBtn = document.getElementById('toggleFullscreenBtn');
    const container = document.getElementById('readerContainerCard');

    if (fullscreenBtn && container) {
        fullscreenBtn.addEventListener('click', function() {
            if (!document.fullscreenElement) {
                if (container.requestFullscreen) {
                    container.requestFullscreen();
                } else if (container.webkitRequestFullscreen) {
                    container.webkitRequestFullscreen();
                } else if (container.msRequestFullscreen) {
                    container.msRequestFullscreen();
                }
                fullscreenBtn.innerHTML = '<i class="fas fa-compress me-1"></i>প্রস্থান';
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                }
                fullscreenBtn.innerHTML = '<i class="fas fa-expand me-1"></i>পূর্ণ পর্দা';
            }
        });

        document.addEventListener('fullscreenchange', function() {
            if (!document.fullscreenElement) {
                fullscreenBtn.innerHTML = '<i class="fas fa-expand me-1"></i>পূর্ণ পর্দা';
            }
        });
    }
});
</script>
@endpush
