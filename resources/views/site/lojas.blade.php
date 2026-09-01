@extends('layouts.site')

@push('meta')
    <title>Lojas Shopp Reparos em Águas Claras e Taguatinga | {{ config('app.name', 'ShopPreparos') }}</title>
    <meta name="description" content="Conheça nossas lojas físicas em Águas Claras e Taguatinga. Veja endereço, mapa, fotos e encontre produtos e serviços com filtro por loja.">
    <meta property="og:title" content="Lojas Shopp Reparos em Águas Claras e Taguatinga" />
    <meta property="og:description" content="Endereços, mapas, produtos e serviços das lojas Shopp Reparos. Filtre por loja e encontre tudo para sua necessidade!" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="robots" content="index, follow">
@endpush

@section('content')
<!-- Hero Section Premium -->
<div class="relative w-full min-h-[300px] flex flex-col items-center justify-center mb-12 lojas-hero overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-cyan-500 to-blue-800 opacity-95 z-0"></div>
    <div class="absolute inset-0 bg-black opacity-20 z-1"></div>
    
    <!-- Animated background elements -->
    <div class="absolute inset-0 overflow-hidden z-2">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white opacity-5 rounded-full animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-cyan-300 opacity-10 rounded-full animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/3 w-48 h-48 bg-blue-300 opacity-5 rounded-full animate-float" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="relative z-10 flex flex-col items-center justify-center py-12 px-4 text-center max-w-6xl mx-auto">
        <!-- Badge de destaque -->
        <div class="badge-premium text-black px-6 py-2 rounded-full text-sm font-bold mb-4 shadow-lg">
            🏪 NOSSAS LOJAS FÍSICAS
        </div>
        
        <img src="{{ asset('img/logohorizontal.png') }}" alt="Shopp Reparos" class="w-32 h-16 mb-6 drop-shadow-2xl animate-scale-in object-contain">
        
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-4 drop-shadow-lg font-display tracking-tight">
            Nossas Lojas
        </h1>
        
        <p class="text-xl sm:text-2xl text-cyan-100 font-medium mb-6 max-w-4xl mx-auto drop-shadow leading-relaxed">
            Visite nossas <span class="text-yellow-300 font-bold">lojas físicas</span> em <span class="text-yellow-300 font-bold">Águas Claras e Taguatinga</span> para conhecer nossos produtos, serviços e equipe especializada.
        </p>
        
        <!-- CTAs principais -->
        <div class="flex flex-col sm:flex-row gap-4 items-center">
            <a href="#nossas-lojas" class="inline-block bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-4 px-8 rounded-full shadow-xl text-lg transition-all duration-300 transform hover:scale-105 animate-scale-in flex items-center gap-2">
                <i class="fas fa-map-marker-alt"></i>
                Ver Nossas Lojas
            </a>
            <a href="/contato" 
               class="inline-block bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-4 px-8 rounded-full shadow-xl text-lg transition-all duration-300 transform hover:scale-105 animate-scale-in flex items-center gap-2">
                <i class="fas fa-phone-alt"></i>
                Falar Conosco
            </a>
        </div>
    </div>
</div>

<!-- Seção das Lojas -->
<div id="nossas-lojas" class="bg-white py-16 shadow-lg relative overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4 font-display">
                🏪 Nossas Lojas Físicas
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Visite nossas lojas para conhecer pessoalmente nossos produtos, serviços e equipe especializada
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-5xl mx-auto">
            <!-- Loja Águas Claras -->
            <div class="loja-card group bg-gradient-to-br from-blue-50 to-cyan-50 rounded-3xl shadow-2xl p-8 border-2 border-blue-100 hover:border-blue-300 transition-all duration-500 transform hover:-translate-y-4">
                <div class="text-center mb-6">
                    <div class="relative mb-4">
                        <div class="absolute inset-0 bg-blue-400 rounded-full opacity-20 blur-xl transform group-hover:scale-110 transition-transform duration-500"></div>
                        <img src="{{ asset('img/Lojas/aguasclaras.webp') }}" alt="Loja Águas Claras" class="loja-imagem relative w-full h-64 object-cover rounded-2xl shadow-xl">
                    </div>
                    <h3 class="text-3xl font-extrabold text-blue-800 mb-2">Águas Claras</h3>
                    <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-bold mb-3 inline-block">
                        🏆 LOJA PRINCIPAL
                    </div>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-center gap-3 text-gray-700">
                        <i class="fas fa-map-marker-alt text-blue-600 text-lg w-5"></i>
                        <span class="font-medium">Q 204 Alfa Mix Loja 15A - Águas Claras, Brasília</span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-700">
                        <i class="fas fa-clock text-blue-600 text-lg w-5"></i>
                        <span class="font-medium">Segunda a Sexta: 8h às 18h | Sábado: 8h às 12h</span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-700">
                        <i class="fas fa-phone text-blue-600 text-lg w-5"></i>
                        <span class="font-medium">(61) 99609-6296</span>
                    </div>
                </div>
                
                <!-- Mapa -->
                <div class="mb-6">
                    <iframe 
                        src="https://www.google.com/maps?q=Q%20204%20Alfa%20Mix%20Loja%2015A%2C%20%C3%81guas%20Claras%2C%20Bras%C3%ADlia%20-%20DF%2C%2071939-540&output=embed" 
                        width="100%" 
                        height="200" 
                        style="border:0;border-radius:16px;" 
                        allowfullscreen="" 
                        loading="lazy"
                        class="shadow-lg">
                    </iframe>
                </div>
                
                <!-- CTA da loja -->
                <div class="text-center">
                    <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Gostaria de visitar a loja de Águas Claras!" 
                       class="inline-flex items-center justify-center bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 px-6 rounded-full shadow-lg text-lg transition-all duration-300 transform hover:scale-105 gap-2 mx-auto">
                        <i class="fab fa-whatsapp"></i>
                        <span>Falar com Águas Claras</span>
                    </a>
                </div>
            </div>
            
            <!-- Loja Taguatinga -->
            <div class="loja-card group bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl shadow-2xl p-8 border-2 border-green-100 hover:border-green-300 transition-all duration-500 transform hover:-translate-y-4">
                <div class="text-center mb-6">
                    <div class="relative mb-4">
                        <div class="absolute inset-0 bg-green-400 rounded-full opacity-20 blur-xl transform group-hover:scale-110 transition-transform duration-500"></div>
                        <img src="{{ asset('img/Lojas/taguatinga.webp') }}" alt="Loja Taguatinga" class="loja-imagem relative w-full h-64 object-cover rounded-2xl shadow-xl">
                    </div>
                    <h3 class="text-3xl font-extrabold text-green-800 mb-2">Taguatinga</h3>
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-bold mb-3 inline-block">
                        🚀 LOJA EXPANSÃO
                    </div>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-center gap-3 text-gray-700">
                        <i class="fas fa-map-marker-alt text-green-600 text-lg w-5"></i>
                        <span class="font-medium">St. E Sul CSE 2 - Taguatinga Sul, Brasília</span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-700">
                        <i class="fas fa-clock text-green-600 text-lg w-5"></i>
                        <span class="font-medium">Segunda a Sexta: 8h às 18h | Sábado: 8h às 12h</span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-700">
                        <i class="fas fa-phone text-green-600 text-lg w-5"></i>
                        <span class="font-medium">(61) 99931-8077</span>
                    </div>
                </div>
                
                <!-- Mapa -->
                <div class="mb-6">
                    <iframe 
                        src="https://www.google.com/maps?q=St.%20E%20Sul%20CSE%202%20-%20Taguatinga%20Sul%2C%20Bras%C3%ADlia%20-%20DF%2C%2072025-025&output=embed" 
                        width="100%" 
                        height="200" 
                        style="border:0;border-radius:16px;" 
                        allowfullscreen="" 
                        loading="lazy"
                        class="shadow-lg">
                    </iframe>
                </div>
                
                <!-- CTA da loja -->
                <div class="text-center">
                    <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Gostaria de visitar a loja de Taguatinga!" 
                       class="inline-flex items-center justify-center bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 px-6 rounded-full shadow-lg text-lg transition-all duration-300 transform hover:scale-105 gap-2 mx-auto">
                        <i class="fab fa-whatsapp"></i>
                        <span>Falar com Taguatinga</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Badge de diferencial -->
        <div class="text-center mt-12">
            <div class="inline-flex items-center gap-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-black px-8 py-4 rounded-full font-bold shadow-lg">
                <i class="fas fa-star text-lg"></i>
                <span>Atendimento Personalizado • Produtos de Qualidade • Serviços Especializados</span>
            </div>
        </div>
    </div>
</div>

<!-- Seção de Filtros e Produtos/Serviços -->
<div class="bg-gradient-to-r from-gray-50 to-blue-50 py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4 font-display">
                Produtos e Serviços por Loja
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Filtre por loja e tipo para encontrar exatamente o que você precisa
            </p>
        </div>
        
        <!-- Filtros -->
        <div class="flex flex-col md:flex-row gap-6 justify-center mb-8">
            <div class="filtro-container">
                <label for="filtro-loja" class="block text-sm font-semibold text-gray-700 mb-2">Selecione a Loja</label>
                <select id="filtro-loja" class="filtro-select">
                    <option value="">Todas as Lojas</option>
                    <option value="aguas">Águas Claras</option>
                    <option value="tagua">Taguatinga</option>
                </select>
            </div>
            
            <div class="filtro-container">
                <label for="filtro-tipo" class="block text-sm font-semibold text-gray-700 mb-2">Tipo de Item</label>
                <select id="filtro-tipo" class="filtro-select">
                    <option value="">Produtos e Serviços</option>
                    <option value="produto">Produtos</option>
                    <option value="servico">Serviços</option>
                </select>
            </div>
        </div>
        
        <!-- Grid de Produtos e Serviços -->
        <div id="loja-lista" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach(App\Models\Produto::all() as $produto)
                <div class="loja-card" data-loja="aguas" data-tipo="produto">
                    <div class="produto-card bg-white rounded-2xl shadow-xl p-6 border border-gray-100 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                        <div class="text-center mb-4">
                            <div class="relative mb-4">
                                <img src="{{ $produto->imagem ? asset('storage/produtos/' . $produto->imagem) : asset('img/logo.png') }}" 
                                     alt="{{ $produto->nome }}" 
                                     class="w-24 h-24 object-contain mx-auto rounded-xl shadow-lg">
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $produto->nome }}</h3>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ Str::limit($produto->descricao, 80) }}</p>
                        </div>
                        
                        <div class="text-center">
                            <a href="/site/produtos/{{ $produto->id }}-{{ $produto->slug }}" 
                               class="inline-block bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 w-full">
                                Ver Produto
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            
            @foreach(App\Models\Servico::where('ativo', 1)->get() as $servico)
                <div class="loja-card" data-loja="tagua" data-tipo="servico">
                    <div class="servico-card bg-white rounded-2xl shadow-xl p-6 border border-gray-100 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                        <div class="text-center mb-4">
                            <div class="relative mb-4">
                                <img src="{{ $servico->imagem ? asset('storage/servicos/' . $servico->imagem) : asset('img/logo.png') }}" 
                                     alt="{{ $servico->titulo }}" 
                                     class="w-24 h-24 object-contain mx-auto rounded-xl shadow-lg">
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $servico->titulo }}</h3>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ Str::limit($servico->descricao, 80) }}</p>
                        </div>
                        
                        <div class="text-center">
                            <a href="/site/servicos/{{ $servico->id }}-{{ $servico->slug }}" 
                               class="inline-block bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 w-full">
                                Ver Serviço
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Mensagem quando não há resultados -->
        <div id="sem-resultados" class="hidden text-center py-12">
            <div class="bg-white rounded-2xl shadow-xl p-8 max-w-md mx-auto">
                <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Nenhum resultado encontrado</h3>
                <p class="text-gray-600 mb-4">Tente ajustar os filtros para encontrar o que procura</p>
                <button onclick="limparFiltros()" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-300">
                    Limpar Filtros
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action Final -->
<div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-3xl p-8 md:p-12 text-center text-white shadow-2xl mx-4 mb-8">
    <h2 class="text-3xl lg:text-4xl font-bold mb-4 font-display">
        Visite Nossas Lojas!
    </h2>
    <p class="text-xl mb-8 opacity-90">
        Conheça pessoalmente nossos produtos, serviços e equipe especializada
    </p>
    
    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="#nossas-lojas" class="bg-white text-blue-600 hover:bg-gray-100 font-bold py-4 px-8 rounded-full shadow-lg text-lg transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
            <i class="fas fa-map-marker-alt"></i>
            Ver Nossas Lojas
        </a>
        <a href="/contato" class="bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-8 rounded-full shadow-lg text-lg transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
            <i class="fas fa-phone-alt"></i>
            Falar Conosco
        </a>
    </div>
    
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
        <div class="flex items-center justify-center gap-2 opacity-90">
            <i class="fas fa-clock"></i>
            <span>Horário flexível</span>
        </div>
        <div class="flex items-center justify-center gap-2 opacity-90">
            <i class="fas fa-users"></i>
            <span>Equipe especializada</span>
        </div>
        <div class="flex items-center justify-center gap-2 opacity-90">
            <i class="fas fa-truck"></i>
            <span>Entrega local</span>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .lojas-hero { 
            min-height: 320px; 
            position: relative;
            overflow: hidden;
        }
        
        .lojas-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(34, 211, 238, 0.1) 50%, rgba(59, 130, 246, 0.1) 100%);
            animation: shimmer 3s ease-in-out infinite;
            z-index: 1;
        }
        
        @keyframes shimmer {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.1; }
        }
        
        .lojas-hero img { 
            box-shadow: 0 8px 32px rgba(59, 130, 246, 0.3);
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }
        
        /* Animações personalizadas */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(1deg); }
            66% { transform: translateY(-5px) rotate(-1deg); }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        /* Cards de loja */
        .loja-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .loja-card:hover {
            transform: translateY(-8px) scale(1.02);
        }
        
        /* Imagens das lojas */
        .loja-imagem {
            transition: all 0.5s ease;
            object-fit: cover;
            object-position: center;
            width: 100%;
            height: 24rem;
            border-radius: 1rem;
        }
        
        .loja-card:hover .loja-imagem {
            transform: scale(1.05);
        }
        
        /* Correção para logo horizontal */
        .lojas-hero img {
            width: 8rem;
            height: 4rem;
            object-fit: contain;
            object-position: center;
        }
        
        /* Filtros */
        .filtro-container {
            min-width: 200px;
        }
        
        .filtro-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            color: #374151;
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .filtro-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .filtro-select:hover {
            border-color: #d1d5db;
        }
        
        /* Cards de produtos e serviços */
        .produto-card, .servico-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .produto-card:hover, .servico-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        /* Correção para imagens de produtos e serviços */
        .produto-card img, .servico-card img {
            width: 6rem;
            height: 6rem;
            object-fit: contain;
            object-position: center;
            border-radius: 0.75rem;
        }
        
        /* Badge premium styling */
        .badge-premium {
            background: linear-gradient(135deg, #fbbf24, #f59e0b, #d97706);
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
            animation: pulse-gold 2s ease-in-out infinite;
        }
        
        @keyframes pulse-gold {
            0%, 100% { transform: scale(1); box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4); }
            50% { transform: scale(1.05); box-shadow: 0 6px 20px rgba(251, 191, 36, 0.6); }
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .lojas-hero { 
                min-height: 250px !important; 
                padding: 1rem !important;
            }
            
            .lojas-hero h1 { 
                font-size: 2rem !important; 
                line-height: 1.1 !important;
                margin-bottom: 1rem !important;
            }
            
            .lojas-hero p { 
                font-size: 1rem !important; 
                line-height: 1.4 !important;
                margin-bottom: 1.5rem !important;
            }
            
            .lojas-hero img {
                width: 6rem !important;
                height: 3rem !important;
                margin-bottom: 1rem !important;
            }
            
            .filtro-container {
                min-width: 100% !important;
                margin-bottom: 1rem !important;
            }
            
            .flex-col.md\\:flex-row {
                gap: 1rem !important;
            }
            
            .loja-card {
                padding: 1.5rem !important;
                margin-bottom: 1rem !important;
            }
            
            .loja-imagem {
                height: 8rem !important;
            }
            
            .grid.grid-cols-1.lg\\:grid-cols-2 {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }
            
            .grid.grid-cols-1.sm\\:grid-cols-2.lg\\:grid-cols-3.xl\\:grid-cols-4 {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }
            
            .py-16 {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }
            
            .px-4 {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            
            .mb-12 {
                margin-bottom: 2rem !important;
            }
            
            .gap-12 {
                gap: 1rem !important;
            }
            
            .gap-6 {
                gap: 1rem !important;
            }
            
            .space-y-4 > * + * {
                margin-top: 1rem !important;
            }
            
            .space-y-3 > * + * {
                margin-top: 0.75rem !important;
            }
            
            .space-y-8 > * + * {
                margin-top: 2rem !important;
            }
            
            .space-y-6 > * + * {
                margin-top: 1.5rem !important;
            }
        }
        
        @media (max-width: 480px) {
            .lojas-hero h1 { 
                font-size: 1.75rem !important; 
            }
            
            .lojas-hero p { 
                font-size: 0.9rem !important; 
            }
            
            .loja-card {
                padding: 1rem !important;
            }
            
            .loja-imagem {
                height: 10rem !important;
            }
            
            .text-3xl {
                font-size: 1.5rem !important;
            }
            
            .text-xl {
                font-size: 1rem !important;
            }
            
            .text-lg {
                font-size: 0.9rem !important;
            }
        }
        
        /* Prevenir scroll horizontal */
        @media (max-width: 768px) {
            .lojas-hero,
            .loja-card,
            .produto-card,
            .servico-card {
                max-width: 100% !important;
                overflow-x: hidden !important;
            }
            
            iframe {
                max-width: 100% !important;
                height: 150px !important;
            }
        }
        
        /* Loading states */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* Animações de entrada */
        .animate-fade-in {
            animation: fadeInUp 0.8s ease-out forwards;
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
        
        /* Animação de escala para o hero */
        .animate-scale-in {
            animation: scaleIn 0.8s ease-out forwards;
        }
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filtroLoja = document.getElementById('filtro-loja');
        const filtroTipo = document.getElementById('filtro-tipo');
        const cards = document.querySelectorAll('.loja-card');
        const semResultados = document.getElementById('sem-resultados');
        
        function filtrar() {
            const loja = filtroLoja.value;
            const tipo = filtroTipo.value;
            let resultadosEncontrados = 0;
            
            cards.forEach(card => {
                const cardLoja = card.getAttribute('data-loja');
                const cardTipo = card.getAttribute('data-tipo');
                let show = true;
                
                if (loja && cardLoja !== loja) show = false;
                if (tipo && cardTipo !== tipo) show = false;
                
                if (show) {
                    card.style.display = '';
                    resultadosEncontrados++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Mostra/esconde mensagem de sem resultados
            if (resultadosEncontrados === 0) {
                semResultados.classList.remove('hidden');
            } else {
                semResultados.classList.add('hidden');
            }
        }
        
        function limparFiltros() {
            filtroLoja.value = '';
            filtroTipo.value = '';
            filtrar();
        }
        
        // Event listeners
        filtroLoja.addEventListener('change', filtrar);
        filtroTipo.addEventListener('change', filtrar);
        
        // Smooth scroll para links internos
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Animações on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        // Observa elementos para animação
        document.querySelectorAll('.loja-card, .produto-card, .servico-card').forEach(el => {
            observer.observe(el);
        });
        
        // Analytics para CTAs (opcional)
        document.querySelectorAll('a[href*="whatsapp"], a[href*="contato"]').forEach(link => {
            link.addEventListener('click', function() {
                console.log('CTA clicked:', this.href);
            });
        });
    });
    
    // Função global para limpar filtros
    function limparFiltros() {
        document.getElementById('filtro-loja').value = '';
        document.getElementById('filtro-tipo').value = '';
        document.querySelectorAll('.loja-card').forEach(card => {
            card.style.display = '';
        });
        document.getElementById('sem-resultados').classList.add('hidden');
    }
</script>
@endpush
