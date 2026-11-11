@extends('admin.layouts.app')

@section('title', 'ইউজার ও রোল ব্যবস্থাপনা')

@section('content')
<div class="pt-3 pb-2 mb-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold mb-1 text-dark">
            <i class="fas fa-users-cog text-primary me-2"></i> ইউজার রোল ও ক্যাটাগরি ব্যবস্থাপনা
        </h1>
        <p class="text-muted font-sm mb-0">নিবন্ধিত ব্যবহারকারীদের সদস্যপদ, প্রশিক্ষণ স্তর বা কর্মকর্তা রোল বরাদ্দ করুন।</p>
    </div>
    <div>
        <a href="{{ route('admin.page-access.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> পেজ অ্যাক্সেস কন্ট্রোলে ফিরে যান
        </a>
    </div>
</div>

<!-- Alerts -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-light p-3 text-dark">
                    <i class="fas fa-users fa-lg"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">{{ $stats['total_users'] }}</h4>
                    <small class="text-muted">মোট নিবন্ধিত ইউজার</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 text-success">
                    <i class="fas fa-id-card fa-lg"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">{{ $stats['members'] }}</h4>
                    <small class="text-muted">অনুমোদিত সদস্য</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-info bg-opacity-10 p-3 text-info">
                    <i class="fas fa-user-graduate fa-lg"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">{{ $stats['students'] }}</h4>
                    <small class="text-muted">প্রশিক্ষণার্থী শিক্ষার্থী</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-danger bg-opacity-10 p-3 text-danger">
                    <i class="fas fa-user-tie fa-lg"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">{{ $stats['officials'] }}</h4>
                    <small class="text-muted">দায়িত্বশীল / কর্মকর্তা</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filter Bar -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
        <form action="{{ route('admin.users-access.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="নাম অথবা ইমেইল দিয়ে খুঁজুন..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="role" class="form-select form-select-sm">
                    <option value="">সকল রোল / ক্যাটাগরি</option>
                    @foreach($userRoles as $rKey => $rLabel)
                        <option value="{{ $rKey }}" {{ request('role') == $rKey ? 'selected' : '' }}>{{ $rLabel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-primary flex-fill">ফিল্টার</button>
                @if(request()->hasAny(['search', 'role']))
                    <a href="{{ route('admin.users-access.index') }}" class="btn btn-sm btn-outline-secondary" title="রিসেট">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Users Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">ক্রম</th>
                        <th>ইউজারের নাম ও ইমেইল</th>
                        <th>কর্মী স্তর ও শাখা</th>
                        <th>সাংগঠনিক ভূমিকা</th>
                        <th>স্ট্যাটাস</th>
                        <th class="text-end" style="width: 140px;">রোল পরিবর্তন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $u)
                        <tr>
                            <td class="text-muted fw-bold">{{ $users->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $u->name }}</div>
                                <small class="text-muted">{{ $u->email }}</small>
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark font-xs">{{ $u->worker_tier_label }}</span>
                                <small class="text-muted d-block font-xs mt-1">{{ $u->branch_name ?? 'শাখা নির্ধারিত হয়নি' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border font-xs">{{ $u->org_tier_label }}</span>
                                <small class="text-primary d-block font-xs fw-semibold">{{ $u->designation ?? 'কর্মী' }}</small>
                            </td>
                            <td>
                                @if($u->status === 'active')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">সক্রিয়</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">নিষ্ক্রিয়</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $u->id }}">
                                    <i class="fas fa-user-edit me-1"></i> মান ও রোল
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                কোনো ব্যবহারকারী পাওয়া যায়নি।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $users->links() }}
        </div>
    @endif
</div>

<!-- Edit User Modals -->
@foreach($users as $u)
<div class="modal fade" id="editUserModal{{ $u->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('admin.users-access.update', $u->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header bg-light">
                    <h5 class="modal-title fs-6 fw-bold">
                        <i class="fas fa-user-shield text-primary me-2"></i> রোল ও ক্যাটাগরি নির্ধারণ
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="p-2 mb-3 rounded bg-light border">
                        <div class="fw-bold">{{ $u->name }}</div>
                        <small class="text-muted">{{ $u->email }}</small>
                    </div>

                    <!-- Worker Tier -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold font-sm">কর্মী মান / স্তর (Worker Tier)</label>
                            <select name="worker_tier" class="form-select" required>
                                <option value="general" {{ $u->worker_tier === 'general' ? 'selected' : '' }}>সাধারণ সদস্য</option>
                                <option value="rageb" {{ $u->worker_tier === 'rageb' ? 'selected' : '' }}>রাগেব (১ম স্তর)</option>
                                <option value="aref" {{ $u->worker_tier === 'aref' ? 'selected' : '' }}>আরেফ (২য় স্তর)</option>
                                <option value="salek" {{ $u->worker_tier === 'salek' ? 'selected' : '' }}>সালেক (৩য় স্তর)</option>
                                <option value="saleh" {{ $u->worker_tier === 'saleh' ? 'selected' : '' }}>সালেহ (৪র্থ / শীর্ষ স্তর)</option>
                            </select>
                            <small class="text-muted font-xs d-block mt-1">স্তরের ওপর ভিত্তি করে সিলেবাস ও বই উন্মুক্ত হবে।</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold font-sm">সাংগঠনিক স্তর (Org Level)</label>
                            <select name="org_tier" class="form-select" required>
                                <option value="branch" {{ $u->org_tier === 'branch' ? 'selected' : '' }}>শাখা / ওয়ার্ড</option>
                                <option value="upazila" {{ $u->org_tier === 'upazila' ? 'selected' : '' }}>উপজেলা / থানা</option>
                                <option value="district" {{ $u->org_tier === 'district' ? 'selected' : '' }}>জেলা পরিষদ</option>
                                <option value="central" {{ $u->org_tier === 'central' ? 'selected' : '' }}>কেন্দ্রীয় পরিষদ</option>
                            </select>
                        </div>
                    </div>

                    <!-- Designation & Branch -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold font-sm">সাংগঠনিক পদবী</label>
                            <input type="text" name="designation" class="form-control" value="{{ $u->designation ?? 'সাধারণ কর্মী' }}" placeholder="যেমন: সভাপতি, সাধারণ সম্পাদক, কর্মী">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold font-sm">শাখা / ইউনিটের নাম</label>
                            <input type="text" name="branch_name" class="form-control" value="{{ $u->branch_name }}" placeholder="যেমন: মিরপুর শাখা, সিলেট জেলা">
                        </div>
                    </div>

                    <!-- Monthly Iyanat & Access Role -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold font-sm">মাসিক এয়ানত ধার্য (টাকা)</label>
                            <input type="number" step="0.01" name="monthly_iyanat" class="form-control" value="{{ $u->monthly_iyanat ?? 200 }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold font-sm">সিস্টেম রোল (Role)</label>
                            <select name="role" class="form-select" required>
                                @foreach($userRoles as $rKey => $rLabel)
                                    <option value="{{ $rKey }}" {{ $u->role === $rKey ? 'selected' : '' }}>
                                        {{ $rLabel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">অ্যাকাউন্ট স্ট্যাটাস</label>
                        <select name="status" class="form-select" required>
                            <option value="active" {{ $u->status === 'active' ? 'selected' : '' }}>সক্রিয় (Active)</option>
                            <option value="inactive" {{ $u->status === 'inactive' ? 'selected' : '' }}>নিষ্ক্রিয় (Inactive)</option>
                            <option value="blocked" {{ $u->status === 'blocked' ? 'selected' : '' }}>ব্লকড (Blocked)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-primary btn-sm px-4">সংরক্ষণ করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
