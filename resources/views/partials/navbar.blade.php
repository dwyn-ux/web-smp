<div x-data="{ menuOpen: false, scrolled: false }" @scroll.window="scrolled = window.pageYOffset > 50">
<nav :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-md' : 'bg-white/80 backdrop-blur-sm'"
     class="fixed top-0 w-full z-50 transition-all duration-300">
    <div class="container mx-auto px-4 h-20 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('assets/logo smp.png') }}" alt="Logo" class="w-12 h-12 object-contain">
            <span class="font-bold text-lg text-blue-900 hidden lg:block leading-tight uppercase">
                SMP MUHAMMADIYAH<br><span class="text-xs text-blue-600">UNGGULAN ASHIDIQ</span>
            </span>
        </a>

        <div class="hidden md:flex items-center gap-8 font-semibold text-gray-700 text-sm tracking-wide">
            <a href="{{ route('profile') }}" class="hover:text-blue-600 transition relative group">PROFIL</a>
            <a href="{{ route('artikel.index') }}" class="hover:text-blue-600 transition relative group">ARTIKEL</a>
            <a href="{{ route('galeri.index') }}" class="hover:text-blue-600 transition relative group">GALERI</a>
            <a href="{{ route('dokumentasi.index') }}" class="hover:text-blue-600 transition relative group">DOKUMENTASI</a>
            <a href="{{ route('alumni.index') }}" class="hover:text-blue-600 transition relative group">ALUMNI</a>
            <a href="https://ponpesashiddiq.or.id" target="_blank" class="bg-blue-600 text-white px-6 py-2.5 rounded-full hover:bg-blue-700 transition font-bold text-sm">
                PSB
            </a>
        </div>

        <button @click="menuOpen = !menuOpen" class="md:hidden text-blue-900 relative w-8 h-8 z-50">
            <i data-lucide="menu" x-show="!menuOpen" class="absolute inset-0"></i>
            <i data-lucide="x" x-show="menuOpen" class="absolute inset-0"></i>
        </button>
    </div>
</nav>

<!-- Mobile Menu -->
<div x-show="menuOpen" x-cloak class="fixed inset-0 z-40 md:hidden" @click.outside="menuOpen = false">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="menuOpen = false"></div>
    <div class="absolute top-20 left-0 right-0 bottom-0 bg-white flex flex-col pt-8 px-6 overflow-y-auto">
        <div class="flex flex-col gap-6 text-lg font-semibold text-gray-800">
            <a href="{{ route('profile') }}" @click="menuOpen = false" class="hover:text-blue-600 border-b pb-4">PROFIL</a>
            <a href="{{ route('artikel.index') }}" @click="menuOpen = false" class="hover:text-blue-600 border-b pb-4">ARTIKEL</a>
            <a href="{{ route('galeri.index') }}" @click="menuOpen = false" class="hover:text-blue-600 border-b pb-4">GALERI</a>
            <a href="{{ route('dokumentasi.index') }}" @click="menuOpen = false" class="hover:text-blue-600 border-b pb-4">DOKUMENTASI</a>
            <a href="{{ route('alumni.index') }}" @click="menuOpen = false" class="hover:text-blue-600 border-b pb-4">ALUMNI</a>
            <a href="https://ponpesashiddiq.or.id" target="_blank" class="bg-blue-600 text-white px-6 py-3 rounded-full text-center">PSB</a>
        </div>
    </div>
</div>
</div>
