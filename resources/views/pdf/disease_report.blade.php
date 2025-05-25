<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Disease Report #{{ $report->report_number }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.4;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #0068B7;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            padding: 20px;
        }
        .report-details {
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }
        .diagnosis {
            margin-bottom: 30px;
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
        <h1>Disease Report #{{ $report->report_number }}</h1>
    </div>
    
    <div class="content">
        <div class="report-details">
            <h2>Report Details</h2>
            <p><strong>Report Number:</strong> {{ $report->report_number }}</p>
            <p><strong>Date:</strong> {{ $date }}</p>
            <p><strong>Disease:</strong> {{ $disease }}</p>
        </div>
        <div>
            <img src="{{ $image }}" alt="Annotated" style="max-width: 100%; height: auto;">
        </div>
        <div class="diagnosis">
            <h2>Diagnosis and Recommendations</h2>
            <div>{!! $info !!}</div>
        </div>
    </div>
    
    {{-- <div class="footer">
        <p>This is a computer-generated report and does not require a signature.</p>
        <p>Generated on: {{ now()->format('d M Y H:i:s') }}</p>
    </div> --}}
</body>
</html>
