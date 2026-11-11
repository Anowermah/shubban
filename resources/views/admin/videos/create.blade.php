@extends('admin.layouts.app')

@section('title', 'নতুন ভিডিও')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">নতুন ভিডিও যোগ করুন</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.videos.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">শিরোনাম <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">বিবরণ</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="video_url" class="form-label">ইউটিউব লিংক <span class="text-danger">*</span></label>
                            <input type="url" 
                                   class="form-control @error('video_url') is-invalid @enderror" 
                                   id="video_url" 
                                   name="video_url" 
                                   value="{{ old('video_url') }}" 
                                   placeholder="https://www.youtube.com/watch?v=..."
                                   required>
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                ইউটিউব ভিডিও লিংক দিন। থাম্বনেইল স্বয়ংক্রিয়ভাবে যোগ হবে।
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">ক্যাটাগরি</label>
                            <input type="text" 
                                   class="form-control @error('category') is-invalid @enderror" 
                                   id="category" 
                                   name="category" 
                                   value="{{ old('category') }}">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">তারিখ <span class="text-danger">*</span></label>
                            <input type="date" 
                                   class="form-control @error('date') is-invalid @enderror" 
                                   id="date" 
                                   name="date" 
                                   value="{{ old('date', date('Y-m-d')) }}" 
                                   required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input @error('status') is-invalid @enderror" 
                                       id="status" 
                                       name="status" 
                                       value="1" 
                                       {{ old('status', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">প্রকাশ করুন</label>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.videos.index') }}" class="btn btn-light">
                                বাতিল করুন
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> সংরক্ষণ করুন
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
