@extends('admin.layouts.app')

@section('title', 'আর্কাইভ গ্যালারি')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">আর্কাইভ গ্যালারি</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.gallery-archives.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> নতুন আর্কাইভ
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Year</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($archives as $archive)
                                <tr>
                                    <td>{{ $archive->title }}</td>
                                    <td>{{ $archive->year }}</td>
                                    <td>
                                        <span class="badge badge-{{ $archive->status ? 'success' : 'danger' }}">
                                            {{ $archive->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.gallery-archives.edit', $archive) }}" 
                                           class="btn btn-sm btn-primary">
                                            Edit
                                        </a>
                                        
                                        <form action="{{ route('admin.gallery-archives.destroy', $archive) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this archive?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $archives->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
