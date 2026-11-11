@extends('layouts.app')

@section('title', $article->title . ' - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<!-- Page Header Banner -->
<div class="page-header-banner py-4 mb-4" style="background: linear-gradient(135deg, #0C4B36 0%, #176B4E 100%); color: #fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2" style="font-size: 0.9rem;">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="fas fa-home me-1"></i>হোম</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('publications.articles') }}" class="text-white-50 text-decoration-none">নিবন্ধ</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">প্রবন্ধ পাঠ</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-0 text-white fw-bold fs-3">{{ $article->title }}</h1>
            </div>
            <div class="col-md-2 text-md-end d-none d-md-block opacity-25">
                <i class="fas fa-feather-alt fa-3x text-white"></i>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <article class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5 bg-white">
                <div class="d-flex flex-wrap align-items-center justify-content-between text-muted mb-4 pb-3 border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <span>
                            <i class="fas fa-calendar-alt text-success me-1"></i>
                            {{ $article->publication_date->format('d F, Y') }}
                        </span>
                        @if($article->author)
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill border">
                                <i class="fas fa-user-edit text-success me-1"></i>
                                {{ $article->author }}
                            </span>
                        @endif
                    </div>
                    @if($article->pdf_file && Storage::disk('public')->exists($article->pdf_file))
                        <div>
                            <a href="{{ Storage::url($article->pdf_file) }}" 
                               class="btn btn-sm btn-outline-success rounded-pill px-3 py-1" 
                               download>
                                <i class="fas fa-file-pdf text-danger me-1"></i> পিডিএফ ডাউনলোড
                            </a>
                        </div>
                    @endif
                </div>

                @if($article->cover_image && Storage::disk('public')->exists($article->cover_image))
                    <div class="text-center mb-4">
                        <img src="{{ Storage::url($article->cover_image) }}" 
                             class="img-fluid rounded-4 shadow-sm w-100 article-cover" 
                             alt="{{ $article->title }}"
                             style="max-height: 420px; object-fit: cover;">
                    </div>
                @endif

                <div class="article-content fs-5 lh-lg mb-5" style="line-height: 1.9;">
                    {!! strip_tags($article->description) == $article->description ? nl2br(e($article->description)) : $article->description !!}
                </div>

                <!-- Social Share -->
                <div class="p-3 bg-light rounded-4 d-flex flex-wrap align-items-center justify-content-between gap-3 border">
                    <span class="fw-bold text-muted"><i class="fas fa-share-alt me-1"></i>শেয়ার করুন:</span>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                           target="_blank" class="btn btn-sm btn-primary rounded-pill px-3">
                            <i class="fab fa-facebook-f me-1"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" 
                           target="_blank" class="btn btn-sm text-white rounded-pill px-3" style="background: #1DA1F2;">
                            <i class="fab fa-twitter me-1"></i> Twitter
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' ' . request()->url()) }}" 
                           target="_blank" class="btn btn-sm btn-success rounded-pill px-3">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </article>

            @if($relatedArticles->isNotEmpty())
                <div class="related-articles">
                    <h4 class="fw-bold mb-4" style="color: #0C4B36;">
                        <i class="fas fa-book-reader text-warning me-2"></i>আরও পড়ুন
                    </h4>
                    <div class="row g-4">
                        @foreach($relatedArticles as $relatedArticle)
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 transition-card bg-white">
                                    <h5 class="card-title fw-bold mb-2" style="color: #0C4B36;">
                                        <a href="{{ route('publications.articles.read', $relatedArticle->id) }}" class="text-decoration-none" style="color: inherit;">
                                            {{ $relatedArticle->title }}
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-3">
                                        <i class="fas fa-calendar-alt text-success me-1"></i>
                                        {{ $relatedArticle->publication_date->format('d F, Y') }}
                                    </p>
                                    <a href="{{ route('publications.articles.read', $relatedArticle->id) }}" 
                                       class="btn btn-sm px-3 py-2 fw-semibold rounded-pill mt-auto" 
                                       style="background: #0C4B36; color: #fff; width: fit-content;">
                                        বিস্তারিত পড়ুন <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .transition-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid #f1f5f9 !important;
    }
    .transition-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(12, 75, 54, 0.1) !important;
        border-color: #0C4B36 !important;
    }
</style>
@endpush
@endsection
