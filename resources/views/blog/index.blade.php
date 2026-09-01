@extends('layouts.site')

@section('title', 'Blog - Dicas e Soluções | Shopp Reparos')
@section('description', 'Descubra dicas práticas, tutoriais e soluções para reparos hidráulicos, elétricos e muito mais. O melhor conteúdo sobre manutenção e reformas.')
@section('keywords', 'blog, dicas de reparo, tutoriais hidráulicos, soluções elétricas, manutenção predial, reformas, Shopp Reparos')

@push('styles')
<style>
.blog-hero {
    background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #fbbf24 100%);
    position: relative;
    overflow: hidden;
    color: white;
    padding: 4rem 0;
    margin-bottom: 0;
}

/* Melhor contraste e espaçamento geral */
.blog-main {
    padding: 2rem 0 3rem 0;
    background: #f8fafc;
}

.blog-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="%23ffffff" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
    opacity: 0.3;
}

.blog-hero-content {
    position: relative;
    z-index: 2;
}

.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    z-index: 1;
}

.floating-elements .element {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.floating-elements .element:nth-child(1) {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.floating-elements .element:nth-child(2) {
    width: 120px;
    height: 120px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.floating-elements .element:nth-child(3) {
    width: 60px;
    height: 60px;
    top: 80%;
    left: 20%;
    animation-delay: 4s;
}

.post-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(30, 64, 175, 0.10);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    overflow: hidden;
    height: 100%;
    position: relative;
    border: 1px solid #e5e7eb;
    margin-bottom: 2rem;
}

.post-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #1e40af, #fbbf24);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.post-card:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 25px 50px rgba(30, 64, 175, 0.18);
}

.post-card:hover::before {
    opacity: 1;
}

.post-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.4s ease;
    border-bottom: 1px solid #e5e7eb;
}

.post-card:hover .post-image {
    transform: scale(1.1);
}

.post-meta {
    font-size: 0.95rem;
    color: #374151;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.category-badge {
    background: linear-gradient(135deg, #1e40af, #fbbf24);
    color: #fff;
    padding: 0.5rem 1.1rem;
    border-radius: 25px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.18);
    border: 1px solid #e5e7eb;
}

.search-section {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 2rem 0 1.5rem 0;
    margin-bottom: 2rem;
    position: relative;
}

.search-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%233b82f6" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>') repeat;
}

.search-container {
    background: #fff;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 6px 18px rgba(30, 64, 175, 0.07);
    border: 1px solid #e5e7eb;
}

.search-input {
    background: #f8fafc;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 0.7rem 1.1rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #1e40af;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.08);
    transform: translateY(-2px);
}

.search-btn {
    background: linear-gradient(135deg, #1e40af, #fbbf24);
    border-radius: 12px;
    padding: 0.7rem 1.7rem;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.18);
    color: #fff;
    font-weight: 700;
    font-size: 1rem;
    border: none;
}

.search-btn:hover {
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 12px 35px rgba(30, 64, 175, 0.18);
    filter: brightness(1.08);
}

.featured-posts {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.9));
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 0.75rem;
    margin: 1rem 0;
}

.stat-card {
        background: #f8fafc;
        border-radius: 24px;
        padding: 2rem 1.5rem;
        margin-bottom: 2.5rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 10px 30px rgba(30, 64, 175, 0.07);
    transition: transform 0.3s ease;

/* Responsividade extra para cards do blog */
@media (max-width: 900px) {
    .post-card { margin-bottom: 1.5rem; }
    .post-image { height: 170px; }
}
@media (max-width: 600px) {
    .blog-main { padding: 1rem 0 2rem 0; }
    .post-card { border-radius: 14px; }
    .post-image { height: 120px; }
    .featured-posts { padding: 1.2rem 0.5rem; }
}
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #1e40af, #fbbf24);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.25rem;
}

.reading-progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6, #f59e0b);
    z-index: 1000;
    transition: width 0.1s ease;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    33% {
        transform: translateY(-15px) rotate(120deg);
    }
    66% {
        transform: translateY(-5px) rotate(240deg);
    }
}

@keyframes pulse-glow {
    0%, 100% {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    }
    50% {
        box-shadow: 0 0 40px rgba(59, 130, 246, 0.6);
    }
}

.animate-pulse-glow {
    animation: pulse-glow 2s ease-in-out infinite;
}

/* Responsividade para telas menores */
@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.5rem;
    }
    
    .stat-card {
        padding: 0.75rem;
    }
    
    .stat-number {
        font-size: 1.25rem;
    }
    
    .search-container {
        padding: 1rem;
    }
    
    .search-section {
        padding: 1rem 0;
    }
}
</style>
@endpush

@section('content')
<!-- Reading Progress Bar -->
<div class="reading-progress"></div>

<!-- Hero Section -->
<div class="blog-hero">
    <div class="floating-elements">
        <div class="element"></div>
        <div class="element"></div>
        <div class="element"></div>
    </div>
    <div class="container mx-auto px-4">
        <div class="blog-hero-content text-center">
            <div class="animate-fade-in">
                <span class="inline-block bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-6 py-3 mb-6 text-sm font-semibold uppercase tracking-wider">
                    ✨ Centro de Conhecimento
                </span>
                <h1 class="text-4xl md:text-5xl font-display font-black mb-4 leading-tight">
                    Blog <span class="bg-gradient-to-r from-yellow-300 to-orange-400 bg-clip-text text-transparent">Shopp Reparos</span>
                </h1>
                <p class="text-lg md:text-xl opacity-90 max-w-3xl mx-auto mb-6 leading-relaxed">
                    🔧 Descubra dicas práticas, tutoriais especializados e soluções inteligentes para todos os seus projetos de reparo e manutenção.
                </p>
                <div class="flex flex-wrap justify-center gap-3 mb-6">
                    <span class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-3 py-1 text-xs">
                        📚 {{ \App\Models\Post::published()->count() }} Artigos
                    </span>
                    <span class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-3 py-1 text-xs">
                        🎯 {{ $categorias->count() }} Categorias
                    </span>
                    <span class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-3 py-1 text-xs">
                        ⭐ Gratuito
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4">
    <!-- Seção de Busca e Filtros -->
    <div class="search-section">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="search-container animate-slide-up">
                    <h2 class="text-xl font-display font-bold text-center mb-1 text-gray-800">
                        🔍 Encontre o que Precisa
                    </h2>
                    <p class="text-center text-gray-600 mb-4 text-sm">
                        Busque entre nossos artigos especializados
                    </p>
                    <form method="GET" class="flex flex-col lg:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    name="busca" 
                                    value="{{ request('busca') }}"
                                    placeholder="Digite sua dúvida ou problema..." 
                                    class="search-input w-full pl-12 pr-4 focus:outline-none"
                                >
                            </div>
                        </div>
                        <div class="lg:w-64">
                            <div class="relative">
                                <i class="fas fa-tag absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <select name="categoria" class="search-input w-full pl-12 pr-4 focus:outline-none appearance-none">
                                    <option value="">🏷️ Todas as categorias</option>
                                    @foreach($categorias as $cat)
                                        <option value="{{ $cat }}" {{ request('categoria') === $cat ? 'selected' : '' }}>
                                            {{ ucfirst($cat) }}
                                        </option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>
                        <button type="submit" class="search-btn text-white font-semibold px-8 py-4 hover:scale-105 focus:outline-none transition-all duration-300">
                            <i class="fas fa-search mr-2"></i>
                            Buscar
                        </button>
                    </form>
                </div>
                
                <!-- Stats Section -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">{{ \App\Models\Post::published()->count() }}</div>
                        <div class="text-gray-600 font-medium text-sm">📚 Artigos</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $categorias->count() }}</div>
                        <div class="text-gray-600 font-medium text-sm">🎯 Categorias</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ \App\Models\Post::published()->sum('views') }}</div>
                        <div class="text-gray-600 font-medium text-sm">👁️ Views</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">100%</div>
                        <div class="text-gray-600 font-medium text-sm">✨ Gratuito</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Conteúdo Principal -->
        <div class="lg:w-2/3">
            @if($posts->count() > 0)
                <!-- Filtros Ativos -->
                @if(request('busca') || request('categoria'))
                <div class="mb-8">
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800">🔍 Resultados da busca:</h3>
                        <div class="flex flex-wrap gap-3">
                            @if(request('busca'))
                                <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">
                                    🔍 "{{ request('busca') }}"
                                    <a href="{{ route('blog.index', array_diff_key(request()->query(), ['busca' => ''])) }}" class="ml-2 text-blue-600 hover:text-blue-800">×</a>
                                </span>
                            @endif
                            @if(request('categoria'))
                                <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-medium">
                                    🏷️ {{ ucfirst(request('categoria')) }}
                                    <a href="{{ route('blog.index', array_diff_key(request()->query(), ['categoria' => ''])) }}" class="ml-2 text-purple-600 hover:text-purple-800">×</a>
                                </span>
                            @endif
                            <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium px-4 py-2 border border-gray-300 rounded-full hover:bg-gray-50 transition-colors">
                                🏠 Limpar filtros
                            </a>
                        </div>
                        <p class="text-gray-600 mt-3">
                            {{ $posts->total() }} artigo{{ $posts->total() !== 1 ? 's' : '' }} encontrado{{ $posts->total() !== 1 ? 's' : '' }}
                        </p>
                    </div>
                </div>
                @endif
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    @foreach($posts as $index => $post)
                        <article class="post-card animate-on-scroll" style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="relative overflow-hidden">
                                @if($post->featured_image && \App\Helpers\BlogHelper::imageExists($post->featured_image))
                                    <img src="{{ \App\Helpers\BlogHelper::getImageUrl($post->featured_image) }}" alt="{{ $post->title }}" class="post-image">
                                @else
                                    <div class="post-image bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center relative overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-black opacity-20"></div>
                                        <span class="text-white text-3xl font-black relative z-10">{{ strtoupper(substr($post->title, 0, 2)) }}</span>
                                        <div class="absolute top-4 right-4 bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-2">
                                            <i class="fas fa-tools text-white text-sm"></i>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Reading Time Badge -->
                                <div class="absolute top-4 left-4 bg-black bg-opacity-70 text-white px-3 py-1 rounded-full text-xs font-medium backdrop-blur-sm">
                                    <i class="fas fa-clock mr-1"></i>{{ $post->reading_time_text }}
                                </div>
                                
                                <!-- Views Badge -->
                                <div class="absolute top-4 right-4 bg-white bg-opacity-90 text-gray-700 px-3 py-1 rounded-full text-xs font-medium backdrop-blur-sm">
                                    <i class="fas fa-eye mr-1"></i>{{ $post->views }}
                                </div>
                            </div>
                            
                            <div class="p-8">
                                <div class="flex items-center gap-4 mb-4">
                                    <span class="category-badge">{{ $post->category }}</span>
                                    <span class="post-meta flex items-center">
                                        <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                        {{ $post->formatted_published_at }}
                                    </span>
                                </div>
                                
                                <h2 class="text-2xl font-display font-bold mb-4 line-clamp-2 leading-tight">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-primary-600 transition-colors duration-200">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                
                                <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">{{ $post->excerpt }}</p>
                                
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">SR</span>
                                        </div>
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-900">Shopp Reparos</p>
                                            <p class="text-gray-500">Especialista</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('blog.show', $post->slug) }}" class="group inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold transition-all duration-200">
                                        Ler artigo
                                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="flex justify-center">
                    {{ $posts->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <h3 class="text-2xl font-bold text-gray-700 mb-4">Nenhum artigo encontrado</h3>
                    <p class="text-gray-600">Tente ajustar os filtros ou fazer uma nova busca.</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Posts em Destaque -->
            <div class="featured-posts">
                <div class="flex items-center mb-6">
                    <div class="w-1 h-8 bg-gradient-to-b from-yellow-400 to-orange-500 rounded-full mr-4"></div>
                    <h3 class="text-2xl font-display font-bold text-gray-800">⭐ Artigos em Destaque</h3>
                </div>
                <div class="space-y-4">
                    @foreach($postsDestaque as $index => $destaque)
                        <div class="group flex gap-4 p-4 rounded-2xl hover:bg-white hover:shadow-lg transition-all duration-300 border border-transparent hover:border-gray-100">
                            <div class="relative flex-shrink-0">
                                @if($destaque->featured_image)
                                    <img src="{{ \App\Helpers\BlogHelper::getImageUrl($destaque->featured_image) }}" alt="{{ $destaque->title }}" class="w-20 h-20 object-cover rounded-2xl">
                                @else
                                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center">
                                        <span class="text-white font-bold text-lg">{{ substr($destaque->title, 0, 2) }}</span>
                                    </div>
                                @endif
                                <div class="absolute -top-2 -left-2 bg-yellow-400 text-yellow-900 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">
                                    {{ $index + 1 }}
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-800 line-clamp-2 mb-2 group-hover:text-primary-600 transition-colors">
                                    <a href="{{ route('blog.show', $destaque->slug) }}">
                                        {{ $destaque->title }}
                                    </a>
                                </h4>
                                <div class="flex items-center text-xs text-gray-500 space-x-3">
                                    <span class="flex items-center">
                                        <i class="fas fa-eye mr-1"></i>
                                        {{ $destaque->views }} views
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ $destaque->formatted_published_at }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-arrow-right text-gray-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all duration-200"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Categorias -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center mb-6">
                    <div class="w-1 h-8 bg-gradient-to-b from-blue-400 to-purple-500 rounded-full mr-4"></div>
                    <h3 class="text-2xl font-display font-bold text-gray-800">🏷️ Categorias</h3>
                </div>
                <div class="grid grid-cols-1 gap-3">
                    @foreach($categorias as $categoria)
                        @php
                            $count = \App\Models\Post::published()->byCategory($categoria)->count();
                            $icons = [
                                'hidráulica' => 'fas fa-tint',
                                'elétrica' => 'fas fa-bolt',
                                'ferramentas' => 'fas fa-tools',
                                'dicas' => 'fas fa-lightbulb',
                                'manutenção' => 'fas fa-cogs',
                                'reparo' => 'fas fa-wrench'
                            ];
                            $icon = $icons[strtolower($categoria)] ?? 'fas fa-folder';
                        @endphp
                        <a href="{{ route('blog.categoria', $categoria) }}" class="group flex items-center justify-between p-4 rounded-2xl border border-gray-100 hover:border-primary-200 hover:bg-gradient-to-r hover:from-primary-50 hover:to-purple-50 transition-all duration-300">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-warning-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                    <i class="{{ $icon }} text-white text-sm"></i>
                                </div>
                                <span class="font-medium text-gray-800 group-hover:text-primary-700">{{ ucfirst($categoria) }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="bg-gray-100 group-hover:bg-white text-gray-600 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $count }}
                                </span>
                                <i class="fas fa-arrow-right text-gray-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all duration-200"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <!-- Newsletter Signup -->
                <div class="mt-8 p-6 bg-gradient-to-br from-primary-500 to-warning-500 rounded-2xl text-white">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-envelope text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-bold mb-2">Fique por dentro!</h4>
                        <p class="text-sm opacity-90 mb-4">Receba nossos melhores artigos direto no seu email</p>
                        <form class="space-y-3">
                            <input type="email" placeholder="Seu melhor email" class="w-full px-4 py-3 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-white">
                            <button type="submit" class="w-full bg-white text-primary-600 font-semibold py-3 rounded-xl hover:bg-gray-100 transition-colors">
                                🚀 Quero receber!
                            </button>
                        </form>
                        <p class="text-xs opacity-75 mt-2">Sem spam, apenas conteúdo de qualidade!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Reading progress bar
    const progressBar = document.querySelector('.reading-progress');
    const content = document.querySelector('main');
    
    function updateProgress() {
        const scrollTop = window.scrollY;
        const docHeight = content.offsetHeight - window.innerHeight;
        const scrollPercent = scrollTop / docHeight * 100;
        progressBar.style.width = Math.min(scrollPercent, 100) + '%';
    }
    
    window.addEventListener('scroll', updateProgress);
    
    // Smooth animations on scroll
    const animateElements = document.querySelectorAll('.animate-on-scroll');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    animateElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        observer.observe(el);
    });
    
    // Enhanced search functionality
    const searchInput = document.querySelector('input[name="busca"]');
    const searchForm = document.querySelector('form');
    
    if (searchInput) {
        // Auto-focus on search input when pressing '/' key
        document.addEventListener('keydown', function(e) {
            if (e.key === '/' && e.target !== searchInput) {
                e.preventDefault();
                searchInput.focus();
            }
        });
        
        // Search suggestions (placeholder for future implementation)
        searchInput.addEventListener('input', function() {
            const query = this.value;
            if (query.length > 2) {
                // Add search suggestions logic here
                console.log('Searching for:', query);
            }
        });
    }
    
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const searchTerm = searchInput?.value;
            if (searchTerm && typeof gtag !== 'undefined') {
                gtag('event', 'search', {
                    search_term: searchTerm
                });
            }
            
            // Add loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Buscando...';
                submitBtn.disabled = true;
                
                // Re-enable after form submission
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 2000);
            }
        });
    }
    
    // Floating elements animation
    const floatingElements = document.querySelectorAll('.floating-elements .element');
    floatingElements.forEach((element, index) => {
        element.style.animationDelay = `${index * 2}s`;
    });
    
    // Category hover effects
    const categoryCards = document.querySelectorAll('a[href*="/blog/categoria/"]');
    categoryCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Newsletter form (placeholder)
    const newsletterForm = document.querySelector('form');
    if (newsletterForm && newsletterForm.querySelector('input[type="email"]')) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            if (email) {
                alert('Obrigado! Em breve você receberá nossos melhores conteúdos! 🚀');
                this.reset();
            }
        });
    }
    
    // Post card 3D effect
    const postCards = document.querySelectorAll('.post-card');
    postCards.forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-12px) scale(1.02)`;
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0) scale(1)';
        });
    });
    
    // Stats counter animation
    const statNumbers = document.querySelectorAll('.stat-number');
    const animateCounter = (element, target) => {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 50);
    };
    
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.textContent.replace(/\D/g, ''));
                if (target && !entry.target.dataset.animated) {
                    entry.target.dataset.animated = 'true';
                    animateCounter(entry.target, target);
                }
            }
        });
    });
    
    statNumbers.forEach(stat => {
        if (!stat.textContent.includes('%')) {
            statsObserver.observe(stat);
        }
    });
    
    console.log('🚀 Blog Shopp Reparos carregado com sucesso!');
    console.log('💡 Dica: Pressione "/" para focar na busca!');
});
</script>
@endpush
