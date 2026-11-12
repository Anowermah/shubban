@extends('admin.layouts.app')

@section('title', 'কার্যক্রম তালিকা')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap pt-2 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-0">
            <i class="fas fa-tasks text-success me-2"></i>কার্যক্রম তালিকা
        </h1>
        <p class="text-muted small mb-0">সংগঠনের চলমান ও ভবিষ্যৎ সকল কার্যক্রমের বিবরণ ও তালিকা</p>
    </div>
    <div class="btn-toolbar mb-0">
        <a href="{{ route('admin.activities.create') }}" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
            <i class="fas fa-plus me-1"></i> নতুন কার্যক্রম যোগ করুন
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-3" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3" style="width: 50px;">ক্রম</th>
                        <th style="width: 60px;">ছবি</th>
                        <th>শিরোনাম</th>
                        <th>বিবরণ</th>
                        <th>স্ট্যাটাস</th>
                        <th class="text-end pe-3" style="width: 110px;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities ?? [] as $activity)
                        <tr>
                            <td class="ps-3 font-monospace text-muted">{{ $loop->iteration }}</td>
                            <td>
                                @if($activity->image)
                                    <img src="{{ asset('storage/' . $activity->image) }}" 
                                         alt="{{ $activity->title }}" 
                                         class="rounded-3 shadow-xs"
                                         style="width: 44px; height: 44px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted" style="width: 44px; height: 44px; font-size: 0.7rem;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-bold text-dark">{{ $activity->title }}</td>
                            <td class="text-secondary small">{{ Str::limit($activity->description, 70) }}</td>
                            <td>
                                @if($activity->status)
                                    <span class="badge bg-success-subtle text-success">সক্রিয়</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">নিষ্ক্রিয়</span>
                                @endif
                            </td>
                            <td class="text-end pe-3">
                                <div class="d-inline-flex gap-1 align-items-center">
                                    <a href="{{ route('admin.activities.edit', $activity->id) }}" 
                                       class="btn btn-sm btn-info text-white" title="সম্পাদনা">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.activities.destroy', $activity->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('আপনি কি নিশ্চিত যে এই কার্যক্রমটি মুছতে চান?')" title="মুছুন">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">কোনো কার্যক্রম পাওয়া যায়নি</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(isset($activities) && $activities->hasPages())
    <div class="mt-3">
        {{ $activities->links('vendor.pagination.bootstrap-5') }}
    </div>
@endif
@endsection
