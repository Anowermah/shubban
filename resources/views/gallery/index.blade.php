@extends('layouts.app')

@section('title', 'ফটো গ্যালারি')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="text-center mb-4">ফটো গ্যালারি</h1>
        </div>
    </div>

    <div class="row g-4">
        @forelse($photos as $photo)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="gallery-item">
                    <a href="{{ asset('storage/' . $photo->image) }}" data-lightbox="gallery" data-title="{{ $photo->title }}">
                        <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="img-fluid rounded">
                    </a>
                    <div class="gallery-caption">
                        <h6>{{ $photo->title }}</h6>
                        <p class="text-muted">{{ $photo->date->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">কোন ছবি পাওয়া যায়নি</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $photos->links() }}
    </div>
</div>
@endsection

@push('styles')
    <!-- Lightbox CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">

    <style>
        .gallery-item {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .gallery-item:hover {
            transform: scale(1.02);
        }
        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .gallery-caption {
            padding: 15px;
        }
        .gallery-caption h6 {
            margin: 0;
            font-size: 1rem;
        }
        .gallery-caption p {
            margin: 5px 0 0;
            font-size: 0.875rem;
        }
    </style>
@endpush

@push('scripts')
    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "ছবি %1 / %2"
        })
    </script>
@endpush
