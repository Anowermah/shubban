@extends('layouts.app')

@section('title', 'দাওয়াহ কার্যক্রম - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="content-wrapper">
                <h1 class="section-title mb-4">দাওয়াহ কার্যক্রম</h1>

                <!-- Overview -->
                <div class="dawah-overview mb-5">
                    <div class="card">
                        <div class="card-body">
                            <p class="lead">জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ কুরআন ও সহীহ হাদীসের আলোকে ইসলামী দাওয়াহ কার্যক্রম পরিচালনা করে থাকে।</p>
                        </div>
                    </div>
                </div>

                <!-- Regular Programs -->
                <div class="regular-programs mb-5">
                    <h2 class="section-title mb-4">নিয়মিত কার্যক্রম</h2>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card program-card h-100">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <i class="fas fa-mosque text-primary me-2"></i>
                                        জুমার খুতবা
                                    </h3>
                                    <p class="card-text">প্রতি জুমাবার দেশের বিভিন্ন মসজিদে আমাদের উলামায়ে কেরাম খুতবা প্রদান করে থাকেন।</p>
                                    <div class="program-stats mt-3">
                                        <div class="stat">
                                            <span class="stat-value">৫০+</span>
                                            <span class="stat-label">মসজিদ</span>
                                        </div>
                                        <div class="stat">
                                            <span class="stat-value">২০+</span>
                                            <span class="stat-label">খতীব</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card program-card h-100">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <i class="fas fa-book-reader text-primary me-2"></i>
                                        তাফসীর মাহফিল
                                    </h3>
                                    <p class="card-text">প্রতি মাসে কুরআনের তাফসীর নিয়ে আলোচনা মাহফিল আয়োজন করা হয়।</p>
                                    <div class="program-stats mt-3">
                                        <div class="stat">
                                            <span class="stat-value">১২</span>
                                            <span class="stat-label">মাসিক মাহফিল</span>
                                        </div>
                                        <div class="stat">
                                            <span class="stat-value">৫০০+</span>
                                            <span class="stat-label">অংশগ্রহণকারী</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card program-card h-100">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <i class="fas fa-microphone-alt text-primary me-2"></i>
                                        ওয়াজ মাহফিল
                                    </h3>
                                    <p class="card-text">দেশের বিভিন্ন স্থানে নিয়মিত ওয়াজ মাহফিলের আয়োজন করা হয়।</p>
                                    <div class="program-stats mt-3">
                                        <div class="stat">
                                            <span class="stat-value">১০০+</span>
                                            <span class="stat-label">বার্ষিক মাহফিল</span>
                                        </div>
                                        <div class="stat">
                                            <span class="stat-value">৩০+</span>
                                            <span class="stat-label">জেলা</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card program-card h-100">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <i class="fas fa-video text-primary me-2"></i>
                                        অনলাইন দারস
                                    </h3>
                                    <p class="card-text">নিয়মিত অনলাইন প্ল্যাটফর্মে ইসলামী দারস প্রদান করা হয়।</p>
                                    <div class="program-stats mt-3">
                                        <div class="stat">
                                            <span class="stat-value">২০০+</span>
                                            <span class="stat-label">ভিডিও</span>
                                        </div>
                                        <div class="stat">
                                            <span class="stat-value">৫০K+</span>
                                            <span class="stat-label">দর্শক</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Publications -->
                <div class="publications mb-5">
                    <h2 class="section-title mb-4">প্রকাশনা</h2>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card publication-card">
                                <img src="{{ asset('images/publications/magazine.jpg') }}" class="card-img-top" alt="মাসিক পত্রিকা">
                                <div class="card-body">
                                    <h4>মাসিক পত্রিকা</h4>
                                    <p>প্রতি মাসে ইসলামী বিষয়ক পত্রিকা প্রকাশ করা হয়</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card publication-card">
                                <img src="{{ asset('images/publications/books.jpg') }}" class="card-img-top" alt="ইসলামী বই">
                                <div class="card-body">
                                    <h4>ইসলামী বই</h4>
                                    <p>বিভিন্ন ইসলামী বিষয়ে বই প্রকাশ করা হয়</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card publication-card">
                                <img src="{{ asset('images/publications/leaflet.jpg') }}" class="card-img-top" alt="লিফলেট">
                                <div class="card-body">
                                    <h4>লিফলেট</h4>
                                    <p>বিভিন্ন ইসলামী বিষয়ে লিফলেট প্রকাশ করা হয়</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="upcoming-events">
                    <h2 class="section-title mb-4">আসন্ন অনুষ্ঠান সমূহ</h2>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card event-card">
                                <div class="card-body">
                                    <div class="event-date">
                                        <span class="date">২৫</span>
                                        <span class="month">ফেব্রুয়ারি</span>
                                    </div>
                                    <div class="event-details">
                                        <h4>ইসলামী সেমিনার</h4>
                                        <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>যাত্রাবাড়ি কেন্দ্রীয় কার্যালয়</p>
                                        <p class="mb-0"><i class="fas fa-clock me-2"></i>সকাল ১০:০০ টা</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card event-card">
                                <div class="card-body">
                                    <div class="event-date">
                                        <span class="date">১</span>
                                        <span class="month">মার্চ</span>
                                    </div>
                                    <div class="event-details">
                                        <h4>বার্ষিক মাহফিল</h4>
                                        <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>বায়তুল মোকাররম মসজিদ</p>
                                        <p class="mb-0"><i class="fas fa-clock me-2"></i>বাদ আসর</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sidebar">
                <!-- YouTube Channel -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-4">আমাদের ইউটিউব চ্যানেল</h3>
                        <div class="youtube-preview">
                            <img src="{{ asset('images/youtube-preview.jpg') }}" alt="YouTube Channel" class="img-fluid mb-3">
                            <a href="#" class="btn btn-danger w-100">
                                <i class="fab fa-youtube me-2"></i>
                                সাবস্ক্রাইব করুন
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4">যোগাযোগ করুন</h3>
                        <div class="contact-info">
                            <p><i class="fas fa-phone text-primary me-2"></i> +880 1765812261</p>
                            <p><i class="fas fa-envelope text-primary me-2"></i> info@shubbanbd.org</p>
                            <p><i class="fas fa-map-marker-alt text-primary me-2"></i> ৭৯/ক/৩, উত্তর যাত্রাবাড়ি, ঢাকা-১২০৪</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.content-wrapper {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.program-card {
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.program-card:hover {
    transform: translateY(-5px);
}

.program-stats {
    display: flex;
    justify-content: space-around;
    text-align: center;
    border-top: 1px solid #eee;
    padding-top: 1rem;
}

.stat-value {
    display: block;
    font-size: 1.5rem;
    font-weight: bold;
    color: #0C4B36;
}

.stat-label {
    display: block;
    font-size: 0.9rem;
    color: #666;
}

.publication-card {
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.publication-card:hover {
    transform: translateY(-5px);
}

.publication-card .card-img-top {
    height: 200px;
    object-fit: cover;
}

.event-card {
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.event-card .card-body {
    display: flex;
    align-items: center;
}

.event-date {
    background: #0C4B36;
    color: white;
    padding: 1rem;
    border-radius: 5px;
    text-align: center;
    margin-right: 1rem;
    min-width: 80px;
}

.event-date .date {
    display: block;
    font-size: 1.5rem;
    font-weight: bold;
}

.event-date .month {
    display: block;
    font-size: 0.9rem;
}

.event-details h4 {
    margin: 0 0 0.5rem 0;
    color: #0C4B36;
}

.event-details p {
    color: #666;
    font-size: 0.9rem;
}

.youtube-preview img {
    border-radius: 5px;
    margin-bottom: 1rem;
}

.contact-info p {
    margin-bottom: 1rem;
}
</style>
@endsection
