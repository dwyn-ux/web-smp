@extends('admin.layout')

@section('content')
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Pendataan Alumni</h2>
        @if($selectedYear)
            <p class="text-sm text-gray-500 mt-1">Menampilkan alumni angkatan {{ $selectedYear }}.</p>
        @endif
    </div>
    <a href="{{ route('admin.alumni.export', request()->filled('graduation_year') ? ['graduation_year' => request('graduation_year')] : []) }}" class="bg-green-600 text-white px-6 py-2 rounded-xl flex items-center gap-2 hover:bg-green-700 font-bold shadow-lg shadow-green-200 transition text-sm">
        <i data-lucide="download"></i> Export CSV
    </a>
</div>

@if(session('success'))
    <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-5 text-green-700">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 p-5 text-red-700">
        <ul class="list-disc pl-5 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_380px] mb-8">
    <form action="{{ route('admin.alumni.index') }}" method="GET" class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Filter Angkatan Kelulusan</label>
        <div class="flex flex-col sm:flex-row gap-3">
            <select name="graduation_year" class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-100 outline-none bg-white">
                <option value="">Semua angkatan</option>
                @foreach($graduationYears as $year)
                    <option value="{{ $year->year }}" {{ (string) $selectedYear === (string) $year->year ? 'selected' : '' }}>Angkatan {{ $year->year }}</option>
                @endforeach
            </select>
            <button type="submit" class="inline-flex items-center justify-center gap-2 bg-blue-900 text-white rounded-2xl px-5 py-3 font-bold hover:bg-blue-800 transition">
                <i data-lucide="filter" class="w-4 h-4"></i> Filter
            </button>
            @if($selectedYear)
                <a href="{{ route('admin.alumni.index') }}" class="inline-flex items-center justify-center rounded-2xl px-5 py-3 font-bold bg-gray-100 text-gray-700 hover:bg-gray-200 transition">Reset</a>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Kelola Tahun Kelulusan</h3>
        <form action="{{ route('admin.alumni.graduation-years.store') }}" method="POST" class="flex gap-3 mb-4">
            @csrf
            <input type="number" name="year" value="{{ old('year') }}" min="1900" max="2100" class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-100 outline-none" placeholder="Contoh: 2026">
            <button type="submit" class="inline-flex items-center justify-center bg-blue-900 text-white rounded-2xl px-4 py-3 font-bold hover:bg-blue-800 transition">
                <i data-lucide="plus" class="w-5 h-5"></i>
            </button>
        </form>
        <div class="flex flex-wrap gap-2">
            @forelse($graduationYears as $year)
                <form action="{{ route('admin.alumni.graduation-years.destroy', $year->id) }}" method="POST" onsubmit="return confirm('Hapus tahun kelulusan ini dari dropdown?')" class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-2">
                    @csrf
                    @method('DELETE')
                    <span class="text-sm font-semibold text-gray-700">{{ $year->year }}</span>
                    <button type="submit" class="text-red-600 hover:text-red-800" aria-label="Hapus tahun kelulusan {{ $year->year }}">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </form>
            @empty
                <p class="text-sm text-gray-500">Belum ada tahun kelulusan untuk dropdown.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[980px]">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left p-6 font-bold text-gray-600">Nama</th>
                    <th class="text-left p-6 font-bold text-gray-600">Angkatan</th>
                    <th class="text-left p-6 font-bold text-gray-600">Kelas SMP</th>
                    <th class="text-left p-6 font-bold text-gray-600">Sekolah / Universitas</th>
                    <th class="text-left p-6 font-bold text-gray-600">Status</th>
                    <th class="text-left p-6 font-bold text-gray-600">Tanggal</th>
                    <th class="text-left p-6 font-bold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($alumni as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-6 font-semibold">{{ $item->name }}</td>
                    <td class="p-6 text-gray-500">{{ $item->graduation_year ?: '-' }}</td>
                    <td class="p-6 text-gray-500">{{ $item->class_level }}</td>
                    <td class="p-6 text-gray-500">
                        <div>{{ $item->current_school }}</div>
                        @if($item->current_university)
                            <div class="text-sm text-gray-400">{{ $item->current_university }}</div>
                        @endif
                    </td>
                    <td class="p-6">
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold uppercase {{ $item->status === 'approved' ? 'bg-green-100 text-green-700' : ($item->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="p-6 text-gray-500">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td class="p-6 flex flex-col gap-2">
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.alumni.show', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-bold">Lihat</a>
                            <a href="{{ route('admin.alumni.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-bold">Edit</a>
                        </div>
                        @if($item->status === 'pending')
                            <form action="{{ route('admin.alumni.approve', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-800 font-bold">Terima & Tampilkan</button>
                            </form>
                        @elseif($item->status === 'approved')
                            <form action="{{ route('admin.alumni.toggleVisibility', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-indigo-600 hover:text-indigo-800 font-bold">
                                    {{ $item->show_on_homepage ? 'Sembunyikan' : 'Tampilkan' }}
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.alumni.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data alumni ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-10 text-center text-gray-400">Belum ada data alumni.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $alumni->links() }}
</div>
@endsection
