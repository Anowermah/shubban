@extends('admin.layouts.app')

@section('title', 'নিবন্ধ সম্পাদনা')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">নিবন্ধ সম্পাদনা</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('publications.articles.read', $article->id) }}" 
                           class="btn btn-success" 
                           target="_blank">
                            <i class="fas fa-eye me-1"></i>দেখুন
                        </a>
                        <a href="{{ route('admin.publications.articles.index') }}" 
                           class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>ফিরে যান
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.publications.articles.update', $article->id) }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4">
                            <div class="col-md-8">
                                <!-- Title -->
                                <div class="form-group mb-4">
                                    <label for="title" class="form-label required">শিরোনাম</label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $article->title) }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description (TinyMCE Editor) -->
                                <div class="form-group mb-4">
                                    <label for="description" class="form-label required">বিবরণ</label>
                                    <textarea class="tinymce-editor @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="15">{{ old('description', $article->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Current Cover Image -->
                                <div class="form-group mb-4">
                                    <label class="form-label d-block">বর্তমান কভার</label>
                                    @if($article->cover_image && Storage::disk('public')->exists($article->cover_image))
                                        <img src="{{ Storage::url($article->cover_image) }}" 
                                             alt="Current Cover" 
                                             class="img-fluid rounded mb-2">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   id="remove_cover" 
                                                   name="remove_cover">
                                            <label class="form-check-label" for="remove_cover">
                                                কভার ইমেজ মুছে ফেলুন
                                            </label>
                                        </div>
                                    @else
                                        <div class="text-muted">কোন কভার ইমেজ নেই</div>
                                    @endif
                                </div>

                                <!-- New Cover Image -->
                                <div class="form-group mb-4">
                                    <label for="cover_image" class="form-label">নতুন কভার ইমেজ</label>
                                    <div class="cover-preview mb-2 d-none">
                                        <img src="" alt="Cover Preview" class="img-fluid rounded">
                                    </div>
                                    <input type="file" 
                                           class="form-control @error('cover_image') is-invalid @enderror" 
                                           id="cover_image" 
                                           name="cover_image" 
                                           accept="image/*">
                                    <div class="form-text">সর্বোচ্চ সাইজ: 2MB | অনুমোদিত: JPG, PNG</div>
                                    @error('cover_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Current PDF File -->
                                <div class="form-group mb-4">
                                    <label class="form-label d-block">বর্তমান পিডিএফ</label>
                                    @if($article->pdf_file && Storage::disk('public')->exists($article->pdf_file))
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                            <div>
                                                <a href="{{ Storage::url($article->pdf_file) }}" 
                                                   target="_blank" 
                                                   class="text-decoration-none">
                                                    পিডিএফ দেখুন
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   id="remove_pdf" 
                                                   name="remove_pdf">
                                            <label class="form-check-label" for="remove_pdf">
                                                পিডিএফ মুছে ফেলুন
                                            </label>
                                        </div>
                                    @else
                                        <div class="text-muted">কোন পিডিএফ নেই</div>
                                    @endif
                                </div>

                                <!-- New PDF File -->
                                <div class="form-group mb-4">
                                    <label for="pdf_file" class="form-label">নতুন পিডিএফ</label>
                                    <input type="file" 
                                           class="form-control @error('pdf_file') is-invalid @enderror" 
                                           id="pdf_file" 
                                           name="pdf_file" 
                                           accept="application/pdf">
                                    <div class="form-text">সর্বোচ্চ সাইজ: 10MB | PDF ফরম্যাট</div>
                                    @error('pdf_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Author -->
                                <div class="form-group mb-4">
                                    <label for="author" class="form-label">লেখক</label>
                                    <input type="text" 
                                           class="form-control @error('author') is-invalid @enderror" 
                                           id="author" 
                                           name="author" 
                                           value="{{ old('author', $article->author) }}">
                                    @error('author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Publication Date -->
                                <div class="form-group mb-4">
                                    <label for="publication_date" class="form-label required">প্রকাশনার তারিখ</label>
                                    <input type="date" 
                                           class="form-control @error('publication_date') is-invalid @enderror" 
                                           id="publication_date" 
                                           name="publication_date" 
                                           value="{{ old('publication_date', $article->publication_date->format('Y-m-d')) }}" 
                                           required>
                                    @error('publication_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="form-group mb-4">
                                    <label for="status" class="form-label required">স্ট্যাটাস</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status" 
                                            required>
                                        <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>খসড়া</option>
                                        <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>প্রকাশিত</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-save me-1"></i>আপডেট করুন
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .required:after {
        content: ' *';
        color: red;
    }
    
    .cover-preview img {
        max-height: 200px;
        width: 100%;
        object-fit: cover;
    }

    /* TinyMCE Customization */
    .tox-tinymce {
        border-radius: 0.375rem;
    }

    /* Suppress TinyMCE Cloud API Key warning banner */
    .tox-notifications-container,
    .tox-notification--warning,
    .tox-notification--error,
    .tox-notification {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        overflow: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }

    .tox .tox-statusbar {
        border-top: 1px solid #dee2e6 !important;
    }
    
    .tox .tox-edit-area {
        border-top: 1px solid #dee2e6 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '.tinymce-editor',
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 16px; }',
        branding: false,
        promotion: false,
        images_upload_url: '{{ route("admin.publications.upload.image") }}',
    });

    // Cover Image Preview
    document.getElementById('cover_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.querySelector('.cover-preview');
                preview.classList.remove('d-none');
                preview.querySelector('img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Handle remove cover/pdf checkboxes
    document.getElementById('remove_cover')?.addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('cover_image').value = '';
            document.querySelector('.cover-preview').classList.add('d-none');
        }
    });

    document.getElementById('cover_image')?.addEventListener('change', function() {
        if (this.value) {
            document.getElementById('remove_cover').checked = false;
        }
    });

    document.getElementById('pdf_file')?.addEventListener('change', function() {
        if (this.value) {
            document.getElementById('remove_pdf').checked = false;
        }
    });
</script>
@endpush
@endsection
