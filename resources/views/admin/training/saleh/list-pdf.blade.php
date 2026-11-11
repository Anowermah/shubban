<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>সালেহ প্রশিক্ষণ - সদস্য তালিকা</title>
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
        .header p {
            margin: 10px 0 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
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
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>সালেহ প্রশিক্ষণ - সদস্য তালিকা</h1>
        <p>তারিখ: {{ now()->format('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ক্রম</th>
                <th>নাম</th>
                <th>পিতার নাম</th>
                <th>মোবাইল</th>
                <th>শিক্ষাগত যোগ্যতা</th>
                <th>পাসের সন</th>
                <th>জেলা</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $key => $registration)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $registration->name }}</td>
                <td>{{ $registration->father_name }}</td>
                <td>{{ $registration->mobile }}</td>
                <td>{{ $registration->last_education }}</td>
                <td>{{ $registration->passing_year }}</td>
                <td>{{ $registration->present_district }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>এই ডকুমেন্টটি কম্পিউটার জেনারেটেড এবং কোন স্বাক্ষর ছাড়াই বৈধ।</p>
    </div>
</body>
</html>
