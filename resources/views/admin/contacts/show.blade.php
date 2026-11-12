@extends('admin.layouts.app')

@section('title', 'বার্তা বিস্তারিত')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap pt-2 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-0">
            <i class="fas fa-comment-dots text-success me-2"></i>বার্তা বিস্তারিত
        </h1>
        <p class="text-muted small mb-0">{{ $contact->name }}-এর পাঠানো বার্তা</p>
    </div>
    <div class="btn-toolbar mb-0">
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> সব বার্তা
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-4 col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-3">
            <div class="card-header bg-light fw-bold py-2 px-3">
                <i class="fas fa-user-circle text-primary me-2"></i>প্রেরকের তথ্য
            </div>
            <div class="card-body p-3">
                <div class="mb-3 pb-2 border-bottom">
                    <span class="text-muted small d-block">প্রেরকের নাম</span>
                    <strong class="text-dark fs-6">{{ $contact->name }}</strong>
                </div>
                <div class="mb-3 pb-2 border-bottom">
                    <span class="text-muted small d-block">মোবাইল ফোন</span>
                    <a href="tel:{{ $contact->phone }}" class="text-decoration-none fw-bold text-success fs-6">
                        <i class="fas fa-phone-alt me-1"></i>{{ $contact->phone }}
                    </a>
                </div>
                <div class="mb-3 pb-2 border-bottom">
                    <span class="text-muted small d-block">ইমেইল ঠিকানা</span>
                    @if($contact->email)
                        <a href="mailto:{{ $contact->email }}" class="text-decoration-none text-primary">
                            <i class="fas fa-envelope me-1"></i>{{ $contact->email }}
                        </a>
                    @else
                        <span class="text-muted">উল্লেখ নেই</span>
                    @endif
                </div>
                <div>
                    <span class="text-muted small d-block">বার্তার সময় ও তারিখ</span>
                    <span class="text-dark font-monospace small">
                        <i class="far fa-clock me-1 text-muted"></i>{{ $contact->created_at->format('d M Y, h:i A') }}
                    </span>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="w-100">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger w-100 rounded-3 py-2 fw-semibold" onclick="return confirm('আপনি কি নিশ্চিত যে আপনি এই বার্তাটি মুছে ফেলতে চান?')">
                <i class="fas fa-trash me-1"></i> বার্তাটি মুছে ফেলুন
            </button>
        </form>
    </div>

    <div class="col-lg-8 col-12">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-light fw-bold py-2 px-3 d-flex justify-content-between align-items-center">
                <span><i class="fas fa-heading text-warning me-2"></i>বিষয়: {{ $contact->subject }}</span>
                <span class="badge bg-success-subtle text-success rounded-pill font-xs">প্রাপ্ত বার্তা</span>
            </div>
            <div class="card-body p-3 p-md-4">
                <h6 class="text-muted small text-uppercase fw-bold mb-2">বার্তার মূল বক্তব্য:</h6>
                <div class="p-3 rounded-3 bg-light border border-light-subtle" style="white-space: pre-wrap; font-size: 0.95rem; line-height: 1.7; min-height: 160px; color: #1e293b;">
                    {{ $contact->message }}
                </div>

                <div class="mt-4 pt-3 border-top d-flex gap-2 flex-wrap">
                    @if($contact->phone)
                        <a href="tel:{{ $contact->phone }}" class="btn btn-sm btn-success rounded-pill px-3">
                            <i class="fas fa-phone me-1"></i> সরাসরি কল করুন
                        </a>
                    @endif
                    @if($contact->email)
                        <a href="mailto:{{ $contact->email }}" class="btn btn-sm btn-primary rounded-pill px-3">
                            <i class="fas fa-reply me-1"></i> ইমেইলে রিপ্লাই দিন
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
