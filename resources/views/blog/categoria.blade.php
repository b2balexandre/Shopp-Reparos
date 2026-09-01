@extends('layouts.site')

@section('title', $tituloCategoria . ' - Blog | Shopp Reparos')
@section('description', 'Explore nossos artigos sobre ' . strtolower($tituloCategoria) . '. Dicas práticas, tutoriais e soluções especializadas para seus projetos.')
@section('keywords', strtolower($tituloCategoria) . ', blog, tutoriais, dicas, Shopp Reparos')

@push('styles')
<style>
/* Reading Progress */
.reading-progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #fbbf24);
    z-index: 1000;
    transition: width 0.1s ease;
}

/* Category Hero */
.category-hero {
    background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #fbbf24 100%);
    position: relative;
    overflow: hidden;
    color: white;
    padding: 4rem 0;
    margin-bottom: 0;
}

.category-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="category-grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="%23ffffff" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23category-grain)"/></svg>') repeat;
    opacity: 0.3;
}

.category-hero-content {
    position: relative;
    z-index: 2;
}

.floating-icons {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    z-index: 1;
}

.floating-icon {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255, 255, 255, 0.6);
    animation: float-icon 8s ease-in-out infinite;
}

.floating-icon:nth-child(1) {
    width: 60px; height: 60px; top: 15%; left: 10%; animation-delay: 0s;
}
.floating-icon:nth-child(2) {
    width: 80px; height: 80px; top: 70%; right: 15%; animation-delay: 2s;
}
.floating-icon:nth-child(3) {
    width: 50px; height: 50px; top: 50%; left: 80%; animation-delay: 4s;
}
.floating-icon:nth-child(4) {
    width: 70px; height: 70px; top: 25%; right: 30%; animation-delay: 6s;
}

@keyframes float-icon {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    25% { transform: translateY(-20px) rotate(90deg); }
    50% { transform: translateY(-10px) rotate(180deg); }
    75% { transform: translateY(-30px) rotate(270deg); }
}

/* Breadcrumb */
.breadcrumb {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1.5rem 0;
    margin-bottom: 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.breadcrumb nav {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.breadcrumb a {
    transition: all 0.2s ease;
    padding: 0.5rem 1rem;
    border-radius: 8px;
}

.breadcrumb a:hover {
    background: rgba(59, 130, 246, 0.1);
    transform: translateY(-1px);
}

/* Content Container */
.content-container {
    background: white;
    border-radius: 24px 24px 0 0;
    margin-top: -2rem;
    position: relative;
    z-index: 10;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
    min-height: 60vh;
}

/* Post Cards */
.post-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    overflow: hidden;
    height: 100%;
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.post-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #fbbf24);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.post-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

.post-card:hover::before {
    opacity: 1;
}

.post-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.post-card:hover .post-image {
    transform: scale(1.1);
}

.post-meta {
    font-size: 0.875rem;
    color: #6b7280;
    font-weight: 500;
}

.category-badge {
    background: linear-gradient(135deg, #1e40af, #fbbf24);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

/* Stats Section */
.stats-section {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.9));
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 2rem;
    margin: 2rem 0;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

.stat-item {
    text-align: center;
    padding: 1.5rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 1.75rem;
    font-weight: 800;
    background: linear-gradient(135deg, #3b82f6, #fbbf24);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Filters */
.filters-section {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 20px;
    padding: 2rem;
    margin: 2rem 0;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.filter-button {
    background: white;
    border: 2px solid #e2e8f0;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    transition: all 0.3s ease;
    font-weight: 600;
}

.filter-button:hover, .filter-button.active {
    background: linear-gradient(135deg, #3b82f6, #fbbf24);
    border-color: transparent;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, #3b82f6 0%, #fbbf24 100%);
    border-radius: 24px;
    padding: 3rem 2rem;
    text-align: center;
    color: white;
    margin: 3rem 0;
    position: relative;
    overflow: hidden;
}

.cta-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="cta-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23cta-pattern)"/></svg>') repeat;
    opacity: 0.3;
}

.cta-content {
    position: relative;
    z-index: 2;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

.stagger-1 { animation-delay: 0.1s; }
.stagger-2 { animation-delay: 0.2s; }
.stagger-3 { animation-delay: 0.3s; }
.stagger-4 { animation-delay: 0.4s; }

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .category-hero {
        padding: 4rem 0;
    }
    
    .floating-icon {
        display: none;
    }
    
    .post-card {
        margin-bottom: 2rem;
    }
}
</style>
@endpush

@section('content')
<!-- Reading Progress Bar -->
<div class="reading-progress"></div>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container mx-auto px-4">
        <nav class="text-sm font-medium">
            <a href="{{ route('home') }}" class="text-primary-600 hover:text-primary-800">
                <i class="fas fa-home mr-1"></i>Home
            </a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('blog.index') }}" class="text-primary-600 hover:text-primary-800">
                <i class="fas fa-blog mr-1"></i>Blog
            </a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-700 font-semibold">
                <i class="fas fa-tag mr-1"></i>{{ $tituloCategoria }}
            </span>
        </nav>
    </div>
</div>

<!-- Hero Section -->
<div class="category-hero">
    <!-- Floating Icons -->
    <div class="floating-icons">
        @php
            $categoryIcons = [
                'hidráulica' => 'fas fa-tint',
                'elétrica' => 'fas fa-bolt', 
                'ferramentas' => 'fas fa-tools',
                'dicas' => 'fas fa-lightbulb',
                'manutenção' => 'fas fa-cogs',
                'reparo' => 'fas fa-wrench',
                'pintura' => 'fas fa-paint-brush'
            ];
            $mainIcon = $categoryIcons[strtolower($categoria)] ?? 'fas fa-folder';
        @endphp
        <div class="floating-icon">
            <i class="{{ $mainIcon }} text-2xl"></i>
        </div>
        <div class="floating-icon">
            <i class="fas fa-screwdriver text-xl"></i>
        </div>
        <div class="floating-icon">
            <i class="fas fa-hammer text-lg"></i>
        </div>
        <div class="floating-icon">
            <i class="fas fa-cog text-xl"></i>
        </div>
    </div>
    
    <div class="container mx-auto px-4">
        <div class="category-hero-content text-center">
            <div class="animate-fade-in">
                <!-- Category Icon -->
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white bg-opacity-20 backdrop-blur-sm rounded-full mb-6">
                    <i class="{{ $mainIcon }} text-4xl"></i>
                </div>
                
                <!-- Title -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-black mb-4 leading-tight">
                    <span class="bg-gradient-to-r from-yellow-300 to-orange-400 bg-clip-text text-transparent">{{ $tituloCategoria }}</span>
                </h1>
                
                <!-- Description -->
                <p class="text-lg md:text-xl opacity-90 max-w-3xl mx-auto mb-6 leading-relaxed">
                    🔧 Artigos especializados sobre <strong>{{ strtolower($tituloCategoria) }}</strong>. 
                    Dicas práticas e soluções profissionais!
                </p>
                
                <!-- Stats -->
                <div class="flex flex-wrap justify-center gap-3 mb-6">
                    <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-4 py-2">
                        <span class="text-xs font-semibold">
                            📚 {{ $posts->total() }} Artigo{{ $posts->total() !== 1 ? 's' : '' }}
                        </span>
                    </div>
                    <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-4 py-2">
                        <span class="text-xs font-semibold">
                            👁️ {{ $posts->sum('views') }} Views
                        </span>
                    </div>
                    <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-4 py-2">
                        <span class="text-xs font-semibold">
                            ✨ Especializado
                        </span>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="flex flex-wrap justify-center gap-4">
                    <button onclick="scrollToContent()" class="bg-white bg-opacity-20 backdrop-blur-sm hover:bg-opacity-30 text-white font-semibold px-6 py-3 rounded-full transition-all duration-300 hover:scale-105">
                        <i class="fas fa-arrow-down mr-2"></i>
                        Ver Artigos
                    </button>
                    <a href="{{ route('blog.index') }}" class="bg-white bg-opacity-20 backdrop-blur-sm hover:bg-opacity-30 text-white font-semibold px-6 py-3 rounded-full transition-all duration-300 hover:scale-105">
                        <i class="fas fa-th-large mr-2"></i>
                        Todas as Categorias
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Container -->
<div class="content-container">
    <div class="container mx-auto px-4 py-12">
        <!-- Stats Section -->
        <div class="stats-section">
            <div class="grid grid-cols-4 gap-3">
                <div class="stat-item">
                    <div class="stat-number">{{ $posts->total() }}</div>
                    <div class="text-gray-600 font-medium text-xs">📚 Artigos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $posts->sum('views') }}</div>
                    <div class="text-gray-600 font-medium text-xs">👁️ Views</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $posts->sum('reading_time') }}</div>
                    <div class="text-gray-600 font-medium text-xs">🕰️ Min</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="text-gray-600 font-medium text-xs">✨ Gratuito</div>
                </div>
            </div>
        </div>
        
        @if($posts->count() > 0)
            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($posts as $index => $post)
                    <article class="post-card animate-fade-in-up stagger-{{ ($index % 4) + 1 }}">
                        <div class="relative overflow-hidden">
                            @if($post->featured_image && \App\Helpers\BlogHelper::imageExists($post->featured_image))
                                <img src="{{ \App\Helpers\BlogHelper::getImageUrl($post->featured_image) }}" alt="{{ $post->title }}" class="post-image">
                            @else
                                <div class="post-image bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-br from-transparent to-black opacity-20"></div>
                                    <span class="text-white text-3xl font-black relative z-10">{{ strtoupper(substr($post->title, 0, 2)) }}</span>
                                    <div class="absolute top-4 right-4 bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-2">
                                        <i class="{{ $mainIcon }} text-white text-sm"></i>
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
            <div class="flex justify-center mb-12">
                <div class="bg-white rounded-2xl p-4 shadow-lg border border-gray-100">
                    {{ $posts->links() }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-lg mx-auto">
                    <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-8">
                        <i class="{{ $mainIcon }} text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-3xl font-display font-bold text-gray-700 mb-4">
                        🔍 Ops! Nada encontrado
                    </h3>
                    <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                        Ainda não temos artigos publicados na categoria <strong>{{ $tituloCategoria }}</strong>. 
                        Mas não se preocupe! Temos muito conteúdo incrivel em outras áreas.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('blog.index') }}" class="bg-gradient-to-r from-primary-600 to-purple-600 text-white px-8 py-4 rounded-2xl font-semibold hover:scale-105 transition-all duration-300 shadow-lg">
                            <i class="fas fa-th-large mr-2"></i>
                            Explorar Todas as Categorias
                        </a>
                        <a href="{{ route('home') }}" class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-2xl font-semibold hover:bg-gray-50 hover:scale-105 transition-all duration-300">
                            <i class="fas fa-home mr-2"></i>
                            Voltar ao Início
                        </a>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Related Categories -->
        @if($posts->count() > 0)
        <div class="mt-16">
            <h3 class="text-3xl font-display font-bold text-center mb-12 text-gray-800">
                🎯 Explore Outras Categorias
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @php
                    $allCategories = \App\Models\Post::published()->select('category')->distinct()->pluck('category')->reject(function($cat) use ($categoria) {
                        return strtolower($cat) === strtolower($categoria);
                    })->take(4);
                @endphp
                @foreach($allCategories as $otherCategory)
                    @php
                        $otherIcon = $categoryIcons[strtolower($otherCategory)] ?? 'fas fa-folder';
                        $otherCount = \App\Models\Post::published()->byCategory($otherCategory)->count();
                    @endphp
                    <a href="{{ route('blog.categoria', $otherCategory) }}" class="group bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-200">
                            <i class="{{ $otherIcon }} text-2xl text-white"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2 group-hover:text-primary-600">{{ ucfirst($otherCategory) }}</h4>
                        <p class="text-sm text-gray-600">{{ $otherCount }} artigos</p>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Call to Action -->
        <div class="cta-section">
            <div class="cta-content">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 backdrop-blur-sm rounded-full mb-8">
                    <i class="fas fa-tools text-3xl"></i>
                </div>
                <h3 class="text-4xl font-display font-black mb-6">
                    🚀 Precisa de Ajuda Especializada?
                </h3>
                <p class="text-xl opacity-90 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Nossa equipe de especialistas está pronta para ajudar você com qualquer projeto de <strong>{{ strtolower($tituloCategoria) }}</strong> 
                    ou qualquer outro tipo de reparo e manutenção. Qualidade garantida!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/contato" class="bg-white text-primary-600 px-10 py-4 rounded-2xl font-bold hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-lg">
                        <i class="fas fa-comment-dots mr-3"></i>
                        Entre em Contato
                    </a>
                    <a href="/site/servicos" class="border-2 border-white text-white px-10 py-4 rounded-2xl font-bold hover:bg-white hover:text-primary-600 hover:scale-105 transition-all duration-300">
                        <i class="fas fa-cogs mr-3"></i>
                        Nossos Serviços
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Preciso de ajuda com {{ strtolower($tituloCategoria) }}" class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white px-10 py-4 rounded-2xl font-bold hover:scale-105 transition-all duration-300 shadow-lg gap-3" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Global functions
function scrollToContent() {
    document.querySelector('.content-container').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Reading progress bar
    const progressBar = document.querySelector('.reading-progress');
    
    function updateProgress() {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = scrollTop / docHeight * 100;
        
        if (progressBar) {
            progressBar.style.width = Math.min(scrollPercent, 100) + '%';
        }
    }
    
    window.addEventListener('scroll', updateProgress);
    
    // Floating icons animation
    const floatingIcons = document.querySelectorAll('.floating-icon');
    floatingIcons.forEach((icon, index) => {
        icon.style.animationDelay = `${index * 2}s`;
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
            if (element.textContent.includes('%')) {
                element.textContent = Math.floor(current) + '%';
            } else {
                element.textContent = Math.floor(current);
            }
        }, 50);
    };
    
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const textContent = entry.target.textContent;
                const target = parseInt(textContent.replace(/\D/g, ''));
                if (target && !entry.target.dataset.animated) {
                    entry.target.dataset.animated = 'true';
                    animateCounter(entry.target, target);
                }
            }
        });
    });
    
    statNumbers.forEach(stat => {
        statsObserver.observe(stat);
    });
    
    // Post cards animations
    const postCards = document.querySelectorAll('.post-card');
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    postCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) ${index * 0.1}s`;
        cardObserver.observe(card);
    });
    
    // Enhanced post card 3D effect
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
    
    // Category cards hover effects
    const categoryCards = document.querySelectorAll('a[href*="/blog/categoria/"]');
    categoryCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Enhanced image loading
    const postImages = document.querySelectorAll('.post-image img');
    postImages.forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
        
        if (img.complete) {
            img.style.opacity = '1';
        } else {
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.3s ease';
        }
    });
    
    // Parallax effect for hero section
    const hero = document.querySelector('.category-hero');
    const heroContent = document.querySelector('.category-hero-content');
    
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallax = scrolled * 0.5;
        
        if (hero) {
            hero.style.transform = `translateY(${parallax}px)`;
        }
        if (heroContent) {
            heroContent.style.transform = `translateY(${-parallax * 0.3}px)`;
        }
    });
    
    // Search functionality enhancement
    const searchButtons = document.querySelectorAll('a[href*="search"], a[href*="busca"]');
    searchButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Track search intent
            if (typeof gtag !== 'undefined') {
                gtag('event', 'search_intent', {
                    search_category: '{{ $categoria }}',
                    page_location: window.location.href
                });
            }
        });
    });
    
    // CTA buttons tracking
    const ctaButtons = document.querySelectorAll('.cta-section a');
    ctaButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.textContent.trim();
            if (typeof gtag !== 'undefined') {
                gtag('event', 'cta_click', {
                    event_category: 'Category Page',
                    event_label: action,
                    value: '{{ $categoria }}'
                });
            }
        });
    });
    
    // Analytics tracking
    if (typeof gtag !== 'undefined') {
        gtag('event', 'page_view', {
            page_title: '{{ $tituloCategoria }} - Blog',
            page_location: window.location.href,
            content_group1: 'Blog Category',
            content_group2: '{{ $categoria }}',
            custom_map: {
                dimension1: '{{ $categoria }}',
                dimension2: '{{ $posts->total() }}'
            }
        });
        
        // Track category engagement
        gtag('event', 'category_view', {
            event_category: 'Blog',
            event_label: '{{ $categoria }}',
            value: {{ $posts->total() }}
        });
    }
    
    // Performance monitoring
    if ('performance' in window) {
        window.addEventListener('load', function() {
            setTimeout(function() {
                const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
                console.log(`🚀 Página da categoria "{{ $tituloCategoria }}" carregada em ${loadTime}ms`);
                
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'timing_complete', {
                        name: 'category_load',
                        value: loadTime
                    });
                }
            }, 0);
        });
    }
    
    console.log('🏷️ Categoria {{ $tituloCategoria }} carregada com sucesso!');
    console.log(`📚 {{ $posts->total() }} artigos disponíveis`);
    console.log(`👁️ {{ $posts->sum('views') }} visualizações totais`);
});
</script>
@endpush
