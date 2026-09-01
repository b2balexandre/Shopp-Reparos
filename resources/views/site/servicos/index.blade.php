@extends('layouts.site')

@section('title', 'Reparos Hidráulicos e Elétricos em Brasília | Shopp Reparos')
@section('description', 'Assistência técnica Docol, reparos hidráulicos e manutenção elétrica em Águas Claras, Taguatinga e Brasília. Qualidade, garantia e atendimento rápido.')
@section('keywords', 'reparos hidráulicos águas claras, reparos hidráulicos taguatinga, assistência técnica docol, manutenção elétrica brasília, hidráulica df, serviços de manutenção brasília')

@section('content')
<!-- Hero Section Premium -->
<div class="services-hero">
    <div class="max-w-6xl mx-auto px-4 text-center relative z-10">
        <div class="mb-6">
            <div class="inline-flex items-center gap-2 bg-white bg-opacity-20 backdrop-blur-sm px-4 py-2 rounded-full text-white/90 text-sm font-medium mb-4">
                <i class="fas fa-tools"></i>
                <span>Nossos Serviços</span>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-4 drop-shadow-lg font-display">
                Serviços de Reparos Hidráulicos e Elétricos
            </h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                Soluções completas em <span class="text-yellow-300 font-bold">reparos hidráulicos, manutenção elétrica e assistência técnica Docol</span> em Brasília, Águas Claras e Taguatinga.
            </p>
        </div>

        <div class="mt-6 text-center">
            <p class="text-white/90 text-base md:text-lg max-w-3xl mx-auto">
                Atendimento rápido para casa, obra e empresa, com garantia, peças originais e suporte técnico especializado.
            </p>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-8">
            <div class="text-center">
                <div class="text-2xl md:text-3xl font-bold text-yellow-300">{{ count($servicos) }}+</div>
                <div class="text-white/80 text-sm">Serviços</div>
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
            $todasMarcas = collect($servicos)->pluck('marca')->filter()->map(fn($m) => trim($m))->unique()->sort()->values();
        @endphp
        
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row gap-6 items-start lg:items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Serviços em Águas Claras, Taguatinga e Brasília</h2>
                    <p class="text-gray-600">Reparos hidráulicos, manutenção elétrica e assistência técnica Docol para sua casa, obra ou empresa.</p>
                </div>
                
                <!-- Filtro de Marca -->
                <div class="filter-container">
                    <label for="marca" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-filter mr-2"></i>Filtrar por marca
                    </label>
                    <select id="marca" class="filter-select">
                        <option value="">Todas as marcas</option>
                        @foreach($todasMarcas as $marca)
                            <option value="{{ $marca }}">{{ $marca }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Grid de Serviços -->
        <p class="text-center text-gray-600 max-w-4xl mx-auto mt-2 mb-6 text-sm md:text-base">
            Atendimento especializado em assistência técnica Docol, reparos hidráulicos em Taguatinga, manutenção em Águas Claras e soluções para obra em Brasília.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-auto max-w-6xl" id="servicos-lista">
            @foreach($servicos as $servico)
                <a href="/site/servicos/{{ $servico->id }}-{{ $servico->slug }}" 
                   class="service-card servico-card-item group" 
                   data-marca="{{ $servico->marca }}">
                    <div class="service-card-image">
                        @if($servico->imagem)
                            <img src="{{ asset('storage/servicos/' . $servico->imagem) }}" 
                                 alt="{{ $servico->titulo }}" 
                                 class="w-full h-48 object-contain transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tools text-4xl text-gray-400"></i>
                            </div>
                        @endif
                        
                        <!-- Overlay -->
                        <div class="service-card-overlay">
                            <div class="bg-white/90 backdrop-blur-sm rounded-full p-3">
                                <i class="fas fa-arrow-right text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="service-card-content">
                        <h3 class="service-card-title">{{ $servico->titulo }}</h3>
                        
                        @if($servico->marca)
                            <div class="service-card-brand">
                                <i class="fas fa-tag"></i>
                                {{ $servico->marca }}
                            </div>
                        @endif
                        
                        <p class="service-card-description">
                            {{ Str::limit($servico->descricao, 80) }}
                        </p>
                        
                        @if($servico->valor_estimado)
                            <div class="service-card-price">
                                <span class="text-sm text-gray-500">A partir de</span>
                                <span class="price-value">R$ {{ number_format((float) $servico->valor_estimado, 2, ',', '.') }}</span>
                            </div>
                        @endif
                        
                        <div class="service-card-action">
                            <span class="action-text">Ver detalhes</span>
                            <i class="fas fa-chevron-right action-icon"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        <!-- Paginação -->
        @if($servicos->hasPages())
            <div class="paginacao-container">
                <div class="paginacao-info">
                    <span>Mostrando {{ $servicos->firstItem() ?? 0 }} a {{ $servicos->lastItem() ?? 0 }} de {{ $servicos->total() }} serviços</span>
                </div>
                
                <div class="paginacao-links">
                    {{-- Botão Anterior --}}
                    @if($servicos->onFirstPage())
                        <span class="paginacao-item paginacao-disabled">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $servicos->previousPageUrl() }}" class="paginacao-item paginacao-prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Números das Páginas --}}
                    @foreach($servicos->getUrlRange(1, $servicos->lastPage()) as $page => $url)
                        @if($page == $servicos->currentPage())
                            <span class="paginacao-item paginacao-ativa">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="paginacao-item">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Botão Próximo --}}
                    @if($servicos->hasMorePages())
                        <a href="{{ $servicos->nextPageUrl() }}" class="paginacao-item paginacao-next">
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
        
        @if(count($servicos) === 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 py-10">
                @foreach([
                    ['titulo' => 'Reparos Hidráulicos', 'descricao' => 'Vazamentos, troca de torneiras, instalação e manutenção hidráulica residencial e predial.', 'icone' => 'fas fa-water'],
                    ['titulo' => 'Serviços Elétricos', 'descricao' => 'Instalações, manutenção e soluções para pontos elétricos e pequenos reparos domésticos.', 'icone' => 'fas fa-bolt'],
                    ['titulo' => 'Instalação de Chuveiros', 'descricao' => 'Instalação e substituição com segurança e atendimento rápido para sua rotina.', 'icone' => 'fas fa-shower'],
                    ['titulo' => 'Troca de Torneiras', 'descricao' => 'Troca profissional de torneiras e peças para melhorar conforto e evitar vazamentos.', 'icone' => 'fas fa-faucet'],
                    ['titulo' => 'Manutenção Predial', 'descricao' => 'Atendimentos para condomínios, reformas e pequenas manutenções de rotina.', 'icone' => 'fas fa-building'],
                    ['titulo' => 'Pequenos Reparos', 'descricao' => 'Suporte imediato para ajustes, instalações e melhorias em casa e empresa.', 'icone' => 'fas fa-wrench']
                ] as $servico)
                    <div class="bg-white rounded-3xl border border-blue-100 shadow-lg p-6 text-center hover:-translate-y-1 transition-transform duration-200">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-2xl">
                            <i class="{{ $servico['icone'] }}"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $servico['titulo'] }}</h3>
                        <p class="text-gray-600 mb-5 leading-relaxed">{{ $servico['descricao'] }}</p>
                        <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Gostaria de solicitar um orçamento para {{ $servico['titulo'] }}." target="_blank" class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-3 rounded-full transition-colors duration-200">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Solicitar orçamento
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('marca');
        const cards = document.querySelectorAll('.servico-card-item');
        
        select.addEventListener('change', function() {
            const marca = this.value;
            let visibleCount = 0;
            
            cards.forEach((card, index) => {
                const cardMarca = card.getAttribute('data-marca');
                if (!marca || cardMarca === marca) {
                    card.style.display = '';
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(10px)';
                    
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 30);
                    
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Mostrar mensagem se não houver serviços
            if (visibleCount === 0 && marca) {
                showNoServicesMessage(marca);
            } else {
                hideNoServicesMessage();
            }
        });
        
        function showNoServicesMessage(marca) {
            let message = document.getElementById('no-services-message');
            if (!message) {
                message = document.createElement('div');
                message.id = 'no-services-message';
                message.className = 'text-center py-16 col-span-full';
                message.innerHTML = `
                    <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Nenhum serviço encontrado</h3>
                    <p class="text-gray-500 mb-3">Não encontramos serviços da marca "${marca}".</p>
                    <button onclick="clearServiceFilter()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                        Limpar Filtro
                    </button>
                `;
                document.getElementById('servicos-lista').appendChild(message);
            }
        }
        
        function hideNoServicesMessage() {
            const message = document.getElementById('no-services-message');
            if (message) {
                message.remove();
            }
        }
        
        // Função global para limpar filtro
        window.clearServiceFilter = function() {
            document.getElementById('marca').value = '';
            select.dispatchEvent(new Event('change'));
        };
        
        console.log('🛠️ Página de Serviços carregada com sucesso!');
        console.log(`🔧 ${document.querySelectorAll('.service-card').length} serviços disponíveis`);
    });
</script>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/paginacao.css') }}">
<link rel="stylesheet" href="{{ asset('css/servicos-fix.css') }}">
<style>
/* Hero Section */
.services-hero {
    background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 30%, #3b82f6 70%, #fbbf24 100%);
    position: relative;
    overflow: hidden;
    color: white;
    padding: 4rem 0;
    margin-bottom: 0;
}

.services-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="services-pattern" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="75" r="1.5" fill="%23fbbf24" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23services-pattern)"/></svg>') repeat;
    opacity: 0.4;
}

.services-hero::after {
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

/* Service Cards - Corrigido para evitar corte */
.service-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    overflow: visible; /* Corrigido para evitar corte */
    height: auto; /* Altura automática */
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.2);
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    min-height: 480px; /* Altura mínima aumentada */
}

.service-card::before {
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

.service-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    text-decoration: none;
    color: inherit;
    z-index: 10; /* Elevar no hover para evitar corte */
}

.service-card:hover::before {
    opacity: 1;
}

.service-card-image {
    position: relative;
    padding: 1.5rem;
    background: linear-gradient(145deg, #f8fafc, #e2e8f0);
    overflow: hidden; /* Apenas na imagem */
    flex-shrink: 0; /* Impede que a imagem encolha */
    height: 200px; /* Altura fixa para a imagem */
    min-height: 200px;
    max-height: 200px;
    border-radius: 20px 20px 0 0;
}

.service-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(251, 191, 36, 0.1));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
    backdrop-filter: blur(2px);
}

.service-card:hover .service-card-overlay {
    opacity: 1;
}

.service-card-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    min-height: 200px; /* Altura mínima para o conteúdo */
    justify-content: space-between; /* Distribui o espaço uniformemente */
}

.service-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    line-height: 1.4;
    margin: 0;
    min-height: 3.5rem; /* Altura mínima para o título */
    max-height: 3.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    word-wrap: break-word;
    hyphens: auto;
}

.service-card-brand {
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
    margin: 0.5rem 0;
}

.service-card-description {
    color: #6b7280;
    font-size: 0.95rem;
    line-height: 1.5;
    margin: 0;
    flex-grow: 1;
    min-height: 3rem; /* Altura mínima para a descrição */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.service-card-price {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid #f3f4f6;
    flex-shrink: 0; /* Impede que o preço encolha */
}

.price-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: #16a34a;
    letter-spacing: -0.5px;
}

.service-card-action {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    color: #3b82f6;
    font-weight: 600;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid #f3f4f6;
    flex-shrink: 0; /* Impede que a ação encolha */
}

.action-text {
    flex-grow: 1;
}

.action-icon {
    transition: transform 0.3s ease;
}

.service-card:hover .action-icon {
    transform: translateX(4px);
}

/* Responsive Design - Corrigido para evitar corte */
@media (max-width: 768px) {
    .services-hero {
        padding: 2.5rem 0;
    }
    
    .services-hero h1 {
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
    
    .service-card {
        min-height: 420px; /* Altura ajustada para mobile */
        overflow: visible; /* Garantir que não corte em mobile */
    }
    
    .service-card-image {
        height: 180px;
        min-height: 180px;
        max-height: 180px;
        padding: 1rem;
    }
    
    .service-card-content {
        padding: 1rem;
        min-height: 180px;
    }
    
    .service-card-title {
        font-size: 1.1rem;
        min-height: 3rem;
        max-height: 3rem;
    }
    
    .service-card-description {
        min-height: 2.5rem;
    }
}

@media (max-width: 640px) {
    .services-hero h1 {
        font-size: 2rem !important;
    }
    
    .service-card {
        min-height: 400px; /* Altura ajustada para mobile pequeno */
        margin: 0 auto;
        max-width: 320px;
    }
    
    .service-card-content {
        padding: 1rem;
        min-height: 160px;
    }
    
    .service-card-title {
        font-size: 1rem;
        min-height: 2.8rem;
        max-height: 2.8rem;
    }
    
    .service-card-description {
        min-height: 2.2rem;
    }
}

@media (max-width: 480px) {
    .services-hero h1 {
        font-size: 2rem !important;
    }
    
    .service-card {
        min-height: 380px; /* Altura ajustada para mobile pequeno */
        margin: 0 10px;
    }
    
    .service-card-content {
        padding: 1rem;
        min-height: 160px;
    }
    
    .service-card-title {
        font-size: 1rem;
        min-height: 2.8rem;
        max-height: 2.8rem;
    }
    
    .service-card-description {
        min-height: 2.2rem;
    }
}

/* Loading states */
.service-card.loading {
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
    .service-card {
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

/* No services message */
#no-services-message {
    grid-column: 1 / -1;
}

#no-services-message .fas {
    background: #f8fafc;
    border: 2px dashed #cbd5e1;
    border-radius: 50%;
    padding: 1rem;
}

#no-services-message h3 {
    color: #475569;
    font-weight: 600;
}

#no-services-message p {
    color: #64748b;
}

#no-services-message button {
    background: linear-gradient(90deg, #1e40af, #3b82f6);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
}

#no-services-message button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
}
</style>
@endpush

@push('meta')
    <title>Serviços em Águas Claras, Taguatinga Sul e Norte | {{ config('app.name', 'ShopPreparos') }}</title>
    <meta name="description" content="Veja nossos serviços em Águas Claras, Taguatinga Sul e Norte. Orçamento, marcas e atendimento especializado para toda a região!">
    <meta property="og:title" content="Serviços em Águas Claras, Taguatinga Sul e Norte" />
    <meta property="og:description" content="Serviços para Águas Claras, Taguatinga Sul e Norte. Orçamento, marcas e atendimento especializado!" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="robots" content="index, follow">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "ItemList",
      "name": "Serviços em Águas Claras, Taguatinga Sul e Norte",
      "itemListElement": [
        @foreach($servicos as $i => $servico)
        {
          "@type": "Service",
          "position": {{ $i+1 }},
          "name": "{{ $servico->titulo }}",
          "image": "{{ $servico->imagem ? asset('storage/servicos/' . $servico->imagem) : asset('img/logo.png') }}",
          "url": "{{ url('/site/servicos/' . $servico->id) }}",
          "provider": {
            "@type": "LocalBusiness",
            "areaServed": ["Águas Claras", "Taguatinga Sul", "Taguatinga Norte"]
          },
          "offers": {
            "@type": "Offer",
            "priceCurrency": "BRL",
            "price": "{{ $servico->valor_estimado ?? '0.00' }}",
            "availability": "https://schema.org/InStock"
          }
        }@if(!$loop->last),@endif
        @endforeach
      ]
    }
    </script>
@endpush
