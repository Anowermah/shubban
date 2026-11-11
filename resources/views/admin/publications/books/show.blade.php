@extends('admin.layouts.app')

@section('title', $book->title)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">বইয়ের বিস্তারিত</h4>
                    <div class="btn-group">
                        <a href="{{ route('admin.publications.books.edit', $book->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit me-1"></i>সম্পাদনা
                        </a>
                        <a href="{{ route('admin.publications.books.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>পিছনে যান
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center mb-4">
                                @if($book->cover_image)
                                    <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="img-fluid rounded shadow" style="max-height: 400px;">
                                @else
                                    <img src="{{ asset('images/books/placeholder.jpg') }}" alt="{{ $book->title }}" class="img-fluid rounded shadow" style="max-height: 400px;">
                                @endif
                            </div>

                            @if($book->pdf_file)
                            <div class="d-grid">
                                <a href="{{ Storage::url($book->pdf_file) }}" class="btn btn-success" target="_blank">
                                    <i class="fas fa-file-pdf me-1"></i>PDF ফাইল দেখুন
                                </a>
                            </div>
                            @endif
                        </div>
                        
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 150px;">শিরোনাম</th>
                                    <td>{{ $book->title }}</td>
                                </tr>
                                <tr>
                                    <th>লেখক</th>
                                    <td>{{ $book->author }}</td>
                                </tr>
                                <tr>
                                    <th>ISBN</th>
                                    <td>{{ $book->isbn ?: 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>মূল্য</th>
                                    <td>
                                        @if($book->price)
                                            ৳{{ number_format($book->price, 2) }}
                                        @else
                                            <span class="badge bg-success">বিনামূল্যে</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>প্রকাশের তারিখ</th>
                                    <td>{{ $book->publication_date ? \Carbon\Carbon::parse($book->publication_date)->format('d/m/Y') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>স্টেটাস</th>
                                    <td>
                                        @if($book->status == 'published')
                                            <span class="badge bg-success">প্রকাশিত</span>
                                        @else
                                            <span class="badge bg-warning">খসড়া</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>তৈরির তারিখ</th>
                                    <td>{{ $book->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>সর্বশেষ আপডেট</th>
                                    <td>{{ $book->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>

                            @if($book->description)
                            <div class="mt-4">
                                <h5 class="mb-3">বিবরণ</h5>
                                <div class="p-3 bg-light rounded">
                                    {!! nl2br(e($book->description)) !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table > :not(caption) > * > * {
        padding: 1rem;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 0.75em;
    }
</style>
@endpush
@endsection
