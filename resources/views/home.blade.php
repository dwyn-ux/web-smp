@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen w-full overflow-hidden bg-blue-950">
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/80 z-20"></div>
    <div class="absolute inset-0 z-10 opacity-30 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] pointer-events-none"></div>

    <div class="absolute inset-0 w-full h-full">
        <iframe 
            class="absolute inset-0 w-[100vw] h-[56.25vw] min-h-screen min-w-[177.77vh] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none"
            src="https://www.youtube.com/embed/BSo6euWKtpQ?autoplay=1&mute=1&controls=0&loop=1&playlist=BSo6euWKtpQ&showinfo=0&rel=0&modestbranding=1&playsinline=1&vq=hd1080&enablejsapi=1"
            allow="autoplay; encrypted-media"
            loading="lazy">
        </iframe>
    </div>

    <div class="relative z-30 h-full flex flex-col items-center justify-center text-white px-4 text-center">
        <img src="{{ asset($photos['logo']) }}" alt="Logo" class="w-24 h-24 md:w-32 md:h-32 mb-6 drop-shadow-2xl">
        <h1 class="text-3xl md:text-6xl font-black mb-4 tracking-tight drop-shadow-lg uppercase px-2">
            SMP Muhammadiyah Unggulan Ashidiq
        </h1>
        
        <div x-data="{ 
                texts: ['Berkemajuan', 'Mandiri', 'Berprestasi', 'Berjiwa Qur\'ani'],
                current: 0,
                init() { setInterval(() => { this.current = (this.current + 1) % this.texts.length }, 3000) }
             }" 
             class="text-lg md:text-4xl font-light mb-8 min-h-[4rem] flex flex-col md:flex-row items-center justify-center drop-shadow-md px-4">
            <span class="md:mr-2">Mencetak Generasi yang</span>
            <div class="h-8 md:h-12 overflow-hidden relative w-full md:w-auto">
                <template x-for="(text, index) in texts" :key="index">
                    <div x-show="current === index" 
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 transform translate-y-8"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-500"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-8"
                         class="font-bold text-blue-300 absolute inset-0 flex items-center justify-center md:justify-start">
                        <span x-text="text"></span>
                    </div>
                </template>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('profile') }}" class="bg-white text-blue-900 px-8 py-3 font-bold rounded-full hover:bg-blue-50 transition text-sm tracking-wide shadow-xl">TENTANG KAMI</a>
            <a href="https://ponpesashiddiq.or.id" target="_blank" class="border-2 border-white text-white px-8 py-3 font-bold rounded-full hover:bg-white hover:text-blue-900 transition text-sm tracking-wide shadow-xl">DAFTAR SEKARANG</a>
            <a href="{{ route('alumni.index') }}" class="inline-flex items-center gap-2 bg-yellow-400 text-blue-900 px-8 py-3 font-bold rounded-full hover:bg-yellow-300 transition text-sm tracking-wide shadow-xl">ALUMNI</a>
        </div>
    </div>
</section>

<section class="py-24 bg-gradient-to-br from-blue-900 to-slate-900 text-white">
    <div class="container mx-auto px-4 grid gap-10 lg:grid-cols-3 items-start">
        <div class="lg:col-span-2 space-y-6">
            <p class="uppercase tracking-[0.4em] text-sm text-blue-200">SMP Unggulan Ashidiq</p>
            <h2 class="text-4xl md:text-5xl font-black leading-tight">Pendidikan Berprestasi dan Berkarakter dengan Sentuhan Islami.</h2>
            <p class="text-blue-100 text-lg leading-relaxed max-w-3xl">Kami membentuk siswa yang cerdas, berbakti, dan siap bersaing. Dukung generasi unggul melalui kemampuan akademik, akhlak mulia, dan pengalaman ekstra kurikuler yang bermakna.</p>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="rounded-3xl bg-blue-800/70 p-6 border border-white/10 shadow-xl">
                    <h3 class="font-bold text-xl mb-3">Lingkungan 7S</h3>
                    <p class="text-blue-100 leading-relaxed">Senyum, Salam, Sapa, Sopan, Santun, Semangat, Sinergi. Budaya ini membuat sekolah kami ramah dan produktif.</p>
                </div>
                <div class="rounded-3xl bg-blue-800/70 p-6 border border-white/10 shadow-xl">
                    <h3 class="font-bold text-xl mb-3">Prestasi & Alumni</h3>
                    <p class="text-blue-100 leading-relaxed">Lulusan kami melanjutkan ke sekolah unggulan, meraih prestasi akademik dan non-akademik, serta menjadi wakil sekolah di berbagai kompetisi.</p>
                </div>
            </div>
        </div>
        <div class="rounded-3xl bg-white/10 border border-white/10 p-8 shadow-2xl backdrop-blur-lg">
            <h3 class="text-2xl font-bold mb-6">Informasi Utama</h3>
            <ul class="space-y-5 text-blue-100">
                <li class="space-y-2">
                    <p class="font-semibold">Pendaftaran Terbuka</p>
                    <p class="text-sm leading-relaxed text-blue-200">SPMBD 2026 dibuka untuk siswa terbaik dari seluruh daerah dengan kesempatan beasiswa.</p>
                </li>
                <li class="space-y-2">
                    <p class="font-semibold">Fasilitas Lengkap</p>
                    <p class="text-sm leading-relaxed text-blue-200">Laboratorium, perpustakaan, olahraga, dan ruang kreativitas mendukung pembelajaran modern.</p>
                </li>
                <li class="space-y-2">
                    <p class="font-semibold">Pembelajaran Holistik</p>
                    <p class="text-sm leading-relaxed text-blue-200">Kurikulum kami menggabungkan akademik, karakter, dan kemandirian.</p>
                </li>
            </ul>
            <a href="{{ route('profile') }}" class="mt-8 inline-flex items-center justify-center w-full rounded-full bg-yellow-400 text-blue-900 px-6 py-4 font-bold hover:bg-yellow-300 transition">Pelajari Program</a>
        </div>
    </div>
</section>

<!-- Welcome Section -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-blue-600 font-semibold uppercase tracking-widest text-sm mb-4">Selamat Datang</p>
                <h2 class="text-4xl md:text-5xl font-black text-blue-900 mb-6 leading-tight">
                    Membangun Generasi<br>Cerdas & Berakhlak
                </h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-8">
                    SMP Muhammadiyah Unggulan Ashidiq hadir sebagai lembaga pendidikan yang mengintegrasikan nilai-nilai Islam dengan kurikulum nasional. Kami berkomitmen mencetak generasi yang unggul dalam akademik, berkarakter kuat, dan siap menghadapi tantangan global.
                </p>
                <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 border-2 border-blue-900 text-blue-900 px-8 py-3 font-bold hover:bg-blue-900 hover:text-white transition tracking-wide text-sm">
                    PELAJARI LEBIH LANJUT <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <img src="{{ asset($photos['kegiatan_1']) }}" alt="Kegiatan" class="h-48 w-full object-cover rounded-2xl shadow-lg">
                    <img src="{{ asset($photos['kegiatan_2']) }}" alt="Kegiatan" class="h-64 w-full object-cover rounded-2xl shadow-lg">
                </div>
                <div class="space-y-4 mt-8">
                    <img src="{{ asset($photos['kegiatan_3']) }}" alt="Kegiatan" class="h-64 w-full object-cover rounded-2xl shadow-lg">
                    <img src="{{ asset($photos['kegiatan_4']) }}" alt="Kegiatan" class="h-48 w-full object-cover rounded-2xl shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-blue-900">
    <div class="container mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="text-center text-white">
            <i data-lucide="users" class="mx-auto mb-3 w-10 h-10 text-blue-300"></i>
            <div class="text-4xl font-black mb-1">500+</div>
            <div class="text-blue-200 text-sm font-medium uppercase tracking-widest">Siswa Aktif</div>
        </div>
        <div class="text-center text-white">
            <i data-lucide="graduation-cap" class="mx-auto mb-3 w-10 h-10 text-blue-300"></i>
            <div class="text-4xl font-black mb-1">50+</div>
            <div class="text-blue-200 text-sm font-medium uppercase tracking-widest">Tenaga Pendidik</div>
        </div>
        <div class="text-center text-white">
            <i data-lucide="book-open" class="mx-auto mb-3 w-10 h-10 text-blue-300"></i>
            <div class="text-4xl font-black mb-1">20+</div>
            <div class="text-blue-200 text-sm font-medium uppercase tracking-widest">Pengalaman</div>
        </div>
        <div class="text-center text-white">
            <i data-lucide="heart" class="mx-auto mb-3 w-10 h-10 text-blue-300"></i>
            <div class="text-4xl font-black mb-1">100%</div>
            <div class="text-blue-200 text-sm font-medium uppercase tracking-widest">Dedikasi</div>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <p class="text-blue-600 font-semibold uppercase tracking-widest text-sm mb-4">Fakta Sekolah</p>
            <h2 class="text-4xl font-black text-blue-900">Statistik Nyata yang Mendukung Kualitas</h2>
            <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">Kinerja akademik, jumlah alumni sukses, dan fasilitas yang menunjang semua proses belajar mengajar.</p>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            <div class="rounded-3xl bg-white border border-slate-200 p-8 text-center shadow-sm hover:shadow-xl transition">
                <div class="text-6xl font-black text-blue-900 mb-4">97%</div>
                <p class="font-semibold text-xl text-slate-900 mb-2">Kelulusan Tahunan</p>
                <p class="text-gray-500">Sebagian besar siswa berhasil menyelesaikan pendidikan dengan hasil bagus.</p>
            </div>
            <div class="rounded-3xl bg-white border border-slate-200 p-8 text-center shadow-sm hover:shadow-xl transition">
                <div class="text-6xl font-black text-blue-900 mb-4">85%</div>
                <p class="font-semibold text-xl text-slate-900 mb-2">Masuk PTN/SMK Unggul</p>
                <p class="text-gray-500">Lulusan melanjutkan ke perguruan tinggi negeri dan sekolah lanjutan terkemuka.</p>
            </div>
            <div class="rounded-3xl bg-white border border-slate-200 p-8 text-center shadow-sm hover:shadow-xl transition">
                <div class="text-6xl font-black text-blue-900 mb-4">120+</div>
                <p class="font-semibold text-xl text-slate-900 mb-2">Prestasi Nasional & Regional</p>
                <p class="text-gray-500">Penghargaan akademik, olahraga, dan seni yang diraih dari berbagai kompetisi.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <p class="text-blue-600 font-semibold uppercase tracking-widest text-sm mb-4">Penghargaan</p>
            <h2 class="text-4xl font-black text-blue-900">Prestasi dan Penghargaan Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">Beberapa pencapaian yang menunjukkan kualitas pembelajaran dan daya saing siswa.</p>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            <div class="rounded-3xl bg-blue-900 text-white p-8 shadow-2xl">
                <h3 class="text-xl font-bold mb-3">Peringkat 1 LTMPT</h3>
                <p class="leading-relaxed">SMP Unggulan Ashidiq terus menunjukkan hasil terbaik di berbagai seleksi masuk perguruan tinggi.</p>
            </div>
            <div class="rounded-3xl bg-blue-800 text-white p-8 shadow-2xl">
                <h3 class="text-xl font-bold mb-3">Rekor MURI</h3>
                <p class="leading-relaxed">Pencapaian rekor prestasi untuk kategori siswa berprestasi dan partisipasi lomba nasional.</p>
            </div>
            <div class="rounded-3xl bg-blue-700 text-white p-8 shadow-2xl">
                <h3 class="text-xl font-bold mb-3">Medali OSN & Kompetisi</h3>
                <p class="leading-relaxed">Siswa kami meraih medali dan juara dalam Olimpiade Sains dan kompetisi akademik lainnya.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <p class="text-blue-600 font-semibold uppercase tracking-widest text-sm mb-4">Fasilitas Sekolah</p>
            <h2 class="text-4xl font-black text-blue-900">Galeri Fasilitas Unggulan</h2>
            <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">Ruang kelas modern, laboratorium lengkap, dan area ekspresi siswa yang mendukung proses belajar.</p>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            @forelse($facilities as $facility)
            <div class="rounded-3xl overflow-hidden shadow-lg">
                <img src="{{ $facility->image_url ?? asset('assets/logo smp.png') }}" alt="{{ $facility->title }}" class="h-72 w-full object-cover">
                <div class="p-6 bg-white">
                    <h3 class="text-xl font-bold text-blue-900 mb-2">{{ $facility->title }}</h3>
                    <p class="text-gray-600">{{ $facility->description }}</p>
                </div>
            </div>
            @empty
            <div class="md:col-span-3 text-center py-16 text-gray-400">
                <p>Belum ada data fasilitas.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@if(isset($alumni) && $alumni->count())
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-12">
            <div>
                <p class="text-blue-600 font-semibold uppercase tracking-widest text-sm mb-4">Alumni Terpilih</p>
                <h2 class="text-4xl font-black text-blue-900">Cerita dan Prestasi Alumni</h2>
            </div>
            <a href="{{ route('alumni.index') }}" class="inline-flex items-center gap-2 border-2 border-blue-900 text-blue-900 px-6 py-3 font-bold rounded-full hover:bg-blue-900 hover:text-white transition text-sm">
                Alumni
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:gap-6 lg:grid-cols-3 lg:gap-8">
            @foreach($alumni as $alumnus)
            <button type="button"
                class="home-alumni-card group relative block w-full overflow-hidden rounded-3xl bg-gray-200 text-left shadow-lg ring-1 ring-black/5 transition duration-300 hover:-translate-y-1.5 hover:shadow-2xl focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-400"
                data-name="{{ $alumnus->name }}"
                data-class="{{ $alumnus->class_level }}"
                data-year="{{ $alumnus->graduation_year }}"
                data-school="{{ $alumnus->current_school }}"
                data-university="{{ $alumnus->current_university }}"
                data-photo="{{ $alumnus->photo_url ?: asset('assets/logo smp.png') }}"
                data-message="{{ $alumnus->message }}">
                <div class="relative aspect-[3/4] w-full overflow-hidden">
                    <img src="{{ $alumnus->photo_url ?: asset('assets/logo smp.png') }}" alt="Foto {{ $alumnus->name }}" loading="lazy" class="h-full w-full object-cover object-top transition duration-700 ease-out group-hover:scale-105">
                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(15,23,70,.92) 0%, rgba(15,23,70,.55) 32%, rgba(15,23,70,0) 62%);"></div>
                    @if($alumnus->graduation_year)
                        <span class="absolute left-3 top-3 rounded-full bg-yellow-400 px-3 py-1 text-xs font-bold text-blue-900 shadow">Angkatan {{ $alumnus->graduation_year }}</span>
                    @endif
                    <div class="absolute inset-x-0 bottom-0 p-4 text-white">
                        <h3 class="text-base font-extrabold leading-snug sm:text-lg" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $alumnus->name }}</h3>
                        <div class="mt-1.5 flex items-center gap-1.5 text-xs text-blue-100 sm:text-sm">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                            <span class="truncate">{{ $alumnus->current_school }}</span>
                        </div>
                    </div>
                </div>
            </button>
            @endforeach
        </div>
    </div>
</section>

{{-- Pop up detail alumni --}}
<div id="home-alumni-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6" role="dialog" aria-modal="true" aria-labelledby="home-alumni-name">
    <div id="home-alumni-backdrop" class="absolute inset-0 bg-slate-900/70 backdrop-blur-sm"></div>
    <div class="relative flex max-h-[90vh] w-full max-w-4xl flex-col overflow-hidden rounded-3xl bg-white shadow-2xl md:flex-row">
        <button type="button" id="home-alumni-close" class="absolute right-3 top-3 z-20 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-gray-700 shadow-lg transition hover:bg-white hover:text-blue-900" aria-label="Tutup">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
        <div class="relative flex shrink-0 items-center justify-center overflow-hidden bg-blue-950 p-5 md:w-5/12 md:p-8">
            <img id="home-alumni-photo-bg" src="" alt="" aria-hidden="true" class="absolute inset-0 h-full w-full scale-125 object-cover opacity-50 blur-2xl">
            <img id="home-alumni-photo" src="" alt="" class="relative max-h-[38vh] w-auto max-w-full rounded-2xl object-contain shadow-2xl ring-1 ring-white/20 md:max-h-[75vh]">
        </div>
        <div class="min-w-0 flex-1 overflow-y-auto p-6 md:p-8">
            <div id="home-alumni-badges" class="mb-3 flex flex-wrap gap-2 pr-10"></div>
            <h2 id="home-alumni-name" class="text-2xl font-extrabold leading-tight text-blue-900 md:text-3xl"></h2>
            <div class="mt-3 h-1 w-14 rounded-full bg-yellow-400"></div>
            <div class="mt-5 space-y-3">
                <div id="home-alumni-school-wrap">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Sekolah saat ini</p>
                    <p id="home-alumni-school" class="font-semibold text-gray-800"></p>
                </div>
                <div id="home-alumni-university-wrap">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Universitas saat ini</p>
                    <p id="home-alumni-university" class="font-semibold text-gray-800"></p>
                </div>
            </div>
            <div id="home-alumni-message-wrap" class="mt-6 rounded-2xl bg-blue-50 p-5">
                <p class="mb-2 text-sm font-bold text-blue-900">Kesan &amp; pesan</p>
                <p id="home-alumni-message" class="break-words whitespace-pre-line text-sm leading-relaxed text-gray-700"></p>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        var modal = document.getElementById('home-alumni-modal');
        if (!modal) return;
        var photo = document.getElementById('home-alumni-photo');
        var photoBg = document.getElementById('home-alumni-photo-bg');
        var nameEl = document.getElementById('home-alumni-name');
        var badgesEl = document.getElementById('home-alumni-badges');
        var schoolWrap = document.getElementById('home-alumni-school-wrap');
        var schoolEl = document.getElementById('home-alumni-school');
        var uniWrap = document.getElementById('home-alumni-university-wrap');
        var uniEl = document.getElementById('home-alumni-university');
        var msgWrap = document.getElementById('home-alumni-message-wrap');
        var msgEl = document.getElementById('home-alumni-message');
        var closeBtn = document.getElementById('home-alumni-close');
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

        document.querySelectorAll('.home-alumni-card').forEach(function (card) {
            card.addEventListener('click', function () { openModal(card); });
        });
        closeBtn.addEventListener('click', closeModal);
        document.getElementById('home-alumni-backdrop').addEventListener('click', closeModal);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });
    })();
</script>
@endif

<!-- Keunggulan Section -->
<section class="py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <p class="text-blue-600 font-semibold uppercase tracking-widest text-sm mb-4">Program Unggulan</p>
            <h2 class="text-4xl font-black text-blue-900">Keunggulan Kami</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @php
                $programs = [
                    ['title' => 'Tahfidz Al-Quran', 'desc' => 'Program hafalan Al-Quran dengan metode terstruktur dan bimbingan berpengalaman.', 'img' => $photos['program_tahfidz']],
                    ['title' => 'Akademik Unggul', 'desc' => 'Kurikulum nasional diperkaya muatan Islami mencetak generasi cerdas beriman.', 'img' => $photos['program_akademik']],
                    ['title' => 'Ekstrakurikuler', 'desc' => 'Beragam kegiatan dari olahraga hingga teknologi untuk mengembangkan bakat.', 'img' => $photos['program_ekskul']],
                ];
            @endphp
            @foreach($programs as $p)
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 group">
                <div class="h-56 overflow-hidden">
                    <img src="{{ asset($p['img']) }}" alt="{{ $p['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold text-blue-900 mb-3">{{ $p['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $p['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Latest Articles -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid gap-12 lg:grid-cols-2 lg:items-end">
            <div>
                <p class="text-blue-600 font-semibold uppercase tracking-widest text-sm mb-4">Artikel & Berita</p>
                <h2 class="text-4xl font-black text-blue-900">Berita Terbaru dan Prestasi Sekolah</h2>
                <p class="text-gray-600 text-lg max-w-2xl leading-relaxed">Ikuti perkembangan kegiatan, prestasi siswa, dan pengumuman penting dari SMP Muhammadiyah Unggulan Ashidiq.</p>
            </div>
            <div class="flex flex-wrap gap-3 justify-start lg:justify-end">
                <a href="{{ route('artikel.index') }}" class="inline-flex items-center gap-2 border-2 border-blue-900 text-blue-900 px-6 py-3 rounded-full font-bold hover:bg-blue-900 hover:text-white transition">Lihat Semua Berita</a>
                <a href="{{ route('alumni.create') }}" class="inline-flex items-center gap-2 bg-yellow-400 text-blue-900 px-6 py-3 rounded-full font-bold hover:bg-yellow-300 transition">Isi Data Alumni</a>
            </div>
        </div>

        <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($articles as $article)
            <article class="group rounded-3xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl transition">
                <div class="h-56 overflow-hidden">
                    <img src="{{ $article->image_url ?? asset('assets/logo smp.png') }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                </div>
                <div class="p-6">
                    <p class="text-sm text-blue-600 uppercase tracking-widest mb-3">{{ $article->created_at->translatedFormat('d F Y') }}</p>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $article->title }}</h3>
                    <a href="{{ route('artikel.show', $article->slug) }}" class="text-blue-600 font-semibold hover:text-blue-800">Baca Selengkapnya &rarr;</a>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-16 text-gray-400">
                <p>Belum ada artikel yang dipublikasikan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-24 bg-slate-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-blue-600 font-semibold uppercase tracking-widest text-sm mb-4">Lokasi Kami</p>
            <h2 class="text-4xl font-black text-blue-900">Kunjungi Sekolah Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed mt-3">{{ $address ?? 'SMP Muhammadiyah Unggulan Ashidiq' }}</p>
        </div>
        <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
            <iframe src="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}&z=17&output=embed" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="text-center mt-6">
            <a href="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}" target="_blank"
                class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 transition shadow-lg">
                <i data-lucide="map-pin" class="w-5 h-5"></i> Buka di Google Maps
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-gradient-to-br from-blue-600 to-blue-800 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <img src="{{ asset($photos['logo']) }}" alt="bg" class="w-full h-full object-contain scale-150 rotate-12">
    </div>
    <div class="container mx-auto px-4 text-center relative z-10">
        <h2 class="text-4xl md:text-5xl font-black mb-6">Siap Bergabung?</h2>
        <p class="text-xl text-blue-100 max-w-2xl mx-auto mb-10">
            Daftarkan putra-putri Anda di SMP Muhammadiyah Unggulan Ashidiq dan wujudkan masa depan cerah bersama kami.
        </p>
        <a href="https://ponpesashiddiq.or.id" target="_blank" class="inline-flex items-center gap-2 bg-white text-blue-700 px-10 py-4 rounded-full font-black text-lg hover:bg-blue-50 transition shadow-2xl">
            DAFTAR SEKARANG <i data-lucide="chevron-right" class="w-6 h-6"></i>
        </a>
    </div>
</section>
@endsection
