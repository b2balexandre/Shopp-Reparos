@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-md">
    <h1 class="text-2xl font-bold mb-6">Nova Tag</h1>
    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nome</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}" required>
            @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Slug</label>
            <input type="text" name="slug" class="w-full border rounded px-3 py-2" value="{{ old('slug') }}" required>
            @error('slug')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('tags.index') }}" class="px-4 py-2 rounded border">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Salvar</button>
        </div>
    </form>
</div>
@endsection
