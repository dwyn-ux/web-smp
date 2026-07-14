@extends('layouts.app')

@section('content')
<section class="py-32 bg-white" x-data="galleryCarousel()">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-black text-blue-900 mb-12 uppercase">Galeri Foto</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($albums as $index => $album)
            <button type="button"
                 class="group relative h-72 sm:h-80 overflow-hidden rounded-xl shadow-md cursor-pointer text-left"
                 @click="open({{ $index }})">
                <img src="{{ $album['cover'] }}" alt="{{ $album['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-4">
                    <div class="flex items-end justify-between gap-3 w-full">
                        <p class="text-white font-bold">{{ $album['title'] }}</p>
                        @if($album['photos']->count() > 1)
                        <span class="shrink-0 inline-flex items-center gap-1 rounded-full bg-black/55 px-3 py-1 text-xs font-bold text-white backdrop-blur-sm">
                            <i data-lucide="images" class="w-4 h-4"></i>
                            {{ $album['photos']->count() }} foto
                        </span>
                        @endif
                    </div>
                </div>
            </button>
            @empty
            <p class="col-span-full py-16 text-center text-gray-500">Belum ada foto galeri.</p>
            @endforelse
        </div>
        @if($albums->hasPages())
        <div class="mt-12">{{ $albums->links() }}</div>
        @endif
    </div>

    <!-- Carousel Lightbox Modal -->
    <template x-if="isOpen">
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95"
             x-transition.opacity
             @click.self="close()"
             @keydown.escape.window="close()"
             @keydown.left.window="prev()"
             @keydown.right.window="next()">

            <!-- Close Button -->
            <button @click="close()" class="absolute top-6 right-6 z-10 text-white hover:text-gray-300 transition p-2 rounded-full bg-white/10 hover:bg-white/20">
                <i data-lucide="x" class="w-8 h-8"></i>
            </button>

            <!-- Counter -->
            <div class="absolute top-6 left-6 z-10 text-white font-bold bg-white/10 px-4 py-2 rounded-full text-sm">
                <span x-text="currentIndex + 1"></span> / <span x-text="total"></span>
            </div>

            <!-- Prev Button -->
            <button @click.stop="prev()"
                    class="absolute left-4 z-10 text-white hover:text-gray-300 transition p-3 rounded-full bg-white/10 hover:bg-white/20"
                    x-show="total > 1">
                <i data-lucide="chevron-left" class="w-8 h-8"></i>
            </button>

            <!-- Next Button -->
            <button @click.stop="next()"
                    class="absolute right-4 z-10 text-white hover:text-gray-300 transition p-3 rounded-full bg-white/10 hover:bg-white/20"
                    x-show="total > 1">
                <i data-lucide="chevron-right" class="w-8 h-8"></i>
            </button>

            <!-- Image Container -->
            <div class="max-w-[90vw] max-h-[85vh] flex items-center justify-center"
                 @touchstart="startSwipe($event)"
                 @touchend="endSwipe($event)">
                <img :src="currentImage()"
                     :alt="currentTitle()"
                     class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl select-none"
                     @dragstart.prevent>
            </div>

            <!-- Title -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white font-bold text-lg bg-white/10 px-6 py-3 rounded-full backdrop-blur-sm"
                 x-text="currentTitle()"></div>
        </div>
    </template>
</section>
@endsection

@push('scripts')
<script>
    function galleryCarousel() {
        return {
            isOpen: false,
            albumIndex: 0,
            currentIndex: 0,
            touchStartX: null,
            albums: @json($albums->getCollection()),

            get items() {
                return this.albums[this.albumIndex]?.photos ?? [];
            },

            get total() {
                return this.items.length;
            },

            open(index) {
                this.albumIndex = index;
                this.currentIndex = 0;
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
                this.$nextTick(() => lucide.createIcons());
            },

            close() {
                this.isOpen = false;
                document.body.style.overflow = '';
            },

            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.total) % this.total;
            },

            next() {
                this.currentIndex = (this.currentIndex + 1) % this.total;
            },

            startSwipe(event) {
                this.touchStartX = event.changedTouches[0]?.clientX ?? null;
            },

            endSwipe(event) {
                if (this.touchStartX === null || this.total < 2) return;

                const distance = (event.changedTouches[0]?.clientX ?? this.touchStartX) - this.touchStartX;
                this.touchStartX = null;

                if (Math.abs(distance) < 50) return;
                distance > 0 ? this.prev() : this.next();
            },

            currentImage() {
                return this.items[this.currentIndex]?.image ?? '';
            },

            currentTitle() {
                return this.items[this.currentIndex]?.title ?? '';
            }
        }
    }
</script>
@endpush
