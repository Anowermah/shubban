@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>ম্যাগাজিন বিস্তারিত</h2>
        <div>
            <a href="{{ route('admin.publications.magazines.edit', $magazine) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i>সম্পাদনা করুন
            </a>
            <a href="{{ route('admin.publications.magazines.index') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-arrow-left me-1"></i>ফিরে যান
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">{{ $magazine->title }}</h3>
                    <div class="d-flex gap-3 text-muted mb-3">
                        <div>
                            <i class="fas fa-hashtag me-1"></i>সংখ্যা {{ $magazine->issue_number }}
                        </div>
                        <div>
                            <i class="fas fa-calendar me-1"></i>{{ $magazine->publication_date->format('d F, Y') }}
                        </div>
                        <div>
                            <i class="fas fa-tag me-1"></i>{{ $magazine->price ? '৳'.number_format($magazine->price, 2) : 'বিনামূল্যে' }}
                        </div>
                    </div>

                    @if($magazine->description)
                        <div class="mb-4">
                            <h5>বিবরণ:</h5>
                            {!! nl2br(e($magazine->description)) !!}
                        </div>
                    @endif

                    <div class="d-flex gap-2">
                        <span class="badge {{ $magazine->status == 'published' ? 'bg-success' : 'bg-warning' }} p-2">
                            <i class="fas {{ $magazine->status == 'published' ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>
                            {{ $magazine->status == 'published' ? 'প্রকাশিত' : 'খসড়া' }}
                        </span>
                        
                        @if($magazine->created_at)
                            <span class="badge bg-info p-2">
                                <i class="fas fa-plus-circle me-1"></i>
                                {{ $magazine->created_at->format('d/m/Y') }} তারিখে যোগ করা হয়েছে
                            </span>
                        @endif
                        
                        @if($magazine->updated_at && $magazine->updated_at->ne($magazine->created_at))
                            <span class="badge bg-primary p-2">
                                <i class="fas fa-edit me-1"></i>
                                {{ $magazine->updated_at->format('d/m/Y') }} তারিখে সর্বশেষ আপডেট করা হয়েছে
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            @if($magazine->pdf_file)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">পিডিএফ প্রিভিউ</h5>
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ Storage::url($magazine->pdf_file) }}" 
                                    class="rounded" 
                                    style="width: 100%; height: 600px;" 
                                    frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">কভার ইমেজ</h5>
                    @if($magazine->cover_image)
                        <img src="{{ Storage::url($magazine->cover_image) }}" 
                             alt="{{ $magazine->title }}" 
                             class="img-fluid rounded">
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle me-1"></i>কোন কভার ইমেজ আপলোড করা হয়নি
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">ডাউনলোড</h5>
                    @if($magazine->pdf_file)
                        <a href="{{ Storage::url($magazine->pdf_file) }}" 
                           class="btn btn-success w-100" 
                           download>
                            <i class="fas fa-file-pdf me-1"></i>পিডিএফ ডাউনলোড করুন
                        </a>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle me-1"></i>কোন পিডিএফ ফাইল আপলোড করা হয়নি
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
