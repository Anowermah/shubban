@extends('admin.layouts.app')

@section('title', 'কর্মী মানোন্নয়ন ও স্তর পরিবর্তন আবেদন')

@section('content')
<div class="pt-3 pb-2 mb-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold mb-1 text-dark">
            <i class="fas fa-layer-group text-warning me-2"></i> কর্মী মানোন্নয়ন ও স্তর পরিবর্তন আবেদন
        </h1>
        <p class="text-muted font-sm mb-0">রাগেব, আরেফ, সালেক ও সালেহ স্তরে পদোন্নতির জন্য কর্মীদের জমাকৃত আবেদন ও মূল্যায়ন বোর্ড।</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-warning bg-opacity-15 p-3 text-warning">
                    <i class="fas fa-hourglass-half fa-lg"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">{{ $stats['pending'] }} টি</h4>
                    <small class="text-muted">অপেক্ষমাণ আবেদন</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 text-success">
                    <i class="fas fa-user-check fa-lg"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">{{ $stats['approved'] }} জন</h4>
                    <small class="text-muted">পদোন্নতিপ্রাপ্ত কর্মী</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-light p-3 text-dark">
                    <i class="fas fa-users-cog fa-lg"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">{{ $stats['total'] }} টি</h4>
                    <small class="text-muted">মোট দাখিলকৃত আবেদন</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>আবেদনের তারিখ</th>
                        <th>কর্মীর নাম ও বর্তমান স্তর</th>
                        <th>কাঙ্ক্ষিত স্তর (Target Tier)</th>
                        <th>সিলেবাস সমাপ্তি</th>
                        <th>পঠিত কিতাব ও বিষয়</th>
                        <th>স্ট্যাটাস</th>
                        <th class="text-end">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($promotions as $promo)
                        <tr>
                            <td>{{ $promo->created_at->format('d M, Y') }}</td>
                            <td>
                                <div class="fw-bold">{{ $promo->user->name ?? 'N/A' }}</div>
                                <span class="badge bg-secondary font-xs">{{ $promo->current_tier_label }}</span>
                                <small class="text-muted d-block font-xs">{{ $promo->user->branch_name ?? '' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-success font-xs">{{ $promo->target_tier_label }}</span>
                            </td>
                            <td>
                                @if($promo->syllabus_completed)
                                    <span class="badge bg-success bg-opacity-10 text-success"><i class="fas fa-check-circle me-1"></i> সমাপ্ত ঘোষিত</span>
                                @else
                                    <span class="badge bg-secondary">অসমাপ্ত</span>
                                @endif
                            </td>
                            <td>
                                <div class="font-sm" style="max-width: 250px;">
                                    {{ Str::limit($promo->books_read, 70) }}
                                </div>
                            </td>
                            <td>{!! $promo->status_badge !!}</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $promo->id }}">
                                    <i class="fas fa-tasks me-1"></i> পর্যালোচনা ও অনুমোদন
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">কোনো মানোন্নয়ন আবেদন পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($promotions->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $promotions->links() }}
        </div>
    @endif
</div>

<!-- Review Modals -->
@foreach($promotions as $promo)
<div class="modal fade" id="reviewModal{{ $promo->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('admin.organization.promotions.status', $promo->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header bg-light">
                    <h5 class="modal-title fs-6 fw-bold">
                        <i class="fas fa-user-graduate text-warning me-2"></i> পদোন্নতি আবেদন মূল্যায়ন
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="p-3 mb-3 rounded bg-light border">
                        <div class="fw-bold">{{ $promo->user->name ?? 'N/A' }}</div>
                        <small class="text-muted d-block">{{ $promo->user->email ?? '' }} | {{ $promo->user->branch_name ?? '' }}</small>
                        <div class="mt-2 d-flex gap-2">
                            <span class="badge bg-secondary">বর্তমান: {{ $promo->current_tier_label }}</span>
                            <i class="fas fa-arrow-right text-muted align-self-center"></i>
                            <span class="badge bg-success">আবেদনকৃত: {{ $promo->target_tier_label }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted font-xs d-block mb-1">পঠিত কিতাব ও বিষয়সমূহ:</label>
                        <div class="p-2 bg-light rounded border font-sm" style="white-space: pre-line;">
                            {{ $promo->books_read }}
                        </div>
                    </div>

                    @if($promo->applicant_notes)
                        <div class="mb-3">
                            <label class="text-muted font-xs d-block mb-1">কর্মীর বক্তব্য / অনুভূতি:</label>
                            <p class="font-sm mb-0 p-2 bg-light rounded border">{{ $promo->applicant_notes }}</p>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">বোর্ডের সিদ্ধান্ত</label>
                        <select name="status" class="form-select" required>
                            <option value="approved" {{ $promo->status === 'approved' ? 'selected' : '' }}>পদোন্নতি অনুমোদন করুন (Promote to {{ $promo->target_tier_label }})</option>
                            <option value="pending" {{ $promo->status === 'pending' ? 'selected' : '' }}>বিচারাধীন রাখুন</option>
                            <option value="rejected" {{ $promo->status === 'rejected' ? 'selected' : '' }}>পুনঃমূল্যায়ন / বাতিল</option>
                        </select>
                        <small class="text-success d-block mt-1 font-xs">
                            <i class="fas fa-info-circle me-1"></i> অনুমোদন দিলে কর্মীর প্রোফাইল ও ড্যাশবোর্ডে নতুন স্তরের সিলেবাস ও অধিকার অবিলম্বে সক্রিয় হবে।
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold font-sm">বোর্ডের মূল্যায়ন মন্তব্য</label>
                        <textarea name="admin_notes" class="form-control" rows="2" placeholder="মতামত বা উপদেশ লিখুন...">{{ $promo->admin_notes }}</textarea>
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
