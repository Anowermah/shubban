<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>রেজিস্ট্রেশন ফরম</title>
    <style>
        @font-face {
            font-family: 'Kalpurush';
            src: url({{ storage_path('fonts/Kalpurush.ttf') }}) format('truetype');
        }

        body {
            font-family: 'Kalpurush', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 30px;
            background: #f8f9fa;
            font-size: 14px;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 20px;
            border-bottom: 2px solid #007bff;
        }

        .header h1 {
            color: #007bff;
            margin: 0 0 10px;
            font-size: 24px;
            font-weight: bold;
        }

        .registration-id {
            font-size: 16px;
            color: #666;
            margin-top: 10px;
        }

        .photo {
            width: 120px;
            height: 150px;
            object-fit: cover;
            border: 2px solid #007bff;
            position: absolute;
            top: 40px;
            right: 40px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            color: #007bff;
            font-size: 18px;
            margin: 0 0 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .info-row {
            display: table-row;
        }

        .info-cell {
            display: table-cell;
            padding: 8px 15px;
            border: 1px solid #dee2e6;
        }

        .info-label {
            background: #f8f9fa;
            font-weight: bold;
            width: 200px;
            color: #495057;
        }

        .info-value {
            color: #333;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
        }

        /* Print styles */
        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .container {
                box-shadow: none;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                @if($registration->course_type == 'aref')
                    আরেফ প্রশিক্ষণ রেজিস্ট্রেশন
                @elseif($registration->course_type == 'saleh')
                    সালেহ প্রশিক্ষণ রেজিস্ট্রেশন
                @elseif($registration->course_type == 'rageb')
                    রাগেব প্রশিক্ষণ রেজিস্ট্রেশন
                @elseif($registration->course_type == 'salek')
                    সালেক প্রশিক্ষণ রেজিস্ট্রেশন
                @endif
            </h1>
            <div class="registration-id">রেজিস্ট্রেশন নং: {{ $registration->id }}</div>
        </div>

        @if($registration->photo)
            <img src="{{ public_path('uploads/photos/' . $registration->photo) }}" alt="ছবি" class="photo">
        @endif

        <div class="section">
            <h2>ব্যক্তিগত তথ্য</h2>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-cell info-label">নাম</div>
                    <div class="info-cell info-value">{{ $registration->name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">পিতার নাম</div>
                    <div class="info-cell info-value">{{ $registration->father_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">মাতার নাম</div>
                    <div class="info-cell info-value">{{ $registration->mother_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">জন্ম তারিখ</div>
                    <div class="info-cell info-value">{{ date('d/m/Y', strtotime($registration->date_of_birth)) }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">লিঙ্গ</div>
                    <div class="info-cell info-value">{{ $registration->gender == 'male' ? 'পুরুষ' : 'মহিলা' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">রক্তের গ্রুপ</div>
                    <div class="info-cell info-value">{{ $registration->blood_group ?? 'উল্লেখ নেই' }}</div>
                </div>
                @if($registration->nid)
                <div class="info-row">
                    <div class="info-cell info-label">জাতীয় পরিচয়পত্র নম্বর</div>
                    <div class="info-cell info-value">{{ $registration->nid }}</div>
                </div>
                @endif
                <div class="info-row">
                    <div class="info-cell info-label">মোবাইল নম্বর</div>
                    <div class="info-cell info-value">{{ $registration->mobile }}</div>
                </div>
                @if($registration->email)
                <div class="info-row">
                    <div class="info-cell info-label">ইমেইল</div>
                    <div class="info-cell info-value">{{ $registration->email }}</div>
                </div>
                @endif
            </div>
        </div>

        <div class="section">
            <h2>জরুরী যোগাযোগ</h2>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-cell info-label">যোগাযোগের নম্বর</div>
                    <div class="info-cell info-value">{{ $registration->emergency_contact }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">সম্পর্ক</div>
                    <div class="info-cell info-value">{{ $registration->emergency_relation }}</div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>বর্তমান ঠিকানা</h2>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-cell info-label">গ্রাম/মহল্লা</div>
                    <div class="info-cell info-value">{{ $registration->present_village }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">ডাকঘর</div>
                    <div class="info-cell info-value">{{ $registration->present_post }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">থানা/উপজেলা</div>
                    <div class="info-cell info-value">{{ $registration->present_thana }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">জেলা</div>
                    <div class="info-cell info-value">{{ $registration->present_district }}</div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>স্থায়ী ঠিকানা</h2>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-cell info-label">গ্রাম/মহল্লা</div>
                    <div class="info-cell info-value">{{ $registration->permanent_village }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">ডাকঘর</div>
                    <div class="info-cell info-value">{{ $registration->permanent_post }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">থানা/উপজেলা</div>
                    <div class="info-cell info-value">{{ $registration->permanent_thana }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">জেলা</div>
                    <div class="info-cell info-value">{{ $registration->permanent_district }}</div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>শিক্ষাগত যোগ্যতা</h2>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-cell info-label">সর্বশেষ শিক্ষাগত যোগ্যতা</div>
                    <div class="info-cell info-value">{{ $registration->last_education }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">শিক্ষা প্রতিষ্ঠান</div>
                    <div class="info-cell info-value">{{ $registration->institute }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">পাসের সন</div>
                    <div class="info-cell info-value">{{ $registration->passing_year }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">ফলাফল</div>
                    <div class="info-cell info-value">{{ $registration->result }}</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>{{ config('app.name') }} &copy; {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>
