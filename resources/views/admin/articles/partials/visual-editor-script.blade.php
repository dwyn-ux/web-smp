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

function applyAlignment(alignment) {
    const selection = window.getSelection();
    if (!selection.rangeCount) return;

    const range = selection.getRangeAt(0);
    const blockSelector = 'p, div, h1, h2, h3, h4, h5, h6, li, blockquote';
    const blocks = Array.from(visualEditor.querySelectorAll(blockSelector))
        .filter(block => {
            try {
                return range.intersectsNode(block) && !block.querySelector(blockSelector);
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
