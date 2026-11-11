@extends('admin.layouts.app')

@section('title', 'পেজ অ্যাক্সেস কন্ট্রোল ও পারমিশন')

@push('styles')
<style>
    .stat-card-mini {
        border-radius: 12px;
        padding: 16px 20px;
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.08);
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .stat-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }
    .access-badge-pill {
        font-size: 0.78rem;
        padding: 5px 10px;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .table-pages td {
        vertical-align: middle;
    }
    .select-access-level {
        font-size: 0.85rem;
        padding: 5px 8px;
        border-radius: 8px;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="pt-3 pb-2 mb-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold mb-1 text-dark">
            <i class="fas fa-user-lock text-warning me-2"></i> পেজ অ্যাক্সেস কন্ট্রোল ও প্রবেশাধিকার
        </h1>
        <p class="text-muted font-sm mb-0">গেস্ট ও বিভিন্ন ক্যাটাগরির ব্যবহারকারীদের জন্য ওয়েবসাইটের প্রতিটি পেজের প্রবেশাধিকার নির্ধারণ করুন।</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.users-access.index') }}" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-users-cog me-1"></i> ইউজার ও রোল ব্যবস্থাপনা
        </a>
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addPageModal">
            <i class="fas fa-plus me-1"></i> নতুন পেজ নিয়ন্ত্রণ যোগ
        </button>
    </div>
</div>

<!-- Alerts -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(isset($errors) && $errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- 4 Summary Stats -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card-mini">
            <div class="stat-card-icon bg-light text-dark">
                <i class="fas fa-sitemap"></i>
            </div>
            <div>
                <h4 class="mb-0 fw-bold">{{ $stats['total'] }}</h4>
                <small class="text-muted">মোট নিয়ন্ত্রিত পেজ</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card-mini">
            <div class="stat-card-icon bg-success bg-opacity-10 text-success">
                <i class="fas fa-globe"></i>
            </div>
            <div>
                <h4 class="mb-0 fw-bold">{{ $stats['public'] }}</h4>
                <small class="text-muted">উন্মুক্ত (গেস্ট সহ)</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card-mini">
            <div class="stat-card-icon bg-warning bg-opacity-15 text-warning">
                <i class="fas fa-lock"></i>
            </div>
            <div>
                <h4 class="mb-0 fw-bold">{{ $stats['authenticated'] }}</h4>
                <small class="text-muted">লগইন আবশ্যক (গেস্ট নিষিদ্ধ)</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card-mini">
            <div class="stat-card-icon bg-danger bg-opacity-10 text-danger">
                <i class="fas fa-user-shield"></i>
            </div>
            <div>
                <h4 class="mb-0 fw-bold">{{ $stats['restricted_roles'] }}</h4>
                <small class="text-muted">নির্দিষ্ট রোল সংরক্ষিত</small>
            </div>
        </div>
    </div>
</div>

<!-- Filters & Search -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
        <form action="{{ route('admin.page-access.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="পেজের নাম বা ইউআরএল খুঁজুন..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select form-select-sm">
                    <option value="">সকল ক্যাটাগরি / বিভাগ</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="access_level" class="form-select form-select-sm">
                    <option value="">সকল প্রবেশাধিকার স্তর</option>
                    @foreach($accessLevels as $lvlKey => $lvlInfo)
                        <option value="{{ $lvlKey }}" {{ request('access_level') == $lvlKey ? 'selected' : '' }}>{{ $lvlInfo['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-primary flex-fill">ফিল্টার</button>
                @if(request()->hasAny(['search', 'category', 'access_level']))
                    <a href="{{ route('admin.page-access.index') }}" class="btn btn-sm btn-outline-secondary" title="রিসেট">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Main Table: Bulk Update Form -->
<form action="{{ route('admin.page-access.bulk-update') }}" method="POST">
    @csrf
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="card-title mb-0 fw-bold">পেজ তালিকা ও অ্যাক্সেস কনফিগারেশন ({{ count($pages) }} টি পেজ)</h5>
                <small class="text-muted">ড্রপডাউন থেকে পরিবর্তন করে নিচে "সকল পরিবর্তন সংরক্ষণ করুন" বাটনে ক্লিক করুন।</small>
            </div>
            <button type="submit" class="btn btn-success btn-sm px-3 shadow-sm">
                <i class="fas fa-save me-1"></i> সকল পরিবর্তন সংরক্ষণ করুন
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-pages mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">ক্রম</th>
                            <th>পেজের বিবরণ ও বিভাগ</th>
                            <th>ইউআরএল / রুট প্যাটার্ন</th>
                            <th style="min-width: 220px;">প্রবেশাধিকার স্তর (Access Level)</th>
                            <th class="text-center" style="width: 100px;">স্ট্যাটাস</th>
                            <th class="text-end" style="width: 120px;">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pages as $index => $page)
                            <tr>
                                <td class="text-muted fw-bold">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $page->page_name }}</div>
                                    <span class="badge bg-light text-secondary border font-xs">
                                        <i class="fas fa-folder me-1"></i> {{ $page->page_category }}
                                    </span>
                                    @if($page->custom_message)
                                        <span class="text-muted font-xs d-block mt-1" title="কাস্টম বার্তা">
                                            <i class="fas fa-comment-alt text-warning me-1"></i> {{ Str::limit($page->custom_message, 45) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <code class="text-primary font-xs">{{ $page->route_pattern }}</code>
                                    @if($page->route_name)
                                        <small class="text-muted d-block font-xs">রুট: {{ $page->route_name }}</small>
                                    @endif
                                </td>
                                <td>
                                    <select name="levels[{{ $page->id }}]" class="form-select form-select-sm select-access-level">
                                        @foreach($accessLevels as $lvlKey => $lvlInfo)
                                            <option value="{{ $lvlKey }}" {{ $page->access_level === $lvlKey ? 'selected' : '' }}>
                                                {{ $lvlInfo['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    @if($page->is_active)
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">সক্রিয়</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border px-2 py-1">নিষ্ক্রিয়</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $page->id }}" title="বিস্তারিত সম্পাদনা">
                                        <i class="fas fa-sliders-h"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $page->id }}" title="মুছুন">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    কোনো পেজ পাওয়া যায়নি।
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
            <span class="text-muted font-sm">মোট {{ count($pages) }} টি পেজের কনফিগারেশন প্রদর্শিত হচ্ছে।</span>
            <button type="submit" class="btn btn-success px-4 shadow-sm">
                <i class="fas fa-save me-1"></i> সকল পরিবর্তন সংরক্ষণ করুন
            </button>
        </div>
    </div>
</form>

<!-- Edit Modals for each page -->
@foreach($pages as $page)
<div class="modal fade" id="editModal{{ $page->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('admin.page-access.update', $page->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header bg-light">
                    <h5 class="modal-title fs-6 fw-bold">
                        <i class="fas fa-edit text-primary me-2"></i> পেজ কনফিগারেশন সম্পাদনা
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">পেজের নাম</label>
                        <input type="text" name="page_name" class="form-control" value="{{ $page->page_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">ক্যাটাগরি / বিভাগ</label>
                        <input type="text" name="page_category" class="form-control" value="{{ $page->page_category }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">প্রবেশাধিকার স্তর (Access Level)</label>
                        <select name="access_level" class="form-select">
                            @foreach($accessLevels as $lvlKey => $lvlInfo)
                                <option value="{{ $lvlKey }}" {{ $page->access_level === $lvlKey ? 'selected' : '' }}>
                                    {{ $lvlInfo['label'] }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted d-block mt-1">লগইন আবশ্যক নির্বাচন করলে গেস্টরা এই পেজ দেখতে পারবে না।</small>
                    </div>

                    <!-- Custom Roles (if custom selected) -->
                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">অনুমোদিত রোলসমূহ (কাস্টম নির্বাচিত রোলের জন্য)</label>
                        <div class="row g-2 border rounded p-2 bg-light">
                            @foreach($userRoles as $rKey => $rLabel)
                                <div class="col-6">
                                    <div class="form-check font-sm">
                                        <input class="form-check-input" type="checkbox" name="allowed_roles[]" value="{{ $rKey }}" id="role_{{ $page->id }}_{{ $rKey }}" 
                                            {{ is_array($page->allowed_roles) && in_array($rKey, $page->allowed_roles) ? 'checked' : '' }}>
                                        <label class="form-check-label font-xs" for="role_{{ $page->id }}_{{ $rKey }}">
                                            {{ $rLabel }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">গেস্টদের জন্য প্রদর্শনযোগ্য কাস্টম নোটিশ (ঐচ্ছিক)</label>
                        <textarea name="custom_message" class="form-control" rows="2" placeholder="লগইন করতে বলার জন্য নিজস্ব বার্তা লিখুন...">{{ $page->custom_message }}</textarea>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="activeSwitch{{ $page->id }}" value="1" {{ $page->is_active ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold font-sm" for="activeSwitch{{ $page->id }}">
                            এই পেজের প্রবেশাধিকার নিয়ন্ত্রণ সক্রিয় রাখুন
                        </label>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal{{ $page->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('admin.page-access.destroy', $page->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center p-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                    <h6 class="fw-bold">আপনি কি নিশ্চিত?</h6>
                    <p class="text-muted font-sm mb-3">"{{ $page->page_name }}" পেজের নিয়ন্ত্রণ মুছে ফেলতে চান?</p>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-sm btn-light border" data-bs-dismiss="modal">না</button>
                        <button type="submit" class="btn btn-sm btn-danger px-3">হ্যাঁ, মুছুন</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Add New Page Modal -->
<div class="modal fade" id="addPageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('admin.page-access.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-light">
                    <h5 class="modal-title fs-6 fw-bold">
                        <i class="fas fa-plus-circle text-success me-2"></i> নতুন পেজ প্রবেশাধিকার যোগ করুন
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">পেজ কি (Unique Key)</label>
                        <input type="text" name="page_key" class="form-control" placeholder="যেমন: research.paper" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">পেজের শিরোনাম / নাম</label>
                        <input type="text" name="page_name" class="form-control" placeholder="যেমন: গবেষণা গবেষণাপত্র ভিউয়ার" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">ক্যাটাগরি / বিভাগ</label>
                        <input type="text" name="page_category" class="form-control" placeholder="যেমন: প্রকাশনা / গবেষণা" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">ইউআরএল প্যাটার্ন (URL Pattern)</label>
                        <input type="text" name="route_pattern" class="form-control" placeholder="যেমন: research/paper/*" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">প্রবেশাধিকার স্তর (Access Level)</label>
                        <select name="access_level" class="form-select" required>
                            @foreach($accessLevels as $lvlKey => $lvlInfo)
                                <option value="{{ $lvlKey }}">{{ $lvlInfo['label'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">গেস্টদের জন্য প্রদর্শনযোগ্য কাস্টম নোটিশ (ঐচ্ছিক)</label>
                        <textarea name="custom_message" class="form-control" rows="2" placeholder="লগইন করতে বলার জন্য নিজস্ব বার্তা..."></textarea>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="newActiveSwitch" value="1" checked>
                        <label class="form-check-label fw-bold font-sm" for="newActiveSwitch">
                            নিয়ন্ত্রণ অবিলম্বে সক্রিয় করুন
                        </label>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-success btn-sm px-4">সংরক্ষণ করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
