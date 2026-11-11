@extends('admin.layouts.app')

@section('title', 'বিভাগসমূহ')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="mb-0">বিভাগসমূহ</h5>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.departments.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> নতুন বিভাগ
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach($departments as $department)
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm hover-shadow">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="department-icon">
                                            <i class="fas fa-building fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.departments.edit', $department) }}" class="btn btn-sm btn-info me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.departments.destroy', $department) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('আপনি কি নিশ্চিত?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="text-center mb-4">
                                        <h5 class="card-title mb-1">{{ $department->name }}</h5>
                                        <div class="badge {{ $department->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $department->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                        </div>
                                    </div>

                                    <div class="department-head mb-4">
                                        <div class="d-flex align-items-center">
                                            <div class="head-avatar me-3">
                                                <i class="fas fa-user-circle fa-2x text-secondary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">{{ $department->head }}</h6>
                                                <small class="text-muted">{{ $department->designation }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-muted small mb-0">বিভাগের বিবরণ:</p>
                                        <p class="mb-0">{{ Str::limit($department->description, 100) }}</p>
                                    </div>

                                    <div class="contact-info small">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            <span>{{ $department->email }}</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-phone text-primary me-2"></i>
                                            <span>{{ $department->phone }}</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                            <span>{{ $department->location }}</span>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-users text-primary me-2"></i>
                                            <span class="small">কর্মী সংখ্যা: {{ $department->staff_count }} জন</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-sort text-primary me-2"></i>
                                            <span class="small">ক্রম: {{ $department->order }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
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
    height: 50px;
    width: 50px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.head-avatar {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 50%;
}

.badge {
    font-size: 0.75rem;
    padding: 0.4rem 0.8rem;
}
</style>
@endsection
