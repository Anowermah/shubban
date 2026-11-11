<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>রাগেব প্রশিক্ষণ রেজিস্ট্রেশন তালিকা</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            @if($logo = asset('images/logo.png'))
                <img src="{{ $logo }}" alt="Logo" class="logo">
            @endif
            <div class="title">রাগেব প্রশিক্ষণ রেজিস্ট্রেশন তালিকা</div>
            <div class="subtitle">শুববান ইসলামিক সেন্টার</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ক্রমিক</th>
                    <th>নাম</th>
                    <th>পিতার নাম</th>
                    <th>মোবাইল</th>
                    <th>জেলা</th>
                    <th>পদবি</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $registration->name }}</td>
                        <td>{{ $registration->father_name }}</td>
                        <td>{{ $registration->mobile }}</td>
                        <td>{{ $registration->present_district }}</td>
                        <td>{{ $registration->designation }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>মোট রেজিস্ট্রেশন: {{ $registrations->count() }} জন</p>
            <p>তারিখ: {{ now()->format('d/m/Y') }}</p>
            <p>© {{ date('Y') }} শুববান ইসলামিক সেন্টার। সর্বস্বত্ব সংরক্ষিত।</p>
        </div>
    </div>
</body>
</html>
