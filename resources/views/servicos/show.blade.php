{{-- filepath: c:\Users\Alexandre Rodrigues\Desktop\shoppreparos\resources\views\servicos\show.blade.php --}}
@extends($layout ?? 'layouts.app')

@section('title', 'Detalhes do Serviço')

@section('content')
<div class="container mx-auto max-w-4xl py-10 px-4">
    <div class="bg-white rounded-2xl shadow-lg p-8 grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
        <div class="flex flex-col gap-6">
            <h1 class="text-3xl font-bold text-blue-800 mb-4 flex items-center gap-2">
                <svg xmlns='http://www.w3.org/2000/svg' class='inline w-8 h-8 text-blue-600' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9.75 17L4.5 12.75l1.5-1.5L9.75 15l8.25-8.25 1.5 1.5z'/></svg>
                Detalhes do Serviço
            </h1>
            <div class="space-y-2 text-lg">
                <div><span class="font-bold text-blue-700">Título:</span> {{ $servico->titulo }}</div>
                <div><span class="font-bold text-blue-700">Descrição:</span> {{ $servico->descricao }}</div>
                <div><span class="font-bold text-blue-700">Marca:</span> {{ $servico->marca }}</div>
                <div><span class="font-bold text-blue-700">Código Interno:</span> {{ $servico->codigo_interno }}</div>
                <div><span class="font-bold text-blue-700">Valor Estimado:</span> <span class="text-green-600 font-semibold">{{ $servico->valor_estimado }}</span></div>
                <div><span class="font-bold text-blue-700">Prazo Médio:</span> {{ $servico->prazo_medio }}</div>
                <div><span class="font-bold text-blue-700">Possui Garantia:</span> <span class="inline-block px-3 py-1 text-xs font-bold rounded-full text-white {{ $servico->possui_garantia ? 'bg-green-600' : 'bg-gray-400' }}">{{ $servico->possui_garantia ? 'Sim' : 'Não' }}</span></div>
                <div><span class="font-bold text-blue-700">Ativo:</span> <span class="inline-block px-3 py-1 text-xs font-bold rounded-full text-white {{ $servico->ativo ? 'bg-green-600' : 'bg-gray-400' }}">{{ $servico->ativo ? 'Sim' : 'Não' }}</span></div>
            </div>
            <div class="bg-blue-50 rounded-lg p-4 mt-4">
                <div class="mb-2"><span class="font-bold text-blue-700">Informações Técnicas:</span> {{ $servico->info_tecnica }}</div>
                <div><span class="font-bold text-blue-700">Instruções para o Cliente:</span> {{ $servico->instrucoes_cliente }}</div>
            </div>
            <div class="flex gap-4 mt-6 flex-wrap">
                <a href="{{ route('admin.servicos.index') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg font-semibold shadow hover:bg-gray-300 transition flex items-center gap-2">
                    <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 19l-7-7 7-7'/></svg>
                    Voltar
                </a>
                <a href="{{ route('admin.servicos.edit', $servico) }}" class="px-6 py-2 bg-yellow-400 text-gray-900 rounded-lg font-semibold shadow hover:bg-yellow-500 transition flex items-center gap-2">
                    <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6'/></svg>
                    Editar
                </a>
            </div>
        </div>
        <div class="flex flex-col items-center gap-4">
            <div class="bg-gray-100 rounded-xl shadow p-6 flex flex-col items-center w-full">
                <span class="font-bold text-blue-700 mb-2 flex items-center gap-2">
                    <svg xmlns='http://www.w3.org/2000/svg' class='w-6 h-6 text-blue-400' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 10l4.553-2.276A2 2 0 0020 6.382V5a2 2 0 00-2-2H6a2 2 0 00-2 2v1.382a2 2 0 00.447 1.342L9 10m6 0v10a2 2 0 01-2 2H7a2 2 0 01-2-2V10m11 0h2a2 2 0 012 2v6a2 2 0 01-2 2h-2a2 2 0 01-2-2v-6a2 2 0 012-2z'/></svg>
                    Imagem do Serviço
                </span>
                @if($servico->imagem)
                    <img src="{{ asset('storage/servicos/' . $servico->imagem) }}" alt="Imagem" class="rounded-lg shadow max-w-xs">
                @else
                    <span class="text-gray-500">Não informada</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
