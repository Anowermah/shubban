@extends('layouts.app')

@section('title', 'আর্কাইভ গ্যালারি')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <h2 class="text-center mb-4">আর্কাইভ গ্যালারি</h2>
            <p class="text-center text-muted mb-5">পুরনো স্মৃতিচারণ</p>
            
            <div class="row g-4">
                @forelse($archives as $archive)
                    <div class="col-md-6 col-lg-4">
                        <div class="archive-card">
                            <div class="archive-thumbnail">
                                <a href="{{ route('gallery.archives.show', $archive) }}">
                                    <img src="{{ asset('storage/' . $archive->cover_image) }}" 
                                         alt="{{ $archive->title }}" 
                                         class="img-fluid">
                                    <div class="archive-overlay">
                                        <div class="archive-info">
                                            <h4>{{ $archive->title }}</h4>
                                            @if($archive->description)
                                                <p class="text-white-50 mb-3">{{ Str::limit($archive->description, 100) }}</p>
                                            @endif
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>
                                                    <i class="fas fa-images me-2"></i>
                                                    {{ $archive->photos_count }} টি ছবি
                                                </span>
                                                <span>
                                                    <i class="fas fa-calendar-alt me-2"></i>
                                                    {{ $archive->year }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-archive fa-3x text-muted mb-3"></i>
                            <p class="text-muted">কোন আর্কাইভ পাওয়া যায়নি</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $archives->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .archive-card {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }
    .archive-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }
    .archive-thumbnail {
        position: relative;
        padding-top: 75%; /* 4:3 Aspect Ratio */
    }
    .archive-thumbnail img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .archive-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.9));
        display: flex;
        align-items: flex-end;
        padding: 25px;
        transition: all 0.3s ease;
    }
    .archive-card:hover .archive-overlay {
        background: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.95));
    }
    .archive-info {
        color: white;
        width: 100%;
    }
    .archive-info h4 {
        margin: 0 0 10px;
        font-size: 1.4rem;
        font-weight: 600;
    }
    .archive-info p {
        font-size: 1rem;
        line-height: 1.6;
    }
    .archive-info span {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    .archive-info i {
        width: 20px;
        text-align: center;
    }
</style>
@endpush
@endsection
