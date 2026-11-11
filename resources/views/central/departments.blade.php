@extends('layouts.app')

@section('title', 'কেন্দ্রীয় বিভাগসমূহ')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12 mb-5">
            <h2 class="text-center mb-4">আমাদের বিভাগসমূহ</h2>
            <p class="text-center text-muted mb-5">শুববানে ইসলাম বাংলাদেশের বিভিন্ন বিভাগ সমাজের উন্নয়নে নিরলসভাবে কাজ করে যাচ্ছে</p>
        </div>
    </div>

    <div class="row">
        @foreach($departments as $department)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm hover-shadow">
                <div class="card-body">
                    <div class="department-icon mb-3 text-center">
                        <i class="fas fa-building fa-3x text-primary"></i>
                    </div>
                    
                    <h3 class="card-title text-center mb-3">{{ $department->name }}</h3>
                    
                    <p class="card-text text-muted mb-4">{{ $department->description }}</p>
                    
                    <div class="department-head mb-4">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <div class="head-avatar me-3">
                                <i class="fas fa-user-circle fa-3x text-secondary"></i>
                            </div>
                            <div class="head-info">
                                <h5 class="mb-1">{{ $department->head }}</h5>
                                <p class="text-muted mb-0">{{ $department->designation }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="responsibilities mb-4">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-tasks me-2"></i>প্রধান দায়িত্বসমূহ
                        </h5>
                        <ul class="list-unstyled">
                            @foreach($department->responsibilities as $responsibility)
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                {{ $responsibility }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="contact-info">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-envelope text-primary me-3"></i>
                            <span>{{ $department->email }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-phone text-primary me-3"></i>
                            <span>{{ $department->phone }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-3"></i>
                            <span>{{ $department->location }}</span>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <span class="badge bg-primary rounded-pill">
                            <i class="fas fa-users me-1"></i>
                            কর্মী সংখ্যা: {{ $department->staff_count }} জন
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}

.department-icon {
    height: 80px;
    width: 80px;
    margin: 0 auto;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.head-avatar {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 50%;
}

.responsibilities ul li {
    position: relative;
    padding-left: 10px;
}

.contact-info {
    font-size: 0.9rem;
}

.badge {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}
</style>
@endsection
