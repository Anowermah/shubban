@extends('admin.layouts.app')

@section('title', 'দান খাত ও ফান্ডসমূহ পরিচালনা')

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
            <i class="fas fa-layer-group text-primary me-2"></i>দান খাত ও ফান্ডসমূহ (Donation Causes)
        </h1>
        <p class="text-muted small mb-0">ওয়েবসাইটের পাবলিক ডোনেশন পেজে প্রদর্শিত খাতসমূহ তৈরি, সম্পাদনা, সক্রিয়/নিষ্ক্রিয় ও মুছে ফেলা</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.donations.causes.create') }}" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm fw-bold">
            <i class="fas fa-plus-circle me-1"></i> নতুন দান খাত যুক্ত করুন
        </a>
        <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> অনুদানের খতিয়ান
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 p-3 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 p-3 mb-4" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">ক্রম</th>
                    <th>খাতের নাম ও বিবরণ</th>
                    <th>টার্গেট ও সংগৃহীত পরিমাণ</th>
                    <th>সংগৃহীত অনুদান</th>
                    <th>স্ট্যাটাস</th>
                    <th class="text-end pe-4">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($causes as $cause)
                    <tr>
                        <td class="ps-4 text-muted fw-bold font-sm">
                            #{{ $toBn($cause->sort_order ?? $loop->iteration) }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="cause-icon-box text-success" style="width: 40px; height: 40px; border-radius: 8px; background: #e8f5ee; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                                    <i class="{{ $cause->icon ?? 'fas fa-hand-holding-heart' }}"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">{{ $cause->name }}</h6>
                                    @if($cause->description)
                                        <p class="text-secondary font-xs mb-0" style="max-width: 320px;">
                                            {{ Str::limit($cause->description, 75) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="min-width: 170px;">
                            <div class="d-flex justify-content-between font-xs text-muted mb-1">
                                <span>সংগৃহীত: <strong class="text-success">৳ {{ $toBn(number_format($cause->raised_amount, 0)) }}</strong></span>
                                @if($cause->target_amount)
                                    <span>লক্ষ্য: {{ $toBn(number_format($cause->target_amount, 0)) }}</span>
                                @endif
                            </div>
                            @if($cause->target_amount && $cause->target_amount > 0)
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: {{ $cause->progress_percentage }}%;"></div>
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1 font-xs">
                                {{ $toBn($cause->donations_count ?? $cause->donations()->count()) }} টি অনুদান
                            </span>
                        </td>
                        <td>
                            @if($cause->is_active)
                                <span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill font-xs fw-bold">
                                    <i class="fas fa-check me-1"></i>সক্রিয়
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary px-2 py-1 rounded-pill font-xs fw-bold">
                                    <i class="fas fa-ban me-1"></i>নিষ্ক্রিয়
                                </span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <!-- Toggle Active/Inactive -->
                                <form action="{{ route('admin.donations.causes.toggle', $cause) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-light border rounded-pill px-2 py-1 font-xs" 
                                            title="{{ $cause->is_active ? 'নিষ্ক্রিয় করুন' : 'সক্রিয় করুন' }}">
                                        <i class="fas {{ $cause->is_active ? 'fa-eye-slash text-secondary' : 'fa-eye text-success' }}"></i>
                                    </button>
                                </form>

                                <!-- Edit -->
                                <a href="{{ route('admin.donations.causes.edit', $cause) }}" class="btn btn-sm btn-outline-warning text-dark rounded-pill px-2 py-1 font-xs" title="সম্পাদনা">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('admin.donations.causes.destroy', $cause) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('আপনি কি নিশ্চিত যে এই দান খাতটি মুছে ফেলতে চান?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1 font-xs" title="মুছুন">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-layer-group fa-3x text-secondary opacity-50 mb-3 d-block"></i>
                            <h5 class="fw-bold text-dark">কোনো দান খাত পাওয়া যায়নি</h5>
                            <a href="{{ route('admin.donations.causes.create') }}" class="btn btn-sm btn-success rounded-pill px-3 mt-2">
                                <i class="fas fa-plus me-1"></i> প্রথম দান খাত যুক্ত করুন
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
