@extends('admin.layout')

@section('title', 'Gerenciar Blog')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6 lg:py-8">
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-6 lg:mb-8">
        <div class="mb-4 lg:mb-0">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 text-center lg:text-left">Gerenciar Blog</h1>
            <p class="text-gray-600 mt-2 text-center lg:text-left">Gerencie todos os posts do blog da Shopp Reparos</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg flex items-center justify-center gap-2 transition-colors w-full lg:w-auto">
            <i class="fas fa-plus"></i>
            Novo Post
        </a>
    </div>

    <!-- Filtros -->
    <div class="bg-white rounded-lg shadow-md p-4 lg:p-6 mb-6">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                <input type="text" name="busca" value="{{ request('busca') }}" 
                       placeholder="Título ou conteúdo..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Categoria</label>
                <select name="categoria" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Todas as categorias</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria }}" {{ request('categoria') === $categoria ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('-', ' ', $categoria)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Todos os status</option>
                    <option value="publicado" {{ request('status') === 'publicado' ? 'selected' : '' }}>Publicado</option>
                    <option value="rascunho" {{ request('status') === 'rascunho' ? 'selected' : '' }}>Rascunho</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-md transition-colors">
                    <i class="fas fa-search mr-2"></i>Filtrar
                </button>
            </div>
        </form>
    </div>

    <!-- Estatísticas Rápidas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                        <i class="fas fa-check text-white text-sm"></i>
                    </div>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total de Posts</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ \App\Models\Post::count() }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                        <i class="fas fa-check-circle text-white text-sm"></i>
                    </div>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Publicados</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ \App\Models\Post::where('published', true)->count() }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                        <i class="fas fa-edit text-white text-sm"></i>
                    </div>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Rascunhos</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ \App\Models\Post::where('published', false)->count() }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                        <i class="fas fa-eye text-white text-sm"></i>
                    </div>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Visualizações</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ \App\Models\Post::sum('views') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Posts -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Mobile Cards View -->
        <div class="lg:hidden">
            @forelse($posts as $post)
            <div class="border-b border-gray-200 p-4 hover:bg-gray-50">
                <div class="flex items-start space-x-3">
                    @if($post->featured_image && \App\Helpers\BlogHelper::imageExists($post->featured_image))
                        <img class="h-16 w-20 object-cover rounded flex-shrink-0" src="{{ \App\Helpers\BlogHelper::getImageUrl($post->featured_image) }}" alt="">
                    @else
                        <div class="h-16 w-20 bg-gray-300 rounded flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-image text-gray-500 text-lg"></i>
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-medium text-gray-900 truncate">{{ $post->title }}</h3>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $post->excerpt }}</p>
                        
                        <div class="flex flex-wrap items-center gap-2 mt-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst(str_replace('-', ' ', $post->category)) }}
                            </span>
                            
                            @if($post->published)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>Publicado
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-edit mr-1"></i>Rascunho
                                </span>
                            @endif
                            
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-eye mr-1"></i>{{ number_format($post->views) }}
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between mt-3">
                            <span class="text-xs text-gray-500">{{ $post->created_at->format('d/m/Y H:i') }}</span>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
                                   class="text-blue-600 hover:text-blue-900 p-1" title="Ver Post">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <a href="{{ route('admin.posts.edit', $post) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 p-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="inline" 
                                      onsubmit="return confirm('Tem certeza que deseja excluir este post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 p-1" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <i class="fas fa-newspaper text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum post encontrado</h3>
                <p class="text-gray-500">Comece criando seu primeiro post do blog.</p>
            </div>
            @endforelse
        </div>

        <!-- Desktop Table View -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Post</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visualizações</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($posts as $post)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($post->featured_image && \App\Helpers\BlogHelper::imageExists($post->featured_image))
                                    <img class="h-12 w-16 object-cover rounded" src="{{ \App\Helpers\BlogHelper::getImageUrl($post->featured_image) }}" alt="">
                                @else
                                    <div class="h-12 w-16 bg-gray-300 rounded flex items-center justify-center">
                                        <i class="fas fa-image text-gray-500"></i>
                                    </div>
                                @endif
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 max-w-xs truncate">{{ $post->title }}</div>
                                    <div class="text-sm text-gray-500 max-w-xs truncate">{{ $post->excerpt }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst(str_replace('-', ' ', $post->category)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($post->published)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>Publicado
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-edit mr-1"></i>Rascunho
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <i class="fas fa-eye mr-1 text-gray-400"></i>{{ number_format($post->views) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $post->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
                                   class="text-blue-600 hover:text-blue-900 p-1" title="Ver Post">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <a href="{{ route('admin.posts.edit', $post) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 p-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="inline" 
                                      onsubmit="return confirm('Tem certeza que deseja excluir este post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 p-1" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center">
                            <i class="fas fa-newspaper text-gray-400 text-4xl mb-4 block"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum post encontrado</h3>
                            <p class="text-gray-500">Comece criando seu primeiro post do blog.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginação -->
    @if($posts->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $posts->links() }}
    </div>
    @endif
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
