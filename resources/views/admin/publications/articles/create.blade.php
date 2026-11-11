@extends('admin.layouts.app')

@section('title', 'নতুন নিবন্ধ যোগ করুন')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">নতুন নিবন্ধ যোগ করুন</h5>
                    <a href="{{ route('admin.publications.articles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>ফিরে যান
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.publications.articles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-4">
                            <div class="col-md-8">
                                <!-- Title -->
                                <div class="form-group mb-4">
                                    <label for="title" class="form-label required">শিরোনাম</label>
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

                                <!-- Description (TinyMCE Editor) -->
                                <div class="form-group mb-4">
                                    <label for="description" class="form-label required">বিবরণ</label>
                                    <textarea class="tinymce-editor @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="15">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Cover Image Preview -->
                                <div class="form-group mb-4">
                                    <label for="cover_image" class="form-label">কভার ইমেজ</label>
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

                                <!-- PDF File -->
                                <div class="form-group mb-4">
                                    <label for="pdf_file" class="form-label">পিডিএফ ফাইল</label>
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
                                           value="{{ old('author') }}">
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
                                           value="{{ old('publication_date', date('Y-m-d')) }}" 
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
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>খসড়া</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>প্রকাশিত</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-save me-1"></i>সংরক্ষণ করুন
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

    /* Custom content styles */
    .content-style {
        font-family: 'Kalpurush', 'SolaimanLipi', Arial, sans-serif !important;
    }

    .content-style h1 { font-size: 2.5rem; margin-bottom: 1rem; }
    .content-style h2 { font-size: 2rem; margin-bottom: 0.9rem; }
    .content-style h3 { font-size: 1.75rem; margin-bottom: 0.8rem; }
    .content-style h4 { font-size: 1.5rem; margin-bottom: 0.7rem; }
    .content-style h5 { font-size: 1.25rem; margin-bottom: 0.6rem; }
    .content-style h6 { font-size: 1rem; margin-bottom: 0.5rem; }

    .content-style p { margin-bottom: 1rem; line-height: 1.7; }
    .content-style ul, .content-style ol { margin-bottom: 1rem; padding-left: 2rem; }
    .content-style li { margin-bottom: 0.5rem; }
    
    .content-style blockquote {
        border-left: 4px solid #dee2e6;
        padding: 1rem;
        margin: 1rem 0;
        background: #f8f9fa;
    }

    .content-style pre {
        background: #2d2d2d;
        color: #fff;
        padding: 1rem;
        border-radius: 0.375rem;
        overflow-x: auto;
    }

    .content-style table {
        width: 100%;
        margin-bottom: 1rem;
        border-collapse: collapse;
    }

    .content-style th,
    .content-style td {
        padding: 0.75rem;
        border: 1px solid #dee2e6;
    }

    .content-style th {
        background: #f8f9fa;
    }

    .content-style img {
        max-width: 100%;
        height: auto;
        border-radius: 0.375rem;
        margin: 1rem 0;
    }

    .content-style figure {
        margin: 1rem 0;
    }

    .content-style figcaption {
        text-align: center;
        font-style: italic;
        margin-top: 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize TinyMCE for Articles with advanced features
    tinymce.init({
        selector: '.tinymce-editor',
        height: 500,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount',
            'emoticons', 'codesample', 'quickbars', 'autosave'
        ],
        toolbar1: 'undo redo | styles | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify',
        toolbar2: 'bullist numlist outdent indent | link image media codesample table emoticons | forecolor backcolor | code fullscreen',
        menubar: 'file edit view insert format tools table help',
        toolbar_mode: 'sliding',
        contextmenu: 'link image table',
        
        // Content appearance
        content_css: [
            'https://fonts.googleapis.com/css2?family=Kalpurush&display=swap',
            'https://fonts.maateen.me/solaiman-lipi/font.css'
        ],
        content_style: '.content-style { font-family: Kalpurush, SolaimanLipi, Arial, sans-serif; font-size: 16px; line-height: 1.7; }',
        body_class: 'content-style',
        
        // Image upload handling
        images_upload_url: '{{ route("admin.publications.upload.image") }}',
        images_upload_credentials: true,
        images_reuse_filename: true,
        image_advtab: true,
        image_caption: true,
        
        // Table settings
        table_appearance_options: true,
        table_grid: true,
        table_class_list: [
            {title: 'Default', value: 'table'},
            {title: 'Bordered', value: 'table table-bordered'},
            {title: 'Striped', value: 'table table-striped'}
        ],
        
        // Link settings
        link_context_toolbar: true,
        link_assume_external_targets: true,
        
        // Code settings
        codesample_languages: [
            {text: 'HTML/XML', value: 'markup'},
            {text: 'JavaScript', value: 'javascript'},
            {text: 'CSS', value: 'css'},
            {text: 'PHP', value: 'php'},
            {text: 'Python', value: 'python'},
            {text: 'Java', value: 'java'},
            {text: 'C', value: 'c'},
            {text: 'C++', value: 'cpp'}
        ],
        
        // Spellchecker settings
        browser_spellcheck: true,
        gecko_spellcheck: true,
        
        // Paste settings
        paste_data_images: true,
        paste_as_text: false,
        paste_word_valid_elements: 'p,b,strong,i,em,h1,h2,h3,h4,h5,h6,table,tr,td,th,div,ol,ul,li,a[href],img[src]',
        
        // Typography
        style_formats: [
            { title: 'Headings', items: [
                { title: 'Heading 1', format: 'h1' },
                { title: 'Heading 2', format: 'h2' },
                { title: 'Heading 3', format: 'h3' },
                { title: 'Heading 4', format: 'h4' },
                { title: 'Heading 5', format: 'h5' },
                { title: 'Heading 6', format: 'h6' }
            ]},
            { title: 'Inline', items: [
                { title: 'Bold', format: 'bold' },
                { title: 'Italic', format: 'italic' },
                { title: 'Underline', format: 'underline' },
                { title: 'Strikethrough', format: 'strikethrough' },
                { title: 'Code', format: 'code' }
            ]},
            { title: 'Blocks', items: [
                { title: 'Paragraph', format: 'p' },
                { title: 'Blockquote', format: 'blockquote' },
                { title: 'Div', format: 'div' },
                { title: 'Pre', format: 'pre' }
            ]}
        ],
        
        // Auto save
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: 'tinymce-autosave-{path}-{id}-',
        autosave_restore_when_empty: true,
        
        // Other settings
        branding: false,
        promotion: false,
        elementpath: false,
        statusbar: true,
        resize: true,
        indent_use_margin: true,
        nonbreaking_force_tab: true,
        
        // Setup callback
        setup: function (editor) {
            editor.on('init', function () {
                this.getDoc().body.style.fontSize = '16px';
            });
        }
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
</script>
@endpush
@endsection
