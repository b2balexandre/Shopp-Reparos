@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-3xl">
    <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
    <div class="text-gray-500 mb-4 flex gap-4">
        <span>Categoria: {{ $post->category?->name ?? '-' }}</span>
        <span>Publicado: {{ $post->published ? 'Sim' : 'Não' }}</span>
        <span>Data: {{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : '-' }}</span>
    </div>
    @if($post->featured_image)
        <img src="{{ $post->featured_image }}" alt="Imagem de destaque" class="mb-4 rounded shadow max-h-80 w-full object-cover">
    @endif
    <div class="mb-4 text-gray-700">
        <strong>Resumo:</strong>
        <p>{{ $post->excerpt }}</p>
    </div>
    <div class="prose max-w-none mb-4">
        {!! nl2br(e($post->content)) !!}
    </div>
    <div class="mb-4">
        <strong>Tags:</strong>
        @forelse($post->tags as $tag)
            <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded mr-2">{{ $tag->name }}</span>
        @empty
            <span>-</span>
        @endforelse
    </div>
    <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline">Voltar para lista</a>
</div>
@endsection
