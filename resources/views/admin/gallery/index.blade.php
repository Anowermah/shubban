@extends('admin.layouts.app')

@section('title', 'গ্যালারি')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">গ্যালারি</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> নতুন ছবি যোগ করুন
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row g-4">
                @forelse($images ?? [] as $image)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top" alt="{{ $image->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $image->title }}</h5>
                                <p class="card-text">{{ $image->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.gallery.edit', $image->id) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i> সম্পাদনা
                                        </a>
                                        <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('আপনি কি নিশ্চিত?')">
                                                <i class="fas fa-trash"></i> মুছুন
                                            </button>
                                        </form>
                                    </div>
                                    <small class="text-muted">{{ $image->created_at->format('d/m/Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            কোন ছবি পাওয়া যায়নি। নতুন ছবি যোগ করতে উপরের বাটনে ক্লিক করুন।
                        </div>
                    </div>
                @endforelse
            </div>

            @if(isset($images) && $images->hasPages())
                <div class="mt-4">
                    {{ $images->links('vendor.pagination.bootstrap-5') }}
                </div>
            @endif
        @endsection
