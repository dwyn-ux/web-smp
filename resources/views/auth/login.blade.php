<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
            <img src="{{ asset('assets/logo smp.png') }}" alt="Logo" class="w-20 h-20 mx-auto mb-4">
            <h1 class="text-2xl font-bold text-blue-900">Admin Login</h1>
            <p class="text-gray-500 text-sm">SMP Muhammadiyah Unggulan Ashidiq</p>
        </div>

        @if($errors->any())
        <div class="bg-red-50 text-red-600 p-4 rounded-2xl mb-6 text-sm font-bold">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" required class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-gray-50">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-gray-50">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                Masuk ke Panel
            </button>
        </form>
    </div>
</body>
</html>
