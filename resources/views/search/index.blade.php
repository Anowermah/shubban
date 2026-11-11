@extends('layouts.app')

@section('title', 'অনুসন্ধানের ফলাফল: ' . ($query ?: 'সকল তথ্য') . ' - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="search-page-section py-5">
    <div class="container">
        <!-- Search Header & Input Box -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 col-md-10 text-center">
                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold mb-2">
                    <i class="fas fa-search me-1"></i> ওয়েবসাইট অনুসন্ধান
                </span>
                <h1 class="display-6 fw-bold text-dark mb-3">অনুসন্ধানের ফলাফল</h1>
                
                <form action="{{ route('search') }}" method="GET" class="position-relative mt-4">
                    <div class="search-bar-wrap shadow-sm rounded-pill p-1 bg-white border">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-4 text-muted"></i>
                        <input type="text" 
                               name="q" 
                               value="{{ $query }}" 
                               class="form-control border-0 rounded-pill ps-5 py-3 shadow-none" 
                               placeholder="বই, লেখক, দায়িত্বশীল ব্যক্তি, নোটিশ বা সংবাদ খুঁজুন..." 
                               required>
                        <button type="submit" class="btn btn-success rounded-pill position-absolute end-0 top-50 translate-middle-y me-2 px-4 py-2">
                            অনুসন্ধান
                        </button>
                    </div>
                </form>

                @if(!empty($query))
                    <div class="mt-3 text-muted small">
                        "<strong>{{ $query }}</strong>" অনুসন্ধানে মোট <span class="fw-bold text-success">{{ $totalCount }}</span> টি ফলাফল পাওয়া গেছে।
                    </div>
                @endif
            </div>
        </div>

        @if(!empty($query) && $totalCount > 0)
            <!-- Category Filter Pills -->
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 py-2 filter-tab-btn active" data-cat="all">
                    সব ফলাফল ({{ $totalCount }})
                </button>
                @foreach($groupedResults as $categoryName => $catItems)
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2 filter-tab-btn bg-white" data-cat="{{ $categoryName }}">
                        {{ $categoryName }} ({{ count($catItems) }})
                    </button>
                @endforeach
            </div>

            <!-- Results Grid -->
            <div class="row g-4" id="searchResultsGrid">
                @foreach($results as $item)
                    <div class="col-lg-6 col-12 result-item-col" data-cat="{{ $item['category'] }}">
                        <div class="result-card p-4 rounded-4 bg-white shadow-sm border h-100 d-flex flex-column justify-content-between transition-all">
                            <div class="d-flex align-items-start gap-3">
                                <div class="result-icon-box rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px; background: rgba(12, 75, 54, 0.08); color: #0C4B36;">
                                    @if(!empty($item['image']))
                                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-100 h-100 rounded-3 object-fit-cover" onerror="this.onerror=null; this.parentElement.innerHTML='<i class=\'{{ $item['icon'] }} fs-4\'></i>';">
                                    @else
                                        <i class="{{ $item['icon'] }} fs-4"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="badge {{ $item['category_badge'] }} rounded-pill font-xs px-2 py-1">
                                            {{ $item['category'] }}
                                        </span>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1 text-truncate">
                                        <a href="{{ $item['url'] }}" class="text-dark text-decoration-none hover-green">
                                            {{ $item['title'] }}
                                        </a>
                                    </h5>
                                    @if(!empty($item['subtitle']))
                                        <p class="text-muted small mb-0">{{ $item['subtitle'] }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="pt-3 mt-3 border-top d-flex justify-content-end">
                                <a href="{{ $item['url'] }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                    দেখুন <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif(!empty($query))
            <!-- No Results Found -->
            <div class="text-center py-5">
                <div class="bg-white rounded-4 shadow-sm p-5 border mx-auto" style="max-width: 600px;">
                    <i class="fas fa-search-minus fa-3x text-muted mb-3 opacity-50"></i>
                    <h4 class="fw-bold text-dark mb-2">কোনো ফলাফল পাওয়া যায়নি</h4>
                    <p class="text-muted mb-4">"<strong>{{ $query }}</strong>" সম্পর্কিত কোনো তথ্য, বই, নোটিশ বা দায়িত্বশীল পাওয়া যায়নি।</p>
                    
                    <div class="bg-light p-3 rounded-3 text-start small">
                        <strong class="text-dark d-block mb-1"><i class="fas fa-lightbulb text-warning me-1"></i> পরামর্শ:</strong>
                        <ul class="mb-0 ps-3 text-muted">
                            <li>বানান সঠিক আছে কিনা পরীক্ষা করুন।</li>
                            <li>কম শব্দ বা সাধারণ শব্দ দিয়ে চেষ্টা করুন (উদাঃ 'তাওহীদ', 'সিরাজগঞ্জ', 'সালাত')।</li>
                            <li>অন্য কোনো সমর্থক শব্দ দিয়ে খুঁজুন।</li>
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <!-- Search Home -->
            <div class="text-center py-5">
                <div class="bg-white rounded-4 shadow-sm p-5 border mx-auto" style="max-width: 600px;">
                    <i class="fas fa-book-reader fa-3x text-success mb-3 opacity-75"></i>
                    <h4 class="fw-bold text-dark mb-2">কী খুঁজছেন?</h4>
                    <p class="text-muted mb-4">উপরের সার্চ বক্সে আপনার প্রয়োজনীয় বিষয়, বইয়ের নাম, লেখকের নাম বা জেলা লিখে অনুসন্ধান করুন।</p>
                    
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <a href="{{ route('search', ['q' => 'বই']) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">বইসমূহ</a>
                        <a href="{{ route('search', ['q' => 'সিরাজগঞ্জ']) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">সিরাজগঞ্জ</a>
                        <a href="{{ route('search', ['q' => 'ঢাকা']) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">ঢাকা</a>
                        <a href="{{ route('search', ['q' => 'নোটিশ']) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">নোটিশ</a>
                        <a href="{{ route('search', ['q' => 'সংবাদ']) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">সংবাদ</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .search-page-section {
        background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        min-height: 80vh;
    }

    .search-bar-wrap {
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .search-bar-wrap:focus-within {
        border-color: #0C4B36;
        box-shadow: 0 4px 18px rgba(12, 75, 54, 0.12) !important;
    }

    .result-card {
        transition: all 0.25s ease;
    }

    .result-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(12, 75, 54, 0.1) !important;
        border-color: rgba(12, 75, 54, 0.2) !important;
    }

    .hover-green:hover {
        color: #0C4B36 !important;
    }

    .font-xs {
        font-size: 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.filter-tab-btn');
    const items = document.querySelectorAll('.result-item-col');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => {
                t.classList.remove('active', 'btn-success');
                t.classList.add('btn-outline-secondary');
            });
            this.classList.remove('btn-outline-secondary');
            this.classList.add('active', 'btn-success');

            const category = this.getAttribute('data-cat');

            items.forEach(item => {
                if (category === 'all' || item.getAttribute('data-cat') === category) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush
@endsection
