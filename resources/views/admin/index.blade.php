@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6 lg:py-8">
    <div class="mb-8 lg:mb-10">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 text-center lg:text-left">Painel Administrativo</h1>
        <p class="text-gray-600 mt-2 text-center lg:text-left">Gerencie todos os aspectos da Shopp Reparos</p>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-6">
        <!-- Usuários -->
        <div class="bg-blue-50 rounded-lg p-4 lg:p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center mb-3">
                <i class="fas fa-users text-blue-600 text-xl mr-3"></i>
                <h2 class="text-lg lg:text-xl font-semibold text-blue-800">Usuários</h2>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.usuarios.index') }}" class="block text-blue-600 hover:text-blue-800 hover:underline text-sm lg:text-base">
                    <i class="fas fa-cog mr-2"></i>Gerenciar Usuários
                </a>
                <a href="{{ route('admin.usuarios.create') }}" class="block text-green-600 hover:text-green-800 hover:underline text-sm lg:text-base">
                    <i class="fas fa-plus mr-2"></i>Cadastrar Novo
                </a>
            </div>
        </div>
        
        <!-- Serviços -->
        <div class="bg-green-50 rounded-lg p-4 lg:p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center mb-3">
                <i class="fas fa-tools text-green-600 text-xl mr-3"></i>
                <h2 class="text-lg lg:text-xl font-semibold text-green-800">Serviços</h2>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.servicos.index') }}" class="block text-green-700 hover:text-green-900 hover:underline text-sm lg:text-base">
                    <i class="fas fa-cog mr-2"></i>Gerenciar Serviços
                </a>
                <a href="{{ route('admin.servicos.create') }}" class="block text-green-600 hover:text-green-800 hover:underline text-sm lg:text-base">
                    <i class="fas fa-plus mr-2"></i>Cadastrar Novo
                </a>
            </div>
        </div>
        
        <!-- Produtos -->
        <div class="bg-yellow-50 rounded-lg p-4 lg:p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center mb-3">
                <i class="fas fa-box text-yellow-600 text-xl mr-3"></i>
                <h2 class="text-lg lg:text-xl font-semibold text-yellow-800">Produtos</h2>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.produtos.index') }}" class="block text-yellow-700 hover:text-yellow-900 hover:underline text-sm lg:text-base">
                    <i class="fas fa-cog mr-2"></i>Gerenciar Produtos
                </a>
                <a href="{{ route('admin.produtos.create') }}" class="block text-yellow-600 hover:text-yellow-800 hover:underline text-sm lg:text-base">
                    <i class="fas fa-plus mr-2"></i>Cadastrar Novo
                </a>
            </div>
        </div>
        
        <!-- Categorias -->
        <div class="bg-purple-50 rounded-lg p-4 lg:p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center mb-3">
                <i class="fas fa-tags text-purple-600 text-xl mr-3"></i>
                <h2 class="text-lg lg:text-xl font-semibold text-purple-800">Categorias</h2>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.categorias.index') }}" class="block text-purple-700 hover:text-purple-900 hover:underline text-sm lg:text-base">
                    <i class="fas fa-cog mr-2"></i>Gerenciar Categorias
                </a>
                <a href="{{ route('admin.categorias.create') }}" class="block text-purple-600 hover:text-purple-800 hover:underline text-sm lg:text-base">
                    <i class="fas fa-plus mr-2"></i>Cadastrar Nova
                </a>
            </div>
        </div>
        
        <!-- Banners -->
        <div class="bg-orange-50 rounded-lg p-4 lg:p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center mb-3">
                <i class="fas fa-images text-orange-600 text-xl mr-3"></i>
                <h2 class="text-lg lg:text-xl font-semibold text-orange-800">Banners</h2>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.banners.index') }}" class="block text-orange-700 hover:text-orange-900 hover:underline text-sm lg:text-base">
                    <i class="fas fa-cog mr-2"></i>Gerenciar Banners
                </a>
                <a href="{{ route('admin.banners.gallery') }}" class="block text-orange-600 hover:text-orange-800 hover:underline text-sm lg:text-base">
                    <i class="fas fa-images mr-2"></i>Galeria
                </a>
            </div>
        </div>
        
        <!-- Blog -->
        <div class="bg-indigo-50 rounded-lg p-4 lg:p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center mb-3">
                <i class="fas fa-blog text-indigo-600 text-xl mr-3"></i>
                <h2 class="text-lg lg:text-xl font-semibold text-indigo-800">Blog</h2>
                <span class="ml-auto bg-indigo-200 text-indigo-800 text-xs px-2 py-1 rounded-full">
                    {{ \App\Models\Post::count() }}
                </span>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.posts.index') }}" class="block text-indigo-700 hover:text-indigo-900 hover:underline text-sm lg:text-base">
                    <i class="fas fa-cog mr-2"></i>Gerenciar Posts
                </a>
                <a href="{{ route('admin.posts.create') }}" class="block text-indigo-600 hover:text-indigo-800 hover:underline text-sm lg:text-base">
                    <i class="fas fa-plus mr-2"></i>Criar Novo Post
                </a>
                <a href="/blog" target="_blank" class="block text-blue-600 hover:text-blue-800 hover:underline text-sm lg:text-base">
                    <i class="fas fa-external-link-alt mr-2"></i>Ver Blog no Site
                </a>
                <div class="text-xs text-gray-600 mt-3 flex flex-col sm:flex-row sm:justify-between space-y-1 sm:space-y-0">
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded">
                        <i class="fas fa-check mr-1"></i>Publicados: {{ \App\Models\Post::where('published', true)->count() }}
                    </span>
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">
                        <i class="fas fa-edit mr-1"></i>Rascunhos: {{ \App\Models\Post::where('published', false)->count() }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Ordens de Serviço -->
        <div class="bg-pink-50 rounded-lg p-4 lg:p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center mb-3">
                <i class="fas fa-clipboard-list text-pink-600 text-xl mr-3"></i>
                <h2 class="text-lg lg:text-xl font-semibold text-pink-800">Ordens de Serviço</h2>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.ordem_servicos.index') }}" class="block text-pink-700 hover:text-pink-900 hover:underline text-sm lg:text-base">
                    <i class="fas fa-cog mr-2"></i>Gerenciar Ordens
                </a>
                <a href="{{ route('admin.ordem_servicos.create') }}" class="block text-pink-600 hover:text-pink-800 hover:underline text-sm lg:text-base">
                    <i class="fas fa-plus mr-2"></i>Nova Ordem
                </a>
            </div>
        </div>
        
        <!-- Relatórios -->
        <div class="bg-gray-50 rounded-lg p-4 lg:p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center mb-3">
                <i class="fas fa-chart-bar text-gray-600 text-xl mr-3"></i>
                <h2 class="text-lg lg:text-xl font-semibold text-gray-800">Relatórios</h2>
            </div>
            <div class="space-y-2">
                <a href="/dashboard" class="block text-blue-700 hover:text-blue-900 hover:underline text-sm lg:text-base">
                    <i class="fas fa-chart-line mr-2"></i>Dashboard Geral
                </a>
                <a href="/" class="block text-gray-600 hover:text-gray-800 hover:underline text-sm lg:text-base">
                    <i class="fas fa-home mr-2"></i>Voltar ao site
                </a>
            </div>
        </div>
    </div>
    
    <!-- Estatísticas Rápidas -->
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-users text-blue-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total de Usuários</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-tools text-green-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total de Serviços</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Servico::count() ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <i class="fas fa-box text-yellow-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total de Produtos</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Produto::count() ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-indigo-100 rounded-lg">
                    <i class="fas fa-blog text-indigo-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Posts Publicados</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Post::where('published', true)->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
