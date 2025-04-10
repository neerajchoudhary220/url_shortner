<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation to Join {{ $company_name }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
        }
        h1 {
            color: #2d3748;
            font-size: 24px;
            margin-top: 0;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4299e1;
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
        }
        .button:hover {
            background-color: #3182ce;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #718096;
            text-align: center;
        }
        .details {
            margin: 20px 0;
            padding: 15px;
            background-color: #edf2f7;
            border-radius: 4px;
        }
        .details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
  

    <div class="content">
        <h1>You're Invited!</h1>
        
        <p>Hello,</p>
        
        <p>You have been invited to join <strong>{{ $company_name }}</strong> as a <strong>{{ $role}}</strong>.</p>
        
        <div class="details">
            <p><strong>Company:</strong> {{ $company_name }}</p>
            <p><strong>Your Role:</strong> {{ $role }}</p>
        </div>
        
        <p>Click the button below to accept this invitation and complete your registration:</p>
        
        <div style="text-align: center;">
            <a href="{{$registerUrl}}" class="button">Accept Invitation</a>
        </div>
        
        <p>If you're unable to click the button above, copy and paste this link into your browser:</p>
        <p><a href="{{$registerUrl}}">{{$registerUrl}}</a></p>
        
    </div>
    
    
</body>
</html>