@extends('layouts.app')

@section('content')
<section class="py-32 bg-white">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-black text-blue-900 mb-12 uppercase">Artikel & Berita</h1>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <a href="{{ route('artikel.show', $article->slug) }}" class="group">
                <div class="relative h-64 mb-4 overflow-hidden rounded-xl">
                    <img src="{{ asset($article->image ?? 'assets/logo smp.png') }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <h2 class="text-xl font-bold group-hover:text-blue-600 transition">{{ $article->title }}</h2>
                <p class="text-gray-500 text-sm mt-2">{{ $article->created_at->format('d F Y') }}</p>
            </a>
            @endforeach
        </div>
        <div class="mt-12">
            {{ $articles->links() }}
        </div>
    </div>
</section>
@endsection
