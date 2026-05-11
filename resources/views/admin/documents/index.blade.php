@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl font-bold text-gray-800">Manajemen Dokumentasi</h2>
    <a href="{{ route('admin.documents.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-xl flex items-center gap-2 hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition">
        <i data-lucide="plus"></i> Tambah Dokumen
    </a>
</div>

<div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left p-6 font-bold text-gray-600">Judul Dokumen</th>
                <th class="text-left p-6 font-bold text-gray-600">Tipe</th>
                <th class="text-left p-6 font-bold text-gray-600">Ukuran</th>
                <th class="text-left p-6 font-bold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($documents as $doc)
            <tr>
                <td class="p-6 font-semibold">{{ $doc->title }}</td>
                <td class="p-6 uppercase text-gray-500 font-bold text-xs">{{ $doc->type }}</td>
                <td class="p-6 text-gray-500 text-sm">{{ $doc->size }}</td>
                <td class="p-6">
                    <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
