<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ __('Usuários do Sistema') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Usuários do Sistema</h1>
            <a href="{{ route('admin.usuarios.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-plus mr-2"></i>Novo Usuário
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Nome</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">E-mail</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Perfil</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td class="px-4 py-2">{{ $usuario->name }}</td>
                        <td class="px-4 py-2">{{ $usuario->email }}</td>
                        <td class="px-4 py-2">
                            @if(isset($usuario) && isset($usuario->perfil) && $usuario->perfil)
                            <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                                @if($usuario->perfil === 'admin') bg-blue-600 text-white
                                @elseif($usuario->perfil === 'tecnico') bg-green-600 text-white
                                @else bg-gray-400 text-white @endif">
                                {{ ucfirst($usuario->perfil) }}
                            </span>
                            @else
                            <span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-300 text-gray-700">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.usuarios.show', $usuario->id) }}" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs font-semibold transition">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
