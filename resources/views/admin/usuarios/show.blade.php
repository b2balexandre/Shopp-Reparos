@extends('admin.layout')

@section('title', 'Detalhes do Usuário')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detalhes do Usuário</h1>
            <p class="text-gray-600 mt-2">Informações completas do usuário</p>
        </div>
        <a href="{{ route('admin.usuarios.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg flex items-center gap-2 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Voltar
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <span class="text-2xl font-bold text-blue-600">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </span>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informações Básicas</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nome Completo</dt>
                            <dd class="text-sm text-gray-900">{{ $user->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="text-sm text-gray-900">{{ $user->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tipo de Usuário</dt>
                            <dd class="text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $user->perfil === 'admin' ? 'bg-blue-100 text-blue-800' : 
                                       ($user->perfil === 'tecnico' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($user->perfil) }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Data de Criação</dt>
                            <dd class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Última Atualização</dt>
                            <dd class="text-sm text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Alterar Nível de Acesso</h3>
                    <form action="{{ route('admin.usuarios.nivel', $user->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        
                        <div>
                            <label for="perfil" class="block text-sm font-medium text-gray-700 mb-2">Novo Tipo</label>
                            <select name="perfil" id="perfil" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="admin" {{ $user->perfil === 'admin' ? 'selected' : '' }}>Administrador</option>
                                <option value="tecnico" {{ $user->perfil === 'tecnico' ? 'selected' : '' }}>Técnico</option>
                                <option value="cliente" {{ $user->perfil === 'cliente' ? 'selected' : '' }}>Cliente</option>
                            </select>
                        </div>

                        <button type="submit" 
                                class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            Atualizar Nível
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex space-x-3">
                    <a href="{{ route('admin.usuarios.edit', $user->id) }}" 
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
                        Editar Perfil
                    </a>
                    <a href="{{ route('admin.usuarios.edit', $user->id) }}#senha" 
                       class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition-colors">
                        Alterar Senha
                    </a>
                </div>
                
                <form action="{{ route('admin.usuarios.destroy', $user->id) }}" method="POST" class="inline"
                      onsubmit="return confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors">
                        Excluir Usuário
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
