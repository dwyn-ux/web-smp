@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl font-bold text-gray-800">Manajemen Galeri</h2>
    <a href="{{ route('admin.gallery.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-xl flex items-center gap-2 hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition">
        <i data-lucide="plus"></i> Tambah Foto
    </a>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    @foreach($galleries as $item)
    <div class="bg-white rounded-3xl shadow-md overflow-hidden group border border-gray-100 p-2">
        <div class="relative h-40 mb-3 overflow-hidden rounded-2xl">
            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
            <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-600 text-white p-2 rounded-full shadow-lg" onclick="return confirm('Hapus foto ini?')">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
        <p class="text-sm font-bold text-gray-700 px-2 truncate">{{ $item->title }}</p>
    </div>
    @endforeach
</div>
@endsection
