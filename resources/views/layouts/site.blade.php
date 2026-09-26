<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Shopp Reparos | Assistência Técnica Docol, Ferragens e Hidráulica em Brasília')</title>
    <meta name="description" content="@yield('description', 'Assistência técnica Docol, reparos hidráulicos, materiais elétricos e ferragens em Águas Claras, Taguatinga e Brasília. Peças originais, garantia e atendimento rápido.')">
    <meta name="keywords" content="@yield('keywords', 'assistência técnica docol, assistência docol, reparos hidráulicos brasília, ferragens águas claras, materiais de construção taguatinga, loja de hidráulica brasília, assistência técnica autorizada')">
    <meta name="author" content="Shopp Reparos">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Shopp Reparos | Assistência Técnica Docol e Reparos em Brasília')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="{{ asset('img/logohorizontal.png') }}">
    <meta property="og:locale" content="pt_BR">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:image" content="{{ asset('img/logohorizontal.png') }}">
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Shopp Reparos",
      "image": "{{ asset('img/logohorizontal.png') }}",
      "url": "{{ url('/') }}",
      "telephone": "+55 61 99609-6296",
      "description": "Assistência técnica autorizada, reparos hidráulicos, ferragens e materiais elétricos em Águas Claras, Taguatinga e Brasília.",
      "areaServed": ["Águas Claras", "Taguatinga", "Brasília", "DF"],
      "address": [
        {
          "@type": "PostalAddress",
          "streetAddress": "Quadra 204, Edifício Alfamix - Loja 15",
          "addressLocality": "Águas Claras",
          "addressRegion": "DF",
          "addressCountry": "BR"
        },
        {
          "@type": "PostalAddress",
          "streetAddress": "CSE 02 Loja 19 - Taguatinga Sul",
          "addressLocality": "Taguatinga",
          "addressRegion": "DF",
          "addressCountry": "BR"
        }
      ],
      "sameAs": [
        "https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Vim pelo site!",
        "https://api.whatsapp.com/send?phone=5561999318077&text=Olá! Vim pelo site!"
      ],
      "makesOffer": [
        {
          "@type": "Offer",
          "itemOffered": {
            "@type": "Service",
            "name": "Assistência Técnica Docol",
            "description": "Manutenção, reparo e assistência técnica especializada para produtos Docol e marcas de hidraulica e eletrica."
          }
        }
      ]
    }
    </script>
    
    @stack('meta')
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/iconfav.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Assets Compilados -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- CSS Responsivo Global -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    
    <!-- CSS para Alinhamento dos Preços -->
    <link href="{{ asset('css/alinhamento-precos.css') }}" rel="stylesheet">
    
    <!-- CSS para Correção dos Serviços -->
    <link href="{{ asset('css/servicos-fix.css') }}" rel="stylesheet">
    
    <!-- CSS para Correção do Alinhamento da Navegação -->
    <link href="{{ asset('css/alinhamento-navegacao.css') }}" rel="stylesheet">
    
    <!-- CSS Inline para correção do footer -->
    <style>
        /* Correção do espaçamento do footer */
        main {
            margin-bottom: 2rem !important;
            padding-bottom: 1rem !important;
        }
        
        /* Correções de alinhamento da navegação */
        .menu {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            flex-wrap: wrap !important;
            max-width: 100% !important;
        }
        
        .menu a {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            white-space: nowrap !important;
            min-height: 44px !important;
            text-align: center !important;
            position: relative !important;
            z-index: 1001 !important;
        }
        
        /* Correção específica para "REPAROS HIDRÁULICOS" */
        .menu a[href="/reparos-hidraulicos"] {
            white-space: nowrap !important;
            min-height: 44px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
        }
        
        /* Correções para problemas de sobreposição */
        .menu,
        .menu a,
        .topo {
            position: relative !important;
        }
        
        .topo {
            z-index: 1002 !important;
        }
        
        .menu {
            z-index: 1000 !important;
        }
        
        .menu a {
            z-index: 1001 !important;
        }
        
        /* Correções para elementos de acessibilidade */
        [role="image"],
        [aria-label*="teste"],
        [data-accessibility] {
            position: relative !important;
            z-index: 999 !important;
            pointer-events: none !important;
            opacity: 0.1 !important;
        }
        
        /* Correção do espaçamento do footer */
        main {
            margin-bottom: 2rem !important;
            padding-bottom: 1rem !important;
        }
        
        .footer-spacer {
            height: 2rem !important;
            background: transparent !important;
            display: block !important;
            clear: both !important;
        }
        
        footer {
            margin-top: 1rem !important;
            padding-top: 1rem !important;
        }
        
        footer .max-w-6xl {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }
        
        @media (max-width: 768px) {
            main {
                margin-bottom: 1rem !important;
            }
            
            .footer-spacer {
                height: 1rem !important;
            }
            
            footer {
                margin-top: 0.5rem !important;
            }
            
            footer .max-w-6xl {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }
        }
        
        /* Correções específicas para a seção "Nossas Lojas" no mobile */
        @media (max-width: 768px) {
            .nossaslojas {
                padding: 40px 20px !important;
                width: 100% !important;
                margin: 0 !important;
                left: auto !important;
                right: auto !important;
                position: relative !important;
                overflow: hidden !important;
            }
            
            .nossaslojas h2 {
                font-size: 2.2rem !important;
                margin-bottom: 30px !important;
                padding: 0 10px !important;
                text-align: center !important;
            }
            
            .lojas {
                flex-direction: column !important;
                align-items: center !important;
                max-width: 100% !important;
                gap: 30px !important;
                padding: 0 !important;
                margin: 0 auto !important;
            }
            
            .loja {
                flex: none !important;
                width: 100% !important;
                max-width: 100% !important;
                min-height: auto !important;
                margin: 0 !important;
                border-radius: 15px !important;
            }
            
            .loja-content {
                padding: 25px 20px !important;
            }
            
            .loja h2 {
                font-size: 1.6rem !important;
                margin-bottom: 15px !important;
            }
            
            .loja img {
                height: 180px !important;
                width: 100% !important;
                object-fit: cover !important;
            }
            
            .loja button {
                padding: 12px 25px !important;
                font-size: 1rem !important;
                width: 100% !important;
                justify-content: center !important;
                border-radius: 25px !important;
            }
            
            .loja p {
                font-size: 0.9rem !important;
                line-height: 1.5 !important;
                margin-bottom: 15px !important;
            }
        }
        
        @media (max-width: 480px) {
            .nossaslojas {
                padding: 30px 15px !important;
            }
            
            .nossaslojas h2 {
                font-size: 1.8rem !important;
                margin-bottom: 25px !important;
            }
            
            .loja {
                border-radius: 12px !important;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
            }
            
            .loja-content {
                padding: 20px 15px !important;
            }
            
            .loja img {
                height: 160px !important;
            }
            
            .loja button {
                padding: 10px 20px !important;
                font-size: 0.9rem !important;
                border-radius: 20px !important;
            }
            
            .loja h2 {
                font-size: 1.4rem !important;
            }
            
            .loja p {
                font-size: 0.85rem !important;
            }
        }
        
        /* Garantir que não haja overflow horizontal em qualquer largura */
        html, body {
            max-width: 100%;
            overflow-x: clip;
        }

        header, main, footer, section {
            max-width: 100%;
        }

        img, video, iframe {
            max-width: 100%;
        }

        .max-w-8xl {
            max-width: min(88rem, 100%) !important;
            width: 100%;
        }

        .slogan-container,
        .slogan-text {
            max-width: 100%;
        }

        @media (max-width: 768px) {
            body {
                overflow-x: clip !important;
                width: 100% !important;
            }
            
                    .max-w-6xl {
            max-width: 100% !important;
            padding: 0 15px !important;
            margin: 0 auto !important;
        }
            
            img, video, iframe, svg {
                max-width: 100% !important;
                height: auto;
            }
            
            /* Correções específicas para serviços */
            .servicos-section,
            .servicos-grid,
            .service-card {
                max-width: 100% !important;
                overflow: visible !important;
            }
            
            .servico-card,
            .service-card {
                overflow: visible !important;
                max-width: 100% !important;
                width: 100% !important;
            }
        }
        
        /* Correções específicas para evitar corte em serviços */
        .servico-card,
        .service-card {
            overflow: visible !important;
            position: relative !important;
        }
        
        .servico-card:hover,
        .service-card:hover {
            z-index: 10 !important;
        }
        
        /* Garantir que o grid de serviços não cause problemas */
        .servicos-grid,
        .grid {
            max-width: 100% !important;
            overflow: visible !important;
        }
        
        /* Correções para cards individuais */
        .servico-card *,
        .service-card * {
            box-sizing: border-box !important;
        }
    </style>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                        'display': ['Poppins', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                    colors: {
                        'primary': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        'accent': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        'warning': {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        },
                        'secondary': {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'scale-in': 'scaleIn 0.3s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(30px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        scaleIn: {
                            '0%': { transform: 'scale(0.9)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Styles otimizados -->
    <link rel="stylesheet" href="{{ asset('especialistas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/produtos.css') }}">
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
        }
        
        .font-display {
            font-family: 'Poppins', system-ui, -apple-system, sans-serif;
        }
        
        /* Responsividade otimizada - sem redundâncias */
        @media (max-width: 640px) {
            .text-6xl { font-size: 2rem !important; line-height: 1.1 !important; }
            .text-5xl { font-size: 1.75rem !important; line-height: 1.1 !important; }
            .text-4xl { font-size: 1.5rem !important; line-height: 1.1 !important; }
            .text-3xl { font-size: 1.25rem !important; line-height: 1.1 !important; }
            .text-2xl { font-size: 1.125rem !important; line-height: 1.1 !important; }
            .text-xl { font-size: 1rem !important; line-height: 1.1 !important; }
            
            .p-8, .p-12 { padding: 1rem !important; }
            .py-16, .py-12 { padding-top: 1rem !important; padding-bottom: 1rem !important; }
        }
        
        /* Garantir visibilidade da seção de especialistas */
        .especialistas-hidraulicos {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        /* Regras globais para dropdowns mobile */
        @media (max-width: 768px) {
            #whatsappDropdown,
            #locationDropdown {
                position: absolute !important;
                z-index: 9999 !important;
                pointer-events: auto !important;
                display: block !important;
                max-width: none !important;
                width: 16rem !important;
            }
            
            #whatsappDropdown.hidden,
            #locationDropdown.hidden {
                display: none !important;
            }
            
            /* Garantir que os botões sejam clicáveis */
            #whatsappBtn,
            #locationBtn {
                pointer-events: auto !important;
                z-index: 10000 !important;
            }
        }
        
        /* Estilos para o slogan com efeito de digitação */
        .slogan-container {
            overflow: hidden;
            position: relative;
            min-height: 1.5rem;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .slogan-text {
            display: inline-block;
            font-weight: 600;
            color: white;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            white-space: nowrap;
            text-align: center;
            border-right: 3px solid white;
            min-width: 0;
            overflow: hidden;
            position: relative;
        }
        
        /* Cursor piscante */
        .slogan-text::after {
            content: '';
            display: inline-block;
            width: 3px;
            height: 1.2em;
            background-color: white;
            margin-left: 2px;
            animation: blink 1s infinite;
            vertical-align: text-bottom;
        }
        
        @keyframes blink {
            0%, 50% {
                opacity: 1;
            }
            51%, 100% {
                opacity: 0;
            }
        }
        
        /* Efeito de fade out para transições suaves */
        .slogan-text.fade-out {
            animation: fadeOut 0.5s ease-out forwards;
        }
        
        @keyframes fadeOut {
            to {
                opacity: 0;
            }
        }
        

        
        /* Responsividade para o slogan */
        @media (max-width: 640px) {
            .slogan-text {
                font-size: 0.875rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    @include('partials.site-header')

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    @include('partials.site-footer')

    <!-- Floating WhatsApp -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Vim pelo site!" 
           class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg transition-all duration-300 hover:scale-110 animate-float group">
            <i class="fab fa-whatsapp text-2xl"></i>
            <span class="absolute right-16 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                Fale conosco!
            </span>
        </a>
    </div>
    
    <!-- Scripts otimizados -->
    <script>
        // Mobile Menu Toggle otimizado com animações
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            const body = document.body;
            
            // Função para abrir menu mobile com animação
            function openMobileMenu() {
                mobileMenu.classList.remove('hidden');
                requestAnimationFrame(function () {
                    mobileMenu.querySelector('.sr-drawer').classList.add('is-open');
                });
                body.classList.add('mobile-menu-open');
                body.style.overflow = 'hidden';
            }
            
            function closeMobileMenu() {
                if (mobileMenu.classList.contains('hidden')) return;
                mobileMenu.querySelector('.sr-drawer').classList.remove('is-open');
                setTimeout(function () {
                    mobileMenu.classList.add('hidden');
                    body.classList.remove('mobile-menu-open');
                    body.style.overflow = '';
                }, 250);
            }
            
            // Toggle do menu
            mobileMenuToggle.addEventListener('click', function() {
                if (mobileMenu.classList.contains('hidden')) {
                    openMobileMenu();
                } else {
                    closeMobileMenu();
                }
            });
            
            // Fechar menu ao clicar no botão de fechar
            mobileMenuClose.addEventListener('click', closeMobileMenu);
            
            // Fechar menu ao clicar fora
            mobileMenu.addEventListener('click', function (e) {
                if (e.target === mobileMenu) closeMobileMenu();
            });

            document.addEventListener('click', function(e) {
                if (!mobileMenuToggle.contains(e.target) && !mobileMenu.contains(e.target) && (!mobileMenuClose || !mobileMenuClose.contains(e.target))) {
                    closeMobileMenu();
                }
            });
            
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1180) {
                    closeMobileMenu();
                }
            });
            
            // Fechar menu ao pressionar ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                    closeMobileMenu();
                }
            });
            
            // Prevenir scroll horizontal em mobile
            if (window.innerWidth <= 768) {
                document.addEventListener('touchmove', function(e) {
                    if (e.touches.length > 1) {
                        e.preventDefault();
                    }
                }, { passive: false });
                
                // Prevenir zoom em mobile
                document.addEventListener('gesturestart', function(e) {
                    e.preventDefault();
                });
            }
            
            // Funções para os dropdowns
            function toggleWhatsAppDropdown() {
                console.log('toggleWhatsAppDropdown chamada');
                const dropdown = document.getElementById('whatsappDropdown');
                const locationDropdown = document.getElementById('locationDropdown');
                
                if (!dropdown) {
                    console.error('Dropdown WhatsApp não encontrado');
                    return;
                }
                
                // Fechar dropdown de localização se estiver aberto
                if (locationDropdown && !locationDropdown.classList.contains('hidden')) {
                    locationDropdown.classList.add('hidden');
                }
                
                // Toggle do dropdown do WhatsApp
                if (dropdown.classList.contains('hidden')) {
                    console.log('Abrindo dropdown WhatsApp');
                    dropdown.classList.remove('hidden');
                } else {
                    console.log('Fechando dropdown WhatsApp');
                    dropdown.classList.add('hidden');
                }
            }
            
            function toggleLocationDropdown() {
                console.log('toggleLocationDropdown chamada');
                const dropdown = document.getElementById('locationDropdown');
                const whatsappDropdown = document.getElementById('whatsappDropdown');
                
                if (!dropdown) {
                    console.error('Dropdown Localização não encontrado');
                    return;
                }
                
                // Fechar dropdown do WhatsApp se estiver aberto
                if (whatsappDropdown && !whatsappDropdown.classList.contains('hidden')) {
                    whatsappDropdown.classList.add('hidden');
                }
                
                // Toggle do dropdown de localização
                if (dropdown.classList.contains('hidden')) {
                    console.log('Abrindo dropdown Localização');
                    dropdown.classList.remove('hidden');
                } else {
                    console.log('Fechando dropdown Localização');
                    dropdown.classList.add('hidden');
                }
            }
            
            // Adicionar event listeners para os botões
            const whatsappBtn = document.getElementById('whatsappBtn');
            const locationBtn = document.getElementById('locationBtn');
            
            if (whatsappBtn) {
                whatsappBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleWhatsAppDropdown();
                });
            }
            
            if (locationBtn) {
                locationBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleLocationDropdown();
                });
            }
            
            // Fechar dropdowns ao clicar fora
            document.addEventListener('click', function(e) {
                const whatsappDropdown = document.getElementById('whatsappDropdown');
                const locationDropdown = document.getElementById('locationDropdown');
                const whatsappButton = e.target.closest('#whatsappBtn');
                const locationButton = e.target.closest('#locationBtn');
                
                // Fechar dropdown do WhatsApp se clicou fora
                if (!whatsappButton && whatsappDropdown && !whatsappDropdown.classList.contains('hidden')) {
                    whatsappDropdown.classList.add('hidden');
                }
                
                // Fechar dropdown de localização se clicou fora
                if (!locationButton && locationDropdown && !locationDropdown.classList.contains('hidden')) {
                    locationDropdown.classList.add('hidden');
                }
            });
        });
        
        // Smooth scroll for anchor links
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
        
        // Funcionalidade para o slogan com efeito de digitação
        document.addEventListener('DOMContentLoaded', function() {
            const sloganText = document.querySelector('.slogan-text');
            if (sloganText) {
                const slogan = "Shopp Reparos, para cada reparo, uma solução!";
                
                function typeWriter(text, element, speed = 50) {
                    element.textContent = '';
                    element.style.width = '0';
                    
                    let i = 0;
                    const timer = setInterval(() => {
                        if (i < text.length) {
                            element.textContent += text.charAt(i);
                            element.style.width = 'auto';
                            i++;
                        } else {
                            clearInterval(timer);
                            // Aguarda um pouco antes de reiniciar
                            setTimeout(() => {
                                element.classList.add('fade-out');
                                setTimeout(() => {
                                    element.classList.remove('fade-out');
                                    typeWriter(slogan, element, speed);
                                }, 500);
                            }, 2000);
                        }
                    }, speed);
                }
                
                // Inicia o efeito de digitação
                typeWriter(slogan, sloganText, 50);
                
                // Adicionar efeito de destaque ao slogan
                sloganText.addEventListener('mouseenter', function() {
                    this.style.color = '#fbbf24';
                    this.style.textShadow = '0 2px 4px rgba(0, 0, 0, 0.3)';
                    this.style.borderRightColor = '#fbbf24';
                });
                
                sloganText.addEventListener('mouseleave', function() {
                    this.style.color = 'white';
                    this.style.textShadow = '0 1px 2px rgba(0, 0, 0, 0.2)';
                    this.style.borderRightColor = 'white';
                });
                
                // Pausar animação ao focar para acessibilidade
                sloganText.addEventListener('focus', function() {
                    this.style.animationPlayState = 'paused';
                });
                
                sloganText.addEventListener('blur', function() {
                    this.style.animationPlayState = 'running';
                });
            }
        });
        
        // Loading animation helper
        function showLoading(element) {
            element.classList.add('loading-dots');
            element.textContent = 'Carregando';
        }
        
        function hideLoading(element, originalText) {
            element.classList.remove('loading-dots');
            element.textContent = originalText;
        }
        
        // Intersection Observer for animations
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
        
        // Observe elements with animation classes
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
        
        // Filtro de produtos por categoria
        document.addEventListener('DOMContentLoaded', function() {
            const categoriaSelect = document.getElementById('categoria');
            const produtosGrid = document.getElementById('produtosGrid');
            
            if (categoriaSelect && produtosGrid) {
                categoriaSelect.addEventListener('change', function() {
                    const categoriaSelecionada = this.value;
                    const produtos = produtosGrid.querySelectorAll('.produto-card');
                    
                    produtos.forEach(produto => {
                        const categoriaProduto = produto.getAttribute('data-categoria');
                        
                        if (!categoriaSelecionada || categoriaProduto === categoriaSelecionada) {
                            produto.style.display = 'block';
                            produto.style.animation = 'fadeInUp 0.4s ease-out';
                        } else {
                            produto.style.display = 'none';
                        }
                    });
                    
                    // Verificar se há produtos visíveis
                    const produtosVisiveis = Array.from(produtos).filter(p => p.style.display !== 'none');
                    
                    if (produtosVisiveis.length === 0 && categoriaSelecionada) {
                        // Mostrar mensagem de "nenhum produto encontrado"
                        const mensagem = document.createElement('div');
                        mensagem.className = 'produto-sem-produtos';
                        mensagem.innerHTML = `
                            <div class="produto-placeholder">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3>Nenhum produto encontrado</h3>
                            <p>Não encontramos produtos na categoria "${categoriaSelecionada}".</p>
                        `;
                        
                        // Remover mensagem anterior se existir
                        const mensagemAnterior = produtosGrid.querySelector('.produto-sem-produtos');
                        if (mensagemAnterior) {
                            mensagemAnterior.remove();
                        }
                        
                        produtosGrid.appendChild(mensagem);
                    } else {
                        // Remover mensagem se existir
                        const mensagem = produtosGrid.querySelector('.produto-sem-produtos');
                        if (mensagem) {
                            mensagem.remove();
                        }
                    }
                });
            }
        });
    </script>
    
    @stack('scripts')
 </body>
 </html>
