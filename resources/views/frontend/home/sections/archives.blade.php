<!-- ========================================================================
     11. HISTORICAL PHOTO ARCHIVES (ঐতিহাসিক অ্যালবাম ও ফটো আর্কাইভ)
     ======================================================================== -->
@php
    $limit = $section->item_limit ?? 4;
    $archiveList = isset($archives) ? $archives->take($limit) : collect();
@endphp
@if($archiveList->isNotEmpty())
    <section class="archive-gallery-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
                <div>
                    @if($section->badge_text)
                        <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-1 rounded-pill fw-bold mb-1">
                            <i class="fas fa-archive me-1"></i> {{ $section->badge_text }}
                        </span>
                    @endif
                    <h2 class="fw-bold fs-3 text-dark mb-0">{{ $section->title ?? 'ঐতিহাসিক ফটো আর্কাইভ' }}</h2>
                    @if($section->subtitle)
                        <p class="text-muted small mb-0 mt-1">{{ $section->subtitle }}</p>
                    @endif
                </div>
                <a href="{{ route('gallery.archives') }}" class="btn btn-sm btn-outline-warning text-dark fw-bold rounded-pill px-3">
                    সকল আর্কাইভ দেখুন <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-3 g-lg-4 mobile-swipe-track archives-swipe-track">
                @foreach($archiveList as $archive)
                    <div class="col-6 col-md-3">
                        <a href="{{ route('gallery.archives.show', $archive) }}" class="archive-album-card">
                            <div class="archive-thumb-wrap">
                                @php
                                    $coverSrc = asset('images/slider1.jpg');
                                    if ($archive->cover_image && file_exists(public_path('storage/' . $archive->cover_image))) {
                                        $coverSrc = asset('storage/' . $archive->cover_image);
                                    } elseif (isset($photos) && $photos->isNotEmpty()) {
                                        $coverSrc = $photos->first()->image_url;
                                    }
                                @endphp
                                <img src="{{ $coverSrc }}" alt="{{ $archive->title }}" loading="lazy">
                                <span class="archive-year-badge">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $archive->year ?? 'আর্কাইভ' }}
                                </span>
                            </div>
                            <div class="archive-body-wrap">
                                <h4 class="archive-album-title" title="{{ $archive->title }}">{{ $archive->title }}</h4>
                                <p class="archive-photo-count">
                                    <i class="fas fa-images text-success me-1"></i> অ্যালবাম দেখুন
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
