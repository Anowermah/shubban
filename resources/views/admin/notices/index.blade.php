@extends('admin.layouts.app')

@section('title', 'নোটিশ তালিকা')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap pt-2 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-0">
            <i class="fas fa-bullhorn text-success me-2"></i>নোটিশ তালিকা
        </h1>
        <p class="text-muted small mb-0">সকল সাম্প্রতিক নোটিশ ও ঘোষণার খতিয়ান ও ব্যবস্থাপনা</p>
    </div>
    <div class="btn-toolbar mb-0">
        <a href="{{ route('admin.notices.create') }}" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
            <i class="fas fa-plus me-1"></i> নতুন নোটিশ যোগ করুন
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
                        <th class="ps-3" style="width: 60px;">ক্রম</th>
                        <th>শিরোনাম</th>
                        <th>বিবরণ</th>
                        <th>তারিখ</th>
                        <th>স্ট্যাটাস</th>
                        <th class="text-end pe-3" style="width: 110px;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notices ?? [] as $notice)
                        <tr>
                            <td class="ps-3 font-monospace text-muted">{{ $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $notice->title }}</td>
                            <td class="text-secondary small">{{ Str::limit($notice->description, 70) }}</td>
                            <td class="text-muted font-xs">{{ $notice->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($notice->status)
                                    <span class="badge bg-success-subtle text-success">সক্রিয়</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">নিষ্ক্রিয়</span>
                                @endif
                            </td>
                            <td class="text-end pe-3">
                                <div class="d-inline-flex gap-1 align-items-center">
                                    <a href="{{ route('admin.notices.edit', $notice->id) }}" 
                                       class="btn btn-sm btn-info text-white" title="সম্পাদনা">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.notices.destroy', $notice->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('আপনি কি নিশ্চিত যে এই নোটিশটি মুছতে চান?')" title="মুছুন">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">কোনো নোটিশ পাওয়া যায়নি</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(isset($notices) && $notices->hasPages())
    <div class="mt-3">
        {{ $notices->links('vendor.pagination.bootstrap-5') }}
    </div>
@endif
@endsection
