@extends('layouts.app')

@section('title', 'কেন্দ্রীয় কমিটি - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="committee-section py-5">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold mb-2">
                <i class="fas fa-users me-1"></i> সাংগঠনিক নেতৃত্ব
            </span>
            <h1 class="display-6 fw-bold text-dark mb-2">কেন্দ্রীয় কার্যনির্বাহী কমিটি</h1>
            <p class="text-muted fs-5 mb-3">সেশন: ২০২৩-২০২৫</p>
            <div class="divider mx-auto"></div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6 col-md-8 col-12">
                <div class="committee-search-box position-relative shadow-sm rounded-pill bg-white p-1">
                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-4 text-muted"></i>
                    <input type="text" 
                           id="committeeSearch" 
                           class="form-control border-0 rounded-pill ps-5 py-3 shadow-none" 
                           placeholder="কমিটির সদস্যের নাম বা পদবী দিয়ে খুঁজুন...">
                    <button class="btn btn-sm btn-success rounded-pill position-absolute end-0 top-50 translate-middle-y me-2 px-3 py-2" id="clearSearch" style="display: none;">
                        <i class="fas fa-times me-1"></i>ক্লিয়ার
                    </button>
                </div>
            </div>
        </div>

        <!-- Members Grid -->
        <div class="row g-4" id="committeeGrid">
            @forelse($members as $member)
                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 member-col" 
                     data-name="{{ mb_strtolower($member->name) }}" 
                     data-designation="{{ mb_strtolower($member->designation) }}"
                     data-address="{{ mb_strtolower($member->address ?? '') }}">
                    <div class="profile-card h-100 {{ $member->order <= 3 ? 'key-member' : '' }}">
                        <!-- Image Container with Safe Top-Framed Ratio -->
                        <div class="profile-image-wrap" data-bs-toggle="modal" data-bs-target="#previewModal-{{ $member->id }}">
                            @if($member->order <= 3)
                                <div class="key-badge">
                                    <i class="fas fa-star me-1 text-warning"></i>শীর্ষ নেতৃত্ব
                                </div>
                            @endif
                            <img src="{{ asset('storage/' . $member->image) }}" 
                                 alt="{{ $member->name }}"
                                 loading="lazy"
                                 onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                            <div class="profile-hover-overlay">
                                <span><i class="fas fa-eye me-1"></i>প্রোফাইল দেখুন</span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="profile-info d-flex flex-column justify-content-between p-3 p-md-4">
                            <div>
                                <h3 class="profile-name mb-2" data-bs-toggle="modal" data-bs-target="#previewModal-{{ $member->id }}">
                                    {{ $member->name }}
                                </h3>
                                <div class="designation-wrap mb-2">
                                    <span class="designation-pill">
                                        {{ $member->designation }}
                                    </span>
                                </div>
                                @if($member->address)
                                    <div class="profile-address small text-muted">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i>{{ $member->address }}
                                    </div>
                                @endif
                            </div>

                            <!-- Action Button -->
                            <div class="pt-3 mt-3 border-top d-flex gap-2">
                                <button type="button" 
                                        class="btn btn-outline-success btn-sm w-100 rounded-pill py-2 fw-semibold"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#previewModal-{{ $member->id }}">
                                    <i class="fas fa-id-badge me-1"></i>বিস্তারিত
                                </button>
                                @if($member->phone)
                                    <a href="tel:{{ $member->phone }}" 
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
                        <h4 class="fw-bold text-dark">কোনো কমিটির সদস্য পাওয়া যায়নি</h4>
                        <p class="text-muted">বর্তমানে কমিটির তালিকা আপডেট করা হচ্ছে।</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- No Search Results Found message -->
        <div id="noResults" class="text-center py-5 d-none">
            <div class="card border-0 shadow-sm rounded-4 p-5 bg-white">
                <i class="fas fa-search fa-3x text-muted mb-3 opacity-50"></i>
                <h4 class="fw-bold text-dark mb-2">কোনো ফলাফল পাওয়া যায়নি</h4>
                <p class="text-muted mb-0">আপনার সার্চ করা নামের সাথে কোনো কেন্দ্রীয় সদস্য মেলেনি।</p>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- All Modals Rendered Cleanly Outside Row    -->
<!-- ========================================== -->
@foreach($members as $member)
    <div class="modal fade" id="previewModal-{{ $member->id }}" tabindex="-1" aria-labelledby="previewModalLabel-{{ $member->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header border-0 bg-success bg-opacity-10 py-3 px-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success rounded-pill px-3 py-2 fw-semibold">
                            <i class="fas fa-id-card me-1"></i>সদস্য পরিচিতি
                        </span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="row g-0 align-items-stretch">
                        <!-- High Res Member Image with Top-Centered Framing -->
                        <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-3">
                            <div class="modal-image-container w-100 h-100 rounded-3 overflow-hidden shadow-sm" style="min-height: 340px;">
                                <img src="{{ asset('storage/' . $member->image) }}" 
                                     class="w-100 h-100 object-fit-cover" 
                                     alt="{{ $member->name }}"
                                     onerror="this.src='{{ asset('images/default-avatar.png') }}'"
                                     style="object-position: top center;">
                            </div>
                        </div>
                        <!-- Member Profile Details -->
                        <div class="col-md-7">
                            <div class="p-4 p-md-5 d-flex flex-column justify-content-center h-100">
                                <h2 class="h3 fw-bold text-dark mb-1" id="previewModalLabel-{{ $member->id }}">
                                    {{ $member->name }}
                                </h2>
                                <p class="text-success fw-bold fs-5 mb-4">
                                    <i class="fas fa-award me-1"></i>{{ $member->designation }}
                                </p>
                                
                                <div class="list-group list-group-flush mb-4">
                                    @if($member->phone)
                                        <div class="list-group-item px-0 py-2 border-0 d-flex align-items-center">
                                            <div class="icon-circle bg-success bg-opacity-10 text-success me-3">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">মোবাইল নম্বর</small>
                                                <a href="tel:{{ $member->phone }}" class="text-decoration-none fw-semibold text-dark">
                                                    {{ $member->phone }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($member->email)
                                        <div class="list-group-item px-0 py-2 border-0 d-flex align-items-center">
                                            <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">ইমেইল ঠিকানা</small>
                                                <a href="mailto:{{ $member->email }}" class="text-decoration-none fw-semibold text-dark">
                                                    {{ $member->email }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($member->address)
                                        <div class="list-group-item px-0 py-2 border-0 d-flex align-items-center">
                                            <div class="icon-circle bg-danger bg-opacity-10 text-danger me-3">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">এলাকা / জেলা</small>
                                                <span class="fw-semibold text-dark">{{ $member->address }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="d-flex gap-2 pt-2">
                                    @if($member->phone)
                                        <a href="tel:{{ $member->phone }}" class="btn btn-success rounded-pill px-4 py-2 flex-grow-1">
                                            <i class="fas fa-phone-alt me-1"></i>সরাসরি কল
                                        </a>
                                        @php
                                            $cleanPhone = preg_replace('/[^0-9]/', '', $member->phone);
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
    .committee-section {
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
    .committee-search-box {
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    .committee-search-box:focus-within {
        border-color: #0C4B36;
        box-shadow: 0 0 0 4px rgba(12, 75, 54, 0.1) !important;
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

    /* Key Leadership Card (President, Secretary, VP) */
    .profile-card.key-member {
        border: 2px solid #0C4B36;
        box-shadow: 0 6px 20px rgba(12, 75, 54, 0.1);
    }
    .profile-card.key-member .designation-pill {
        background: #0C4B36;
        color: #ffffff;
        border-color: #0C4B36;
    }

    /* Profile Image Container: Fixed 4:5 Portrait Ratio */
    .profile-image-wrap {
        position: relative;
        width: 100%;
        height: 270px;
        background: #edf2f7;
        overflow: hidden;
        cursor: pointer;
    }

    .profile-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center !important; /* Never cuts off faces/caps */
        transition: transform 0.4s ease;
    }

    .profile-card:hover .profile-image-wrap img {
        transform: scale(1.06);
    }

    .profile-hover-overlay {
        position: absolute;
        inset: 0;
        background: rgba(12, 75, 54, 0.6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .profile-card:hover .profile-hover-overlay {
        opacity: 1;
    }

    .key-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(12, 75, 54, 0.9);
        backdrop-filter: blur(4px);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 50px;
        z-index: 2;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Profile Info */
    .profile-info {
        flex-grow: 1;
        text-align: center;
    }

    .profile-name {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        cursor: pointer;
        min-height: 2.8rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease;
    }
    .profile-name:hover {
        color: #0C4B36;
    }

    .designation-pill {
        display: inline-block;
        background: #ecfdf5;
        color: #0C4B36;
        font-weight: 600;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.85rem;
        border: 1px solid rgba(12, 75, 54, 0.15);
        max-width: 100%;
        white-space: normal;
    }

    .icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .profile-image-wrap {
            height: 230px;
        }
        .profile-name {
            font-size: 1.05rem;
            min-height: auto;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('committeeSearch');
        const clearBtn = document.getElementById('clearSearch');
        const memberCols = document.querySelectorAll('.member-col');
        const noResults = document.getElementById('noResults');

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

        const cardData = Array.from(memberCols).map(col => {
            const name = col.getAttribute('data-name') || '';
            const designation = col.getAttribute('data-designation') || '';
            const address = col.getAttribute('data-address') || '';
            const cardText = col.textContent || '';
            
            const fullSearchable = normalizeText(name + ' ' + designation + ' ' + address + ' ' + cardText);

            return {
                element: col,
                searchable: fullSearchable
            };
        });

        function filterMembers() {
            const rawQuery = searchInput ? searchInput.value.trim() : '';
            const normalizedQuery = normalizeText(rawQuery);
            const tokens = normalizedQuery.split(/\s+/).filter(t => t.length > 0);

            if (clearBtn) {
                clearBtn.style.display = rawQuery.length > 0 ? 'inline-block' : 'none';
            }

            let visibleCount = 0;

            cardData.forEach(item => {
                const matchesQuery = tokens.length === 0 || tokens.every(token => item.searchable.includes(token));

                if (matchesQuery) {
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
            searchInput.addEventListener('input', filterMembers);
            searchInput.addEventListener('keyup', filterMembers);
            searchInput.addEventListener('search', filterMembers);
        }

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                searchInput.value = '';
                filterMembers();
                searchInput.focus();
            });
        }
    });
</script>
@endpush
