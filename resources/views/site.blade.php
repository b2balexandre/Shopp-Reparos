@extends('layouts.site')

@section('title', 'Shopp Reparos | Ferragens, Hidráulica, Elétrica e Serviços em Brasília')
@section('description', 'Shopp Reparos oferece ferragens, hidráulica, elétrica, ferramentas, assistência técnica e serviços especializados em Águas Claras e Taguatinga. Atendimento rápido pelo WhatsApp.')

@push('meta')
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1EWW9KM5F2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-1EWW9KM5F2');
    </script>
    <meta name="google-site-verification" content="ZQmbqwogObdR4NMxb9qRSihILN5ftW2hnsQo7xYQKCM" />
    <meta name="robots" content="index, follow" />
    
    <!-- CSS Adicional -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('especialistas.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/servicos.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/produtos.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/parceiros.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    
    <!-- Estilos Críticos Inline para Garantir Funcionamento em Produção -->
    <style>
        /* Estilos críticos para Serviços */
        .servicos-section {
            background: #ffffff !important;
            padding: 60px 0 !important;
            margin: 40px 0 !important;
            border-radius: 20px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
        }
        
        .servicos-section .section-title {
            text-align: center !important;
            font-size: 2.5rem !important;
            font-weight: 700 !important;
            color: #1e3a8a !important;
            margin-bottom: 40px !important;
        }
        
        .servicos-grid {
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important;
            gap: 25px !important;
            padding: 0 !important;
            margin: 0 auto !important;
            width: 100% !important;
            max-width: 72rem !important; /* Largura máxima para não esticar */
        }
        
        .servico-card {
            background: #ffffff !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
            overflow: visible !important; /* Corrigido para evitar corte */
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            color: inherit !important;
            border: 1px solid #f3f4f6 !important;
            display: flex !important;
            flex-direction: column !important;
            min-height: 420px !important; /* Altura mínima para evitar corte */
            height: auto !important; /* Altura automática */
            position: relative !important;
        }
        
        .servico-card:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15) !important;
            z-index: 10 !important; /* Elevar no hover */
        }
        
        .servico-image {
            height: 200px !important;
            min-height: 200px !important;
            overflow: hidden !important;
            background: #f8fafc !important;
            border-radius: 16px 16px 0 0 !important;
        }
        
        .servico-image img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            transition: transform 0.3s ease !important;
        }
        
        .servico-card:hover .servico-image img {
            transform: scale(1.05) !important;
        }
        
        .servico-placeholder {
            width: 100% !important;
            height: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: #e2e8f0 !important;
            color: #64748b !important;
            font-size: 3rem !important;
        }
        
        .servico-info {
            padding: 20px !important;
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            text-align: center !important;
            min-height: 180px !important; /* Altura mínima para o conteúdo */
        }
        
        .servico-titulo {
            font-size: 1.1rem !important;
            font-weight: 600 !important;
            color: #1f2937 !important;
            margin: 0 !important;
            line-height: 1.4 !important;
            min-height: 2.8rem !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
            text-align: center !important;
            word-wrap: break-word !important;
            hyphens: auto !important;
        }
        
        .servico-valor {
            display: block !important;
            font-size: 1.3rem !important;
            font-weight: 700 !important;
            color: #059669 !important;
            margin: 0 !important;
            text-align: center !important;
            padding: 8px 0 !important;
        }
        
        .ver-servico {
            width: 100% !important;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8) !important;
            color: white !important;
            border: none !important;
            padding: 12px 20px !important;
            border-radius: 25px !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            margin-top: auto !important; /* Empurra o botão para baixo */
            text-align: center !important;
            flex-shrink: 0 !important; /* Impede que o botão encolha */
        }
        
        .ver-servico:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af) !important;
            transform: translateY(-2px) !important;
        }
        
        .servico-sem-servicos {
            grid-column: 1 / -1 !important;
            text-align: center !important;
            padding: 60px 20px !important;
        }
        
        .servico-sem-servicos h3 {
            font-size: 1.5rem !important;
            font-weight: 600 !important;
            color: #64748b !important;
            margin-bottom: 12px !important;
        }
        
        .servico-sem-servicos p {
            color: #94a3b8 !important;
            font-size: 1.1rem !important;
        }
        
        .servicos-filter {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            margin-bottom: 30px !important;
            justify-content: center !important;
        }
        
        .servicos-filter label {
            font-weight: 600 !important;
            color: #374151 !important;
            font-size: 1.1rem !important;
        }
        
        .servicos-filter select {
            padding: 8px 16px !important;
            border: 2px solid #e5e7eb !important;
            border-radius: 8px !important;
            background: white !important;
            color: #374151 !important;
            font-size: 1rem !important;
            cursor: pointer !important;
            transition: border-color 0.3s ease !important;
        }
        
        .servicos-filter select:focus {
            outline: none !important;
            border-color: #3b82f6 !important;
        }
        
        /* Responsividade para serviços */
        @media (max-width: 768px) {
            .servicos-grid {
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)) !important;
                gap: 20px !important;
            }
            
            .servico-card {
                min-height: 380px !important;
                overflow: visible !important;
            }
            
            .servico-info {
                min-height: 160px !important;
            }
        }
        
        @media (max-width: 640px) {
            .servicos-grid {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
                padding: 0 10px !important;
            }
            
            .servico-card {
                min-height: 360px !important;
                margin: 0 auto !important;
                max-width: 320px !important;
            }
        }
        
        @media (max-width: 480px) {
            .servico-card {
                min-height: 340px !important;
            }
            
            .servico-info {
                min-height: 140px !important;
            }
        }
        
        /* Estilos críticos para Produtos */
        .produtos-section {
            background: #ffffff !important;
            padding: 60px 0 !important;
            margin: 40px 0 !important;
            border-radius: 20px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
        }
        
        .produtos-section .section-title {
            text-align: center !important;
            font-size: 2.5rem !important;
            font-weight: 700 !important;
            color: #1e3a8a !important;
            margin-bottom: 40px !important;
        }
        
        .produtos-grid {
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
            gap: 30px !important;
        }
        
        .produto-card {
            background: #ffffff !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            color: inherit !important;
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            min-height: 400px !important; /* Altura mínima aumentada */
        }
        
        .produto-card:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15) !important;
        }
        
        .produto-image {
            height: 200px !important;
            min-height: 200px !important;
            max-height: 200px !important;
            overflow: hidden !important;
            background: #f8fafc !important;
            flex-shrink: 0 !important; /* Impede que a imagem encolha */
        }
        
        .produto-image img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            transition: transform 0.3s ease !important;
        }
        
        .produto-card:hover .produto-image img {
            transform: scale(1.05) !important;
        }
        
        .produto-placeholder {
            width: 100% !important;
            height: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: #e2e8f0 !important;
            color: #64748b !important;
            font-size: 3rem !important;
        }
        
        .produto-info {
            padding: 20px !important;
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            min-height: 160px !important; /* Altura mínima para o conteúdo */
        }
        
        .produto-titulo {
            font-size: 1.25rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
            margin-bottom: 12px !important;
            line-height: 1.4 !important;
            min-height: 3.5rem !important; /* Altura mínima para o título */
            max-height: 3.5rem !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
            word-wrap: break-word !important;
            hyphens: auto !important;
        }
        
        .produto-valor {
            display: block !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            color: #059669 !important;
            margin-bottom: 16px !important;
            flex-shrink: 0 !important; /* Impede que o valor encolha */
        }
        
        .ver-produto {
            width: 100% !important;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8) !important;
            color: white !important;
            border: none !important;
            padding: 12px 20px !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            margin-top: auto !important; /* Empurra o botão para baixo */
            flex-shrink: 0 !important; /* Impede que o botão encolha */
        }
        
        .ver-produto:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af) !important;
            transform: translateY(-2px) !important;
        }
        
        /* Responsividade para mobile - Produtos */
        @media (max-width: 768px) {
            .produto-card {
                min-height: 380px !important;
            }
            
            .produto-image {
                height: 180px !important;
                min-height: 180px !important;
                max-height: 180px !important;
            }
            
            .produto-info {
                padding: 16px !important;
                min-height: 140px !important;
            }
            
            .produto-titulo {
                font-size: 1.1rem !important;
                min-height: 3rem !important;
                max-height: 3rem !important;
            }
        }
        
        @media (max-width: 480px) {
            .produto-card {
                min-height: 360px !important;
            }
            
            .produto-image {
                height: 160px !important;
                min-height: 160px !important;
                max-height: 160px !important;
            }
            
            .produto-info {
                padding: 14px !important;
                min-height: 130px !important;
            }
            
            .produto-titulo {
                font-size: 1rem !important;
                min-height: 2.8rem !important;
                max-height: 2.8rem !important;
            }
        }
        
        .produto-sem-produtos {
            grid-column: 1 / -1 !important;
            text-align: center !important;
            padding: 60px 20px !important;
        }
        
        .produto-sem-produtos h3 {
            font-size: 1.5rem !important;
            font-weight: 600 !important;
            color: #64748b !important;
            margin-bottom: 12px !important;
        }
        
        .produto-sem-produtos p {
            color: #94a3b8 !important;
            font-size: 1.1rem !important;
        }
        
        .produtos-filter {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            margin-bottom: 30px !important;
            justify-content: center !important;
        }
        
        .produtos-filter label {
            font-weight: 600 !important;
            color: #374151 !important;
            font-size: 1.1rem !important;
        }
        
        .produtos-filter select {
            padding: 8px 16px !important;
            border: 2px solid #e5e7eb !important;
            border-radius: 8px !important;
            background: white !important;
            color: #374151 !important;
            font-size: 1rem !important;
            cursor: pointer !important;
            transition: border-color 0.3s ease !important;
        }
        
        .produtos-filter select:focus {
            outline: none !important;
            border-color: #3b82f6 !important;
        }
        
        /* Estilos críticos para Parceiros */
        .parceiros {
            background: #ffffff !important;
            padding: 60px 0 !important;
            margin: 40px 0 !important;
            border-radius: 20px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
            overflow: hidden !important;
            width: 100% !important;
        }
        
        .parceiros .max-w-6xl {
            max-width: 72rem !important;
            margin: 0 auto !important;
            padding: 0 1rem !important;
            overflow: hidden !important;
        }
        
        .parceiros h2 {
            text-align: center !important;
            font-size: 2.5rem !important;
            font-weight: 700 !important;
            color: #1e3a8a !important;
            margin-bottom: 40px !important;
        }
        
        .parceiros-grid {
            display: flex !important;
            gap: 100px !important;
            animation: scrollParceiros 30s linear infinite !important;
            width: max-content !important;
            max-width: none !important;
            overflow: visible !important;
        }
        
        .carrossel-parceiros-simples {
            position: relative !important;
            overflow: hidden !important;
            padding: 20px 0 !important;
            width: 100% !important;
        }
        
        .parceiro-item {
            flex: 0 0 350px !important;
            height: 250px !important;
            background: #ffffff !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.3s ease !important;
            border: 1px solid #f3f4f6 !important;
            min-width: 350px !important;
            max-width: 350px !important;
        }
        
        .parceiro-item img {
            max-width: 95% !important;
            max-height: 95% !important;
            object-fit: contain !important;
            filter: grayscale(100%) !important;
            transition: all 0.3s ease !important;
        }
        
        @keyframes scrollParceiros {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        /* Estilos críticos para Banners */
        /* Centralização perfeita para todos os banners */
        .carrossel,
        .carrossel-mobile {
            position: relative !important;
            /* Removido left e transform para usar margens naturais */
        }
        
        /* Garante que as bordas arredondadas sejam aplicadas no container, não na imagem */
        .carrossel-mobile .slide img {
            border-radius: 0 !important; /* Remove bordas da imagem */
        }
        
        /* Garantir que o banner ocupe toda a largura disponível */
        .carrossel,
        .carrossel-mobile {
            box-sizing: border-box !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        
        /* CORREÇÃO FINAL: Sobrescrever TODOS os estilos conflitantes */
        .carrossel {
            position: relative !important;
            width: 100% !important;
            max-width: 100% !important;
            height: 350px !important;
            margin: 0 0 30px 0 !important;
            overflow: hidden !important;
            border-radius: 20px !important;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15) !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            left: auto !important;
            right: auto !important;
            transform: none !important;
        }
        
        .carrossel-mobile {
            position: relative !important;
            width: 100% !important;
            max-width: 100% !important;
            aspect-ratio: 1/1 !important;
            margin: 0 auto 30px auto !important;
            overflow: hidden !important;
            border-radius: 20px !important;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15) !important;
            display: none !important;
            visibility: visible !important;
            opacity: 1 !important;
            left: auto !important;
            right: auto !important;
            transform: none !important;
            padding: 0 !important;
            background: transparent !important;
            clip-path: inset(0 round 20px) !important;
        }
        
        /* Forçar exibição correta em mobile */
        @media (max-width: 768px) {
            .carrossel {
                display: none !important;
            }
            
            .carrossel-mobile {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 auto 30px auto !important;
                padding: 0 !important;
                left: auto !important;
                right: auto !important;
                transform: none !important;
            }
        }
        
        /* Garantir que o container não interfira */
        .max-w-6xl .carrossel,
        .max-w-6xl .carrossel-mobile {
            width: 100% !important;
            max-width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
            left: auto !important;
            right: auto !important;
            transform: none !important;
        }
        
        .carrossel .slides {
            display: flex !important;
            transition: transform 0.5s ease-in-out !important;
            overflow: hidden !important;
            height: 100% !important;
            width: 100% !important;
        }
        
        .carrossel .slide {
            min-width: 100% !important;
            height: 100% !important;
            position: relative !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            display: none !important;
        }
        
        .carrossel .slide.ativo {
            display: block !important;
        }
        
        .carrossel .slide img {
            width: 100% !important;
            height: 100% !important;
            object-fit: contain !important;
            object-position: center !important;
            display: block !important;
            background: #f8fafc !important;
        }
        
        .carrossel .seta {
            position: absolute !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            background: rgba(0, 0, 0, 0.5) !important;
            color: white !important;
            border: none !important;
            padding: 15px 20px !important;
            cursor: pointer !important;
            font-size: 18px !important;
            border-radius: 50% !important;
            transition: all 0.3s ease !important;
            z-index: 10 !important;
        }
        
        .carrossel .seta:hover {
            background: rgba(0, 0, 0, 0.8) !important;
        }
        
        .carrossel .seta.esquerda {
            left: 20px !important;
        }
        
        .carrossel .seta.direita {
            right: 20px !important;
        }
        
        .carrossel .indicadores {
            position: absolute !important;
            bottom: 20px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            display: flex !important;
            gap: 10px !important;
            z-index: 10 !important;
            margin-top: 0 !important; /* Remove margem do CSS externo */
        }
        
        .carrossel .indicadores .bolinha {
            width: 12px !important;
            height: 12px !important;
            border-radius: 50% !important;
            background: rgba(255, 255, 255, 0.5) !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
        }
        
        .carrossel .indicadores .bolinha.ativo {
            background: white !important;
            transform: scale(1.2) !important;
        }
        
        .carrossel-mobile .slides {
            display: flex !important;
            transition: transform 0.5s ease-in-out !important;
            overflow: hidden !important;
        }
        
        .carrossel-mobile .slide {
            min-width: 100% !important;
            aspect-ratio: 1/1 !important; /* Formato quadrado */
            position: relative !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            display: none !important;
        }
        
        .carrossel-mobile .slide.ativo {
            display: block !important;
        }
        
        .carrossel-mobile .slide img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
            display: block !important;
            border-radius: 0 !important; /* Remove bordas da imagem */
        }
        
        .carrossel-mobile .seta {
            position: absolute !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            background: rgba(0, 0, 0, 0.5) !important;
            color: white !important;
            border: none !important;
            padding: 12px 16px !important;
            cursor: pointer !important;
            font-size: 16px !important;
            border-radius: 50% !important;
            transition: all 0.3s ease !important;
            z-index: 10 !important;
        }
        
        .carrossel-mobile .seta:hover {
            background: rgba(0, 0, 0, 0.8) !important;
        }
        
        .carrossel-mobile .seta.esquerda {
            left: 15px !important;
        }
        
        .carrossel-mobile .seta.direita {
            right: 15px !important;
        }
        
        .carrossel-mobile .indicadores {
            position: absolute !important;
            bottom: 15px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            display: flex !important;
            gap: 8px !important;
            z-index: 10 !important;
            margin-top: 0 !important; /* Remove margem do CSS externo */
        }
        
        .carrossel-mobile .indicadores .bolinha {
            width: 10px !important;
            height: 10px !important;
            border-radius: 50% !important;
            background: rgba(255, 255, 255, 0.5) !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
        }
        
        .carrossel-mobile .indicadores .bolinha.ativo {
            background: white !important;
            transform: scale(1.2) !important;
        }
        
        /* Responsividade crítica */
        @media (max-width: 768px) {
            /* Esconde banner desktop e mostra mobile */
            .carrossel {
                display: none !important;
            }
            
            /* Container centralizado para banners mobile */
            .carrossel-mobile {
                display: block !important;
                position: relative !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 auto 30px auto !important;
                padding: 0 !important;
                box-sizing: border-box !important;
                border-radius: 20px !important;
                overflow: hidden !important;
                aspect-ratio: 1/1 !important;
            }
            
            .carrossel-mobile .slide {
                aspect-ratio: 1/1 !important;
            }
            
            .carrossel-mobile .slide img {
                object-fit: cover !important;
                object-position: center !important;
            }
        }
        
        @media (max-width: 480px) {
            /* Otimizações para smartphones */
            .carrossel-mobile {
                border-radius: 15px !important;
                margin: 0 auto 25px auto !important;
            }
        }
        
        /* Garantir que os banners sejam sempre visíveis e alinhados */
        .carrossel,
        .carrossel-mobile {
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        /* Forçar alinhamento perfeito em todos os dispositivos DESKTOP */
        @media (min-width: 769px) and (max-width: 1920px) {
            .carrossel {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                left: auto !important;
                right: auto !important;
                transform: none !important;
                height: 350px !important;
            }
            
            .carrossel .slide {
                height: 100% !important;
            }
            
            .carrossel .slide img {
                object-fit: contain !important;
                object-position: center !important;
            }
        }
        
        /* Para telas muito largas (ultrawide) */
        @media (min-width: 1921px) {
            .carrossel {
                max-width: 100% !important;
                margin: 0 !important;
                height: 400px !important;
            }
        }
        
        /* Garantir que o container principal não interfira no banner */
        .max-w-6xl {
            overflow: visible !important;
        }
        
        /* Container específico para o banner */
        .banner-container {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
        }
        
        /* Remover espaçamento entre banner e stories */
        .container-stories {
            margin-top: 20px !important;
        }
        
        /* Estilos críticos para Produtos e Serviços */
        .produtos-section {
            background: #ffffff !important;
            padding: 60px 0 !important;
            margin: 40px 0 !important;
            border-radius: 20px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
        }
        
        .produtos-section .section-title {
            text-align: center !important;
            font-size: 2.5rem !important;
            font-weight: 700 !important;
            color: #1e3a8a !important;
            margin-bottom: 40px !important;
        }
        
        .produtos-grid {
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important;
            gap: 25px !important;
            padding: 0 !important;
            margin: 0 auto !important;
            width: 100% !important;
            max-width: 72rem !important; /* Largura máxima para não esticar */
        }
        
        .produto-card {
            background: #ffffff !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
            overflow: visible !important; /* Corrigido para evitar corte */
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            color: inherit !important;
            border: 1px solid #f3f4f6 !important;
            display: flex !important;
            flex-direction: column !important;
            min-height: 420px !important; /* Altura mínima para evitar corte */
            height: auto !important; /* Altura automática */
            position: relative !important;
        }
        
        .produto-card:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15) !important;
            z-index: 10 !important; /* Elevar no hover */
        }
        
        .produto-image {
            height: 200px !important;
            min-height: 200px !important;
            overflow: hidden !important;
            background: #f8fafc !important;
            border-radius: 16px 16px 0 0 !important;
        }
        
        .produto-image img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            transition: transform 0.3s ease !important;
        }
        
        .produto-card:hover .produto-image img {
            transform: scale(1.05) !important;
        }
        
        .produto-placeholder {
            width: 100% !important;
            height: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: #e2e8f0 !important;
            color: #64748b !important;
            font-size: 3rem !important;
        }
        
        .produto-info {
            padding: 20px !important;
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            text-align: center !important;
            min-height: 180px !important; /* Altura mínima para o conteúdo */
        }
        
        .produto-nome {
            font-size: 1.1rem !important;
            font-weight: 600 !important;
            color: #1f2937 !important;
            margin: 0 !important;
            line-height: 1.4 !important;
            min-height: 2.8rem !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
            text-align: center !important;
            word-wrap: break-word !important;
            hyphens: auto !important;
        }
        
        .produto-preco {
            display: block !important;
            font-size: 1.4rem !important;
            font-weight: 700 !important;
            color: #059669 !important;
            margin: 0 !important;
            text-align: center !important;
            padding: 8px 0 !important;
        }
        
        .ver-detalhes {
            width: 100% !important;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8) !important;
            color: white !important;
            border: none !important;
            padding: 12px 20px !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            margin-top: auto !important; /* Empurra o botão para baixo */
            text-align: center !important;
            flex-shrink: 0 !important; /* Impede que o botão encolha */
        }
        
        .ver-detalhes:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af) !important;
            transform: translateY(-2px) !important;
        }
        
        .produto-sem-produtos {
            grid-column: 1 / -1 !important;
            text-align: center !important;
            padding: 60px 20px !important;
        }
        
        .produto-sem-produtos h3 {
            font-size: 1.5rem !important;
            font-weight: 600 !important;
            color: #64748b !important;
            margin-bottom: 12px !important;
        }
        
        .produto-sem-produtos p {
            color: #94a3b8 !important;
            font-size: 1.1rem !important;
        }
        
        .produtos-filter {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            margin-bottom: 30px !important;
            justify-content: center !important;
        }
        
        .produtos-filter label {
            font-weight: 600 !important;
            color: #374151 !important;
            font-size: 1.1rem !important;
        }
        
        .produtos-filter select {
            padding: 8px 16px !important;
            border: 2px solid #e5e7eb !important;
            border-radius: 8px !important;
            background: white !important;
            color: #374151 !important;
            font-size: 1rem !important;
            cursor: pointer !important;
            transition: border-color 0.3s ease !important;
        }
        
        .produtos-filter select:focus {
            outline: none !important;
            border-color: #3b82f6 !important;
        }
        
        /* Botão Ver Mais */
        .ver-mais-btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.5rem !important;
            background: linear-gradient(135deg, #1e40af, #3b82f6) !important;
            color: white !important;
            padding: 1rem 2rem !important;
            border-radius: 12px !important;
            font-size: 1.1rem !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3) !important;
        }
        
        .ver-mais-btn:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important;
            color: white !important;
            text-decoration: none !important;
        }
        
        .ver-mais-btn i {
            font-size: 1.2rem !important;
        }
        
        /* Responsividade para produtos e serviços */
        @media (max-width: 768px) {
            .produtos-grid {
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)) !important;
                gap: 20px !important;
            }
            
            .produto-card {
                min-height: 380px !important;
                overflow: visible !important;
            }
            
            .produto-info {
                min-height: 160px !important;
            }
        }
        
        @media (max-width: 640px) {
            .produtos-grid {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
                padding: 0 10px !important;
            }
            
            .produto-card {
                min-height: 360px !important;
                margin: 0 auto !important;
                max-width: 320px !important;
            }
        }
        
        @media (max-width: 480px) {
            .produto-card {
                min-height: 340px !important;
            }
            
            .produto-info {
                min-height: 140px !important;
            }
        }

        /* Estilos modernos para os cards */
        .moderno-card {
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            overflow: hidden !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        }
        
        .moderno-card:hover {
            transform: translateY(-4px) !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }
        
        .moderno-image {
            height: 220px !important;
            min-height: 220px !important;
            max-height: 220px !important;
            overflow: hidden !important;
            background: #f8fafc !important;
            border-radius: 16px 16px 0 0 !important;
        }
        
        .moderno-image img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            transition: transform 0.3s ease !important;
        }
        
        .moderno-card:hover .moderno-image img {
            transform: scale(1.05) !important;
        }
        
        .moderno-info {
            padding: 16px !important;
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 10px !important;
            text-align: center !important;
            min-height: 180px !important; /* Altura mínima para o conteúdo */
        }
        
        .moderno-nome {
            font-size: 1.2rem !important;
            font-weight: 600 !important;
            color: #1f2937 !important;
            margin: 0 !important;
            line-height: 1.4 !important;
            min-height: 3rem !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
            text-align: center !important;
            word-wrap: break-word !important;
            hyphens: auto !important;
        }
        
        .moderno-preco {
            display: block !important;
            font-size: 1.4rem !important;
            font-weight: 700 !important;
            color: #059669 !important;
            margin: 0 !important;
            text-align: center !important;
            padding: 8px 0 !important;
        }
        
        .moderno-btn {
            width: 100% !important;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8) !important;
            color: white !important;
            border: none !important;
            padding: 12px 0 !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            margin-top: auto !important; /* Empurra o botão para baixo */
            text-align: center !important;
            flex-shrink: 0 !important; /* Impede que o botão encolha */
        }
        
        .moderno-btn:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af) !important;
            transform: translateY(-2px) !important;
        }

        /* Ensure consistent card height and width */
        .produto-card, .servico-card {
            height: 100% !important;
            min-height: 400px !important; /* Consistent minimum height */
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
        }

        .produto-image, .servico-image {
            height: 200px !important; /* Consistent image height */
            min-height: 200px !important;
            max-height: 200px !important;
            overflow: hidden !important;
            background: #f8fafc !important;
            border-radius: 16px 16px 0 0 !important;
        }

        .produto-image img, .servico-image img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important; /* Ensure images fill the container */
        }

        /* Adjustments for smaller screens */
        @media (max-width: 768px) {
            .produto-card, .servico-card {
                min-height: 380px !important;
            }

            .produto-image, .servico-image {
                height: 180px !important;
                min-height: 180px !important;
                max-height: 180px !important;
            }
        }

        @media (max-width: 480px) {
            .produto-card, .servico-card {
                min-height: 360px !important;
            }

            .produto-image, .servico-image {
                height: 160px !important;
                min-height: 160px !important;
                max-height: 160px !important;
            }
        }
    </style>
    
    <!-- CSS CRÍTICO INLINE - Renderização IMEDIATA e CENTRALIZADA -->
    <style>
        /* Container centralizado e sem scroll no mobile */
        .container-stories .swiper {
            overflow: hidden !important; /* Remove scroll horizontal */
            width: 100% !important;
            position: relative !important;
        }
        
        /* Flexbox DISTRIBUÍDO - de canto a canto do container */
        .container-stories .swiper-wrapper {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: center !important;
            justify-content: space-between !important; /* Distribui de canto a canto */
            gap: 0 !important; /* Remove gap para usar space-between */
            transform: none !important;
            transition: none !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        
        /* Slides distribuídos uniformemente com altura fixa para alinhamento */
        .container-stories .swiper-slide {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: flex-start !important; /* Alinha no topo */
            opacity: 1 !important;
            visibility: visible !important;
            flex: 1 1 0 !important; /* Distribui espaço igualmente */
            min-width: 0 !important;
            max-width: none !important;
            transform: none !important;
            transition: none !important;
            margin: 0 !important;
            height: auto !important;
        }
        
        /* Garante que o texto tenha altura mínima fixa para alinhamento */
        .container-stories .swiper-slide p {
            min-height: 2.5em !important; /* Altura mínima para 2 linhas */
            text-align: center !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 8px 0 0 0 !important;
            line-height: 1.2 !important;
            padding: 0 5px !important;
        }
        
        /* Mobile: mantém distribuição mas permite quebra se necessário */
        @media (max-width: 767px) {
            .container-stories .swiper {
                overflow: hidden !important; /* SEM scroll no mobile */
                -webkit-overflow-scrolling: none !important;
            }
            
            .container-stories .swiper-wrapper {
                justify-content: space-between !important; /* Mantém distribuição */
                gap: 5px !important; /* Pequeno gap no mobile */
                flex-wrap: wrap !important; /* Permite quebra de linha se necessário */
            }
            
            .container-stories .swiper-slide {
                flex: 0 0 calc(33.333% - 5px) !important; /* 3 colunas no mobile */
                min-width: 0 !important;
                max-width: calc(33.333% - 5px) !important;
                margin-bottom: 10px !important;
            }
        }
        
        /* Tablets: ajuste intermediário */
        @media (min-width: 768px) and (max-width: 1023px) {
            .container-stories .swiper-slide {
                flex: 1 1 0 !important;
            }
        }
        
        /* Imagens aparecem INSTANTANEAMENTE */
        .container-stories .story-icon {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        .container-stories .story-icon img {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
    </style>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endpush

@section('content')
    <div class="max-w-8xl mx-auto px-6">
        <!-- SLIDER / BANNER PRINCIPAL desktop e tablet -->
        <div class="carrossel pt-6">
            <div class="slides">
                @foreach($banners as $index => $banner)
                <div class="slide {{ $index === 0 ? 'ativo' : '' }}">
                    <img src="{{ $banner->desktop_image_path }}" alt="{{ $banner->titulo ?? 'Banner ' . ($index + 1) }}">
                </div>
                @endforeach
            </div>
            <button class="seta esquerda">&#10094;</button>
            <button class="seta direita">&#10095;</button>
            <div class="indicadores">
                @foreach($banners as $index => $banner)
                <span class="bolinha {{ $index === 0 ? 'ativo' : '' }}"></span>
                @endforeach
            </div>
        </div>
        <!-- SLIDER / BANNER PRINCIPAL mobile -->
        <div class="carrossel-mobile ">
            <div class="slides pt-5">
                @foreach($banners as $index => $banner)
                <div class="slide {{ $index === 0 ? 'ativo' : '' }}">
                    <img src="{{ $banner->mobile_image_path }}" alt="{{ $banner->titulo ?? 'Banner ' . ($index + 1) }}">
                </div>
                @endforeach
            </div>
            <button class="seta esquerda">&#10094;</button>
            <button class="seta direita">&#10095;</button>
            <div class="indicadores">
                @foreach($banners as $index => $banner)
                <span class="bolinha {{ $index === 0 ? 'ativo' : '' }}"></span>
                @endforeach
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-4 py-8">
            <div class="rounded-[32px] bg-gradient-to-r from-blue-900 via-blue-700 to-cyan-600 p-6 md:p-8 shadow-2xl text-white">
                <div class="grid grid-cols-1 lg:grid-cols-[1.5fr_1fr] gap-6 items-center">
                    <div>
                        <p class="inline-flex items-center px-3 py-1 rounded-full bg-white/15 border border-white/20 text-sm font-semibold mb-4">Tudo para seu reparo, em um só lugar</p>
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black leading-tight mb-4">Ferragens, elétrica, hidráulica, ferramentas, assistência técnica e serviços especializados.</h1>
                        <p class="text-base md:text-lg text-blue-100 max-w-2xl mb-6">Produtos de qualidade, atendimento rápido e suporte profissional para casas, empresas e reformas em Brasília.</p>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="/site/produtos" class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-full shadow-lg transition-all duration-200">Comprar Produtos</a>
                            <a href="/site/servicos" class="inline-flex items-center justify-center bg-white text-blue-700 hover:bg-blue-50 font-bold px-6 py-3 rounded-full shadow-lg transition-all duration-200">Solicitar um Reparo</a>
                            <a href="/lojas" class="inline-flex items-center justify-center bg-yellow-400 hover:bg-yellow-300 text-blue-900 font-bold px-6 py-3 rounded-full shadow-lg transition-all duration-200">Encontrar uma Loja</a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/10">
                            <div class="text-3xl font-black text-yellow-300 mb-2">2</div>
                            <div class="text-sm text-blue-100">Lojas físicas</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/10">
                            <div class="text-3xl font-black text-yellow-300 mb-2">+20</div>
                            <div class="text-sm text-blue-100">Marcas</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/10 col-span-2">
                            <div class="text-sm uppercase tracking-wide text-blue-100 mb-2">Atendimento</div>
                            <div class="text-xl font-bold">WhatsApp rápido e atendimento especializado</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl border border-blue-100 p-5 shadow-sm">
                    <div class="text-3xl mb-3">🔧</div>
                    <h3 class="font-bold text-gray-800 mb-2">Reparos Hidráulicos</h3>
                    <p class="text-sm text-gray-600">Vazamentos, torneiras, chuveiros e manutenção predial.</p>
                </div>
                <div class="bg-white rounded-2xl border border-blue-100 p-5 shadow-sm">
                    <div class="text-3xl mb-3">⚡</div>
                    <h3 class="font-bold text-gray-800 mb-2">Serviços Elétricos</h3>
                    <p class="text-sm text-gray-600">Instalações, manutenção e soluções para sua casa ou empresa.</p>
                </div>
                <div class="bg-white rounded-2xl border border-blue-100 p-5 shadow-sm">
                    <div class="text-3xl mb-3">🛠️</div>
                    <h3 class="font-bold text-gray-800 mb-2">Ferramentas</h3>
                    <p class="text-sm text-gray-600">Produtos para obra, reforma, manutenção e uso profissional.</p>
                </div>
                <div class="bg-white rounded-2xl border border-blue-100 p-5 shadow-sm">
                    <div class="text-3xl mb-3">🏆</div>
                    <h3 class="font-bold text-gray-800 mb-2">Assistência Técnica</h3>
                    <p class="text-sm text-gray-600">Atendimento autorizado para marcas líderes do mercado.</p>
                </div>
            </div>
        </div>
        
        <!-- CATEGORIAS DE SERVIÇOS - abaixo do banner -->
        <div class="container-stories">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide story">
                        <div class="story-icon">
                            <img src="{{ asset('img/Destaques/Reparos Hidraulicos.png') }}" alt="Reparos" loading="eager" fetchpriority="high">
                        </div>
                        <p>Reparos Hidráulicos</p>
                    </div>
                    <div class="swiper-slide story">
                        <div class="story-icon">
                            <img src="{{ asset('img/Destaques/Eletrica.png') }}" alt="Elétrica" loading="eager">
                        </div>
                        <p>Elétrica</p>
                    </div>
                    <div class="swiper-slide story">
                        <div class="story-icon">
                            <img src="{{ asset('img/Destaques/Hidraulica.png') }}" alt="Hidráulica" loading="eager">
                        </div>
                        <p>Hidráulica</p>
                    </div>
                    <div class="swiper-slide story">
                        <div class="story-icon">
                            <img src="{{ asset('img/Destaques/Ferragenss.png') }}" alt="Ferragens" loading="eager">
                        </div>
                        <p>Ferragens</p>
                    </div>
                    <div class="swiper-slide story">
                        <div class="story-icon">
                            <img src="{{ asset('img/Destaques/Ferramentas.png') }}" alt="Ferramentas" loading="eager">
                        </div>
                        <p>Ferramentas</p>
                    </div>
                    <div class="swiper-slide story">
                        <div class="story-icon">
                            <img src="{{ asset('img/Destaques/Pintura.png') }}" alt="Pintura" loading="eager">
                        </div>
                        <p>Pintura</p>
                    </div>
                    <!-- ...outros stories... -->
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        
        <!-- CARD IMPORTANTES -->
        <div class="container-card">
            <div class="card">
                <video src="{{ asset('Ag 1.mp4') }}" autoplay muted loop playsinline></video>
                <div class="card-content">
                    <h3>Variedade de Produtos</h3>
                </div>
            </div>
            <div class="card">
                <video src="{{ asset('assitencias.mp4') }}" autoplay muted loop playsinline preload="auto"></video>
                <div class="card-content">
                    <h3>Assistências Especializada</h3>
                </div>
            </div>
            <div style="all: initial !important; display: block !important; position: relative !important; flex: 1 !important; max-width: 580px !important; min-width: 280px !important; height: 300px !important; background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%) !important; border-radius: 15px !important; overflow: hidden !important; box-sizing: border-box !important; padding: 30px !important;">
                <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%2325D366%22><path d=%22M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.051 3.488z%22/></svg>') no-repeat center !important; background-size: contain !important; opacity: 0.3 !important;"></div>
                <div style="position: relative !important; z-index: 2 !important; font-family: Inter, sans-serif !important;">
                    <h3 style="all: initial !important; display: block !important; color: white !important; font-size: 1.5rem !important; margin: 0 0 25px 0 !important; font-weight: 600 !important; font-family: Inter, sans-serif !important;">Fale Conosco</h3>
                    
                    <div style="margin-bottom: 20px !important;">
                        <p style="all: initial !important; display: block !important; color: white !important; margin: 0 0 10px 0 !important; font-size: 1.1rem !important; font-weight: 600 !important; font-family: Inter, sans-serif !important;">Águas Claras</p>
                        <a href="https://w.app/yi1u7s" style="text-decoration: none !important;">
                            <button style="all: initial !important; display: inline-block !important; background: #fbbf24 !important; color: #1f2937 !important; border: none !important; padding: 8px 16px !important; border-radius: 20px !important; font-weight: 600 !important; cursor: pointer !important; font-size: 0.95rem !important; font-family: Inter, sans-serif !important;">(61) 99609-6296</button>
                        </a>
                    </div>
                    
                    <div>
                        <p style="all: initial !important; display: block !important; color: white !important; margin: 0 0 10px 0 !important; font-size: 1.1rem !important; font-weight: 600 !important; font-family: Inter, sans-serif !important;">Taguatinga</p>
                        <a href="https://w.app/ynelwk" style="text-decoration: none !important;">
                            <button style="all: initial !important; display: inline-block !important; background: #fbbf24 !important; color: #1f2937 !important; border: none !important; padding: 8px 16px !important; border-radius: 20px !important; font-weight: 600 !important; cursor: pointer !important; font-size: 0.95rem !important; font-family: Inter, sans-serif !important;">(61) 99931-8077</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
         <!-- SEÇÃO DE SERVIÇOS OTIMIZADA -->
            <div class="produtos-section catalog-section">
                <div class="max-w-6xl mx-auto px-4">
                    <div class="catalog-header">
                        <span class="catalog-kicker">Serviços</span>
                        <h2 class="section-title">Serviços em Águas Claras, Taguatinga e Brasília</h2>
                        <p>Oferecemos reparos hidráulicos, manutenção predial, serviços elétricos e assistência técnica para Docol e demais marcas na região de Brasília, Águas Claras e Taguatinga.</p>
                    </div>

                    <div class="catalog-filter-shell">
                        <label for="marca">Filtrar por marca:</label>
                        <select id="marca">
                            <option value="">Todas as marcas</option>
                            @foreach($todasMarcas as $marca)
                                <option value="{{ $marca }}">{{ $marca }}</option>
                            @endforeach
                        </select>
                    </div>

                    <p class="text-center text-gray-600 max-w-4xl mx-auto mt-4 mb-6 text-sm md:text-base">
                        Atendimento especializado em assistência técnica Docol, reparos hidráulicos em Taguatinga, serviços de manutenção em Águas Claras e materiais para obra em Brasília.
                    </p>

                    <div class="produtos-grid" id="servicosGrid">
                        @forelse($servicos as $servico)
                            <a href="/site/servicos/{{ $servico->id }}" class="produto-card" data-marca="{{ $servico->marca }}">
                                <div class="produto-image">
                                    @if($servico->imagem)
                                        <img src="{{ asset('storage/servicos/' . $servico->imagem) }}" alt="{{ $servico->titulo }}" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="produto-placeholder" style="display:none;">
                                            <i class="fas fa-tools"></i>
                                        </div>
                                    @else
                                        <div class="produto-placeholder">
                                            <i class="fas fa-tools"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="produto-info">
                                    <h3 class="produto-nome">{{ $servico->titulo }}</h3>
                                    @if($servico->valor_estimado && $servico->valor_estimado > 0)
                                        <span class="produto-preco">R$ {{ number_format((float) $servico->valor_estimado, 2, ',', '.') }}</span>
                                    @else
                                        <span class="produto-preco" style="display:none;"></span>
                                    @endif
                                    <button class="ver-detalhes" type="button">
                                        <i class="fas fa-eye"></i>
                                        Ver detalhes
                                    </button>
                                </div>
                            </a>
                        @empty
                            <div class="produto-sem-produtos">
                                <div class="produto-placeholder">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <h3>Reparos e serviços em destaque</h3>
                                <p>Oferecemos soluções em hidráulica, elétrica, manutenção predial e pequenos reparos.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="text-center mt-8">
                        <a href="/site/servicos" class="ver-mais-btn">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Ver todos os serviços
                        </a>
                    </div>
                </div>
            </div>
        <!--  - ASSISTÊNCIAS -->
        <div class="assistencias">
            <div class="assistencias-header">
                <span class="assistencias-kicker">Parceiros</span>
                <h2>Assistência Técnica Docol e Marcas Especializadas</h2>
                <p>Assistência técnica Docol em Brasília, Águas Claras e Taguatinga com garantia, peças originais, atendimento especializado e técnicos certificados.</p>
            </div>

            <section class="assistencias-row-section">
                <div class="assistencias-row-wrapper">
                    <div class="assistencias-row">
                        <article class="assistencia-card-item">
                            <div class="assistencia-media">
                                <div class="assistencia-gallery" data-gallery>
                                    <img src="{{ asset('img/assistencia/lorenzetti/01.jpg') }}" class="gallery-image active" alt="Assistência Lorenzetti">
                                    <img src="{{ asset('img/assistencia/lorenzetti/02.jpg') }}" class="gallery-image" alt="Assistência Lorenzetti">
                                    <img src="{{ asset('img/assistencia/lorenzetti/03.webp') }}" class="gallery-image" alt="Assistência Lorenzetti">
                                </div>
                                <div class="assistencia-badge">★ Autorizada</div>
                                <div class="assistencia-dots" aria-label="Navegar pelas imagens">
                                    <span class="active"></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>

                            <div class="assistencia-content">
                                <div class="assistencia-logo">
                                    <img src="{{ asset('img/assistencia/lorenzeti.png') }}" alt="Lorenzetti">
                                </div>
                                <p>Assistência técnica especializada Lorenzetti com foco em qualidade, garantia e manutenção de produtos de alta performance.</p>
                                <ul class="assistencia-features">
                                    <li>Peças Originais</li>
                                    <li>Garantia</li>
                                    <li>Técnicos Certificados</li>
                                </ul>
                                <a href="https://api.whatsapp.com/send?phone=5561999318077&text=Ol%C3%A1+%21+Preciso+de+assist%C3%AAncia+Lorenzetti" class="assistencia-button">
                                    <i class="fab fa-whatsapp"></i>
                                    Entrar em contato
                                </a>
                            </div>
                        </article>

                        <article class="assistencia-card-item">
                            <div class="assistencia-media">
                                <div class="assistencia-gallery" data-gallery>
                                    <img src="{{ asset('img/assistencia/meber/01.png') }}" class="gallery-image active" alt="Assistência Meber">
                                    <img src="{{ asset('img/assistencia/meber/02.png') }}" class="gallery-image" alt="Assistência Meber">
                                    <img src="{{ asset('img/assistencia/meber/03.png') }}" class="gallery-image" alt="Assistência Meber">
                                </div>
                                <div class="assistencia-badge">★ Autorizada</div>
                                <div class="assistencia-dots" aria-label="Navegar pelas imagens">
                                    <span class="active"></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>

                            <div class="assistencia-content">
                                <div class="assistencia-logo">
                                    <img src="{{ asset('img/assistencia/meber.png') }}" alt="Meber">
                                </div>
                                <p>Atendimento especializado Meber para manutenção e reparo com qualidade, rapidez e suporte técnico confiável.</p>
                                <ul class="assistencia-features">
                                    <li>Peças Originais</li>
                                    <li>Garantia</li>
                                    <li>Técnicos Certificados</li>
                                </ul>
                                <a href="https://api.whatsapp.com/send?phone=5561999318077&text=Ol%C3%A1+%21+Preciso+de+assist%C3%AAncia+Meber" class="assistencia-button">
                                    <i class="fab fa-whatsapp"></i>
                                    Entrar em contato
                                </a>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </div>

        <style>
            .assistencias {
                max-width: 1200px;
                margin: 72px auto 24px;
                padding: 0 18px;
                text-align: center;
            }

            .assistencias-header {
                margin-bottom: 28px;
            }

            .assistencias-kicker {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 7px 16px;
                border-radius: 999px;
                background: linear-gradient(135deg, rgba(14, 165, 233, 0.12), rgba(59, 130, 246, 0.16));
                color: #0f4c81;
                font-size: 0.72rem;
                font-weight: 800;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                margin-bottom: 16px;
            }

            .assistencias h2 {
                margin: 0 0 12px;
                font-size: clamp(2rem, 3vw, 2.8rem);
                line-height: 1.1;
                color: #0f172a;
            }

            .assistencias-header p {
                margin: 0 auto;
                max-width: 650px;
                color: #475569;
                font-size: 1.05rem;
                line-height: 1.7;
            }

            .assistencias-row {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 28px;
            }

            .assistencia-card-item {
                display: flex;
                flex-direction: column;
                background: #fff;
                border: 1px solid rgba(148, 163, 184, 0.18);
                border-radius: 26px;
                overflow: hidden;
                box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            .assistencia-card-item:hover {
                transform: translateY(-6px);
                box-shadow: 0 24px 48px rgba(14, 116, 144, 0.14);
            }

            .assistencia-media {
                position: relative;
                background: linear-gradient(135deg, #eff6ff, #f8fafc);
            }

            .assistencia-gallery {
                position: relative;
                width: 100%;
                height: 260px;
                overflow: hidden;
                background: #f8fafc;
            }

            .gallery-image {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                opacity: 0;
                transition: opacity 0.9s ease-in-out;
            }

            .gallery-image.active {
                opacity: 1;
            }

            .assistencia-badge {
                position: absolute;
                top: 16px;
                right: 16px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 7px 14px;
                border-radius: 999px;
                background: linear-gradient(135deg, #f59e0b, #f97316);
                color: #fff;
                font-size: 0.76rem;
                font-weight: 700;
                box-shadow: 0 12px 22px rgba(249, 115, 22, 0.28);
            }

            .assistencia-dots {
                position: absolute;
                left: 50%;
                bottom: 14px;
                transform: translateX(-50%);
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .assistencia-dots span {
                width: 9px;
                height: 9px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.58);
                box-shadow: 0 0 0 1px rgba(15, 23, 42, 0.1);
                cursor: pointer;
                transition: all 0.25s ease;
            }

            .assistencia-dots span.active {
                background: #fff;
                transform: scale(1.2);
            }

            .assistencia-content {
                display: flex;
                flex: 1;
                flex-direction: column;
                align-items: center;
                padding: 22px 22px 24px;
            }

            .assistencia-logo {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 54px;
                margin-bottom: 16px;
            }

            .assistencia-logo img {
                max-height: 56px;
                width: auto;
                object-fit: contain;
            }

            .assistencia-content p {
                margin: 0 0 18px;
                color: #475569;
                font-size: 0.97rem;
                line-height: 1.6;
                text-align: center;
                flex: 1;
            }

            .assistencia-features {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 8px;
                list-style: none;
                padding: 0;
                margin: 0 0 20px;
                width: 100%;
            }

            .assistencia-features li {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 7px 12px;
                border-radius: 999px;
                background: linear-gradient(135deg, #eff6ff, #e0f2fe);
                color: #0f4c81;
                font-size: 0.77rem;
                font-weight: 700;
            }

            .assistencia-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                width: 100%;
                max-width: 240px;
                padding: 13px 18px;
                border-radius: 999px;
                background: linear-gradient(135deg, #22c55e, #16a34a);
                color: #fff;
                font-weight: 700;
                text-decoration: none;
                box-shadow: 0 14px 25px rgba(34, 197, 94, 0.22);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .assistencia-button:hover {
                transform: translateY(-1px);
                box-shadow: 0 18px 28px rgba(34, 197, 94, 0.25);
                color: #fff;
            }

            @media (max-width: 900px) {
                .assistencias-row {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 640px) {
                .assistencias {
                    padding: 0 14px;
                    margin-top: 52px;
                }

                .assistencia-gallery {
                    height: 220px;
                }

                .assistencia-content {
                    padding: 18px 16px 20px;
                }

                .assistencia-features li {
                    font-size: 0.74rem;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('[data-gallery]').forEach(function (gallery) {
                    const images = gallery.querySelectorAll('.gallery-image');
                    const dots = gallery.parentElement.querySelectorAll('.assistencia-dots span');
                    let currentIndex = 0;

                    function showImage(index) {
                        images.forEach(function (image, imageIndex) {
                            image.classList.toggle('active', imageIndex === index);
                        });

                        dots.forEach(function (dot, dotIndex) {
                            dot.classList.toggle('active', dotIndex === index);
                        });
                    }

                    dots.forEach(function (dot, index) {
                        dot.addEventListener('click', function () {
                            currentIndex = index;
                            showImage(currentIndex);
                        });
                    });

                    setInterval(function () {
                        currentIndex = (currentIndex + 1) % images.length;
                        showImage(currentIndex);
                    }, 4000);
                });
            });
        </script>

        <!-- SEÇÃO ESPECIALISTAS EM REPAROS HIDRÁULICOS -->
        @include('partials.especialistas')

            <!-- SEÇÃO DE PRODUTOS OTIMIZADA -->
            <div class="produtos-section catalog-section">
                <div class="max-w-6xl mx-auto px-4">
                    <div class="catalog-header">
                        <span class="catalog-kicker">Produtos</span>
                        <h2 class="section-title">Ferragens e Materiais Hidráulicos em Brasília</h2>
                        <p>Ferragens, materiais hidráulicos, peças para obra e itens essenciais para reforma, manutenção e construção em Águas Claras, Taguatinga e Brasília.</p>
                    </div>

                    <div class="catalog-filter-shell">
                        <label for="categoria">Filtrar por categoria:</label>
                        <select id="categoria">
                            <option value="">Todas as categorias</option>
                            @foreach($todasCategorias ?? [] as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <p class="text-center text-gray-600 max-w-4xl mx-auto mt-4 mb-6 text-sm md:text-base">
                        Loja de materiais hidráulicos e ferragens em Águas Claras e Taguatinga com variedade para obra, reforma e manutenção residencial e comercial.
                    </p>

                    <div class="produtos-grid" id="produtosGrid">
                        @forelse($produtos ?? [] as $produto)
                            <a href="/site/produtos/{{ $produto->id }}" class="produto-card" data-categoria="{{ optional($produto->categoria)->nome }}">
                                <div class="produto-image">
                                    @if($produto->imagem)
                                        <img src="{{ asset('storage/produtos/' . $produto->imagem) }}" alt="{{ $produto->nome }}" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="produto-placeholder" style="display:none;">
                                            <i class="fas fa-box-open"></i>
                                        </div>
                                    @else
                                        <div class="produto-placeholder">
                                            <i class="fas fa-box-open"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="produto-info">
                                    <h3 class="produto-nome">{{ $produto->nome }}</h3>
                                    @if($produto->preco && $produto->preco > 0)
                                        <span class="produto-preco">R$ {{ number_format((float) $produto->preco, 2, ',', '.') }}</span>
                                    @else
                                        <span class="produto-preco" style="display:none;"></span>
                                    @endif
                                    <button class="ver-detalhes" type="button">
                                        <i class="fas fa-eye"></i>
                                        Ver detalhes
                                    </button>
                                </div>
                            </a>
                        @empty
                            <div class="produto-sem-produtos">
                                <div class="produto-placeholder">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <h3>Produtos em destaque</h3>
                                <p>Ferragens, materiais hidráulicos e itens essenciais para sua obra ou reforma.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="text-center mt-8">
                        <a href="/site/produtos" class="ver-mais-btn">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Ver todos os produtos
                        </a>
                    </div>
                </div>
            </div>

            <style>
                .catalog-header {
                    text-align: center;
                    margin-bottom: 28px;
                }

                .catalog-kicker {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    padding: 7px 16px;
                    margin-bottom: 12px;
                    border-radius: 999px;
                    background: linear-gradient(135deg, rgba(14, 165, 233, 0.12), rgba(59, 130, 246, 0.14));
                    color: #0f4c81;
                    font-size: 0.72rem;
                    font-weight: 800;
                    letter-spacing: 0.12em;
                    text-transform: uppercase;
                }

                .catalog-header p {
                    max-width: 700px;
                    margin: 0 auto;
                    color: #475569;
                    font-size: 1.04rem;
                    line-height: 1.7;
                }

                .catalog-filter-shell {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 14px;
                    flex-wrap: wrap;
                    margin: 0 auto 32px;
                    padding: 18px 22px;
                    max-width: 640px;
                    background: rgba(248, 250, 252, 0.9);
                    border: 1px solid rgba(148, 163, 184, 0.2);
                    border-radius: 18px;
                    box-shadow: 0 12px 30px rgba(15, 23, 42, 0.04);
                }

                .catalog-filter-shell label {
                    font-weight: 700;
                    color: #334155;
                    font-size: 0.98rem;
                }

                .catalog-filter-shell select {
                    min-width: 240px;
                    appearance: none;
                    background: #fff;
                    border: 1px solid #dbeafe;
                    border-radius: 12px;
                    padding: 12px 16px;
                    font-size: 0.96rem;
                    color: #334155;
                    font-weight: 600;
                    box-shadow: inset 0 1px 2px rgba(15, 23, 42, 0.04);
                }

                .catalog-filter-shell select:focus {
                    outline: none;
                    border-color: #60a5fa;
                    box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.12);
                }
            </style>
        <div class="nossaslojas">
            <h2>Nossas Lojas</h2>
            <div class="lojas">
                <div class="loja">
                    <img src="{{ asset('img/Lojas/aguasclaras.webp') }}" alt="Loja Águas Claras">
                    <div class="loja-content">
                        <h2>Águas Claras</h2>
                        <p>Quadra 204, Edifício Alfamix - Loja 15</p>
                        
                        <div class="loja-info">
                            <div class="loja-info-item">
                                <i class="fas fa-clock"></i>
                                <span>Seg a Sex: 8h às 18h | Sáb: 8h às 14h</span>
                            </div>
                            <div class="loja-info-item">
                                <i class="fas fa-phone"></i>
                                <span>(61) 99609-6296</span>
                            </div>
                        </div>
                        
                        <div class="loja-action">
                            <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Vim pelo site!" target="_blank">
                                <button>
                                    <i class="fab fa-whatsapp"></i>
                                    Falar no WhatsApp
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="loja">
                    <img src="{{ asset('img/Lojas/taguatinga.webp') }}" alt="Loja Taguatinga">
                    <div class="loja-content">
                        <h2>Taguatinga</h2>
                        <p>CSE 02 Loja 19 - Taguatinga Sul - DF </p>
                        
                        <div class="loja-info">
                            <div class="loja-info-item">
                                <i class="fas fa-clock"></i>
                                <span>Seg a Sex: 8h às 18h | Sáb: 8h às 14h</span>
                            </div>
                            <div class="loja-info-item">
                                <i class="fas fa-phone"></i>
                                <span>(61) 99931-8077</span>
                            </div>
                        </div>
                        
                        <div class="loja-action">
                            <a href="https://api.whatsapp.com/send?phone=5561999318077&text=Olá! Vim pelo site!" target="_blank">
                                <button>
                                    <i class="fab fa-whatsapp"></i>
                                    Falar no WhatsApp
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seção de Parceiros (movida para fora das lojas) -->
        <div class="parceiros">
            <div class="max-w-6xl mx-auto px-4">
                <h2>Parceiros</h2>
                <div class="parceiros-grid">
                    <div class="parceiro-item">
                        <img src="{{ asset('img/parceiros/imperatriz.png') }}" alt="Imperatriz">
                    </div>
                    <div class="parceiro-item">
                        <img src="{{ asset('img/parceiros/legrand.png') }}" alt="Legrand">
                    </div>
                    <div class="parceiro-item">
                        <img src="{{ asset('img/parceiros/Lorenzetti.png') }}" alt="Lorenzetti">
                    </div>
                    <div class="parceiro-item">
                        <img src="{{ asset('img/parceiros/osram.png') }}" alt="OSRAM">
                    </div>
                    <div class="parceiro-item">
                        <img src="{{ asset('img/parceiros/pado.png') }}" alt="Pado">
                    </div>
                    <div class="parceiro-item">
                        <img src="{{ asset('img/parceiros/siemens.png') }}" alt="Siemens">
                    </div>
                    <div class="parceiro-item">
                        <img src="{{ asset('img/parceiros/sil.png') }}" alt="SIL">
                    </div>
                    <div class="parceiro-item">
                        <img src="{{ asset('img/parceiros/stam.png') }}" alt="Stam">
                    </div>
                    <div class="parceiro-item">
                        <img src="{{ asset('img/parceiros/taschibra.png') }}" alt="Taschibra">
                    </div>
                    <div class="parceiro-item">
                        <img src="{{ asset('img/parceiros/tramontina.png') }}" alt="Tramontina">
                    </div>
                    <div class="parceiro-item">
                        <img src="{{ asset('img/parceiros/tigre.png') }}" alt="Tigre">
                    </div>
                </div>

                <!-- Indicadores de progresso -->
                <div class="indicadores-parceiros">
                    <div class="indicador active" data-slide="0"></div>
                    <div class="indicador" data-slide="1"></div>
                    <div class="indicador" data-slide="2"></div>
                    <div class="indicador" data-slide="3"></div>
                    <div class="indicador" data-slide="4"></div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('script.js') }}" defer></script>
    <script src="{{ asset('servicos-api.js') }}?v={{ time() }}" defer></script>
    <script src="{{ asset('produtos-api.js') }}?v={{ time() }}" defer></script>
    <script src="{{ asset('servicos-filtro.js') }}?v={{ time() }}" defer></script>
    <script src="{{ asset('produtos-filtro.js') }}?v={{ time() }}" defer></script>
    <script>
        // Filtro de serviços por marca
        document.addEventListener('DOMContentLoaded', function() {
            const marcaSelect = document.getElementById('marca');
            const servicosGrid = document.getElementById('servicosGrid');
            
            if (marcaSelect && servicosGrid) {
                marcaSelect.addEventListener('change', function() {
                    const marcaSelecionada = this.value;
                    const servicos = servicosGrid.querySelectorAll('.servico-card');
                    
                    servicos.forEach(servico => {
                        const marcaServico = servico.getAttribute('data-marca');
                        
                        if (!marcaSelecionada || marcaServico === marcaSelecionada) {
                            servico.style.display = 'block';
                            servico.style.animation = 'fadeInUp 0.4s ease-out';
                        } else {
                            servico.style.display = 'none';
                        }
                    });
                    
                    // Verificar se há serviços visíveis
                    const servicosVisiveis = Array.from(servicos).filter(s => s.style.display !== 'none');
                    
                    if (servicosVisiveis.length === 0 && marcaSelecionada) {
                        // Mostrar mensagem de "nenhum serviço encontrado"
                        const mensagem = document.createElement('div');
                        mensagem.className = 'servico-sem-servicos';
                        mensagem.innerHTML = `
                            <div class="servico-placeholder">
                                <i class="fas fa-tools"></i>
                            </div>
                            <h3>Nenhum serviço encontrado</h3>
                            <p>Não encontramos serviços da marca "${marcaSelecionada}".</p>
                        `;
                        
                        // Remover mensagem anterior se existir
                        const mensagemAnterior = servicosGrid.querySelector('.servico-sem-servicos');
                        if (mensagemAnterior) {
                            mensagemAnterior.remove();
                        }
                        
                        servicosGrid.appendChild(mensagem);
                    } else {
                        // Remover mensagem se existir
                        const mensagem = servicosGrid.querySelector('.servico-sem-servicos');
                        if (mensagem) {
                            mensagem.remove();
                        }
                    }
                });
            }
        });
    </script>
@endsection
