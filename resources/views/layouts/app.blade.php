<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMP Muhammadiyah Unggulan Ashidiq')</title>
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white text-gray-900 font-sans">
    @include('partials.navbar')

    <div class="min-h-screen">
        @yield('content')
    </div>

    @include('partials.footer')

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
