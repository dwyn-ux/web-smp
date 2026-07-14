@extends('layouts.app')

@section('content')
<section class="py-32 bg-gray-50">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-black text-blue-900 mb-4 uppercase text-center">Dokumentasi & Unduhan</h1>
        <p class="text-center text-gray-500 mb-10">Kumpulan dokumen dan file penting sekolah</p>
        
        <!-- Filter Bar -->
        <div class="max-w-4xl mx-auto mb-10" x-data="{ openFilter: false }">
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('dokumentasi.index') }}" 
                   class="px-5 py-2.5 rounded-full font-bold text-sm transition-all duration-300
                          {{ !request('type') && !request('category') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                    Semua
                </a>
                @foreach($types as $type)
                <a href="{{ route('dokumentasi.index', ['type' => $type]) }}" 
                   class="px-5 py-2.5 rounded-full font-bold text-sm transition-all duration-300 uppercase
                          {{ request('type') == $type ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                    {{ $type }}
                </a>
                @endforeach
                <!-- Category Filter Dropdown -->
                @if($categories->isNotEmpty())
                <div class="relative" @click.outside="openFilter = false">
                    <button @click="openFilter = !openFilter" 
                            class="px-5 py-2.5 rounded-full font-bold text-sm transition-all duration-300 flex items-center gap-2
                                   {{ request('category') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                        <i data-lucide="filter" class="w-4 h-4"></i>
                        {{ request('category') ? ucfirst(request('category')) : 'Kategori' }}
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                    <div x-show="openFilter" x-cloak
                         x-transition.opacity
                         class="absolute top-full mt-2 right-0 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-20 min-w-[180px]">
                        <a href="{{ route('dokumentasi.index', request()->except('category')) }}" 
                           class="block px-5 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                            Semua Kategori
                        </a>
                        @foreach($categories as $cat)
                        <a href="{{ route('dokumentasi.index', ['category' => $cat]) }}" 
                           class="block px-5 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition capitalize">
                            {{ $cat }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Document Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($documents as $doc)
            <a href="{{ route('dokumentasi.show', $doc->id) }}" class="block bg-white rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-gray-100 overflow-hidden group">
                <!-- Thumbnail Area -->
                <div class="relative h-48 flex items-center justify-center border-b border-gray-100 overflow-hidden">
                    @if($doc->thumbnail_url)
                        <img src="{{ $doc->thumbnail_url }}" alt="{{ $doc->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="flex flex-col items-center gap-3 bg-gradient-to-br from-blue-50 to-indigo-50 w-full h-full justify-center">
                            <div class="p-6 rounded-2xl bg-blue-100 text-blue-600 group-hover:bg-blue-200 group-hover:scale-110 transition-all">
                                @if($doc->type == 'pdf')
                                    <i data-lucide="file-text" class="w-12 h-12"></i>
                                @elseif($doc->type == 'doc')
                                    <i data-lucide="file-type" class="w-12 h-12"></i>
                                @elseif($doc->type == 'xls')
                                    <i data-lucide="sheet" class="w-12 h-12"></i>
                                @else
                                    <i data-lucide="file" class="w-12 h-12"></i>
                                @endif
                            </div>
                            <span class="text-xs font-bold uppercase text-blue-500 bg-blue-50 px-3 py-1 rounded-full">{{ $doc->type }}</span>
                        </div>
                    @endif
                    <!-- Category Badge -->
                    @if($doc->category)
                    <span class="absolute top-3 left-3 text-[10px] font-bold uppercase bg-white/90 text-blue-700 px-2.5 py-1 rounded-full shadow-sm backdrop-blur-sm">
                        {{ $doc->category }}
                    </span>
                    @endif
                </div>
                
                <!-- Card Info -->
                <div class="p-5">
                    <h3 class="font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-700 transition-colors">{{ $doc->title }}</h3>
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-500 uppercase">{{ $doc->type }} • {{ $doc->size }}</p>
                        <span class="text-blue-600 text-sm font-bold flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            Buka <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        @if($documents->isEmpty())
        <div class="text-center py-16">
            <div class="p-6 rounded-2xl bg-blue-50 text-blue-600 inline-block mb-4">
                <i data-lucide="folder-open" class="w-12 h-12"></i>
            </div>
            <p class="text-gray-500 text-lg">Belum ada dokumen tersedia.</p>
        </div>
        @endif

        <div class="mt-20">
            <h2 class="text-2xl font-black text-blue-900 mb-8 uppercase text-center">Video Dokumentasi</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl overflow-hidden shadow-md">
                    <div class="relative pt-[56.25%]">
                        <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/BSo6euWKtpQ" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
