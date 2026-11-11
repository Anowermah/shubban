@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4">{{ $title }}</h2>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($responsiblePersons as $person)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-img-wrapper">
                        <img src="{{ $person['image'] ? asset('storage/' . $person['image']) : asset('images/avatar.png') }}" 
                            class="card-img-top" 
                            alt="{{ $person['name'] }}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">{{ $person['name'] }}</h5>
                        <p class="card-text">
                            <strong>পদবি:</strong> {{ $person['designation'] }}<br>
                            @if($person['phone'])
                                <strong>ফোন:</strong> {{ $person['phone'] }}<br>
                            @endif
                            @if($person['email'])
                                <strong>ইমেইল:</strong> {{ $person['email'] }}
                            @endif
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <div class="d-flex justify-content-around">
                            @if($person['phone'])
                                <a href="tel:{{ $person['phone'] }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-phone me-1"></i> কল করুন
                                </a>
                            @endif
                            @if($person['email'])
                                <a href="mailto:{{ $person['email'] }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-envelope me-1"></i> ইমেইল
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    কোন দায়িত্বপ্রাপ্ত ব্যক্তি পাওয়া যায়নি।
                </div>
            </div>
        @endforelse
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
        border: none;
        background-color: #fff;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .card-img-wrapper {
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        margin: 1rem 1rem 0 1rem;
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-radius: 0.5rem;
    }
    .card-title {
        color: #2c3e50;
        font-weight: 600;
    }
    .card-text {
        color: #6c757d;
    }
    .btn-outline-primary {
        border-width: 2px;
    }
    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }
</style>
@endpush
@endsection
