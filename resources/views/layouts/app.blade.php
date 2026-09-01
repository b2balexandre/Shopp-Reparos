<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @hasSection('header')
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="px-4 sm:px-6 lg:px-8 py-4">
                @yield('content')
            </main>
        </div>
        
        <!-- Responsividade Admin -->
        <style>
            /* REGRA #1: SEM SCROLL NO MOBILE */
            @media (max-width: 768px) {
                html, body {
                    overflow-x: hidden !important;
                    overflow-y: auto !important;
                    position: relative !important;
                    width: 100% !important;
                    max-width: 100vw !important;
                }
                
                /* Prevenir scroll horizontal */
                * {
                    max-width: 100% !important;
                    box-sizing: border-box !important;
                }
                
                /* Container responsivo */
                .max-w-7xl {
                    max-width: 100% !important;
                    padding-left: 1rem !important;
                    padding-right: 1rem !important;
                }
                
                /* Grid responsivo */
                .grid {
                    grid-template-columns: 1fr !important;
                    gap: 1rem !important;
                }
                
                /* Flex responsivo */
                .flex {
                    flex-wrap: wrap !important;
                }
                
                /* Tabelas responsivas */
                .overflow-x-auto {
                    overflow-x: auto !important;
                    -webkit-overflow-scrolling: touch !important;
                }
                
                /* Cards responsivos */
                .bg-white {
                    margin: 0.5rem !important;
                    border-radius: 0.5rem !important;
                }
                
                /* Espaçamentos responsivos */
                .py-6 { padding-top: 1rem !important; padding-bottom: 1rem !important; }
                .px-4 { padding-left: 1rem !important; padding-right: 1rem !important; }
                .space-y-6 > * + * { margin-top: 1rem !important; }
                .space-y-4 > * + * { margin-top: 0.75rem !important; }
                .space-y-2 > * + * { margin-top: 0.5rem !important; }
                
                /* Textos responsivos */
                .text-2xl { font-size: 1.5rem !important; }
                .text-xl { font-size: 1.25rem !important; }
                .text-lg { font-size: 1.125rem !important; }
                .text-base { font-size: 1rem !important; }
                .text-sm { font-size: 0.875rem !important; }
            }
            
            /* Menu mobile admin */
            @media (max-width: 768px) {
                .sm\\:hidden {
                    display: block !important;
                }
                
                .hidden.sm\\:hidden {
                    display: none !important;
                }
                
                .sm\\:flex {
                    display: flex !important;
                }
                
                .sm\\:items-center {
                    align-items: center !important;
                }
                
                .sm\\:ms-10 {
                    margin-left: 0 !important;
                }
                
                .sm\\:ms-6 {
                    margin-left: 0 !important;
                }
                
                .sm\\:space-x-8 > * + * {
                    margin-left: 0 !important;
                    margin-top: 0.5rem !important;
                }
            }
        </style>
    </body>
</html>
