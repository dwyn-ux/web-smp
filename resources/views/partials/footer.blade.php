<footer class="bg-blue-900 text-white py-16">
    <div class="container mx-auto px-4 grid md:grid-cols-3 gap-12">
        <div>
            <div class="flex items-center gap-3 mb-4">
                <img src="{{ asset('assets/logo smp.png') }}" alt="Logo" class="w-12 h-12 brightness-200">
                <span class="font-bold text-xl uppercase">SMP Muhammadiyah Unggulan Ashidiq</span>
            </div>
            <p class="text-blue-200 text-sm leading-relaxed">
                Mencetak generasi unggul berakhlak mulia, cerdas, dan berwawasan global.
            </p>
        </div>
        <div>
            <h3 class="font-bold text-lg mb-4">Menu Utama</h3>
            <ul class="space-y-2 text-blue-200 text-sm">
                <li><a href="{{ route('profile') }}" class="hover:text-white transition">Profil Sekolah</a></li>
                <li><a href="{{ route('artikel.index') }}" class="hover:text-white transition">Berita & Artikel</a></li>
                <li><a href="{{ route('galeri.index') }}" class="hover:text-white transition">Galeri Foto</a></li>
                <li><a href="{{ route('dokumentasi.index') }}" class="hover:text-white transition">Dokumentasi</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-bold text-lg mb-4">Hubungi Kami</h3>
            <ul class="space-y-2 text-blue-200 text-sm">
                <li>Email: info@smpmuashidiq.sch.id</li>
                <li>Telp: (021) xxxx-xxxx</li>
                <li>Alamat: Jl. Pendidikan No. 1, Kota ...</li>
            </ul>
        </div>
    </div>
    <div class="container mx-auto px-4 mt-12 pt-8 border-t border-blue-800 text-center text-blue-300 text-sm">
        &copy; {{ date('Y') }} SMP Muhammadiyah Unggulan Ashidiq. All rights reserved.
    </div>
</footer>
