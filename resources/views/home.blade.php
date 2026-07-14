@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen w-full overflow-hidden bg-blue-950">
    <!-- Video Overlay for Cinematic Feel -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/80 z-20"></div>
    <div class="absolute inset-0 z-10 opacity-30 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] pointer-events-none"></div>

    <!-- YouTube Video Background -->
    <div class="absolute inset-0 w-full h-full">
        <iframe 
            class="absolute inset-0 w-[100vw] h-[56.25vw] min-h-screen min-w-[177.77vh] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none"
            src="https://www.youtube.com/embed/BSo6euWKtpQ?autoplay=1&mute=1&controls=0&loop=1&playlist=BSo6euWKtpQ&showinfo=0&rel=0&modestbranding=1&playsinline=1&vq=hd1080&enablejsapi=1"
            allow="autoplay; encrypted-media"
            loading="lazy">
        </iframe>
    </div>

    <div class="relative z-30 h-full flex flex-col items-center justify-center text-white px-4 text-center">
        <img src="{{ asset('assets/logo smp.png') }}" alt="Logo" class="w-24 h-24 md:w-32 md:h-32 mb-6 drop-shadow-2xl">
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
                    <img src="{{ asset('assets/kegiatan-1.jpg') }}" alt="Kegiatan" class="h-48 w-full object-cover rounded-2xl shadow-lg">
                    <img src="{{ asset('assets/kegiatan-2.jpg') }}" alt="Kegiatan" class="h-64 w-full object-cover rounded-2xl shadow-lg">
                </div>
                <div class="space-y-4 mt-8">
                    <img src="{{ asset('assets/kegiatan-3.jpg') }}" alt="Kegiatan" class="h-64 w-full object-cover rounded-2xl shadow-lg">
                    <img src="{{ asset('assets/kegiatan-4.jpg') }}" alt="Kegiatan" class="h-48 w-full object-cover rounded-2xl shadow-lg">
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
            <div class="rounded-3xl overflow-hidden shadow-lg">
                <img src="{{ asset('assets/kegiatan-1.jpg') }}" alt="Fasilitas Laboratorium" class="h-72 w-full object-cover">
                <div class="p-6 bg-white">
                    <h3 class="text-xl font-bold text-blue-900 mb-2">Laboratorium Modern</h3>
                    <p class="text-gray-600">Fasilitas yang lengkap untuk praktik sains dan teknologi.</p>
                </div>
            </div>
            <div class="rounded-3xl overflow-hidden shadow-lg">
                <img src="{{ asset('assets/kegiatan-2.jpg') }}" alt="Fasilitas Perpustakaan" class="h-72 w-full object-cover">
                <div class="p-6 bg-white">
                    <h3 class="text-xl font-bold text-blue-900 mb-2">Perpustakaan Nyaman</h3>
                    <p class="text-gray-600">Ruang belajar tenang dengan koleksi buku dan referensi lengkap.</p>
                </div>
            </div>
            <div class="rounded-3xl overflow-hidden shadow-lg">
                <img src="{{ asset('assets/kegiatan-3.jpg') }}" alt="Fasilitas Olahraga" class="h-72 w-full object-cover">
                <div class="p-6 bg-white">
                    <h3 class="text-xl font-bold text-blue-900 mb-2">Lapangan & Ekstrakurikuler</h3>
                    <p class="text-gray-600">Area olahraga dan kegiatan kreatif untuk siswa aktif.</p>
                </div>
            </div>
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

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($alumni as $alumnus)
            <div class="bg-gray-50 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-72 overflow-hidden">
                    <img src="{{ $alumnus->photo_url ?: asset('assets/logo smp.png') }}" alt="Foto {{ $alumnus->name }}" class="w-full h-full object-cover">
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-blue-900 mb-2">{{ $alumnus->name }}</h3>
                    <p class="text-sm text-gray-500 uppercase tracking-widest mb-4">
                        {{ $alumnus->class_level }}
                        @if($alumnus->graduation_year)
                            | Angkatan {{ $alumnus->graduation_year }}
                        @endif
                        | {{ $alumnus->current_university ?: $alumnus->current_school }}
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-4">{{ Str::limit($alumnus->message, 140) }}</p>
                    <p class="text-sm text-gray-500"><span class="font-semibold">Kesan:</span> {{ Str::limit($alumnus->message, 80) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
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
                    ['title' => 'Tahfidz Al-Quran', 'desc' => 'Program hafalan Al-Quran dengan metode terstruktur dan bimbingan berpengalaman.', 'img' => 'assets/program-tahfidz.jpg'],
                    ['title' => 'Akademik Unggul', 'desc' => 'Kurikulum nasional diperkaya muatan Islami mencetak generasi cerdas beriman.', 'img' => 'assets/program-akademik.jpg'],
                    ['title' => 'Ekstrakurikuler', 'desc' => 'Beragam kegiatan dari olahraga hingga teknologi untuk mengembangkan bakat.', 'img' => 'assets/program-ekskul.jpg'],
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
        <img src="{{ asset('assets/logo smp.png') }}" alt="bg" class="w-full h-full object-contain scale-150 rotate-12">
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
