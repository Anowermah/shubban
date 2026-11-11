@extends('admin.layouts.app')

@section('title', 'অনুদানের খতিয়ান ও হিসাব ব্যবস্থাপনা')

@section('content')
@php
    $toBn = function($number) {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, (string)$number);
    };
@endphp

<!-- Page Title & Top Actions -->
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-3 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1" style="color: #0C4B36;">
            <i class="fas fa-hand-holding-usd text-success me-2"></i>অনুদানের খতিয়ান ও ব্যবস্থাপনা
        </h1>
        <p class="text-muted small mb-0">বাইতুল মাল, আস-শিফা ও বিভিন্ন ফান্ডের প্রাপ্ত অনুদান যাচাই, অনুমোদন ও নিয়ন্ত্রণ</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.donations.create') }}" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm fw-bold">
            <i class="fas fa-plus-circle me-1"></i> নতুন দান এন্ট্রি
        </a>
        <a href="{{ route('admin.donations.causes.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
            <i class="fas fa-layer-group me-1"></i> দান খাতসমূহ
        </a>
        <a href="{{ route('admin.donations.accounts') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold">
            <i class="fas fa-wallet me-1"></i> পেমেন্ট ও ব্যাংক সেটিংস
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 p-3 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Overview Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-success">
            <div class="d-flex align-items-center justify-content-between mb-1">
                <span class="text-muted small fw-bold">মোট অনুমোদিত অনুদান</span>
                <span class="badge bg-success-subtle text-success rounded-pill font-xs">মোট প্রাপ্তি</span>
            </div>
            <h3 class="fw-bold fs-4 text-success mb-1">৳ {{ $toBn(number_format($stats['total_approved_amount'], 2)) }}</h3>
            <span class="small text-muted">{{ $toBn($stats['total_approved_count']) }} টি সফল অনুদান</span>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-warning">
            <div class="d-flex align-items-center justify-content-between mb-1">
                <span class="text-muted small fw-bold">যাচাইাধীন (অপেক্ষমান)</span>
                <span class="badge bg-warning-subtle text-dark rounded-pill font-xs">অপেক্ষমান</span>
            </div>
            <h3 class="fw-bold fs-4 text-warning mb-1">৳ {{ $toBn(number_format($stats['pending_amount'], 2)) }}</h3>
            <span class="small text-muted">{{ $toBn($stats['pending_count']) }} টি ট্রানজেকশন যাচাই বাকি</span>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-info">
            <div class="d-flex align-items-center justify-content-between mb-1">
                <span class="text-muted small fw-bold">চলতি মাসের সংগ্রহ</span>
                <span class="badge bg-info-subtle text-dark rounded-pill font-xs">{{ date('F Y') }}</span>
            </div>
            <h3 class="fw-bold fs-4 text-info mb-1">৳ {{ $toBn(number_format($stats['this_month_amount'], 2)) }}</h3>
            <span class="small text-muted">এই মাসে জমা হওয়া অনুদান</span>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-secondary">
            <div class="d-flex align-items-center justify-content-between mb-1">
                <span class="text-muted small fw-bold">মোট রেকর্ড</span>
                <span class="badge bg-light text-secondary rounded-pill font-xs">সর্বমোট</span>
            </div>
            <h3 class="fw-bold fs-4 text-dark mb-1">{{ $toBn($stats['total_count']) }} টি</h3>
            <span class="small text-muted">বাতিল: {{ $toBn($stats['rejected_count']) }} টি</span>
        </div>
    </div>
</div>

<!-- Search & Advanced Filter Card -->
<div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white mb-4">
    <form action="{{ route('admin.donations.index') }}" method="GET" class="row g-3 align-items-end">
        <!-- Search Keyword -->
        <div class="col-12 col-md-3">
            <label class="form-label small fw-bold text-secondary mb-1">অনুসন্ধান</label>
            <input type="text" name="search" class="form-control rounded-pill" 
                   placeholder="নাম, ফোন, TrxID, রসিদ নং..." value="{{ request('search') }}">
        </div>

        <!-- Status Filter -->
        <div class="col-6 col-md-2">
            <label class="form-label small fw-bold text-secondary mb-1">স্ট্যাটাস</label>
            <select name="status" class="form-select rounded-pill">
                <option value="all">সকল স্ট্যাটাস</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>যাচাইাধীন</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>অনুমোদিত</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>বাতিল</option>
            </select>
        </div>

        <!-- Cause Filter -->
        <div class="col-6 col-md-2">
            <label class="form-label small fw-bold text-secondary mb-1">দানের খাত</label>
            <select name="cause_id" class="form-select rounded-pill">
                <option value="">সকল খাত</option>
                @foreach($causes as $cause)
                    <option value="{{ $cause->id }}" {{ request('cause_id') == $cause->id ? 'selected' : '' }}>
                        {{ $cause->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Payment Method -->
        <div class="col-6 col-md-2">
            <label class="form-label small fw-bold text-secondary mb-1">পেমেন্ট মেথড</label>
            <select name="payment_method" class="form-select rounded-pill">
                <option value="all">সকল মেথড</option>
                <option value="bkash" {{ request('payment_method') === 'bkash' ? 'selected' : '' }}>বিকাশ</option>
                <option value="nagad" {{ request('payment_method') === 'nagad' ? 'selected' : '' }}>নগদ</option>
                <option value="rocket" {{ request('payment_method') === 'rocket' ? 'selected' : '' }}>রকেট</option>
                <option value="bank" {{ request('payment_method') === 'bank' ? 'selected' : '' }}>ব্যাংক</option>
                <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>ক্যাশ</option>
            </select>
        </div>

        <!-- Filter & Reset Buttons -->
        <div class="col-6 col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-success rounded-pill flex-grow-1 fw-bold">
                <i class="fas fa-filter me-1"></i> ফিল্টার
            </button>
            @if(request()->anyFilled(['search', 'status', 'cause_id', 'payment_method']))
                <a href="{{ route('admin.donations.index') }}" class="btn btn-outline-secondary rounded-pill" title="রিসেট">
                    <i class="fas fa-undo"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Donations Data Table Card -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">রসিদ নং ও তারিখ</th>
                    <th>দাতার নাম ও যোগাযোগ</th>
                    <th>দানের খাত</th>
                    <th>পরিমাণ</th>
                    <th>মেথড ও TrxID</th>
                    <th>স্লিপ</th>
                    <th>স্ট্যাটাস</th>
                    <th class="text-end pe-4">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                    <tr>
                        <!-- Receipt & Date -->
                        <td class="ps-4">
                            <span class="font-monospace fw-bold text-success font-sm d-block">
                                {{ $donation->receipt_no ?? ('#'.$donation->id) }}
                            </span>
                            <span class="text-muted font-xs">
                                {{ $donation->created_at->format('d/m/Y h:i A') }}
                            </span>
                        </td>

                        <!-- Donor Profile -->
                        <td>
                            <div class="fw-bold text-dark font-sm">
                                {{ $donation->name }}
                                @if($donation->is_anonymous)
                                    <span class="badge bg-secondary-subtle text-secondary font-xs ms-1">
                                        <i class="fas fa-user-secret"></i> গোপন
                                    </span>
                                @endif
                            </div>
                            <div class="font-xs text-muted">
                                <i class="fas fa-phone-alt me-1 text-success"></i>{{ $donation->phone }}
                                @if($donation->email)
                                    • {{ $donation->email }}
                                @endif
                            </div>
                        </td>

                        <!-- Cause -->
                        <td>
                            <span class="badge bg-light text-dark border font-xs">
                                <i class="fas fa-tag text-warning me-1"></i>
                                {{ $donation->cause->name ?? ($donation->category ?? 'সাধারণ') }}
                            </span>
                        </td>

                        <!-- Amount -->
                        <td>
                            <span class="fw-bold font-monospace fs-6 text-success">
                                ৳ {{ $toBn(number_format($donation->amount, 2)) }}
                            </span>
                        </td>

                        <!-- Payment Method & TrxID -->
                        <td>
                            <span class="badge bg-light text-dark border text-uppercase font-xs">
                                {{ $donation->payment_method }}
                            </span>
                            @if($donation->transaction_id)
                                <div class="font-monospace font-xs text-secondary mt-1">
                                    {{ $donation->transaction_id }}
                                </div>
                            @endif
                        </td>

                        <!-- Slip Image -->
                        <td>
                            @if($donation->receipt_image && Storage::disk('public')->exists($donation->receipt_image))
                                <a href="{{ Storage::url($donation->receipt_image) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-circle p-1" style="width: 28px; height: 28px;" title="স্লিপ দেখুন">
                                    <i class="fas fa-image"></i>
                                </a>
                            @else
                                <span class="text-muted font-xs">—</span>
                            @endif
                        </td>

                        <!-- Status Badge -->
                        <td>
                            @if($donation->status === 'approved')
                                <span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill font-xs fw-bold">
                                    <i class="fas fa-check-circle me-1"></i>অনুমোদিত
                                </span>
                            @elseif($donation->status === 'rejected')
                                <span class="badge bg-danger-subtle text-danger px-2 py-1 rounded-pill font-xs fw-bold">
                                    <i class="fas fa-times-circle me-1"></i>বাতিল
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-dark px-2 py-1 rounded-pill font-xs fw-bold">
                                    <i class="fas fa-clock me-1"></i>যাচাইাধীন
                                </span>
                            @endif
                        </td>

                        <!-- Action Buttons -->
                        <td class="text-end pe-4">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border rounded-pill px-2 py-1" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.donations.show', $donation) }}">
                                            <i class="fas fa-eye text-primary me-2"></i> বিস্তারিত দেখুন
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.donations.edit', $donation) }}">
                                            <i class="fas fa-edit text-warning me-2"></i> তথ্য এডিট করুন
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.donations.print', $donation) }}" target="_blank">
                                            <i class="fas fa-print text-success me-2"></i> রসিদ প্রিন্ট করুন
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    
                                    <!-- Quick Status Toggle -->
                                    @if($donation->status !== 'approved')
                                        <li>
                                            <form action="{{ route('admin.donations.status', $donation) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="dropdown-item text-success">
                                                    <i class="fas fa-check-circle me-2"></i> অনুমোদন করুন
                                                </button>
                                            </form>
                                        </li>
                                    @endif

                                    @if($donation->status !== 'rejected')
                                        <li>
                                            <form action="{{ route('admin.donations.status', $donation) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-times-circle me-2"></i> বাতিল করুন
                                                </button>
                                            </form>
                                        </li>
                                    @endif

                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" 
                                              onsubmit="return confirm('আপনি কি নিশ্চিত যে এই দানের রেকর্ডটি সম্পূর্ণরূপে মুছে ফেলতে চান?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash-alt me-2"></i> রেকর্ড মুছুন
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fas fa-hand-holding-usd fa-3x text-secondary opacity-50 mb-3 d-block"></i>
                            <h5 class="fw-bold text-dark">কোনো অনুদানের রেকর্ড পাওয়া যায়নি</h5>
                            <p class="small text-muted mb-0">নতুন অনুদান এলে বা ম্যানুয়াল এন্ট্রি করলে এখানে তালিকাভুক্ত হবে।</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-3 border-top">
        {{ $donations->links() }}
    </div>
</div>
@endsection

@section('styles')
<style>
    .font-xs {
        font-size: 0.78rem;
    }
    .font-sm {
        font-size: 0.88rem;
    }
</style>
@endsection
