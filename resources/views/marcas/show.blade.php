@extends('admin.layout')

@section('title', $marca->nome)

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
    <h1 class="mb-2 text-2xl font-bold text-gray-800">{{ $marca->nome }}</h1>
    <p class="text-gray-600 mb-6">{{ $marca->produtos->count() }} {{ $marca->produtos->count() === 1 ? 'produto' : 'produtos' }}</p>
    <ul class="divide-y divide-gray-200 mb-6">
        @forelse($marca->produtos as $produto)
            <li class="py-2">
                <a href="{{ route('admin.produtos.show', $produto) }}" class="text-blue-700 hover:underline">{{ $produto->nome }}</a>
            </li>
        @empty
            <li class="py-2 text-gray-500">Nenhum produto usa esta marca.</li>
        @endforelse
    </ul>
    <div class="flex gap-3">
        <a href="{{ route('admin.marcas.index') }}" class="px-5 py-2 bg-gray-300 text-gray-800 font-semibold rounded">Voltar</a>
        <a href="{{ route('admin.marcas.edit', $marca) }}" class="px-5 py-2 bg-yellow-500 text-white font-semibold rounded">Editar</a>
    </div>
</div>
@endsection
