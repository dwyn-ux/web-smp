@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl font-bold text-gray-800">Fasilitas Unggulan</h2>
    <a href="{{ route('admin.facilities.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-xl flex items-center gap-2 hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition">
        <i data-lucide="plus"></i> Tambah Fasilitas
    </a>
</div>

@if(session('success'))
<div class="mb-6 bg-green-50 text-green-700 px-4 py-3 rounded-2xl font-medium">{{ session('success') }}</div>
@endif

<div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($facilities as $item)
    <div class="bg-white rounded-3xl shadow-md overflow-hidden border border-gray-100">
        <div class="h-44 overflow-hidden">
            <img src="{{ $item->image_url ?? asset('assets/logo smp.png') }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
        </div>
        <div class="p-6">
            <div class="flex items-start justify-between gap-2 mb-2">
                <h3 class="font-bold text-lg text-gray-800">{{ $item->title }}</h3>
                <span class="text-xs text-gray-400 bg-gray-100 rounded-full px-2 py-1 whitespace-nowrap">Urutan {{ $item->sort_order }}</span>
            </div>
            <p class="text-gray-500 text-sm leading-relaxed">{{ $item->description }}</p>
            <div class="flex gap-2 mt-4">
                <a href="{{ route('admin.facilities.edit', $item) }}" class="text-blue-600 hover:text-blue-800 text-sm font-bold">Edit</a>
                <form action="{{ route('admin.facilities.destroy', $item) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-bold" onclick="return confirm('Hapus fasilitas ini?')">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-16 text-gray-400">
        <p>Belum ada fasilitas. Klik "Tambah Fasilitas" untuk menambahkan.</p>
    </div>
    @endforelse
</div>
@endsection
