@extends('layouts.app')

@section('content')
<section class="py-24 bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 max-w-5xl">

        <style>
            #pdf-container {
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
        </style>
        <!-- Breadcrumb & Back -->
        <div class="mb-8">
            <a href="{{ route('dokumentasi.index') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-bold text-sm transition-colors bg-white px-4 py-2 rounded-xl shadow-sm hover:shadow-md">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Dokumentasi
            </a>
        </div>

        <!-- Document Info Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">
                @if($document->thumbnail_url)
                    <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 shadow-md">
                        <img src="{{ $document->thumbnail_url }}" alt="{{ $document->title }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="p-3 rounded-xl bg-blue-100 text-blue-600 flex-shrink-0">
                        <i data-lucide="file-text" class="w-8 h-8"></i>
                    </div>
                @endif
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">{{ $document->title }}</h1>
                    <div class="flex items-center gap-3 flex-wrap">
                        @if($document->category)
                            <span class="text-xs font-bold uppercase bg-green-100 text-green-700 px-3 py-1 rounded-full">{{ $document->category }}</span>
                        @endif
                        <span class="text-xs font-bold uppercase bg-blue-100 text-blue-700 px-3 py-1 rounded-full">{{ $document->type }}</span>
                        <span class="text-sm text-gray-500">{{ $document->size }}</span>
                    </div>
                </div>
                <div class="text-sm text-gray-400 flex items-center gap-1">
                    <i data-lucide="clock" class="w-3 h-3"></i>
                    {{ $document->created_at->format('d M Y') }}
                </div>
            </div>

            <!-- PDF Viewer -->
            <div id="pdf-container" class="relative bg-gray-900" style="height: 75vh; min-height: 500px;" oncontextmenu="return false;">
                <!-- Overlay Anti-Download (pointer-events: none agar scroll tetap tembus) -->
                <div id="anti-download-overlay" class="absolute inset-0 z-10 pointer-events-none" style="background: transparent;"></div>
                
                <!-- Loading -->
                <div id="pdf-loading" class="absolute inset-0 flex items-center justify-center bg-gray-900 z-20">
                    <div class="text-center">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-400 mx-auto mb-4"></div>
                        <p class="text-gray-300 text-sm">Memuat dokumen...</p>
                    </div>
                </div>

                <!-- PDF Embed -->
                <embed id="pdf-embed"
                       src="{{ route('dokumentasi.stream', $document->id) }}#toolbar=0&navpanes=1&scrollbar=1" 
                       type="application/pdf" 
                       class="absolute inset-0 w-full h-full z-0"
                       style="border: none;" />
            </div>
        </div>

        <!-- Action Bar -->
        <div class="flex items-center justify-center gap-4 text-sm text-gray-400 mb-8">
            <span class="flex items-center gap-1">
                <i data-lucide="shield" class="w-3 h-3"></i> Dokumen dilindungi
            </span>
            <span>•</span>
            <span>Hanya untuk dibaca</span>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pdfEmbed = document.getElementById('pdf-embed');
    const loading = document.getElementById('pdf-loading');

    // Hide loading when PDF loads
    if (pdfEmbed) {
        pdfEmbed.addEventListener('load', function() {
            if (loading) loading.style.display = 'none';
        });
        // Fallback: hide loading after 5 seconds
        setTimeout(function() {
            if (loading) loading.style.display = 'none';
        }, 5000);
    }

    // Blokir keyboard shortcuts download (Ctrl+S, Ctrl+P, Ctrl+Shift+S)
    document.addEventListener('keydown', function(e) {
        // Ctrl+S / Ctrl+Shift+S (Save)
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            return false;
        }
        // Ctrl+P (Print)
        if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            return false;
        }
    });
});
</script>
@endsection
