@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>নতুন ম্যাগাজিন যোগ করুন</h2>
        <a href="{{ route('admin.publications.magazines.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>ফিরে যান
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.publications.magazines.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">শিরোনাম</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ইস্যু নম্বর</label>
                            <input type="text" class="form-control" name="issue_number" value="{{ old('issue_number') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ম্যাগাজিনের বিবরণ ও সূচিপত্র</label>
                            <textarea class="form-control tinymce-editor" name="description" rows="5">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">প্রকাশনার তারিখ</label>
                                    <input type="date" class="form-control" name="publication_date" 
                                           value="{{ old('publication_date') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">মূল্য</label>
                                    <input type="number" class="form-control" name="price" step="0.01" min="0"
                                           value="{{ old('price') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">কভার ইমেজ</h5>
                                <input type="file" class="form-control" name="cover_image" accept="image/*">
                                <small class="text-muted">সর্বোচ্চ 2MB সাইজের JPG, PNG বা JPEG ইমেজ আপলোড করুন</small>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">পিডিএফ ফাইল</h5>
                                <input type="file" class="form-control" name="pdf_file" accept=".pdf">
                                <small class="text-muted">সর্বোচ্চ 10MB সাইজের PDF ফাইল আপলোড করুন</small>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">স্ট্যাটাস</h5>
                                <select class="form-control" name="status" required>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>খসড়া</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>প্রকাশিত</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>সংরক্ষণ করুন
                    </button>
                    <a href="{{ route('admin.publications.magazines.index') }}" class="btn btn-secondary ms-2">
                        বাতিল
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
