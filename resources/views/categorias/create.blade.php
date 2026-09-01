@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-8">
    <h1 class="mb-6 text-2xl font-bold text-center text-blue-700">Nova Categoria</h1>
    <form action="{{ route('admin.categorias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div>
            <label for="nome" class="block mb-1 font-medium text-gray-700">Nome</label>
            <input type="text" name="nome" id="nome" class="w-full rounded border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="icone" class="block mb-1 font-medium text-gray-700">Ícone (opcional, SVG ou PNG)</label>
            <input type="file" name="icone" id="icone" class="w-full rounded border-gray-300">
        </div>
        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded shadow focus:outline-none focus:ring-2 focus:ring-green-400 transition">Salvar</button>
            <a href="{{ route('admin.categorias.index') }}" class="w-full sm:w-auto px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded shadow text-center transition">Cancelar</a>
        </div>
    </form>
</div>
@endsection
