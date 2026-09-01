@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6">Novo Post</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Título</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2" value="{{ old('title') }}" required>
            @error('title')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Slug</label>
            <input type="text" name="slug" class="w-full border rounded px-3 py-2" value="{{ old('slug') }}" required>
            @error('slug')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Categoria</label>
            <select name="category_id" class="w-full border rounded px-3 py-2">
                <option value="">Selecione</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tags</label>
            <select name="tags[]" class="w-full border rounded px-3 py-2" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @selected(collect(old('tags'))->contains($tag->id))>{{ $tag->name }}</option>
                @endforeach
            </select>
            @error('tags')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Resumo</label>
            <textarea name="excerpt" class="w-full border rounded px-3 py-2">{{ old('excerpt') }}</textarea>
            @error('excerpt')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Conteúdo</label>
            <textarea name="content" class="w-full border rounded px-3 py-2" rows="8" required>{{ old('content') }}</textarea>
            @error('content')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Imagem de destaque (URL)</label>
            <input type="text" name="featured_image" class="w-full border rounded px-3 py-2" value="{{ old('featured_image') }}">
            @error('featured_image')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4 flex gap-4">
            <div>
                <label class="block mb-1 font-semibold">Publicado?</label>
                <input type="checkbox" name="published" value="1" @checked(old('published'))>
            </div>
            <div>
                <label class="block mb-1 font-semibold">Data de publicação</label>
                <input type="datetime-local" name="published_at" class="border rounded px-3 py-2" value="{{ old('published_at') }}">
                @error('published_at')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('posts.index') }}" class="px-4 py-2 rounded border">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Salvar</button>
        </div>
    </form>
</div>
@endsection
