@extends('admin.layouts.app')

@section('title', 'শাখা ও কর্মসূচি প্রতিবেদন')

@section('content')
<div class="pt-3 pb-2 mb-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold mb-1 text-dark">
            <i class="fas fa-file-signature text-info me-2"></i> শাখা ও কর্মসূচি প্রতিবেদন
        </h1>
        <p class="text-muted font-sm mb-0">সারাদেশের শাখা, উপজেলা ও জেলা থেকে দায়িত্বশীলদের পাঠানো দাওয়াতী ও সাংগঠনিক প্রতিবেদনের খতিয়ান।</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Reports Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>তারিখ</th>
                        <th>শাখা / ইউনিট</th>
                        <th>প্রোগ্রামের নাম ও ধরন</th>
                        <th>উপস্থিতি</th>
                        <th>রিপোর্ট প্রদানকারী</th>
                        <th>স্ট্যাটাস</th>
                        <th class="text-end">মূল্যায়ন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $rep)
                        <tr>
                            <td>{{ $rep->date ? $rep->date->format('d M, Y') : 'N/A' }}</td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $rep->org_tier_label }}</span>
                                <div class="fw-bold font-sm mt-1">{{ $rep->branch_name ?? 'শাখা' }}</div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $rep->title }}</div>
                                <small class="text-muted"><i class="fas fa-tag me-1 text-primary"></i> {{ $rep->program_type }}</small>
                                @if($rep->venue)
                                    <small class="text-muted d-block"><i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $rep->venue }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success">কর্মী: {{ $rep->worker_attendance }}</span>
                                <span class="badge bg-primary bg-opacity-10 text-primary">সুধী: {{ $rep->guest_attendance }}</span>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $rep->user->name ?? 'N/A' }}</div>
                                <small class="text-muted">{{ $rep->user->designation ?? 'কর্মী' }}</small>
                            </td>
                            <td>{!! $rep->status_badge !!}</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewReportModal{{ $rep->id }}">
                                    <i class="fas fa-eye me-1"></i> দেখুন ও মন্তব্য
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">কোনো প্রতিবেদন পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($reports->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $reports->links() }}
        </div>
    @endif
</div>

<!-- Report Detail Modals -->
@foreach($reports as $rep)
<div class="modal fade" id="viewReportModal{{ $rep->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('admin.organization.reports.status', $rep->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header bg-light">
                    <h5 class="modal-title fs-6 fw-bold">
                        <i class="fas fa-file-alt text-info me-2"></i> কর্মসূচি প্রতিবেদন বিস্তারিত
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3 pb-3 border-bottom">
                        <div class="col-md-6">
                            <label class="text-muted font-xs d-block">কর্মসূচির শিরোনাম:</label>
                            <h6 class="fw-bold mb-0">{{ $rep->title }}</h6>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted font-xs d-block">তারিখ:</label>
                            <span class="fw-semibold">{{ $rep->date ? $rep->date->format('d F, Y') : '' }}</span>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted font-xs d-block">শাখা / ইউনিট:</label>
                            <span class="badge bg-secondary">{{ $rep->branch_name }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted font-xs d-block mb-1">বিস্তারিত বিবরণ ও গৃহীত সিদ্ধান্তসমূহ:</label>
                        <div class="p-3 bg-light rounded border font-sm" style="white-space: pre-line;">
                            {{ $rep->description }}
                        </div>
                    </div>

                    @if($rep->attachment)
                        <div class="mb-3">
                            <label class="text-muted font-xs d-block mb-1">সংযুক্ত ডকুমেন্ট / ছবি:</label>
                            <a href="{{ asset('storage/' . $rep->attachment) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-paperclip me-1"></i> সংযুক্তি ডাউনলোড / দেখুন
                            </a>
                        </div>
                    @endif

                    <div class="row g-3 pt-3 border-top">
                        <div class="col-md-4">
                            <label class="form-label fw-bold font-sm">প্রতিবেদন স্ট্যাটাস</label>
                            <select name="status" class="form-select">
                                <option value="submitted" {{ $rep->status === 'submitted' ? 'selected' : '' }}>জমাকৃত</option>
                                <option value="under_review" {{ $rep->status === 'under_review' ? 'selected' : '' }}>মূল্যায়নাধীন</option>
                                <option value="approved" {{ $rep->status === 'approved' ? 'selected' : '' }}>অনুমোদিত</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-bold font-sm">কেন্দ্রীয় পরামর্শ / ফিডব্যাক</label>
                            <input type="text" name="admin_feedback" class="form-control" value="{{ $rep->admin_feedback }}" placeholder="শাখার জন্য কেন্দ্রীয় নির্দেশনা বা মন্তব্য লিখুন...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">বন্ধ করুন</button>
                    <button type="submit" class="btn btn-success btn-sm px-4">সংরক্ষণ করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
