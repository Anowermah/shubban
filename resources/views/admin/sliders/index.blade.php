@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('admin.layouts.app')

@section('title', 'স্লাইডার ব্যবস্থাপনা')

@section('content')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">স্লাইডার ব্যবস্থাপনা</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> নতুন স্লাইড যোগ করুন
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ক্রম</th>
                                    <th>ছবি</th>
                                    <th>শিরোনাম</th>
                                    <th>অবস্থা</th>
                                    <th>অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->order }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $slider->image) }}" 
                                             alt="স্লাইডার ছবি" 
                                             class="img-thumbnail"
                                             style="max-width: 150px;">
                                    </td>
                                    <td>{{ $slider->title }}</td>
                                    <td>
                                        <span class="badge bg-{{ $slider->status ? 'success' : 'danger' }}">
                                            {{ $slider->status ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.sliders.edit', $slider) }}" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i> সম্পাদনা
                                        </a>
                                        <form action="{{ route('admin.sliders.destroy', $slider) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('আপনি কি নিশ্চিত?')">
                                                <i class="fas fa-trash"></i> মুছুন
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endsection
