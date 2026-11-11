@extends('admin.layouts.app')

@section('title', 'বই ব্যবস্থাপনা')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-primary">
                    <i class="fas fa-books me-2"></i>বই ব্যবস্থাপনা
                </h4>
                <a href="{{ route('admin.publications.books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>নতুন বই যোগ করুন
                </a>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.publications.books.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="search" class="form-label">অনুসন্ধান</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="বইয়ের নাম বা লেখক...">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status" class="form-label">স্টেটাস</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">সব</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>প্রকাশিত</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>খসড়া</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sort" class="form-label">সাজানো</label>
                        <select class="form-select" id="sort" name="sort">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>সর্বশেষ</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>পুরাতন</option>
                            <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>শিরোনাম (A-Z)</option>
                            <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>শিরোনাম (Z-A)</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>খুঁজুন
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Books List -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 50px">#</th>
                            <th scope="col" style="width: 100px">কভার</th>
                            <th scope="col">শিরোনাম</th>
                            <th scope="col">লেখক</th>
                            <th scope="col">মূল্য</th>
                            <th scope="col" style="width: 120px">স্টেটাস</th>
                            <th scope="col" style="width: 150px">প্রকাশের তারিখ</th>
                            <th scope="col" style="width: 120px">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                        <tr>
                            <td>{{ $books->firstItem() + $loop->index }}</td>
                            <td>
                                @if($book->cover_image)
                                    <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: 80px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/books/placeholder.jpg') }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: 80px; object-fit: cover;">
                                @endif
                            </td>
                            <td>
                                <h6 class="mb-1">{{ $book->title }}</h6>
                                @if($book->isbn)
                                    <small class="text-muted">ISBN: {{ $book->isbn }}</small>
                                @endif
                            </td>
                            <td>{{ $book->author }}</td>
                            <td>
                                @if($book->price)
                                    ৳{{ number_format($book->price, 2) }}
                                @else
                                    <span class="badge bg-success">বিনামূল্যে</span>
                                @endif
                            </td>
                            <td>
                                @if($book->status == 'published')
                                    <span class="badge bg-success">প্রকাশিত</span>
                                @else
                                    <span class="badge bg-warning">খসড়া</span>
                                @endif
                            </td>
                            <td>{{ $book->publication_date ? \Carbon\Carbon::parse($book->publication_date)->format('d/m/Y') : 'N/A' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.publications.books.edit', $book->id) }}" class="btn btn-sm btn-primary" title="সম্পাদনা">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.publications.books.show', $book->id) }}" class="btn btn-sm btn-info" title="বিস্তারিত">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" title="মুছে ফেলুন" 
                                            onclick="if(confirm('আপনি কি নিশ্চিত যে আপনি এই বইটি মুছে ফেলতে চান?')) { document.getElementById('delete-form-{{ $book->id }}').submit(); }">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $book->id }}" action="{{ route('admin.publications.books.destroy', $book->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <img src="{{ asset('images/no-data.svg') }}" alt="No Data" style="width: 120px; height: 120px; opacity: 0.5;">
                                <h4 class="text-muted mt-3">কোন বই পাওয়া যায়নি</h4>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-4">
                {{ $books->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }
    
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .btn-group .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    .btn-group .btn:hover {
        transform: translateY(-1px);
    }

    .badge {
        font-weight: 500;
        padding: 0.5em 0.75em;
    }

    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: none;
        border-radius: 0.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
    }
</style>
@endpush
@endsection
