@extends('layouts.page')

@section('title', 'দান প্রাপ্তি স্বীকার রশিদ')
@section('category', 'অনুদান')
@section('subtitle', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর ডিজিটাল ভাউচার ও স্বীকৃতিপত্র')

@section('page-content')
@php
    $toBn = function($number) {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, (string)$number);
    };
@endphp

<div class="row justify-content-center pb-5">
    <div class="col-lg-8">
        <!-- Success Alert banner -->
        <div class="alert alert-success border-0 shadow-sm rounded-4 p-4 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-white text-success d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                    <i class="fas fa-check-circle fa-2x"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1 text-success">জাযাকাল্লাহু খাইরান! আপনার দান সফলভাবে গৃহীত হয়েছে</h5>
                    <p class="mb-0 small text-secondary">নিচের রশিদ নম্বরটি আপনার অনুদানের প্রমাণ হিসেবে সংরক্ষণ করুন।</p>
                </div>
            </div>
            <button onclick="window.print()" class="btn btn-sm btn-outline-success rounded-pill px-3 py-2 fw-bold">
                <i class="fas fa-print me-1"></i> রশিদ প্রিন্ট করুন
            </button>
        </div>

        <!-- Official Branded Receipt Card (Print-Ready) -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-white print-voucher-card position-relative">
            <!-- Decorative Top Border -->
            <div style="height: 6px; background: linear-gradient(90deg, #0C4B36 0%, #FBB040 50%, #0C4B36 100%);"></div>

            <div class="card-body p-4 p-md-5">
                <!-- Header -->
                <div class="row align-items-center border-bottom pb-4 mb-4">
                    <div class="col-8">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('images/logo.png') }}" alt="Shubban Logo" style="height: 65px; width: auto;" onerror="this.style.display='none'">
                            <div>
                                <h3 class="fw-bold mb-1 fs-5" style="color: #0C4B36;">জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ</h3>
                                <p class="text-muted small mb-0">কেন্দ্রীয় বাইতুল মাল ও সমাজকল্যাণ বিভাগ</p>
                                <span class="badge bg-light text-dark border font-xs">অফিসিয়াল ডিজিটাল ভাউচার</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="font-xs text-muted mb-1">রশিদ নম্বর (Voucher No):</div>
                        <div class="fw-bold font-monospace text-success fs-6">{{ $donation->receipt_no ?? ('SHB-DON-' . $donation->id) }}</div>
                        <div class="font-xs text-muted mt-1">{{ $donation->created_at->format('d/m/Y h:i A') }}</div>
                    </div>
                </div>

                <!-- Status Banner -->
                <div class="mb-4 p-3 rounded-3 d-flex align-items-center justify-content-between flex-wrap gap-2 {{ $donation->status === 'approved' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-dark' }}">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas {{ $donation->status === 'approved' ? 'fa-check-double text-success' : 'fa-hourglass-half text-warning' }} fa-lg"></i>
                        <div>
                            <span class="fw-bold">অনুদানের স্ট্যাটাস:</span> 
                            <span>{{ $donation->status === 'approved' ? 'যাচাইকৃত ও অনুমোদিত (Verified)' : 'যাচাইাধীন (Pending Verification)' }}</span>
                        </div>
                    </div>
                    @if($donation->status === 'approved' && $donation->verified_at)
                        <span class="font-xs text-muted">যাচাইয়ের তারিখ: {{ $donation->verified_at->format('d/m/Y') }}</span>
                    @else
                        <span class="font-xs text-muted">অ্যাডমিন টিম শীঘ্রই TrxID যাচাই করে কনফার্ম করবে</span>
                    @endif
                </div>

                <!-- Details Table -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <tr>
                                <th class="bg-light text-secondary font-sm" style="width: 32%;">দাতার নাম</th>
                                <td class="fw-bold text-dark font-sm">{{ $donation->display_name }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-secondary font-sm">মোবাইল নম্বর</th>
                                <td class="font-monospace text-dark font-sm">{{ $donation->phone }}</td>
                            </tr>
                            @if($donation->email)
                                <tr>
                                    <th class="bg-light text-secondary font-sm">ইমেইল ঠিকানা</th>
                                    <td class="font-sm text-dark">{{ $donation->email }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th class="bg-light text-secondary font-sm">দানের খাত / ফান্ড</th>
                                <td class="fw-bold text-success font-sm">
                                    <i class="fas fa-hand-holding-heart me-1"></i>
                                    {{ $donation->cause->name ?? ($donation->category ?? 'সাধারণ বাইতুল মাল') }}
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light text-secondary font-sm">পেমেন্ট মাধ্যম</th>
                                <td class="font-sm text-capitalize">
                                    <span class="badge bg-light text-dark border">{{ strtoupper($donation->payment_method) }}</span>
                                    @if($donation->sender_number)
                                        <span class="ms-2 font-xs text-muted">(প্রেরক: {{ $donation->sender_number }})</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light text-secondary font-sm">ট্রানজেকশন আইডি (TrxID)</th>
                                <td class="font-monospace fw-bold text-dark font-sm">{{ $donation->transaction_id ?? 'N/A' }}</td>
                            </tr>
                            <tr class="table-success table-opacity-25">
                                <th class="fw-bold fs-6 text-dark">দানের পরিমাণ</th>
                                <td class="fw-bold fs-4 text-success font-monospace">
                                    ৳ {{ $toBn(number_format($donation->amount, 2)) }}
                                </td>
                            </tr>
                            @if($donation->message)
                                <tr>
                                    <th class="bg-light text-secondary font-sm">দাতার মন্তব্য / দো'আ</th>
                                    <td class="font-sm text-secondary fst-italic">"{{ $donation->message }}"</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Footer Signatures & Official Notice -->
                <div class="row align-items-end pt-4 border-top">
                    <div class="col-8">
                        <div class="small text-muted lh-base" style="font-size: 0.8rem;">
                            * এটি জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর একটি স্বয়ংক্রিয় ইলেকট্রনিক রসিদ। কোনো স্বাক্ষরের প্রয়োজন নেই।<br>
                            * যে কোনো অনুসন্ধান বা তথ্যের জন্য যোগাযোগ করুন: info.shubbanbd@gmail.com
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="official-seal-box d-inline-block text-center p-2 rounded border" style="border-color: #0C4B36 !important; background: #fdfdfd;">
                            <i class="fas fa-stamp fa-2x text-success mb-1"></i>
                            <div class="font-xs fw-bold text-success">শুব্বান কেন্দ্রীয় তহবিল</div>
                            <div class="font-xs text-muted">স্বীকৃত ও সংরক্ষিত</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Links -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('donate.index') }}" class="btn btn-outline-success rounded-pill px-4">
                <i class="fas fa-plus me-1"></i> আরও দান করুন
            </a>
            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-success rounded-pill px-4" style="background: #0C4B36; border-color: #0C4B36;">
                    <i class="fas fa-print me-1"></i> প্রিন্ট ভাউচার
                </button>
                <a href="{{ url('/') }}" class="btn btn-light border rounded-pill px-3">
                    হোম পেজ
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-styles')
<style>
    .font-xs {
        font-size: 0.8rem;
    }
    .font-sm {
        font-size: 0.88rem;
    }
    @media print {
        body * {
            visibility: hidden;
        }
        .print-voucher-card, .print-voucher-card * {
            visibility: visible;
        }
        .print-voucher-card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: 1px solid #ccc !important;
            box-shadow: none !important;
        }
    }
</style>
@endsection
