@extends('layouts.app')

@section('title', $archive->title)

@section('meta')
<meta property="og:title" content="{{ $archive->title }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($archive->description), 200) }}">
<meta property="og:image" content="{{ asset('storage/' . $archive->cover_image) }}">
<meta property="og:url" content="{{ route('gallery.archives.show', $archive) }}">
<meta name="twitter:card" content="summary_large_image">
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">হোম</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gallery.archives') }}">আর্কাইভ গ্যালারি</a></li>
                    <li class="breadcrumb-item active">{{ $archive->title }}</li>
                </ol>
            </nav>

            <div class="card">
                <img src="{{ asset('storage/' . $archive->cover_image) }}" 
                     class="card-img-top" 
                     alt="{{ $archive->title }}">
                
                <div class="card-body">
                    <h1 class="card-title">{{ $archive->title }}</h1>
                    
                    <p class="text-muted mb-3">
                        <i class="fas fa-calendar-alt"></i> 
                        {{ $archive->year }}
                    </p>

                    @if($archive->description)
                        <div class="card-text mb-4">
                            {!! nl2br(e($archive->description)) !!}
                        </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="share-buttons">
                        <h5 class="mb-3">শেয়ার করুন</h5>
                        
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('gallery.archives.show', $archive)) }}" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <!-- Twitter -->
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('gallery.archives.show', $archive)) }}&text={{ urlencode($archive->title) }}" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="fab fa-twitter"></i>
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text={{ urlencode($archive->title . ' ' . route('gallery.archives.show', $archive)) }}" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                        <!-- Copy Link -->
                        <button type="button" 
                                class="btn btn-outline-primary btn-sm copy-link"
                                onclick="copyToClipboard('{{ route('gallery.archives.show', $archive) }}')"
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="লিংক কপি করুন">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('লিংক কপি করা হয়েছে!');
    }).catch(function(err) {
        console.error('Error copying text: ', err);
    });
}
</script>
@endpush
@endsection
