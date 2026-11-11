@extends('layouts.app')

@section('title', 'জেলা দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="responsible-section py-5">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold mb-2">
                <i class="fas fa-map-marked-alt me-1"></i> জেলাভিত্তিক নেতৃত্ব
            </span>
            <h1 class="display-6 fw-bold text-dark mb-2">জেলা দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ</h1>
            <p class="text-muted fs-5 mb-3">জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ — বিভিন্ন জেলার সাংগঠনিক দায়িত্বশীলবৃন্দ</p>
            <div class="divider mx-auto"></div>
        </div>

        @php
            $managerList = $managers ?? $responsiblePersons ?? [];
            $districts = $managerList->pluck('area')->filter()->unique()->values();
        @endphp

        <!-- Search & District Filter Bar -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-7 col-md-9 col-12">
                <div class="responsible-search-box position-relative shadow-sm rounded-pill bg-white p-1">
                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-4 text-muted"></i>
                    <input type="text" 
                           id="districtSearch" 
                           class="form-control border-0 rounded-pill ps-5 py-3 shadow-none" 
                           placeholder="জেলার নাম (উদাঃ সিরাজগঞ্জ, রাজশাহী), দায়িত্বশীলের নাম বা পদবী লিখুন...">
                    <button class="btn btn-sm btn-success rounded-pill position-absolute end-0 top-50 translate-middle-y me-2 px-3 py-2" id="clearSearch" style="display: none;">
                        <i class="fas fa-times me-1"></i>ক্লিয়ার
                    </button>
                </div>
            </div>
        </div>

        <!-- Quick District Filter Pills (if multiple districts present) -->
        @if($districts->count() > 1)
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-5" id="districtFilterPills">
                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 py-1 district-pill active" data-district="all">
                    সব জেলা ({{ $managerList->count() }})
                </button>
                @foreach($districts as $dist)
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 district-pill bg-white" data-district="{{ mb_strtolower($dist) }}">
                        <i class="fas fa-map-marker-alt text-danger me-1"></i>{{ $dist }}
                    </button>
                @endforeach
            </div>
        @else
            <div class="mb-4"></div>
        @endif

        <!-- Members Grid -->
        <div class="row g-4" id="districtGrid">
            @forelse($managerList as $manager)
                <div class="col-xxl-3 col-xl-4 col-md-6 col-12 manager-col" 
                     data-name="{{ mb_strtolower($manager->name) }}" 
                     data-designation="{{ mb_strtolower($manager->designation) }}"
                     data-district="{{ mb_strtolower($manager->area ?? '') }}"
                     data-address="{{ mb_strtolower($manager->address ?? '') }}"
                     data-phone="{{ $manager->phone ?? '' }}"
                     data-email="{{ mb_strtolower($manager->email ?? '') }}">
                    <div class="profile-card h-100">
                        <!-- Image Container with Safe Top-Framed Ratio -->
                        <div class="profile-image-wrap" data-bs-toggle="modal" data-bs-target="#managerModal-{{ $manager->id }}">
                            @if($manager->area)
                                <div class="district-badge">
                                    <i class="fas fa-map-marker-alt me-1 text-warning"></i>{{ $manager->area }}
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
                                        <i class="fas fa-map-pin text-success me-1"></i>জেলা: <strong>{{ $manager->area }}</strong>
                                    </div>
                                @endif
                                @if($manager->address)
                                    <div class="profile-address small text-muted">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i>{{ $manager->address }}
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="pt-3 mt-3 border-top d-flex gap-2">
                                <button type="button" 
                                        class="btn btn-outline-success btn-sm w-100 rounded-pill py-2 fw-semibold"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#managerModal-{{ $manager->id }}">
                                    <i class="fas fa-id-badge me-1"></i>বিস্তারিত
                                </button>
                                @if($manager->phone)
                                    <a href="tel:{{ $manager->phone }}" 
                                       class="btn btn-light btn-sm rounded-circle d-flex align-items-center justify-content-center text-success border"
                                       title="কল করুন"
                                       style="width: 38px; height: 38px;">
                                        <i class="fas fa-phone-alt"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="card border-0 shadow-sm rounded-4 p-5 bg-white">
                        <i class="fas fa-users-slash fa-3x text-muted mb-3 opacity-50"></i>
                        <h4 class="fw-bold text-dark">বর্তমানে জেলা দায়িত্বশীলদের তালিকা আপডেট করা হচ্ছে</h4>
                        <p class="text-muted">খুব শীঘ্রই সকল জেলার কমিটি ও দায়িত্বশীলদের পূর্ণাঙ্গ তালিকা এখানে যুক্ত করা হবে।</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- No Search Results Found message -->
        <div id="noResults" class="text-center py-5 d-none">
            <div class="card border-0 shadow-sm rounded-4 p-5 bg-white">
                <i class="fas fa-search fa-3x text-muted mb-3 opacity-50"></i>
                <h4 class="fw-bold text-dark mb-2">কোনো ফলাফল পাওয়া যায়নি</h4>
                <p class="text-muted mb-0">আপনার সার্চ করা জেলা বা নামের সাথে কোনো দায়িত্বশীল সদস্যের মিল পাওয়া যায়নি।</p>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- All Modals Rendered Cleanly Outside Row    -->
<!-- ========================================== -->
@foreach($managerList as $manager)
    <div class="modal fade" id="managerModal-{{ $manager->id }}" tabindex="-1" aria-labelledby="managerModalLabel-{{ $manager->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header border-0 bg-success bg-opacity-10 py-3 px-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success rounded-pill px-3 py-2 fw-semibold">
                            <i class="fas fa-id-card me-1"></i>দায়িত্বশীল পরিচিতি
                        </span>
                        @if($manager->area)
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-semibold ms-2">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $manager->area }}
                            </span>
                        @endif
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="row g-0 align-items-stretch">
                        <!-- High Res Member Image with Top-Centered Framing -->
                        <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-3">
                            <div class="modal-image-container w-100 h-100 rounded-3 overflow-hidden shadow-sm" style="min-height: 320px;">
                                <img src="{{ $manager->image ? asset('storage/' . $manager->image) : asset('images/default-avatar.png') }}" 
                                     class="w-100 h-100 object-fit-cover" 
                                     alt="{{ $manager->name }}"
                                     onerror="this.src='{{ asset('images/default-avatar.png') }}'"
                                     style="object-position: top center;">
                            </div>
                        </div>
                        <!-- Member Profile Details -->
                        <div class="col-md-7">
                            <div class="p-4 p-md-5 d-flex flex-column justify-content-center h-100">
                                <h2 class="h3 fw-bold text-dark mb-1" id="managerModalLabel-{{ $manager->id }}">
                                    {{ $manager->name }}
                                </h2>
                                <p class="text-success fw-bold fs-5 mb-4">
                                    <i class="fas fa-award me-1"></i>{{ $manager->designation }}
                                </p>
                                
                                <div class="list-group list-group-flush mb-4">
                                    @if($manager->area)
                                        <div class="list-group-item px-0 py-2 border-0 d-flex align-items-center">
                                            <div class="icon-circle bg-warning bg-opacity-10 text-dark me-3">
                                                <i class="fas fa-map-marked-alt text-warning"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">জেলা</small>
                                                <span class="fw-semibold text-dark">{{ $manager->area }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if($manager->phone)
                                        <div class="list-group-item px-0 py-2 border-0 d-flex align-items-center">
                                            <div class="icon-circle bg-success bg-opacity-10 text-success me-3">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">মোবাইল নম্বর</small>
                                                <a href="tel:{{ $manager->phone }}" class="text-decoration-none fw-semibold text-dark">
                                                    {{ $manager->phone }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($manager->email)
                                        <div class="list-group-item px-0 py-2 border-0 d-flex align-items-center">
                                            <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">ইমেইল ঠিকানা</small>
                                                <a href="mailto:{{ $manager->email }}" class="text-decoration-none fw-semibold text-dark">
                                                    {{ $manager->email }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($manager->address)
                                        <div class="list-group-item px-0 py-2 border-0 d-flex align-items-center">
                                            <div class="icon-circle bg-danger bg-opacity-10 text-danger me-3">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">উপজেলা / এলাকা</small>
                                                <span class="fw-semibold text-dark">{{ $manager->address }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="d-flex gap-2 pt-2">
                                    @if($manager->phone)
                                        <a href="tel:{{ $manager->phone }}" class="btn btn-success rounded-pill px-4 py-2 flex-grow-1">
                                            <i class="fas fa-phone-alt me-1"></i>সরাসরি কল
                                        </a>
                                        @php
                                            $cleanPhone = preg_replace('/[^0-9]/', '', $manager->phone);
                                            if (str_starts_with($cleanPhone, '0')) {
                                                $waPhone = '88' . $cleanPhone;
                                            } else {
                                                $waPhone = $cleanPhone;
                                            }
                                        @endphp
                                        <a href="https://wa.me/{{ $waPhone }}" target="_blank" class="btn btn-outline-success rounded-pill px-3 py-2" title="WhatsApp">
                                            <i class="fab fa-whatsapp fs-5"></i>
                                        </a>
                                    @endif
                                    <button type="button" class="btn btn-light rounded-pill px-3 py-2 border" data-bs-dismiss="modal">
                                        বন্ধ করুন
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@push('styles')
<style>
    .responsible-section {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        min-height: 80vh;
    }

    .divider {
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #0C4B36, #FBB040);
        border-radius: 4px;
    }

    /* Search Box */
    .responsible-search-box {
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    .responsible-search-box:focus-within {
        border-color: #0C4B36;
        box-shadow: 0 0 0 4px rgba(12, 75, 54, 0.1) !important;
    }

    /* District Pills */
    .district-pill {
        transition: all 0.2s ease;
        font-size: 0.82rem;
        font-weight: 600;
    }
    .district-pill:hover,
    .district-pill.active {
        background: #0C4B36 !important;
        color: #ffffff !important;
        border-color: #0C4B36 !important;
    }

    /* Profile Card */
    .profile-card {
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s ease, border-color 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .profile-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 32px rgba(12, 75, 54, 0.12);
        border-color: #0C4B36;
    }

    /* District Badge */
    .district-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(12, 75, 54, 0.92);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 20px;
        z-index: 2;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(4px);
    }

    /* Profile Image Container: Fixed 4:5 Portrait Ratio */
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
        letter-spacing: 0.3px;
    }

    .profile-card:hover .profile-hover-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    /* Card Details */
    .profile-info {
        flex-grow: 1;
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
        letter-spacing: 0.2px;
    }

    .profile-address {
        font-size: 0.82rem;
        color: #64748b;
    }

    /* Modal Styling */
    .icon-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .modal-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
    }

    @media (max-width: 575.98px) {
        .profile-image-wrap {
            height: 280px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('districtSearch');
    const clearBtn = document.getElementById('clearSearch');
    const cards = document.querySelectorAll('.manager-col');
    const noResults = document.getElementById('noResults');
    const pills = document.querySelectorAll('.district-pill');

    let activeDistrictFilter = 'all';

    function normalizeText(text) {
        if (!text) return '';
        const bnDigits = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        const enDigits = ['0','1','2','3','4','5','6','7','8','9'];
        
        let normalized = text.toLowerCase()
            .replace(/[\u200B-\u200D\uFEFF]/g, '')
            .replace(/[ঃ:]/g, ' ')
            .replace(/[.,\-_/()|]/g, ' ')
            .replace(/\s+/g, ' ')
            .trim();

        let enVersion = normalized.replace(/[০-৯]/g, d => bnDigits.indexOf(d));
        let bnVersion = normalized.replace(/[0-9]/g, d => bnDigits[enDigits.indexOf(d)]);
        
        return normalized + ' ' + enVersion + ' ' + bnVersion;
    }

    const cardData = Array.from(cards).map(card => {
        const name = card.getAttribute('data-name') || '';
        const designation = card.getAttribute('data-designation') || '';
        const district = (card.getAttribute('data-district') || '').trim().toLowerCase();
        const address = card.getAttribute('data-address') || '';
        const phone = card.getAttribute('data-phone') || '';
        const email = card.getAttribute('data-email') || '';
        const cardText = card.textContent || '';
        
        const fullSearchable = normalizeText(name + ' ' + designation + ' ' + district + ' ' + address + ' ' + phone + ' ' + email + ' ' + cardText);

        return {
            element: card,
            district: district,
            searchable: fullSearchable
        };
    });

    function filterCards() {
        const rawQuery = searchInput ? searchInput.value.trim() : '';
        const normalizedQuery = normalizeText(rawQuery);
        const tokens = normalizedQuery.split(/\s+/).filter(t => t.length > 0);

        if (clearBtn) {
            clearBtn.style.display = rawQuery.length > 0 ? 'inline-block' : 'none';
        }

        if (tokens.length > 0 && activeDistrictFilter !== 'all') {
            const matchesInFilter = cardData.some(c => c.district === activeDistrictFilter && tokens.every(t => c.searchable.includes(t)));
            if (!matchesInFilter) {
                activeDistrictFilter = 'all';
                pills.forEach(p => {
                    if (p.getAttribute('data-district') === 'all') {
                        p.classList.add('active', 'btn-success');
                        p.classList.remove('btn-outline-secondary');
                    } else {
                        p.classList.remove('active', 'btn-success');
                        p.classList.add('btn-outline-secondary');
                    }
                });
            }
        }

        let visibleCount = 0;

        cardData.forEach(item => {
            const matchesDistrict = (activeDistrictFilter === 'all') || (item.district === activeDistrictFilter);
            const matchesQuery = tokens.length === 0 || tokens.every(token => item.searchable.includes(token));

            if (matchesDistrict && matchesQuery) {
                item.element.style.display = '';
                visibleCount++;
            } else {
                item.element.style.display = 'none';
            }
        });

        if (noResults) {
            if (visibleCount === 0 && cardData.length > 0) {
                noResults.classList.remove('d-none');
            } else {
                noResults.classList.add('d-none');
            }
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterCards);
        searchInput.addEventListener('keyup', filterCards);
        searchInput.addEventListener('search', filterCards);
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
            pills.forEach(p => {
                p.classList.remove('active', 'btn-success');
                p.classList.add('btn-outline-secondary');
            });
            this.classList.remove('btn-outline-secondary');
            this.classList.add('active', 'btn-success');

            activeDistrictFilter = (this.getAttribute('data-district') || 'all').trim().toLowerCase();
            filterCards();
        });
    });
});
</script>
@endpush
