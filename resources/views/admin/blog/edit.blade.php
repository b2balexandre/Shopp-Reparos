@extends('admin.layout')

@section('title', 'Editar Post')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Editar Post</h2>
                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" 
                       class="text-blue-600 hover:text-blue-800 text-sm">
                        Ver Post →
                    </a>
                </div>
            </div>
            
            <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Coluna Principal -->
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título do Post *</label>
                            <input type="text" name="title" id="title" required
                                   value="{{ old('title', $post->title) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                                   placeholder="Digite o título do post...">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Resumo/Excerpt *</label>
                            <textarea name="excerpt" id="excerpt" rows="3" required
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('excerpt') border-red-500 @enderror"
                                      placeholder="Escreva um resumo atrativo do post...">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Este texto aparecerá nas listagens e redes sociais.</p>
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Conteúdo do Post *</label>
                            <textarea name="content" id="content" rows="15" required
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror"
                                      placeholder="Escreva o conteúdo completo do post...">{!! old('content', $post->content) !!}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Quebre o texto com linhas em branco para criar parágrafos automaticamente. Tags HTML avançadas continuam funcionando.</p>
                            <button type="button" id="insert-image-url-edit" class="mt-3 inline-flex items-center gap-2 bg-blue-50 hover:bg-blue-100 text-blue-700 font-medium text-sm px-3 py-2 rounded-md transition-colors">
                                <i class="fas fa-image"></i>
                                Inserir imagem por URL
                            </button>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Informações do Post -->
                        <div class="bg-gray-50 p-4 rounded-md">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Informações</h3>
                            <div class="space-y-2 text-sm text-gray-600">
                                <div><strong>Criado:</strong> {{ $post->created_at->format('d/m/Y H:i') }}</div>
                                <div><strong>Atualizado:</strong> {{ $post->updated_at->format('d/m/Y H:i') }}</div>
                                <div><strong>Visualizações:</strong> {{ number_format($post->views) }}</div>
                                <div><strong>Slug:</strong> {{ $post->slug }}</div>
                            </div>
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Categoria *</label>
                            <select name="category" id="category" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category') border-red-500 @enderror">
                                <option value="">Selecione uma categoria</option>
                                @foreach($categorias as $value => $label)
                                    <option value="{{ $value }}" {{ old('category', $post->category) === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Imagem Destacada</label>
                            
                            @if($post->featured_image && \App\Helpers\BlogHelper::imageExists($post->featured_image))
                                <div class="mt-2">
                                    <img src="{{ \App\Helpers\BlogHelper::getImageUrl($post->featured_image) }}" alt="Imagem atual" class="w-full h-32 object-cover rounded-md">
                                </div>
                            @endif
                            
                            <input type="file" name="featured_image" id="featured_image" accept="image/*,image/svg+xml"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('featured_image') border-red-500 @enderror">
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Deixe vazio para manter a imagem atual. Formatos: JPG, PNG, GIF, SVG, WebP. Max: 2MB</p>
                        </div>

                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">Palavras-chave SEO</label>
                            <textarea name="meta_keywords" id="meta_keywords" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('meta_keywords') border-red-500 @enderror"
                                      placeholder="palavra1, palavra2, palavra3">{{ old('meta_keywords', $post->meta_keywords_string) }}</textarea>
                            @error('meta_keywords')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Separe as palavras-chave por vírgula.</p>
                        </div>

                        <div>
                            <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                            <textarea name="tags" id="tags" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tags') border-red-500 @enderror"
                                      placeholder="Tag1, Tag2, Tag3">{{ old('tags', $post->tags_string) }}</textarea>
                            @error('tags')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Separe as tags por vírgula.</p>
                        </div>

                        <div class="border-t pt-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="published" id="published" value="1" {{ old('published', $post->published) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="published" class="ml-2 block text-sm text-gray-900">
                                    Post publicado
                                </label>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">
                                @if($post->published)
                                    Publicado em {{ $post->published_at->format('d/m/Y H:i') }}
                                @else
                                    Post está como rascunho
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.posts.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded transition-colors">
                        Voltar
                    </a>
                    <div class="space-x-4">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                            Salvar Alterações
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const excerptInput = document.getElementById('excerpt');
    if (excerptInput) {
        const updateExcerptCounter = function(e) {
            const maxLength = 500;
            const currentLength = e.target.value.length;
            const remaining = maxLength - currentLength;
            let counter = document.getElementById('excerpt-counter');
            if (!counter) {
                counter = document.createElement('p');
                counter.id = 'excerpt-counter';
                counter.className = 'mt-1 text-sm text-gray-500';
                e.target.parentNode.appendChild(counter);
            }

            counter.textContent = `${remaining} caracteres restantes`;
            counter.className = remaining < 0
                ? 'mt-1 text-sm text-red-500'
                : 'mt-1 text-sm text-gray-500';
        };

        excerptInput.addEventListener('input', updateExcerptCounter);
        updateExcerptCounter({ target: excerptInput });
    }

    const featuredInput = document.getElementById('featured_image');
    if (featuredInput) {
        featuredInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                const existingPreview = document.getElementById('image-preview');
                if (existingPreview) {
                    existingPreview.remove();
                }

                const preview = document.createElement('div');
                preview.id = 'image-preview';
                preview.className = 'mt-3 p-3 border rounded-md bg-gray-50';

                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = 'w-full h-32 object-cover rounded-md';
                img.alt = 'Preview da nova imagem';

                const label = document.createElement('p');
                label.className = 'text-sm text-gray-600 mt-2';
                label.textContent = `Nova imagem: ${file.name} (${(file.size / 1024).toFixed(1)} KB)`;

                preview.appendChild(img);
                preview.appendChild(label);
                e.target.parentNode.appendChild(preview);
            };

            reader.readAsDataURL(file);
        });
    }

    if (typeof ClassicEditor !== 'undefined') {
        ClassicEditor
            .create(document.querySelector('#content'), {
                language: 'pt-br',
                toolbar: {
                    items: [
                        'undo', 'redo', '|',
                        'heading', '|',
                        'bold', 'italic', 'underline', 'link', '|',
                        'bulletedList', 'numberedList', 'outdent', 'indent', '|',
                        'blockQuote', 'insertTable', 'insertImage'
                    ]
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Parágrafo', class: 'ck-heading_paragraph' },
                        { model: 'heading2', view: 'h2', title: 'Cabeçalho 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Cabeçalho 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Cabeçalho 4', class: 'ck-heading_heading4' }
                    ]
                },
                table: {
                    contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells', 'toggleTableCaption' ],
                    defaultHeadings: { rows: 1, columns: 0 }
                },
                image: {
                    toolbar: ['imageStyle:inline', 'imageStyle:block', 'imageStyle:side', '|', 'toggleImageCaption', 'imageTextAlternative'],
                    insert: {
                        integrations: ['insertImageViaUrl']
                    }
                }
            })
            .then(editor => {
                window.adminBlogEditor = editor;
                const insertButton = document.getElementById('insert-image-url-edit');
                if (insertButton) {
                    insertButton.addEventListener('click', function() {
                        insertImageFromUrl(editor);
                    });
                }
            })
            .catch(error => {
                console.error('Não foi possível inicializar o CKEditor:', error);
            });
    } else {
        console.error('CKEditor não pôde ser carregado. Verifique a conexão com o CDN.');
    }
});

function insertImageFromUrl(editor) {
    if (!editor) {
        return;
    }

    const url = prompt('Informe a URL da imagem (https://...)');
    if (!url) {
        return;
    }

    const trimmed = url.trim();
    if (!/^https?:\/\//i.test(trimmed)) {
        alert('Use um link completo começando com http:// ou https://');
        return;
    }

    editor.model.change(() => {
        editor.execute('insertImage', { source: [{ src: trimmed }] });
    });
}
</script>
@endpush

@push('styles')
<style>
    #insert-image-url-edit i {
        font-size: 0.875rem;
    }
</style>
@endpush
@endsection
