@extends('layouts.site')

@push('meta')
    <title>Reparos Hidráulicos em Águas Claras e Taguatinga | {{ config('app.name', 'Shopp Reparos') }}</title>
    <meta name="description" content="Especialistas em reparos hidráulicos em Águas Claras e Taguatinga. Vazamentos, entupimentos, instalações e manutenções hidráulicas com qualidade e garantia.">
    <meta property="og:title" content="Reparos Hidráulicos em Águas Claras e Taguatinga" />
    <meta property="og:description" content="Especialistas em reparos hidráulicos. Vazamentos, entupimentos, instalações e manutenções com qualidade!" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="robots" content="index, follow">
@endpush

@section('content')
<div class="relative w-full min-h-[180px] flex flex-col items-center justify-center mb-8 assist-hero">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 via-blue-600 to-blue-900 opacity-90 rounded-b-3xl z-0"></div>
    <div class="relative z-10 flex flex-col items-center justify-center py-8 px-4 text-center">
        <img src="{{ asset('img/Destaques/Hidraulica.png') }}" alt="Reparos Hidráulicos" class="w-20 h-20 mb-2 drop-shadow-lg">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-2 drop-shadow">Reparos Hidráulicos</h1>
        <p class="text-lg sm:text-xl text-blue-100 font-medium mb-4 max-w-xl mx-auto drop-shadow">Especialistas em reparos hidráulicos em Águas Claras e Taguatinga. Vazamentos, entupimentos, instalações e manutenções com qualidade e garantia.</p>
        <a href="/contato" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-full shadow-lg text-lg transition">Solicitar Orçamento</a>
    </div>
</div>

<div class="max-w-6xl mx-auto py-6 px-2 sm:px-4 md:px-6">
    <!-- Seção de Serviços Hidráulicos -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-blue-700 mb-6 flex items-center gap-2 text-center justify-center">
            <svg xmlns='http://www.w3.org/2000/svg' style='width:32px;height:32px;color:#22d3ee;vertical-align:middle;' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 19l9 2-9-18-9 18 9-2zm0 0v-8'/>
            </svg>
            Nossos Serviços Hidráulicos
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Reparo de Vazamentos -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-blue-100 hover:shadow-xl transition-shadow">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-blue-800 mb-2">Reparo de Vazamentos</h3>
                </div>
                <p class="text-gray-700 text-sm text-center leading-relaxed">Identificação e reparo de vazamentos em tubulações, torneiras, chuveiros e conexões hidráulicas.</p>
                <div class="text-center mt-4">
                    <a href="/contato" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                        Solicitar
                    </a>
                </div>
            </div>

            <!-- Desentupimento -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-blue-100 hover:shadow-xl transition-shadow">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-green-800 mb-2">Desentupimento</h3>
                </div>
                <p class="text-gray-700 text-sm text-center leading-relaxed">Desentupimento de pias, ralos, vasos sanitários, tubulações e sistemas de esgoto.</p>
                <div class="text-center mt-4">
                    <a href="/contato" class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                        Solicitar
                    </a>
                </div>
            </div>

            <!-- Instalações Hidráulicas -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-blue-100 hover:shadow-xl transition-shadow">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-orange-800 mb-2">Instalações Hidráulicas</h3>
                </div>
                <p class="text-gray-700 text-sm text-center leading-relaxed">Instalação de torneiras, chuveiros, válvulas, registros e sistemas hidráulicos completos.</p>
                <div class="text-center mt-4">
                    <a href="/contato" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                        Solicitar
                    </a>
                </div>
            </div>

            <!-- Manutenção Preventiva -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-blue-100 hover:shadow-xl transition-shadow">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-purple-800 mb-2">Manutenção Preventiva</h3>
                </div>
                <p class="text-gray-700 text-sm text-center leading-relaxed">Inspeção, limpeza e manutenção preventiva de sistemas hidráulicos para evitar problemas futuros.</p>
                <div class="text-center mt-4">
                    <a href="/contato" class="inline-block bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                        Solicitar
                    </a>
                </div>
            </div>

            <!-- Substituição de Peças -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-blue-100 hover:shadow-xl transition-shadow">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-red-800 mb-2">Substituição de Peças</h3>
                </div>
                <p class="text-gray-700 text-sm text-center leading-relaxed">Substituição de peças desgastadas, torneiras, válvulas e componentes hidráulicos.</p>
                <div class="text-center mt-4">
                    <a href="/contato" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                        Solicitar
                    </a>
                </div>
            </div>


        </div>
    </div>

    <!-- Seção de Vantagens -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-blue-700 mb-6 flex items-center gap-2 text-center justify-center">
            <svg xmlns='http://www.w3.org/2000/svg' style='width:32px;height:32px;color:#22d3ee;vertical-align:middle;' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'/>
            </svg>
            Por que escolher a Shopp Reparos?
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Técnicos Certificados</h3>
                    <p class="text-gray-600 text-sm">Equipe qualificada e experiente em reparos hidráulicos</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Garantia nos Serviços</h3>
                    <p class="text-gray-600 text-sm">Todos os nossos serviços possuem garantia de qualidade</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Atendimento Rápido</h3>
                    <p class="text-gray-600 text-sm">Resposta rápida para emergências e solicitações</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Preços Justos</h3>
                    <p class="text-gray-600 text-sm">Orçamentos transparentes e preços competitivos</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Seção de CTA -->
    <div class="text-center bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-8 text-white">
        <h2 class="text-2xl font-bold mb-4">Precisa de um reparo hidráulico?</h2>
        <p class="text-blue-100 mb-6 max-w-2xl mx-auto">Nossa equipe está pronta para atender você com qualidade e agilidade. Entre em contato e solicite um orçamento gratuito!</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center w-full">
            <a href="/contato" class="inline-flex items-center justify-center bg-white text-blue-600 font-bold py-3 px-8 rounded-full hover:bg-blue-50 transition min-w-[200px]">
                Solicitar Orçamento
            </a>
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Preciso de um reparo hidráulico!" class="inline-flex items-center justify-center bg-green-500 text-white font-bold py-3 px-6 rounded-full hover:bg-green-600 transition min-w-[200px] w-full sm:w-auto gap-2">
                    <i class="fab fa-whatsapp"></i>
                    <span>Águas Claras</span>
                </a>
                <a href="https://api.whatsapp.com/send?phone=5561999318077&text=Olá! Preciso de um reparo hidráulico!" class="inline-flex items-center justify-center bg-green-600 text-white font-bold py-3 px-6 rounded-full hover:bg-green-700 transition min-w-[200px] w-full sm:w-auto gap-2">
                    <i class="fab fa-whatsapp"></i>
                    <span>Taguatinga</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- CSS específico para esta página -->
<style>
.assist-hero {
    background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
}

.gallery-container {
    position: relative;
    overflow: hidden;
}

.gallery-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.gallery-image.active {
    opacity: 1;
}

.gallery-dot {
    transition: all 0.3s ease;
}

.gallery-dot.active {
    background-color: white;
    transform: scale(1.2);
}

/* Responsividade dos botões WhatsApp */
@media (max-width: 640px) {
    .cta-buttons .flex {
        flex-direction: column;
        gap: 1rem;
    }
    
    .cta-buttons .flex .flex {
        flex-direction: column;
        gap: 0.75rem;
        width: 100%;
    }
    
    .cta-buttons a {
        min-width: auto;
        width: 100%;
        max-width: 280px;
    }
    
    /* Garantir alinhamento perfeito em mobile */
    .bg-gradient-to-r .flex {
        align-items: center;
        justify-content: center;
    }
    
    .bg-gradient-to-r .flex .flex {
        width: 100%;
        align-items: center;
    }
}
</style>

<!-- JavaScript para a galeria -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleries = document.querySelectorAll('.gallery-container');
    
    galleries.forEach(gallery => {
        const images = gallery.querySelectorAll('.gallery-image');
        const dots = gallery.parentElement.querySelectorAll('.gallery-dot');
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
        
        // Trocar imagem a cada 3 segundos
        setInterval(nextImage, 3000);
        
        // Adicionar eventos aos dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                showImage(currentIndex);
            });
        });
    });
});
</script>
@endsection
