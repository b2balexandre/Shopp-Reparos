@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Tags</h1>
        <a href="{{ route('tags.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nova Tag</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded shadow">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Nome</th>
                    <th class="px-4 py-2 border">Slug</th>
                    <th class="px-4 py-2 border">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tags as $tag)
                <tr>
                    <td class="px-4 py-2 border">{{ $tag->name }}</td>
                    <td class="px-4 py-2 border">{{ $tag->slug }}</td>
                    <td class="px-4 py-2 border flex gap-2">
                        <a href="{{ route('tags.edit', $tag) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Tem certeza?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-2 text-center">Nenhuma tag encontrada.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $tags->links() }}
    </div>
</div>
@endsection
