@extends('layouts.page')

@section('title', 'ইতিহাস')

@section('page-content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ এর ইতিহাস</h2>

                <div class="history-timeline">
                    <div class="timeline-item">
                        <h4>১৯৪৬ সালে প্রতিষ্ঠা</h4>
                        <p>
                            জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ ১৯৪৬ সালে প্রতিষ্ঠিত হয়। প্রতিষ্ঠাতা সদস্যদের
                            দূরদর্শী চিন্তা ও পরিকল্পনার মাধ্যমে এই সংগঠনের যাত্রা শুরু হয়।
                        </p>
                    </div>

                    <div class="timeline-item">
                        <h4>প্রাথমিক কার্যক্রম</h4>
                        <p>
                            প্রতিষ্ঠার পর থেকেই সংগঠনটি ইসলামী শিক্ষা প্রচার, সামাজিক সেবা এবং
                            দাওয়াতি কাজের মাধ্যমে জনগণের মাঝে কাজ করে আসছে।
                        </p>
                    </div>

                    <div class="timeline-item">
                        <h4>বর্তমান অবস্থান</h4>
                        <p>
                            বর্তমানে সংগঠনটি দেশের বিভিন্ন জেলায় শাখা বিস্তার করেছে এবং বিভিন্ন
                            শিক্ষা প্রতিষ্ঠান, মসজিদ ও মাদরাসা পরিচালনা করছে।
                        </p>
                    </div>
                </div>
            </div>

            <div class="content-section mt-4">
                <h3>প্রধান অর্জনসমূহ</h3>
                <ul class="achievement-list">
                    <li>দেশব্যাপী শাখা বিস্তার</li>
                    <li>শিক্ষা প্রতিষ্ঠান প্রতিষ্ঠা</li>
                    <li>ইসলামী গ্রন্থ প্রকাশনা</li>
                    <li>সামাজিক কল্যাণমূলক কার্যক্রম</li>
                    <li>দাওয়াতি কাজের প্রসার</li>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">দ্রুত লিঙ্ক</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about.introduction') }}" class="text-decoration-none">পরিচিতি</a></li>
                        <li><a href="{{ route('about.committee') }}" class="text-decoration-none">কমিটি</a></li>
                        <li><a href="{{ route('about.goals') }}" class="text-decoration-none">লক্ষ্য ও উদ্দেশ্য</a></li>
                    </ul>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title">যোগাযোগ</h4>
                    <p>আরও তথ্যের জন্য যোগাযোগ করুন:</p>
                    <div class="text-center">
                        <a href="{{ route('contact.index') }}" class="btn btn-primary">যোগাযোগ করুন</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-styles')
<style>
    .history-timeline .timeline-item {
        border-left: 3px solid #28a745;
        padding-left: 20px;
        margin-bottom: 30px;
        position: relative;
    }

    .history-timeline .timeline-item:before {
        content: '';
        width: 15px;
        height: 15px;
        background: #28a745;
        border-radius: 50%;
        position: absolute;
        left: -9px;
        top: 5px;
    }

    .achievement-list {
        list-style: none;
        padding-left: 0;
    }

    .achievement-list li {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .achievement-list li:last-child {
        border-bottom: none;
    }
</style>
@endsection
@endsection
