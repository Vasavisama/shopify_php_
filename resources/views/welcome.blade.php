<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify Clone</title>
    <style>
        body {
            background-color: #f7fafc;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 10px;
        }
        .button-blue {
            background-color: #007bff;
        }
        .button-green {
            background-color: #28a745;
        }
        .success {
            color: green;
            font-size: 1rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        <h1>Welcome to Shopify Clone</h1>
        <div>
            <a href="{{ route('register') }}" class="button button-blue">Register</a>
            <a href="{{ route('login') }}" class="button button-green">Login</a>
        
        </div>
    </div>
</body>
</html>
