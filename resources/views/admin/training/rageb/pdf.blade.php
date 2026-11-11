<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>রাগেব প্রশিক্ষণ রেজিস্ট্রেশন</title>
    <style>
        body {
            font-family: 'bangla', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
            margin-right: 10px;
        }
        .photo {
            max-width: 150px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            @if($logo = asset('images/logo.png'))
                <img src="{{ $logo }}" alt="Logo" class="logo">
            @endif
            <div class="title">রাগেব প্রশিক্ষণ রেজিস্ট্রেশন</div>
            <div class="subtitle">শুববান ইসলামিক সেন্টার</div>
        </div>

        <div class="info-section">
            <div class="info-title">ব্যক্তিগত তথ্য</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">নাম:</span>
                    <span>{{ $registration->name }}</span>
                </div>
                <div class="info-item">
                    <span class="label">পিতার নাম:</span>
                    <span>{{ $registration->father_name }}</span>
                </div>
                <div class="info-item">
                    <span class="label">মাতার নাম:</span>
                    <span>{{ $registration->mother_name }}</span>
                </div>
                <div class="info-item">
                    <span class="label">জন্ম তারিখ:</span>
                    <span>{{ $registration->date_of_birth }}</span>
                </div>
                <div class="info-item">
                    <span class="label">রক্তের গ্রুপ:</span>
                    <span>{{ $registration->blood_group }}</span>
                </div>
                <div class="info-item">
                    <span class="label">লিঙ্গ:</span>
                    <span>{{ $registration->gender == 'male' ? 'পুরুষ' : 'মহিলা' }}</span>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="info-title">যোগাযোগের তথ্য</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">মোবাইল:</span>
                    <span>{{ $registration->mobile }}</span>
                </div>
                <div class="info-item">
                    <span class="label">ইমেইল:</span>
                    <span>{{ $registration->email }}</span>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="info-title">বর্তমান ঠিকানা</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">গ্রাম:</span>
                    <span>{{ $registration->present_village }}</span>
                </div>
                <div class="info-item">
                    <span class="label">পোস্ট:</span>
                    <span>{{ $registration->present_post }}</span>
                </div>
                <div class="info-item">
                    <span class="label">থানা:</span>
                    <span>{{ $registration->present_thana }}</span>
                </div>
                <div class="info-item">
                    <span class="label">জেলা:</span>
                    <span>{{ $registration->present_district }}</span>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="info-title">স্থায়ী ঠিকানা</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">গ্রাম:</span>
                    <span>{{ $registration->permanent_village }}</span>
                </div>
                <div class="info-item">
                    <span class="label">পোস্ট:</span>
                    <span>{{ $registration->permanent_post }}</span>
                </div>
                <div class="info-item">
                    <span class="label">থানা:</span>
                    <span>{{ $registration->permanent_thana }}</span>
                </div>
                <div class="info-item">
                    <span class="label">জেলা:</span>
                    <span>{{ $registration->permanent_district }}</span>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="info-title">প্রতিষ্ঠানের তথ্য</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">প্রতিষ্ঠানের নাম:</span>
                    <span>{{ $registration->organization_name }}</span>
                </div>
                <div class="info-item">
                    <span class="label">পদবি:</span>
                    <span>{{ $registration->designation }}</span>
                </div>
                <div class="info-item">
                    <span class="label">যোগদানের তারিখ:</span>
                    <span>{{ $registration->joining_date }}</span>
                </div>
                <div class="info-item">
                    <span class="label">প্রতিষ্ঠানের ঠিকানা:</span>
                    <span>{{ $registration->organization_address }}</span>
                </div>
            </div>
        </div>

        @if($registration->photo)
            <div class="info-section">
                <div class="info-title">ছবি</div>
                <img src="{{ asset('storage/' . $registration->photo) }}" alt="Photo" class="photo">
            </div>
        @endif

        <div class="footer">
            <p>তারিখ: {{ now()->format('d/m/Y') }}</p>
            <p>একটি রাগেব ট্রেনিং রেজিস্ট্রেশনের PDF ভিউ তৈরি করা হয়েছে</p>
            <p>সর্বস্বত্ব সংরক্ষিত।</p>
        </div>
    </div>
</body>
</html>
