<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>সালেহ প্রশিক্ষণ রেজিস্ট্রেশন</title>
    <style>
        body {
            font-family: 'SolaimanLipi', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            padding: 0;
        }
        .photo {
            float: right;
            margin-left: 20px;
            margin-bottom: 20px;
        }
        .photo img {
            width: 100px;
            height: auto;
            border: 1px solid #ddd;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-section h2 {
            font-size: 18px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
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
        .info-item strong {
            display: inline-block;
            min-width: 150px;
        }
        .address-section {
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>সালেহ প্রশিক্ষণ রেজিস্ট্রেশন</h1>
    </div>

    @if($registration->photo)
        <div class="photo">
            <img src="{{ public_path('storage/'.$registration->photo) }}" alt="Photo">
        </div>
    @endif

    <div class="info-section">
        <h2>ব্যক্তিগত তথ্য</h2>
        <div class="info-grid">
            <div class="info-item">
                <strong>নাম:</strong> {{ $registration->name }}
            </div>
            <div class="info-item">
                <strong>পিতার নাম:</strong> {{ $registration->father_name }}
            </div>
            <div class="info-item">
                <strong>মাতার নাম:</strong> {{ $registration->mother_name }}
            </div>
            <div class="info-item">
                <strong>পিতার পেশা:</strong> {{ $registration->father_occupation }}
            </div>
            <div class="info-item">
                <strong>জন্ম তারিখ:</strong> {{ $registration->date_of_birth->format('d/m/Y') }}
            </div>
            <div class="info-item">
                <strong>জাতীয় পরিচয়পত্র নম্বর:</strong> {{ $registration->nid }}
            </div>
            <div class="info-item">
                <strong>রক্তের গ্রুপ:</strong> {{ $registration->blood_group }}
            </div>
            <div class="info-item">
                <strong>লিঙ্গ:</strong> {{ $registration->gender == 'male' ? 'পুরুষ' : 'মহিলা' }}
            </div>
            <div class="info-item">
                <strong>মোবাইল:</strong> {{ $registration->mobile }}
            </div>
            <div class="info-item">
                <strong>ইমেইল:</strong> {{ $registration->email }}
            </div>
        </div>
    </div>

    <div class="info-section">
        <h2>শিক্ষাগত যোগ্যতা</h2>
        <div class="info-grid">
            <div class="info-item">
                <strong>সর্বশেষ শিক্ষাগত যোগ্যতা:</strong> {{ $registration->last_education }}
            </div>
            <div class="info-item">
                <strong>প্রতিষ্ঠানের নাম:</strong> {{ $registration->institute }}
            </div>
            <div class="info-item">
                <strong>পাসের সন:</strong> {{ $registration->passing_year }}
            </div>
            <div class="info-item">
                <strong>ফলাফল:</strong> {{ $registration->result }}
            </div>
        </div>
    </div>

    <div class="info-section">
        <h2>বর্তমান ঠিকানা</h2>
        <div class="address-section">
            <div class="info-item">
                <strong>গ্রাম:</strong> {{ $registration->present_village }}
            </div>
            <div class="info-item">
                <strong>পোস্ট:</strong> {{ $registration->present_post }}
            </div>
            <div class="info-item">
                <strong>থানা:</strong> {{ $registration->present_thana }}
            </div>
            <div class="info-item">
                <strong>জেলা:</strong> {{ $registration->present_district }}
            </div>
        </div>
    </div>

    <div class="info-section">
        <h2>স্থায়ী ঠিকানা</h2>
        <div class="address-section">
            <div class="info-item">
                <strong>গ্রাম:</strong> {{ $registration->permanent_village }}
            </div>
            <div class="info-item">
                <strong>পোস্ট:</strong> {{ $registration->permanent_post }}
            </div>
            <div class="info-item">
                <strong>থানা:</strong> {{ $registration->permanent_thana }}
            </div>
            <div class="info-item">
                <strong>জেলা:</strong> {{ $registration->permanent_district }}
            </div>
        </div>
    </div>

    <div class="footer">
        <p>এই ডকুমেন্টটি কম্পিউটার জেনারেটেড এবং কোন স্বাক্ষর ছাড়াই বৈধ।</p>
    </div>
</body>
</html>
