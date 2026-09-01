@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-md">
    <h1 class="text-2xl font-bold mb-6">Editar Categoria</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nome</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name', $category->name) }}" required>
            @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Slug</label>
            <input type="text" name="slug" class="w-full border rounded px-3 py-2" value="{{ old('slug', $category->slug) }}" required>
            @error('slug')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded border">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Salvar</button>
        </div>
    </form>
</div>
@endsection
