@extends('admin.layouts.app')

@section('title', 'ভিজিটর চ্যাট লগ ও অনুসন্ধান হিস্ট্রি')

@section('content')
<div class="container-fluid py-3">

    <!-- Header & Breadcrumb -->
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-decoration-none">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.ai-chat.index') }}" class="text-decoration-none">এআই সহকারী</a></li>
                    <li class="breadcrumb-item active" aria-current="page">চ্যাট হিস্ট্রি</li>
                </ol>
            </nav>
            <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                <i class="fas fa-history text-secondary"></i> ভিজিটর চ্যাট লগ ও অনুসন্ধান হিস্ট্রি
            </h1>
            <p class="text-secondary small mb-0">
                ওয়েবসাইটে আগত দর্শনার্থীরা কী প্রশ্ন করছে তা পর্যবেক্ষণ করুন এবং অজানা প্রশ্নগুলোকে নলেজ বেসে রূপান্তর করুন।
            </p>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0 d-flex gap-2 justify-content-md-end flex-wrap">
            <form action="{{ route('admin.ai-chat.logs.clear') }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিত যে সকল চ্যাট হিস্ট্রি মুছে ফেলতে চান?');">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm" title="হিস্ট্রি পরিষ্কার করুন">
                    <i class="fas fa-trash-alt me-1"></i> সকল লগ মুছুন
                </button>
            </form>
            <a href="{{ route('admin.ai-chat.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-sliders-h me-1"></i> এআই ড্যাশবোর্ড
            </a>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search & Filter Bar -->
    <div class="card border-0 shadow-sm rounded-4 bg-white p-3 mb-4">
        <form method="GET" action="{{ route('admin.ai-chat.logs.index') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="প্রশ্ন বা উত্তরের লেখা খুঁজুন..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="filter" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">-- সকল রেকর্ড --</option>
                    <option value="unresolved" {{ request('filter') === 'unresolved' ? 'selected' : '' }}>⚠️ অমীমাংসিত প্রশ্নসমূহ (Fallback)</option>
                    <option value="unhelpful" {{ request('filter') === 'unhelpful' ? 'selected' : '' }}>👎 নেতিবাচক প্রতিক্রিয়া (Thumbs Down)</option>
                    <option value="helpful" {{ request('filter') === 'helpful' ? 'selected' : '' }}>👍 ইতিবাচক প্রতিক্রিয়া (Thumbs Up)</option>
                </select>
            </div>
            <div class="col-md-3 text-md-end d-flex gap-2 justify-content-md-end">
                <button type="submit" class="btn btn-sm btn-primary px-3">ফিল্টার</button>
                @if(request()->hasAny(['search', 'filter']))
                    <a href="{{ route('admin.ai-chat.logs.index') }}" class="btn btn-sm btn-light border">রিসেট</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table of Logs -->
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 140px;">সময় ও আইপি</th>
                        <th style="width: 250px;">ভিজিটরের প্রশ্ন</th>
                        <th>বটের উত্তর</th>
                        <th class="text-center" style="width: 100px;">ইঞ্জিন</th>
                        <th class="text-center" style="width: 90px;">প্রতিক্রিয়া</th>
                        <th class="text-end" style="width: 130px;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>
                                <div class="small fw-semibold text-dark">{{ $log->created_at->format('d/m/Y') }}</div>
                                <div class="font-xs text-muted">{{ $log->created_at->format('h:i A') }}</div>
                                @if($log->user_ip)
                                    <code class="font-xs text-secondary">{{ $log->user_ip }}</code>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark small mb-1">{{ $log->user_message }}</div>
                                @if($log->knowledgeBase)
                                    <span class="badge bg-success-subtle text-success font-xs">
                                        <i class="fas fa-check-circle me-1"></i> নলেজ ম্যাচ
                                    </span>
                                @else
                                    <span class="badge {{ $log->is_resolved ? 'bg-info-subtle text-info' : 'bg-warning-subtle text-warning-emphasis' }} font-xs">
                                        {{ $log->is_resolved ? 'রিসলভড' : 'অমীমাংসিত' }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="small text-secondary p-2 bg-light rounded-2" style="max-height: 80px; overflow-y: auto;">
                                    {!! nl2br(e($log->bot_response)) !!}
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $log->provider_used === 'internal' ? 'bg-success' : 'bg-primary' }} font-xs">
                                    {{ $log->provider_used }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($log->was_helpful === true)
                                    <span class="badge bg-success font-xs"><i class="fas fa-thumbs-up me-1"></i> ভালো</span>
                                @elseif($log->was_helpful === false)
                                    <span class="badge bg-danger font-xs"><i class="fas fa-thumbs-down me-1"></i> খারাপ</span>
                                @else
                                    <span class="text-muted font-xs">-</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-2 py-1 font-xs" data-bs-toggle="modal" data-bs-target="#convertModal{{ $log->id }}" title="নলেজ বেস Q&A হিসেবে সেভ করুন">
                                    <i class="fas fa-plus-circle me-1"></i> নলেজে সেভ
                                </button>
                            </td>
                        </tr>

                        <!-- Convert Log to Knowledge Modal -->
                        <div class="modal fade" id="convertModal{{ $log->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title fw-bold fs-6">
                                            <i class="fas fa-brain me-2"></i> প্রশ্নটি নলেজ বেসে রূপান্তর করুন
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.ai-chat.logs.convert', $log->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-8">
                                                    <label class="form-label fw-semibold small text-dark">প্রশ্ন / বিষয় *</label>
                                                    <input type="text" name="question" class="form-control" value="{{ $log->user_message }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label fw-semibold small text-dark">ক্যাটাগরি *</label>
                                                    <select name="category" class="form-select" required>
                                                        @foreach(\App\Models\AIChatKnowledgeBase::categories() as $k => $cName)
                                                            <option value="{{ $k }}">{{ $cName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-semibold small text-dark">সার্চ কীওয়ার্ড (কমা দিয়ে আলাদা করুন)</label>
                                                    <input type="text" name="keywords" class="form-control" value="{{ $log->user_message }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-semibold small text-dark">সঠিক উত্তর *</label>
                                                    <textarea name="answer" class="form-control" rows="5" required>{{ $log->bot_response }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">বাতিল</button>
                                            <button type="submit" class="btn btn-success btn-sm fw-semibold">নলেজ বেসে সংরক্ষণ করুন</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-muted">
                                কোনো চ্যাট লগ হিস্ট্রি পাওয়া যায়নি।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
            <div class="p-3 border-top">
                {{ $logs->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
