@extends('layouts.app')

@section('title', 'ইভেন্ট নিবন্ধন: ' . $event->title . ' - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-success text-white py-4 px-4 text-center">
                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-2">
                        <i class="fas fa-ticket-alt me-1"></i> অনলাইন রেজিস্ট্রেশন
                    </span>
                    <h2 class="h4 fw-bold mb-1">{{ $event->title }}</h2>
                    <p class="mb-0 text-white-50 small">
                        <i class="fas fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($event->start_date)->format('d F, Y') }} 
                        @if($event->location) | <i class="fas fa-map-marker-alt me-1"></i> {{ $event->location }} @endif
                    </p>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subject" value="Event Registration: {{ $event->title }}">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">আপনার নাম <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control rounded-pill" value="{{ auth()->user()->name ?? old('name') }}" required placeholder="পূর্ণ নাম লিখুন">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">মোবাইল নম্বর <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control rounded-pill" value="{{ auth()->user()->phone ?? old('phone') }}" required placeholder="০১xxxxxxxxx">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">ইমেইল ঠিকানা</label>
                                <input type="email" name="email" class="form-control rounded-pill" value="{{ auth()->user()->email ?? old('email') }}" placeholder="example@email.com">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">জেলা / এলাকা <span class="text-danger">*</span></label>
                                <input type="text" name="area" class="form-control rounded-pill" value="{{ auth()->user()->address ?? old('area') }}" required placeholder="আপনার জেলা/উপজেলা">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">অতিরিক্ত মন্তব্য বা প্রশ্ন (যদি থাকে)</label>
                                <textarea name="message" rows="3" class="form-control rounded-3" placeholder="আপনার কোনো জিজ্ঞাসা থাকলে লিখুন..."></textarea>
                            </div>

                            <div class="col-12 pt-3">
                                <button type="submit" class="btn btn-success rounded-pill px-5 py-2 w-100 fw-bold">
                                    <i class="fas fa-paper-plane me-1"></i> রেজিস্ট্রেশন সম্পন্ন করুন
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer bg-light py-3 px-4 text-center border-top">
                    <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none text-muted small">
                        <i class="fas fa-arrow-left me-1"></i>ইভেন্টের বিস্তারিত পেজে ফিরে যান
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
