@extends('admin.layout')

@section('title', 'Nova Marca')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-8">
    <h1 class="mb-6 text-2xl font-bold text-gray-800">Nova Marca</h1>
    <form action="{{ route('admin.marcas.store') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label for="nome" class="block mb-1 font-medium text-gray-700">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" class="w-full rounded border-gray-300 p-3" required>
            @error('nome')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded">Salvar</button>
            <a href="{{ route('admin.marcas.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 font-semibold rounded">Cancelar</a>
        </div>
    </form>
</div>
@endsection
