@extends('admin.layout')

@section('content')
<div class="max-w-5xl mx-auto">
    <style>
        .article-editor {
            min-height: 400px;
            color: #1a202c;
            line-height: 1.75;
        }
        .article-editor:empty::before {
            content: attr(data-placeholder);
            color: #9ca3af;
            pointer-events: none;
        }
        .article-editor p { margin: 0 0 1rem; }
        .article-editor h2 { font-size: 1.5rem; font-weight: 700; margin: 1.5rem 0 .75rem; }
        .article-editor h3 { font-size: 1.25rem; font-weight: 700; margin: 1.25rem 0 .5rem; }
        .article-editor ul { list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem; }
        .article-editor ol { list-style: decimal; padding-left: 1.5rem; margin-bottom: 1rem; }
        .article-editor blockquote { border-left: 4px solid #93c5fd; padding-left: 1rem; color: #4b5563; }
        .article-editor img { max-width: 100%; height: auto; margin: 1rem auto; border-radius: .75rem; }
        .editor-tool[aria-pressed="true"] { background: #dbeafe; color: #1d4ed8; }
        .editor-tool:disabled { opacity: .45; cursor: wait; }
        @media (max-width: 640px) {
            .article-editor { min-height: 320px; }
        }
    </style>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-blue-900 p-8 text-white">
            <h1 class="text-2xl font-bold">Edit Artikel</h1>
            <p class="text-blue-200">Perbarui konten artikel di bawah ini.</p>
        </div>

        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            @method('PUT')
            <div class="grid md:grid-cols-3 gap-8">
                <div class="md:col-span-2 space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Artikel</label>
                        <input type="text" name="title" required value="{{ old('title', $article->title) }}" class="w-full text-2xl font-bold border-b-2 border-gray-200 focus:border-blue-600 outline-none py-2 transition bg-white text-gray-900" placeholder="Masukkan judul artikel...">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Konten Artikel</label>
                        <div class="overflow-hidden rounded-xl border border-gray-300 bg-white focus-within:border-blue-600 focus-within:ring-2 focus-within:ring-blue-100">
                            <div id="editor-toolbar" class="flex flex-wrap items-center gap-1 border-b border-gray-200 bg-gray-50 p-2" role="toolbar" aria-label="Format konten artikel">
                                <select id="format-block" class="h-9 rounded-lg border border-gray-300 bg-white px-2 text-sm" title="Format teks">
                                    <option value="p">Paragraf</option>
                                    <option value="h2">Judul Besar</option>
                                    <option value="h3">Subjudul</option>
                                </select>
                                <span class="mx-1 h-6 w-px bg-gray-300"></span>
                                <button type="button" class="editor-tool rounded-lg p-2 hover:bg-blue-100" data-command="bold" title="Tebal"><i data-lucide="bold" class="h-4 w-4"></i></button>
                                <button type="button" class="editor-tool rounded-lg p-2 hover:bg-blue-100" data-command="italic" title="Miring"><i data-lucide="italic" class="h-4 w-4"></i></button>
                                <button type="button" class="editor-tool rounded-lg p-2 hover:bg-blue-100" data-command="underline" title="Garis bawah"><i data-lucide="underline" class="h-4 w-4"></i></button>
                                <span class="mx-1 h-6 w-px bg-gray-300"></span>
                                <button type="button" class="editor-tool rounded-lg p-2 hover:bg-blue-100" data-command="justifyLeft" title="Rata kiri"><i data-lucide="align-left" class="h-4 w-4"></i></button>
                                <button type="button" class="editor-tool rounded-lg p-2 hover:bg-blue-100" data-command="justifyCenter" title="Rata tengah"><i data-lucide="align-center" class="h-4 w-4"></i></button>
                                <button type="button" class="editor-tool rounded-lg p-2 hover:bg-blue-100" data-command="justifyRight" title="Rata kanan"><i data-lucide="align-right" class="h-4 w-4"></i></button>
                                <button type="button" class="editor-tool rounded-lg p-2 hover:bg-blue-100" data-command="justifyFull" title="Rata kanan kiri"><i data-lucide="align-justify" class="h-4 w-4"></i></button>
                                <span class="mx-1 h-6 w-px bg-gray-300"></span>
                                <button type="button" class="editor-tool rounded-lg p-2 hover:bg-blue-100" data-command="insertUnorderedList" title="Daftar poin"><i data-lucide="list" class="h-4 w-4"></i></button>
                                <button type="button" class="editor-tool rounded-lg p-2 hover:bg-blue-100" data-command="insertOrderedList" title="Daftar nomor"><i data-lucide="list-ordered" class="h-4 w-4"></i></button>
                                <button type="button" id="insert-link" class="editor-tool rounded-lg p-2 hover:bg-blue-100" title="Tambah tautan"><i data-lucide="link" class="h-4 w-4"></i></button>
                                <button type="button" id="upload-content-image" class="editor-tool rounded-lg p-2 hover:bg-blue-100" title="Tambah gambar"><i data-lucide="image-plus" class="h-4 w-4"></i></button>
                                <input type="file" id="content-image-input" accept="image/*" class="hidden">
                                <span class="mx-1 h-6 w-px bg-gray-300"></span>
                                <button type="button" class="editor-tool rounded-lg p-2 hover:bg-blue-100" data-command="undo" title="Urungkan"><i data-lucide="undo-2" class="h-4 w-4"></i></button>
                                <button type="button" class="editor-tool rounded-lg p-2 hover:bg-blue-100" data-command="redo" title="Ulangi"><i data-lucide="redo-2" class="h-4 w-4"></i></button>
                            </div>
                            <div id="visual-editor" class="article-editor p-5 outline-none" contenteditable="true" data-placeholder="Tulis konten artikel di sini...">{!! old('content', $article->content ?? '') !!}</div>
                        </div>
                        <textarea id="editor" name="content" class="hidden"></textarea>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-gray-50 p-6 rounded-3xl border border-dashed border-gray-300">
                        <label class="block text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                            <i data-lucide="image" class="w-4 h-4"></i> Gambar Header
                        </label>
                        @if($article->image)
                            <img src="{{ asset('uploads/' . $article->image) }}" alt="Header" class="w-full rounded-xl mb-3">
                            <p class="text-[10px] text-gray-400 mb-2">Upload gambar baru untuk mengganti.</p>
                        @endif
                        <input type="file" name="image" accept="image/*" class="w-full text-xs text-gray-500">
                        <p class="text-[10px] text-gray-400 mt-2 italic">Kosongkan jika tidak ingin mengganti.</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-3xl border border-gray-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                            <i data-lucide="sparkles" class="w-4 h-4"></i> Buat dengan AI
                        </label>
                        <select id="ai-provider" class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white text-gray-900 mb-3">
                            <option value="openai">🤖 OpenAI (GPT-4o mini)</option>
                            <option value="deepseek">🧠 DeepSeek (deepseek-chat)</option>
                            <option value="gemini">✨ Google Gemini (2.0 Flash)</option>
                            <option value="custom">⚙️ Custom Endpoint</option>
                        </select>
                        <div id="custom-endpoint-wrap" class="hidden mb-3 space-y-2">
                            <input type="text" id="ai-endpoint" class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white text-gray-900" placeholder="https://api.contoh.com/v1/chat/completions">
                            <input type="text" id="ai-api-key" class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white text-gray-900" placeholder="API Key (opsional jika sudah di .env)">
                            <input type="text" id="ai-model" class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white text-gray-900" placeholder="Nama model, mis: gpt-4o-mini">
                        </div>
                        <textarea id="ai-prompt" rows="4" class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white text-gray-900" placeholder="Masukkan topik artikel, misal: 'Pentingnya pendidikan karakter di SMP'."></textarea>
                        <button type="button" id="generate-article" class="mt-4 w-full bg-indigo-600 text-white py-3 rounded-2xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 flex items-center justify-center gap-2">
                            <i data-lucide="cpu" class="w-4 h-4"></i> Generate Konten AI
                        </button>
                        <p class="text-[10px] text-gray-400 mt-2 italic">Isi API key di .env atau gunakan Custom Endpoint.</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-3xl border border-gray-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                            <i data-lucide="tag" class="w-4 h-4"></i> Tag / Kategori
                        </label>
                        <input type="text" name="tags" value="{{ $article->tags->pluck('name')->implode(', ') }}" class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white text-gray-900" placeholder="Berita, Kegiatan">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                        <i data-lucide="save"></i> Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.articles.index') }}" class="w-full block text-center bg-gray-200 text-gray-700 py-4 rounded-2xl font-bold hover:bg-gray-300 transition">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const visualEditor = document.getElementById('visual-editor');
    const sourceEditor = document.getElementById('editor');
    const editorToolbar = document.getElementById('editor-toolbar');
    const editorForm = visualEditor.closest('form');
    let savedSelection = null;

    function syncEditor() {
        sourceEditor.value = visualEditor.innerHTML.trim();
    }

    syncEditor();

    function saveSelection() {
        const selection = window.getSelection();
        if (!selection.rangeCount) return;

        const range = selection.getRangeAt(0);
        if (visualEditor.contains(range.commonAncestorContainer)) {
            savedSelection = range.cloneRange();
        }
    }

    function restoreSelection() {
        visualEditor.focus();
        if (!savedSelection) return;

        const selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(savedSelection);
    }

    function runCommand(command, value = null) {
        restoreSelection();

        const alignments = {
            justifyLeft: 'left',
            justifyCenter: 'center',
            justifyRight: 'right',
            justifyFull: 'justify',
        };

        if (alignments[command]) {
            applyAlignment(alignments[command]);
            return;
        }

        document.execCommand(command, false, value);
        saveSelection();
        syncEditor();
    }

    function applyAlignment(alignment) {
        const selection = window.getSelection();
        if (!selection.rangeCount) return;

        const range = selection.getRangeAt(0);
        const blockSelector = 'p, div, h1, h2, h3, h4, h5, h6, li, blockquote';
        const blocks = Array.from(visualEditor.querySelectorAll(blockSelector))
            .filter(block => {
                try {
                    return range.intersectsNode(block)
                        && !block.querySelector(blockSelector);
                } catch (error) {
                    return false;
                }
            });

        if (!blocks.length) {
            const node = range.startContainer.nodeType === Node.TEXT_NODE
                ? range.startContainer.parentElement
                : range.startContainer;
            const currentBlock = node.closest?.(blockSelector);

            if (currentBlock && currentBlock !== visualEditor) {
                blocks.push(currentBlock);
            }
        }

        if (!blocks.length) {
            document.execCommand('formatBlock', false, 'p');
            document.execCommand(
                alignment === 'justify' ? 'justifyFull' : `justify${alignment[0].toUpperCase()}${alignment.slice(1)}`,
                false
            );
        } else {
            blocks.forEach(block => {
                block.style.textAlign = alignment;
            });
        }

        saveSelection();
        syncEditor();
    }

    function editorHtml(content) {
        if (/<\/?[a-z][\s\S]*>/i.test(content)) return content;

        return content
            .split(/\n\s*\n/)
            .filter(paragraph => paragraph.trim())
            .map(paragraph => {
                const container = document.createElement('div');
                container.textContent = paragraph.trim();
                return `<p>${container.innerHTML.replace(/\n/g, '<br>')}</p>`;
            })
            .join('');
    }

    const editorInstance = {
        setData(content) {
            visualEditor.innerHTML = editorHtml(content);
            syncEditor();
        }
    };

    visualEditor.addEventListener('keyup', saveSelection);
    visualEditor.addEventListener('mouseup', saveSelection);
    visualEditor.addEventListener('input', syncEditor);
    editorForm.addEventListener('submit', syncEditor);

    editorToolbar.querySelectorAll('[data-command]').forEach(button => {
        button.addEventListener('mousedown', event => event.preventDefault());
        button.addEventListener('click', () => runCommand(button.dataset.command));
    });

    document.getElementById('format-block').addEventListener('change', function () {
        runCommand('formatBlock', this.value);
    });

    document.getElementById('insert-link').addEventListener('mousedown', event => event.preventDefault());
    document.getElementById('insert-link').addEventListener('click', function () {
        const url = prompt('Masukkan alamat tautan:');
        if (url) runCommand('createLink', url);
    });

    const contentImageButton = document.getElementById('upload-content-image');
    const contentImageInput = document.getElementById('content-image-input');

    contentImageButton.addEventListener('mousedown', event => event.preventDefault());
    contentImageButton.addEventListener('click', () => {
        saveSelection();
        contentImageInput.click();
    });

    contentImageInput.addEventListener('change', async function () {
        const file = this.files[0];
        if (!file) return;

        const data = new FormData();
        data.append('file', file);
        data.append('_token', '{{ csrf_token() }}');
        contentImageButton.disabled = true;

        try {
            const response = await fetch('{{ route('admin.articles.upload') }}', {
                method: 'POST',
                body: data,
            });
            const result = await response.json();

            if (!response.ok || !result.location) {
                throw new Error('Upload gagal');
            }

            runCommand('insertImage', result.location);
        } catch (error) {
            alert('Gambar gagal di-upload. Silakan coba lagi.');
        } finally {
            contentImageButton.disabled = false;
            this.value = '';
        }
    });

    document.getElementById('ai-provider').addEventListener('change', function () {
        const wrap = document.getElementById('custom-endpoint-wrap');
        wrap.classList.toggle('hidden', this.value !== 'custom');
    });

    document.getElementById('generate-article').addEventListener('click', function () {
        const prompt = document.getElementById('ai-prompt').value.trim();
        const provider = document.getElementById('ai-provider').value;
        if (!prompt) {
            alert('Masukkan topik artikel terlebih dahulu.');
            return;
        }

        const body = { prompt, provider };
        if (provider === 'custom') {
            const endpoint = document.getElementById('ai-endpoint').value.trim();
            const apiKey = document.getElementById('ai-api-key').value.trim();
            const model = document.getElementById('ai-model').value.trim();
            if (!endpoint) {
                alert('Masukkan endpoint URL untuk Custom Endpoint.');
                return;
            }
            body.endpoint = endpoint;
            body.api_key = apiKey;
            body.model = model || 'gpt-4o-mini';
        }

        this.disabled = true;
        this.textContent = 'Membuat artikel...';

        fetch('{{ route("admin.articles.generate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify(body),
        })
        .then(async response => {
            this.disabled = false;
            this.textContent = 'Generate Konten AI';
            const data = await response.json();
            if (!response.ok) {
                alert(data.error || 'Gagal membuat konten AI.');
                return;
            }
            if (editorInstance) {
                editorInstance.setData(data.content);
            }
        })
        .catch(() => {
            this.disabled = false;
            this.textContent = 'Generate Konten AI';
            alert('Terjadi kesalahan koneksi.');
        });

    lucide.createIcons();
</script>
@endsection
