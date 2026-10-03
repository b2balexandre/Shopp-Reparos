@extends('admin.layout')

@section('title', 'Importar produtos')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Importar planilha de produtos</h2>
            <p class="text-gray-600 mt-2">Envie o arquivo .xlsx. Cada linha vira um produto, com nome, especificação, marca, categoria e a imagem que estiver na mesma linha.</p>
        </div>
        <form action="{{ route('admin.produtos.importar.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            <div>
                <label for="planilha" class="block font-medium text-gray-700 mb-1">Planilha</label>
                <input type="file" name="planilha" id="planilha" accept=".xlsx" required class="w-full rounded border-gray-300 p-3">
                @error('planilha')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="categoria_id" class="block font-medium text-gray-700 mb-1">Categoria, se a planilha não tiver essa coluna</label>
                <select name="categoria_id" id="categoria_id" class="w-full rounded border-gray-300 p-3">
                    <option value="">A planilha já traz a categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected(old('categoria_id') == $categoria->id)>{{ $categoria->nome }}</option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-2">Quando a coluna Categoria existe, ela vale para a linha e a categoria é criada se ainda não houver. A coluna Marca também cria a marca no cadastro. Um produto cujo título já está cadastrado não é substituído. Se faltar a foto ou a marca, a planilha completa só o que estiver vazio. Pode enviar a mesma planilha de novo.</p>
            </div>
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <a href="{{ route('admin.produtos.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Cancelar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Importar</button>
            </div>
        </form>
    </div>
</div>
@endsection
