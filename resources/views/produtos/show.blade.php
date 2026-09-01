@extends('admin.layout')

@section('content')
<div class="container mx-auto max-w-5xl py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-10 p-8 items-start">
        {{-- Imagem do Produto --}}
        <div class="flex flex-col items-center justify-center gap-4">
            <div class="bg-gray-100 rounded-xl shadow p-6 flex flex-col items-center w-full">
                @php
                    // Garante que só nome (fallback para registros antigos)
                    $nomeImagem = $produto->imagem ? basename(str_replace('\\','/',$produto->imagem)) : null;
                @endphp

                @if($nomeImagem)
                    <img
                        src="{{ asset('storage/produtos/' . $nomeImagem) }}"
                        alt="{{ $produto->nome }}"
                        class="w-full max-w-xs max-h-[400px] object-contain rounded-xl mb-4"
                        onerror="this.src='{{ asset('img/logo.png') }}';"
                    >
                @else
                    <div class="w-full h-64 flex items-center justify-center bg-gray-100 rounded border text-gray-500">
                        Sem imagem
                    </div>
                @endif
            </div>
        </div>
        {{-- Informações do Produto --}}
        <div class="flex flex-col justify-between gap-6">
            <div>
                <h1 class="text-4xl font-bold text-blue-800 mb-2 flex items-center gap-2">
                    <svg xmlns='http://www.w3.org/2000/svg' class='inline w-8 h-8 text-blue-600' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 7h18M3 12h18M3 17h18'/></svg>
                    {{ $produto->nome }}
                </h1>
                <p class="text-sm text-gray-500 mb-1 flex items-center gap-1">
                    <svg xmlns='http://www.w3.org/2000/svg' class='w-4 h-4 text-gray-400' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 6h16M4 10h16M4 14h16M4 18h16'/></svg>
                    Categoria:
                    <span class="font-semibold text-gray-800">
                        {{ $produto->categoria->nome ?? '-' }}
                    </span>
                </p>
                <p class="text-gray-700 mt-4 leading-relaxed">
                    {{ $produto->descricao }}
                </p>
                @if($produto->preco)
                    <div class="mt-6 flex items-center gap-2">
                        <svg xmlns='http://www.w3.org/2000/svg' class='w-7 h-7 text-green-500' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 7v7'/></svg>
                        <span class="text-3xl font-extrabold text-green-600">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                    </div>
                @endif
            </div>
            {{-- Ações --}}
            <div class="mt-8 flex flex-col md:flex-row gap-4">
                <a href="{{ route('admin.produtos.index') }}"
                   class="flex-1 text-center px-6 py-3 rounded-xl font-semibold bg-gray-200 text-gray-800 hover:bg-gray-300 transition flex items-center gap-2 justify-center">
                    <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 19l-7-7 7-7'/></svg>
                    Voltar
                </a>
                <a href="{{ route('admin.produtos.edit', $produto) }}"
                   class="flex-1 text-center px-6 py-3 rounded-xl font-semibold bg-yellow-400 text-gray-900 hover:bg-yellow-500 transition flex items-center gap-2 justify-center">
                    <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6'/></svg>
                    Editar
                </a>
                <button class="flex-1 text-center px-6 py-3 rounded-xl font-semibold bg-blue-600 text-white hover:bg-blue-700 transition flex items-center gap-2 justify-center">
                    <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 3h18v18H3V3z'/></svg>
                    Comprar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
