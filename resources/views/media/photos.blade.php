@extends('layouts.app')

@section('title', 'ফটো গ্যালারি - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="gallery-content">
                <h1 class="section-title mb-4">ফটো গ্যালারি</h1>

                <!-- Album Categories -->
                <div class="album-categories mb-4">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary active" data-album="all">সকল ছবি</button>
                        <button type="button" class="btn btn-outline-primary" data-album="program">অনুষ্ঠান</button>
                        <button type="button" class="btn btn-outline-primary" data-album="education">শিক্ষা কার্যক্রম</button>
                        <button type="button" class="btn btn-outline-primary" data-album="charity">মানবসেবা</button>
                    </div>
                </div>

                <!-- Photo Grid -->
                <div class="row g-4">
                    <!-- Program Photos -->
                    <div class="col-md-4 col-sm-6 gallery-item program">
                        <div class="card">
                            <a href="{{ asset('images/gallery/program1.jpg') }}" data-fancybox="gallery" data-caption="মাসিক ইসলামী মাহফিল - ফেব্রুয়ারি ২০২৫">
                                <img src="{{ asset('images/gallery/program1.jpg') }}" class="card-img-top" alt="মাহফিল">
                                <div class="card-body">
                                    <h5 class="card-title">মাসিক ইসলামী মাহফিল</h5>
                                    <p class="card-text">ফেব্রুয়ারি ২০২৫</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Education Photos -->
                    <div class="col-md-4 col-sm-6 gallery-item education">
                        <div class="card">
                            <a href="{{ asset('images/gallery/education1.jpg') }}" data-fancybox="gallery" data-caption="কুরআন শিক্ষা কোর্স - ২০২৫">
                                <img src="{{ asset('images/gallery/education1.jpg') }}" class="card-img-top" alt="শিক্ষা">
                                <div class="card-body">
                                    <h5 class="card-title">কুরআন শিক্ষা কোর্স</h5>
                                    <p class="card-text">জানুয়ারি ২০২৫</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Charity Photos -->
                    <div class="col-md-4 col-sm-6 gallery-item charity">
                        <div class="card">
                            <a href="{{ asset('images/gallery/charity1.jpg') }}" data-fancybox="gallery" data-caption="শীতবস্ত্র বিতরণ - ২০২৫">
                                <img src="{{ asset('images/gallery/charity1.jpg') }}" class="card-img-top" alt="শীতবস্ত্র">
                                <div class="card-body">
                                    <h5 class="card-title">শীতবস্ত্র বিতরণ</h5>
                                    <p class="card-text">জানুয়ারি ২০২৫</p>
                                </div>
                            </a>
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
.gallery-content {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.album-categories .btn-group {
    width: 100%;
}

.album-categories .btn {
    flex: 1;
}

.gallery-item .card {
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    margin-bottom: 1.5rem;
}

.gallery-item .card:hover {
    transform: translateY(-5px);
}

.gallery-item .card-img-top {
    height: 200px;
    object-fit: cover;
}

.gallery-item .card-title {
    color: #0C4B36;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.gallery-item .card-text {
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

    // Album filtering
    const albumButtons = document.querySelectorAll('[data-album]');
    const galleryItems = document.querySelectorAll('.gallery-item');

    albumButtons.forEach(button => {
        button.addEventListener('click', function() {
            const album = this.dataset.album;
            
            // Update active button
            albumButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Show/hide photos
            galleryItems.forEach(item => {
                if (album === 'all' || item.classList.contains(album)) {
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
