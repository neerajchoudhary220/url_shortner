<!DOCTYPE html>
<html>
<head>
    <title>Your Export is Ready</title>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Hello {{ $user->name }},</h1>

    <p>Your export file <strong>{{ $filename }}</strong> is ready for download.</p>

    <p>
        <a href="{{ route('shortUrl.downloadCsvFile',$encrypted_user_id) }}" class="button">Download Export File</a>
    </p>

    <p>Thank you,<br>
    {{ config('app.name') }}</p>
</body>
</html>
