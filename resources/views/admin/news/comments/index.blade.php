@extends('admin.layouts.app')

@section('title', 'সংবাদের মন্তব্য ব্যবস্থাপনা')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">
                <i class="fas fa-comments text-success me-2"></i>সংবাদের মন্তব্যসমূহ
            </h1>
            <p class="text-muted small mb-0">পাঠকদের মন্তব্য অনুমোদন ও পরিচালনা করুন</p>
        </div>
        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i>সংবাদ তালিকায় ফিরে যান
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>মন্তব্যকারী</th>
                            <th>সংবাদ</th>
                            <th>মন্তব্য</th>
                            <th>তারিখ</th>
                            <th>অবস্থা</th>
                            <th class="text-end">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comments as $comment)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $comment->name ?? ($comment->user->name ?? 'বেনামী পাঠক') }}</div>
                                    @if($comment->email)
                                        <div class="small text-muted">{{ $comment->email }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($comment->news)
                                        <a href="{{ route('news.show', $comment->news->id) }}" target="_blank" class="text-decoration-none fw-semibold text-dark">
                                            {{ Str::limit($comment->news->title, 35) }}
                                        </a>
                                    @else
                                        <span class="text-muted">সংবাদ অপসারিত</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="small text-secondary" style="max-width: 320px;">
                                        {{ Str::limit($comment->comment, 80) }}
                                    </div>
                                </td>
                                <td class="small text-muted font-monospace">
                                    {{ $comment->created_at ? $comment->created_at->format('d M, Y') : '-' }}
                                </td>
                                <td>
                                    @if($comment->status === 'approved')
                                        <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1">অনুমোদিত</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-dark rounded-pill px-2 py-1">পেন্ডিং</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        @if($comment->status !== 'approved')
                                            <form action="{{ route('admin.news.comments.approve', $comment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success rounded-circle" title="অনুমোদন করুন" style="width: 32px; height: 32px; padding: 0;">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.news.comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই মন্তব্যটি মুছে ফেলতে চান?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="মুছে ফেলুন" style="width: 32px; height: 32px; padding: 0;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-comments fa-2x mb-2 opacity-50"></i>
                                    <div>কোনো মন্তব্য পাওয়া যায়নি</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($comments->hasPages())
            <div class="card-footer bg-white border-top p-3 d-flex justify-content-center">
                {{ $comments->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
