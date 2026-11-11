@extends('layouts.page')

@section('title', 'অনুসন্ধানের ফলাফল')

@section('page-content')
<div class="search-results">
    <div class="search-header mb-4">
        <h2>অনুসন্ধান: "{{ $query }}"</h2>
    </div>

    @if(count($results) > 0)
        <div class="results-list">
            @foreach($results as $result)
                <div class="result-item mb-4">
                    <h3><a href="{{ $result->url }}">{{ $result->title }}</a></h3>
                    <p class="text-muted">{{ $result->excerpt }}</p>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-results">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                দুঃখিত, আপনার অনুসন্ধানের সাথে মিলে এমন কোন তথ্য পাওয়া যায়নি।
            </div>
            <div class="suggestions mt-4">
                <h4>পরামর্শ:</h4>
                <ul>
                    <li>সঠিক বানান ব্যবহার করে চেষ্টা করুন</li>
                    <li>কম শব্দ ব্যবহার করে চেষ্টা করুন</li>
                    <li>বিভিন্ন শব্দ ব্যবহার করে চেষ্টা করুন</li>
                </ul>
            </div>
        </div>
    @endif
</div>

<style>
.search-results {
    max-width: 800px;
    margin: 0 auto;
}

.result-item h3 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
}

.result-item h3 a {
    color: #004d40;
    text-decoration: none;
}

.result-item h3 a:hover {
    color: #00695c;
    text-decoration: underline;
}

.suggestions ul {
    list-style-type: none;
    padding-left: 0;
}

.suggestions li {
    padding: 5px 0;
    position: relative;
    padding-left: 20px;
}

.suggestions li:before {
    content: "•";
    position: absolute;
    left: 0;
    color: #004d40;
}
</style>
@endsection
