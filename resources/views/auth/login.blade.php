@extends('layouts.app')

@section('title', 'লগইন - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

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
        transition: transform 0.2s ease;
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
        margin-bottom: 20px;
    }
    .form-floating-custom .form-control {
        height: 52px;
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
        padding: 18px;
        text-align: center;
        margin-top: 15px;
    }
    .guest-action-card p {
        font-size: 0.86rem;
        color: #4a5568;
        margin-bottom: 12px;
    }
    .btn-guest-action {
        background: #ffffff;
        color: #0C4B36;
        font-weight: 600;
        font-size: 0.92rem;
        border: 1.5px solid #0C4B36;
        padding: 10px 22px;
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
                        <h2 class="auth-header-title">ব্যবহারকারী লগইন</h2>
                        <p class="auth-header-sub">জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ</p>
                    </div>

                    <!-- Body -->
                    <div class="auth-card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('login_warning'))
                            <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert" style="background: #fff8e6; border: 1.5px solid #ffeeba; color: #856404; border-radius: 12px;">
                                <i class="fas fa-lock me-2 fs-5 text-warning"></i>
                                <div><strong>সংরক্ষিত পেজ:</strong> {{ session('login_warning') }}</div>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

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

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="form-floating-custom">
                                <i class="fas fa-envelope input-icon"></i>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="আপনার ইমেইল ঠিকানা">
                            </div>

                            <!-- Password -->
                            <div class="form-floating-custom">
                                <i class="fas fa-lock input-icon"></i>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="পাসওয়ার্ড">
                                <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password', this)" aria-label="Toggle password visibility">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>

                            <!-- Remember & Forgot -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="accent-color: #0C4B36;">
                                    <label class="form-check-label text-secondary font-sm" for="remember">
                                        মনে রাখুন
                                    </label>
                                </div>
                                <span class="text-muted font-sm" style="font-size: 0.85rem;">পাসওয়ার্ড নিরাপদ রাখুন</span>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-auth-primary">
                                <i class="fas fa-sign-in-alt me-2"></i> লগইন করুন
                            </button>
                        </form>

                        <!-- Register Link -->
                        <div class="text-center mt-3 pt-2">
                            <span class="text-muted font-sm">এখনো কোনো অ্যাকাউন্ট নেই?</span>
                            <a href="{{ route('register') }}" class="fw-bold ms-1" style="color: #0C4B36; text-decoration: none;">
                                নতুন অ্যাকাউন্ট তৈরি করুন <i class="fas fa-arrow-right font-xs"></i>
                            </a>
                        </div>

                        <!-- Guest Mode Option -->
                        <div class="auth-divider">
                            <span>অথবা গেস্ট ব্রাউজিং</span>
                        </div>

                        <div class="guest-action-card">
                            <p>
                                <i class="fas fa-user-shield text-success me-1"></i>
                                অ্যাকাউন্ট ছাড়াই কি ওয়েবসাইট ব্রাউজ ও কার্যক্রম দেখতে চান?
                            </p>
                            <a href="{{ route('guest') }}" class="btn-guest-action">
                                <i class="fas fa-compass text-warning"></i> গেস্ট হিসেবে চালিয়ে যান
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
