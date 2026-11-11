@extends('admin.layouts.app')

@section('title', 'ফটো গ্যালারি')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-images me-2"></i>ফটো গ্যালারি
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.photos.create') }}" class="btn btn-light">
                            <i class="fas fa-plus"></i> নতুন ছবি
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Category Filters -->
                    @if($categories->count() > 0)
                        <div class="mb-4">
                            <div class="btn-group">
                                <a href="{{ route('admin.photos.index') }}" 
                                   class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }}">
                                    <i class="fas fa-th-large me-1"></i>সকল ছবি
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('admin.photos.index', ['category' => $category]) }}" 
                                       class="btn {{ request('category') == $category ? 'btn-primary' : 'btn-outline-primary' }}">
                                        <i class="fas fa-folder me-1"></i>{{ $category }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="row g-4">
                        @forelse($photos as $photo)
                            <div class="col-md-3">
                                <div class="card h-100 shadow-sm hover-shadow">
                                    <div class="card-img-top position-relative" style="height: 200px; overflow: hidden;">
                                        <img src="{{ $photo->image_url }}" 
                                             class="w-100 h-100"
                                             alt="{{ $photo->title }}"
                                             style="object-fit: cover;">
                                        @if($photo->category)
                                            <div class="position-absolute top-0 start-0 m-2">
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-folder me-1"></i>{{ $photo->category }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="card-body">
                                        <h5 class="card-title text-primary mb-3">{{ $photo->title }}</h5>
                                        <p class="card-text mb-0">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                {{ $photo->date->format('d F, Y') }}
                                            </small>
                                        </p>
                                    </div>

                                    <div class="card-footer bg-transparent border-top-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('admin.photos.edit', $photo) }}" 
                                               class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-edit me-1"></i>সম্পাদনা
                                            </a>
                                            
                                            <form action="{{ route('admin.photos.destroy', $photo) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('আপনি কি নিশ্চিত?')">
                                                    <i class="fas fa-trash me-1"></i>মুছুন
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle me-2"></i>কোন ছবি পাওয়া যায়নি।
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $photos->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .card-img-top img {
        transition: transform 0.3s ease;
    }
    .card:hover .card-img-top img {
        transform: scale(1.1);
    }
    .btn-group .btn {
        border-radius: 0;
    }
    .btn-group .btn:first-child {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }
    .btn-group .btn:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
    .pagination {
        margin-bottom: 0;
    }
    .page-link {
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border-radius: 0.25rem;
    }
</style>
@endpush

@endsection
