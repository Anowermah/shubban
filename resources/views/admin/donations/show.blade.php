@extends('admin.layouts.app')

@section('title', 'অনুদানের বিস্তারিত বিবরণ')

@section('content')
@php
    $toBn = function($number) {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, (string)$number);
    };
@endphp

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-3 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1">
            <i class="fas fa-file-invoice text-success me-2"></i>অনুদানের বিস্তারিত খতিয়ান
        </h1>
        <p class="text-muted small mb-0">রশিদ নং: <span class="font-monospace fw-bold text-success">{{ $donation->receipt_no ?? ('#'.$donation->id) }}</span></p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.donations.print', $donation) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold">
            <i class="fas fa-print me-1"></i> রসিদ প্রিন্ট
        </a>
        <a href="{{ route('admin.donations.edit', $donation) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-bold text-dark">
            <i class="fas fa-edit me-1"></i> এডিট করুন
        </a>
        <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> তালিকা
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 p-3 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4 mb-5">
    <!-- Left Column: Full Donation Profile -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
            <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="fas fa-info-circle text-success me-2"></i>অনুদান বিবরণ ও ভাউচার তথ্য
                </h5>
                <div>
                    @if($donation->status === 'approved')
                        <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold">
                            <i class="fas fa-check-circle me-1"></i>অনুমোদিত
                        </span>
                    @elseif($donation->status === 'rejected')
                        <span class="badge bg-danger-subtle text-danger px-3 py-1 rounded-pill fw-bold">
                            <i class="fas fa-times-circle me-1"></i>বাতিল
                        </span>
                    @else
                        <span class="badge bg-warning-subtle text-dark px-3 py-1 rounded-pill fw-bold">
                            <i class="fas fa-clock me-1"></i>যাচাইাধীন
                        </span>
                    @endif
                </div>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <tr>
                                <th class="bg-light text-secondary small" style="width: 30%;">রশিদ নম্বর (Receipt No)</th>
                                <td class="font-monospace fw-bold text-success fs-6">{{ $donation->receipt_no ?? ('SHB-DON-' . $donation->id) }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-secondary small">আবেদনের তারিখ ও সময়</th>
                                <td class="small text-dark">{{ $donation->created_at->format('d F, Y - h:i A') }} ({{ $donation->created_at->diffForHumans() }})</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-secondary small">দাতার নাম</th>
                                <td class="fw-bold text-dark">
                                    {{ $donation->name }}
                                    @if($donation->is_anonymous)
                                        <span class="badge bg-secondary text-white font-xs ms-2">
                                            <i class="fas fa-user-secret me-1"></i> গোপন দানকারী
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light text-secondary small">মোবাইল নম্বর</th>
                                <td class="font-monospace fw-bold text-dark">
                                    <a href="tel:{{ $donation->phone }}" class="text-decoration-none text-dark">
                                        {{ $donation->phone }} <i class="fas fa-phone text-success ms-1 small"></i>
                                    </a>
                                </td>
                            </tr>
                            @if($donation->sender_number)
                                <tr>
                                    <th class="bg-light text-secondary small">প্রেরকের নম্বর / একাউন্ট</th>
                                    <td class="font-monospace small text-dark">{{ $donation->sender_number }}</td>
                                </tr>
                            @endif
                            @if($donation->email)
                                <tr>
                                    <th class="bg-light text-secondary small">ইমেইল ঠিকানা</th>
                                    <td class="small text-dark">{{ $donation->email }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th class="bg-light text-secondary small">দানের খাত / ফান্ড</th>
                                <td class="fw-bold text-success">
                                    <i class="fas fa-hand-holding-heart me-1"></i>
                                    {{ $donation->cause->name ?? ($donation->category ?? 'সাধারণ বাইতুল মাল') }}
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light text-secondary small">পেমেন্ট মেথড</th>
                                <td class="text-uppercase fw-bold text-dark small">
                                    <span class="badge bg-light text-dark border px-2 py-1">{{ $donation->payment_method }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light text-secondary small">ট্রানজেকশন আইডি (TrxID)</th>
                                <td class="font-monospace fw-bold text-dark fs-6">{{ $donation->transaction_id ?? 'N/A' }}</td>
                            </tr>
                            <tr class="table-success table-opacity-25">
                                <th class="fw-bold fs-6 text-dark">দানের মোট পরিমাণ</th>
                                <td class="fw-bold fs-4 text-success font-monospace">
                                    ৳ {{ $toBn(number_format($donation->amount, 2)) }}
                                </td>
                            </tr>
                            @if($donation->message)
                                <tr>
                                    <th class="bg-light text-secondary small">দাতার দো'আ বা মন্তব্য</th>
                                    <td class="small text-secondary fst-italic">"{{ $donation->message }}"</td>
                                </tr>
                            @endif
                            @if($donation->admin_notes)
                                <tr>
                                    <th class="bg-light text-secondary small">অ্যাডমিন রিমার্কস</th>
                                    <td class="small text-dark bg-warning-subtle">{{ $donation->admin_notes }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Attached Slip Image Preview -->
                @if($donation->receipt_image && Storage::disk('public')->exists($donation->receipt_image))
                    <div class="mt-4 p-3 bg-light rounded-3 border">
                        <h6 class="fw-bold text-dark mb-2">
                            <i class="fas fa-paperclip text-success me-1"></i>সংযুক্ত পেমেন্ট স্লিপ / স্ক্রিনশট:
                        </h6>
                        <div class="text-center">
                            <a href="{{ Storage::url($donation->receipt_image) }}" target="_blank">
                                <img src="{{ Storage::url($donation->receipt_image) }}" alt="Deposit Slip" 
                                     class="img-fluid rounded-3 shadow-sm border" style="max-height: 380px;">
                            </a>
                            <div class="mt-2">
                                <a href="{{ Storage::url($donation->receipt_image) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-external-link-alt me-1"></i> পূর্ণ আকারে দেখুন
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right Column: Verification & Status Actions -->
    <div class="col-lg-4">
        <!-- Status Update Box -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
            <div class="card-header bg-white border-bottom p-3">
                <h5 class="fs-6 fw-bold mb-0 text-dark">
                    <i class="fas fa-tasks text-warning me-2"></i>স্ট্যাটাস ও ভেরিফিকেশন কন্ট্রোল
                </h5>
            </div>
            <div class="card-body p-3 p-md-4">
                <form action="{{ route('admin.donations.status', $donation) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">বর্তমান স্ট্যাটাস পরিবর্তন করুন</label>
                        <select name="status" class="form-select rounded-3 fw-bold">
                            <option value="pending" {{ $donation->status === 'pending' ? 'selected' : '' }}>যাচাইাধীন (Pending)</option>
                            <option value="approved" {{ $donation->status === 'approved' ? 'selected' : '' }}>অনুমোদিত (Approved)</option>
                            <option value="rejected" {{ $donation->status === 'rejected' ? 'selected' : '' }}>বাতিল (Rejected)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">অ্যাডমিন নোট / ভেরিফিকেশন মন্তব্য</label>
                        <textarea name="admin_notes" class="form-control rounded-3" rows="3" 
                                  placeholder="উদাঃ বিকাশের স্টেটমেন্টের সাথে TrxID মিলেছে...">{{ $donation->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold shadow-sm" style="background: #0C4B36; border-color: #0C4B36;">
                        <i class="fas fa-check me-1"></i> স্ট্যাটাস আপডেট করুন
                    </button>
                </form>

                <!-- Audit info -->
                @if($donation->verified_at)
                    <div class="mt-3 pt-3 border-top small text-muted">
                        <div><i class="fas fa-user-check text-success me-1"></i> যাচাইকারী: <strong>{{ $donation->verified_by ?? 'Admin' }}</strong></div>
                        <div><i class="far fa-calendar-check text-success me-1"></i> তারিখ: {{ $donation->verified_at->format('d/m/Y h:i A') }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions & Delete -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-3 p-md-4 mb-4">
            <h5 class="fs-6 fw-bold mb-3 text-dark">দ্রুত অ্যাকশন</h5>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.donations.print', $donation) }}" target="_blank" class="btn btn-outline-success rounded-pill fw-semibold">
                    <i class="fas fa-print me-1"></i> রসিদ প্রিন্ট করুন
                </a>
                <a href="{{ route('admin.donations.edit', $donation) }}" class="btn btn-outline-warning text-dark rounded-pill fw-semibold">
                    <i class="fas fa-edit me-1"></i> তথ্য এডিট করুন
                </a>
                <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" 
                      onsubmit="return confirm('আপনি কি নিশ্চিত যে এই দানের রেকর্ডটি সম্পূর্ণরূপে মুছে ফেলতে চান?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger rounded-pill fw-semibold w-100">
                        <i class="fas fa-trash-alt me-1"></i> রেকর্ডটি মুছে ফেলুন
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
