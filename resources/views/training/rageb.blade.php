@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="content-section">
                <h1 class="section-title mb-4">{{ __('messages.rageb_training') }}</h1>
                
                <div class="content-body">
                    <p class="lead mb-4">{{ __('messages.rageb_training_intro') }}</p>
                    
                    <div class="training-details mb-5">
                        <h2 class="mb-4">{{ __('messages.training_details') }}</h2>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            <i class="fas fa-book-reader text-primary me-2"></i>
                                            {{ __('messages.course_content') }}
                                        </h3>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ __('messages.rageb_content_1') }}</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ __('messages.rageb_content_2') }}</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ __('messages.rageb_content_3') }}</li>
                                            <li><i class="fas fa-check text-success me-2"></i>{{ __('messages.rageb_content_4') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            <i class="fas fa-info-circle text-primary me-2"></i>
                                            {{ __('messages.course_info') }}
                                        </h3>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><i class="fas fa-clock text-info me-2"></i>{{ __('messages.duration') }}: {{ __('messages.rageb_duration') }}</li>
                                            <li class="mb-2"><i class="fas fa-users text-info me-2"></i>{{ __('messages.batch_size') }}: {{ __('messages.rageb_batch_size') }}</li>
                                            <li class="mb-2"><i class="fas fa-calendar-alt text-info me-2"></i>{{ __('messages.class_schedule') }}: {{ __('messages.rageb_schedule') }}</li>
                                            <li><i class="fas fa-money-bill-wave text-info me-2"></i>{{ __('messages.course_fee') }}: {{ __('messages.rageb_fee') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="registration-section text-center">
                        <a href="{{ route('training.register', ['type' => 'rageb']) }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>{{ __('messages.register_now') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="sidebar">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-4">{{ __('messages.course_features') }}</h3>
                        <ul class="list-unstyled feature-list">
                            <li class="mb-3">
                                <i class="fas fa-certificate text-warning me-2"></i>
                                {{ __('messages.certification') }}
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-book text-primary me-2"></i>
                                {{ __('messages.study_materials') }}
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-chalkboard-teacher text-success me-2"></i>
                                {{ __('messages.experienced_teachers') }}
                            </li>
                            <li>
                                <i class="fas fa-hands-helping text-info me-2"></i>
                                {{ __('messages.mentorship') }}
                            </li>
                        </ul>
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
