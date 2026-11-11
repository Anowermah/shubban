<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>দান প্রাপ্তি স্বীকার রশিদ - {{ $donation->receipt_no ?? ('#'.$donation->id) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'SolaimanLipi', 'Hind Siliguri', 'Noto Sans Bengali', Arial, sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }
        .receipt-card {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            border: 2px solid #0C4B36;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            position: relative;
        }
        .receipt-header {
            background: linear-gradient(135deg, #07281d 0%, #0C4B36 100%);
            color: #fff;
            padding: 24px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .table-bordered td, .table-bordered th {
            border-color: #cbd5e1;
            padding: 10px 14px;
        }
        .seal-box {
            border: 2px dashed #0C4B36;
            padding: 12px;
            border-radius: 8px;
            display: inline-block;
            text-align: center;
        }
        @media print {
            body {
                background: #fff;
            }
            .no-print {
                display: none !important;
            }
            .receipt-card {
                margin: 0;
                box-shadow: none;
                border: 2px solid #0C4B36 !important;
            }
        }
    </style>
</head>
<body>
@php
    $toBn = function($number) {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, (string)$number);
    };
@endphp

<div class="container py-4">
    <!-- Top Print Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3 no-print" style="max-width: 800px; margin: 0 auto;">
        <button onclick="window.close()" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="fas fa-times me-1"></i> বন্ধ করুন
        </button>
        <button onclick="window.print()" class="btn btn-sm btn-success rounded-pill px-4 fw-bold shadow-sm" style="background: #0C4B36;">
            <i class="fas fa-print me-1"></i> প্রিন্ট ভাউচার
        </button>
    </div>

    <!-- Printable Receipt Container -->
    <div class="receipt-card">
        <!-- Header -->
        <div class="receipt-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <h2 class="h4 fw-bold mb-1 text-white">জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ</h2>
                    <p class="mb-0 text-white-50 small">কেন্দ্রীয় বাইতুল মাল ও দাওয়াত তহবিল • ঢাকা, বাংলাদেশ</p>
                    <span class="badge bg-warning text-dark font-xs fw-bold mt-2">অফিসিয়াল দান প্রাপ্তি স্বীকার রশিদ</span>
                </div>
                <div class="col-4 text-end">
                    <div class="font-xs text-white-50">ভাউচার নম্বর:</div>
                    <div class="fw-bold font-monospace text-warning fs-5">{{ $donation->receipt_no ?? ('#'.$donation->id) }}</div>
                    <div class="font-xs text-white-50 mt-1">{{ $donation->created_at->format('d/m/Y - h:i A') }}</div>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="p-4 p-md-5">
            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle">
                    <tbody>
                        <tr>
                            <th class="bg-light text-secondary" style="width: 30%;">দাতার নাম</th>
                            <td class="fw-bold text-dark fs-6">{{ $donation->display_name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-secondary">মোবাইল নম্বর</th>
                            <td class="font-monospace text-dark">{{ $donation->phone }}</td>
                        </tr>
                        @if($donation->email)
                            <tr>
                                <th class="bg-light text-secondary">ইমেইল</th>
                                <td>{{ $donation->email }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th class="bg-light text-secondary">দানের খাত / ফান্ড</th>
                            <td class="fw-bold text-success fs-6">
                                {{ $donation->cause->name ?? ($donation->category ?? 'সাধারণ বাইতুল মাল') }}
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-secondary">পেমেন্ট মাধ্যম ও TrxID</th>
                            <td>
                                <span class="badge bg-light text-dark border text-uppercase">{{ $donation->payment_method }}</span>
                                @if($donation->transaction_id)
                                    <span class="font-monospace ms-2 text-dark font-sm">TrxID: <strong>{{ $donation->transaction_id }}</strong></span>
                                @endif
                                @if($donation->sender_number)
                                    <span class="font-xs text-muted ms-2">(প্রেরক: {{ $donation->sender_number }})</span>
                                @endif
                            </td>
                        </tr>
                        <tr class="table-success table-opacity-25">
                            <th class="fw-bold fs-6 text-dark">দানের পরিমাণ</th>
                            <td class="fw-bold fs-4 text-success font-monospace">
                                ৳ {{ $toBn(number_format($donation->amount, 2)) }} টাকা মাত্র
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-secondary">স্ট্যাটাস</th>
                            <td>
                                @if($donation->status === 'approved')
                                    <span class="badge bg-success text-white px-2 py-1">যাচাইকৃত ও অনুমোদিত (Verified)</span>
                                @else
                                    <span class="badge bg-warning text-dark px-2 py-1">যাচাইাধীন (Pending)</span>
                                @endif
                            </td>
                        </tr>
                        @if($donation->message)
                            <tr>
                                <th class="bg-light text-secondary">দাতার মন্তব্য / দো'আ</th>
                                <td class="fst-italic text-secondary">"{{ $donation->message }}"</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Signatures -->
            <div class="row align-items-end pt-5 mt-4">
                <div class="col-4 text-center">
                    <div style="border-top: 1px dashed #64748b; padding-top: 6px;" class="small text-muted">
                        আদায়কারী / হিসাব সহকারী
                    </div>
                </div>
                <div class="col-4 text-center">
                    <div class="seal-box">
                        <i class="fas fa-stamp text-success fa-2x mb-1"></i>
                        <div class="small fw-bold text-success">শুব্বান কেন্দ্রীয় তহবিল</div>
                        <div style="font-size: 0.72rem;" class="text-muted">স্বীকৃত ও সংরক্ষিত</div>
                    </div>
                </div>
                <div class="col-4 text-center">
                    <div style="border-top: 1px dashed #64748b; padding-top: 6px;" class="small text-muted">
                        কেন্দ্রীয় কোষাধ্যক্ষ / সভাপতি
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
