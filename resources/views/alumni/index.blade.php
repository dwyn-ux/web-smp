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
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($alumni as $item)
                            <button type="button"
                                class="alumni-card h-32 w-full text-left rounded-2xl border border-gray-200 bg-white p-5 shadow-sm hover:shadow-md hover:border-blue-300 transition focus:outline-none focus:ring-2 focus:ring-blue-400"
                                data-name="{{ $item->name }}"
                                data-class="{{ $item->class_level }}"
                                data-year="{{ $item->graduation_year }}"
                                data-school="{{ $item->current_school }}"
                                data-university="{{ $item->current_university }}"
                                data-photo="{{ $item->photo_url ?: asset('assets/logo smp.png') }}"
                                data-message="{{ $item->message }}">
                                <h2 class="text-lg font-bold text-blue-900 truncate">{{ $item->name }}</h2>
                                <p class="text-sm text-gray-500 mt-1 truncate">
                                    @if($item->graduation_year)
                                        Angkatan {{ $item->graduation_year }}
                                    @else
                                        {{ $item->class_level }}
                                    @endif
                                </p>
                                <p class="text-sm text-gray-700 mt-2 truncate">Sekolah saat ini: {{ $item->current_school }}</p>
                            </button>
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

{{-- Pop up detail alumni --}}
<div id="alumni-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/70 p-4" role="dialog" aria-modal="true" aria-labelledby="alumni-modal-name">
    <div class="relative w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-3xl bg-white shadow-2xl">
        <button type="button" id="alumni-modal-close" class="absolute right-3 top-3 z-10 flex h-9 w-9 items-center justify-center rounded-full bg-white/90 text-xl font-bold text-gray-700 shadow hover:bg-white" aria-label="Tutup">&times;</button>
        <div class="bg-gray-100 rounded-t-3xl">
            <img id="alumni-modal-photo" src="" alt="" class="mx-auto block max-h-[60vh] w-full object-contain">
        </div>
        <div class="p-6">
            <h2 id="alumni-modal-name" class="text-xl font-bold text-blue-900"></h2>
            <p id="alumni-modal-meta" class="text-gray-500 mb-2"></p>
            <p id="alumni-modal-school" class="text-gray-700"></p>
            <p id="alumni-modal-university" class="text-gray-700"></p>
            <div id="alumni-modal-message-wrap" class="mt-4">
                <p class="text-sm font-semibold text-gray-900 mb-1">Kesan &amp; pesan</p>
                <p id="alumni-modal-message" class="break-words whitespace-pre-line text-gray-600 text-sm"></p>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        var modal = document.getElementById('alumni-modal');
        if (!modal) return;

        var photo = document.getElementById('alumni-modal-photo');
        var nameEl = document.getElementById('alumni-modal-name');
        var metaEl = document.getElementById('alumni-modal-meta');
        var schoolEl = document.getElementById('alumni-modal-school');
        var uniEl = document.getElementById('alumni-modal-university');
        var msgWrap = document.getElementById('alumni-modal-message-wrap');
        var msgEl = document.getElementById('alumni-modal-message');

        function openModal(card) {
            var d = card.dataset;
            photo.src = d.photo;
            photo.alt = 'Foto ' + d.name;
            nameEl.textContent = d.name;

            var meta = [];
            if (d['class']) meta.push(d['class']);
            if (d.year) meta.push('Angkatan ' + d.year);
            metaEl.textContent = meta.join('  |  ');

            schoolEl.textContent = d.school ? 'Sekolah saat ini: ' + d.school : '';
            uniEl.textContent = d.university ? 'Universitas saat ini: ' + d.university : '';

            if (d.message) {
                msgEl.textContent = d.message;
                msgWrap.classList.remove('hidden');
            } else {
                msgWrap.classList.add('hidden');
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
            photo.src = '';
        }

        document.querySelectorAll('.alumni-card').forEach(function (card) {
            card.addEventListener('click', function () { openModal(card); });
        });

        document.getElementById('alumni-modal-close').addEventListener('click', closeModal);
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });
    })();
</script>
@endsection
