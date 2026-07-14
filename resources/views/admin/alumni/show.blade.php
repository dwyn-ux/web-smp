@extends('admin.layout')

@section('content')
<div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
    <div class="flex flex-col md:flex-row gap-8">
        <div class="w-full md:w-1/3 bg-blue-50 rounded-3xl p-6 flex flex-col items-center gap-6 text-center">
            <img src="{{ $alumnus->photo_url ?: asset('assets/logo smp.png') }}" alt="Foto {{ $alumnus->name }}" class="w-full h-72 object-cover rounded-3xl shadow-lg">
            <div>
                <h2 class="text-2xl font-bold text-blue-900">{{ $alumnus->name }}</h2>
                <p class="text-sm text-gray-500">{{ $alumnus->class_level }}</p>
            </div>
        </div>
        <div class="w-full md:w-2/3 space-y-6">
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Status</h3>
                <p class="text-gray-600 uppercase tracking-wide font-semibold">{{ $alumnus->status }}</p>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Tahun Kelulusan</h3>
                <p class="text-gray-600">{{ $alumnus->graduation_year ?: '-' }}</p>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Alamat</h3>
                <p class="text-gray-600">{{ $alumnus->address }}</p>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Sekolah Saat Ini (SMA/SMK/MA)</h3>
                <p class="text-gray-600">{{ $alumnus->current_school }}</p>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Universitas Saat Ini</h3>
                <p class="text-gray-600">{{ $alumnus->current_university ?: '-' }}</p>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Pesan dan Kesan</h3>
                <p class="text-gray-600 whitespace-pre-line">{{ $alumnus->message }}</p>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Saran</h3>
                <p class="text-gray-600 whitespace-pre-line">{{ $alumnus->suggestion }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.alumni.index') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-5 py-3 rounded-full hover:bg-gray-200 transition">Kembali</a>
                <form action="{{ route('admin.alumni.destroy', $alumnus->id) }}" method="POST" onsubmit="return confirm('Hapus data alumni ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 bg-red-600 text-white px-5 py-3 rounded-full hover:bg-red-700 transition">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
