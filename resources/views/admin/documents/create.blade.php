@extends('admin.layout')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
        <h1 class="text-2xl font-bold text-gray-800 mb-8 flex items-center gap-2">
            <i data-lucide="file-text" class="text-blue-600"></i> Tambah Dokumen Baru
        </h1>
        <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Dokumen</label>
                <input type="text" name="title" required class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Kalender Akademik 2026">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Dokumen</label>
                <select name="type" class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                    <option value="pdf">PDF</option>
                    <option value="doc">Word (DOC/DOCX)</option>
                    <option value="xls">Excel (XLS/XLSX)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Pilih File</label>
                <input type="file" name="file" required class="w-full text-sm text-gray-500">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                Upload Dokumen
            </button>
        </form>
    </div>
</div>
@endsection
