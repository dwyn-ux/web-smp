@extends('admin.layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100 flex items-center gap-6">
        <div class="p-4 bg-blue-50 text-blue-600 rounded-2xl">
            <i data-lucide="file-text" class="w-8 h-8"></i>
        </div>
        <div>
            <p class="text-gray-500 font-bold text-xs uppercase tracking-widest mb-1">Total Artikel</p>
            <h3 class="text-3xl font-black text-gray-800">{{ \App\Models\Article::count() }}</h3>
        </div>
    </div>

    <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100 flex items-center gap-6">
        <div class="p-4 bg-purple-50 text-purple-600 rounded-2xl">
            <i data-lucide="image" class="w-8 h-8"></i>
        </div>
        <div>
            <p class="text-gray-500 font-bold text-xs uppercase tracking-widest mb-1">Foto Galeri</p>
            <h3 class="text-3xl font-black text-gray-800">{{ \App\Models\Gallery::count() }}</h3>
        </div>
    </div>

    <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100 flex items-center gap-6">
        <div class="p-4 bg-orange-50 text-orange-600 rounded-2xl">
            <i data-lucide="folder" class="w-8 h-8"></i>
        </div>
        <div>
            <p class="text-gray-500 font-bold text-xs uppercase tracking-widest mb-1">Dokumen</p>
            <h3 class="text-3xl font-black text-gray-800">{{ \App\Models\Document::count() }}</h3>
        </div>
    </div>
</div>

<div class="bg-blue-900 rounded-3xl p-8 text-white relative overflow-hidden shadow-2xl">
    <div class="relative z-10">
        <h2 class="text-3xl font-black mb-2">Selamat Datang, Admin!</h2>
        <p class="text-blue-200 max-w-xl">
            Di panel ini Anda bisa mengelola konten website SMP Muhammadiyah Unggulan Ashidiq. 
            Gunakan tab di atas untuk mulai membuat artikel baru, mengunggah foto kegiatan, atau menambah dokumen unduhan.
        </p>
    </div>
    <i data-lucide="layout-dashboard" class="absolute -right-8 -bottom-8 w-64 h-64 text-blue-800 opacity-20 rotate-12"></i>
</div>
@endsection
