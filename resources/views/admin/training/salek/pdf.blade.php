<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>সালেক প্রশিক্ষণ রেজিস্ট্রেশন</title>
    <style>
        @font-face {
            font-family: 'SolaimanLipi';
            src: url({{ storage_path('fonts/SolaimanLipi.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        
        body {
            font-family: 'SolaimanLipi', sans-serif;
            line-height: 1.6;
            font-size: 14px;
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
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
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
            <h2>সালেক প্রশিক্ষণ রেজিস্ট্রেশন</h2>
        </div>

        <table>
            <tr>
                <th>নাম</th>
                <td>{{ $registration->name }}</td>
            </tr>
            <tr>
                <th>পিতার নাম</th>
                <td>{{ $registration->father_name }}</td>
            </tr>
            <tr>
                <th>মোবাইল</th>
                <td>{{ $registration->mobile }}</td>
            </tr>
            <tr>
                <th>জেলা</th>
                <td>{{ $registration->present_district }}</td>
            </tr>
            <tr>
                <th>শিক্ষাগত যোগ্যতা</th>
                <td>{{ $registration->last_education }}</td>
            </tr>
            <tr>
                <th>রেজিস্ট্রেশন তারিখ</th>
                <td>{{ $registration->created_at->format('d/m/Y') }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>তারিখ: {{ now()->format('d/m/Y') }}</p>
        </div>
    </div>
</body>
</html>
