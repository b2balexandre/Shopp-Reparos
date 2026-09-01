<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ __('Detalhes do Usuário') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Detalhes do Usuário</h1>
        
        <div class="mb-4 flex flex-col items-center">
            @if($user->foto)
                <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto" class="w-24 h-24 rounded-full object-cover mb-2">
            @else
                <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center mb-2">
                    <span class="text-3xl text-gray-500">{{ strtoupper(substr($user->name,0,1)) }}</span>
                </div>
            @endif
            <div class="text-lg font-semibold text-gray-800">{{ $user->name }}</div>
            <div class="text-gray-500">{{ $user->email }}</div>
        </div>
        
        <div class="mb-4">
            <span class="font-semibold text-gray-700">Perfil:</span>
            @if(isset($user) && isset($user->perfil) && $user->perfil)
                <span class="ml-2 inline-block px-2 py-1 rounded text-xs font-semibold
                    @if($user->perfil === 'admin') bg-blue-600 text-white
                    @elseif($user->perfil === 'tecnico') bg-green-600 text-white
                    @else bg-gray-400 text-white @endif">
                    {{ ucfirst($user->perfil) }}
                </span>
            @else
                <span class="ml-2 inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-300 text-gray-700">-</span>
            @endif
        </div>
        
        @if($user && $user->id)
            <form action="{{ route('admin.usuarios.nivel', $user->id) }}" method="POST" class="space-y-4 mt-6">
                @csrf
                <label for="perfil" class="block font-medium text-gray-700">Alterar nível de acesso</label>
                <select name="perfil" id="perfil" class="w-full rounded border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="admin" @if($user->perfil=='admin') selected @endif>Administrador</option>
                    <option value="tecnico" @if($user->perfil=='tecnico') selected @endif>Técnico</option>
                    <option value="cliente" @if($user->perfil=='cliente') selected @endif>Cliente</option>
                </select>
                <button type="submit" class="w-full px-6 py-2 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-400 transition">Salvar Nível</button>
            </form>
        @endif
        
        @if(session('success'))
            <div class="mt-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="flex gap-3 pt-6">
                    <a href="{{ route('admin.usuarios.index') }}" class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded shadow text-center transition">Voltar</a>
        <a href="{{ route('admin.usuarios.edit', $user->id) }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded shadow text-center transition">Editar Perfil</a>
        <a href="{{ route('admin.usuarios.edit', $user->id) }}#senha" class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded shadow text-center transition">Alterar Senha</a>
        </div>
    </div>
</x-app-layout>
