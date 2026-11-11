@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ $magazine->title }}</h2>
        <a href="{{ route('publications.magazines') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>ফিরে যান
        </a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    @if($magazine->cover_image)
                        <img src="{{ Storage::url($magazine->cover_image) }}" 
                             alt="{{ $magazine->title }}" 
                             class="img-fluid rounded mb-3">
                    @endif
                    <div class="d-grid gap-2">
                        <a href="{{ route('publications.magazines.read', $magazine) }}" class="btn btn-primary">
                            <i class="fas fa-book-reader me-1"></i>পড়ুন
                        </a>
                        @if($magazine->pdf_file)
                            <a href="{{ Storage::url($magazine->pdf_file) }}" class="btn btn-success" download>
                                <i class="fas fa-download me-1"></i>ডাউনলোড
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-4">ম্যাগাজিন তথ্য</h4>
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">শিরোনাম</th>
                            <td>{{ $magazine->title }}</td>
                        </tr>
                        <tr>
                            <th>ইস্যু নম্বর</th>
                            <td>{{ $magazine->issue_number }}</td>
                        </tr>
                        <tr>
                            <th>প্রকাশনার তারিখ</th>
                            <td>{{ $magazine->publication_date->format('d F, Y') }}</td>
                        </tr>
                        @if($magazine->price)
                            <tr>
                                <th>মূল্য</th>
                                <td>৳{{ number_format($magazine->price, 2) }}</td>
                            </tr>
                        @endif
                    </table>

                    @if($magazine->description)
                        <div class="mt-4">
                            <h5>বিবরণ</h5>
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($magazine->description)) !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($relatedMagazines && $relatedMagazines->count() > 0)
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">অন্যান্য সংখ্যা</h4>
                        <div class="row g-3">
                            @foreach($relatedMagazines as $relatedMagazine)
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="row g-0">
                                            <div class="col-4">
                                                @if($relatedMagazine->cover_image)
                                                    <img src="{{ Storage::url($relatedMagazine->cover_image) }}" 
                                                         alt="{{ $relatedMagazine->title }}" 
                                                         class="img-fluid rounded-start h-100 object-fit-cover">
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ $relatedMagazine->title }}</h6>
                                                    <p class="card-text small text-muted">
                                                        ইস্যু #{{ $relatedMagazine->issue_number }}
                                                    </p>
                                                    <a href="{{ route('publications.magazines.details', $relatedMagazine) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        বিস্তারিত দেখুন
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
