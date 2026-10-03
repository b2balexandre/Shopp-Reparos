@extends('admin.layout')

@section('title', 'Gerenciar Marcas')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gerenciar Marcas</h1>
            <p class="text-gray-600 mt-2">Marcas usadas nos produtos do catálogo</p>
        </div>
        <a href="{{ route('admin.marcas.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg flex items-center gap-2 transition-colors">
            Nova Marca
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produtos</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($marcas as $marca)
                <tr>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $marca->nome }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $marca->produtos_count }}</td>
                    <td class="px-6 py-4 text-right text-sm">
                        <a href="{{ route('admin.marcas.show', $marca) }}" class="text-blue-600 hover:text-blue-900 mr-3">Ver</a>
                        <a href="{{ route('admin.marcas.edit', $marca) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                        <form action="{{ route('admin.marcas.destroy', $marca) }}" method="POST" class="inline" onsubmit="return confirm('Excluir esta marca?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Excluir</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">Nenhuma marca cadastrada. A importação da planilha cria as marcas que vierem na coluna Marca.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
