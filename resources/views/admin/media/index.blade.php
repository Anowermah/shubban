@extends('admin.layouts.app')

@section('title', 'মিডিয়া ও ফাইল ম্যানেজার')

@section('content')
<div class="container-fluid px-0">
    <!-- 1. Header & Storage Metrics Banner -->
    <div class="page-header-box d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill">
                    <i class="fas fa-photo-video me-1"></i> কেন্দ্রীয় মিডিয়া রিপোজিটরি
                </span>
                <span class="text-muted small">সাইটের সমস্ত ছবি ও ডকুমেন্টের কেন্দ্রীভূত নিয়ন্ত্রণ</span>
            </div>
            <h1 class="h3 fw-bold mb-0 text-dark">মিডিয়া ও ফাইল ম্যানেজার</h1>
        </div>

        <div class="d-flex flex-wrap gap-2 align-items-center">
            <!-- Upload Modal Trigger Button -->
            <button type="button" class="btn btn-primary rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
                <i class="fas fa-cloud-upload-alt fs-6"></i> নতুন ফাইল আপলোড
            </button>
            <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2">
                <i class="fas fa-sync-alt me-1"></i> রিফ্রেশ
            </a>
        </div>
    </div>

    <!-- Storage Statistics Overview -->
    <div class="row g-3 mb-4">
        <!-- 1. Total Files -->
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">মোট মিডিয়া ফাইল</div>
                        <div class="stat-number text-primary">{{ $stats['total_files'] }} <span class="fs-6 fw-normal text-muted">টি</span></div>
                    </div>
                    <div class="stat-icon-wrap primary">
                        <i class="fas fa-folder-open"></i>
                    </div>
                </div>
                <div class="stat-meta text-muted">
                    পাবলিক স্টোরেজে রক্ষিত সর্বমোট ফাইল
                </div>
            </div>
        </div>

        <!-- 2. Total Storage Space -->
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">ব্যবহৃত মেমোরি স্পেস</div>
                        <div class="stat-number text-success">{{ $stats['total_size'] }}</div>
                    </div>
                    <div class="stat-icon-wrap success">
                        <i class="fas fa-hdd"></i>
                    </div>
                </div>
                <div class="stat-meta text-muted">
                    ছবি ও ডকুমেন্টের মোট সাইজ
                </div>
            </div>
        </div>

        <!-- 3. Images -->
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">ইমেজ ও ফটো</div>
                        <div class="stat-number text-info">{{ $stats['image_count'] }} <span class="fs-6 fw-normal text-muted">টি</span></div>
                    </div>
                    <div class="stat-icon-wrap info">
                        <i class="fas fa-images"></i>
                    </div>
                </div>
                <div class="stat-meta text-muted">
                    JPG, PNG, WEBP ও ব্যানারসমূহ
                </div>
            </div>
        </div>

        <!-- 4. PDFs & Docs -->
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">PDF ও ডকুমেন্টস</div>
                        <div class="stat-number text-purple">{{ $stats['pdf_count'] + $stats['other_count'] }} <span class="fs-6 fw-normal text-muted">টি</span></div>
                    </div>
                    <div class="stat-icon-wrap purple">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                </div>
                <div class="stat-meta text-muted">
                    বইয়ের PDF, নোটিশ ও রসিদ
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="fas fa-check-circle fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="fas fa-exclamation-triangle fs-5"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- 2. Folder Navigation Pills -->
    <div class="card shadow-sm mb-4">
        <div class="card-body p-3">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fw-bold small text-muted text-uppercase">
                    <i class="fas fa-folder text-warning me-1"></i> ফোল্ডার নির্বাচন করুন:
                </span>
                <span class="small text-muted">বর্তমান ফোল্ডার: <strong>{{ $folderFilter === 'all' ? 'সকল ফোল্ডার' : ($availableFolders[$folderFilter]['label'] ?? $folderFilter) }}</strong></span>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.media.index', array_merge(request()->except('folder', 'page'), ['folder' => 'all'])) }}" 
                   class="btn btn-sm rounded-pill {{ $folderFilter === 'all' ? 'btn-primary' : 'btn-outline-secondary' }}">
                    <i class="fas fa-th-large me-1"></i> সব ফাইল 
                    <span class="badge bg-white text-dark ms-1">{{ $stats['total_files'] }}</span>
                </a>

                @foreach($availableFolders as $folderKey => $folderData)
                    @php $count = $folderCounts[$folderKey] ?? 0; @endphp
                    @if($count > 0 || in_array($folderKey, ['sliders', 'books', 'magazines', 'articles', 'photos', 'uploads']))
                        <a href="{{ route('admin.media.index', array_merge(request()->except('folder', 'page'), ['folder' => $folderKey])) }}" 
                           class="btn btn-sm rounded-pill {{ $folderFilter === $folderKey ? 'btn-primary' : 'btn-outline-secondary' }}">
                            <i class="{{ $folderData['icon'] }} me-1"></i> {{ $folderData['label'] }}
                            @if($count > 0)
                                <span class="badge bg-secondary ms-1">{{ $count }}</span>
                            @endif
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- 3. Search and Type Filter Bar -->
    <div class="card shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('admin.media.index') }}" class="row g-2 align-items-center">
                <!-- Keep folder parameter -->
                <input type="hidden" name="folder" value="{{ $folderFilter }}">

                <!-- Search Input -->
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="ফাইলের নাম লিখে খুঁজুন..." value="{{ $search }}">
                        @if($search)
                            <a href="{{ route('admin.media.index', request()->except('search', 'page')) }}" class="btn btn-outline-secondary" title="রিসেট">✕</a>
                        @endif
                    </div>
                </div>

                <!-- Type Filter -->
                <div class="col-md-4">
                    <div class="d-flex align-items-center gap-1">
                        <span class="small text-muted me-1 d-none d-lg-inline">টাইপ:</span>
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('admin.media.index', array_merge(request()->except('type', 'page'), ['type' => 'all'])) }}" class="btn btn-sm {{ $typeFilter === 'all' ? 'btn-primary' : 'btn-outline-secondary' }}">সব</a>
                            <a href="{{ route('admin.media.index', array_merge(request()->except('type', 'page'), ['type' => 'image'])) }}" class="btn btn-sm {{ $typeFilter === 'image' ? 'btn-primary' : 'btn-outline-secondary' }}">ছবি</a>
                            <a href="{{ route('admin.media.index', array_merge(request()->except('type', 'page'), ['type' => 'pdf'])) }}" class="btn btn-sm {{ $typeFilter === 'pdf' ? 'btn-primary' : 'btn-outline-secondary' }}">PDF</a>
                            <a href="{{ route('admin.media.index', array_merge(request()->except('type', 'page'), ['type' => 'other'])) }}" class="btn btn-sm {{ $typeFilter === 'other' ? 'btn-primary' : 'btn-outline-secondary' }}">অন্যান্য</a>
                        </div>
                    </div>
                </div>

                <!-- Submit & Clear -->
                <div class="col-md-3 text-md-end">
                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">
                        <i class="fas fa-filter me-1"></i> ফিল্টার প্রয়োগ
                    </button>
                    @if(request()->hasAny(['search', 'type', 'folder']) && ($search || $typeFilter !== 'all' || $folderFilter !== 'all'))
                        <a href="{{ route('admin.media.index') }}" class="btn btn-sm btn-outline-danger rounded-pill px-2">রিসেট</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- 4. Interactive Media Grid -->
    <div class="row g-3 g-lg-4 mb-4">
        @forelse($paginatedFiles as $file)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="media-file-card h-100 d-flex flex-column justify-content-between p-2 rounded-3 border bg-white shadow-sm position-relative">
                    <!-- File Preview / Thumbnail -->
                    <div class="media-thumb-wrap rounded-2 overflow-hidden position-relative mb-2 d-flex align-items-center justify-content-center bg-light" style="aspect-ratio: 1 / 1;">
                        @if($file['is_image'])
                            <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" class="w-100 h-100 object-fit-cover" loading="lazy">
                        @elseif($file['is_pdf'])
                            <div class="text-center p-3 text-danger">
                                <i class="fas fa-file-pdf fa-3x mb-1"></i>
                                <span class="d-block badge bg-danger-subtle text-danger small">PDF নথি</span>
                            </div>
                        @else
                            <div class="text-center p-3 text-secondary">
                                <i class="fas fa-file-alt fa-3x mb-1"></i>
                                <span class="d-block badge bg-secondary-subtle text-secondary small text-uppercase">{{ $file['extension'] }}</span>
                            </div>
                        @endif

                        <!-- Hover Overlay Actions -->
                        <div class="media-overlay-actions position-absolute inset-0 d-flex align-items-center justify-content-center gap-2">
                            <button type="button" class="btn btn-sm btn-light rounded-circle shadow-sm" 
                                    onclick="previewMedia('{{ $file['url'] }}', '{{ addslashes($file['name']) }}', '{{ $file['size_formatted'] }}', '{{ $file['folder'] }}', {{ $file['is_image'] ? 'true' : 'false' }}, {{ $file['is_pdf'] ? 'true' : 'false' }})" 
                                    title="প্রিভিউ দেখুন">
                                <i class="fas fa-eye text-primary"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-light rounded-circle shadow-sm" 
                                    onclick="copyToClipboard('{{ $file['url'] }}')" 
                                    title="লিংক কপি করুন">
                                <i class="fas fa-copy text-success"></i>
                            </button>
                            <a href="{{ $file['url'] }}" download="{{ $file['name'] }}" class="btn btn-sm btn-light rounded-circle shadow-sm" title="ডাউনলোড">
                                <i class="fas fa-download text-dark"></i>
                            </a>
                        </div>
                    </div>

                    <!-- File Details -->
                    <div class="media-info-wrap mt-auto">
                        <div class="fw-semibold text-dark text-truncate small mb-1" title="{{ $file['name'] }}">
                            {{ $file['name'] }}
                        </div>
                        <div class="d-flex align-items-center justify-content-between text-muted" style="font-size: 0.72rem;">
                            <span class="badge bg-light text-muted border">{{ $file['folder'] }}</span>
                            <span class="font-monospace">{{ $file['size_formatted'] }}</span>
                        </div>
                    </div>

                    <!-- Bottom Quick Actions Strip -->
                    <div class="pt-2 mt-2 border-top d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-xs btn-outline-success py-0 px-2" style="font-size: 0.72rem;" onclick="copyToClipboard('{{ $file['url'] }}')">
                            <i class="fas fa-link me-1"></i> কপি URL
                        </button>

                        <!-- Delete Form -->
                        <form method="POST" action="{{ route('admin.media.destroy') }}" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই ফাইলটি মুছে ফেলতে চান? এটি মুছে ফেললে ওয়েবসাইটে যেখানে এই ফাইল ব্যবহার করা হয়েছে তা লোড নাও হতে পারে!')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="path" value="{{ $file['path'] }}">
                            <button type="submit" class="btn btn-xs btn-outline-danger py-0 px-1 border-0" style="font-size: 0.75rem;" title="ফাইল মুছুন">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card shadow-sm text-center py-5">
                    <div class="text-muted mb-3">
                        <i class="fas fa-photo-video fa-4x opacity-50"></i>
                    </div>
                    <h5 class="fw-bold text-dark">কোনো ফাইল পাওয়া যায়নি</h5>
                    <p class="text-muted small mb-3">বর্তমান ফিল্টার বা সার্চে কোনো মিডিয়া ফাইল খুঁজে পাওয়া যায়নি।</p>
                    <div>
                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
                            <i class="fas fa-cloud-upload-alt me-1"></i> নতুন ফাইল আপলোড করুন
                        </button>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- 5. Pagination Links -->
    @if($paginatedFiles->hasPages())
        <div class="d-flex justify-content-center mb-4">
            {{ $paginatedFiles->links() }}
        </div>
    @endif
</div>

<!-- ========================================================================
     PREVIEW MODAL (প্রিভিউ ও বিস্তারিত তথ্য)
     ======================================================================== -->
<div class="modal fade" id="mediaPreviewModal" tabindex="-1" aria-labelledby="mediaPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="mediaPreviewModalLabel">মিডিয়া প্রিভিউ ও বিবরণ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <!-- Preview Canvas -->
                <div id="modalPreviewContainer" class="mb-4 rounded-3 overflow-hidden bg-light border d-flex align-items-center justify-content-center p-2" style="min-height: 280px; max-height: 420px;">
                    <!-- Injected dynamically via JS -->
                </div>

                <!-- Copyable URL Input -->
                <div class="mb-3 text-start">
                    <label class="form-label small fw-bold text-muted">পাবলিক সরাসরি লিংক (Direct URL):</label>
                    <div class="input-group">
                        <input type="text" id="modalFileUrlInput" class="form-control font-monospace bg-light" readonly>
                        <button class="btn btn-success" type="button" onclick="copyModalUrl()">
                            <i class="fas fa-copy me-1"></i> কপি করুন
                        </button>
                    </div>
                    <small class="text-muted" style="font-size: 0.75rem;">এই লিংকটি আপনি যেকোনো পেজ, নোটিশ বা আর্টিকেলের ভেতর ব্যবহার করতে পারবেন।</small>
                </div>

                <!-- Metadata List -->
                <div class="row g-2 text-start text-muted small p-3 rounded bg-light border">
                    <div class="col-sm-6">
                        <strong>ফাইলের নাম:</strong> <span id="modalFileNameText">-</span>
                    </div>
                    <div class="col-sm-6">
                        <strong>সাইজ:</strong> <span id="modalFileSizeText">-</span>
                    </div>
                    <div class="col-sm-6">
                        <strong>ফোল্ডার:</strong> <span id="modalFileFolderText" class="badge bg-secondary">-</span>
                    </div>
                    <div class="col-sm-6">
                        <a id="modalDownloadBtn" href="#" download class="btn btn-sm btn-outline-dark py-0 px-2">
                            <i class="fas fa-download me-1"></i> ডিভাইস-এ ডাউনলোড করুন
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================
     UPLOAD MODAL (নতুন ফাইল আপলোড)
     ======================================================================== -->
<div class="modal fade" id="uploadMediaModal" tabindex="-1" aria-labelledby="uploadMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.media.upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="uploadMediaModalLabel">
                        <i class="fas fa-cloud-upload-alt me-2"></i> নতুন ফাইল আপলোড করুন
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Folder Selection -->
                    <div class="mb-3">
                        <label for="targetFolder" class="form-label fw-bold">টার্গেট ফোল্ডার নির্বাচন করুন: <span class="text-danger">*</span></label>
                        <select name="folder" id="targetFolder" class="form-select" required>
                            <option value="uploads" {{ $folderFilter === 'uploads' ? 'selected' : '' }}>uploads (সাধারণ আপলোড)</option>
                            <option value="sliders" {{ $folderFilter === 'sliders' ? 'selected' : '' }}>sliders (হোম স্লাইডার ব্যানার)</option>
                            <option value="photos" {{ $folderFilter === 'photos' ? 'selected' : '' }}>photos (ফটো গ্যালারি)</option>
                            <option value="books" {{ $folderFilter === 'books' ? 'selected' : '' }}>books (বই ও প্রকাশনা)</option>
                            <option value="magazines" {{ $folderFilter === 'magazines' ? 'selected' : '' }}>magazines (মাসিক ম্যাগাজিন)</option>
                            <option value="articles" {{ $folderFilter === 'articles' ? 'selected' : '' }}>articles (প্রবন্ধের ফিচার ইমেজ)</option>
                            <option value="news" {{ $folderFilter === 'news' ? 'selected' : '' }}>news (সংবাদের ছবি)</option>
                            <option value="notices" {{ $folderFilter === 'notices' ? 'selected' : '' }}>notices (নোটিশ ও সার্কুলার)</option>
                            <option value="activities" {{ $folderFilter === 'activities' ? 'selected' : '' }}>activities (সাংগঠনিক কার্যক্রম)</option>
                        </select>
                        <small class="text-muted" style="font-size: 0.78rem;">ফাইলগুলো আপনার নির্বাচিত ফোল্ডারে সংরক্ষিত হবে।</small>
                    </div>

                    <!-- File Chooser -->
                    <div class="mb-3">
                        <label for="mediaFilesInput" class="form-label fw-bold">ফাইল বাছাই করুন (একাধিক একসাথে সম্ভব): <span class="text-danger">*</span></label>
                        <input type="file" name="files[]" id="mediaFilesInput" class="form-control" multiple required accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.zip">
                        <small class="text-muted d-block mt-1" style="font-size: 0.76rem;">
                            সমর্থিত ফরম্যাট: JPG, PNG, WEBP, GIF, PDF, DOC, ZIP (প্রতিটি ফাইল সর্বোচ্চ ৫০ MB)
                        </small>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill px-3" data-bs-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">
                        <i class="fas fa-upload me-1"></i> আপলোড শুরু করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quick Toast for Clipboard Copy Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
    <div id="clipboardToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i> ফাইলের লিংক সফলভাবে কপি হয়েছে!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@push('styles')
<style>
.media-file-card {
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
.media-file-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 20px rgba(12, 75, 54, 0.12) !important;
    border-color: rgba(12, 75, 54, 0.3) !important;
}
.media-thumb-wrap .media-overlay-actions {
    background: rgba(7, 35, 25, 0.65);
    backdrop-filter: blur(2px);
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.25s ease;
}
.media-file-card:hover .media-thumb-wrap .media-overlay-actions {
    opacity: 1;
    pointer-events: auto;
}
.btn-xs {
    padding: 0.18rem 0.45rem;
    font-size: 0.75rem;
    border-radius: 4px;
}
</style>
@endpush

@push('scripts')
<script>
function copyToClipboard(text) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(() => {
            showToast();
        }).catch(err => {
            prompt("লিংক কপি করতে নিচের বক্স থেকে টেক্সট কপি করুন:", text);
        });
    } else {
        prompt("লিংক কপি করতে নিচের বক্স থেকে টেক্সট কপি করুন:", text);
    }
}

function showToast() {
    const toastEl = document.getElementById('clipboardToast');
    if (toastEl && window.bootstrap) {
        const toast = new bootstrap.Toast(toastEl, { delay: 2500 });
        toast.show();
    } else {
        alert("লিংক সফলভাবে কপি হয়েছে!");
    }
}

function previewMedia(url, name, size, folder, isImage, isPdf) {
    const container = document.getElementById('modalPreviewContainer');
    const urlInput = document.getElementById('modalFileUrlInput');
    const nameText = document.getElementById('modalFileNameText');
    const sizeText = document.getElementById('modalFileSizeText');
    const folderText = document.getElementById('modalFileFolderText');
    const downloadBtn = document.getElementById('modalDownloadBtn');

    urlInput.value = url;
    nameText.textContent = name;
    sizeText.textContent = size;
    folderText.textContent = folder;
    downloadBtn.href = url;
    downloadBtn.setAttribute('download', name);

    if (isImage) {
        container.innerHTML = `<img src="${url}" alt="${name}" class="img-fluid rounded" style="max-height: 400px; object-fit: contain;">`;
    } else if (isPdf) {
        container.innerHTML = `
            <div class="text-center p-4">
                <i class="fas fa-file-pdf fa-4x text-danger mb-3"></i>
                <h6 class="fw-bold text-dark">${name}</h6>
                <a href="${url}" target="_blank" class="btn btn-sm btn-outline-danger mt-2">
                    <i class="fas fa-external-link-alt me-1"></i> নতুন ট্যাবে PDF ফাইলটি দেখুন
                </a>
            </div>
        `;
    } else {
        container.innerHTML = `
            <div class="text-center p-4">
                <i class="fas fa-file-alt fa-4x text-secondary mb-3"></i>
                <h6 class="fw-bold text-dark">${name}</h6>
                <a href="${url}" target="_blank" class="btn btn-sm btn-outline-secondary mt-2">
                    <i class="fas fa-download me-1"></i> ফাইলটি ডাউনলোড করুন
                </a>
            </div>
        `;
    }

    const modal = new bootstrap.Modal(document.getElementById('mediaPreviewModal'));
    modal.show();
}

function copyModalUrl() {
    const urlInput = document.getElementById('modalFileUrlInput');
    urlInput.select();
    urlInput.setSelectionRange(0, 99999);
    copyToClipboard(urlInput.value);
}
</script>
@endpush
@endsection
