<!-- ========================================================================
     8. RESEARCH ARTICLES & ESSAYS (গবেষণামূলক প্রবন্ধ ও নিবন্ধ সম্ভার)
     ======================================================================== -->
@php
    $limit = $section->item_limit ?? 3;
    $articleList = isset($articles) ? $articles->take($limit) : collect();
@endphp
<section class="articles-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <div>
                @if($section->badge_text)
                    <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold mb-1">
                        <i class="fas fa-feather-alt me-1"></i> {{ $section->badge_text }}
                    </span>
                @endif
                <h2 class="fw-bold fs-3 text-dark mb-0">{{ $section->title ?? 'প্রবন্ধ ও আর্টিকেল আর্কাইভ' }}</h2>
                @if($section->subtitle)
                    <p class="text-muted small mb-0 mt-1">{{ $section->subtitle }}</p>
                @endif
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('publications.articles') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                    সকল প্রবন্ধ ও আর্টিকেল <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-3 g-lg-4">
            @forelse($articleList as $article)
                <div class="col-md-6 col-lg-4">
                    <div class="article-modern-card">
                        <a href="{{ route('publications.articles.read', $article->id) }}" class="article-cover-wrap text-decoration-none d-block">
                            @if($article->cover_image)
                                <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" loading="lazy">
                            @else
                                <img src="{{ asset('images/quran.jpg') }}" alt="{{ $article->title }}">
                            @endif
                            <span class="article-category-badge">
                                <i class="fas fa-book-reader me-1"></i> গবেষণামূলক প্রবন্ধ
                            </span>
                        </a>
                        <div class="article-content-wrap">
                            <div class="article-meta-info">
                                <span>
                                    <i class="far fa-calendar-alt text-success me-1"></i>
                                    {{ $article->created_at ? $article->created_at->format('d M, Y') : '২০২৫' }}
                                </span>
                                @if($article->author)
                                    <span>•</span>
                                    <span class="text-truncate" style="max-width: 170px;">
                                        <i class="fas fa-pen-nib text-warning me-1"></i> {{ $article->author }}
                                    </span>
                                @endif
                            </div>
                            <h3 class="article-card-title">
                                <a href="{{ route('publications.articles.read', $article->id) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            @if($article->description)
                                <p class="article-card-excerpt">
                                    {{ Str::limit(strip_tags($article->description), 110) }}
                                </p>
                            @endif
                            <a href="{{ route('publications.articles.read', $article->id) }}" class="btn-article-read">
                                <span>সম্পূর্ণ প্রবন্ধ পড়ুন</span> <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="p-4 text-center text-muted bg-light rounded-3">কোনো প্রবন্ধ বা আর্টিকেল পাওয়া যায়নি</div>
                </div>
            @endforelse
        </div>
    </div>
</section>
