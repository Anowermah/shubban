@extends('admin.layouts.app')

@section('title', 'অ্যাডমিন ড্যাশবোর্ড')

@section('content')
<div class="container-fluid px-0">
    <!-- 1. Modern Welcome Hero Card -->
    <div class="dashboard-welcome-hero">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill">
                        <i class="fas fa-shield-alt me-1"></i> শুব্বান অ্যাডমিন কন্ট্রোল সেন্টার
                    </span>
                    <span class="text-white-50 small">
                        <i class="far fa-calendar-alt text-warning me-1"></i>
                        {{ \Carbon\Carbon::now()->isoFormat('LL') }}
                    </span>
                </div>
                <h1 class="h3 fw-bold text-white mb-2">
                    স্বাগতম, {{ Auth::guard('admin')->user()->name ?? 'সম্মানিত অ্যাডমিনিস্ট্রেটর' }}!
                </h1>
                <p class="hero-quote mb-3">
                    "হে আমাদের প্রতিপালক! আমাদের জ্ঞান বৃদ্ধি করে দিন।" — (সূরা ত্বা-হা: ১১৪)
                </p>

                <!-- Quick Action Shortcuts -->
                <div class="quick-action-strip">
                    <a href="{{ route('admin.donations.create') }}" class="quick-action-btn">
                        <i class="fas fa-hand-holding-usd text-warning"></i> নতুন দান এন্ট্রি
                    </a>
                    <a href="{{ route('admin.notices.create') }}" class="quick-action-btn">
                        <i class="fas fa-bullhorn text-info"></i> নতুন নোটিশ
                    </a>
                    <a href="{{ route('admin.news.create') }}" class="quick-action-btn">
                        <i class="fas fa-newspaper text-success"></i> নতুন সংবাদ
                    </a>
                    <a href="{{ route('admin.publications.books.create') }}" class="quick-action-btn">
                        <i class="fas fa-book text-warning"></i> নতুন বই
                    </a>
                    <a href="{{ route('admin.organization.promotions') }}" class="quick-action-btn">
                        <i class="fas fa-layer-group text-danger"></i> মানোন্নয়ন আবেদন
                    </a>
                    <a href="{{ route('admin.media.index') }}" class="quick-action-btn">
                        <i class="fas fa-photo-video text-warning"></i> মিডিয়া ম্যানেজার
                    </a>
                    <a href="{{ route('admin.homepage.index') }}" class="quick-action-btn">
                        <i class="fas fa-layer-group text-success"></i> হোমপেজ কন্ট্রোল
                    </a>
                    <a href="{{ route('admin.ai-chat.index') }}" class="quick-action-btn">
                        <i class="fas fa-robot text-info"></i> এআই সহকারী
                    </a>
                    <a href="{{ route('admin.pwa.index') }}" class="quick-action-btn">
                        <i class="fas fa-mobile-alt text-warning"></i> পিডব্লিউএ কন্ট্রোল
                    </a>
                </div>
            </div>

            <!-- Quick Pending Counter Box (Desktop & Tablet) -->
            <div class="col-lg-4 mt-3 mt-lg-0 text-lg-end">
                <div class="p-3 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-25 d-inline-block text-start w-100" style="max-width: 320px;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-white-50 small fw-bold text-uppercase">অপেক্ষমাণ কার্যক্রম</span>
                        <span class="badge bg-danger rounded-pill">{{ ($stats['donations']['pending'] ?? 0) + ($stats['organization']['promotions_pending'] ?? 0) + ($stats['organization']['reports_submitted'] ?? 0) }} টি</span>
                    </div>
                    <div class="d-flex flex-column gap-1 small">
                        <a href="{{ route('admin.donations.index') }}?status=pending" class="text-white text-decoration-none d-flex justify-content-between">
                            <span><i class="fas fa-hand-holding-usd me-1 text-warning"></i> অনুদান যাচাই:</span>
                            <span class="fw-bold">{{ $stats['donations']['pending'] ?? 0 }} টি</span>
                        </a>
                        <a href="{{ route('admin.organization.promotions') }}" class="text-white text-decoration-none d-flex justify-content-between">
                            <span><i class="fas fa-layer-group me-1 text-info"></i> পদোন্নতি আবেদন:</span>
                            <span class="fw-bold">{{ $stats['organization']['promotions_pending'] ?? 0 }} টি</span>
                        </a>
                        <a href="{{ route('admin.organization.reports') }}" class="text-white text-decoration-none d-flex justify-content-between">
                            <span><i class="fas fa-file-signature me-1 text-success"></i> কর্মসূচি রিপোর্ট:</span>
                            <span class="fw-bold">{{ $stats['organization']['reports_submitted'] ?? 0 }} টি</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Primary KPI Metric Cards (Row 1: Finance & Organization) -->
    <div class="row g-3 mb-4">
        <!-- 1. Total Donations -->
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">মোট অনুদান সংগ্রহ</div>
                        <div class="stat-number text-success">৳{{ number_format($stats['donations']['amount'] ?? 0, 0) }}</div>
                    </div>
                    <div class="stat-icon-wrap success">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                </div>
                <div class="stat-meta d-flex justify-content-between align-items-center text-muted">
                    <span>চলতি মাসে: <strong>৳{{ number_format($stats['donations']['this_month'] ?? 0, 0) }}</strong></span>
                    @if(($stats['donations']['pending'] ?? 0) > 0)
                        <span class="badge bg-warning text-dark">{{ $stats['donations']['pending'] }} পেন্ডিং</span>
                    @else
                        <span class="badge bg-success-subtle text-success">সব যাচাইকৃত</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- 2. Organization Workers & Users -->
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">সংগঠন ও কর্মী</div>
                        <div class="stat-number text-primary">{{ ($stats['users']['total'] ?? 0) + ($stats['members']['total'] ?? 0) }} <span class="fs-6 fw-normal text-muted">জন</span></div>
                    </div>
                    <div class="stat-icon-wrap primary">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-meta text-muted text-truncate" title="সালেহ, সালেক, আরেফ, রাগেব">
                    রাগেব: <strong>{{ $stats['users']['rageb'] ?? 0 }}</strong> | আরেফ: <strong>{{ $stats['users']['aref'] ?? 0 }}</strong> | সালেক: <strong>{{ $stats['users']['salek'] ?? 0 }}</strong> | সালেহ: <strong>{{ $stats['users']['saleh'] ?? 0 }}</strong>
                </div>
            </div>
        </div>

        <!-- 3. Monthly Iyanat -->
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">মাসিক এয়ানত তহবিল</div>
                        <div class="stat-number text-info">৳{{ number_format($stats['organization']['iyanat_total'] ?? 0, 0) }}</div>
                    </div>
                    <div class="stat-icon-wrap info">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
                <div class="stat-meta d-flex justify-content-between align-items-center text-muted">
                    <span>চলতি মাসে আদায়:</span>
                    <strong class="text-dark">৳{{ number_format($stats['organization']['iyanat_this_month'] ?? 0, 0) }}</strong>
                </div>
            </div>
        </div>

        <!-- 4. Approvals & Reviews -->
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">অপেক্ষমাণ আবেদন</div>
                        <div class="stat-number text-warning">{{ ($stats['organization']['promotions_pending'] ?? 0) + ($stats['organization']['reports_submitted'] ?? 0) }} <span class="fs-6 fw-normal text-muted">টি</span></div>
                    </div>
                    <div class="stat-icon-wrap warning">
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>
                <div class="stat-meta d-flex justify-content-between align-items-center text-muted">
                    <span>পদোন্নতি: <strong>{{ $stats['organization']['promotions_pending'] ?? 0 }}</strong></span>
                    <span>প্রতিবেদন: <strong>{{ $stats['organization']['reports_submitted'] ?? 0 }}</strong></span>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Secondary Row: Publications & Website Content -->
    <div class="row g-3 mb-4">
        <!-- Publications -->
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">মাকতাবাহ ও প্রকাশনা</div>
                        <div class="stat-number text-purple">{{ ($stats['publications']['books']['total'] ?? 0) + ($stats['publications']['magazines']['total'] ?? 0) + ($stats['publications']['articles']['total'] ?? 0) }} <span class="fs-6 fw-normal text-muted">আইটেম</span></div>
                    </div>
                    <div class="stat-icon-wrap purple">
                        <i class="fas fa-book-open"></i>
                    </div>
                </div>
                <div class="stat-meta text-muted">
                    বই: <strong>{{ $stats['publications']['books']['total'] ?? 0 }}</strong> | ম্যাগাজিন: <strong>{{ $stats['publications']['magazines']['total'] ?? 0 }}</strong> | প্রবন্ধ: <strong>{{ $stats['publications']['articles']['total'] ?? 0 }}</strong>
                </div>
            </div>
        </div>

        <!-- Notices -->
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">জরুরি নোটিশ</div>
                        <div class="stat-number text-danger">{{ $stats['notices']['total'] ?? 0 }}</div>
                    </div>
                    <div class="stat-icon-wrap danger">
                        <i class="fas fa-bell"></i>
                    </div>
                </div>
                <div class="stat-meta d-flex justify-content-between text-muted">
                    <span>প্রকাশিত নোটিশ: <strong>{{ $stats['notices']['active'] ?? 0 }}</strong> টি</span>
                    <a href="{{ route('admin.notices.index') }}" class="text-decoration-none small text-danger fw-bold">সব নোটিশ &rarr;</a>
                </div>
            </div>
        </div>

        <!-- News & Media -->
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">সংবাদ ও বুলেটিন</div>
                        <div class="stat-number text-info">{{ $stats['news']['total'] ?? 0 }}</div>
                    </div>
                    <div class="stat-icon-wrap info">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
                <div class="stat-meta d-flex justify-content-between text-muted">
                    <span>সক্রিয় সংবাদ: <strong>{{ $stats['news']['active'] ?? 0 }}</strong> টি</span>
                    <a href="{{ route('admin.news.index') }}" class="text-decoration-none small text-info fw-bold">সব সংবাদ &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Contacts -->
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-modern">
                <div class="stat-top-row">
                    <div>
                        <div class="stat-title">যোগাযোগ বার্তা</div>
                        <div class="stat-number text-primary">{{ $stats['contacts']['total'] ?? 0 }}</div>
                    </div>
                    <div class="stat-icon-wrap primary">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                </div>
                <div class="stat-meta d-flex justify-content-between text-muted">
                    @if(($stats['contacts']['unread'] ?? 0) > 0)
                        <span class="text-danger fw-bold"><i class="fas fa-exclamation-circle me-1"></i> {{ $stats['contacts']['unread'] }} টি অপঠিত</span>
                    @else
                        <span class="text-success"><i class="fas fa-check-double me-1"></i> সব পড়া হয়েছে</span>
                    @endif
                    <a href="{{ route('admin.contacts.index') }}" class="text-decoration-none small text-primary fw-bold">ইনবক্স &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Interactive Activity Hub & Management (2 Columns) -->
    <div class="row g-3 mb-4">
        <!-- Left Column: Recent Donations & Hierarchy -->
        <div class="col-lg-8">
            <!-- Recent Donations Table -->
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold"><i class="fas fa-hand-holding-usd text-success me-2"></i>সর্বশেষ অনুদানসমূহ</span>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.donations.create') }}" class="btn btn-sm btn-primary rounded-pill px-2 py-1" style="font-size: 0.8rem;">
                            <i class="fas fa-plus"></i> নতুন দান
                        </a>
                        <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-2 py-1" style="font-size: 0.8rem;">
                            সব খতিয়ান &rarr;
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>রসিদ / দাতা</th>
                                    <th>খাত / ফান্ড</th>
                                    <th>পরিমাণ</th>
                                    <th>মাধ্যম</th>
                                    <th>অবস্থা</th>
                                    <th class="text-end">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentDonations as $donation)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $donation->is_anonymous ? 'গোপন দান (সাদাকাহ)' : ($donation->donor_name ?? 'অজ্ঞাত দাতা') }}</div>
                                            <div class="small text-muted font-monospace">{{ $donation->receipt_no ?? '#' . $donation->id }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">{{ $donation->cause->title ?? ($donation->purpose ?? 'সাধারণ ফান্ড') }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success fs-6">৳{{ number_format($donation->amount, 0) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-secondary text-uppercase">{{ $donation->payment_method ?? 'bKash' }}</span>
                                            @if($donation->trx_id)
                                                <div class="small text-muted font-monospace" style="font-size: 0.72rem;">Trx: {{ Str::limit($donation->trx_id, 10) }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($donation->status === 'approved')
                                                <span class="badge badge-active">অনুমোদিত</span>
                                            @elseif($donation->status === 'pending')
                                                <span class="badge badge-pending">পেন্ডিং</span>
                                            @else
                                                <span class="badge badge-inactive">বাতিল</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.donations.show', $donation->id) }}" class="btn btn-outline-primary py-0 px-2" title="বিস্তারিত দেখুন">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.donations.receipt', $donation->id) }}" target="_blank" class="btn btn-outline-success py-0 px-2" title="রসিদ প্রিন্ট">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">কোনো অনুদান এন্ট্রি পাওয়া যায়নি</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Organizational Structure & Hierarchy -->
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold"><i class="fas fa-sitemap text-primary me-2"></i>সাংগঠনিক স্তর ও দায়িত্বশীলদের খতিয়ান</span>
                    <a href="{{ route('admin.management.central') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1" style="font-size: 0.8rem;">সব দেখুন</a>
                </div>
                <div class="card-body">
                    <div class="row text-center g-2 g-md-3">
                        <div class="col-4 col-md-2">
                            <div class="p-2 p-md-3 rounded-3 bg-light border">
                                <div class="text-muted small fw-bold">কেন্দ্রীয়</div>
                                <div class="h4 fw-bold text-primary mb-0">{{ $stats['management']['central'] ?? 0 }}</div>
                            </div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="p-2 p-md-3 rounded-3 bg-light border">
                                <div class="text-muted small fw-bold">জেলা</div>
                                <div class="h4 fw-bold text-success mb-0">{{ $stats['management']['district'] ?? 0 }}</div>
                            </div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="p-2 p-md-3 rounded-3 bg-light border">
                                <div class="text-muted small fw-bold">উপজেলা</div>
                                <div class="h4 fw-bold text-info mb-0">{{ $stats['management']['upazila'] ?? 0 }}</div>
                            </div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="p-2 p-md-3 rounded-3 bg-light border">
                                <div class="text-muted small fw-bold">থানা</div>
                                <div class="h4 fw-bold text-warning mb-0">{{ $stats['management']['thana'] ?? 0 }}</div>
                            </div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="p-2 p-md-3 rounded-3 bg-light border">
                                <div class="text-muted small fw-bold">শাখা</div>
                                <div class="h4 fw-bold text-secondary mb-0">{{ $stats['management']['branch'] ?? 0 }}</div>
                            </div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="p-2 p-md-3 rounded-3 bg-primary-subtle border border-primary-subtle">
                                <div class="text-primary small fw-bold">মোট দায়িত্বশীল</div>
                                <div class="h4 fw-bold text-primary mb-0">{{ $stats['management']['total'] ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold"><i class="fas fa-calendar-check text-primary me-2"></i>সাম্প্রতিক সাংগঠনিক কার্যক্রম</span>
                    <a href="{{ route('admin.activities.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1" style="font-size: 0.8rem;">সব কার্যক্রম</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>ছবি</th>
                                    <th>শিরোনাম</th>
                                    <th>তারিখ</th>
                                    <th>অবস্থা</th>
                                    <th class="text-end">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activities as $act)
                                    <tr>
                                        <td style="width: 55px;">
                                            @if($act->image)
                                                <img src="{{ asset('storage/' . $act->image) }}" class="rounded" style="width: 48px; height: 36px; object-fit: cover;" alt="{{ $act->title }}">
                                            @else
                                                <div class="bg-light text-center rounded text-muted" style="width: 48px; height: 36px; line-height: 36px;"><i class="fas fa-image"></i></div>
                                            @endif
                                        </td>
                                        <td class="fw-semibold">{{ Str::limit($act->title, 40) }}</td>
                                        <td class="small text-muted">{{ $act->created_at ? $act->created_at->format('d M, Y') : '-' }}</td>
                                        <td>
                                            @if($act->status)
                                                <span class="badge badge-active">সক্রিয়</span>
                                            @else
                                                <span class="badge badge-inactive">নিষ্ক্রিয়</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.activities.edit', $act->id) }}" class="btn btn-sm btn-outline-secondary py-0 px-2" title="এডিট">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">কোনো কার্যক্রম পাওয়া যায়নি</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Approvals, Reports & Training -->
        <div class="col-lg-4">
            <!-- Pending Tier Promotions -->
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold"><i class="fas fa-layer-group text-warning me-2"></i>মানোন্নয়ন আবেদন</span>
                    <a href="{{ route('admin.organization.promotions') }}" class="btn btn-sm btn-outline-warning text-dark py-0 px-2" style="font-size: 0.78rem;">সব আবেদন</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($recentPromotions as $promo)
                        <div class="list-group-item p-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">{{ $promo->user->name ?? 'কর্মী' }}</span>
                                @if($promo->status === 'pending')
                                    <span class="badge bg-warning text-dark">পেন্ডিং</span>
                                @elseif($promo->status === 'approved')
                                    <span class="badge bg-success">অনুমোদিত</span>
                                @else
                                    <span class="badge bg-danger">বাতিল</span>
                                @endif
                            </div>
                            <div class="small text-muted mb-2">
                                বর্তমান স্তর: <span class="fw-semibold text-dark">{{ \App\Models\TierPromotion::getTierLabel($promo->current_tier) }}</span> &rarr; কাঙ্ক্ষিত: <span class="fw-bold text-success">{{ \App\Models\TierPromotion::getTierLabel($promo->target_tier) }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $promo->created_at ? $promo->created_at->diffForHumans() : '' }}</small>
                                <a href="{{ route('admin.organization.promotions') }}" class="btn btn-xs btn-outline-primary py-0 px-2" style="font-size: 0.75rem;">পর্যালোচনা</a>
                            </div>
                        </div>
                    @empty
                        <div class="p-3 text-center text-muted small">কোনো নতুন মানোন্নয়ন আবেদন নেই</div>
                    @endforelse
                </div>
            </div>

            <!-- Program Reports -->
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold"><i class="fas fa-file-signature text-info me-2"></i>কর্মসূচি প্রতিবেদন</span>
                    <a href="{{ route('admin.organization.reports') }}" class="btn btn-sm btn-outline-info py-0 px-2 text-dark" style="font-size: 0.78rem;">সব রিপোর্ট</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($recentReports as $report)
                        <div class="list-group-item p-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">{{ Str::limit($report->program_title, 26) }}</span>
                                @if($report->status === 'submitted')
                                    <span class="badge bg-info text-dark">জমা হয়েছে</span>
                                @elseif($report->status === 'approved')
                                    <span class="badge bg-success">অনুমোদিত</span>
                                @else
                                    <span class="badge bg-secondary">পর্যালোচনায়</span>
                                @endif
                            </div>
                            <div class="small text-muted mb-2">
                                প্রেরক: <strong>{{ $report->user->name ?? 'দায়িত্বশীল' }}</strong> ({{ $report->branch_name ?? 'শাখা' }})
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $report->created_at ? $report->created_at->format('d M, Y') : '' }}</small>
                                <a href="{{ route('admin.organization.reports') }}" class="btn btn-xs btn-outline-info py-0 px-2 text-dark" style="font-size: 0.75rem;">যাচাই করুন</a>
                            </div>
                        </div>
                    @empty
                        <div class="p-3 text-center text-muted small">কোনো নতুন কর্মসূচি প্রতিবেদন নেই</div>
                    @endforelse
                </div>
            </div>

            <!-- Training Shortcuts -->
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold"><i class="fas fa-graduation-cap text-primary me-2"></i>প্রশিক্ষণ কোর্স ও সিলেবাস</span>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.training.aref.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-user-graduate text-primary"></i>
                            <span>আরেফ প্রশিক্ষণ কোর্স</span>
                        </div>
                        <i class="fas fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.training.rageb.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-user-graduate text-success"></i>
                            <span>রাগেব প্রশিক্ষণ কোর্স</span>
                        </div>
                        <i class="fas fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.training.salek.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-user-graduate text-info"></i>
                            <span>সালেক প্রশিক্ষণ কোর্স</span>
                        </div>
                        <i class="fas fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.training.saleh.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-user-graduate text-warning"></i>
                            <span>সালেহ প্রশিক্ষণ কোর্স</span>
                        </div>
                        <i class="fas fa-chevron-right text-muted small"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
