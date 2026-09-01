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
            flex-wrap: nowrap !important;
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
        
        /* Garantir que não haja overflow horizontal */
        @media (max-width: 768px) {
            body {
                overflow-x: hidden !important;
                width: 100% !important;
            }
            
                    .max-w-6xl {
            max-width: 100% !important;
            padding: 0 15px !important;
            margin: 0 auto !important;
        }
            
            * {
                max-width: 100% !important;
                box-sizing: border-box !important;
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
    <!-- Header -->
    <header class="bg-white shadow-lg relative z-50">
        <!-- Top Bar -->
        <div class="bg-blue-900 text-white py-2">
            <div class="max-w-8xl mx-auto px-4">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center space-x-4">
                        <span class="hidden md:inline-flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            (61) 99609-6296 | (61) 99931-8077
                        </span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="hidden lg:inline">🕒 Seg - Sex: 8h às 18h | Sáb: 8h às 12h</span>
                    </div>
                </div>
                
                <!-- Slogan Centralizado -->
                <div class="flex justify-center items-center py-1">
                    <div class="slogan-container">
                        <span class="slogan-text">Shopp Reparos, para cada reparo, uma solução!</span>
                    </div>
                </div>
                </div>
            </div>
        </div>
        
        <!-- Main Header -->
        <div class="max-w-8xl mx-auto px-4">
            <!-- Desktop Layout -->
            <div class="hidden lg:flex items-center justify-between py-2">
                <!-- Logo -->
                <div class="flex items-center header-logo-desktop">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('img/logohorizontal.png') }}" alt="Shopp Reparos" class="h-10 w-auto object-contain">
                    </a>
                </div>
                

                
                <!-- Action Buttons Desktop -->
                <div class="flex items-center space-x-4">
                    <!-- WhatsApp Button -->
                    <div class="relative group">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition-colors duration-200 flex items-center justify-center animate-pulse-slow" title="WhatsApp">
                            <i class="fab fa-whatsapp text-lg"></i>
                        </button>
                        
                        <!-- Dropdown do WhatsApp -->
                        <div class="absolute top-full right-0 mt-2 w-72 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-800 mb-4 text-center">Fale Conosco</h4>
                                
                                <div class="space-y-3">
                                    <div class="bg-green-50 p-3 rounded-lg border-l-4 border-green-500">
                                        <h5 class="font-semibold text-green-700 mb-2">Águas Claras</h5>
                                        <p class="text-green-600 text-sm mb-2">(61) 99609-6296</p>
                                        <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Vim pelo site!" 
                                           class="inline-flex items-center space-x-2 bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-full text-sm transition-colors">
                                            <i class="fab fa-whatsapp"></i>
                                            <span>Conversar</span>
                                        </a>
                                    </div>
                                    
                                    <div class="bg-blue-50 p-3 rounded-lg border-l-4 border-blue-500">
                                        <h5 class="font-semibold text-blue-700 mb-2">Taguatinga</h5>
                                        <p class="text-blue-600 text-sm mb-2">(61) 99931-8077</p>
                                        <a href="https://api.whatsapp.com/send?phone=5561999318077&text=Olá! Vim pelo site!" 
                                           class="inline-flex items-center space-x-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-full text-sm transition-colors">
                                            <i class="fab fa-whatsapp"></i>
                                            <span>Conversar</span>
                                        </a>
                                    </div>
                                    
                                    <div class="text-center pt-2">
                                        <p class="text-xs text-gray-500">Atendimento rápido e especializado</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Blog Button -->
                    <a href="{{ route('blog.index') }}" 
                       class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 p-3 rounded-full transition-colors duration-200 flex items-center justify-center" title="Blog">
                        <i class="fas fa-blog text-lg"></i>
                    </a>
                    
                    <!-- Localização Button -->
                    <div class="relative group">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition-colors duration-200 flex items-center justify-center" title="Localização">
                            <i class="fas fa-map-marker-alt text-lg"></i>
                        </button>
                        
                        <!-- Dropdown de localização -->
                        <div class="absolute top-full right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-800 mb-4 text-center">Nossas Lojas</h4>
                                
                                <div class="space-y-4">
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <h5 class="font-semibold text-blue-600 mb-2">Águas Claras</h5>
                                        <p class="text-gray-600 text-sm mb-3">Q 204 Alfa Mix Loja 15A - Águas Claras, Brasília</p>
                                        <iframe src="https://www.google.com/maps?q=Q%20204%20Alfa%20Mix%20Loja%2015A%2C%20%C3%81guas%20Claras%2C%20Bras%C3%ADlia%20-%20DF%2C%2071939-540&output=embed" 
                                                class="w-full h-24 rounded border-0" frameborder="0" allowfullscreen loading="lazy"></iframe>
                                    </div>
                                    
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <h5 class="font-semibold text-blue-600 mb-2">Taguatinga</h5>
                                        <p class="text-gray-600 text-sm mb-3">St. E Sul CSE 2 - Taguatinga Sul, Brasília</p>
                                        <iframe src="https://www.google.com/maps?q=St.%20E%20Sul%20CSE%202%20-%20Taguatinga%20Sul%2C%20Bras%C3%ADlia%20-%20DF%2C2072025-025&output=embed" 
                                                class="w-full h-24 rounded border-0" frameborder="0" allowfullscreen loading="lazy"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Usuário/Login Button -->
                    <div class="relative group">
                        <button class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 p-3 rounded-full transition-colors duration-200 flex items-center justify-center" title="Usuário">
                            <i class="fas fa-user text-lg"></i>
                        </button>
                        
                        <!-- Menu do usuário -->
                        <div class="absolute top-full right-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="p-4">
                                @guest
                                    <div class="space-y-2">
                                        <a href="{{ route('login') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-blue-600 transition-colors">
                                            <i class="fas fa-sign-in-alt text-blue-500"></i>
                                            <span>Entrar</span>
                                        </a>
                                        <a href="{{ route('register') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-green-600 transition-colors">
                                            <i class="fas fa-user-plus text-green-500"></i>
                                            <span>Registrar</span>
                                        </a>
                                    </div>
                                @else
                                    <div class="space-y-2">
                                        <div class="p-2 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                                            <span class="text-sm font-medium text-blue-800">Olá, {{ Auth::user()->name }}</span>
                                        </div>
                                        
                                        @if(Auth::user()->perfil === 'admin')
                                            <a href="/admin" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-purple-600 transition-colors">
                                                <i class="fas fa-cog text-purple-500"></i>
                                                <span>Painel Admin</span>
                                            </a>
                                            <a href="/dashboard" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-blue-600 transition-colors">
                                                <i class="fas fa-tachometer-alt text-blue-500"></i>
                                                <span>Dashboard</span>
                                            </a>
                                        @endif
                                        
                                        @if(Auth::user()->nivel_acesso === 'gerente')
                                            <a href="/gerente" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-red-600 transition-colors">
                                                <i class="fas fa-user-tie text-red-500"></i>
                                                <span>Painel Gerente</span>
                                            </a>
                                        @endif
                                        
                                        @if(Auth::user()->nivel_acesso === 'colaborador')
                                            <a href="/colaborador" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-orange-600 transition-colors">
                                                <i class="fas fa-user-friends text-orange-500"></i>
                                                <span>Painel Colaborador</span>
                                            </a>
                                        @endif
                                        
                                        <div class="border-t border-gray-200 my-2"></div>
                                        
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" 
                                           class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 text-gray-700 hover:text-red-600 transition-colors">
                                            <i class="fas fa-sign-out-alt text-red-500"></i>
                                            <span>Sair</span>
                                        </a>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Layout - Header limpo e organizado -->
            <div class="lg:hidden py-2">
                <!-- Logo otimizado para mobile -->
                <div class="flex justify-center mb-2">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('img/logohorizontal.png') }}" alt="Shopp Reparos" class="h-10 w-auto object-contain">
                    </a>
                </div>
                
                <!-- Botões essenciais apenas - 4 botões principais -->
                <div class="flex justify-center items-center space-x-4">
                    <!-- WhatsApp com Dropdown -->
                    <div class="relative">
                        <button id="whatsappBtn" 
                                class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition-colors duration-200 animate-pulse-slow shadow-lg" title="WhatsApp">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </button>
                        
                        <!-- Dropdown WhatsApp -->
                        <div id="whatsappDropdown" class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 hidden">
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-800 mb-3 text-center">Fale Conosco</h4>
                                
                                <div class="space-y-3">
                                    <div class="bg-green-50 p-3 rounded-lg border-l-4 border-green-500">
                                        <h5 class="font-semibold text-green-700 mb-2">Águas Claras</h5>
                                        <p class="text-green-600 text-sm mb-2">(61) 99609-6296</p>
                                        <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Vim pelo site!" 
                                           class="inline-flex items-center space-x-2 bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-full text-sm">
                                            <i class="fab fa-whatsapp"></i>
                                            <span>Conversar</span>
                                        </a>
                                    </div>
                                    
                                    <div class="bg-blue-50 p-3 rounded-lg border-l-4 border-blue-500">
                                        <h5 class="font-semibold text-blue-700 mb-2">Taguatinga</h5>
                                        <p class="text-blue-600 text-sm mb-2">(61) 99931-8077</p>
                                        <a href="https://api.whatsapp.com/send?phone=5561999318077&text=Olá! Vim pelo site!" 
                                           class="inline-flex items-center space-x-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-full text-sm">
                                            <i class="fab fa-whatsapp"></i>
                                            <span>Conversar</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Localização com Dropdown -->
                    <div class="relative">
                        <button id="locationBtn" 
                                class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition-colors duration-200 shadow-lg" title="Localização">
                            <i class="fas fa-map-marker-alt text-xl"></i>
                        </button>
                        
                        <!-- Dropdown Localização -->
                        <div id="locationDropdown" class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 hidden">
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-800 mb-3 text-center">Nossas Lojas</h4>
                                
                                <div class="space-y-3">
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <h5 class="font-semibold text-blue-600 mb-2">Águas Claras</h5>
                                        <p class="text-gray-600 text-sm mb-2">Q 204 Alfa Mix Loja 15A</p>
                                        <p class="text-gray-500 text-xs">Águas Claras, Brasília - DF</p>
                                        <div class="flex space-x-2 mt-2">
                                            <a href="https://maps.google.com/?q=Q+204+Alfa+Mix+Loja+15A,+Águas+Claras,+Brasília+-+DF" 
                                               target="_blank"
                                               class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-full text-sm text-center transition-colors">
                                                <i class="fas fa-map-marked-alt mr-1"></i>
                                                <span>Maps</span>
                                            </a>
                                            <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Vim pelo site!" 
                                               class="flex-1 bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-full text-sm text-center transition-colors">
                                                <i class="fab fa-whatsapp mr-1"></i>
                                                <span>WhatsApp</span>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <h5 class="font-semibold text-blue-600 mb-2">Taguatinga</h5>
                                        <p class="text-gray-600 text-sm mb-2">St. E Sul CSE 2</p>
                                        <p class="text-gray-500 text-xs">Taguatinga Sul, Brasília - DF</p>
                                        <div class="flex space-x-2 mt-2">
                                            <a href="https://share.google/vYHCBjEN96Ggz2SiY" 
                                               target="_blank"
                                               class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-full text-sm text-center transition-colors">
                                                <i class="fas fa-map-marked-alt mr-1"></i>
                                                <span>Maps</span>
                                            </a>
                                            <a href="https://api.whatsapp.com/send?phone=5561999318077&text=Olá! Vim pelo site!" 
                                               class="flex-1 bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-full text-sm text-center transition-colors">
                                                <i class="fab fa-whatsapp mr-1"></i>
                                                <span>WhatsApp</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Blog direto -->
                    <a href="{{ route('blog.index') }}" 
                       class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 p-3 rounded-full transition-colors duration-200 shadow-lg" title="Blog">
                        <i class="fas fa-blog text-xl"></i>
                    </a>
                    
                    <!-- Menu principal -->
                    <button id="mobile-menu-toggle" class="bg-primary-500 hover:bg-primary-600 text-white p-3 rounded-full transition-colors duration-200 shadow-lg">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Navegação Secundária - Apenas Desktop -->
        <nav class="hidden md:block bg-white border-t border-gray-100 shadow-sm">
            <div class="max-w-6xl mx-auto px-4">
                <!-- Desktop: Navegação completa -->
                <div class="hidden md:flex items-center justify-center space-x-8 py-3 overflow-x-auto">
                    @php
                        $currentPath = request()->path();
                        $currentUrl = request()->url();
                        $isActive = function($path) use ($currentPath, $currentUrl) {
                            if ($path === '/') {
                                return $currentPath === '' || $currentPath === '/';
                            }
                            $cleanPath = ltrim($path, '/');
                            return $currentPath === $cleanPath || strpos($currentPath, $cleanPath . '/') === 0;
                        };
                    @endphp
                    
                    <a href="/" class="relative px-3 py-2 font-semibold text-sm uppercase tracking-wide transition-all duration-200 whitespace-nowrap {{ $isActive('/') || $currentPath === '' ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                        HOME
                        @if($isActive('/') || $currentPath === '')
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-600 to-yellow-400 rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="/lojas" class="relative px-3 py-2 font-semibold text-sm uppercase tracking-wide transition-all duration-200 whitespace-nowrap {{ $isActive('lojas') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                        LOJAS
                        @if($isActive('lojas'))
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-600 to-yellow-400 rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="/reparos-hidraulicos" class="relative px-3 py-2 font-semibold text-sm uppercase tracking-wide transition-all duration-200 whitespace-nowrap {{ $isActive('reparos-hidraulicos') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                        REPAROS HIDRÁULICOS
                        @if($isActive('reparos-hidraulicos'))
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-600 to-yellow-400 rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="/site/produtos" class="relative px-3 py-2 font-semibold text-sm uppercase tracking-wide transition-all duration-200 whitespace-nowrap {{ $isActive('site/produtos') || $isActive('produtos') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                        PRODUTOS
                        @if($isActive('site/produtos') || $isActive('produtos'))
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-600 to-yellow-400 rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="/site/servicos" class="relative px-3 py-2 font-semibold text-sm uppercase tracking-wide transition-all duration-200 whitespace-nowrap {{ $isActive('site/servicos') || $isActive('servicos') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                        SERVIÇOS
                        @if($isActive('site/servicos') || $isActive('servicos'))
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-600 to-yellow-400 rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="/assistencia-tecnica" class="relative px-3 py-2 font-semibold text-sm uppercase tracking-wide transition-all duration-200 whitespace-nowrap {{ $isActive('assistencia-tecnica') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                        ASSISTÊNCIA TÉCNICA
                        @if($isActive('assistencia-tecnica'))
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-600 to-yellow-400 rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="/blog" class="relative px-3 py-2 font-semibold text-sm uppercase tracking-wide transition-all duration-200 whitespace-nowrap {{ $isActive('blog') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                        BLOG
                        @if($isActive('blog'))
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-600 to-yellow-400 rounded-full"></span>
                        @endif
                    </a>
                </div>
            </div>
        </nav>
        
        <!-- Mobile Menu - Dropdown vertical estilo aplicativo -->
        <div id="mobile-menu" class="lg:hidden hidden fixed inset-0 bg-black bg-opacity-50 z-50">
            <div class="absolute top-0 right-0 h-full w-80 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out">
                <!-- Header do menu -->
                <div class="bg-primary-600 text-white px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">Menu</h3>
                        <button id="mobile-menu-close" class="text-white hover:text-primary-200 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Conteúdo do menu -->
                <div class="overflow-y-auto h-full pb-16">
                    <nav class="py-3">
                        <!-- Links principais -->
                        <div class="px-4 mb-4">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Navegação</h4>
                            @php
                                $currentPath = request()->path();
                                $currentUrl = request()->url();
                                $isActive = function($path) use ($currentPath, $currentUrl) {
                                    if ($path === '/') {
                                        return $currentPath === '' || $currentPath === '/';
                                    }
                                    $cleanPath = ltrim($path, '/');
                                    return $currentPath === $cleanPath || strpos($currentPath, $cleanPath . '/') === 0;
                                };
                            @endphp
                            
                            <div class="space-y-0.5">
                                <a href="/" class="flex items-center py-2 px-3 rounded-lg transition-all duration-200 group {{ ($isActive('/') || $currentPath === '') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="fas fa-home mr-3 {{ ($isActive('/') || $currentPath === '') ? 'text-blue-600' : 'text-primary-500' }} w-4 group-hover:scale-110 transition-transform"></i>
                                    <span class="font-medium text-sm {{ ($isActive('/') || $currentPath === '') ? 'font-semibold' : '' }}">Home</span>
                                </a>
                                
                                <a href="/lojas" class="flex items-center py-2 px-3 rounded-lg transition-all duration-200 group {{ $isActive('lojas') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="fas fa-store mr-3 {{ $isActive('lojas') ? 'text-blue-600' : 'text-blue-500' }} w-4 group-hover:scale-110 transition-transform"></i>
                                    <span class="font-medium text-sm {{ $isActive('lojas') ? 'font-semibold' : '' }}">Nossas Lojas</span>
                                </a>
                                
                                <a href="/reparos-hidraulicos" class="flex items-center py-2 px-3 rounded-lg transition-all duration-200 group {{ $isActive('reparos-hidraulicos') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="fas fa-tint mr-3 {{ $isActive('reparos-hidraulicos') ? 'text-blue-600' : 'text-green-500' }} w-4 group-hover:scale-110 transition-transform"></i>
                                    <span class="font-medium text-sm {{ $isActive('reparos-hidraulicos') ? 'font-semibold' : '' }}">Reparos Hidráulicos</span>
                                </a>
                                
                                <a href="/site/produtos" class="flex items-center py-2 px-3 rounded-lg transition-all duration-200 group {{ ($isActive('site/produtos') || $isActive('produtos')) ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="fas fa-box mr-3 {{ ($isActive('site/produtos') || $isActive('produtos')) ? 'text-blue-600' : 'text-orange-500' }} w-4 group-hover:scale-110 transition-transform"></i>
                                    <span class="font-medium text-sm {{ ($isActive('site/produtos') || $isActive('produtos')) ? 'font-semibold' : '' }}">Produtos</span>
                                </a>
                                
                                <a href="/site/servicos" class="flex items-center py-3 px-3 rounded-lg transition-all duration-200 group {{ ($isActive('site/servicos') || $isActive('servicos')) ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="fas fa-tools mr-3 {{ ($isActive('site/servicos') || $isActive('servicos')) ? 'text-blue-600' : 'text-purple-500' }} w-4 group-hover:scale-110 transition-transform"></i>
                                    <span class="font-medium text-sm {{ ($isActive('site/servicos') || $isActive('servicos')) ? 'font-semibold' : '' }}">Serviços</span>
                                </a>
                                
                                <a href="/assistencia-tecnica" class="flex items-center py-2 px-3 rounded-lg transition-all duration-200 group {{ $isActive('assistencia-tecnica') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="fas fa-wrench mr-3 {{ $isActive('assistencia-tecnica') ? 'text-blue-600' : 'text-red-500' }} w-4 group-hover:scale-110 transition-transform"></i>
                                    <span class="font-medium text-sm {{ $isActive('assistencia-tecnica') ? 'font-semibold' : '' }}">Assistência Técnica</span>
                                </a>
                                
                                <a href="/blog" class="flex items-center py-2 px-3 rounded-lg transition-all duration-200 group {{ $isActive('blog') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="fas fa-blog mr-3 {{ $isActive('blog') ? 'text-blue-600' : 'text-blue-500' }} w-4 group-hover:scale-110 transition-transform"></i>
                                    <span class="font-medium text-sm {{ $isActive('blog') ? 'font-semibold' : '' }}">Blog</span>
                                </a>
                                
                                <a href="/contato" class="flex items-center py-2 px-3 rounded-lg transition-all duration-200 group {{ $isActive('contato') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="fas fa-envelope mr-3 {{ $isActive('contato') ? 'text-blue-600' : 'text-gray-500' }} w-4 group-hover:scale-110 transition-transform"></i>
                                    <span class="font-medium text-sm {{ $isActive('contato') ? 'font-semibold' : '' }}">Contato</span>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
                
                <!-- Seção de Contas - Ultra Mínima -->
                <div class="absolute bottom-0 left-0 right-0 bg-gray-900 text-white border-t border-gray-700">
                    <div class="px-2 py-1">
                        @guest
                            <!-- Usuário não logado - ultra mínimo -->
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-400">Bem-vindo!</span>
                                <div class="flex space-x-1">
                                    <a href="{{ route('login') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-1.5 py-0.5 rounded text-xs">
                                        Entrar
                                    </a>
                                    <a href="{{ route('register') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-1.5 py-0.5 rounded text-xs">
                                        Registrar
                                    </a>
                                </div>
                            </div>
                        @else
                            <!-- Usuário logado - ultra mínimo -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-1.5 min-w-0">
                                    <div class="w-4 h-4 bg-primary-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-user text-xs text-white"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-white font-medium truncate">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-0.5 flex-shrink-0">
                                    @if(Auth::user()->perfil === 'admin')
                                        <a href="/admin" class="bg-gray-700 hover:bg-gray-600 text-white p-0.5 rounded text-xs" title="Admin">
                                            <i class="fas fa-cog text-xs"></i>
                                        </a>
                                    @endif
                                    <a href="/dashboard" class="bg-gray-700 hover:bg-gray-600 text-white p-0.5 rounded text-xs" title="Dashboard">
                                        <i class="fas fa-tachometer-alt text-xs"></i>
                                    </a>
                                    <button onclick="event.preventDefault();document.getElementById('logout-form').submit();" 
                                            class="bg-red-600 hover:bg-red-700 text-white p-0.5 rounded text-xs" title="Sair">
                                        <i class="fas fa-sign-out-alt text-xs"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    <!-- Espaçamento antes do footer -->
    <div class="footer-spacer"></div>
    
    <!-- Footer -->
    <footer class="bg-blue-900 text-white relative overflow-hidden">
        <!-- Elemento decorativo sutil -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-800/20 via-transparent to-blue-700/20"></div>
        
        <div class="relative z-10">
                    <!-- Conteúdo principal do footer -->
        <div class="max-w-6xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                    <!-- Logo & Info - Coluna principal -->
                    <div class="lg:col-span-1 space-y-6">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('img/logohorizontal.png') }}" alt="Shopp Reparos" class="h-12 w-auto object-contain brightness-0 invert">
                            <div class="h-8 w-px bg-blue-300"></div>
                        </div>
                        <p class="text-blue-100 leading-relaxed text-sm">
                            Especialistas em soluções completas para reparos hidráulicos, elétricos e manutenção predial com qualidade e confiança.
                        </p>
                        
                        <!-- Redes sociais com cores alinhadas -->
                        <div class="flex space-x-4">
                            <a href="#" class="group relative">
                                <div class="w-10 h-10 bg-blue-600 hover:bg-blue-500 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg">
                                    <i class="fab fa-facebook-f text-white text-lg"></i>
                                </div>
                                <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                                    Facebook
                                </span>
                            </a>
                            
                            <a href="#" class="group relative">
                                <div class="w-10 h-10 bg-blue-600 hover:bg-blue-500 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg">
                                    <i class="fab fa-instagram text-white text-lg"></i>
                                </div>
                                <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                                    Instagram
                                </span>
                            </a>
                            
                            <a href="#" class="group relative">
                                <div class="w-10 h-10 bg-green-600 hover:bg-green-500 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg">
                                    <i class="fab fa-whatsapp text-white text-lg"></i>
                                </div>
                                <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                                    WhatsApp
                                </span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Links Rápidos - Estilo card simplificado -->
                    <div class="space-y-6">
                        <div class="bg-blue-800/30 rounded-xl p-6 border border-blue-700/50">
                            <h3 class="text-lg font-semibold mb-4 text-white flex items-center">
                                <i class="fas fa-link mr-3 text-blue-300"></i>
                                Links Rápidos
                            </h3>
                            <ul class="space-y-3">
                                <li>
                                    <a href="{{ route('home') }}" class="flex items-center text-blue-100 hover:text-white transition-all duration-200 group">
                                        <i class="fas fa-chevron-right text-xs text-blue-300 mr-3 group-hover:translate-x-1 transition-transform"></i>
                                        <span class="text-sm">Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/site/produtos" class="flex items-center text-blue-100 hover:text-white transition-all duration-200 group">
                                        <i class="fas fa-chevron-right text-xs text-blue-300 mr-3 group-hover:translate-x-1 transition-transform"></i>
                                        <span class="text-sm">Produtos</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/site/servicos" class="flex items-center text-blue-100 hover:text-white transition-all duration-200 group">
                                        <i class="fas fa-chevron-right text-xs text-blue-300 mr-3 group-hover:translate-x-1 transition-transform"></i>
                                        <span class="text-sm">Serviços</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('blog.index') }}" class="flex items-center text-blue-100 hover:text-white transition-all duration-200 group">
                                        <i class="fas fa-chevron-right text-xs text-blue-300 mr-3 group-hover:translate-x-1 transition-transform"></i>
                                        <span class="text-sm">Blog</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/contato" class="flex items-center text-blue-100 hover:text-white transition-all duration-200 group">
                                        <i class="fas fa-chevron-right text-xs text-blue-300 mr-3 group-hover:translate-x-1 transition-transform"></i>
                                        <span class="text-sm">Contato</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Serviços - Estilo card simplificado -->
                    <div class="space-y-6">
                        <div class="bg-blue-800/30 rounded-xl p-6 border border-blue-700/50">
                            <h3 class="text-lg font-semibold mb-4 text-white flex items-center">
                                <i class="fas fa-tools mr-3 text-blue-300"></i>
                                Nossos Serviços
                            </h3>
                            <ul class="space-y-3">
                                <li>
                                    <a href="/reparos-hidraulicos" class="flex items-center text-blue-100 hover:text-white transition-all duration-200 group">
                                        <i class="fas fa-tint text-xs text-blue-300 mr-3 group-hover:scale-110 transition-transform"></i>
                                        <span class="text-sm">Reparos Hidráulicos</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/assistencia-tecnica" class="flex items-center text-blue-100 hover:text-white transition-all duration-200 group">
                                        <i class="fas fa-wrench text-xs text-blue-300 mr-3 group-hover:scale-110 transition-transform"></i>
                                        <span class="text-sm">Assistência Técnica</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-blue-100 hover:text-white transition-all duration-200 group">
                                        <i class="fas fa-building text-xs text-blue-300 mr-3 group-hover:scale-110 transition-transform"></i>
                                        <span class="text-sm">Manutenção Predial</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-blue-100 hover:text-white transition-all duration-200 group">
                                        <i class="fas fa-bolt text-xs text-blue-300 mr-3 group-hover:scale-110 transition-transform"></i>
                                        <span class="text-sm">Instalações Elétricas</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Contato - Estilo card simplificado -->
                    <div class="space-y-6">
                        <div class="bg-blue-800/30 rounded-xl p-6 border border-blue-700/50">
                            <h3 class="text-lg font-semibold mb-4 text-white flex items-center">
                                <i class="fas fa-phone mr-3 text-blue-300"></i>
                                Contato
                            </h3>
                            <div class="space-y-4">
                                <!-- Águas Claras -->
                                <div class="bg-blue-700/40 rounded-lg p-3 border border-blue-600/50">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-map-marker-alt text-white text-sm"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-blue-200 text-sm">Águas Claras</p>
                                            <p class="text-blue-100 text-xs leading-tight">Q 204 Alfa Mix Loja 15A</p>
                                            <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Vim pelo site!" 
                                               class="inline-flex items-center mt-2 text-xs text-blue-200 hover:text-white transition-colors">
                                                <i class="fab fa-whatsapp mr-1"></i>
                                                WhatsApp
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Taguatinga -->
                                <div class="bg-blue-700/40 rounded-lg p-3 border border-blue-600/50">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-map-marker-alt text-white text-sm"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-blue-200 text-sm">Taguatinga</p>
                                            <p class="text-blue-100 text-xs leading-tight">St. E Sul CSE 2</p>
                                            <a href="https://api.whatsapp.com/send?phone=5561999318077&text=Olá! Vim pelo site!" 
                                               class="inline-flex items-center mt-2 text-xs text-blue-200 hover:text-white transition-colors">
                                                <i class="fab fa-whatsapp mr-1"></i>
                                                WhatsApp
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Telefones -->
                                <div class="flex items-center space-x-3 pt-2">
                                    <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-phone text-white text-sm"></i>
                                    </div>
                                    <div class="text-sm">
                                        <p class="text-blue-100">(61) 99609-6296</p>
                                        <p class="text-blue-100">(61) 99931-8077</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Linha separadora simplificada -->
            <div class="border-t border-blue-700">
                <div class="max-w-6xl mx-auto px-4 py-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                        <!-- Copyright -->
                        <div class="text-center sm:text-left">
                            <p class="text-blue-200 text-sm">
                                &copy; {{ date('Y') }} <span class="font-semibold text-white">Shopp Reparos</span>. Todos os direitos reservados.
                            </p>
                        </div>
                        
                        <!-- Links legais -->
                        <div class="flex items-center space-x-6 text-sm">
                            <a href="#" class="text-blue-200 hover:text-white transition-colors">Política de Privacidade</a>
                            <a href="#" class="text-blue-200 hover:text-white transition-colors">Termos de Uso</a>
                            <a href="#" class="text-blue-200 hover:text-white transition-colors">Cookies</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Elementos decorativos sutis -->
        <div class="absolute top-0 left-0 w-32 h-32 bg-blue-800/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-40 h-40 bg-blue-700/20 rounded-full blur-3xl"></div>
    </footer>
    
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
                // Pequeno delay para garantir que o elemento está visível antes da animação
                setTimeout(() => {
                    mobileMenu.querySelector('.absolute').classList.add('translate-x-0');
                    mobileMenu.querySelector('.absolute').classList.remove('translate-x-full');
                }, 10);
                body.classList.add('mobile-menu-open');
                
                // Prevenir scroll no body quando menu estiver aberto
                if (window.innerWidth <= 768) {
                    body.style.overflow = 'hidden';
                }
            }
            
            // Função para fechar menu mobile com animação
            function closeMobileMenu() {
                mobileMenu.querySelector('.absolute').classList.remove('translate-x-0');
                mobileMenu.querySelector('.absolute').classList.add('translate-x-full');
                
                // Aguardar a animação terminar antes de esconder
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    body.classList.remove('mobile-menu-open');
                    
                    // Restaurar scroll
                    if (window.innerWidth <= 768) {
                        body.style.overflow = '';
                    }
                }, 300);
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
            document.addEventListener('click', function(e) {
                if (!mobileMenuToggle.contains(e.target) && !mobileMenu.contains(e.target) && (!mobileMenuClose || !mobileMenuClose.contains(e.target))) {
                    closeMobileMenu();
                }
            });
            
            // Fechar menu ao redimensionar para desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
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
