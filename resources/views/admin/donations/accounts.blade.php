@extends('admin.layouts.app')

@section('title', 'পেমেন্ট গেটওয়ে ও ব্যাংক সেটিংস')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-3 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1">
            <i class="fas fa-wallet text-success me-2"></i>পেমেন্ট গেটওয়ে ও ব্যাংক একাউন্ট সেটিংস
        </h1>
        <p class="text-muted small mb-0">ওয়েবসাইটের পাবলিক ডোনেশন পেজে প্রদর্শিত বিকাশ, নগদ, রকেট ও ব্যাংক একাউন্ট নম্বর নিয়ন্ত্রণ করুন</p>
    </div>
    <div>
        <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> অনুদানের তালিকা
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 p-3 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row justify-content-center mb-5">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 p-md-5">
            <form action="{{ route('admin.donations.accounts.update') }}" method="POST">
                @csrf

                <!-- Mobile Financial Services (MFS) -->
                <h5 class="fw-bold fs-6 text-dark mb-3 pb-2 border-bottom">
                    <i class="fas fa-mobile-alt text-danger me-2"></i>মোবাইল ব্যাংকিং নম্বরসমূহ (MFS)
                </h5>

                <div class="row g-3 mb-4">
                    <!-- bKash -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">বিকাশ (bKash) নম্বর</label>
                        <input type="text" name="bkash_number" class="form-control rounded-3 font-monospace" 
                               value="{{ old('bkash_number', $setting->bkash_number ?? '01765812261') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">বিকাশ একাউন্টের ধরণ</label>
                        <select name="bkash_type" class="form-select rounded-3">
                            <option value="মার্চেন্ট" {{ old('bkash_type', $setting->bkash_type) === 'মার্চেন্ট' ? 'selected' : '' }}>মার্চেন্ট (Make Payment)</option>
                            <option value="পার্সোনাল" {{ old('bkash_type', $setting->bkash_type) === 'পার্সোনাল' ? 'selected' : '' }}>পার্সোনাল (Send Money)</option>
                        </select>
                    </div>

                    <!-- Nagad -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">নগদ (Nagad) নম্বর</label>
                        <input type="text" name="nagad_number" class="form-control rounded-3 font-monospace" 
                               value="{{ old('nagad_number', $setting->nagad_number ?? '01765812261') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">নগদ একাউন্টের ধরণ</label>
                        <select name="nagad_type" class="form-select rounded-3">
                            <option value="পার্সোনাল" {{ old('nagad_type', $setting->nagad_type) === 'পার্সোনাল' ? 'selected' : '' }}>পার্সোনাল (Send Money)</option>
                            <option value="মার্চেন্ট" {{ old('nagad_type', $setting->nagad_type) === 'মার্চেন্ট' ? 'selected' : '' }}>মার্চেন্ট (Payment)</option>
                        </select>
                    </div>

                    <!-- Rocket -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">রকেট (Rocket) নম্বর</label>
                        <input type="text" name="rocket_number" class="form-control rounded-3 font-monospace" 
                               value="{{ old('rocket_number', $setting->rocket_number ?? '017658122617') }}">
                    </div>
                </div>

                <!-- Bank Account Details -->
                <h5 class="fw-bold fs-6 text-dark mb-3 mt-4 pb-2 border-bottom">
                    <i class="fas fa-university text-success me-2"></i>অফিসিয়াল ব্যাংক একাউন্ট বিবরণ
                </h5>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">ব্যাংকের পূর্ণ নাম</label>
                        <input type="text" name="bank_name" class="form-control rounded-3" 
                               value="{{ old('bank_name', $setting->bank_name ?? 'ইসলামী ব্যাংক বাংলাদেশ লিমিটেড') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">শাখা (Branch)</label>
                        <input type="text" name="bank_branch" class="form-control rounded-3" 
                               value="{{ old('bank_branch', $setting->bank_branch ?? 'যাত্রাবাড়ী শাখা, ঢাকা') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">একাউন্টের নাম (Account Title)</label>
                        <input type="text" name="bank_account_name" class="form-control rounded-3" 
                               value="{{ old('bank_account_name', $setting->bank_account_name ?? 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">একাউন্ট নম্বর (Account Number)</label>
                        <input type="text" name="bank_account_number" class="form-control rounded-3 font-monospace fw-bold text-success" 
                               value="{{ old('bank_account_number', $setting->bank_account_number ?? '20501234567') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">রাউটিং নম্বর (Routing Number)</label>
                        <input type="text" name="bank_routing" class="form-control rounded-3 font-monospace" 
                               value="{{ old('bank_routing', $setting->bank_routing ?? '125273456') }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('admin.donations.index') }}" class="btn btn-light border rounded-pill px-4">
                        বাতিল
                    </a>
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm" style="background: #0C4B36; border-color: #0C4B36;">
                        <i class="fas fa-save me-1"></i> সেটিংস আপডেট করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
