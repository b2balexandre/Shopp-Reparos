@extends('admin.layout')

@section('title', 'Galeria de Histórico de Banners')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Galeria de Histórico de Banners</h1>
            <p class="text-gray-600 mt-2">Visualize e restaure banners antigos</p>
        </div>
        <a href="{{ route('admin.banners.index') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg flex items-center gap-2 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Voltar para Gerenciar Banners
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Histórico Completo</h3>
        @if($history->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($history as $oldBanner)
                    <div class="border rounded-lg p-4 flex flex-col items-center">
                        <div class="mb-2 text-xs text-gray-500">{{ $oldBanner->created_at->format('d/m/Y H:i') }}</div>
                        @if($oldBanner->desktop_old_image)
                            <div class="mb-2 w-full">
                                <span class="block text-xs text-gray-500 mb-1">Desktop</span>
                                <img src="{{ $oldBanner->desktop_old_image_path }}" alt="Desktop Antigo" class="w-full h-20 object-cover rounded">
                            </div>
                        @endif
                        @if($oldBanner->mobile_old_image)
                            <div class="mb-2 w-full">
                                <span class="block text-xs text-gray-500 mb-1">Mobile</span>
                                <img src="{{ $oldBanner->mobile_old_image_path }}" alt="Mobile Antigo" class="w-full h-20 object-cover rounded">
                            </div>
                        @endif
                        <form action="{{ route('admin.banners.restore', $oldBanner->id) }}" method="POST" class="mt-2 w-full">
                            @csrf
                            <button type="submit" class="w-full text-blue-600 hover:text-blue-800 text-sm flex items-center justify-center">
                                <i class="fas fa-undo mr-1"></i> Restaurar
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <div class="flex flex-col items-center">
                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-lg font-medium">Nenhum banner antigo encontrado</p>
                    <p class="text-sm">O histórico de banners aparecerá aqui quando houver alterações</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 