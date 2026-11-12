@extends('admin.layouts.app')

@section('title', 'যোগাযোগ বার্তাসমূহ')

@section('content')
<div class="d-flex justify-content-between flex-wrap align-items-center pt-2 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-0">
            <i class="fas fa-envelope-open-text text-success me-2"></i>যোগাযোগ বার্তাসমূহ
        </h1>
        <p class="text-muted small mb-0">ওয়েবসাইটের যোগাযোগ ফর্ম থেকে ব্যবহারকারীদের পাঠানো বার্তা ও অনুসন্ধান</p>
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
                        <th class="ps-3">তারিখ</th>
                        <th>নাম</th>
                        <th>ফোন</th>
                        <th>ইমেইল</th>
                        <th>বিষয়</th>
                        <th>স্ট্যাটাস</th>
                        <th class="text-end pe-3">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td class="ps-3 text-muted font-xs">{{ $contact->created_at->format('d/m/Y') }}</td>
                        <td class="fw-bold text-dark">{{ $contact->name }}</td>
                        <td>
                            <a href="tel:{{ $contact->phone }}" class="text-decoration-none text-secondary">
                                <i class="fas fa-phone-alt font-xs text-success me-1"></i>{{ $contact->phone }}
                            </a>
                        </td>
                        <td class="text-muted">{{ $contact->email }}</td>
                        <td>{{ Str::limit($contact->subject, 35) }}</td>
                        <td>
                            @if($contact->status)
                                <span class="badge bg-success-subtle text-success">পঠিত</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning">নতুন বার্তা</span>
                            @endif
                        </td>
                        <td class="text-end pe-3">
                            <div class="d-inline-flex gap-1 align-items-center">
                                <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-info text-white" title="বিস্তারিত দেখুন">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('আপনি কি নিশ্চিত যে আপনি এই বার্তাটি মুছে ফেলতে চান?')" title="মুছুন">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">কোনো যোগাযোগ বার্তা পাওয়া যায়নি</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($contacts->hasPages())
    <div class="mt-3">
        {{ $contacts->links('vendor.pagination.bootstrap-5') }}
    </div>
@endif
@endsection
