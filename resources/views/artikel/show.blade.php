@extends('layouts.app')

@section('content')
<section class="py-32 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        @if($article->image)
        <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="w-full h-96 object-cover rounded-3xl mb-8 shadow-xl">
        @endif
        <h1 class="text-4xl md:text-5xl font-black text-blue-900 mb-4">{{ $article->title }}</h1>
        <p class="text-gray-500 mb-8 border-b pb-4">{{ $article->created_at->format('d F Y') }}</p>
        
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            {!! $article->content !!}
        </div>
    </div>
</section>
@endsection
