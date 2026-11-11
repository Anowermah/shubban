<!-- ========================================================================
     12. DEDICATED CINEMATIC VIDEO GALLERY (ভিডিও লেকচার ও প্রামাণ্যচিত্র)
     ======================================================================== -->
@php
    $limit = $section->item_limit ?? 4;
    $videoList = isset($videos) ? $videos->take($limit) : collect();
@endphp
<section class="video-cinema-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <div>
                @if($section->badge_text)
                    <span class="badge bg-danger px-3 py-1 rounded-pill fw-bold mb-1">
                        <i class="fab fa-youtube me-1"></i> {{ $section->badge_text }}
                    </span>
                @endif
                <h2 class="fw-bold fs-3 text-white mb-0">{{ $section->title ?? 'ভিডিও লেকচার ও আলোচনা' }}</h2>
                @if($section->subtitle)
                    <p class="text-white-50 small mb-0 mt-1">{{ $section->subtitle }}</p>
                @endif
            </div>
            <a href="{{ route('gallery.videos') }}" class="btn btn-sm btn-outline-danger text-white rounded-pill px-3">
                <i class="fab fa-youtube text-danger me-1"></i> সকল ভিডিও দেখুন ({{ count($videos ?? []) }}+)
            </a>
        </div>

        <!-- Videos Grid -->
        <div class="row g-3 g-lg-4">
            @forelse($videoList as $video)
                @php
                    $videoId = '';
                    if (strpos($video->video_url, 'youtube.com') !== false) {
                        parse_str(parse_url($video->video_url, PHP_URL_QUERY), $params);
                        $videoId = $params['v'] ?? '';
                    } elseif (strpos($video->video_url, 'youtu.be') !== false) {
                        $videoId = basename(parse_url($video->video_url, PHP_URL_PATH));
                    }
                @endphp
                <div class="col-6 col-lg-3">
                    <div class="video-cinema-card">
                        <a href="{{ $video->video_url }}" data-fancybox="home-videos" data-caption="{{ $video->title }}" class="text-decoration-none">
                            <div class="video-thumb-wrap">
                                <img src="{{ $videoId ? 'https://img.youtube.com/vi/'.$videoId.'/mqdefault.jpg' : asset('images/video-placeholder.jpg') }}" alt="{{ $video->title }}">
                                <div class="video-play-pulse">
                                    <i class="fas fa-play ms-1"></i>
                                </div>
                            </div>
                            <div class="video-cinema-body">
                                <h4 class="video-cinema-title" title="{{ $video->title }}">
                                    {{ $video->title }}
                                </h4>
                                <div class="mt-2 text-white-50 small d-flex align-items-center justify-content-between">
                                    <span><i class="fab fa-youtube text-danger me-1"></i> ভিডিও দেখুন</span>
                                    <span><i class="fas fa-play-circle"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="p-4 text-center text-white-50">কোনো ভিডিও পাওয়া যায়নি</div>
                </div>
            @endforelse
        </div>
    </div>
</section>
