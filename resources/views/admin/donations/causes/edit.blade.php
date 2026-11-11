@extends('admin.layouts.app')

@section('title', 'দান খাত সম্পাদনা')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-3 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1">
            <i class="fas fa-edit text-warning me-2"></i>দান খাত সম্পাদনা
        </h1>
        <p class="text-muted small mb-0">{{ $cause->name }}</p>
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
            <form action="{{ route('admin.donations.causes.update', $cause) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label small fw-bold">খাতের পূর্ণ নাম <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control rounded-3" 
                           value="{{ old('name', $cause->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">বিস্তারিত বিবরণ ও আবেদন (দাতার উদ্দেশ্যে)</label>
                    <textarea name="description" class="form-control tinymce-editor rounded-3" rows="4">{{ old('description', $cause->description) }}</textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">টার্গেট / লক্ষ্যমাত্রা টাকা (ঐচ্ছিক)</label>
                        <input type="number" name="target_amount" class="form-control rounded-3" 
                               value="{{ old('target_amount', $cause->target_amount) }}" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">আইকন ক্লাস (FontAwesome)</label>
                        <input type="text" name="icon" class="form-control rounded-3" 
                               value="{{ old('icon', $cause->icon) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">ক্রম / ক্রমবিন্যাস নম্বর</label>
                        <input type="number" name="sort_order" class="form-control rounded-3" 
                               value="{{ old('sort_order', $cause->sort_order) }}" min="0">
                    </div>
                    <div class="col-md-6 d-flex align-items-center pt-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActiveEdit" 
                                   {{ old('is_active', $cause->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small text-dark" for="isActiveEdit">
                                খাতটি প্রকাশ্য পেজে সক্রিয় রাখুন
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('admin.donations.causes.index') }}" class="btn btn-light border rounded-pill px-4">
                        বাতিল
                    </a>
                    <button type="submit" class="btn btn-warning text-dark rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-1"></i> পরিবর্তন সংরক্ষণ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
