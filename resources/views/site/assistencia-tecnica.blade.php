@extends('layouts.site')

@push('meta')
    <title>Assistência Técnica Docol e Marcas Especializadas em Brasília | {{ config('app.name', 'ShopPreparos') }}</title>
    <meta name="description" content="Assistência técnica Docol e marcas especializadas em Brasília, Águas Claras e Taguatinga. Serviços com garantia, peças originais e técnicos certificados.">
    <meta name="keywords" content="assistência técnica docol, assistência docol, assistência técnica autorizada, reparos hidráulicos brasília, manutenção docol, peças originais docol">
    <meta property="og:title" content="Assistência Técnica Docol e Marcas Especializadas em Brasília" />
    <meta property="og:description" content="Assistência técnica Docol e outras marcas com garantia, peças originais e especialistas em manutenção." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="robots" content="index, follow">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "name": "Assistência Técnica Docol",
      "provider": {
        "@type": "LocalBusiness",
        "name": "Shopp Reparos",
        "areaServed": ["Águas Claras", "Taguatinga", "Brasília"],
        "telephone": "+55 61 99609-6296"
      },
      "serviceType": "Assistência técnica especializada em produtos Docol e marcas de hidráulica",
      "description": "Manutenção, reparo e assistência técnica para produtos Docol e marcas relacionadas com garantia e peças originais.",
      "areaServed": ["Águas Claras", "Taguatinga", "Brasília"],
      "offers": {
        "@type": "Offer",
        "priceSpecification": {
          "@type": "UnitPriceSpecification",
          "priceCurrency": "BRL"
        }
      }
    }
    </script>
@endpush

@section('content')
<div class="relative w-full min-h-[180px] flex flex-col items-center justify-center mb-8 assist-hero">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 via-blue-600 to-blue-900 opacity-90 rounded-b-3xl z-0"></div>
    <div class="relative z-10 flex flex-col items-center justify-center py-8 px-4 text-center">
        <img src="{{ asset('img/Destaques/Hidraulica.png') }}" alt="Assistência Técnica" class="w-20 h-20 mb-2 drop-shadow-lg">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-2 drop-shadow">Assistência Técnica Autorizada</h1>
        <p class="text-lg sm:text-xl text-blue-100 font-medium mb-4 max-w-xl mx-auto drop-shadow">Atendimento especializado para Lorenzetti e Meber. Serviços com garantia, peças originais e técnicos certificados em Águas Claras, Taguatinga Sul e Norte.</p>
        <a href="/contato" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-full shadow-lg text-lg transition">Solicitar Orçamento</a>
    </div>
</div>

<div class="max-w-6xl mx-auto py-6 px-2 sm:px-4 md:px-6">
    <!-- Seção de Marcas Atendidas com Imagens -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-blue-700 mb-6 flex items-center gap-2 text-center justify-center">
            <svg xmlns='http://www.w3.org/2000/svg' style='width:32px;height:32px;color:#22d3ee;vertical-align:middle;' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6'/>
            </svg>
            Marcas Atendidas
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 max-w-4xl mx-auto">
            <!-- Lorenzetti -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-blue-100 hover:shadow-xl transition-shadow">
                <div class="text-center mb-4">
                    <img src="{{ asset('img/assistencia/lorenzeti.png') }}" alt="Lorenzetti" class="h-16 mx-auto mb-3">
                    <h3 class="text-xl font-bold text-blue-800 mb-2">Lorenzetti</h3>
                </div>
                <div class="relative h-48 mb-4 rounded-lg overflow-hidden">
                    <div class="gallery-container h-full">
                        <img src="{{ asset('img/assistencia/lorenzetti/01.jpg') }}" class="gallery-image active" alt="Assistência Lorenzetti">
                        <img src="{{ asset('img/assistencia/lorenzetti/02.jpg') }}" class="gallery-image" alt="Assistência Lorenzetti">
                        <img src="{{ asset('img/assistencia/lorenzetti/03.webp') }}" class="gallery-image" alt="Assistência Lorenzetti">
                    </div>
                    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-1">
                        <span class="gallery-dot active w-2 h-2 bg-white rounded-full cursor-pointer"></span>
                        <span class="gallery-dot w-2 h-2 bg-white/50 rounded-full cursor-pointer"></span>
                        <span class="gallery-dot w-2 h-2 bg-white/50 rounded-full cursor-pointer"></span>
                    </div>
                </div>
                <p class="text-gray-700 text-sm text-center leading-relaxed">Assistência técnica especializada Lorenzetti. Qualidade e excelência garantidas.</p>
                <div class="text-center mt-4">
                    <a href="https://wa.me/5561999999999?text=Olá! Preciso de assistência Lorenzetti!" class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg text-sm transition gap-2">
                        <i class="fab fa-whatsapp"></i>
                        <span>Solicitar</span>
                    </a>
                </div>
            </div>

            <!-- Meber -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-blue-100 hover:shadow-xl transition-shadow">
                <div class="text-center mb-4">
                    <img src="{{ asset('img/assistencia/meber.png') }}" alt="Meber" class="h-16 mx-auto mb-3">
                    <h3 class="text-xl font-bold text-blue-800 mb-2">Meber</h3>
                </div>
                <div class="relative h-48 mb-4 rounded-lg overflow-hidden">
                    <div class="gallery-container h-full">
                        <img src="{{ asset('img/assistencia/meber/01.png') }}" class="gallery-image active" alt="Assistência Meber">
                        <img src="{{ asset('img/assistencia/meber/02.png') }}" class="gallery-image" alt="Assistência Meber">
                        <img src="{{ asset('img/assistencia/meber/03.png') }}" class="gallery-image" alt="Assistência Meber">
                    </div>
                    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-1">
                        <span class="gallery-dot active w-2 h-2 bg-white rounded-full cursor-pointer"></span>
                        <span class="gallery-dot w-2 h-2 bg-white/50 rounded-full cursor-pointer"></span>
                        <span class="gallery-dot w-2 h-2 bg-white/50 rounded-full cursor-pointer"></span>
                    </div>
                </div>
                <p class="text-gray-700 text-sm text-center leading-relaxed">Atendimento especializado Meber. Cuidamos dos seus produtos com excelência.</p>
                <div class="text-center mt-4">
                    <a href="https://wa.me/5561999999999?text=Olá! Preciso de assistência Meber!" class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg text-sm transition gap-2">
                        <i class="fab fa-whatsapp"></i>
                        <span>Solicitar</span>
                    </a>
                </div>
            </div>
        </div>

        <p class="text-gray-700 text-base sm:text-lg leading-relaxed text-center mb-6 max-w-4xl mx-auto">
            Somos assistência técnica autorizada e especializada em manutenção, instalação e reparo de produtos dessas marcas. 
            Utilizamos peças originais e oferecemos garantia em todos os serviços.
        </p>
    </div>

    <!-- Seção de Serviços Realizados -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-blue-700 mb-6 flex items-center gap-2 text-center justify-center">
            <svg xmlns='http://www.w3.org/2000/svg' style='width:32px;height:32px;color:#22d3ee;vertical-align:middle;' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 7h18M3 12h18M3 17h18'/>
            </svg>
            Serviços Realizados
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                <div class="text-center mb-4">
                    <i class="fas fa-tools text-3xl text-blue-600 mb-3"></i>
                    <h3 class="text-lg font-semibold text-blue-800">Instalação e Manutenção</h3>
                </div>
                <p class="text-gray-700 text-sm text-center">Aquecedores, duchas e torneiras com instalação profissional</p>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                <div class="text-center mb-4">
                    <i class="fas fa-wrench text-3xl text-green-600 mb-3"></i>
                    <h3 class="text-lg font-semibold text-green-800">Reparo de Vazamentos</h3>
                </div>
                <p class="text-gray-700 text-sm text-center">Identificação e correção de vazamentos com garantia</p>
            </div>
            
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                <div class="text-center mb-4">
                    <i class="fas fa-home text-3xl text-purple-600 mb-3"></i>
                    <h3 class="text-lg font-semibold text-purple-800">Atendimento Residencial</h3>
                </div>
                <p class="text-gray-700 text-sm text-center">Serviços residenciais, comerciais e condominiais</p>
            </div>
            
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 border border-orange-200">
                <div class="text-center mb-4">
                    <i class="fas fa-clock text-3xl text-orange-600 mb-3"></i>
                    <h3 class="text-lg font-semibold text-orange-800">Atendimento Rápido</h3>
                </div>
                <p class="text-gray-700 text-sm text-center">Orçamento rápido e atendimento em até 24h</p>
            </div>
            
            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 border border-red-200">
                <div class="text-center mb-4">
                    <i class="fas fa-shield-alt text-3xl text-red-600 mb-3"></i>
                    <h3 class="text-lg font-semibold text-red-800">Peças Originais</h3>
                </div>
                <p class="text-gray-700 text-sm text-center">Utilizamos peças originais com garantia de serviço</p>
            </div>
            
            <div class="bg-gradient-to-br from-cyan-50 to-cyan-100 rounded-xl p-6 border border-cyan-200">
                <div class="text-center mb-4">
                    <i class="fas fa-certificate text-3xl text-cyan-600 mb-3"></i>
                    <h3 class="text-lg font-semibold text-cyan-800">Técnicos Certificados</h3>
                </div>
                <p class="text-gray-700 text-sm text-center">Equipe qualificada e certificada pelas marcas</p>
            </div>
        </div>
    </div>

    <!-- CTA Principal -->
    <div class="text-center mt-12">
        <a href="/contato" class="inline-block bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold py-4 px-10 rounded-full shadow-xl hover:from-blue-600 hover:to-cyan-500 transition text-xl">
            Solicitar Orçamento Agora
        </a>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .assist-hero { min-height: 220px; }
        .assist-hero .bg-gradient-to-br { border-bottom-left-radius: 2.5rem; border-bottom-right-radius: 2.5rem; }
        .assist-hero img { box-shadow: 0 4px 24px #2563eb33; }
        
        .gallery-container { position: relative; }
        .gallery-image { 
            position: absolute; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            opacity: 0; 
            transition: opacity 1s ease-in-out; 
        }
        .gallery-image.active { opacity: 1; }
        
        .gallery-dot { transition: all 0.3s ease; }
        .gallery-dot.active { background-color: white !important; }
        
        @media (max-width: 640px) {
            .assist-hero { min-height: 160px; padding-top: 12px; }
            .assist-hero h1 { font-size: 1.5rem; }
            .assist-hero p { font-size: 1rem; }
        }
    </style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Função para trocar imagens da galeria
    function initGallery(container) {
        const images = container.querySelectorAll('.gallery-image');
        const dots = container.parentElement.querySelectorAll('.gallery-dot');
        let currentIndex = 0;
        
        function showImage(index) {
            images.forEach((img, i) => {
                img.classList.toggle('active', i === index);
            });
            
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }
        
        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }
        
        // Adicionar eventos aos dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                showImage(currentIndex);
            });
        });
        
        // Trocar automaticamente a cada 4 segundos
        setInterval(nextImage, 4000);
    }
    
    // Inicializar todas as galerias
    document.querySelectorAll('.gallery-container').forEach(initGallery);
});
</script>
@endpush
