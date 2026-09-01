<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Shopp Reparos</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Responsivo para Admin -->
    <link href="{{ asset('css/admin-responsive.css') }}" rel="stylesheet">

    @stack('styles')
    
    <!-- Custom Styles -->
    <style>
        /* Animações para o menu mobile */
        .sidebar-mobile {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
            will-change: transform;
        }
        
        .sidebar-mobile.open {
            transform: translateX(0);
        }
        
        /* Overlay para fechar o menu */
        .sidebar-overlay {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
            pointer-events: none;
        }
        
        .sidebar-overlay.open {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }
        
        @media (max-width: 1023px) {
            .sidebar-mobile {
                display: block !important;
            }
            
            #mobile-menu-btn {
                display: block !important;
            }
            
            .sidebar-overlay.open {
                display: block !important;
            }
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            color: #1f2937;
            text-decoration: none;
            border-radius: 0.85rem;
            transition: all 0.2s ease-in-out;
            font-weight: 500;
        }

        .sidebar-link:hover {
            background-color: rgba(59, 130, 246, 0.08);
            color: #0f172a;
            transform: translateX(4px);
        }

        .sidebar-link.active {
            background-image: linear-gradient(135deg, #2563eb 0%, #38bdf8 100%);
            color: white;
            box-shadow: 0 16px 35px -20px rgba(37, 99, 235, 0.6);
        }
    </style>
</head>
<body class="bg-slate-100">
    <div class="flex min-h-screen">
        <aside class="relative hidden lg:flex lg:w-72 flex-col overflow-hidden border-r border-slate-200 bg-gradient-to-b from-white via-slate-50 to-slate-100 shadow-xl">
            <div class="relative flex items-center justify-center h-20 border-b border-slate-200 px-6">
                <img src="{{ asset('img/logohorizontal.png') }}" alt="Shopp Reparos" class="h-10">
            </div>
            <nav class="flex flex-1 flex-col overflow-y-auto px-6 py-8">
                <div class="space-y-6">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-400">Menu Principal</p>
                        <div class="mt-4 space-y-2">
                            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt w-5"></i>
                                Dashboard
                            </a>
                            <a href="{{ route('admin.posts.index') }}" class="sidebar-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                                <i class="fas fa-blog w-5"></i>
                                Blog
                                <span class="ml-auto rounded-full bg-blue-100 px-2 py-0.5 text-[11px] font-semibold text-blue-700">
                                    {{ \App\Models\Post::count() }}
                                </span>
                            </a>
                            <a href="{{ route('admin.banners.index') }}" class="sidebar-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                                <i class="fas fa-images w-5"></i>
                                Banners
                            </a>
                            <a href="{{ route('admin.usuarios.index') }}" class="sidebar-link {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
                                <i class="fas fa-users w-5"></i>
                                Usuários
                            </a>
                            <a href="{{ route('admin.servicos.index') }}" class="sidebar-link {{ request()->routeIs('admin.servicos.*') ? 'active' : '' }}">
                                <i class="fas fa-tools w-5"></i>
                                Serviços
                            </a>
                            <a href="{{ route('admin.produtos.index') }}" class="sidebar-link {{ request()->routeIs('admin.produtos.*') ? 'active' : '' }}">
                                <i class="fas fa-box w-5"></i>
                                Produtos
                            </a>
                            <a href="{{ route('admin.categorias.index') }}" class="sidebar-link {{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}">
                                <i class="fas fa-tags w-5"></i>
                                Categorias
                            </a>
                            <a href="{{ route('admin.ordem_servicos.index') }}" class="sidebar-link {{ request()->routeIs('admin.ordem_servicos.*') ? 'active' : '' }}">
                                <i class="fas fa-clipboard-list w-5"></i>
                                Ordens de Serviço
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-auto space-y-3 pt-10">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-400">Site</p>
                    <div class="space-y-2">
                        <a href="/blog" target="_blank" class="sidebar-link">
                            <i class="fas fa-external-link-alt w-5"></i>
                            Ver Blog
                        </a>
                        <a href="/" target="_blank" class="sidebar-link">
                            <i class="fas fa-home w-5"></i>
                            Ver Site
                        </a>
                    </div>
                </div>
            </nav>

        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="relative border-b border-slate-200 bg-gradient-to-r from-white via-white to-indigo-50/50">
                <div class="pointer-events-none absolute inset-y-0 right-0 hidden w-64 translate-x-1/3 rounded-full bg-cyan-400/20 blur-3xl lg:block"></div>
                <div class="pointer-events-none absolute -top-16 left-12 hidden h-40 w-40 rounded-full bg-indigo-500/20 blur-3xl lg:block"></div>
                <div class="relative flex flex-col gap-4 px-4 py-6 lg:px-8">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <button id="mobile-menu-btn" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white p-2 text-slate-600 shadow-sm transition hover:border-indigo-200 hover:text-indigo-600 lg:hidden">
                                <i class="fas fa-bars text-lg"></i>
                            </button>
                            <div class="text-left">
                                <p class="text-[11px] uppercase tracking-[0.35em] text-slate-400">Painel administrativo</p>
                                <h1 class="text-xl font-semibold text-slate-900 lg:text-2xl">@yield('title', 'Dashboard')</h1>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="hidden sm:inline text-sm text-slate-600">Olá, {{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-rose-200 bg-white px-4 py-2 text-sm font-semibold text-rose-600 transition hover:bg-rose-50">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span class="hidden sm:inline">Sair</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <p class="text-sm text-slate-500 lg:max-w-3xl">Organize conteúdos, banners e serviços com uma experiência visual refinada e intuitiva.</p>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/60 px-4 pb-8 pt-8 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden" style="display: none;"></div>
    
    <!-- Mobile Sidebar -->
    <div id="mobile-sidebar" class="sidebar-mobile fixed top-0 left-0 h-full w-64 bg-white shadow-lg z-50 lg:hidden" style="display: none;">
        <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
            <img src="{{ asset('img/logohorizontal.png') }}" alt="Shopp Reparos" class="h-8">
            <button id="close-sidebar" class="p-2 text-gray-600 hover:text-gray-900">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <nav class="mt-8 px-4">
            <div class="mb-4">
                <h3 class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Menu Principal</h3>
            </div>
            
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                Dashboard
            </a>
            
            <a href="{{ route('admin.posts.index') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-2 {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <i class="fas fa-blog w-5 h-5 mr-3"></i>
                Blog
                <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                    {{ \App\Models\Post::count() }}
                </span>
            </a>
            
            <a href="{{ route('admin.banners.index') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-2 {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                <i class="fas fa-images w-5 h-5 mr-3"></i>
                Banners
            </a>
            
            <a href="{{ route('admin.usuarios.index') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-2 {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
                <i class="fas fa-users w-5 h-5 mr-3"></i>
                Usuários
            </a>

            <a href="{{ route('admin.servicos.index') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-2 {{ request()->routeIs('admin.servicos.*') ? 'active' : '' }}">
                <i class="fas fa-tools w-5 h-5 mr-3"></i>
                Serviços
            </a>

            <a href="{{ route('admin.produtos.index') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-2 {{ request()->routeIs('admin.produtos.*') ? 'active' : '' }}">
                <i class="fas fa-box w-5 h-5 mr-3"></i>
                Produtos
            </a>

            <a href="{{ route('admin.categorias.index') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-2 {{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}">
                <i class="fas fa-tags w-5 h-5 mr-3"></i>
                Categorias
            </a>

            <a href="{{ route('admin.ordem_servicos.index') }}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-2 {{ request()->routeIs('admin.ordem_servicos.*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list w-5 h-5 mr-3"></i>
                Ordens de Serviço
            </a>

            <div class="mt-8 mb-4">
                <h3 class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Site</h3>
            </div>
            
            <a href="/blog" target="_blank" class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-2">
                <i class="fas fa-external-link-alt w-5 h-5 mr-3"></i>
                Ver Blog
            </a>
            
            <a href="/" target="_blank" class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-2">
                <i class="fas fa-home w-5 h-5 mr-3"></i>
                Ver Site
            </a>
        </nav>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const closeSidebarBtn = document.getElementById('close-sidebar');
            
            // Verificar se os elementos existem
            if (!mobileMenuBtn || !mobileSidebar || !sidebarOverlay || !closeSidebarBtn) {
                console.error('Elementos do menu mobile não encontrados');
                return;
            }
            
            // Abrir sidebar
            function openSidebar() {
                console.log('Abrindo sidebar mobile');
                mobileSidebar.style.display = 'block';
                sidebarOverlay.style.display = 'block';
                
                // Pequeno delay para garantir que o display seja aplicado antes da animação
                setTimeout(() => {
                    mobileSidebar.classList.add('open');
                    sidebarOverlay.classList.add('open');
                }, 10);
                
                document.body.style.overflow = 'hidden';
            }
            
            // Fechar sidebar
            function closeSidebar() {
                console.log('Fechando sidebar mobile');
                mobileSidebar.classList.remove('open');
                sidebarOverlay.classList.remove('open');
                
                // Aguardar a animação terminar antes de ocultar
                setTimeout(() => {
                    mobileSidebar.style.display = 'none';
                    sidebarOverlay.style.display = 'none';
                }, 300);
                
                document.body.style.overflow = '';
            }
            
            // Event listeners
            mobileMenuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                openSidebar();
            });
            
            closeSidebarBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeSidebar();
            });
            
            sidebarOverlay.addEventListener('click', function(e) {
                if (e.target === sidebarOverlay) {
                    closeSidebar();
                }
            });
            
            // Fechar ao redimensionar para desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    closeSidebar();
                }
            });
            
            // Fechar ao pressionar ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSidebar();
                }
            });
            
            // Debug: verificar se o JavaScript está funcionando
            console.log('Menu mobile inicializado');
            console.log('Botão hambúrguer:', mobileMenuBtn);
            console.log('Sidebar mobile:', mobileSidebar);
        });
    </script>

    @stack('scripts')
</body>
</html>