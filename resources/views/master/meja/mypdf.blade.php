<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <style>
        /* Optional: Add basic styles */
        body { font-family: sans-serif; }
        h1 { text-align: center; }
        .qrcode-container { text-align: center; margin-top: 50px; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Generated on: {{ $date }}</p>
    
    <div class="qrcode-container">
        <h2>Scan Me</h2>
        <img src="data:image/svg+xml;base64,{{ $qrcode }}" alt="QR Code">
        <p>Data: {{ $data_to_encode ?? 'Check your controller for the encoded data' }}</p>
    </div>
</body>
</html>