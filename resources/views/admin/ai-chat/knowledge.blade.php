@extends('admin.layouts.app')

@section('title', 'নলেজ বেস প্রশ্নোত্তর রিপোজিটরি')

@section('content')
<div class="container-fluid py-3">

    <!-- Header & Breadcrumb -->
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-decoration-none">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.ai-chat.index') }}" class="text-decoration-none">এআই সহকারী</a></li>
                    <li class="breadcrumb-item active" aria-current="page">নলেজ বেস Q&A</li>
                </ol>
            </nav>
            <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                <i class="fas fa-book-reader text-primary"></i> নলেজ বেস প্রশ্নোত্তর রিপোজিটরি
            </h1>
            <p class="text-secondary small mb-0">
                এআই সহকারীকে সঠিক ও নির্ভুল উত্তর দেওয়ার জন্য প্রতিষ্ঠানের সকল প্রশ্নোত্তর ও তথ্য এখানে পরিচালনা করুন।
            </p>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0 d-flex gap-2 justify-content-md-end flex-wrap">
            <form action="{{ route('admin.ai-chat.knowledge.reset') }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিত যে সকল প্রশ্নোত্তরকে ডিফল্ট প্রাতিষ্ঠানিক উপাত্তে রিসেট করতে চান?');">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm" title="ডিফল্ট ফ্যাক্টরি সেটিংসে রিসেট">
                    <i class="fas fa-undo me-1"></i> ডিফল্ট রিসেট
                </button>
            </form>
            <button type="button" class="btn btn-success btn-sm fw-semibold shadow-sm" data-bs-toggle="modal" data-bs-target="#createKnowledgeModal">
                <i class="fas fa-plus me-1"></i> নতুন প্রশ্নোত্তর যোগ করুন
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

    <!-- Search & Filter Bar -->
    <div class="card border-0 shadow-sm rounded-4 bg-white p-3 mb-4">
        <form method="GET" action="{{ route('admin.ai-chat.knowledge.index') }}" class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="প্রশ্ন, কীওয়ার্ড বা উত্তর খুঁজুন..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">-- সকল ক্যাটাগরি --</option>
                    @foreach($categories as $key => $catName)
                        <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $catName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 text-md-end d-flex gap-2 justify-content-md-end">
                <button type="submit" class="btn btn-sm btn-primary px-3">ফিল্টার</button>
                @if(request()->hasAny(['search', 'category']))
                    <a href="{{ route('admin.ai-chat.knowledge.index') }}" class="btn btn-sm btn-light border">রিসেট</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table of Q&A Items -->
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">ক্রম</th>
                        <th>প্রশ্ন ও ক্যাটাগরি</th>
                        <th>কীওয়ার্ড ও উত্তর সারসংক্ষেপ</th>
                        <th class="text-center" style="width: 100px;">হিট সংখ্যা</th>
                        <th class="text-center" style="width: 90px;">স্ট্যাটাস</th>
                        <th class="text-end" style="width: 130px;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                        <tr>
                            <td class="text-muted small fw-bold">{{ $items->firstItem() + $index }}</td>
                            <td style="max-width: 260px;">
                                <div class="fw-bold text-dark mb-1">{{ $item->question }}</div>
                                <span class="badge bg-success-subtle text-success font-xs">
                                    {{ $categories[$item->category] ?? ucfirst($item->category) }}
                                </span>
                                @if($item->priority > 0)
                                    <span class="badge bg-warning-subtle text-warning-emphasis font-xs">অগ্রাধিকার: {{ $item->priority }}</span>
                                @endif
                            </td>
                            <td style="max-width: 380px;">
                                @if($item->keywords)
                                    <div class="mb-1 text-truncate">
                                        <i class="fas fa-tags text-muted font-xs me-1"></i>
                                        @foreach(array_slice(explode(',', $item->keywords), 0, 4) as $kw)
                                            <span class="badge bg-light text-secondary border font-xs">{{ trim($kw) }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="text-secondary small text-truncate" style="max-height: 40px;">
                                    {{ Str::limit(strip_tags($item->answer), 110) }}
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border">
                                    <i class="fas fa-fire text-danger me-1"></i> {{ $item->hit_count }}
                                </span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.ai-chat.knowledge.toggle', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }} border-0" title="স্ট্যাটাস পরিবর্তন করুন" style="cursor: pointer;">
                                        {{ $item->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-2 py-1" data-bs-toggle="modal" data-bs-target="#editKnowledgeModal{{ $item->id }}" title="এডিট করুন">
                                    <i class="fas fa-edit font-xs"></i>
                                </button>
                                <form action="{{ route('admin.ai-chat.knowledge.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই প্রশ্নোত্তরটি মুছে ফেলতে চান?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1" title="মুছে ফেলুন">
                                        <i class="fas fa-trash-alt font-xs"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Knowledge Modal for this item -->
                        <div class="modal fade" id="editKnowledgeModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title fw-bold fs-6">
                                            <i class="fas fa-edit me-2"></i> প্রশ্নোত্তর সম্পাদনা করুন
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.ai-chat.knowledge.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-8">
                                                    <label class="form-label fw-semibold small text-dark">মূল প্রশ্ন / বিষয় *</label>
                                                    <input type="text" name="question" class="form-control" value="{{ $item->question }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label fw-semibold small text-dark">ক্যাটাগরি *</label>
                                                    <select name="category" class="form-select" required>
                                                        @foreach($categories as $key => $catName)
                                                            <option value="{{ $key }}" {{ $item->category === $key ? 'selected' : '' }}>{{ $catName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-9">
                                                    <label class="form-label fw-semibold small text-dark">সার্চ কীওয়ার্ড (কমা দিয়ে আলাদা করুন)</label>
                                                    <input type="text" name="keywords" class="form-control" value="{{ $item->keywords }}" placeholder="উদাঃ লক্ষ্য, কর্মসূচি, ৫ দফা">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label fw-semibold small text-dark">অগ্রাধিকার (Priority 0-10)</label>
                                                    <input type="number" name="priority" class="form-control" value="{{ $item->priority }}" min="0" max="10">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-semibold small text-dark">বিস্তারিত উত্তর *</label>
                                                    <textarea name="answer" class="form-control" rows="5" required>{{ $item->answer }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">বাতিল</button>
                                            <button type="submit" class="btn btn-primary btn-sm fw-semibold">পরিবর্তন সংরক্ষণ করুন</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-muted">
                                কোনো প্রশ্নোত্তর পাওয়া যায়নি। নতুন যোগ করতে উপরের বোতাম চাপুন।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="p-3 border-top">
                {{ $items->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Create Knowledge Modal -->
<div class="modal fade" id="createKnowledgeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold fs-6">
                    <i class="fas fa-plus-circle me-2"></i> নতুন প্রশ্নোত্তর যুক্ত করুন
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.ai-chat.knowledge.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold small text-dark">মূল প্রশ্ন / বিষয় *</label>
                            <input type="text" name="question" class="form-control" placeholder="উদাঃ শুব্বানের সদস্য হওয়ার নিয়ম কি?" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">ক্যাটাগরি *</label>
                            <select name="category" class="form-select" required>
                                @foreach($categories as $key => $catName)
                                    <option value="{{ $key }}">{{ $catName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-9">
                            <label class="form-label fw-semibold small text-dark">সার্চ কীওয়ার্ড (কমা দিয়ে আলাদা করুন)</label>
                            <input type="text" name="keywords" class="form-control" placeholder="উদাঃ সদস্য, কর্মী, যোগদান, ফরম">
                            <span class="font-xs text-muted">ভিজিটর এই শব্দগুলো লিখলে এই উত্তরটি প্রাধান্য পাবে।</span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small text-dark">অগ্রাধিকার (Priority 0-10)</label>
                            <input type="number" name="priority" class="form-control" value="5" min="0" max="10">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small text-dark">বিস্তারিত নির্ভুল উত্তর *</label>
                            <textarea name="answer" class="form-control" rows="5" placeholder="বটের বিস্তারিত উত্তরটি বাংলায় সুন্দরভাবে লিখুন..." required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-success btn-sm fw-semibold">সংরক্ষণ করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
