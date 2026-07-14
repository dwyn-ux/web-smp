@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-gray-50 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200">
            <div class="bg-blue-900 text-white p-10 text-center">
                <h1 class="text-3xl font-black mb-2">Alumni Terdaftar</h1>
                <p class="text-blue-100 max-w-2xl mx-auto">Berikut adalah alumni yang telah disetujui dan ditampilkan di halaman utama.</p>
            </div>
            <div class="p-10">
                <div class="mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Total alumni: <span class="font-bold text-gray-900">{{ $alumni->total() }}</span></p>
                    </div>
                    <a href="{{ route('alumni.create') }}" class="inline-flex items-center gap-2 bg-yellow-400 text-blue-900 px-6 py-3 rounded-full font-bold hover:bg-yellow-300 transition text-sm">
                        Isi Pendataan Alumni
                    </a>
                </div>

                @if($alumni->count())
                    <div class="grid gap-6 sm:grid-cols-2">
                        @foreach($alumni as $item)
                            <div class="rounded-3xl overflow-hidden border border-gray-200 shadow-sm bg-white">
                                <img src="{{ $item->photo_url ?: asset('assets/logo smp.png') }}" alt="Foto {{ $item->name }}" class="h-60 w-full object-cover">
                                <div class="p-6">
                                    <h2 class="text-xl font-bold text-blue-900">{{ $item->name }}</h2>
                                    <p class="text-gray-500 mb-2">
                                        {{ $item->class_level }}
                                        @if($item->graduation_year)
                                            <span class="mx-1">|</span> Angkatan {{ $item->graduation_year }}
                                        @endif
                                    </p>
                                    <p class="text-gray-700">Sekolah saat ini: {{ $item->current_school }}</p>
                                    @if($item->current_university)
                                        <p class="text-gray-700 mb-4">Universitas saat ini: {{ $item->current_university }}</p>
                                    @else
                                        <div class="mb-4"></div>
                                    @endif
                                    <p class="text-gray-600 text-sm">{{ Str::limit($item->message, 120) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10">
                        {{ $alumni->links() }}
                    </div>
                @else
                    <div class="rounded-3xl bg-gray-50 border border-gray-200 p-10 text-center">
                        <p class="text-gray-600">Belum ada alumni yang disetujui.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
