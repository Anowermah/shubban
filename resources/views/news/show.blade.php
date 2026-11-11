@extends('layouts.app')

@section('title', $news->title . ' - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<!-- Page Header Banner -->
<div class="page-header-banner py-4 mb-4" style="background: linear-gradient(135deg, #0C4B36 0%, #176B4E 100%); color: #fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2" style="font-size: 0.9rem;">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="fas fa-home me-1"></i>হোম</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('news.index') }}" class="text-white-50 text-decoration-none">সংবাদ</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">সংবাদ বিস্তারিত</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-0 text-white fw-bold fs-3">{{ $news->title }}</h1>
            </div>
            <div class="col-md-2 text-md-end d-none d-md-block opacity-25">
                <i class="fas fa-newspaper fa-3x text-white"></i>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 news-detail-card">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex flex-wrap align-items-center justify-content-between text-muted mb-4 pb-3 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <span>
                                <i class="fas fa-calendar-alt text-success me-1"></i>
                                {{ $news->created_at->format('d F, Y') }}
                            </span>
                            <span>
                                <i class="fas fa-clock text-muted me-1"></i>
                                {{ $news->created_at->format('h:i A') }}
                            </span>
                        </div>
                        <div>
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill border">
                                <i class="fas fa-thumbs-up text-primary me-1"></i> 
                                <span id="likes-count">{{ $news->likes()->count() }}</span> টি লাইক
                            </span>
                        </div>
                    </div>
                    
                    @if($news->image && file_exists(public_path('storage/' . $news->image)))
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $news->image) }}" 
                                 alt="{{ $news->title }}" 
                                 class="img-fluid rounded-4 shadow-sm w-100" 
                                 style="max-height: 480px; object-fit: cover;">
                        </div>
                    @endif
                    
                    <div class="news-content fs-5 lh-lg mb-5">
                        {!! strip_tags($news->description) == $news->description ? nl2br(e($news->description)) : $news->description !!}
                    </div>
                    
                    <!-- Share & Like Actions -->
                    <div class="p-3 bg-light rounded-4 d-flex flex-wrap align-items-center justify-content-between gap-3 mb-5 border">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold me-1 text-muted"><i class="fas fa-share-alt me-1"></i>শেয়ার:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank" class="btn btn-sm btn-primary rounded-pill px-3">
                                <i class="fab fa-facebook-f me-1"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" 
                               target="_blank" class="btn btn-sm text-white rounded-pill px-3" style="background: #1DA1F2;">
                                <i class="fab fa-twitter me-1"></i> Twitter
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($news->title . ' ' . request()->url()) }}" 
                               target="_blank" class="btn btn-sm btn-success rounded-pill px-3">
                                <i class="fab fa-whatsapp me-1"></i> WhatsApp
                            </a>
                        </div>
                        <div>
                            <button class="btn btn-outline-success rounded-pill px-4" id="like-button" 
                                    data-news-id="{{ $news->id }}"
                                    data-liked="{{ $news->likes()->where('ip_address', request()->ip())->exists() ? 'true' : 'false' }}">
                                <i class="fas fa-thumbs-up me-1"></i> 
                                <span id="like-text">
                                    {{ $news->likes()->where('ip_address', request()->ip())->exists() ? 'লাইক করা হয়েছে' : 'লাইক দিন' }}
                                </span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Comments Section -->
                    <div class="comments-section">
                        <h4 class="fw-bold mb-4" style="color: #0C4B36;">
                            <i class="fas fa-comments me-2 text-warning"></i>মন্তব্যসমূহ ({{ $news->getApprovedComments()->count() }})
                        </h4>
                        
                        <!-- Comment Form -->
                        <div class="card border rounded-4 mb-4 bg-light">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-3" style="color: #0C4B36;">আপনার মতামত দিন</h5>
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif
                                <form action="{{ route('news.comment', $news) }}" method="POST">
                                    @csrf
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label fw-semibold">আপনার নাম *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label fw-semibold">ইমেইল *</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="comment" class="form-label fw-semibold">মন্তব্য *</label>
                                        <textarea class="form-control @error('comment') is-invalid @enderror" 
                                                  id="comment" name="comment" rows="3" placeholder="শালীন ও গঠনমূলক মন্তব্য লিখুন..." required>{{ old('comment') }}</textarea>
                                        @error('comment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success px-4" style="background: #0C4B36; border: none;">
                                        <i class="fas fa-paper-plane me-1"></i> মন্তব্য প্রকাশ করুন
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Comments List -->
                        <div class="comments-list">
                            @forelse($news->getApprovedComments() as $comment)
                                <div class="card border-0 shadow-sm rounded-4 mb-3 p-3 bg-white">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="avatar-circle rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 36px; height: 36px; background: #0C4B36 !important;">
                                            {{ mb_substr($comment->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $comment->name }}</h6>
                                            <small class="text-muted">{{ $comment->created_at->format('d F, Y - h:i A') }}</small>
                                        </div>
                                    </div>
                                    <p class="card-text text-secondary ps-4 ms-2 mb-0">{{ $comment->comment }}</p>
                                </div>
                            @empty
                                <div class="text-center py-4 bg-light rounded-4 text-muted">
                                    <i class="far fa-comment-dots fa-2x mb-2 d-block"></i>
                                    এখনো কোনো মন্তব্য করা হয়নি। প্রথম মন্তব্যকারী হোন!
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#like-button').click(function() {
        const button = $(this);
        const newsId = button.data('news-id');
        
        $.ajax({
            url: `/news/${newsId}/like`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#likes-count').text(response.likes_count);
                if (response.action === 'liked') {
                    button.data('liked', 'true');
                    $('#like-text').text('লাইক করা হয়েছে');
                    button.addClass('btn-success text-white').removeClass('btn-outline-success');
                } else {
                    button.data('liked', 'false');
                    $('#like-text').text('লাইক দিন');
                    button.removeClass('btn-success text-white').addClass('btn-outline-success');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});
</script>
@endpush
