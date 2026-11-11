<!-- ========================================================================
     10. DEDICATED PHOTO GALLERY (দৃষ্টিজুড়ানো ফটো গ্যালারি)
     ======================================================================== -->
@php
    $limit = $section->item_limit ?? 8;
    $photoList = isset($photos) ? $photos->take($limit) : collect();
@endphp
<section class="photo-gallery-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <div>
                @if($section->badge_text)
                    <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold mb-1">
                        <i class="fas fa-camera-retro me-1"></i> {{ $section->badge_text }}
                    </span>
                @endif
                <h2 class="fw-bold fs-3 text-dark mb-0">{{ $section->title ?? 'দৃষ্টিজুড়ানো ফটো গ্যালারি' }}</h2>
                @if($section->subtitle)
                    <p class="text-muted small mb-0 mt-1">{{ $section->subtitle }}</p>
                @endif
            </div>
            <a href="{{ route('gallery.photos') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                <i class="fas fa-images me-1"></i> সকল ছবি দেখুন ({{ count($photos ?? []) }}+)
            </a>
        </div>

        <!-- Photos Grid -->
        <div class="row g-3 g-lg-4">
            @forelse($photoList as $photo)
                <div class="col-6 col-md-3">
                    <a href="{{ $photo->image_url }}" data-lightbox="shubban-photo-gallery" data-title="{{ $photo->title }}" class="photo-grid-card">
                        <div class="photo-grid-thumb">
                            <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}" loading="lazy">
                            <div class="photo-grid-overlay">
                                <div class="photo-zoom-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="photo-caption-bar">
                            <h4 class="photo-caption-text" title="{{ $photo->title }}">{{ $photo->title }}</h4>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="p-4 text-center text-muted">কোনো ছবি পাওয়া যায়নি</div>
                </div>
            @endforelse
        </div>
    </div>
</section>
