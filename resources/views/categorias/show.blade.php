@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-8">
    <h1 class="mb-6 text-2xl font-bold text-gray-800">Detalhes da Categoria</h1>
    <div class="mb-4">
        <span class="font-semibold text-gray-700">Nome:</span>
        <span class="ml-2 text-gray-900">{{ $categoria->nome }}</span>
    </div>
    <div class="mb-4">
        <span class="font-semibold text-gray-700">Ícone:</span>
        @if($categoria->icone)
            <img src="{{ asset('storage/' . $categoria->icone) }}" alt="Ícone" class="w-12 h-12 object-contain rounded bg-gray-100 inline-block ml-2">
        @else
            <span class="ml-2 text-gray-500">Não informado</span>
        @endif
    </div>
    <div class="flex gap-3 pt-4">
        <a href="{{ route('admin.categorias.index') }}" class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded shadow text-center transition">Voltar</a>
        <a href="{{ route('admin.categorias.edit', $categoria) }}" class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded shadow text-center transition">Editar</a>
    </div>
</div>
@endsection
