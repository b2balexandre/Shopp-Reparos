@extends('layouts.site')

@section('title', 'Ferragens e Materiais Hidráulicos em Águas Claras e Taguatinga | Shopp Reparos')
@section('description', 'Loja de ferragens, materiais hidráulicos, peças para obra e itens de manutenção em Águas Claras, Taguatinga e Brasília. Atendimento especializado e qualidade garantida.')
@section('keywords', 'ferragens águas claras, ferragens taguatinga, materiais hidráulicos brasília, loja de hidráulica df, peças para obra taguatinga, materiais de construção águas claras')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/paginacao.css') }}">
<style>
/* Reset e base */
* {
    box-sizing: border-box;
}

/* Hero section premium */
.products-hero {
    background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 30%, #3b82f6 70%, #fbbf24 100%);
    position: relative;
    overflow: hidden;
    color: white;
    padding: 4rem 0;
    margin-bottom: 0;
}

.products-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="products-pattern" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="75" r="1.5" fill="%23fbbf24" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23products-pattern)"/></svg>') repeat;
    opacity: 0.4;
}

.products-hero::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #fbbf24, #f59e0b, #d97706);
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

/* Filter Container */
.filter-container {
    background: linear-gradient(145deg, #f8fafc, #e2e8f0);
    padding: 1.5rem;
    border-radius: 16px;
    border: 1px solid rgba(59, 130, 246, 0.1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
}

.filter-select {
    width: 100%;
    min-width: 200px;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 500;
    background: white;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.filter-select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Product Cards */
.product-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    overflow: hidden;
    height: 100%;
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.2);
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
}

.product-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #1e40af, #3b82f6, #fbbf24);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.product-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    text-decoration: none;
    color: inherit;
}

.product-card:hover::before {
    opacity: 1;
}

.product-image {
    position: relative;
    padding: 1.5rem;
    background: linear-gradient(145deg, #f8fafc, #e2e8f0);
    overflow: hidden;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-info {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.product-category {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    color: #1e40af;
    padding: 0.5rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    width: fit-content;
}

.product-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    line-height: 1.3;
    margin: 0;
    min-height: 3rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-price {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid #f3f4f6;
}

.price-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: #16a34a;
    letter-spacing: -0.5px;
}

.product-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    color: #3b82f6;
    font-weight: 600;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid #f3f4f6;
}

.product-status {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #6b7280;
}

.product-status i {
    color: #10b981;
}

.view-button {
    background: linear-gradient(90deg, #1e40af, #3b82f6);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.view-button:hover {
    transform: scale(1.05);
    color: white;
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
}

/* Grid responsivo */
#produtos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin: 0;
    padding: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .products-hero {
        padding: 2.5rem 0;
    }
    
    .products-hero h1 {
        font-size: 2.5rem !important;
    }
    
    .content-container {
        margin-top: -1rem;
        border-radius: 16px 16px 0 0;
    }
    
    .filter-container {
        padding: 1rem;
    }
    
    .filter-select {
        min-width: auto;
    }
    
    #produtos-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 480px) {
    .products-hero h1 {
        font-size: 2rem !important;
    }
    
    .product-info {
        padding: 1rem;
    }
    
    #produtos-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

/* Loading states */
.product-card.loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Animation enhancements */
@media (prefers-reduced-motion: no-preference) {
    .product-card {
        animation: fadeInUp 0.6s ease-out;
    }
    
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
}

/* No results styling */
#no-results {
    text-align: center;
    padding: 3rem 1rem;
    display: none;
    grid-column: 1 / -1;
}

#no-results.show {
    display: block;
}

#no-results .w-20 {
    background: #f8fafc;
    border: 2px dashed #cbd5e1;
}

#no-results h3 {
    color: #475569;
    font-weight: 600;
}

#no-results p {
    color: #64748b;
}

#no-results button {
    background: linear-gradient(90deg, #1e40af, #3b82f6);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
}

#no-results button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
}
</style>
@endpush

@section('content')
<!-- Hero Section Premium -->
<div class="products-hero">
    <div class="max-w-6xl mx-auto px-4 text-center relative z-10">
        <div class="mb-6">
            <div class="inline-flex items-center gap-2 bg-white bg-opacity-20 backdrop-blur-sm px-4 py-2 rounded-full text-white/90 text-sm font-medium mb-4">
                <i class="fas fa-shopping-cart"></i>
                <span>Nossos Produtos</span>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-4 drop-shadow-lg font-display">
                Ferragens e Materiais Hidráulicos em Brasília
            </h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                Encontre ferragens, materiais hidráulicos e <span class="text-yellow-300 font-bold">peças para obra</span> em Águas Claras, Taguatinga e Brasília com garantia e atendimento especializado.
            </p>
        </div>

        <div class="mt-6 text-center">
            <p class="text-white/90 text-base md:text-lg max-w-3xl mx-auto">
                Loja de materiais para construção e hidráulica com variedade para reforma, manutenção residencial e projetos comerciais.
            </p>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-8">
            <div class="text-center">
                <div class="text-2xl md:text-3xl font-bold text-yellow-300">{{ count($produtos) }}+</div>
                <div class="text-white/80 text-sm">Produtos</div>
            </div>
            <div class="text-center">
                <div class="text-2xl md:text-3xl font-bold text-yellow-300">100%</div>
                <div class="text-white/80 text-sm">Garantia</div>
            </div>
            <div class="text-center">
                <div class="text-2xl md:text-3xl font-bold text-yellow-300">24h</div>
                <div class="text-white/80 text-sm">Atendimento</div>
            </div>
            <div class="text-center">
                <div class="text-2xl md:text-3xl font-bold text-yellow-300">2</div>
                <div class="text-white/80 text-sm">Lojas</div>
            </div>
        </div>
    </div>
</div>

<!-- Content Container -->
<div class="content-container">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <!-- Filtros -->
        @php
            $todasCategorias = collect($produtos->items())->map(fn($p) => optional($p->categoria)->nome)->filter()->unique()->sort()->values();
        @endphp
        
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row gap-6 items-start lg:items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Ferragens e Materiais Hidráulicos</h2>
                    <p class="text-gray-600">Produtos para obra, reforma e manutenção em Águas Claras, Taguatinga e Brasília.</p>
                </div>
                
                <!-- Filtro de Categoria -->
                <div class="filter-container">
                    <label for="categoria-filter" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-filter mr-2"></i>Filtrar por categoria
                    </label>
                    <select id="categoria-filter" class="filter-select">
                        <option value="">Todas as categorias</option>
                        @foreach($todasCategorias as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

       <!-- Grid de Produtos -->
<div id="produtos-grid">
    @foreach($produtos as $produto)
        <div class="product-card"
             data-categoria="{{ optional($produto->categoria)->nome }}"
             data-nome="{{ strtolower($produto->nome) }}">
            
            <!-- Product Image -->
            <div class="product-image">
                @if($produto->imagem)
                    <img src="{{ asset('storage/' . ltrim($produto->imagem,'/')) }}"
                         alt="{{ $produto->nome }}"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="text-4xl text-gray-300 hidden">
                        <i class="fas fa-box-open"></i>
                    </div>
                @else
                    <div class="text-4xl text-gray-300">
                        <i class="fas fa-box-open"></i>
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="product-info">
                @if(optional($produto->categoria)->nome)
                    <span class="product-category">
                        <i class="fas fa-tag"></i>
                        {{ $produto->categoria->nome }}
                    </span>
                @endif

                <h3 class="product-title">{{ $produto->nome }}</h3>

                @if($produto->preco)
                    <div class="product-price">
                        <span class="text-sm text-gray-500">Preço</span>
                        <span class="price-value">
                            R$ {{ number_format((float)$produto->preco, 2, ',', '.') }}
                        </span>
                    </div>
                @endif

                <div class="product-footer">
                    <div class="product-status">
                        <i class="fas fa-check-circle"></i>
                        <span>Disponível</span>
                    </div>
                    <a href="/site/produtos/{{ $produto->id }}-{{ $produto->slug }}" class="view-button">
                        <i class="fas fa-eye"></i> Ver detalhes
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>


        <!-- Paginação -->
        @if($produtos->hasPages())
            <div class="paginacao-container">
                <div class="paginacao-info">
                    <span>Mostrando {{ $produtos->firstItem() ?? 0 }} a {{ $produtos->lastItem() ?? 0 }} de {{ $produtos->total() }} produtos</span>
                </div>
                
                <div class="paginacao-links">
                    {{-- Botão Anterior --}}
                    @if($produtos->onFirstPage())
                        <span class="paginacao-item paginacao-disabled">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $produtos->previousPageUrl() }}" class="paginacao-item paginacao-prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Números das Páginas --}}
                    @foreach($produtos->getUrlRange(1, $produtos->lastPage()) as $page => $url)
                        @if($page == $produtos->currentPage())
                            <span class="paginacao-item paginacao-ativa">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="paginacao-item">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Botão Próximo --}}
                    @if($produtos->hasMorePages())
                        <a href="{{ $produtos->nextPageUrl() }}" class="paginacao-item paginacao-next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="paginacao-item paginacao-disabled">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        @endif

        <!-- No Results -->
        <div id="no-results">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-search text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-700 mb-2">Nenhum produto encontrado</h3>
            <p class="text-gray-600 mb-3">Tente ajustar os filtros ou fazer uma nova busca.</p>
            <button onclick="clearFilters()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                Limpar Filtros
            </button>
        </div>
    </div>
</div>
@endsection

@push('meta')
    <title>Produtos em Águas Claras, Taguatinga Sul e Norte | {{ config('app.name', 'ShopPreparos') }}</title>
    <meta name="description" content="Confira nossa seleção de produtos em Águas Claras, Taguatinga Sul e Norte. Preços, categorias e ofertas para toda a região!">
    <meta property="og:title" content="Produtos em Águas Claras, Taguatinga Sul e Norte" />
    <meta property="og:description" content="Produtos para Águas Claras, Taguatinga Sul e Norte. Veja preços, categorias e ofertas!" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="robots" content="index, follow">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "ItemList",
      "name": "Produtos em Águas Claras, Taguatinga Sul e Norte",
      "itemListElement": [
        @foreach($produtos as $i => $produto)
        {
          "@type": "Product",
          "position": {{ $i+1 }},
          "name": "{{ $produto->nome }}",
          "image": "{{ $produto->imagem ? asset('storage/' . ltrim($produto->imagem, '/')) : asset('img/logo.png') }}",
          "url": "{{ url('/site/produtos/' . $produto->id) }}",
          "category": "{{ optional($produto->categoria)->nome }}",
          "offers": {
            "@type": "Offer",
            "priceCurrency": "BRL",
            "price": "{{ $produto->preco ?? '0.00' }}",
            "availability": "https://schema.org/InStock"
          },
          "areaServed": ["Águas Claras", "Taguatinga Sul", "Taguatinga Norte"]
        }@if(!$loop->last),@endif
        @endforeach
      ]
    }
    </script>
@endpush

@push('scripts')
<script>
function clearFilters() {
    document.getElementById('categoria-filter').value = '';
    filterProducts();
}

function filterProducts() {
    const categoria = document.getElementById('categoria-filter').value;
    const products = document.querySelectorAll('.product-card');
    const noResults = document.getElementById('no-results');
    let visibleCount = 0;

    products.forEach((product, index) => {
        const productCategoria = product.dataset.categoria || '';
        const matchesCategoria = !categoria || productCategoria === categoria;
        
        if (matchesCategoria) {
            product.style.display = 'block';
            product.style.opacity = '0';
            product.style.transform = 'translateY(10px)';
            
            setTimeout(() => {
                product.style.opacity = '1';
                product.style.transform = 'translateY(0)';
            }, index * 30);
            
            visibleCount++;
        } else {
            product.style.display = 'none';
        }
    });

    if (visibleCount === 0) {
        noResults.classList.add('show');
    } else {
        noResults.classList.remove('show');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const categoriaFilter = document.getElementById('categoria-filter');
    
    categoriaFilter.addEventListener('change', filterProducts);
    
    console.log('🛍️ Página de Produtos carregada com sucesso!');
    console.log(`📦 ${document.querySelectorAll('.product-card').length} produtos disponíveis`);
});
</script>
@endpush
