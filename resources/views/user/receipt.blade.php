<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>এয়ানত রসিদ - {{ $iyanat->receipt_no }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'SolaimanLipi', 'Noto Sans Bengali', sans-serif;
            padding: 40px 15px;
        }
        .receipt-box {
            max-width: 650px;
            margin: auto;
            background: #ffffff;
            border-radius: 16px;
            padding: 35px;
            border: 2px dashed #0C4B36;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            position: relative;
        }
        .receipt-header {
            text-align: center;
            border-bottom: 2px solid #e2ece6;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .receipt-logo {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 10px;
        }
        .org-name {
            color: #0C4B36;
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 2px;
        }
        .receipt-title-badge {
            background: #0C4B36;
            color: #FBB040;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 4px 16px;
            border-radius: 50px;
            display: inline-block;
            margin-top: 6px;
        }
        .receipt-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed #edf2ef;
            font-size: 0.95rem;
        }
        .receipt-total {
            background: #f4f8f5;
            padding: 15px;
            border-radius: 12px;
            margin-top: 20px;
            font-size: 1.15rem;
            font-weight: 700;
            color: #0C4B36;
            display: flex;
            justify-content: space-between;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 5rem;
            color: rgba(12, 75, 54, 0.04);
            font-weight: 900;
            text-transform: uppercase;
            pointer-events: none;
            white-space: nowrap;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            .receipt-box {
                border: 2px solid #0C4B36;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-box">
        <div class="watermark">SHUBBAN BD</div>

        <div class="receipt-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="receipt-logo">
            <h1 class="org-name">জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ</h1>
            <p class="text-muted small mb-0">কেন্দ্রীয় বায়তুলমাল বিভাগ • মাসিক এয়ানত আদায় রসিদ</p>
            <div class="receipt-title-badge">অফিসিয়াল ডিজিটাল রসিদ</div>
        </div>

        <div class="receipt-row">
            <span class="text-muted">রসিদ নম্বর:</span>
            <span class="fw-bold text-dark"><code>{{ $iyanat->receipt_no }}</code></span>
        </div>
        <div class="receipt-row">
            <span class="text-muted">পরিশোধের তারিখ ও সময়:</span>
            <span>{{ $iyanat->created_at->format('d F, Y - h:i A') }}</span>
        </div>
        <div class="receipt-row">
            <span class="text-muted">কর্মী / সদস্যের নাম:</span>
            <span class="fw-bold">{{ $iyanat->user->name }}</span>
        </div>
        <div class="receipt-row">
            <span class="text-muted">কর্মী স্তর ও শাখা:</span>
            <span>{{ $iyanat->user->worker_tier_label }} ({{ $iyanat->user->branch_name ?? 'শাখা' }})</span>
        </div>
        <div class="receipt-row">
            <span class="text-muted">এয়ানতের মাস:</span>
            <span class="fw-bold text-primary">{{ $iyanat->month }}</span>
        </div>
        <div class="receipt-row">
            <span class="text-muted">পেমেন্ট মাধ্যম:</span>
            <span>{{ $iyanat->payment_method_label }}</span>
        </div>
        @if($iyanat->transaction_id)
        <div class="receipt-row">
            <span class="text-muted">ট্রানজেকশন আইডি (TrxID):</span>
            <span class="font-monospace">{{ $iyanat->transaction_id }}</span>
        </div>
        @endif
        <div class="receipt-row">
            <span class="text-muted">স্ট্যাটাস:</span>
            <span>{!! $iyanat->status_badge !!}</span>
        </div>

        <div class="receipt-total">
            <span>পরিশোধিত মোট এয়ানত:</span>
            <span>৳ {{ number_format($iyanat->amount, 2) }}</span>
        </div>

        <div class="text-center mt-4 pt-3 text-muted small">
            <p class="mb-1"><i class="fas fa-check-circle text-success me-1"></i> এটি একটি কম্পিউটার জেনারেটেড ডিজিটাল রসিদ। কোনো স্বাক্ষরের প্রয়োজন নেই।</p>
            <p class="mb-0">আল্লাহ তায়ালা আপনার এয়ানত কবুল করুন এবং বরকত দান করুন। আমীন।</p>
        </div>

        <div class="text-center mt-4 no-print d-flex justify-content-center gap-2">
            <button onclick="window.print()" class="btn btn-success px-4 rounded-pill">
                <i class="fas fa-print me-1"></i> রসিদ প্রিন্ট করুন
            </button>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> ড্যাশবোর্ডে ফিরুন
            </a>
        </div>
    </div>
</body>
</html>
