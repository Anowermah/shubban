@extends('layouts.app')

@section('title', 'ভিডিও গ্যালারি - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="video-content">
                <h1 class="section-title mb-4">ভিডিও গ্যালারি</h1>

                <!-- Video Categories -->
                <div class="video-categories mb-4">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary active" data-category="all">সকল ভিডিও</button>
                        <button type="button" class="btn btn-outline-primary" data-category="lecture">ইসলামী বক্তৃতা</button>
                        <button type="button" class="btn btn-outline-primary" data-category="program">অনুষ্ঠান</button>
                        <button type="button" class="btn btn-outline-primary" data-category="documentary">ডকুমেন্টারি</button>
                    </div>
                </div>

                <!-- Video Grid -->
                <div class="row g-4">
                    <!-- Lecture Videos -->
                    <div class="col-md-6 col-lg-4 video-item lecture">
                        <div class="card">
                            <div class="video-thumbnail">
                                <img src="{{ asset('images/videos/lecture1.jpg') }}" class="card-img-top" alt="বক্তৃতা">
                                <a href="https://www.youtube.com/watch?v=VIDEO_ID" class="play-button" data-fancybox>
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">কুরআন ও সুন্নাহর আলোকে জীবন গঠন</h5>
                                <p class="card-text">
                                    <span class="date"><i class="far fa-calendar-alt me-1"></i> ১৫ ফেব্রুয়ারি ২০২৫</span>
                                    <span class="duration ms-3"><i class="far fa-clock me-1"></i> ৪৫ মিনিট</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Program Videos -->
                    <div class="col-md-6 col-lg-4 video-item program">
                        <div class="card">
                            <div class="video-thumbnail">
                                <img src="{{ asset('images/videos/program1.jpg') }}" class="card-img-top" alt="মাহফিল">
                                <a href="https://www.youtube.com/watch?v=VIDEO_ID" class="play-button" data-fancybox>
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">মাসিক ইসলামী মাহফিল</h5>
                                <p class="card-text">
                                    <span class="date"><i class="far fa-calendar-alt me-1"></i> ১০ ফেব্রুয়ারি ২০২৫</span>
                                    <span class="duration ms-3"><i class="far fa-clock me-1"></i> ২ ঘণ্টা</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Documentary Videos -->
                    <div class="col-md-6 col-lg-4 video-item documentary">
                        <div class="card">
                            <div class="video-thumbnail">
                                <img src="{{ asset('images/videos/documentary1.jpg') }}" class="card-img-top" alt="ডকুমেন্টারি">
                                <a href="https://www.youtube.com/watch?v=VIDEO_ID" class="play-button" data-fancybox>
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">জমঈয়তের কার্যক্রম - ২০২৪</h5>
                                <p class="card-text">
                                    <span class="date"><i class="far fa-calendar-alt me-1"></i> ৫ ফেব্রুয়ারি ২০২৫</span>
                                    <span class="duration ms-3"><i class="far fa-clock me-1"></i> ৩০ মিনিট</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">পূর্ববর্তী</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">১</a></li>
                        <li class="page-item"><a class="page-link" href="#">২</a></li>
                        <li class="page-item"><a class="page-link" href="#">৩</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">পরবর্তী</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>
.video-content {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.video-categories .btn-group {
    width: 100%;
}

.video-categories .btn {
    flex: 1;
}

.video-item .card {
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    margin-bottom: 1.5rem;
}

.video-item .card:hover {
    transform: translateY(-5px);
}

.video-thumbnail {
    position: relative;
    overflow: hidden;
}

.video-thumbnail img {
    height: 200px;
    object-fit: cover;
    width: 100%;
}

.play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0C4B36;
    text-decoration: none;
    transition: all 0.3s ease;
}

.play-button:hover {
    background: #0C4B36;
    color: white;
}

.video-item .card-title {
    color: #0C4B36;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.video-item .card-text {
    color: #666;
    font-size: 0.9rem;
}

.pagination .page-link {
    color: #0C4B36;
}

.pagination .page-item.active .page-link {
    background-color: #0C4B36;
    border-color: #0C4B36;
}
</style>

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Fancybox
    Fancybox.bind("[data-fancybox]", {
        // Custom options
    });

    // Video filtering
    const categoryButtons = document.querySelectorAll('[data-category]');
    const videoItems = document.querySelectorAll('.video-item');

    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active button
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Show/hide videos
            videoItems.forEach(item => {
                if (category === 'all' || item.classList.contains(category)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush
@endsection
