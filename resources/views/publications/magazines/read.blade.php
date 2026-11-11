@extends('layouts.app')

@section('title', $magazine->title)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ $magazine->title }}</h2>
        <div class="d-flex gap-2">
            @if($magazine->pdf_file && Storage::disk('public')->exists($magazine->pdf_file))
                <a href="{{ Storage::url($magazine->pdf_file) }}" class="btn btn-success" target="_blank" download>
                    <i class="fas fa-download me-1"></i>ডাউনলোড
                </a>
            @endif
            <a href="{{ route('publications.magazines') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>ফিরে যান
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            @if($magazine->pdf_file && Storage::disk('public')->exists($magazine->pdf_file))
                <div class="ratio ratio-16x9" style="min-height: 800px;">
                    <object
                        data="{{ Storage::url($magazine->pdf_file) }}"
                        type="application/pdf"
                        width="100%"
                        height="100%">
                        <p>
                            আপনার ব্রাউজারে পিডিএফ দেখার সুবিধা নেই। 
                            <a href="{{ Storage::url($magazine->pdf_file) }}" download>পিডিএফ ডাউনলোড করুন</a>
                        </p>
                    </object>
                </div>
            @else
                <div class="alert alert-warning m-3">
                    <i class="fas fa-exclamation-triangle me-1"></i>এই ম্যাগাজিনের পিডিএফ ফাইল পাওয়া যায়নি
                </div>
            @endif
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h4>ম্যাগাজিন তথ্য</h4>
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">শিরোনাম:</th>
                            <td>{{ $magazine->title }}</td>
                        </tr>
                        <tr>
                            <th>ইস্যু নম্বর:</th>
                            <td>{{ $magazine->issue_number }}</td>
                        </tr>
                        <tr>
                            <th>প্রকাশনার তারিখ:</th>
                            <td>{{ $magazine->publication_date->format('d F, Y') }}</td>
                        </tr>
                        @if($magazine->description)
                            <tr>
                                <th>বিবরণ:</th>
                                <td>{!! nl2br(e($magazine->description)) !!}</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="col-md-4">
                    @if($magazine->cover_image && Storage::disk('public')->exists($magazine->cover_image))
                        <img src="{{ Storage::url($magazine->cover_image) }}" 
                             alt="{{ $magazine->title }}" 
                             class="img-fluid rounded">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Add fullscreen button to PDF viewer
    document.addEventListener('DOMContentLoaded', function() {
        const pdfObject = document.querySelector('object[type="application/pdf"]');
        if (pdfObject) {
            const fullscreenBtn = document.createElement('button');
            fullscreenBtn.className = 'btn btn-primary position-absolute top-0 end-0 m-2';
            fullscreenBtn.innerHTML = '<i class="fas fa-expand"></i>';
            fullscreenBtn.addEventListener('click', function() {
                if (pdfObject.requestFullscreen) {
                    pdfObject.requestFullscreen();
                } else if (pdfObject.webkitRequestFullscreen) {
                    pdfObject.webkitRequestFullscreen();
                } else if (pdfObject.msRequestFullscreen) {
                    pdfObject.msRequestFullscreen();
                }
            });
            pdfObject.parentElement.style.position = 'relative';
            pdfObject.parentElement.appendChild(fullscreenBtn);
        }
    });
</script>
@endpush

@endsection
