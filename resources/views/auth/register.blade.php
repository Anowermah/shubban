@extends('layouts.app')

@section('title', 'নতুন অ্যাকাউন্ট নিবন্ধন - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@push('styles')
<style>
    .auth-page-wrap {
        background: linear-gradient(135deg, #f3f6f4 0%, #e7eee9 100%);
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        padding: 50px 15px;
    }
    .auth-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(12, 75, 54, 0.08), 0 5px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(12, 75, 54, 0.1);
        overflow: hidden;
    }
    .auth-card-header {
        background: linear-gradient(135deg, #072b1f 0%, #0C4B36 100%);
        color: #ffffff;
        padding: 30px 25px 25px;
        text-align: center;
        position: relative;
    }
    .auth-card-header::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #FBB040 0%, #f7d070 100%);
    }
    .auth-logo-img {
        width: 70px;
        height: 70px;
        object-fit: contain;
        background: #ffffff;
        border-radius: 50%;
        padding: 6px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        margin-bottom: 12px;
    }
    .auth-header-title {
        font-size: 1.35rem;
        font-weight: 700;
        margin-bottom: 4px;
        letter-spacing: -0.3px;
    }
    .auth-header-sub {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.85);
        margin: 0;
    }
    .auth-card-body {
        padding: 35px 30px;
    }
    .form-floating-custom {
        position: relative;
        margin-bottom: 18px;
    }
    .form-floating-custom .form-control {
        height: 50px;
        padding: 12px 18px 12px 45px;
        border-radius: 12px;
        border: 1.5px solid #d5dfd9;
        font-size: 0.95rem;
        background-color: #fbfdfc;
        transition: all 0.2s ease;
    }
    .form-floating-custom .form-control:focus {
        border-color: #0C4B36;
        box-shadow: 0 0 0 3.5px rgba(12, 75, 54, 0.15);
        background-color: #ffffff;
    }
    .form-floating-custom .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #0C4B36;
        font-size: 1.05rem;
        z-index: 4;
    }
    .password-toggle-btn {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #718096;
        cursor: pointer;
        padding: 5px;
        z-index: 4;
    }
    .btn-auth-primary {
        background: linear-gradient(135deg, #0C4B36 0%, #166547 100%);
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
        padding: 13px 20px;
        border-radius: 12px;
        border: none;
        width: 100%;
        box-shadow: 0 4px 12px rgba(12, 75, 54, 0.25);
        transition: all 0.25s ease;
    }
    .btn-auth-primary:hover {
        background: linear-gradient(135deg, #07281d 0%, #0C4B36 100%);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(12, 75, 54, 0.35);
    }
    .auth-divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 25px 0 20px;
        color: #8c9b93;
        font-size: 0.88rem;
    }
    .auth-divider::before, .auth-divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px dashed #d0dcd4;
    }
    .auth-divider:not(:empty)::before {
        margin-right: .75em;
    }
    .auth-divider:not(:empty)::after {
        margin-left: .75em;
    }
    .guest-action-card {
        background: #f7faf8;
        border: 1.5px dashed #c0d8cb;
        border-radius: 14px;
        padding: 16px;
        text-align: center;
        margin-top: 15px;
    }
    .guest-action-card p {
        font-size: 0.85rem;
        color: #4a5568;
        margin-bottom: 10px;
    }
    .btn-guest-action {
        background: #ffffff;
        color: #0C4B36;
        font-weight: 600;
        font-size: 0.92rem;
        border: 1.5px solid #0C4B36;
        padding: 9px 20px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-guest-action:hover {
        background: #0C4B36;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(12, 75, 54, 0.2);
    }
</style>
@endpush

@section('content')
<div class="auth-page-wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="auth-card">
                    <!-- Header -->
                    <div class="auth-card-header">
                        <a href="{{ url('/') }}" title="হোমপেজে ফিরে যান">
                            <img src="{{ asset('images/logo.png') }}" alt="শুব্বান লোগো" class="auth-logo-img">
                        </a>
                        <h2 class="auth-header-title">নতুন একাউন্ট নিবন্ধন</h2>
                        <p class="auth-header-sub">শুব্বানের দাওয়াতী পরিবারে আপনাকে স্বাগতম</p>
                    </div>

                    <!-- Body -->
                    <div class="auth-card-body">
                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Full Name -->
                            <div class="form-floating-custom">
                                <i class="fas fa-user input-icon"></i>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="আপনার পূর্ণ নাম">
                            </div>

                            <!-- Email -->
                            <div class="form-floating-custom">
                                <i class="fas fa-envelope input-icon"></i>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="আপনার ইমেইল ঠিকানা">
                            </div>

                            <!-- Password -->
                            <div class="form-floating-custom">
                                <i class="fas fa-lock input-icon"></i>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="নতুন পাসওয়ার্ড (কমপক্ষে ৬ অক্ষর)">
                                <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password', this)" aria-label="Toggle password visibility">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-floating-custom">
                                <i class="fas fa-check-circle input-icon"></i>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="পাসওয়ার্ড নিশ্চিত করুন">
                                <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password-confirm', this)" aria-label="Toggle password visibility">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>

                            <!-- Terms Notice -->
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="termsCheck" required checked style="accent-color: #0C4B36;">
                                <label class="form-check-label text-muted font-sm" for="termsCheck" style="font-size: 0.85rem;">
                                    আমি জমঈয়ত শুব্বানের নীতিমালা ও নির্দেশিকা মেনে চলব।
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-auth-primary">
                                <i class="fas fa-user-plus me-2"></i> একাউন্ট তৈরি করুন
                            </button>
                        </form>

                        <!-- Already have account -->
                        <div class="text-center mt-3 pt-2">
                            <span class="text-muted font-sm">ইতিমধ্যে একাউন্ট আছে?</span>
                            <a href="{{ route('login') }}" class="fw-bold ms-1" style="color: #0C4B36; text-decoration: none;">
                                লগইন করুন <i class="fas fa-arrow-right font-xs"></i>
                            </a>
                        </div>

                        <!-- Guest Mode Option -->
                        <div class="auth-divider">
                            <span>অথবা গেস্ট ব্রাউজিং</span>
                        </div>

                        <div class="guest-action-card">
                            <p>
                                <i class="fas fa-compass text-warning me-1"></i>
                                রেজিস্ট্রেশন ছাড়াই ওয়েবসাইট ও প্রকাশনা দেখতে চান?
                            </p>
                            <a href="{{ route('guest') }}" class="btn-guest-action">
                                <i class="fas fa-user-shield text-success"></i> গেস্ট হিসেবে চালিয়ে যান
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Back to Homepage Link -->
                <div class="text-center mt-4">
                    <a href="{{ url('/') }}" class="text-decoration-none text-muted font-sm">
                        <i class="fas fa-chevron-left me-1"></i> প্রধান ওয়েবসাইটে ফিরে যান
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePasswordVisibility(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
