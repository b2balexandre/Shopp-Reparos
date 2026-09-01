<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ __('Editar Usuário') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Usuário</h1>

        <form method="POST" action="{{ route('admin.usuarios.update', $user->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div id="senha">
                <label for="password" class="block text-sm font-medium text-gray-700">Nova Senha (opcional)</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Nova Senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="perfil" class="block text-sm font-medium text-gray-700">Perfil</label>
                <select name="perfil" id="perfil" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Selecione um perfil</option>
                    <option value="admin" {{ old('perfil', $user->perfil) == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="tecnico" {{ old('perfil', $user->perfil) == 'tecnico' ? 'selected' : '' }}>Técnico</option>
                    <option value="cliente" {{ old('perfil', $user->perfil) == 'cliente' ? 'selected' : '' }}>Cliente</option>
                </select>
                @error('perfil')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.usuarios.index') }}" 
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" 
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    Atualizar Usuário
                </button>
            </div>
        </form>
    </div>
</x-app-layout> 