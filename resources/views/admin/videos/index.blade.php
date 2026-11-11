@extends('admin.layouts.app')

@section('title', 'ভিডিও গ্যালারি')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">ভিডিও গ্যালারি</h4>
                    <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> নতুন ভিডিও
                    </a>
                </div>

                <div class="card-body">
                    <!-- Category Filters -->
                    @if($categories->isNotEmpty())
                        <div class="mb-4">
                            <div class="btn-group">
                                <a href="{{ route('admin.videos.index') }}" 
                                   class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }}">
                                    সকল ভিডিও
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('admin.videos.index', ['category' => $category]) }}" 
                                       class="btn {{ request('category') == $category ? 'btn-primary' : 'btn-outline-primary' }}">
                                        {{ $category }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Videos Grid -->
                    <div class="row g-4">
                        @forelse($videos as $video)
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <img src="{{ $video->thumbnail_url }}" 
                                         class="card-img-top" 
                                         alt="{{ $video->title }}"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $video->title }}</h5>
                                        @if($video->description)
                                            <p class="card-text text-muted">{{ Str::limit($video->description, 100) }}</p>
                                        @endif
                                        @if($video->category)
                                            <span class="badge bg-primary">{{ $video->category }}</span>
                                        @endif
                                    </div>
                                    <div class="card-footer bg-white border-top-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <small class="text-muted">{{ $video->date->format('d M, Y') }}</small>
                                                @if(!$video->status)
                                                    <span class="badge bg-warning ms-2">Draft</span>
                                                @endif
                                            </div>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.videos.edit', $video) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.videos.destroy', $video) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Are you sure?')" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info mb-0">
                                    কোন ভিডিও পাওয়া যায়নি।
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $videos->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
