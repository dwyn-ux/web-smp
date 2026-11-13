@extends('layouts.app')

@section('content')
<style>
    .alumni-card { animation: alumniRise .55s cubic-bezier(.2,.7,.2,1) backwards; }
    .alumni-shade { position: absolute; inset: 0; background: linear-gradient(to top, rgba(15,23,70,.92) 0%, rgba(15,23,70,.55) 32%, rgba(15,23,70,0) 62%); }
    .alumni-clamp { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .alumni-backdrop { animation: alumniFade .25s ease; }
    .alumni-dialog { animation: alumniPop .35s cubic-bezier(.2,.8,.2,1); }
    @keyframes alumniRise { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes alumniFade { from { opacity: 0; } to { opacity: 1; } }
    @keyframes alumniPop { from { opacity: 0; transform: translateY(16px) scale(.96); } to { opacity: 1; transform: translateY(0) scale(1); } }
    @media (prefers-reduced-motion: reduce) {
        .alumni-card, .alumni-backdrop, .alumni-dialog { animation: none; }
    }
</style>

<section class="min-h-screen bg-gray-50 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200">
            <div class="bg-blue-900 text-white p-10 text-center">
                <h1 class="text-3xl font-black mb-2">Alumni Terdaftar</h1>
                <p class="text-blue-100 max-w-2xl mx-auto">Berikut adalah alumni yang telah disetujui dan ditampilkan di halaman utama.</p>
            </div>
            <div class="p-6 sm:p-10">
                <div class="mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Total alumni: <span class="font-bold text-gray-900">{{ $alumni->total() }}</span></p>
                    </div>
                    <a href="{{ route('alumni.create') }}" class="inline-flex items-center gap-2 bg-yellow-400 text-blue-900 px-6 py-3 rounded-full font-bold hover:bg-yellow-300 transition text-sm">
                        Isi Pendataan Alumni
                    </a>
                </div>

                @if($alumni->count())
                    <div class="grid grid-cols-2 gap-4 sm:gap-5 lg:grid-cols-3">
                        @foreach($alumni as $item)
                            <button type="button"
                                style="animation-delay: {{ $loop->index * 60 }}ms"
                                class="alumni-card group relative block w-full overflow-hidden rounded-3xl bg-gray-200 text-left shadow-md ring-1 ring-black/5 transition duration-300 hover:-translate-y-1.5 hover:shadow-2xl focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-400"
                                data-name="{{ $item->name }}"
                                data-class="{{ $item->class_level }}"
                                data-year="{{ $item->graduation_year }}"
                                data-school="{{ $item->current_school }}"
                                data-university="{{ $item->current_university }}"
                                data-photo="{{ $item->photo_url ?: asset('assets/logo smp.png') }}"
                                data-message="{{ $item->message }}">
                                <div class="relative aspect-[3/4] w-full overflow-hidden">
                                    <img src="{{ $item->photo_url ?: asset('assets/logo smp.png') }}" alt="Foto {{ $item->name }}" loading="lazy" class="h-full w-full object-cover object-top transition duration-700 ease-out group-hover:scale-105">
                                    <div class="alumni-shade"></div>

                                    @if($item->graduation_year)
                                        <span class="absolute left-3 top-3 rounded-full bg-yellow-400 px-3 py-1 text-xs font-bold text-blue-900 shadow">Angkatan {{ $item->graduation_year }}</span>
                                    @endif

                                    <div class="absolute inset-x-0 bottom-0 p-4 text-white">
                                        <h2 class="alumni-clamp text-base font-extrabold leading-snug sm:text-lg">{{ $item->name }}</h2>
                                        <div class="mt-1.5 flex items-center gap-1.5 text-xs text-blue-100 sm:text-sm">
                                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                            <span class="truncate">{{ $item->current_school }}</span>
                                        </div>
                                    </div>
                                </div>
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
<div id="alumni-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6" role="dialog" aria-modal="true" aria-labelledby="alumni-modal-name">
    <div id="alumni-modal-backdrop" class="alumni-backdrop absolute inset-0 bg-slate-900/70 backdrop-blur-sm"></div>

    <div class="alumni-dialog relative flex max-h-[90vh] w-full max-w-4xl flex-col overflow-hidden rounded-3xl bg-white shadow-2xl md:flex-row">
        <button type="button" id="alumni-modal-close" class="absolute right-3 top-3 z-20 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-gray-700 shadow-lg transition hover:bg-white hover:text-blue-900 hover:rotate-90" aria-label="Tutup">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/></svg>
        </button>

        {{-- Foto --}}
        <div class="relative flex shrink-0 items-center justify-center overflow-hidden bg-blue-950 p-5 md:w-5/12 md:p-8">
            <img id="alumni-modal-photo-bg" src="" alt="" aria-hidden="true" class="absolute inset-0 h-full w-full scale-125 object-cover opacity-50 blur-2xl">
            <img id="alumni-modal-photo" src="" alt="" class="relative max-h-[38vh] w-auto max-w-full rounded-2xl object-contain shadow-2xl ring-1 ring-white/20 md:max-h-[75vh]">
        </div>

        {{-- Detail --}}
        <div class="min-w-0 flex-1 overflow-y-auto p-6 md:p-8">
            <div id="alumni-modal-badges" class="mb-3 flex flex-wrap gap-2 pr-10"></div>
            <h2 id="alumni-modal-name" class="text-2xl font-extrabold leading-tight text-blue-900 md:text-3xl"></h2>
            <div class="mt-3 h-1 w-14 rounded-full bg-yellow-400"></div>

            <div class="mt-5 space-y-3">
                <div id="alumni-modal-school-wrap" class="flex items-start gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-900">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    </span>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Sekolah saat ini</p>
                        <p id="alumni-modal-school" class="font-semibold text-gray-800"></p>
                    </div>
                </div>
                <div id="alumni-modal-university-wrap" class="flex items-start gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-yellow-50 text-yellow-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </span>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Universitas saat ini</p>
                        <p id="alumni-modal-university" class="font-semibold text-gray-800"></p>
                    </div>
                </div>
            </div>

            <div id="alumni-modal-message-wrap" class="relative mt-6 rounded-2xl bg-blue-50 p-5 pt-7">
                <span class="absolute -top-3 left-4 flex h-8 w-8 items-center justify-center rounded-full bg-blue-900 text-xl font-black leading-none text-yellow-300" aria-hidden="true">&ldquo;</span>
                <p class="mb-2 text-sm font-bold text-blue-900">Kesan &amp; pesan</p>
                <p id="alumni-modal-message" class="break-words whitespace-pre-line text-sm leading-relaxed text-gray-700"></p>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        var modal = document.getElementById('alumni-modal');
        if (!modal) return;

        var photo = document.getElementById('alumni-modal-photo');
        var photoBg = document.getElementById('alumni-modal-photo-bg');
        var nameEl = document.getElementById('alumni-modal-name');
        var badgesEl = document.getElementById('alumni-modal-badges');
        var schoolWrap = document.getElementById('alumni-modal-school-wrap');
        var schoolEl = document.getElementById('alumni-modal-school');
        var uniWrap = document.getElementById('alumni-modal-university-wrap');
        var uniEl = document.getElementById('alumni-modal-university');
        var msgWrap = document.getElementById('alumni-modal-message-wrap');
        var msgEl = document.getElementById('alumni-modal-message');
        var closeBtn = document.getElementById('alumni-modal-close');
        var lastFocus = null;

        function addBadge(text, cls) {
            var span = document.createElement('span');
            span.className = 'rounded-full px-3 py-1 text-xs font-bold ' + cls;
            span.textContent = text;
            badgesEl.appendChild(span);
        }

        function openModal(card) {
            var d = card.dataset;
            lastFocus = card;

            photo.src = d.photo;
            photo.alt = 'Foto ' + d.name;
            photoBg.src = d.photo;
            nameEl.textContent = d.name;

            badgesEl.innerHTML = '';
            if (d.year) addBadge('Angkatan ' + d.year, 'bg-yellow-400 text-blue-900');
            if (d['class']) addBadge('Kelas ' + d['class'], 'bg-blue-100 text-blue-900');

            schoolEl.textContent = d.school || '';
            schoolWrap.classList.toggle('hidden', !d.school);

            uniEl.textContent = d.university || '';
            uniWrap.classList.toggle('hidden', !d.university);

            if (d.message) {
                msgEl.textContent = d.message;
                msgWrap.classList.remove('hidden');
            } else {
                msgWrap.classList.add('hidden');
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            closeBtn.focus();
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
            photo.src = '';
            photoBg.src = '';
            if (lastFocus) lastFocus.focus();
        }

        document.querySelectorAll('.alumni-card').forEach(function (card) {
            card.addEventListener('click', function () { openModal(card); });
        });

        closeBtn.addEventListener('click', closeModal);
        document.getElementById('alumni-modal-backdrop').addEventListener('click', closeModal);
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });
    })();
</script>
@endsection
