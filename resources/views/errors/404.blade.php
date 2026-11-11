@extends('layouts.app')

@section('title', '404 - পাতাটি পাওয়া যায়নি')

@section('content')
<div class="error-page min-vh-100 d-flex align-items-center position-relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="animated-bg">
        <div class="circle circle-1" data-speed="1.5"></div>
        <div class="circle circle-2" data-speed="1.2"></div>
        <div class="circle circle-3" data-speed="0.8"></div>
        <div class="square square-1" data-speed="1.3"></div>
        <div class="square square-2" data-speed="0.9"></div>
        <div class="triangle triangle-1" data-speed="1.1"></div>
        <div class="triangle triangle-2" data-speed="1.4"></div>
    </div>

    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <div class="error-content">
                    <div class="glitch-wrapper mb-4">
                        <h1 class="error-title glitch" data-text="404">404</h1>
                    </div>
                    
                    <div class="error-image-wrapper mb-4">
                        <div class="search-animation">
                            <div class="search-icon">
                                <div class="circle-outer">
                                    <div class="circle-inner"></div>
                                </div>
                                <div class="handle"></div>
                            </div>
                            <div class="planet"></div>
                            <div class="star star1"></div>
                            <div class="star star2"></div>
                            <div class="star star3"></div>
                        </div>
                    </div>

                    <div class="error-message">
                        <h2 class="error-heading mb-3 text-gradient">দুঃখিত! পাতাটি পাওয়া যায়নি</h2>
                        <p class="error-description mb-4">
                            আপনি যে পাতাটি খুঁজছেন তা এই মুহূর্তে পাওয়া যাচ্ছে না।<br>
                            হয়তো পাতাটি সরানো হয়েছে অথবা লিংকটি ভুল।
                        </p>
                    </div>

                    <div class="error-actions">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-glow btn-lg me-3">
                            <i class="fas fa-home me-2"></i>হোম পেইজে যান
                        </a>
                        <button onclick="window.history.back()" class="btn btn-outline-secondary btn-hover-glow btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>পূর্বের পাতায় ফিরুন
                        </button>
                    </div>

                    <div class="search-suggestion mt-5">
                        <p class="suggestion-text mb-3">আপনি এগুলো দেখতে পারেন:</p>
                        <div class="suggestion-links">
                            <a href="{{ route('about.index') }}" class="suggestion-link">আমাদের সম্পর্কে</a>
                            <span class="separator">•</span>
                            <a href="{{ route('contact.index') }}" class="suggestion-link">যোগাযোগ</a>
                            <span class="separator">•</span>
                            <a href="{{ route('notice.index') }}" class="suggestion-link">নোটিশ বোর্ড</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .error-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    /* Animated Background */
    .animated-bg {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }

    .circle {
        position: absolute;
        border-radius: 50%;
        opacity: 0.1;
        transition: transform 0.3s ease;
    }

    .circle-1 {
        width: 300px;
        height: 300px;
        background: #dc3545;
        top: -50px;
        right: -50px;
    }

    .circle-2 {
        width: 200px;
        height: 200px;
        background: #fd7e14;
        bottom: 10%;
        right: 20%;
    }

    .circle-3 {
        width: 150px;
        height: 150px;
        background: #0dcaf0;
        top: 30%;
        left: 15%;
    }

    .square {
        position: absolute;
        background: rgba(13, 110, 253, 0.1);
        transition: transform 0.3s ease;
    }

    .square-1 {
        width: 200px;
        height: 200px;
        top: 20%;
        right: 30%;
        transform: rotate(45deg);
    }

    .square-2 {
        width: 120px;
        height: 120px;
        bottom: 15%;
        left: 5%;
        transform: rotate(20deg);
    }

    .triangle {
        position: absolute;
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-bottom: 86.6px solid rgba(220, 53, 69, 0.1);
        transition: transform 0.3s ease;
    }

    .triangle-1 {
        top: 20%;
        left: 20%;
        transform: rotate(30deg);
    }

    .triangle-2 {
        bottom: 20%;
        right: 10%;
        transform: rotate(-15deg);
    }

    /* Glitch Effect */
    .glitch-wrapper {
        position: relative;
    }

    .error-title {
        font-size: 150px;
        font-weight: 900;
        margin: 0;
        color: #dc3545;
        position: relative;
        text-shadow: 0.05em 0 0 #dc3545, -0.025em -0.05em 0 #fd7e14,
                     0.025em 0.05em 0 #0dcaf0;
        animation: glitch 725ms infinite;
    }

    @keyframes glitch {
        0% { 
            text-shadow: 0.05em 0 0 #dc3545, -0.025em -0.05em 0 #fd7e14,
                        0.025em 0.05em 0 #0dcaf0;
        }
        30% { 
            text-shadow: 0.05em 0 0 #dc3545, -0.025em -0.05em 0 #fd7e14,
                        0.025em 0.05em 0 #0dcaf0;
        }
        31% { 
            text-shadow: -0.05em 0 0 #dc3545, 0.025em -0.05em 0 #fd7e14,
                        -0.025em 0.05em 0 #0dcaf0;
        }
        45% { 
            text-shadow: -0.05em 0 0 #dc3545, 0.025em -0.05em 0 #fd7e14,
                        -0.025em 0.05em 0 #0dcaf0;
        }
        46% { 
            text-shadow: 0.025em 0.05em 0 #dc3545, -0.05em 0 0 #fd7e14,
                        0.05em 0 0 #0dcaf0;
        }
        100% { 
            text-shadow: 0.025em 0.05em 0 #dc3545, -0.05em 0 0 #fd7e14,
                        0.05em 0 0 #0dcaf0;
        }
    }

    /* Search Animation */
    .search-animation {
        width: 150px;
        height: 150px;
        margin: 0 auto;
        position: relative;
    }

    .search-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .circle-outer {
        width: 100px;
        height: 100px;
        border: 8px solid #dc3545;
        border-radius: 50%;
        position: relative;
        animation: pulse 2s infinite;
    }

    .circle-inner {
        width: 100%;
        height: 100%;
        background: rgba(220, 53, 69, 0.1);
        border-radius: 50%;
        animation: innerPulse 2s infinite;
    }

    .handle {
        position: absolute;
        width: 8px;
        height: 50px;
        background: #dc3545;
        bottom: -30px;
        right: -20px;
        transform: rotate(45deg);
        transform-origin: top center;
    }

    .planet {
        width: 20px;
        height: 20px;
        background: #fd7e14;
        border-radius: 50%;
        position: absolute;
        top: 20%;
        right: 15%;
        animation: orbit 8s infinite linear;
    }

    .star {
        width: 4px;
        height: 4px;
        background: #ffc107;
        border-radius: 50%;
        position: absolute;
        animation: twinkle 1s infinite;
    }

    .star1 { top: 30%; left: 20%; }
    .star2 { top: 50%; right: 25%; animation-delay: 0.3s; }
    .star3 { bottom: 30%; left: 30%; animation-delay: 0.6s; }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    @keyframes innerPulse {
        0% { opacity: 0.3; }
        50% { opacity: 0.6; }
        100% { opacity: 0.3; }
    }

    @keyframes orbit {
        from { transform: rotate(0deg) translateX(50px) rotate(0deg); }
        to { transform: rotate(360deg) translateX(50px) rotate(-360deg); }
    }

    @keyframes twinkle {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    /* Text Gradient */
    .text-gradient {
        background: linear-gradient(45deg, #dc3545, #fd7e14);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    /* Content Styling */
    .error-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 2rem;
        padding: 3rem;
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
    }

    .error-description {
        font-size: 1.2rem;
        color: #6c757d;
        line-height: 1.8;
    }

    /* Button Styles */
    .btn-glow {
        position: relative;
        background: linear-gradient(45deg, #0d6efd, #0dcaf0);
        border: none;
        color: white;
        overflow: hidden;
        z-index: 1;
    }

    .btn-glow::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 200%;
        height: 100%;
        background: linear-gradient(115deg, transparent 0%, transparent 40%, rgba(255,255,255,0.6) 50%, transparent 60%, transparent 100%);
        transform: translateX(-100%);
        transition: transform 0.6s;
        z-index: -1;
    }

    .btn-glow:hover::before {
        transform: translateX(0);
    }

    .btn-hover-glow:hover {
        box-shadow: 0 0 15px rgba(13, 110, 253, 0.5);
    }

    /* Suggestion Links */
    .search-suggestion {
        border-top: 1px solid rgba(108, 117, 125, 0.2);
        padding-top: 2rem;
    }

    .suggestion-text {
        color: #6c757d;
        font-size: 1.1rem;
    }

    .suggestion-links {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .suggestion-link {
        color: #0d6efd;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .suggestion-link:hover {
        color: #0a58ca;
        text-decoration: underline;
    }

    .separator {
        color: #6c757d;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .error-title {
            font-size: 100px;
        }
        
        .error-content {
            padding: 2rem;
            margin: 1rem;
        }
        
        .error-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn {
            width: 100%;
            margin: 0 !important;
        }
        
        .search-animation {
            width: 120px;
            height: 120px;
        }

        .circle-outer {
            width: 80px;
            height: 80px;
        }

        .handle {
            height: 40px;
            bottom: -25px;
            right: -15px;
        }

        .animated-bg div {
            transform: scale(0.7);
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add mouse parallax effect to background elements
    document.addEventListener('mousemove', function(e) {
        const moveX = (e.clientX - window.innerWidth/2) * 0.01;
        const moveY = (e.clientY - window.innerHeight/2) * 0.01;
        
        document.querySelectorAll('.circle, .square, .triangle').forEach(elem => {
            const speed = parseFloat(elem.getAttribute('data-speed')) || 1;
            elem.style.transform = `translate(${moveX * speed}px, ${moveY * speed}px)`;
        });
    });
});
</script>
@endpush

@endsection
