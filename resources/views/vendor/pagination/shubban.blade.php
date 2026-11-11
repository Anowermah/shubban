@php
    $toBn = function($number) {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, (string)$number);
    };
@endphp

@if ($paginator->hasPages())
    <div class="shubban-pagination-wrap d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 my-4 py-3 px-3 rounded-4 bg-white border shadow-sm">
        <!-- Pagination Result Info -->
        <div class="pagination-info text-muted small text-center text-md-start">
            মোট <span class="fw-bold text-dark">{{ $toBn($paginator->total()) }}</span> টির মধ্যে 
            <span class="fw-bold text-success">{{ $toBn($paginator->firstItem()) }}-{{ $toBn($paginator->lastItem()) }}</span> টি প্রদর্শিত হচ্ছে 
            <span class="mx-1 text-muted">•</span> 
            পৃষ্ঠা <span class="badge bg-success-subtle text-success px-2 py-1 fw-bold">{{ $toBn($paginator->currentPage()) }}</span> / <span class="fw-bold text-dark">{{ $toBn($paginator->lastPage()) }}</span>
        </div>

        <!-- Pagination Controls -->
        <nav aria-label="পাতা পরিবর্তন">
            <ul class="pagination pagination-sm mb-0 justify-content-center flex-wrap gap-1">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-hidden="true">
                            <i class="fas fa-chevron-left me-1"></i> পূর্ববর্তী
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="পূর্ববর্তী পৃষ্ঠা">
                            <i class="fas fa-chevron-left me-1"></i> পূর্ববর্তী
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link active-page-pill">
                                        {{ $toBn($page) }}
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $toBn($page) }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="পরবর্তী পৃষ্ঠা">
                            পরবর্তী <i class="fas fa-chevron-right ms-1"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-hidden="true">
                            পরবর্তী <i class="fas fa-chevron-right ms-1"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@elseif($paginator->total() > 0)
    <div class="shubban-pagination-wrap d-flex justify-content-center align-items-center my-3 py-2 px-3 rounded-3 bg-light border text-muted small">
        <i class="fas fa-check-circle text-success me-2"></i>
        মোট <span class="fw-bold text-dark mx-1">{{ $toBn($paginator->total()) }}</span> টি ফলাফল সম্পূর্ণ প্রদর্শিত হচ্ছে
    </div>
@endif

<style>
    .shubban-pagination-wrap {
        border-color: rgba(12, 75, 54, 0.12) !important;
    }
    .shubban-pagination-wrap .pagination {
        --bs-pagination-border-radius: 8px;
    }
    .shubban-pagination-wrap .page-link {
        color: #0C4B36;
        border-radius: 8px !important;
        padding: 6px 12px;
        font-weight: 600;
        font-size: 0.88rem;
        border: 1px solid #d5e4dc;
        background: #fff;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
    }
    .shubban-pagination-wrap .page-link:hover {
        background-color: #e8f5ee;
        border-color: #0C4B36;
        color: #0C4B36;
        transform: translateY(-1px);
    }
    .shubban-pagination-wrap .page-item.active .active-page-pill {
        background: linear-gradient(135deg, #0C4B36 0%, #176B4E 100%) !important;
        border-color: #0C4B36 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 10px rgba(12, 75, 54, 0.3);
        font-weight: 700;
    }
    .shubban-pagination-wrap .page-item.disabled .page-link {
        color: #94a3b8;
        background-color: #f8fafc;
        border-color: #e2e8f0;
        cursor: not-allowed;
    }
</style>
