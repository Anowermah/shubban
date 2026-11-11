@extends('layouts.app')

@section('title', 'দান ব্যর্থ - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body text-center py-5">
                    <div class="failed-icon mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 5rem;"></i>
                    </div>
                    
                    <h1 class="mb-4 text-danger">দুঃখিত!</h1>
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <p class="lead mb-4">
                        আপনার পেমেন্ট প্রসেস করা যায়নি। অনুগ্রহ করে আবার চেষ্টা করুন।
                    </p>

                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h5 class="text-danger mb-3">সম্ভাব্য কারণসমূহ:</h5>
                            <ul class="text-start">
                                <li>আপনার একাউন্টে পর্যাপ্ত ব্যালেন্স নেই</li>
                                <li>ট্রানজেকশন টাইম আউট হয়েছে</li>
                                <li>ইন্টারনেট সংযোগে সমস্যা</li>
                                <li>পেমেন্ট গেটওয়েতে সমস্যা</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('donate.index') }}" class="btn btn-danger">আবার চেষ্টা করুন</a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary ms-2">হোম পেজে ফিরে যান</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 15px;
    }
    .failed-icon {
        animation: shake 0.5s ease-in-out;
    }
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }
    ul {
        list-style-type: none;
        padding-left: 0;
    }
    ul li {
        padding: 8px 0;
        position: relative;
        padding-left: 25px;
    }
    ul li:before {
        content: "•";
        color: #dc3545;
        font-weight: bold;
        position: absolute;
        left: 0;
    }
</style>
@endpush
