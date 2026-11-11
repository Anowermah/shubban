@extends('admin.layouts.app')

@section('title', 'নিবন্ধ ব্যবস্থাপনা')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">নিবন্ধ তালিকা</h5>
                    <a href="{{ route('admin.publications.articles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>নতুন নিবন্ধ
                    </a>
                </div>

                <div class="card-body">
                    <!-- Search & Filter -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('admin.publications.articles.index') }}" method="GET" class="d-flex gap-2">
                                <input type="text" 
                                       class="form-control" 
                                       name="search" 
                                       value="{{ request('search') }}" 
                                       placeholder="শিরোনাম বা লেখক দ্বারা খুঁজুন...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2 justify-content-md-end">
                                <select class="form-select w-auto" name="status" id="status-filter">
                                    <option value="">সব স্ট্যাটাস</option>
                                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>প্রকাশিত</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>খসড়া</option>
                                </select>
                                <select class="form-select w-auto" name="sort" id="sort-filter">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>সর্বশেষ</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>পুরাতন</option>
                                    <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>শিরোনাম (A-Z)</option>
                                    <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>শিরোনাম (Z-A)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Articles Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th style="width: 100px;">কভার</th>
                                    <th>শিরোনাম</th>
                                    <th>লেখক</th>
                                    <th>প্রকাশনার তারিখ</th>
                                    <th>স্ট্যাটাস</th>
                                    <th style="width: 150px;">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($articles as $article)
                                    <tr>
                                        <td>{{ $articles->firstItem() + $loop->index }}</td>
                                        <td>
                                            @if($article->cover_image && Storage::disk('public')->exists($article->cover_image))
                                                <img src="{{ Storage::url($article->cover_image) }}" 
                                                     alt="{{ $article->title }}"
                                                     class="img-thumbnail"
                                                     style="width: 80px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="img-thumbnail text-center text-muted" 
                                                     style="width: 80px; height: 60px; line-height: 60px;">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-medium">{{ $article->title }}</div>
                                            @if($article->pdf_file)
                                                <small class="text-success">
                                                    <i class="fas fa-file-pdf"></i> PDF সংযুক্ত
                                                </small>
                                            @endif
                                        </td>
                                        <td>{{ $article->author ?? '-' }}</td>
                                        <td>{{ $article->publication_date->format('d M, Y') }}</td>
                                        <td>
                                            @if($article->status == 'published')
                                                <span class="badge bg-success">প্রকাশিত</span>
                                            @else
                                                <span class="badge bg-warning">খসড়া</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('admin.publications.articles.edit', $article->id) }}" 
                                                   class="btn btn-sm btn-info" 
                                                   title="সম্পাদনা">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('publications.articles.read', $article->id) }}" 
                                                   class="btn btn-sm btn-success" 
                                                   title="দেখুন"
                                                   target="_blank">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('admin.publications.articles.destroy', $article->id) }}" 
                                                      method="POST" 
                                                      class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger" 
                                                            title="মুছে ফেলুন">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <img src="{{ asset('assets/images/not-found.svg') }}" 
                                                 alt="Not Found" 
                                                 class="img-fluid mb-3" 
                                                 style="max-width: 200px;">
                                            <div class="text-muted">কোন নিবন্ধ পাওয়া যায়নি</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table th {
        background-color: #f8f9fa;
    }
    
    .delete-form {
        display: inline;
    }
</style>
@endpush

@push('scripts')
<script>
    // Handle status and sort filters
    document.getElementById('status-filter').addEventListener('change', function() {
        updateFilters();
    });

    document.getElementById('sort-filter').addEventListener('change', function() {
        updateFilters();
    });

    function updateFilters() {
        const status = document.getElementById('status-filter').value;
        const sort = document.getElementById('sort-filter').value;
        const search = new URLSearchParams(window.location.search).get('search') || '';

        const url = new URL(window.location.href);
        url.searchParams.set('status', status);
        url.searchParams.set('sort', sort);
        if (search) url.searchParams.set('search', search);

        window.location.href = url.toString();
    }

    // Delete confirmation
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('আপনি কি নিশ্চিত যে আপনি এই নিবন্ধটি মুছে ফেলতে চান?')) {
                this.submit();
            }
        });
    });
</script>
@endpush
@endsection
