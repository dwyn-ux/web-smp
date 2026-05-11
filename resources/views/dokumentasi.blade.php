@extends('layouts.app')

@section('content')
<section class="py-32 bg-gray-50">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-black text-blue-900 mb-12 uppercase text-center">Dokumentasi & Unduhan</h1>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($documents as $doc)
            <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition flex items-start gap-4 border border-gray-100">
                <div class="p-3 rounded-xl bg-blue-50 text-blue-600">
                    <i data-lucide="file-text"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-gray-800 mb-1 line-clamp-2">{{ $doc->title }}</h3>
                    <p class="text-sm text-gray-500 mb-3 uppercase">{{ $doc->type }} • {{ $doc->size }}</p>
                    <a href="{{ asset($doc->file) }}" download class="text-sm font-bold text-blue-600 flex items-center gap-1 hover:text-blue-800">
                        <i data-lucide="download" class="w-4 h-4"></i> Unduh File
                    </a>
                </div>
            </div>
            @endforeach
        </div>

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
