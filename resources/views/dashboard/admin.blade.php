<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Shopify Clone</title>
    <style>
        body {
            background-color: #f7fafc;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
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
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
        <h1>Admin Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}! You have administrative privileges.</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="button">Logout</button>
        </form>
    </div>
    //admin login
</body>
</html>
