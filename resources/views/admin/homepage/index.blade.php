@extends('admin.layouts.app')

@section('title', 'হোমপেজ সেকশন ও লেআউট কন্ট্রোলার')

@push('styles')
<style>
    .section-card {
        transition: all 0.25s ease;
        border: 1px solid rgba(0, 0, 0, 0.08);
        background: #fff;
    }
    .section-card:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }
    .section-card.is-disabled {
        opacity: 0.72;
        background: #f8fafc;
        border-style: dashed;
    }
    .drag-handle {
        cursor: grab;
        color: #94a3b8;
        padding: 6px 10px;
        border-radius: 6px;
        transition: color 0.15s ease;
    }
    .drag-handle:hover {
        color: #0C4B36;
        background: rgba(12, 75, 54, 0.08);
    }
    .order-badge {
        width: 32px;
        height: 32px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #0C4B36;
        color: #fff;
    }
    .btn-order-move {
        width: 30px;
        height: 30px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-size: 0.75rem;
    }
    .section-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        background: rgba(12, 75, 54, 0.08);
    }
    /* Dark Mode Overrides */
    [data-theme="dark"] .section-card {
        background: #1e293b;
        border-color: #334155;
    }
    [data-theme="dark"] .section-card.is-disabled {
        background: #0f172a;
    }
    [data-theme="dark"] .drag-handle:hover {
        color: #38bdf8;
        background: rgba(56, 189, 248, 0.1);
    }
    [data-theme="dark"] .section-icon-box {
        background: rgba(255, 255, 255, 0.08);
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-3">

    <!-- Top Breadcrumb & Page Header -->
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-decoration-none">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active" aria-current="page">হোমপেজ কন্ট্রোল</li>
                </ol>
            </nav>
            <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                <i class="fas fa-layer-group text-success"></i> হোমপেজ সেকশন ও লেআউট কন্ট্রোলার
            </h1>
            <p class="text-secondary small mb-0">
                মূল ওয়েবসাইটের হোমপেজে কোন সেকশন কোথায় থাকবে, প্রদর্শনের ক্রম, অন/অফ এবং শিরোনাম ও প্রদর্শনের সংখ্যা নিয়ন্ত্রণ করুন।
            </p>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0 d-flex gap-2 justify-content-md-end flex-wrap">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-success">
                <i class="fas fa-external-link-alt me-1"></i> লাইভ সাইট দেখুন
            </a>
            <form action="{{ route('admin.homepage.reset') }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিত যে সকল সেকশনকে ডিফল্ট সাজানো অবস্থানে রিসেট করতে চান?');">
                @csrf
                <button type="submit" class="btn btn-outline-danger" title="ডিফল্ট অবস্থানে ফিরিয়ে নিন">
                    <i class="fas fa-undo me-1"></i> ডিফল্ট রিসেট
                </button>
            </form>
            <button type="submit" form="homepageLayoutForm" class="btn btn-success fw-semibold shadow-sm">
                <i class="fas fa-save me-1"></i> পরিবর্তন সংরক্ষণ করুন
            </button>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Quick Statistics Strip -->
    @php
        $totalSections = $sections->count();
        $activeSections = $sections->where('is_active', true)->count();
        $disabledSections = $totalSections - $activeSections;
    @endphp
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white d-flex flex-row align-items-center justify-content-between">
                <div>
                    <span class="text-secondary small fw-semibold">মোট মডুলার সেকশন</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totalSections }} টি</h3>
                </div>
                <div class="rounded-circle p-3 bg-primary-subtle text-primary">
                    <i class="fas fa-cubes fs-4"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white d-flex flex-row align-items-center justify-content-between">
                <div>
                    <span class="text-secondary small fw-semibold">হোমপেজে সক্রিয় (প্রদর্শিত)</span>
                    <h3 class="fw-bold mb-0 text-success">{{ $activeSections }} টি</h3>
                </div>
                <div class="rounded-circle p-3 bg-success-subtle text-success">
                    <i class="fas fa-eye fs-4"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white d-flex flex-row align-items-center justify-content-between">
                <div>
                    <span class="text-secondary small fw-semibold">লুকানো / নিষ্ক্রিয়</span>
                    <h3 class="fw-bold mb-0 text-danger">{{ $disabledSections }} টি</h3>
                </div>
                <div class="rounded-circle p-3 bg-danger-subtle text-danger">
                    <i class="fas fa-eye-slash fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Layout Instruction Notice -->
    <div class="alert alert-info border-0 shadow-sm rounded-3 d-flex align-items-center gap-3 mb-4">
        <i class="fas fa-info-circle fs-3 text-info"></i>
        <div class="small">
            <strong>ব্যবহার বিধি:</strong> সেকশনের ক্রম পরিবর্তন করতে <i class="fas fa-arrow-up"></i> বা <i class="fas fa-arrow-down"></i> বোতাম ব্যবহার করুন অথবা সরাসরি ক্রম সংখ্যা টাইপ করুন। যেকোনো সেকশন অন/অফ করতে ডানপাশের সুইচ ব্যবহার করুন। সেকশনের শিরোনাম, সাবটাইটেল বা প্রদর্শনের সীমা পরিবর্তন করতে <strong>"কাস্টমাইজ"</strong> বোতামে ক্লিক করুন। সবশেষে উপরের <strong>"পরিবর্তন সংরক্ষণ করুন"</strong> বোতামে চাপুন।
        </div>
    </div>

    <!-- Main Layout Controller Form -->
    <form action="{{ route('admin.homepage.update') }}" method="POST" id="homepageLayoutForm">
        @csrf

        <div class="d-flex flex-column gap-3" id="sectionsContainer">
            @foreach($sections as $index => $section)
                @php
                    $extra = $section->extra_config ?? [];
                    $icon = $extra['icon'] ?? 'fas fa-layer-group';
                    $color = $extra['color'] ?? 'text-success';
                    $adminRoute = $extra['admin_route'] ?? null;
                    $adminLabel = $extra['admin_label'] ?? null;
                @endphp

                <div class="card section-card rounded-3 shadow-sm {{ $section->is_active ? '' : 'is-disabled' }}" id="section-row-{{ $section->id }}" data-id="{{ $section->id }}">
                    <div class="card-body p-3 p-md-4">
                        <div class="row align-items-center gy-3">
                            
                            <!-- Col 1: Order Controls & Drag Handle -->
                            <div class="col-auto d-flex align-items-center gap-2">
                                <span class="drag-handle d-none d-md-inline-block" title="ড্র্যাগ করুন">
                                    <i class="fas fa-grip-vertical"></i>
                                </span>
                                <div class="d-flex flex-column gap-1">
                                    <button type="button" class="btn btn-sm btn-light border btn-order-move btn-move-up" title="উপরে তুলুন">
                                        <i class="fas fa-chevron-up"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light border btn-order-move btn-move-down" title="নিচে নামান">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="text-center">
                                    <span class="order-badge order-display-number">{{ $section->order }}</span>
                                    <input type="hidden" name="sections[{{ $section->id }}][order]" class="order-input" value="{{ $section->order }}">
                                </div>
                            </div>

                            <!-- Col 2: Section Icon & Name -->
                            <div class="col-md-5 col-12 d-flex align-items-center gap-3">
                                <div class="section-icon-box {{ $color }}">
                                    <i class="{{ $icon }}"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <h5 class="fw-bold mb-0 text-dark fs-6">{{ $section->name_bn }}</h5>
                                        <code class="text-muted font-xs">{{ $section->section_key }}</code>
                                    </div>
                                    <p class="text-secondary small mb-0 text-truncate" style="max-width: 380px;">
                                        {{ $section->subtitle ?: ($section->title ?: 'স্বাভাবিক কনটেন্ট লেআউট') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Col 3: Quick Admin Module Link -->
                            <div class="col-md-2 col-6 text-md-center">
                                @if($adminRoute && \Illuminate\Support\Facades\Route::has($adminRoute))
                                    <a href="{{ route($adminRoute) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 font-xs" target="_blank" title="এই সেকশনের উপাত্ত পরিচালনা করুন">
                                        <i class="fas fa-external-link-alt me-1"></i> {{ $adminLabel ?: 'কনটেন্ট নিয়ন্ত্রণ' }}
                                    </a>
                                @else
                                    <span class="badge bg-light text-secondary border font-xs">হোমপেজ মডিউল</span>
                                @endif
                            </div>

                            <!-- Col 4: Visibility Toggle Switch & Customize Accordion Trigger -->
                            <div class="col-md-4 col-12 d-flex align-items-center justify-content-end gap-3">
                                <button type="button" class="btn btn-sm btn-light border rounded-pill px-3 text-secondary" data-bs-toggle="collapse" data-bs-target="#customizeCollapse{{ $section->id }}" aria-expanded="false">
                                    <i class="fas fa-sliders-h me-1 text-primary"></i> কাস্টমাইজ <i class="fas fa-chevron-down font-xs ms-1"></i>
                                </button>

                                <div class="form-check form-switch m-0 d-flex align-items-center gap-2">
                                    <input class="form-check-input section-toggle-switch" type="checkbox" role="switch" 
                                           id="switch_{{ $section->id }}" 
                                           name="sections[{{ $section->id }}][is_active]" 
                                           value="1" 
                                           {{ $section->is_active ? 'checked' : '' }}
                                           style="width: 2.75rem; height: 1.45rem; cursor: pointer;">
                                    <label class="form-check-label fw-bold small toggle-label text-{{ $section->is_active ? 'success' : 'muted' }}" for="switch_{{ $section->id }}">
                                        {{ $section->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Collapsible Customization Options for this section -->
                        <div class="collapse mt-3 pt-3 border-top" id="customizeCollapse{{ $section->id }}">
                            <div class="p-3 bg-light rounded-3 border">
                                <div class="row g-3">
                                    <!-- Title -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold small text-dark">সেকশন মূল শিরোনাম (Title)</label>
                                        <input type="text" name="sections[{{ $section->id }}][title]" class="form-control form-control-sm" value="{{ $section->title }}" placeholder="শিরোনাম দিন...">
                                    </div>

                                    <!-- Badge Text -->
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold small text-dark">টপ ব্যাজ টেক্সট (Badge)</label>
                                        <input type="text" name="sections[{{ $section->id }}][badge_text]" class="form-control form-control-sm" value="{{ $section->badge_text }}" placeholder="উদাঃ তাত্ত্বিক ও গবেষণামূলক">
                                    </div>

                                    <!-- Item Limit (if applicable) -->
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold small text-dark">প্রদর্শনের সংখ্যা (Item Limit)</label>
                                        <input type="number" name="sections[{{ $section->id }}][item_limit]" class="form-control form-control-sm" value="{{ $section->item_limit }}" min="1" max="24">
                                        <span class="font-xs text-muted">হোমপেজে সর্বোচ্চ কতটি আইটেম দৃশ্যমান হবে</span>
                                    </div>

                                    <!-- Subtitle -->
                                    <div class="col-12">
                                        <label class="form-label fw-semibold small text-dark">উপ-শিরোনাম / বিবরণ (Subtitle)</label>
                                        <input type="text" name="sections[{{ $section->id }}][subtitle]" class="form-control form-control-sm" value="{{ $section->subtitle }}" placeholder="সেকশনের সংক্ষিপ্ত বিবরণ বা উপ-শিরোনাম...">
                                    </div>

                                    <!-- Specific Extra Fields for Stats Section -->
                                    @if($section->section_key === 'quick_stats')
                                        <div class="col-12 border-top pt-3 mt-3">
                                            <h6 class="fw-bold text-dark small mb-2"><i class="fas fa-chart-pie me-1 text-success"></i> ৪টি কাউন্টার পরিসংখ্যানের উপাত্ত পরিবর্তন:</h6>
                                            <div class="row g-2">
                                                <div class="col-md-3 col-6">
                                                    <label class="form-label font-xs text-muted mb-1">কাউন্টার ১ সংখ্যা</label>
                                                    <input type="text" name="sections[{{ $section->id }}][extra][stat1_num]" class="form-control form-control-sm" value="{{ $extra['stat1_num'] ?? '৬৪+' }}">
                                                    <label class="form-label font-xs text-muted mb-1 mt-1">লেবেল</label>
                                                    <input type="text" name="sections[{{ $section->id }}][extra][stat1_label]" class="form-control form-control-sm" value="{{ $extra['stat1_label'] ?? 'জেলা ও উপজেলা শাখা' }}">
                                                </div>
                                                <div class="col-md-3 col-6">
                                                    <label class="form-label font-xs text-muted mb-1">কাউন্টার ২ সংখ্যা</label>
                                                    <input type="text" name="sections[{{ $section->id }}][extra][stat2_num]" class="form-control form-control-sm" value="{{ $extra['stat2_num'] ?? '১০,০০০+' }}">
                                                    <label class="form-label font-xs text-muted mb-1 mt-1">লেবেল</label>
                                                    <input type="text" name="sections[{{ $section->id }}][extra][stat2_label]" class="form-control form-control-sm" value="{{ $extra['stat2_label'] ?? 'যুব সদস্য ও কর্মী' }}">
                                                </div>
                                                <div class="col-md-3 col-6">
                                                    <label class="form-label font-xs text-muted mb-1">কাউন্টার ৩ সংখ্যা</label>
                                                    <input type="text" name="sections[{{ $section->id }}][extra][stat3_num]" class="form-control form-control-sm" value="{{ $extra['stat3_num'] ?? '১৭+' }}">
                                                    <label class="form-label font-xs text-muted mb-1 mt-1">লেবেল</label>
                                                    <input type="text" name="sections[{{ $section->id }}][extra][stat3_label]" class="form-control form-control-sm" value="{{ $extra['stat3_label'] ?? 'প্রকাশিত গ্রন্থ ও পত্রিকা' }}">
                                                </div>
                                                <div class="col-md-3 col-6">
                                                    <label class="form-label font-xs text-muted mb-1">কাউন্টার ৪ সংখ্যা</label>
                                                    <input type="text" name="sections[{{ $section->id }}][extra][stat4_num]" class="form-control form-control-sm" value="{{ $extra['stat4_num'] ?? '৪ স্তর' }}">
                                                    <label class="form-label font-xs text-muted mb-1 mt-1">লেবেল</label>
                                                    <input type="text" name="sections[{{ $section->id }}][extra][stat4_label]" class="form-control form-control-sm" value="{{ $extra['stat4_label'] ?? 'ধারাবাহিক যুব প্রশিক্ষণ' }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Specific Extra Fields for Core Mission Section -->
                                    @if($section->section_key === 'core_mission')
                                        <div class="col-12 border-top pt-3 mt-3">
                                            <label class="form-label fw-semibold small text-dark"><i class="fas fa-bullseye me-1 text-warning"></i> মূল লক্ষ্য হাইলাইট টেক্সট (Motto)</label>
                                            <textarea name="sections[{{ $section->id }}][extra][motto]" class="form-control form-control-sm" rows="2">{{ $extra['motto'] ?? 'কালেমা "লা- ইলাহা ইল্লাল্লাহু মুহাম্মাদুর রাসূলুল্লাহ"-কে যথাযথ উপলব্ধি করত জীবনের সর্বস্তরে কুরআন ও সুন্নাহর বিধান প্রতিষ্ঠার মাধ্যমে আল্লাহর সন্তুষ্টি অর্জন।' }}</textarea>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <!-- Sticky Footer Save Actions -->
        <div class="card border-0 shadow-lg rounded-3 p-3 bg-white mt-4 sticky-bottom" style="z-index: 10;">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2 text-secondary small">
                    <i class="fas fa-check-double text-success"></i> ক্রম ও পরিবর্তনের পর সংরক্ষণ করতে ভুলবেন না
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-light border px-4">বাতিল</a>
                    <button type="submit" class="btn btn-success fw-bold px-4 shadow-sm">
                        <i class="fas fa-save me-1"></i> পরিবর্তন সংরক্ষণ করুন
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('sectionsContainer');

    function refreshOrderNumbers() {
        const rows = container.querySelectorAll('.section-card');
        rows.forEach((row, idx) => {
            const newOrder = idx + 1;
            const badge = row.querySelector('.order-display-number');
            const input = row.querySelector('.order-input');
            if (badge) badge.textContent = newOrder;
            if (input) input.value = newOrder;
        });
    }

    // Move Up
    container.addEventListener('click', function (e) {
        const btnUp = e.target.closest('.btn-move-up');
        if (btnUp) {
            const card = btnUp.closest('.section-card');
            const prev = card.previousElementSibling;
            if (prev) {
                container.insertBefore(card, prev);
                refreshOrderNumbers();
                card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }
    });

    // Move Down
    container.addEventListener('click', function (e) {
        const btnDown = e.target.closest('.btn-move-down');
        if (btnDown) {
            const card = btnDown.closest('.section-card');
            const next = card.nextElementSibling;
            if (next) {
                container.insertBefore(next, card);
                refreshOrderNumbers();
                card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }
    });

    // Interactive Switch Toggle Styling
    container.addEventListener('change', function (e) {
        if (e.target.classList.contains('section-toggle-switch')) {
            const card = e.target.closest('.section-card');
            const label = card.querySelector('.toggle-label');
            if (e.target.checked) {
                card.classList.remove('is-disabled');
                if (label) {
                    label.textContent = 'সক্রিয়';
                    label.classList.remove('text-muted');
                    label.classList.add('text-success');
                }
            } else {
                card.classList.add('is-disabled');
                if (label) {
                    label.textContent = 'নিষ্ক্রিয়';
                    label.classList.remove('text-success');
                    label.classList.add('text-muted');
                }
            }
        }
    });
});
</script>
@endpush
