@extends('layouts.app')

@section('title', 'আর্কাইভ গ্যালারি')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4">আর্কাইভ গ্যালারি</h2>
            
            <!-- Gallery Grid -->
            <div class="row g-4">
                @forelse($archives as $archive)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <a href="{{ route('gallery.archives.show', $archive) }}" class="text-decoration-none">
                                <img src="{{ asset('storage/' . $archive->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $archive->title }}"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">{{ $archive->title }}</h5>
                                    @if($archive->description)
                                        <p class="card-text text-muted">{{ Str::limit($archive->description, 100) }}</p>
                                    @endif
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt"></i> 
                                            {{ $archive->event_date->format('d/m/Y') }}
                                        </small>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            কোন আর্কাইভ পাওয়া যায়নি।
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $archives->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
