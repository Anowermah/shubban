@extends('admin.layouts.app')

@section('title', 'মাসিক এয়ানত আদায় ও খতিয়ান')

@section('content')
<div class="pt-3 pb-2 mb-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold mb-1 text-dark">
            <i class="fas fa-hand-holding-usd text-success me-2"></i> মাসিক এয়ানত আদায় ও অনুমোদন
        </h1>
        <p class="text-muted font-sm mb-0">সারাদেশের দায়িত্বশীল ও কর্মীদের পরিশোধিত মাসিক সাংগঠনিক এয়ানতের খতিয়ান।</p>
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
                <div class="rounded-circle bg-success bg-opacity-10 p-3 text-success">
                    <i class="fas fa-wallet fa-lg"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">৳ {{ number_format($stats['total_approved'], 2) }}</h4>
                    <small class="text-muted">মোট অনুমোদিত এয়ানত</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-warning bg-opacity-15 p-3 text-warning">
                    <i class="fas fa-hourglass-half fa-lg"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">{{ $stats['pending_count'] }} টি</h4>
                    <small class="text-muted">অপেক্ষমাণ / নতুন এয়ানত</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-light p-3 text-dark">
                    <i class="fas fa-receipt fa-lg"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">{{ $stats['total_count'] }} টি</h4>
                    <small class="text-muted">মোট দাখিলকৃত কিস্তি</small>
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
                        <th>রসিদ নং</th>
                        <th>কর্মী / দায়িত্বশীল</th>
                        <th>মাস</th>
                        <th>পরিমাণ</th>
                        <th>পদ্ধতি ও ট্রানজেকশন</th>
                        <th>স্ট্যাটাস</th>
                        <th class="text-end">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($iyanats as $iyn)
                        <tr>
                            <td><code>{{ $iyn->receipt_no }}</code></td>
                            <td>
                                <div class="fw-bold">{{ $iyn->user->name ?? 'N/A' }}</div>
                                <small class="text-muted">{{ $iyn->user->email ?? '' }}</small>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $iyn->month }}</span></td>
                            <td class="fw-bold text-success">৳ {{ number_format($iyn->amount, 2) }}</td>
                            <td>
                                <div>{{ $iyn->payment_method_label }}</div>
                                @if($iyn->transaction_id)
                                    <small class="text-muted">Trx: <code>{{ $iyn->transaction_id }}</code></small>
                                @endif
                            </td>
                            <td>{!! $iyn->status_badge !!}</td>
                            <td class="text-end">
                                @if($iyn->status === 'pending')
                                    <form action="{{ route('admin.organization.iyanats.status', $iyn->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-sm btn-success px-2 py-1" title="অনুমোদন করুন">
                                            <i class="fas fa-check me-1"></i> অনুমোদন
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.organization.iyanats.status', $iyn->id) }}" method="POST" class="d-inline ms-1">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-2 py-1" title="বাতিল করুন">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.organization.iyanats.status', $iyn->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                            <option value="approved" {{ $iyn->status === 'approved' ? 'selected' : '' }}>অনুমোদিত</option>
                                            <option value="pending" {{ $iyn->status === 'pending' ? 'selected' : '' }}>পর্যালোচনায়</option>
                                            <option value="rejected" {{ $iyn->status === 'rejected' ? 'selected' : '' }}>প্রত্যাখ্যাত</option>
                                        </select>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">কোনো এয়ানত রেকর্ড পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($iyanats->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $iyanats->links() }}
        </div>
    @endif
</div>
@endsection
