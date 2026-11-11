@extends('layouts.page')

@section('title', 'দান-সদকা')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>দান-সদকা</h2>
                
                <!-- চলমান প্রকল্প -->
                <div class="ongoing-projects mb-5">
                    <h3 class="text-success mb-4">
                        <i class="fas fa-hand-holding-heart me-2"></i>চলমান প্রকল্প
                    </h3>
                    <div class="project-card featured">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ asset('images/charity/placeholder.jpg') }}" alt="প্রকল্প" class="img-fluid rounded">
                                <div class="urgent-badge">জরুরি</div>
                            </div>
                            <div class="col-md-7">
                                <div class="project-details">
                                    <h4>এতিম শিশুদের জন্য খাদ্য সহায়তা</h4>
                                    <div class="progress-info">
                                        <div class="d-flex justify-content-between">
                                            <span>সংগৃহীত: ৫,০০,০০০৳</span>
                                            <span>লক্ষ্য: ১০,০০,০০০৳</span>
                                        </div>
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <p class="description mt-3">
                                        এতিম শিশুদের জন্য নিয়মিত খাদ্য সরবরাহ প্রকল্প। আপনার সামর্থ্য অনুযায়ী সহযোগিতা করুন।
                                    </p>
                                    <div class="action-buttons">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fas fa-hand-holding-usd me-1"></i>দান করুন
                                        </a>
                                        <a href="#" class="btn btn-outline-primary">
                                            <i class="fas fa-info-circle me-1"></i>বিস্তারিত
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- নিয়মিত প্রকল্প -->
                <div class="regular-projects mb-5">
                    <h3 class="text-primary mb-4">
                        <i class="fas fa-project-diagram me-2"></i>নিয়মিত প্রকল্প
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="project-card">
                                <img src="{{ asset('images/charity/placeholder.jpg') }}" alt="প্রকল্প" class="img-fluid rounded mb-3">
                                <div class="project-details">
                                    <h5>মসজিদ নির্মাণ</h5>
                                    <div class="progress-info">
                                        <div class="d-flex justify-content-between small">
                                            <span>সংগৃহীত: ২০,০০,০০০৳</span>
                                            <span>লক্ষ্য: ৫০,০০,০০০৳</span>
                                        </div>
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="action-buttons mt-3">
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fas fa-hand-holding-usd me-1"></i>দান করুন
                                        </a>
                                        <a href="#" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-info-circle me-1"></i>বিস্তারিত
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="project-card">
                                <img src="{{ asset('images/charity/placeholder.jpg') }}" alt="প্রকল্প" class="img-fluid rounded mb-3">
                                <div class="project-details">
                                    <h5>মাদ্রাসা শিক্ষার্থী সহায়তা</h5>
                                    <div class="progress-info">
                                        <div class="d-flex justify-content-between small">
                                            <span>সংগৃহীত: ৩,০০,০০০৳</span>
                                            <span>লক্ষ্য: ৫,০০,০০০৳</span>
                                        </div>
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="action-buttons mt-3">
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fas fa-hand-holding-usd me-1"></i>দান করুন
                                        </a>
                                        <a href="#" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-info-circle me-1"></i>বিস্তারিত
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- সম্পন্ন প্রকল্প -->
                <div class="completed-projects">
                    <h3 class="text-info mb-4">
                        <i class="fas fa-check-circle me-2"></i>সম্পন্ন প্রকল্প
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="project-card">
                                <img src="{{ asset('images/charity/placeholder.jpg') }}" alt="প্রকল্প" class="img-fluid rounded mb-3">
                                <div class="project-details">
                                    <h5>বন্যার্তদের সহায়তা</h5>
                                    <p class="completion-info">
                                        <i class="fas fa-calendar-check me-2"></i>সম্পন্ন: জানুয়ারি ২০২৫
                                    </p>
                                    <p class="description">
                                        বন্যার্তদের জন্য খাদ্য ও আশ্রয় সহায়তা প্রকল্প সফলভাবে সম্পন্ন।
                                    </p>
                                    <a href="#" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-images me-1"></i>গ্যালারি
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="project-card">
                                <img src="{{ asset('images/charity/placeholder.jpg') }}" alt="প্রকল্প" class="img-fluid rounded mb-3">
                                <div class="project-details">
                                    <h5>শীতার্তদের কম্বল বিতরণ</h5>
                                    <p class="completion-info">
                                        <i class="fas fa-calendar-check me-2"></i>সম্পন্ন: ডিসেম্বর ২০২৪
                                    </p>
                                    <p class="description">
                                        শীতার্তদের মাঝে কম্বল বিতরণ কার্যক্রম সফলভাবে সম্পন্ন।
                                    </p>
                                    <a href="#" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-images me-1"></i>গ্যালারি
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- দ্রুত দান -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">দ্রুত দান</h4>
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label class="form-label">দানের পরিমাণ</label>
                            <div class="amount-buttons">
                                <button type="button" class="btn btn-outline-primary mb-2">৫০০৳</button>
                                <button type="button" class="btn btn-outline-primary mb-2">১০০০৳</button>
                                <button type="button" class="btn btn-outline-primary mb-2">২০০০৳</button>
                                <button type="button" class="btn btn-outline-primary mb-2">৫০০০৳</button>
                            </div>
                            <input type="number" class="form-control mt-2" placeholder="অন্য পরিমাণ">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">প্রকল্প নির্বাচন</label>
                            <select class="form-select">
                                <option>এতিম শিশুদের জন্য খাদ্য সহায়তা</option>
                                <option>মসজিদ নির্মাণ</option>
                                <option>মাদ্রাসা শিক্ষার্থী সহায়তা</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-hand-holding-usd me-1"></i>দান করুন
                        </button>
                    </form>
                </div>
            </div>

            <!-- দানের পদ্ধতি -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">দানের পদ্ধতি</h4>
                    <div class="payment-methods">
                        <div class="payment-method mb-3">
                            <h5><i class="fas fa-mobile-alt me-2"></i>মোবাইল ব্যাংকিং</h5>
                            <p class="mb-2">বিকাশ: ০১XXXXXXXXX</p>
                            <p class="mb-2">নগদ: ০১XXXXXXXXX</p>
                            <p>রকেট: ০১XXXXXXXXX</p>
                        </div>
                        <div class="payment-method mb-3">
                            <h5><i class="fas fa-university me-2"></i>ব্যাংক একাউন্ট</h5>
                            <p class="mb-2">ইসলামী ব্যাংক বাংলাদেশ লিমিটেড</p>
                            <p>একাউন্ট নং: XXXXXXXXXXXXX</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- যোগাযোগ -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">যোগাযোগ</h4>
                    <p>দান-সদকা সংক্রান্ত তথ্যের জন্য যোগাযোগ করুন</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i>০১৭XXXXXXXX</li>
                        <li><i class="fas fa-envelope me-2"></i>charity@shubban.org</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>প্রধান কার্যালয়, ঢাকা</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .project-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        position: relative;
        padding: 20px;
    }

    .project-card.featured {
        border: 2px solid #28a745;
    }

    .urgent-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #dc3545;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .project-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .project-details {
        padding: 15px 0;
    }

    .progress {
        height: 8px;
        border-radius: 4px;
    }

    .progress-info {
        margin: 15px 0;
    }

    .description {
        color: #666;
        margin: 15px 0;
    }

    .action-buttons .btn {
        margin-right: 5px;
    }

    .completion-info {
        color: #28a745;
        font-size: 0.9rem;
    }

    .amount-buttons {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .amount-buttons .btn {
        width: 100%;
    }

    .payment-method h5 {
        color: #2c3e50;
        font-size: 1.1rem;
    }

    .payment-method p {
        color: #666;
        margin-left: 25px;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
</style>
@endsection
@endsection
