@extends('layouts.app')

@section('content')
<section class="relative h-[50vh] overflow-hidden">
    <img src="{{ asset('assets/sekolah.jpg') }}" alt="Gedung Sekolah" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 to-black/30"></div>
    <div class="relative z-10 h-full flex items-end pb-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-black text-white mb-2 uppercase">Profil Sekolah</h1>
            <p class="text-blue-200 text-lg">Mengenal lebih dekat SMP Muhammadiyah Unggulan Ashidiq</p>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-16 items-center">
        <div>
            <h2 class="text-3xl font-black text-blue-900 mb-6">Tentang Kami</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                SMP Muhammadiyah Unggulan Ashidiq adalah lembaga pendidikan Islam yang berkomitmen mencetak generasi unggul. Kami memadukan kurikulum nasional dengan pembinaan karakter Islami yang kuat.
            </p>
            <p class="text-gray-600 leading-relaxed">
                Fokus kami adalah pada pengembangan kemandirian, prestasi akademik, serta penguatan hafalan Al-Qur'an (Tahfidz) sebagai fondasi utama bagi setiap peserta didik.
            </p>
        </div>
        <div class="relative h-80 rounded-2xl overflow-hidden shadow-xl">
            <img src="{{ asset('assets/tentang.jpg') }}" alt="Tentang SMP" class="w-full h-full object-cover">
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12">
            <div class="bg-blue-900 text-white rounded-2xl p-10 shadow-xl">
                <h2 class="text-3xl font-black mb-6">Visi</h2>
                <p class="text-blue-100 text-lg leading-relaxed">
                    Menyiapkan kader Muhammadiyah dan Bangsa yang Berkemajuan, mandiri, berprestasi, serta Berjiwa Qur’ani
                </p>
            </div>
            <div class="bg-white rounded-2xl p-10 shadow-xl border">
                <h2 class="text-3xl font-black text-blue-900 mb-6">Misi</h2>
                <ul class="space-y-4 text-gray-600">
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 shrink-0"></span>
                        Menjalankan Pendidikan yang berorientasi pada kemandirian, kejujuran, kedisiplinan, dan tanggungjawab.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 shrink-0"></span>
                        Meningkatkan Pembelajaran yang bermutu baik akademik maupun non akademik.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 shrink-0"></span>
                        Menumbuhkembangkan Minat dan Bakat Siswa melalui Pembelajaran serta Pendampingan Peserta didik.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 shrink-0"></span>
                        Mewujudkan Peserta Didik Penghafal Al-Qur’an didik yang beriman dan bertakwa kepada Allah Subhanahu Wata’ala.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 shrink-0"></span>
                        Mewujudkan peningkatan pemahaman dan kesadaran akan diri dan situasi yang dihadapi serta regulasi diri melalui program yang terencana dan berkesinambungan.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
