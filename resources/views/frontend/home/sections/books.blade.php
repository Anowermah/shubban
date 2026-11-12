<!-- ========================================================================
     9. FEATURED PUBLICATIONS & BOOKS (শুব্বান প্রকাশনা ও বই সম্ভার)
     ======================================================================== -->
@php
    $limit = $section->item_limit ?? 4;
    $bookList = isset($featuredBooks) ? $featuredBooks->take($limit) : collect();
@endphp
<section class="py-4 py-lg-5 bg-white border-bottom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <div>
                @if($section->badge_text)
                    <span class="badge bg-info-subtle text-info-emphasis px-3 py-1 rounded-pill fw-bold mb-1">{{ $section->badge_text }}</span>
                @endif
                <h2 class="fw-bold fs-3 text-dark mb-0">{{ $section->title ?? 'শুব্বান প্রকাশনা ও মাকতাবাহ' }}</h2>
                @if($section->subtitle)
                    <p class="text-muted small mb-0 mt-1">{{ $section->subtitle }}</p>
                @endif
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('publications.magazines') }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 text-dark fw-semibold">
                    <i class="fas fa-newspaper me-1"></i> মাসিক পত্রিকা
                </a>
                <a href="{{ route('publications.books') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                    সকল বই <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-3 g-lg-4 mobile-swipe-track books-swipe-track">
            @forelse($bookList as $book)
                <div class="col-6 col-md-3">
                    <div class="book-card-item">
                        <a href="{{ route('publications.books.read', $book->id) }}" class="book-cover-wrap text-decoration-none">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" loading="lazy">
                            @else
                                <i class="fas fa-book fa-3x text-muted"></i>
                            @endif
                        </a>
                        <h4 class="book-title-text" title="{{ $book->title }}">
                            <a href="{{ route('publications.books.read', $book->id) }}" class="text-decoration-none" style="color: inherit;">
                                {{ $book->title }}
                            </a>
                        </h4>
                        <p class="book-author-text">
                            <i class="fas fa-user-edit me-1 text-muted"></i> {{ $book->author ?? 'শুব্বান প্রকাশনী' }}
                        </p>
                        <div class="book-actions-wrap">
                            <span class="badge bg-success-subtle text-success small">
                                {{ $book->price ? '৳ ' . $book->price : 'ফ্রি' }}
                            </span>
                            <a href="{{ route('publications.books.read', $book->id) }}" class="btn btn-sm btn-success rounded-pill px-2 py-0" style="font-size: 0.78rem;">
                                <i class="fas fa-book-reader me-1"></i> পড়ুন
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="p-4 text-center text-muted">কোন বই পাওয়া যায়নি</div>
                </div>
            @endforelse
        </div>
    </div>
</section>
