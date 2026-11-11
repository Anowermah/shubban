@extends('admin.layouts.app')

@section('title', 'নতুন ছবি')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">নতুন ছবি</h3>
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

                    <form action="{{ route('admin.photos.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="image" class="form-label">ছবি <span class="text-danger">*</span></label>
                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   accept="image/*"
                                   required>
                            <div id="imagePreview" class="mt-3 d-none">
                                <div class="position-relative d-inline-block">
                                    <img src="#" 
                                         alt="Preview" 
                                         class="img-thumbnail" 
                                         style="max-width: 300px;">
                                    <div class="image-overlay">
                                        <i class="fas fa-image"></i>
                                        <span>প্রিভিউ</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="title" class="form-label">শিরোনাম <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title') }}" 
                                   required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="description" class="form-label">বিবরণ</label>
                            <textarea name="description" 
                                      id="description" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="category" class="form-label">ক্যাটাগরি</label>
                            <input type="text" 
                                   name="category" 
                                   id="category" 
                                   class="form-control @error('category') is-invalid @enderror" 
                                   value="{{ old('category') }}">
                        </div>

                        <div class="form-group mb-4">
                            <label for="date" class="form-label">তারিখ <span class="text-danger">*</span></label>
                            <input type="date" 
                                   name="date" 
                                   id="date" 
                                   class="form-control @error('date') is-invalid @enderror" 
                                   value="{{ old('date', date('Y-m-d')) }}" 
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> সংরক্ষণ করুন
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

@push('scripts')
<script>
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    const img = preview.querySelector('img');
    
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('d-none');
        }
        
        reader.readAsDataURL(this.files[0]);
    } else {
        preview.classList.add('d-none');
    }
});
</script>
@endpush

@endsection
