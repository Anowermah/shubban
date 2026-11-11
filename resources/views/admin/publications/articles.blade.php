@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">প্রবন্ধ সমূহ</h2>

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addArticleModal">
                <i class="fas fa-plus"></i> নতুন প্রবন্ধ যোগ করুন
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>শিরোনাম</th>
                            <th>লেখক</th>
                            <th>ক্যাটাগরি</th>
                            <th>প্রকাশনার তারিখ</th>
                            <th>স্ট্যাটাস</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->author }}</td>
                            <td>{{ $article->category }}</td>
                            <td>{{ $article->publication_date->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge {{ $article->status == 'published' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $article->status == 'published' ? 'প্রকাশিত' : 'খসড়া' }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Article Modal -->
<div class="modal fade" id="addArticleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">নতুন প্রবন্ধ যোগ করুন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.publications.articles.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">শিরোনাম</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">লেখক</label>
                        <input type="text" class="form-control" name="author" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">বিষয়বস্তু</label>
                        <textarea class="form-control" name="content" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">প্রকাশনার তারিখ</label>
                        <input type="date" class="form-control" name="publication_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ক্যাটাগরি</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">স্ট্যাটাস</label>
                        <select class="form-control" name="status" required>
                            <option value="draft">খসড়া</option>
                            <option value="published">প্রকাশিত</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-primary">সংরক্ষণ করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
