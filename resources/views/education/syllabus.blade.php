@extends('layouts.page')

@section('title', 'শিক্ষা সিলেবাস')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>শিক্ষা সিলেবাস</h2>
                
                <div class="syllabus-section">
                    <!-- কুরআন বিভাগ -->
                    <div class="course-category mb-5">
                        <h3 class="text-success mb-4">
                            <i class="fas fa-book-open me-2"></i>কুরআন বিভাগ
                        </h3>
                        <div class="accordion" id="quranAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#quranBasic">
                                        বেসিক কোর্স
                                    </button>
                                </h2>
                                <div id="quranBasic" class="accordion-collapse collapse show" data-bs-parent="#quranAccordion">
                                    <div class="accordion-body">
                                        <ul class="syllabus-list">
                                            <li>নাজেরা কুরআন</li>
                                            <li>তাজবীদ</li>
                                            <li>মাখরাজ</li>
                                            <li>হিফজুল কুরআন (প্রাথমিক)</li>
                                        </ul>
                                        <a href="#" class="btn btn-outline-success btn-sm mt-3">
                                            <i class="fas fa-download me-2"></i>সিলেবাস ডাউনলোড
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#quranAdvanced">
                                        অ্যাডভান্সড কোর্স
                                    </button>
                                </h2>
                                <div id="quranAdvanced" class="accordion-collapse collapse" data-bs-parent="#quranAccordion">
                                    <div class="accordion-body">
                                        <ul class="syllabus-list">
                                            <li>তাফসীর</li>
                                            <li>উলূমুল কুরআন</li>
                                            <li>কিরাআত</li>
                                            <li>হিফজুল কুরআন (উচ্চ)</li>
                                        </ul>
                                        <a href="#" class="btn btn-outline-success btn-sm mt-3">
                                            <i class="fas fa-download me-2"></i>সিলেবাস ডাউনলোড
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- হাদীস বিভাগ -->
                    <div class="course-category mb-5">
                        <h3 class="text-primary mb-4">
                            <i class="fas fa-book me-2"></i>হাদীস বিভাগ
                        </h3>
                        <div class="accordion" id="hadithAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#hadithBasic">
                                        বেসিক কোর্স
                                    </button>
                                </h2>
                                <div id="hadithBasic" class="accordion-collapse collapse show" data-bs-parent="#hadithAccordion">
                                    <div class="accordion-body">
                                        <ul class="syllabus-list">
                                            <li>হাদীস পরিচিতি</li>
                                            <li>৪০ হাদীস</li>
                                            <li>রিয়াদুস সালেহীন</li>
                                            <li>হাদীস শাস্ত্রের ইতিহাস</li>
                                        </ul>
                                        <a href="#" class="btn btn-outline-primary btn-sm mt-3">
                                            <i class="fas fa-download me-2"></i>সিলেবাস ডাউনলোড
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#hadithAdvanced">
                                        অ্যাডভান্সড কোর্স
                                    </button>
                                </h2>
                                <div id="hadithAdvanced" class="accordion-collapse collapse" data-bs-parent="#hadithAccordion">
                                    <div class="accordion-body">
                                        <ul class="syllabus-list">
                                            <li>বুখারী শরীফ</li>
                                            <li>মুসলিম শরীফ</li>
                                            <li>উলূমুল হাদীস</li>
                                            <li>হাদীস গবেষণা পদ্ধতি</li>
                                        </ul>
                                        <a href="#" class="btn btn-outline-primary btn-sm mt-3">
                                            <i class="fas fa-download me-2"></i>সিলেবাস ডাউনলোড
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- আরবি ভাষা -->
                    <div class="course-category">
                        <h3 class="text-info mb-4">
                            <i class="fas fa-language me-2"></i>আরবি ভাষা
                        </h3>
                        <div class="accordion" id="arabicAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#arabicBasic">
                                        বেসিক কোর্স
                                    </button>
                                </h2>
                                <div id="arabicBasic" class="accordion-collapse collapse show" data-bs-parent="#arabicAccordion">
                                    <div class="accordion-body">
                                        <ul class="syllabus-list">
                                            <li>আরবি বর্ণমালা</li>
                                            <li>শব্দভাণ্ডার</li>
                                            <li>ব্যাকরণ (প্রাথমিক)</li>
                                            <li>সহজ কথোপকথন</li>
                                        </ul>
                                        <a href="#" class="btn btn-outline-info btn-sm mt-3">
                                            <i class="fas fa-download me-2"></i>সিলেবাস ডাউনলোড
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#arabicAdvanced">
                                        অ্যাডভান্সড কোর্স
                                    </button>
                                </h2>
                                <div id="arabicAdvanced" class="accordion-collapse collapse" data-bs-parent="#arabicAccordion">
                                    <div class="accordion-body">
                                        <ul class="syllabus-list">
                                            <li>নাহু-সরফ</li>
                                            <li>বালাগাত</li>
                                            <li>আরবি সাহিত্য</li>
                                            <li>অনুবাদ কৌশল</li>
                                        </ul>
                                        <a href="#" class="btn btn-outline-info btn-sm mt-3">
                                            <i class="fas fa-download me-2"></i>সিলেবাস ডাউনলোড
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">শিক্ষা ক্যালেন্ডার</h4>
                    <p>২০২৫ সালের শিক্ষা ক্যালেন্ডার দেখুন</p>
                    <a href="#" class="btn btn-primary">ক্যালেন্ডার দেখুন</a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">গুরুত্বপূর্ণ লিংক</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('education-board.exam-schedule') }}" class="text-decoration-none">পরীক্ষার সময়সূচি</a></li>
                        <li><a href="{{ route('education-board.results') }}" class="text-decoration-none">পরীক্ষার ফলাফল</a></li>
                    </ul>
                    <div class="mt-4">
                        <a href="{{ route('contact.index') }}" class="btn btn-success">যোগাযোগ করুন</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">পরামর্শ নিন</h4>
                    <p>শিক্ষা সংক্রান্ত পরামর্শের জন্য যোগাযোগ করুন</p>
                    <a href="{{ route('contact.index') }}" class="btn btn-success">যোগাযোগ করুন</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .accordion-button:not(.collapsed) {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,.125);
    }

    .syllabus-list {
        list-style: none;
        padding-left: 0;
    }

    .syllabus-list li {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
        color: #666;
    }

    .syllabus-list li:last-child {
        border-bottom: none;
    }

    .syllabus-list li:before {
        content: "•";
        color: #28a745;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    .course-category h3 {
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
</style>
@endsection
@endsection
