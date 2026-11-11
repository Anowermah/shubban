@extends('layouts.app')

@section('title', 'অনুমোদনহীন অ্যাক্সেস (Access Denied) - জমঈয়ত শুব্বান')

@section('content')
<div class="container py-5 my-4">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 text-center">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden p-4 p-md-5">
                <div class="mb-4">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background: #fff3cd; color: #856404; font-size: 2.5rem;">
                        <i class="fas fa-user-lock"></i>
                    </span>
                </div>

                <h3 class="fw-bold mb-2 text-danger">প্রবেশাধিকার সংরক্ষিত</h3>
                <p class="text-secondary font-sm mb-4">
                    দুঃখিত, এই পেজটি (<strong>{{ $page->page_name }}</strong>) দেখার জন্য আপনার অ্যাকাউন্টের বর্তমান ক্যাটাগরি অনুমোদনযোগ্য নয়।
                </p>

                <div class="alert alert-light border rounded-3 text-start mb-4">
                    <div class="mb-2">
                        <small class="text-muted d-block font-xs">আপনার বর্তমান রোল / ক্যাটাগরি:</small>
                        <span class="badge bg-secondary px-2 py-1">{{ $user->role_label }}</span>
                    </div>
                    <div>
                        <small class="text-muted d-block font-xs">প্রয়োজনীয় প্রবেশাধিকার স্তর:</small>
                        <span class="badge bg-warning text-dark px-2 py-1">{{ $requiredLevel }}</span>
                    </div>
                </div>

                <p class="text-muted font-sm mb-4">
                    আপনার সদস্যপদ বা ক্যাটাগরি আপগ্রেড করতে অনুগ্রহ করে কেন্দ্রীয় অ্যাডমিন বা দায়িত্বশীলদের সাথে যোগাযোগ করুন।
                </p>

                <div class="d-flex justify-content-center gap-2 flex-wrap">
                    <a href="{{ route('user.dashboard') }}" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-tachometer-alt me-1"></i> আমার ড্যাশবোর্ড
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-home me-1"></i> হোমপেজ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
