@extends('layouts.app')

@section('title', 'কেন্দ্রীয় কমিটি')

@section('content')
<div class="committee-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-dark mb-3">কেন্দ্রীয় কমিটি</h1>
            <h4 class="text-muted">২০২৩-২০২৫</h4>
            <div class="divider mx-auto"></div>
        </div>

        <div class="row g-3">
            @foreach($members as $member)
                <div class="col-xl col-lg-3 col-md-4 col-6">
                    <div class="profile-card {{ $member->order <= 3 ? 'key-member' : '' }}" 
                         data-bs-toggle="modal" 
                         data-bs-target="#previewModal-{{ $member->id }}">
                        <div class="profile-image">
                            <img src="{{ asset('storage/' . $member->image) }}" 
                                 alt="{{ $member->name }}"
                                 onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                        </div>
                        <div class="profile-info">
                            <h3 class="profile-name">{{ $member->name }}</h3>
                            <div class="profile-designation">{{ $member->designation }}</div>
                        </div>
                    </div>
                </div>

                <!-- Preview Modal -->
                <div class="modal fade" id="previewModal-{{ $member->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal"></button>
                                <div class="card border-0">
                                    <div class="row g-0">
                                        <div class="col-md-5">
                                            <div class="position-relative h-100">
                                                <img src="{{ asset('storage/' . $member->image) }}" 
                                                     class="w-100 h-100 object-fit-cover" 
                                                     alt="{{ $member->name }}"
                                                     onerror="this.src='{{ asset('images/default-avatar.png') }}'"
                                                     style="min-height: 400px;">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card-body p-4">
                                                <h2 class="card-title mb-1 display-6">{{ $member->name }}</h2>
                                                <p class="text-success fw-bold fs-4 mb-4">{{ $member->designation }}</p>
                                                
                                                <div class="contact-details fs-5">
                                                    @if($member->phone)
                                                        <p class="mb-3">
                                                            <i class="fas fa-phone text-primary me-2"></i>
                                                            {{ $member->phone }}
                                                        </p>
                                                    @endif
                                                    
                                                    @if($member->email)
                                                        <p class="mb-3">
                                                            <i class="fas fa-envelope text-primary me-2"></i>
                                                            {{ $member->email }}
                                                        </p>
                                                    @endif
                                                    
                                                    @if($member->address)
                                                        <p class="mb-3">
                                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                            {{ $member->address }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .committee-section {
        background-color: #f8f9fa;
    }

    .divider {
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #0C4B36, #FBB040);
        border-radius: 2px;
        margin-top: 1.5rem;
    }

    .profile-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid rgba(0, 0, 0, 0.05);
        cursor: pointer;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(12, 75, 54, 0.15);
        border-color: #0C4B36;
    }

    .profile-image {
        position: relative;
        width: 100%;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        overflow: hidden;
    }

    .profile-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .profile-card:hover .profile-image img {
        transform: scale(1.05);
    }

    .profile-info {
        padding: 1rem;
        text-align: center;
    }

    .profile-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.3rem;
        line-height: 1.3;
    }

    .profile-designation {
        color: #0C4B36;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .profile-contacts {
        text-align: left;
    }

    .contact-item {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .contact-item i {
        color: #0C4B36;
        width: 20px;
        margin-right: 8px;
    }

    .key-member {
        border: 2px solid #0C4B36;
    }

    .key-member .profile-info {
        background: linear-gradient(to bottom, #fff, #f0fdf4);
    }

    .modal-dialog {
        max-width: 900px;
    }

    .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .modal-body {
        padding: 0;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    .contact-details p {
        color: #555;
    }

    .contact-details i {
        width: 25px;
    }

    @media (max-width: 1200px) {
        .profile-name {
            font-size: 1rem;
        }
        
        .profile-designation {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 768px) {
        .profile-info {
            padding: 0.8rem;
        }
        
        .profile-name {
            font-size: 0.95rem;
        }
        
        .profile-designation {
            font-size: 0.8rem;
        }

        .modal-dialog {
            margin: 0.5rem;
        }

        .modal-body img {
            min-height: 250px !important;
        }
    }
</style>
@endpush
