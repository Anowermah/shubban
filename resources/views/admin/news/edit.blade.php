@extends('admin.layouts.app')

@section('title', 'সংবাদ সম্পাদনা করুন')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">সংবাদ সম্পাদনা করুন</h1>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">শিরোনাম</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $news->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">বিস্তারিত বিবরণ <span class="text-danger">*</span></label>
                            <textarea class="form-control tinymce-editor @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="8">{{ old('description', $news->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">ছবি</label>
                            @if($news->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $news->image) }}" 
                                         alt="{{ $news->title }}" class="img-thumbnail" width="200">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">নতুন ছবি আপলোড না করলে আগের ছবি থেকে যাবে</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="status" name="status" 
                                       value="1" {{ $news->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">প্রকাশিত</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">আপডেট করুন</button>
                        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">বাতিল করুন</a>
                    </form>
                </div>
            </div>
        @endsection
