@extends('admin.layout')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
        <h1 class="text-2xl font-bold text-gray-800 mb-8 flex items-center gap-2">
            <i data-lucide="building-2" class="text-blue-600"></i>
            {{ isset($facility) ? 'Edit Fasilitas' : 'Tambah Fasilitas' }}
        </h1>

        <form action="{{ isset($facility) ? route('admin.facilities.update', $facility) : route('admin.facilities.store') }}"
              method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if(isset($facility)) @method('PUT') @endif

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul</label>
                <input type="text" name="title" required value="{{ old('title', $facility->title ?? '') }}"
                    class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:ring-2 focus:ring-blue-500 outline-none bg-white text-gray-900"
                    placeholder="Contoh: Laboratorium Modern">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" required rows="4"
                    class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:ring-2 focus:ring-blue-500 outline-none bg-white text-gray-900"
                    placeholder="Jelaskan fasilitas ini">{{ old('description', $facility->description ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Foto</label>
                @if(isset($facility) && $facility->image_url)
                <img src="{{ $facility->image_url }}" alt="Preview" class="h-40 w-full object-cover rounded-2xl border border-gray-200 mb-3">
                @endif
                <input type="file" name="image" accept="image/*" {{ !isset($facility) ? 'required' : '' }}
                    class="w-full border border-gray-300 rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none bg-white text-gray-900">
                <p class="text-xs text-gray-400 mt-1">{{ isset($facility) ? 'Kosongkan jika tidak ingin mengganti foto.' : 'Maks 5MB (JPEG/PNG/WEBP).' }}</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $facility->sort_order ?? 0) }}"
                    class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:ring-2 focus:ring-blue-500 outline-none bg-white text-gray-900">
                <p class="text-xs text-gray-400 mt-1">Angka kecil tampil lebih dulu.</p>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                <i data-lucide="save"></i> Simpan Fasilitas
            </button>
        </form>
    </div>
</div>
@endsection
