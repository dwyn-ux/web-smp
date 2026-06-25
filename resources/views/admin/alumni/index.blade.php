@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl font-bold text-gray-800">Pendataan Alumni</h2>
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
                <th class="text-left p-6 font-bold text-gray-600">Nama</th>
                <th class="text-left p-6 font-bold text-gray-600">Kelas SMP</th>
                <th class="text-left p-6 font-bold text-gray-600">Sekolah Sekarang</th>
                <th class="text-left p-6 font-bold text-gray-600">Status</th>
                <th class="text-left p-6 font-bold text-gray-600">Tanggal</th>
                <th class="text-left p-6 font-bold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($alumni as $item)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-6 font-semibold">{{ $item->name }}</td>
                <td class="p-6 text-gray-500">{{ $item->class_level }}</td>
                <td class="p-6 text-gray-500">{{ $item->current_school }}</td>
                <td class="p-6">
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold uppercase {{ $item->status === 'approved' ? 'bg-green-100 text-green-700' : ($item->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="p-6 text-gray-500">{{ $item->created_at->format('d/m/Y') }}</td>
                <td class="p-6 flex gap-3">
                    <a href="{{ route('admin.alumni.show', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-bold">Lihat</a>
                    <a href="{{ route('admin.alumni.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-bold">Edit</a>
                    <form action="{{ route('admin.alumni.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data alumni ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-10 text-center text-gray-400">Belum ada data alumni.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $alumni->links() }}
</div>
@endsection
