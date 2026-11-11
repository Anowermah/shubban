@extends('admin.layouts.app')

@section('title', 'ছবি সম্পাদনা')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ছবি সম্পাদনা</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.photos.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> ছবির তালিকা
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.photos.update', $photo) }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="image" class="form-label">ছবি</label>
                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   accept="image/*">
                            
                            @if($photo->image_url)
                                <div class="mt-3">
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ asset($photo->image_url) }}" 
                                             alt="{{ $photo->title }}" 
                                             class="img-thumbnail" 
                                             style="max-width: 300px;">
                                        <div class="image-overlay">
                                            <i class="fas fa-image"></i>
                                            <span>বর্তমান ছবি</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <label for="title" class="form-label">শিরোনাম <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $photo->title) }}" 
                                   required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="description" class="form-label">বিবরণ</label>
                            <textarea name="description" 
                                      id="description" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="3">{{ old('description', $photo->description) }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="category" class="form-label">ক্যাটাগরি</label>
                            <input type="text" 
                                   name="category" 
                                   id="category" 
                                   class="form-control @error('category') is-invalid @enderror" 
                                   value="{{ old('category', $photo->category) }}">
                        </div>

                        <div class="form-group mb-4">
                            <label for="date" class="form-label">তারিখ <span class="text-danger">*</span></label>
                            <input type="date" 
                                   name="date" 
                                   id="date" 
                                   class="form-control @error('date') is-invalid @enderror" 
                                   value="{{ old('date', $photo->date->format('Y-m-d')) }}" 
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> আপডেট করুন
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image-overlay i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .position-relative:hover .image-overlay {
        opacity: 1;
    }
</style>
@endpush

@endsection
