@extends('admin.layouts.app')

@section('title', 'ছবি সম্পাদনা করুন')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">ছবি সম্পাদনা করুন</h1>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.gallery.update', $image->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">শিরোনাম</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $image->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">বিবরণ</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $image->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">নতুন ছবি (ঐচ্ছিক)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">বর্তমান ছবি</label>
                            <div>
                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}" 
                                     class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" 
                                       name="is_featured" value="1" {{ $image->is_featured ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">ফিচার্ড ছবি</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">আপডেট করুন</button>
                        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">বাতিল করুন</a>
                    </form>
                </div>
            </div>
        @endsection
