<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify Clone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center">Welcome to Shopify Clone</h1>
        <div class="flex justify-center mt-4">
            <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Register</a>
            <a href="{{ route('login') }}" class="bg-green-500 text-white px-4 py-2 rounded">Login</a>
        </div>
    </div>
</body>
</html>
