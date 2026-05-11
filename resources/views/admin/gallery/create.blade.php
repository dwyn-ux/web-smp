@extends('admin.layout')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
        <h1 class="text-2xl font-bold text-gray-800 mb-8 flex items-center gap-2">
            <i data-lucide="image" class="text-blue-600"></i> Tambah Foto Galeri
        </h1>
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Foto</label>
                <input type="text" name="title" required class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Kegiatan Shalat Berjamaah">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Foto</label>
                <input type="file" name="image" accept="image/*" required class="w-full text-sm text-gray-500">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                Upload Foto
            </button>
        </form>
    </div>
</div>
@endsection
