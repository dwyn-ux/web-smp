@extends('admin.layout')

@section('content')
<div class="max-w-2xl mx-auto" x-data="multiUpload()">
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
        <h1 class="text-2xl font-bold text-gray-800 mb-8 flex items-center gap-2">
            <i data-lucide="images" class="text-blue-600"></i> Tambah Foto Galeri
        </h1>

        @if(session('success'))
        <div class="mb-6 bg-green-50 text-green-700 px-4 py-3 rounded-xl font-bold text-sm">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Foto</label>
                <input type="text" name="title" required class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Kegiatan Shalat Berjamaah">
                <p class="text-xs text-gray-400 mt-1">Judul akan sama untuk semua foto yang diupload.</p>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Foto (Bisa Banyak)</label>
                <input type="file" name="images[]" accept="image/*" multiple required 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                       @change="previewFiles($event)">
                <p class="text-xs text-gray-400 mt-1">Kamu bisa pilih banyak foto sekaligus (maks 5MB/foto).</p>
            </div>

            <!-- Preview Grid -->
            <div x-show="previews.length > 0" class="grid grid-cols-3 gap-3" x-cloak>
                <template x-for="(preview, i) in previews" :key="i">
                    <div class="relative rounded-xl overflow-hidden bg-gray-100 aspect-square">
                        <img :src="preview" class="w-full h-full object-cover">
                        <span x-text="'Foto ' + (i + 1)" class="absolute bottom-1 left-1 bg-black/60 text-white text-xs px-2 py-0.5 rounded-lg"></span>
                    </div>
                </template>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                <i data-lucide="upload-cloud"></i> Upload Semua Foto
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function multiUpload() {
        return {
            previews: [],
            previewFiles(event) {
                this.previews = [];
                const files = event.target.files;
                for (let i = 0; i < files.length; i++) {
                    this.previews.push(URL.createObjectURL(files[i]));
                }
            }
        }
    }
</script>
@endpush
