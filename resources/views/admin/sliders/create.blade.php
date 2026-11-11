@extends('admin.layouts.app')

@section('title', 'নতুন স্লাইড যোগ করুন')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">নতুন স্লাইড যোগ করুন</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> তালিকায় ফিরে যান
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">শিরোনাম</label>
                                    <input type="text" name="title" id="title" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           value="{{ old('title') }}">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">সাব-শিরোনাম</label>
                                    <input type="text" name="subtitle" id="subtitle" 
                                           class="form-control @error('subtitle') is-invalid @enderror" 
                                           value="{{ old('subtitle') }}">
                                    @error('subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">ছবি <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image" 
                                           class="form-control @error('image') is-invalid @enderror"
                                           accept="image/*"
                                           onchange="previewImage(this);">
                                    <small class="text-muted">সর্বোচ্চ সাইজ: 2MB | অনুমোদিত ফরম্যাট: JPG, JPEG, PNG, GIF</small>
                                    <div class="mt-2">
                                        <img id="imagePreview" src="#" alt="ছবি প্রিভিউ" 
                                             style="max-width: 200px; display: none;" 
                                             class="img-thumbnail">
                                    </div>
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="button_text" class="form-label">বাটন টেক্সট</label>
                                    <input type="text" name="button_text" id="button_text" 
                                           class="form-control @error('button_text') is-invalid @enderror" 
                                           value="{{ old('button_text') }}">
                                    @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="button_link" class="form-label">বাটন লিংক</label>
                                    <input type="text" name="button_link" id="button_link" 
                                           class="form-control @error('button_link') is-invalid @enderror" 
                                           value="{{ old('button_link') }}">
                                    @error('button_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="order" class="form-label">ক্রম</label>
                                            <input type="number" name="order" id="order" 
                                                   class="form-control @error('order') is-invalid @enderror" 
                                                   value="{{ old('order', 0) }}">
                                            <small class="text-muted">স্লাইডের প্রদর্শন ক্রম</small>
                                            @error('order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input type="checkbox" name="status" 
                                                       class="form-check-input" id="status" 
                                                       value="1" {{ old('status') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status">সক্রিয়</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> সংরক্ষণ করুন
                            </button>
                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
                                বাতিল করুন
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        @endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>
@endpush
