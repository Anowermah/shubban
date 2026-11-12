<!-- ========================================================================
     7. DIGITAL NOTICE BOARD & IMPORTANT PORTALS
     ======================================================================== -->
@php
    $limit = $section->item_limit ?? 5;
    $noticeList = isset($notices) ? $notices->take($limit) : collect();
@endphp
<section class="py-4 py-lg-5 bg-white border-top border-bottom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <div>
                @if($section->badge_text)
                    <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-1 rounded-pill fw-bold mb-1">{{ $section->badge_text }}</span>
                @endif
                <h2 class="fw-bold fs-3 text-dark mb-0 d-flex align-items-center">
                    <i class="fas fa-bell text-warning me-2"></i> {{ $section->title ?? 'ডিজিটাল নোটিশ বোর্ড' }}
                </h2>
                @if($section->subtitle)
                    <p class="text-muted small mb-0 mt-1">{{ $section->subtitle }}</p>
                @endif
            </div>
            <a href="{{ route('notice.index') }}" class="btn btn-sm btn-outline-warning text-dark fw-semibold rounded-pill px-3">
                সকল নোটিশ <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            <!-- Notices List (8 Cols) -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                    <div class="card-header border-0 py-3 px-3 px-sm-4 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #073123 0%, #0C4B36 100%);">
                        <span class="text-white fw-bold d-flex align-items-center">
                            <i class="fas fa-bullhorn text-warning me-2"></i> সাম্প্রতিক দাপ্তরিক ও সাংগঠনিক নোটিশ
                        </span>
                        <span class="badge bg-warning text-dark">
                            মোট {{ $noticeList->count() }} টি
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($noticeList as $notice)
                                <div class="list-group-item p-2 p-md-3 border-bottom d-flex align-items-center justify-content-between gap-2 transition-all hover-bg-light" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#noticeModal{{ $notice->id }}">
                                    <div class="d-flex align-items-center gap-2 overflow-hidden flex-grow-1">
                                        <div class="notice-item-squircle flex-shrink-0 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-bell"></i>
                                        </div>
                                        <div class="overflow-hidden flex-grow-1">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <span class="badge bg-success-subtle text-success font-xs">
                                                    <i class="far fa-calendar-alt me-1"></i> {{ $notice->created_at->format('d M, Y') }}
                                                </span>
                                                @if($notice->category)
                                                    <span class="badge bg-light text-secondary border font-xs">{{ ucfirst($notice->category) }}</span>
                                                @endif
                                            </div>
                                            <a href="#" class="text-decoration-none text-dark fw-bold hover-green d-block text-truncate" style="font-size: 0.92rem;">
                                                {{ $notice->title }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                        <div class="d-none d-md-flex align-items-center gap-2">
                                            @if($notice->file)
                                                <a href="{{ asset('storage/' . $notice->file) }}" class="btn btn-sm btn-outline-primary py-1 px-3 rounded-pill font-xs" download title="PDF ডাউনলোড" onclick="event.stopPropagation();">
                                                    <i class="fas fa-download me-1"></i> PDF
                                                </a>
                                            @endif
                                            <button type="button" class="btn btn-sm btn-outline-success py-1 px-3 rounded-pill font-xs">
                                                দেখুন <i class="fas fa-eye ms-1"></i>
                                            </button>
                                        </div>
                                        <div class="d-md-none text-muted p-1">
                                            <i class="fas fa-chevron-right fs-6 text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 text-center text-muted">
                                    কোনো নোটিশ পাওয়া যায়নি
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Helpful Portals & Links (4 Cols) -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                    <div class="card-header border-0 py-3 px-3 px-sm-4" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
                        <span class="text-white fw-bold d-flex align-items-center">
                            <i class="fas fa-link text-warning me-2"></i> গুরুত্বপূর্ণ পোর্টাল ও লিংক
                        </span>
                    </div>
                    <div class="card-body p-3 d-flex flex-column gap-2 justify-content-center">
                        <a href="https://jamiyat.org.bd/" target="_blank" class="p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none text-dark hover-shadow bg-light">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-globe text-success fs-5"></i>
                                <div>
                                    <div class="fw-bold small">বাংলাদেশ জমঈয়ত</div>
                                    <div class="text-muted font-xs">অফিসিয়াল কেন্দ্রীয় পোর্টাল</div>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-muted small"></i>
                        </a>

                        <a href="https://talimiboard.org/" target="_blank" class="p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none text-dark hover-shadow bg-light">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-graduation-cap text-primary fs-5"></i>
                                <div>
                                    <div class="fw-bold small">তা‘লীমী বোর্ড বাংলাদেশ</div>
                                    <div class="text-muted font-xs">মাদরাসা শিক্ষা ব্যবস্থাপনা</div>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-muted small"></i>
                        </a>

                        <a href="{{ route('contact.index') }}" class="p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none text-dark hover-shadow bg-light">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-envelope text-warning fs-5"></i>
                                <div>
                                    <div class="fw-bold small">সরাসরি যোগাযোগ</div>
                                    <div class="text-muted font-xs">কেন্দ্রীয় কার্যালয় ও হেল্পডেস্ক</div>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-muted small"></i>
                        </a>

                        <a href="{{ route('notice.index') }}" class="p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none text-dark hover-shadow bg-light">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-archive text-danger fs-5"></i>
                                <div>
                                    <div class="fw-bold small">পুরাতন নোটিশ আর্কাইভ</div>
                                    <div class="text-muted font-xs">বিগত সকল বিজ্ঞপ্তি ও আদেশ</div>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-muted small"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
