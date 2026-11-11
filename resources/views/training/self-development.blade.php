@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="content-section">
                <h1 class="section-title mb-4">{{ __('messages.self_development') }}</h1>
                
                <div class="content-body">
                    <p class="lead mb-4">{{ __('messages.self_development_intro') }}</p>
                    
                    <div class="development-areas mb-5">
                        <h2 class="mb-4">{{ __('messages.development_areas') }}</h2>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            <i class="fas fa-brain text-primary me-2"></i>
                                            {{ __('messages.personal_growth') }}
                                        </h3>
                                        <p class="card-text">{{ __('messages.personal_growth_desc') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            <i class="fas fa-book-reader text-primary me-2"></i>
                                            {{ __('messages.islamic_studies') }}
                                        </h3>
                                        <p class="card-text">{{ __('messages.islamic_studies_desc') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            <i class="fas fa-users text-primary me-2"></i>
                                            {{ __('messages.leadership') }}
                                        </h3>
                                        <p class="card-text">{{ __('messages.leadership_desc') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            <i class="fas fa-hands-helping text-primary me-2"></i>
                                            {{ __('messages.social_skills') }}
                                        </h3>
                                        <p class="card-text">{{ __('messages.social_skills_desc') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="development-resources">
                        <h2 class="mb-4">{{ __('messages.resources') }}</h2>
                        
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                {{ __('messages.self_development_guide') }}
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-video text-primary me-2"></i>
                                {{ __('messages.video_lectures') }}
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-book text-success me-2"></i>
                                {{ __('messages.recommended_books') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="sidebar">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-4">{{ __('messages.upcoming_programs') }}</h3>
                        <div class="upcoming-programs">
                            <div class="program-item mb-3 pb-3 border-bottom">
                                <h4 class="h6 mb-2">{{ __('messages.leadership_workshop') }}</h4>
                                <p class="small text-muted mb-0">
                                    <i class="fas fa-calendar-alt me-2"></i> 
                                    {{ __('messages.program_date') }}
                                </p>
                            </div>
                            <div class="program-item mb-3 pb-3 border-bottom">
                                <h4 class="h6 mb-2">{{ __('messages.quran_study') }}</h4>
                                <p class="small text-muted mb-0">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    {{ __('messages.program_date_2') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4">{{ __('messages.contact_coordinator') }}</h3>
                        <p class="mb-2">
                            <i class="fas fa-user text-primary me-2"></i>
                            {{ __('messages.coordinator_name') }}
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-phone text-primary me-2"></i>
                            +880 1765812261
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            training@shubbanbd.org
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
