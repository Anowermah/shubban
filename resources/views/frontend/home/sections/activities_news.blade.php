<!-- ========================================================================
     6. RECENT ACTIVITIES & LATEST NEWS (সাম্প্রতিক কার্যক্রম ও খবর)
     ======================================================================== -->
@php
    $limit = $section->item_limit ?? 4;
    $activityList = isset($activities) ? $activities->take($limit) : collect();
    $extra = $section->extra_config ?? [];
    $newsLimit = $extra['news_limit'] ?? 3;
    $newsList = isset($news) ? $news->take($newsLimit) : collect();
@endphp
<section class="py-4 py-lg-5" style="background-color: #f8fafc;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <div>
                @if($section->badge_text)
                    <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold mb-1">{{ $section->badge_text }}</span>
                @endif
                <h2 class="fw-bold fs-3 text-dark mb-0 d-flex align-items-center">
                    <i class="fas fa-calendar-check text-success me-2"></i> {{ $section->title ?? 'সাম্প্রতিক কার্যক্রম' }}
                </h2>
                @if($section->subtitle)
                    <p class="text-muted small mb-0 mt-1">{{ $section->subtitle }}</p>
                @endif
            </div>
            <a href="{{ route('activities.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                সকল কার্যক্রম <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-3 g-lg-4 mobile-swipe-track activities-swipe-track">
            @forelse($activityList as $activity)
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="card h-100 border-0 rounded-3 shadow-sm overflow-hidden bg-white">
                        @if($activity->image)
                            <div style="height: 150px; overflow: hidden; background: #e2e8f0;">
                                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="w-100 h-100 object-fit-cover">
                            </div>
                        @else
                            <div style="height: 150px; overflow: hidden; background: linear-gradient(135deg, #0C4B36 0%, #072e20 100%); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.7);">
                                <i class="fas fa-calendar-alt fa-3x"></i>
                            </div>
                        @endif
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-1">
                                <i class="far fa-calendar-alt text-success me-1"></i>
                                {{ $activity->created_at ? $activity->created_at->format('d M, Y') : '' }}
                            </div>
                            <h4 class="fs-6 fw-bold mb-2" style="color: #0C4B36; min-height: 40px;">
                                <a href="{{ route('activities.show', $activity) }}" class="text-decoration-none" style="color: inherit;">
                                    {{ Str::limit($activity->title, 45) }}
                                </a>
                            </h4>
                            <p class="small text-secondary mb-3 flex-grow-1">
                                {{ Str::limit(strip_tags($activity->description), 75) }}
                            </p>
                            <a href="{{ route('activities.show', $activity) }}" class="btn btn-sm btn-outline-success rounded-pill mt-auto" style="width: fit-content; font-size: 0.8rem;">
                                বিস্তারিত পড়ুন <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="p-4 text-center bg-white rounded-3 shadow-sm text-muted">
                        কোনো সাম্প্রতিক কার্যক্রম পাওয়া যায়নি
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Latest News Strip -->
        @if($newsList->isNotEmpty())
            <div class="mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="fs-6 fw-bold text-dark mb-0 d-flex align-items-center">
                        <i class="fas fa-newspaper text-warning me-2"></i> সর্বশেষ সংবাদ বুলেটিন
                    </h4>
                    <a href="{{ route('news.index') }}" class="small text-success text-decoration-none fw-semibold">
                        সকল সংবাদ <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </div>
                <div class="row g-2">
                    @foreach($newsList as $newsItem)
                        <div class="col-md-4">
                            <a href="{{ route('news.show', $newsItem->id) }}" class="p-2 px-3 bg-white border rounded-3 text-decoration-none d-flex align-items-center justify-content-between gap-2 shadow-sm hover-shadow transition-all">
                                <div class="text-truncate">
                                    <i class="fas fa-caret-right text-success me-1"></i>
                                    <span class="fw-semibold text-dark small">{{ $newsItem->title }}</span>
                                </div>
                                <span class="badge bg-light text-secondary border font-xs">{{ $newsItem->created_at->format('d/m') }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
