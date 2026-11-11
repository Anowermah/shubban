<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>আরেফ প্রশিক্ষণ রেজিস্ট্রেশন তালিকা</title>
    <style>
        body {
            font-family: 'bangla', sans-serif;
            line-height: 1.6;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
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
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>আরেফ প্রশিক্ষণ রেজিস্ট্রেশন তালিকা</h2>
            <p>মোট রেজিস্ট্রেশন: {{ $registrations->count() }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ক্রমিক</th>
                    <th>নাম</th>
                    <th>পিতার নাম</th>
                    <th>মোবাইল</th>
                    <th>জেলা</th>
                    <th>শিক্ষাগত যোগ্যতা</th>
                    <th>রেজিস্ট্রেশন তারিখ</th>
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
                    <td>{{ $registration->last_education }}</td>
                    <td>{{ $registration->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>তারিখ: {{ now()->format('d/m/Y') }}</p>
        </div>
    </div>
</body>
</html>
