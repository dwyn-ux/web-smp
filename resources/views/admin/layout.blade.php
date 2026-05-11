<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">
    <header class="bg-blue-900 text-white p-4 flex justify-between items-center sticky top-0 z-50">
        <h1 class="text-xl font-bold uppercase tracking-tight">Admin SMP Muh Unggulan Ashidiq</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-2 hover:text-blue-300 font-bold transition">
                <i data-lucide="log-out" class="w-5 h-5"></i> Logout
            </button>
        </form>
    </header>

    <div class="container mx-auto p-4 md:p-8">
        <div class="flex gap-4 mb-8 border-b overflow-x-auto">
            <a href="{{ route('admin.articles.index') }}" class="pb-2 px-4 font-bold transition {{ request()->routeIs('admin.articles.*') ? 'border-b-4 border-blue-600 text-blue-600' : 'text-gray-500' }}">Artikel</a>
            <a href="{{ route('admin.gallery.index') }}" class="pb-2 px-4 font-bold transition {{ request()->routeIs('admin.gallery.*') ? 'border-b-4 border-blue-600 text-blue-600' : 'text-gray-500' }}">Galeri</a>
            <a href="{{ route('admin.documents.index') }}" class="pb-2 px-4 font-bold transition {{ request()->routeIs('admin.documents.*') ? 'border-b-4 border-blue-600 text-blue-600' : 'text-gray-500' }}">Dokumen</a>
        </div>

        @yield('content')
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
