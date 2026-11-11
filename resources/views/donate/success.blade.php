@extends('layouts.app')

@section('title', 'দান সফল - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body text-center py-5">
                    <div class="success-icon mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>
                    
                    <h1 class="mb-4">আলহামদুলিল্লাহ!</h1>
                    
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    
                    <p class="lead mb-4">
                        আপনার দানের জন্য আন্তরিক ধন্যবাদ। আল্লাহ তা'আলা আপনার দান কবুল করুন।
                    </p>

                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <p class="arabic-text mb-3" style="font-size: 1.3rem; line-height: 2.3rem;">
                                اللَّهُمَّ اجْعَلْهُ لَهُمْ طَهُورًا وَنَمَاءً وَأَجْرًا
                            </p>
                            <p class="mb-0">
                                "হে আল্লাহ! এই দানকে তাদের জন্য পবিত্রতা, বৃদ্ধি ও পুরস্কারের মাধ্যম বানিয়ে দিন।"
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('donate.index') }}" class="btn btn-success">আবার দান করুন</a>
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
    .arabic-text {
        font-family: 'Noto Naskh Arabic', serif;
        direction: rtl;
    }
    .card {
        border-radius: 15px;
    }
    .success-icon {
        animation: scale-in 0.5s ease-out;
    }
    @keyframes scale-in {
        from {
            transform: scale(0);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>
@endpush
