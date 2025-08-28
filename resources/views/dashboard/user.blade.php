<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Shopify Clone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">User Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}! Your store: {{ auth()->user()->store->name }}</p>
        <form id="logout-form" action="/logout" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded mt-4">Logout</button>
        </form>
    </div>

    <script>
        document.getElementById('logout-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const response = await fetch('/api/logout', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                },
            });
            if (response.ok) {
                localStorage.removeItem('token');
                window.location.href = '/';
            }
        });
    </script>
</body>
</html>
