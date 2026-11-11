@extends('layouts.page')

@section('title', 'সকল সংবাদ ও প্রেস বিজ্ঞপ্তি')
@section('category', 'মিডিয়া')
@section('subtitle', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর সর্বশেষ সাংগঠনিক সংবাদ, প্রেস বিজ্ঞপ্তি ও বিবৃতি')

@section('meta_description', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর অফিসিয়াল সংবাদ ও প্রেস বিজ্ঞপ্তি।')
@section('meta_keywords', 'শুব্বান সংবাদ, প্রেস বিজ্ঞপ্তি, আহলে হাদীস নিউজ, ইসলামিক সংবাদ')

@section('page-content')
@if($news->isEmpty())
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-3">
        <i class="fas fa-newspaper fa-3x text-muted mb-3 opacity-50"></i>
        <h4 class="fw-bold text-dark mb-2">কোনো সংবাদ পাওয়া যায়নি</h4>
        <p class="text-muted mb-0">নতুন কোনো সংবাদ প্রকাশিত হলে এখানে প্রদর্শিত হবে।</p>
    </div>
@else
    <div class="row g-4">
        @foreach($news as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden news-card-custom bg-white d-flex flex-column">
                    <div class="news-image-wrapper position-relative" style="height: 220px; overflow: hidden; background: #e2e8f0;">
                        @if($item->image && file_exists(public_path('storage/' . $item->image)))
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->title }}" loading="lazy">
                        @elseif($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->title }}" onerror="this.src='{{ asset('images/news-placeholder.jpg') }}'" loading="lazy">
                        @else
                            <img src="{{ asset('images/news-placeholder.jpg') }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->title }}" loading="lazy">
                        @endif
                        <div class="news-date-badge position-absolute bottom-0 start-0 m-3 px-3 py-1 rounded-pill bg-white text-dark shadow-sm small fw-bold">
                            <i class="fas fa-calendar-alt text-success me-1"></i>
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d F, Y') }}
                        </div>
                    </div>

                    <div class="card-body p-4 d-flex flex-column flex-grow-1">
                        <h4 class="card-title fw-bold mb-3 fs-5" style="color: #0C4B36; line-height: 1.4;">
                            <a href="{{ route('news.show', $item->id) }}" class="text-decoration-none" style="color: inherit;">
                                {{ $item->title }}
                            </a>
                        </h4>
                        <p class="card-text text-muted mb-4 flex-grow-1" style="font-size: 0.95rem; line-height: 1.6;">
                            {{ Str::limit(strip_tags($item->description), 130) }}
                        </p>
                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('news.show', $item->id) }}" class="btn btn-sm px-3 py-2 fw-semibold rounded-pill" style="background: #0C4B36; color: #fff;">
                                বিস্তারিত পড়ুন <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                            @if(method_exists($item, 'likes'))
                            <span class="text-muted small">
                                <i class="far fa-thumbs-up text-primary me-1"></i>{{ $item->likes()->count() }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Unified Pagination Component -->
    {{ $news->links() }}
@endif
@endsection

@section('page-styles')
<style>
    .news-card-custom {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(12, 75, 54, 0.08) !important;
    }
    .news-card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px rgba(12, 75, 54, 0.12) !important;
        border-color: #0C4B36 !important;
    }
    .news-card-custom:hover img {
        transform: scale(1.05);
        transition: transform 0.4s ease;
    }
</style>
@endsection
