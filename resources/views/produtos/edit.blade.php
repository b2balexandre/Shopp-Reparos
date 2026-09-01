@extends('admin.layout')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-gray-900 mb-8 text-center">Editar Produto</h1>
    <form action="{{ route('admin.produtos.update', $produto) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white rounded-lg shadow p-8">
        @csrf @method('PUT')
        <div class="mb-4">
            <label for="nome" class="block font-medium text-gray-700 mb-1">Nome</label>
            <input type="text" name="nome" id="nome" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" value="{{ old('nome', $produto->nome) }}" required>
        </div>
        <div class="mb-4">
            <label for="descricao" class="block font-medium text-gray-700 mb-1">Descrição</label>
            <textarea name="descricao" id="descricao" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3">{{ old('descricao', $produto->descricao) }}</textarea>
        </div>
        <div class="mb-4">
            <label for="categoria_id" class="block font-medium text-gray-700 mb-1">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" required>
                <option value="">Selecione</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @if(old('categoria_id', $produto->categoria_id) == $categoria->id) selected @endif>{{ $categoria->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="imagem" class="block font-medium text-gray-700 mb-1">Imagem (opcional)</label>
            <input type="file" name="imagem" id="imagem" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3">
            @if($produto->imagem)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $produto->imagem) }}" alt="Imagem atual" class="rounded shadow max-w-[40px]">
                </div>
            @endif
        </div>
        <div class="mb-4">
            <label for="preco" class="block font-medium text-gray-700 mb-1">Preço</label>
            <input type="number" step="0.01" name="preco" id="preco" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" value="{{ old('preco', $produto->preco) }}">
        </div>
        <div class="flex gap-4 pt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">Atualizar</button>
            <a href="{{ route('admin.produtos.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg font-semibold shadow hover:bg-gray-400 transition">Cancelar</a>
        </div>
    </form>
</div>
@endsection
