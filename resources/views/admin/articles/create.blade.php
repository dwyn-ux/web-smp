@extends('admin.layout')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- CKEditor 5 Classic -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
            color: #1a202c; /* Text gray-900 */
        }
    </style>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-blue-900 p-8 text-white">
            <h1 class="text-2xl font-bold">Tulis Artikel Baru</h1>
            <p class="text-blue-200">Gunakan editor di bawah untuk membuat konten yang menarik.</p>
        </div>

        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            <div class="grid md:grid-cols-3 gap-8">
                <div class="md:col-span-2 space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Artikel</label>
                        <input type="text" name="title" required class="w-full text-2xl font-bold border-b-2 border-gray-200 focus:border-blue-600 outline-none py-2 transition bg-white text-gray-900" placeholder="Masukkan judul artikel...">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Konten Artikel</label>
                        <textarea id="editor" name="content"></textarea>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-gray-50 p-6 rounded-3xl border border-dashed border-gray-300">
                        <label class="block text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                            <i data-lucide="image" class="w-4 h-4"></i> Gambar Header
                        </label>
                        <input type="file" name="image" accept="image/*" class="w-full text-xs text-gray-500">
                        <p class="text-[10px] text-gray-400 mt-2 italic">Gambar utama di daftar berita.</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-3xl border border-gray-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                            <i data-lucide="tag" class="w-4 h-4"></i> Tag / Kategori
                        </label>
                        <input type="text" name="tags" class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white text-gray-900" placeholder="Berita, Kegiatan">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                        <i data-lucide="save"></i> Publish Artikel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file.then(file => new Promise((resolve, reject) => {
                const data = new FormData();
                data.append('file', file);
                data.append('_token', '{{ csrf_token() }}');

                fetch('{{ route('admin.articles.upload') }}', {
                    method: 'POST',
                    body: data,
                })
                .then(response => response.json())
                .then(result => {
                    resolve({ default: result.location });
                })
                .catch(error => {
                    reject(error);
                });
            }));
        }
    }

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    ClassicEditor
        .create(document.querySelector('#editor'), {
            extraPlugins: [MyCustomUploadAdapterPlugin],
            toolbar: [
                'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
                'imageUpload', 'insertTable', 'mediaEmbed', 'undo', 'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
