@extends('layouts.page')

@section('title', 'আমাদের মিশন ও ভিশন')

@section('page-content')
<div class="goals-page-wrap">
    <!-- Main Objective Featured Hero Card -->
    <div class="card main-goal-card mb-5 border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-4 p-md-5 text-center position-relative">
            <div class="goal-top-badge mb-3">
                <span class="badge px-3 py-2 rounded-pill font-sm fw-bold shadow-sm" style="background: #FBB040; color: #0C4B36;">
                    <i class="fas fa-bullseye me-1"></i> শুব্বানের ভিশন ও মিশন
                </span>
            </div>
            
            <div class="arabic-shahada-text mb-3" style="font-family: 'Amiri', 'Traditional Arabic', serif; font-size: 1.6rem; color: #FBB040; letter-spacing: 0.5px;">
                لَا إِلَٰهَ إِلَّا ٱللَّٰهُ مُحَمَّدٌ رَّসُولُ ٱللَّٰهِ
            </div>

            <h2 class="main-goal-title fw-bold text-white mb-3" style="font-size: 1.55rem; line-height: 1.6;">
                কালেমা <span style="color: #FBB040;">"লা- ইলাহা ইল্লাল্লাহু মুহাম্মাদুর রাসূলুল্লাহ"</span>-কে যথাযথ উপলব্ধি করত জীবনের সর্বস্তরে কুরআন ও সুন্নাহর বিধান প্রতিষ্ঠার মাধ্যমে আল্লাহর সন্তুষ্টি অর্জন।
            </h2>

            <p class="text-white-50 font-sm mx-auto mb-0" style="max-width: 750px;">
                জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ একটি দ্বীনী, অরাজনৈতিক, দাওয়াতী ও যুবকল্যাণমূলক সংগঠন। তরুণ প্রজন্মকে তাওহীদ ও সুন্নাহর আলোকে গড়ে তোলাই আমাদের প্রধান ব্রত।
            </p>
        </div>
    </div>

    <!-- Mission & Vision 2-Column Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success" style="width: 50px; height: 50px; font-size: 1.3rem;">
                        <i class="fas fa-compass"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">আমাদের মিশন (Mission)</h4>
                        <small class="text-muted">আমাদের দৈনন্দিন কর্মতৎপরতা</small>
                    </div>
                </div>
                <p class="text-secondary leading-relaxed">
                    কুরআন ও সহীহ সুন্নাহর নির্ভেজাল আদর্শে যুব সমাজ বিনির্মাণ, তরুণদের চরিত্র গঠন, শিরক ও বিদআত মুক্ত সমাজ সংস্কার, বিশুদ্ধ ইসলামী শিক্ষা বিস্তার এবং সমাজকল্যাণমূলক কর্মকাণ্ডে যুব শক্তিকে নিয়োজিত করা।
                </p>
                <ul class="list-unstyled mb-0 d-flex flex-column gap-2 text-secondary small">
                    <li><i class="fas fa-check-circle text-success me-2"></i> তাওহীদ ও সুন্নাহর নির্ভেজাল দাওয়াত সর্বস্তরে পৌঁছে দেওয়া।</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> যুবসমাজকে নৈতিক অবক্ষয় ও অনৈসলামিক অপসংস্কৃতি থেকে রক্ষা করা।</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> আদর্শ ও খোদাভীরু তরুণ নেতৃত্ব গড়ে তোলা।</li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning" style="width: 50px; height: 50px; font-size: 1.3rem;">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">আমাদের ভিশন (Vision)</h4>
                        <small class="text-muted">আমাদের ভবিষ্যৎ স্বপ্ন ও গন্তব্য</small>
                    </div>
                </div>
                <p class="text-secondary leading-relaxed">
                    একটি আলোকিত, শিরক-বিদআতমুক্ত এবং কুরআন ও সুন্নাহর আদর্শে পরিচালিত তাকওয়াবান যুবসমাজ গড়ে তোলা, যারা ব্যক্তি, পরিবার, সমাজ ও রাষ্ট্রের সকল ক্ষেত্রে ইসলামের সুমহান শান্তির বার্তা প্রতিষ্ঠা করবে।
                </p>
                <ul class="list-unstyled mb-0 d-flex flex-column gap-2 text-secondary small">
                    <li><i class="fas fa-star text-warning me-2"></i> প্রতিটি জনপদে বিশুদ্ধ দ্বীনি দাওয়াতের আলো প্রজ্জ্বলন।</li>
                    <li><i class="fas fa-star text-warning me-2"></i> তরুণদের মাঝে ইসলামী গবেষণা ও জ্ঞানচর্চার প্রসার।</li>
                    <li><i class="fas fa-star text-warning me-2"></i> মানবসেবা ও সমাজকল্যাণে কার্যকর ভূমিকা পালন।</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
