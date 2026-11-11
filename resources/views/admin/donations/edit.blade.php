@extends('admin.layouts.app')

@section('title', 'অনুদানের তথ্য সংশোধন')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-3 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1">
            <i class="fas fa-edit text-warning me-2"></i>অনুদানের তথ্য সম্পাদনা
        </h1>
        <p class="text-muted small mb-0">রশিদ নং: <strong>{{ $donation->receipt_no ?? ('#'.$donation->id) }}</strong> | তারিখ: {{ $donation->created_at->format('d/m/Y') }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.donations.show', $donation) }}" class="btn btn-sm btn-outline-info rounded-pill px-3">
            <i class="fas fa-eye me-1"></i> বিস্তারিত ভিউ
        </a>
        <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> তালিকা
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
            <form action="{{ route('admin.donations.update', $donation) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Donor Profile -->
                <h5 class="fw-bold fs-6 text-dark mb-3 pb-2 border-bottom">
                    <i class="fas fa-user text-success me-2"></i>দাতার পরিচিতি
                </h5>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">দাতার নাম <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-3" 
                               value="{{ old('name', $donation->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">মোবাইল নম্বর <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control rounded-3" 
                               value="{{ old('phone', $donation->phone) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">প্রেরকের নম্বর</label>
                        <input type="text" name="sender_number" class="form-control rounded-3" 
                               value="{{ old('sender_number', $donation->sender_number) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">ইমেইল ঠিকানা</label>
                        <input type="email" name="email" class="form-control rounded-3" 
                               value="{{ old('email', $donation->email) }}">
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_anonymous" value="1" id="isAnonEdit" 
                                   {{ old('is_anonymous', $donation->is_anonymous) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small text-dark" for="isAnonEdit">
                                <i class="fas fa-user-secret text-secondary me-1"></i> গোপন দানকারী (নাম প্রকাশ না করার অনুরোধ)
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Financial & Fund Info -->
                <h5 class="fw-bold fs-6 text-dark mb-3 mt-4 pb-2 border-bottom">
                    <i class="fas fa-coins text-warning me-2"></i>টাকার পরিমাণ ও খাত
                </h5>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">দানের পরিমাণ (টাকা) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-success fw-bold">৳</span>
                            <input type="number" name="amount" class="form-control rounded-end-3 fw-bold fs-5 text-success" 
                                   value="{{ old('amount', $donation->amount) }}" min="1" step="any" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">দানের খাত / ফান্ড <span class="text-danger">*</span></label>
                        <select name="cause_id" class="form-select rounded-3" required>
                            @foreach($causes as $cause)
                                <option value="{{ $cause->id }}" {{ old('cause_id', $donation->cause_id) == $cause->id ? 'selected' : '' }}>
                                    {{ $cause->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">পেমেন্ট মেথড <span class="text-danger">*</span></label>
                        <select name="payment_method" class="form-select rounded-3" required>
                            <option value="bkash" {{ old('payment_method', $donation->payment_method) === 'bkash' ? 'selected' : '' }}>বিকাশ</option>
                            <option value="nagad" {{ old('payment_method', $donation->payment_method) === 'nagad' ? 'selected' : '' }}>নগদ</option>
                            <option value="rocket" {{ old('payment_method', $donation->payment_method) === 'rocket' ? 'selected' : '' }}>রকেট</option>
                            <option value="bank" {{ old('payment_method', $donation->payment_method) === 'bank' ? 'selected' : '' }}>ব্যাংক</option>
                            <option value="cash" {{ old('payment_method', $donation->payment_method) === 'cash' ? 'selected' : '' }}>ক্যাশ</option>
                            <option value="other" {{ old('payment_method', $donation->payment_method) === 'other' ? 'selected' : '' }}>অন্যান্য</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">ট্রানজেকশন আইডি (TrxID)</label>
                        <input type="text" name="transaction_id" class="form-control rounded-3" 
                               value="{{ old('transaction_id', $donation->transaction_id) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">স্ট্যাটাস <span class="text-danger">*</span></label>
                        <select name="status" class="form-select rounded-3" required>
                            <option value="approved" {{ old('status', $donation->status) === 'approved' ? 'selected' : '' }}>অনুমোদিত (Approved)</option>
                            <option value="pending" {{ old('status', $donation->status) === 'pending' ? 'selected' : '' }}>যাচাইাধীন (Pending)</option>
                            <option value="rejected" {{ old('status', $donation->status) === 'rejected' ? 'selected' : '' }}>বাতিল (Rejected)</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold">নতুন স্লিপ ছবি আপলোড (যদি পরিবর্তন প্রয়োজন হয়)</label>
                        <input type="file" name="receipt_image" class="form-control rounded-3" accept="image/*">
                        @if($donation->receipt_image && Storage::disk('public')->exists($donation->receipt_image))
                            <div class="mt-2">
                                <span class="small text-muted me-2">বর্তমান স্লিপ:</span>
                                <a href="{{ Storage::url($donation->receipt_image) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill px-2 py-0">
                                    <i class="fas fa-eye me-1"></i> স্লিপ ফাইল দেখুন
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Notes & Messages -->
                <h5 class="fw-bold fs-6 text-dark mb-3 mt-4 pb-2 border-bottom">
                    <i class="fas fa-sticky-note text-info me-2"></i>দাতার মন্তব্য ও অ্যাডমিন নোট
                </h5>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">দাতার মন্তব্য</label>
                        <textarea name="message" class="form-control rounded-3" rows="3">{{ old('message', $donation->message) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">অ্যাডমিন নোট / রিমার্কস</label>
                        <textarea name="admin_notes" class="form-control rounded-3" rows="3" 
                                  placeholder="যাচাই সংক্রান্ত তথ্য বা বিশেষ মন্তব্য">{{ old('admin_notes', $donation->admin_notes) }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('admin.donations.show', $donation) }}" class="btn btn-light border rounded-pill px-4">
                        বাতিল
                    </a>
                    <button type="submit" class="btn btn-warning text-dark rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-1"></i> আপডেট সংরক্ষণ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
