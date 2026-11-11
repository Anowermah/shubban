@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="text-center mb-5">
                <h1 class="display-4 mb-3">{{ __('messages.central_responsible') }}</h1>
                <div class="title-separator mx-auto"></div>
            </div>
            
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @forelse($managers as $manager)
                    <div class="col">
                        <div class="card h-100 member-card">
                            <div class="star-shape">
                                <div class="star-content">
                                    @if($manager->image)
                                        <div class="member-image-wrapper">
                                            <img src="{{ asset('storage/' . $manager->image) }}" 
                                                 alt="{{ $manager->name }}" 
                                                 class="member-image">
                                        </div>
                                    @else
                                        <div class="member-image-wrapper">
                                            <div class="member-image-placeholder">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="star-body text-center">
                                        <h4 class="member-name mb-2">{{ $manager->name }}</h4>
                                        <p class="member-designation mb-3">{{ $manager->designation }}</p>
                                        
                                        <div class="member-contact">
                                            @if($manager->phone)
                                                <a href="tel:{{ $manager->phone }}" class="contact-link" data-bs-toggle="tooltip" title="কল করুন">
                                                    <i class="fas fa-phone-alt"></i>
                                                </a>
                                            @endif
                                            
                                            @if($manager->email)
                                                <a href="mailto:{{ $manager->email }}" class="contact-link" data-bs-toggle="tooltip" title="ইমেইল করুন">
                                                    <i class="fas fa-envelope"></i>
                                                </a>
                                            @endif
                                            
                                            <button type="button" class="contact-link border-0 bg-transparent" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#managerModal{{ $manager->id }}"
                                                    title="বিস্তারিত দেখুন">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Manager Details Modal -->
                    <div class="modal fade" id="managerModal{{ $manager->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 pb-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center pt-0">
                                    <div class="star-shape modal-star">
                                        <div class="star-content">
                                            @if($manager->image)
                                                <div class="member-image-wrapper modal-image">
                                                    <img src="{{ asset('storage/' . $manager->image) }}" 
                                                         alt="{{ $manager->name }}" 
                                                         class="member-image">
                                                </div>
                                            @else
                                                <div class="member-image-wrapper modal-image">
                                                    <div class="member-image-placeholder">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <h4 class="member-name mb-2">{{ $manager->name }}</h4>
                                    <p class="member-designation mb-4">{{ $manager->designation }}</p>
                                    
                                    <div class="row g-3">
                                        @if($manager->address)
                                            <div class="col-12">
                                                <div class="detail-item">
                                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                    {{ $manager->address }}
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($manager->phone)
                                            <div class="col-sm-6">
                                                <div class="detail-item">
                                                    <i class="fas fa-phone-alt text-primary me-2"></i>
                                                    <a href="tel:{{ $manager->phone }}" class="text-decoration-none">
                                                        {{ $manager->phone }}
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($manager->email)
                                            <div class="col-sm-6">
                                                <div class="detail-item">
                                                    <i class="fas fa-envelope text-primary me-2"></i>
                                                    <a href="mailto:{{ $manager->email }}" class="text-decoration-none">
                                                        {{ $manager->email }}
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="no-data-wrapper py-5">
                            <i class="fas fa-users text-muted mb-3"></i>
                            <p class="text-muted">{{ __('messages.no_data_found') }}</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .title-separator {
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #ff0000, #28a745);
        border-radius: 2px;
        margin-top: 1rem;
    }

    .member-card {
        border: none;
        background: transparent;
        margin-bottom: 2rem;
    }

    .star-shape {
        position: relative;
        width: 100%;
        padding-top: 100%;
    }

    .star-content {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: white;
        clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .star-shape:hover .star-content {
        transform: scale(1.05);
    }

    .modal-star {
        width: 200px;
        height: 200px;
        padding-top: 0;
        margin: 0 auto 2rem;
    }
    
    .member-image-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto 1rem;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #28a745;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .modal-image {
        width: 100px;
        height: 100px;
    }
    
    .member-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .member-image-placeholder {
        width: 100%;
        height: 100%;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .member-image-placeholder i {
        font-size: 2rem;
        color: #dee2e6;
    }
    
    .member-name {
        color: #2c3e50;
        font-weight: 600;
        font-size: 1.1rem;
        margin: 0;
    }
    
    .member-designation {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 0.5rem 0;
    }
    
    .member-contact {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }
    
    .contact-link {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f8f9fa;
        color: #2c3e50;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }
    
    .contact-link:hover {
        background: #28a745;
        color: white;
        transform: translateY(-2px);
    }
    
    .detail-item {
        background: #f8f9fa;
        padding: 0.75rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .detail-item:hover {
        background: #e9ecef;
    }

    .no-data-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .no-data-wrapper i {
        font-size: 3rem;
        color: #dc3545;
    }

    @media (max-width: 767.98px) {
        .star-shape {
            width: 80%;
            margin: 0 auto;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush

@endsection
