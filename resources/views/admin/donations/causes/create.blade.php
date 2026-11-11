@extends('admin.layouts.app')

@section('title', 'নতুন দান খাত যুক্ত করুন')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-3 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1">
            <i class="fas fa-plus-circle text-success me-2"></i>নতুন দান খাত / ফান্ড যুক্ত করুন
        </h1>
        <p class="text-muted small mb-0">পাবলিক ডোনেশন পেজে নতুন খাতের জন্য অপশন তৈরি করুন</p>
    </div>
    <div>
        <a href="{{ route('admin.donations.causes.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> খাতের তালিকা
        </a>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger border-0 shadow-sm rounded-3 p-3 mb-4">
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 p-md-5">
            <form action="{{ route('admin.donations.causes.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label small fw-bold">খাতের পূর্ণ নাম <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control rounded-3" 
                           placeholder="উদাঃ শুব্বান কেন্দ্রীয় কমপ্লেক্স ও পাঠাগার নির্মাণ" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">বিস্তারিত বিবরণ ও আবেদন (দাতার উদ্দেশ্যে)</label>
                    <textarea name="description" class="form-control tinymce-editor rounded-3" rows="4" 
                              placeholder="এই ফান্ডের উদ্দেশ্য ও টাকা কীভাবে ব্যয় করা হবে...">{{ old('description') }}</textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">টার্গেট / লক্ষ্যমাত্রা টাকা (ঐচ্ছিক)</label>
                        <input type="number" name="target_amount" class="form-control rounded-3" 
                               placeholder="উদাঃ ৫,০০,০০০" value="{{ old('target_amount') }}" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">আইকন ক্লাস (FontAwesome)</label>
                        <input type="text" name="icon" class="form-control rounded-3" 
                               placeholder="fas fa-mosque" value="{{ old('icon', 'fas fa-hand-holding-heart') }}">
                        <div class="form-text font-xs text-muted">উদাহরণ: fas fa-mosque, fas fa-heartbeat, fas fa-book-reader</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">ক্রম / ক্রমবিন্যাস নম্বর</label>
                        <input type="number" name="sort_order" class="form-control rounded-3" 
                               value="{{ old('sort_order', 1) }}" min="0">
                    </div>
                    <div class="col-md-6 d-flex align-items-center pt-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" checked>
                            <label class="form-check-label fw-bold small text-dark" for="isActive">
                                খাতটি প্রকাশ্য পেজে সক্রিয় রাখুন
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('admin.donations.causes.index') }}" class="btn btn-light border rounded-pill px-4">
                        বাতিল
                    </a>
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm" style="background: #0C4B36; border-color: #0C4B36;">
                        <i class="fas fa-save me-1"></i> দান খাত সংরক্ষণ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
