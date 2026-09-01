@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Posts</h1>
        <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Novo Post</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded shadow">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Título</th>
                    <th class="px-4 py-2 border">Categoria</th>
                    <th class="px-4 py-2 border">Publicado</th>
                    <th class="px-4 py-2 border">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td class="px-4 py-2 border">{{ $post->title }}</td>
                    <td class="px-4 py-2 border">{{ $post->category?->name ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $post->published ? 'Sim' : 'Não' }}</td>
                    <td class="px-4 py-2 border flex gap-2">
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Tem certeza?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center">Nenhum post encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection
