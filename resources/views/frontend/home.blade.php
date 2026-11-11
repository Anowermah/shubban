@extends('frontend.layouts.app')

@section('content')
    <!-- Hero Slider Section -->
    <section class="hero-slider">
        <div id="mainSlider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach($sliders as $key => $slider)
                    <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="{{ $key }}" 
                            class="{{ $key == 0 ? 'active' : '' }}" aria-current="true" 
                            aria-label="Slide {{ $key + 1 }}"></button>
                @endforeach
            </div>
            
            <div class="carousel-inner">
                @foreach($sliders as $key => $slider)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}">
                        <div class="carousel-caption d-none d-md-block">
                            @if($slider->title || $slider->subtitle)
                                <div class="caption-content">
                                    @if($slider->title)
                                        <h2 class="display-4 fw-bold mb-3">{{ $slider->title }}</h2>
                                    @endif
                                    @if($slider->subtitle)
                                        <p class="lead mb-4">{{ $slider->subtitle }}</p>
                                    @endif
                                    @if($slider->button_text && $slider->button_link)
                                        <a href="{{ $slider->button_link }}" class="btn btn-primary btn-lg">
                                            {{ $slider->button_text }}
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if(count($sliders) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </section>

    <!-- Rest of the homepage content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1>স্বাগতম</h1>
                <p>This is the content of the home page.</p>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.hero-slider {
    margin-bottom: 2rem;
}

.carousel-item {
    height: 500px;
    overflow: hidden;
}

.carousel-item img {
    object-fit: cover;
    height: 100%;
    width: 100%;
}

.carousel-caption {
    background: rgba(0, 0, 0, 0.5);
    padding: 2rem;
    border-radius: 10px;
    max-width: 80%;
    margin: 0 auto;
    bottom: 50%;
    transform: translateY(50%);
}

.caption-content {
    animation: fadeInUp 0.5s ease-out;
}

.carousel-indicators {
    margin-bottom: 2rem;
}

.carousel-control-prev,
.carousel-control-next {
    width: 5%;
    opacity: 0.8;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .carousel-item {
        height: 300px;
    }

    .carousel-caption {
        position: relative;
        background: #fff;
        color: #000;
        padding: 1rem;
        margin-top: -60px;
        z-index: 2;
    }

    .carousel-caption h2 {
        font-size: 1.5rem;
    }

    .carousel-caption p {
        font-size: 1rem;
    }

    .carousel-caption .btn {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }
}
</style>
@endpush
