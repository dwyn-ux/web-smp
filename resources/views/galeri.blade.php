@extends('layouts.app')

@section('content')
<section class="py-32 bg-white">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-black text-blue-900 mb-12 uppercase">Galeri Foto</h1>
        <div class="columns-1 sm:columns-2 lg:columns-3 gap-4 space-y-4">
            @foreach($galleries as $item)
            <div class="break-inside-avoid group relative overflow-hidden rounded-xl shadow-md">
                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <p class="text-white font-bold">{{ $item->title }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
    </div>
</section>
@endsection
