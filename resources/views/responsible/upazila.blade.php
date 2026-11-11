@extends('layouts.app')

@section('title', 'উপজেলা দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="responsible-section py-5">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold mb-2">
                <i class="fas fa-landmark me-1"></i> উপজেলাভিত্তিক নেতৃত্ব
            </span>
            <h1 class="display-6 fw-bold text-dark mb-2">উপজেলা দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ</h1>
            <p class="text-muted fs-5 mb-3">জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ — বিভিন্ন উপজেলার সাংগঠনিক দায়িত্বশীলবৃন্দ</p>
            <div class="divider mx-auto"></div>
        </div>

        @php
            $managerList = $managers ?? $responsiblePersons ?? collect();
            $upazilas = $managerList->pluck('area')->filter()->unique()->values();
        @endphp

        <!-- Search & Filter Bar -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-7 col-md-9 col-12">
                <div class="responsible-search-box position-relative shadow-sm rounded-pill bg-white p-1">
                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-4 text-muted"></i>
                    <input type="text" 
                           id="upazilaSearch" 
                           class="form-control border-0 rounded-pill ps-5 py-3 shadow-none" 
                           placeholder="উপজেলার নাম, দায়িত্বশীলের নাম বা পদবী লিখুন...">
                    <button class="btn btn-sm btn-success rounded-pill position-absolute end-0 top-50 translate-middle-y me-2 px-3 py-2" id="clearSearch" style="display: none;">
                        <i class="fas fa-times me-1"></i>ক্লিয়ার
                    </button>
                </div>
            </div>
        </div>

        <!-- Quick Filter Pills -->
        @if($upazilas->count() > 1)
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-5" id="upazilaFilterPills">
                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 py-1 upazila-pill active" data-area="all">
                    সব উপজেলা ({{ $managerList->count() }})
                </button>
                @foreach($upazilas as $upz)
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 upazila-pill bg-white" data-area="{{ mb_strtolower($upz) }}">
                        <i class="fas fa-map-marker-alt text-danger me-1"></i>{{ $upz }}
                    </button>
                @endforeach
            </div>
        @else
            <div class="mb-4"></div>
        @endif

        <!-- Members Grid -->
        <div class="row g-4" id="upazilaGrid">
            @forelse($managerList as $manager)
                <div class="col-xxl-3 col-xl-4 col-md-6 col-12 manager-col" 
                     data-name="{{ mb_strtolower($manager->name) }}" 
                     data-designation="{{ mb_strtolower($manager->designation) }}"
                     data-area="{{ mb_strtolower($manager->area ?? '') }}"
                     data-address="{{ mb_strtolower($manager->address ?? '') }}">
                    <div class="profile-card h-100">
                        <!-- Image Container -->
                        <div class="profile-image-wrap" data-bs-toggle="modal" data-bs-target="#managerModal-{{ $manager->id }}">
                            @if($manager->area)
                                <div class="area-badge">
                                    <i class="fas fa-landmark me-1 text-warning"></i>{{ $manager->area }}
                                </div>
                            @endif
                            <img src="{{ $manager->image ? asset('storage/' . $manager->image) : asset('images/default-avatar.png') }}" 
                                 alt="{{ $manager->name }}"
                                 loading="lazy"
                                 onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                            <div class="profile-hover-overlay">
                                <span><i class="fas fa-eye me-1"></i>বিস্তারিত দেখুন</span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="profile-info d-flex flex-column justify-content-between p-3 p-md-4">
                            <div>
                                <h3 class="profile-name mb-2" data-bs-toggle="modal" data-bs-target="#managerModal-{{ $manager->id }}">
                                    {{ $manager->name }}
                                </h3>
                                <div class="designation-wrap mb-2">
                                    <span class="designation-pill">
                                        {{ $manager->designation }}
                                    </span>
                                </div>
                                @if($manager->area)
                                    <div class="profile-address small text-muted mb-1">
                                        <i class="fas fa-landmark text-success me-1"></i>উপজেলা: <strong>{{ $manager->area }}</strong>
                                    </div>
                                @endif
                                @if($manager->address)
                                    <div class="profile-address small text-muted">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i>{{ $manager->address }}
                                    </div>
                                @endif
                            </div>

                            <!-- Contact Actions -->
                            <div class="profile-actions pt-3 mt-3 border-top d-flex gap-2 justify-content-between align-items-center">
                                @if($manager->phone)
                                    <a href="tel:{{ $manager->phone }}" class="btn btn-sm btn-outline-success rounded-pill px-3 flex-fill text-nowrap" title="কল করুন">
                                        <i class="fas fa-phone-alt me-1"></i>কল
                                    </a>
                                @endif
                                @if($manager->email)
                                    <a href="mailto:{{ $manager->email }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 flex-fill text-nowrap" title="ইমেইল পাঠান">
                                        <i class="fas fa-envelope me-1"></i>ইমেইল
                                    </a>
                                @endif
                                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 text-nowrap" data-bs-toggle="modal" data-bs-target="#managerModal-{{ $manager->id }}">
                                    বিস্তারিত
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="empty-state p-5 bg-white rounded-4 shadow-sm border">
                        <i class="fas fa-landmark fa-3x text-muted mb-3 opacity-50"></i>
                        <h4 class="text-dark fw-bold mb-2">কোনো উপজেলা দায়িত্বশীলের তথ্য পাওয়া যায়নি</h4>
                        <p class="text-muted mb-0">বর্তমানে উপজেলা দায়িত্বশীলদের তথ্য হালনাগাদ করা হচ্ছে। অনুগ্রহ করে পরবর্তীতে আবার দেখুন।</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- No Results Fallback for Search -->
        <div id="noResults" class="text-center py-5 d-none">
            <div class="bg-white rounded-4 shadow-sm p-5 border max-w-md mx-auto" style="max-width: 500px;">
                <i class="fas fa-search fa-3x text-muted mb-3 opacity-50"></i>
                <h5 class="fw-bold text-dark mb-1">কোনো ফলাফল পাওয়া যায়নি</h5>
                <p class="text-muted small mb-0">আপনার সার্চ করা নাম বা উপজেলার সাথে মিল রেখে কোনো দায়িত্বশীল পাওয়া যায়নি।</p>
            </div>
        </div>
    </div>
</div>

<!-- Modals outside card grid -->
@foreach($managerList as $manager)
<div class="modal fade" id="managerModal-{{ $manager->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $manager->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-success text-white border-0 py-3 px-4">
                <h5 class="modal-title fw-bold" id="modalLabel-{{ $manager->id }}">
                    <i class="fas fa-id-badge me-2"></i>দায়িত্বশীলের পরিচিতি
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center">
                        <div class="modal-image-container mx-auto rounded-4 overflow-hidden shadow-sm" style="width: 220px; height: 260px; background: #f8fafc;">
                            <img src="{{ $manager->image ? asset('storage/' . $manager->image) : asset('images/default-avatar.png') }}" 
                                 alt="{{ $manager->name }}" 
                                 class="w-100 h-100 object-fit-cover"
                                 onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                        </div>
                        @if($manager->area)
                            <div class="mt-3">
                                <span class="badge bg-warning bg-opacity-25 text-dark px-3 py-2 rounded-pill fw-bold">
                                    <i class="fas fa-landmark text-success me-1"></i>{{ $manager->area }} উপজেলা
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-7">
                        <h3 class="fw-bold text-dark mb-1">{{ $manager->name }}</h3>
                        <p class="text-success fw-semibold fs-5 mb-4">{{ $manager->designation }}</p>

                        <div class="info-list d-flex flex-column gap-3">
                            @if($manager->area)
                                <div class="d-flex align-items-center p-3 rounded-3 bg-light">
                                    <div class="icon-circle bg-success text-white me-3">
                                        <i class="fas fa-landmark"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">কার্য এলাকা / উপজেলা</div>
                                        <div class="fw-bold text-dark">{{ $manager->area }}</div>
                                    </div>
                                </div>
                            @endif

                            @if($manager->phone)
                                <div class="d-flex align-items-center p-3 rounded-3 bg-light">
                                    <div class="icon-circle bg-success text-white me-3">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">মোবাইল নম্বর</div>
                                        <a href="tel:{{ $manager->phone }}" class="fw-bold text-success text-decoration-none">
                                            {{ $manager->phone }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if($manager->email)
                                <div class="d-flex align-items-center p-3 rounded-3 bg-light">
                                    <div class="icon-circle bg-primary text-white me-3">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">ইমেইল ঠিকানা</div>
                                        <a href="mailto:{{ $manager->email }}" class="fw-bold text-primary text-decoration-none">
                                            {{ $manager->email }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if($manager->address)
                                <div class="d-flex align-items-center p-3 rounded-3 bg-light">
                                    <div class="icon-circle bg-secondary text-white me-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">স্থায়ী ঠিকানা</div>
                                        <div class="fw-bold text-dark">{{ $manager->address }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-0 py-3 px-4 d-flex justify-content-between">
                <span class="text-muted small">
                    <i class="fas fa-shield-alt text-success me-1"></i>জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ
                </span>
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@push('styles')
<style>
    .responsible-section {
        background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        min-height: 80vh;
    }

    .divider {
        width: 60px;
        height: 3px;
        background: #0C4B36;
        border-radius: 2px;
    }

    .responsible-search-box {
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .responsible-search-box:focus-within {
        border-color: #0C4B36;
        box-shadow: 0 4px 15px rgba(12, 75, 54, 0.12) !important;
    }

    .profile-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(12, 75, 54, 0.12);
        border-color: rgba(12, 75, 54, 0.2);
    }

    .area-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(12, 75, 54, 0.9);
        backdrop-filter: blur(4px);
        color: #ffffff;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 30px;
        z-index: 2;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .profile-image-wrap {
        position: relative;
        width: 100%;
        height: 260px;
        background: #edf2f7;
        overflow: hidden;
        cursor: pointer;
    }

    .profile-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center !important;
        transition: transform 0.4s ease;
    }

    .profile-card:hover .profile-image-wrap img {
        transform: scale(1.06);
    }

    .profile-hover-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(180deg, transparent 0%, rgba(12, 75, 54, 0.85) 100%);
        padding: 24px 12px 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }

    .profile-hover-overlay span {
        color: #ffffff;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .profile-card:hover .profile-hover-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    .profile-name {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1e293b;
        cursor: pointer;
        line-height: 1.4;
        transition: color 0.2s ease;
    }

    .profile-name:hover {
        color: #0C4B36;
    }

    .designation-pill {
        display: inline-block;
        font-size: 0.85rem;
        font-weight: 600;
        color: #0C4B36;
        background: rgba(12, 75, 54, 0.08);
        border: 1px solid rgba(12, 75, 54, 0.2);
        border-radius: 30px;
        padding: 4px 14px;
    }

    .icon-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('upazilaSearch');
    const clearBtn = document.getElementById('clearSearch');
    const cards = document.querySelectorAll('.manager-col');
    const noResults = document.getElementById('noResults');
    const pills = document.querySelectorAll('.upazila-pill');

    let activeFilter = 'all';

    function filterCards() {
        const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
        let visibleCount = 0;

        if (clearBtn) {
            clearBtn.style.display = query.length > 0 ? 'block' : 'none';
        }

        cards.forEach(card => {
            const name = card.getAttribute('data-name') || '';
            const designation = card.getAttribute('data-designation') || '';
            const area = card.getAttribute('data-area') || '';
            const address = card.getAttribute('data-address') || '';

            const matchesArea = (activeFilter === 'all') || (area === activeFilter);
            const matchesQuery = !query || name.includes(query) || designation.includes(query) || area.includes(query) || address.includes(query);

            if (matchesArea && matchesQuery) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (visibleCount === 0 && cards.length > 0) {
            noResults.classList.remove('d-none');
        } else {
            noResults.classList.add('d-none');
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterCards);
    }

    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            filterCards();
            searchInput.focus();
        });
    }

    pills.forEach(pill => {
        pill.addEventListener('click', function () {
            pills.forEach(p => p.classList.remove('active', 'btn-success'));
            pills.forEach(p => p.classList.add('btn-outline-secondary'));
            this.classList.remove('btn-outline-secondary');
            this.classList.add('active', 'btn-success');

            activeFilter = this.getAttribute('data-area');
            filterCards();
        });
    });
});
</script>
@endpush
