@extends('layouts.admin')
@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Gerenciar Produtos</h1>
        <a href="{{ route('admin.produtos.create') }}" class="btn btn-primary">Novo Produto</a>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="table-auto w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium text-gray-500">Nome</th>
                    <th class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium text-gray-500">Categoria</th>
                    <th class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium text-gray-500">Imagem</th>
                    <th class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium text-gray-500">Preço</th>
                    <th class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium text-gray-500">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($produtos as $produto)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $produto->nome }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $produto->categoria->nome ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($produto->imagem)
                        <img src="{{ asset('storage/produtos/' . $produto->imagem) }}" alt="Imagem" class="w-12 h-12 object-cover rounded-lg">
                        @else
                        <span class="text-gray-500">Sem imagem</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.produtos.edit', $produto->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                        <form action="{{ route('admin.produtos.destroy', $produto->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $produtos->links() }}
    </div>
</div>
@endsection
