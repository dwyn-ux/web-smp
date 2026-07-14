@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl font-bold text-gray-800">Manajemen Artikel</h2>
    <a href="{{ route('admin.articles.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-xl flex items-center gap-2 hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition">
        <i data-lucide="plus"></i> Tambah Artikel
    </a>
</div>

@if(session('success'))
    <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-5 text-green-700">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left p-6 font-bold text-gray-600">Judul Artikel</th>
                <th class="text-left p-6 font-bold text-gray-600">Tanggal</th>
                <th class="text-left p-6 font-bold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($articles as $article)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-6 font-semibold">{{ $article->title }}</td>
                <td class="p-6 text-gray-500">{{ $article->created_at->format('d/m/Y') }}</td>
                <td class="p-6 flex gap-3">
                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="text-blue-600 hover:text-blue-800 font-bold">Edit</a>
                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
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
