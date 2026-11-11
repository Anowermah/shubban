@extends('admin.layouts.app')

@section('title', 'নতুন অনুদান এন্ট্রি')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-3 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1">
            <i class="fas fa-plus-circle text-success me-2"></i>নতুন অনুদান এন্ট্রি (অফিস / ক্যাশ / ব্যাংক)
        </h1>
        <p class="text-muted small mb-0">অফিসে সরাসরি প্রাপ্ত ক্যাশ, চেক বা ব্যাংক ডিপোজিট এন্ট্রি করে অফিসিয়াল ভাউচার তৈরি করুন</p>
    </div>
    <div>
        <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> অনুদানের তালিকা
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
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 p-md-5">
            <form action="{{ route('admin.donations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Donor Info -->
                <h5 class="fw-bold fs-6 text-dark mb-3 pb-2 border-bottom">
                    <i class="fas fa-user text-success me-2"></i>দাতার পরিচিতি
                </h5>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">দাতার পূর্ণ নাম <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-3" 
                               placeholder="উদাঃ মাওলানা আব্দুল্লাহ" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">মোবাইল নম্বর <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control rounded-3" 
                               placeholder="০১৭XXXXXXXX" value="{{ old('phone') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">ইমেইল ঠিকানা</label>
                        <input type="email" name="email" class="form-control rounded-3" 
                               placeholder="donor@example.com" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6 d-flex align-items-center pt-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_anonymous" value="1" id="isAnon" {{ old('is_anonymous') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small text-dark" for="isAnon">
                                <i class="fas fa-user-secret text-secondary me-1"></i> গোপন দানকারী হিসেবে চিহ্নিত করুন
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Financial & Fund Info -->
                <h5 class="fw-bold fs-6 text-dark mb-3 mt-4 pb-2 border-bottom">
                    <i class="fas fa-coins text-warning me-2"></i>অনুদানের পরিমাণ ও ফান্ড নির্বাচন
                </h5>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">দানের পরিমাণ (টাকায়) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-success fw-bold">৳</span>
                            <input type="number" name="amount" class="form-control rounded-end-3 fw-bold fs-5 text-success" 
                                   placeholder="৫০০০" value="{{ old('amount') }}" min="1" step="any" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">দানের খাত / ফান্ড <span class="text-danger">*</span></label>
                        <select name="cause_id" class="form-select rounded-3" required>
                            <option value="">খাত নির্বাচন করুন</option>
                            @foreach($causes as $cause)
                                <option value="{{ $cause->id }}" {{ old('cause_id') == $cause->id ? 'selected' : '' }}>
                                    {{ $cause->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">পেমেন্ট মাধ্যম <span class="text-danger">*</span></label>
                        <select name="payment_method" class="form-select rounded-3" required>
                            <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>সরাসরি ক্যাশ / নগদ</option>
                            <option value="bank" {{ old('payment_method') === 'bank' ? 'selected' : '' }}>ব্যাংক ডিপোজিট / চেক</option>
                            <option value="bkash" {{ old('payment_method') === 'bkash' ? 'selected' : '' }}>বিকাশ</option>
                            <option value="nagad" {{ old('payment_method') === 'nagad' ? 'selected' : '' }}>নগদ</option>
                            <option value="rocket" {{ old('payment_method') === 'rocket' ? 'selected' : '' }}>রকেট</option>
                            <option value="other" {{ old('payment_method') === 'other' ? 'selected' : '' }}>অন্যান্য</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">ট্রানজেকশন / চেক / ভাউচার রেফারেন্স</label>
                        <input type="text" name="transaction_id" class="form-control rounded-3" 
                               placeholder="উদাঃ CHQ-8821 বা TrxID" value="{{ old('transaction_id') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">স্ট্যাটাস <span class="text-danger">*</span></label>
                        <select name="status" class="form-select rounded-3" required>
                            <option value="approved" {{ old('status', 'approved') === 'approved' ? 'selected' : '' }}>অনুমোদিত (Approved)</option>
                            <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>যাচাইাধীন (Pending)</option>
                            <option value="rejected" {{ old('status') === 'rejected' ? 'selected' : '' }}>বাতিল (Rejected)</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold">ডিপোজিট স্লিপ বা রসিদের ছবি (ঐচ্ছিক)</label>
                        <input type="file" name="receipt_image" class="form-control rounded-3" accept="image/*">
                    </div>
                </div>

                <!-- Notes & Messages -->
                <h5 class="fw-bold fs-6 text-dark mb-3 mt-4 pb-2 border-bottom">
                    <i class="fas fa-sticky-note text-info me-2"></i>মন্তব্য ও দো'আ
                </h5>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">দাতার মন্তব্য / দো'আ</label>
                        <textarea name="message" class="form-control rounded-3" rows="2" 
                                  placeholder="দাতার কোনো বিশেষ অনুরোধ বা দো'আ থাকলে">{{ old('message') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">অ্যাডমিন ইন্টারনাল নোট (অফিসের অভ্যন্তরীণ তথ্য)</label>
                        <textarea name="admin_notes" class="form-control rounded-3" rows="2" 
                                  placeholder="রশিদ কার হাতে প্রদান করা হয়েছে বা বিশেষ কোনো মন্তব্য">{{ old('admin_notes') }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('admin.donations.index') }}" class="btn btn-light border rounded-pill px-4">
                        বাতিল
                    </a>
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm" style="background: #0C4B36; border-color: #0C4B36;">
                        <i class="fas fa-save me-1"></i> অনুদান এন্ট্রি নিশ্চিত করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
