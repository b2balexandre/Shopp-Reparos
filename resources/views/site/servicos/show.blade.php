@extends('layouts.site')

@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="mb-2 mt-4">
        <ol class="flex gap-2 list-none p-0">
            <li><a href="/" class="text-blue-600 no-underline">Início</a> &gt;</li>
            <li><a href="/site/servicos" class="text-blue-600 no-underline">Serviços</a> &gt;</li>
            <li class="text-gray-900">{{ $servico->titulo }}</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="max-w-3xl mx-auto mt-10 px-2">
    <div class="bg-white rounded-2xl shadow-lg flex flex-col overflow-hidden">
        <div class="flex flex-row items-start gap-8 p-8 flex-wrap">
            {{-- Imagem do Serviço --}}
            <div class="flex-none w-80 max-w-xs flex items-center justify-center">
                <div class="bg-gray-100 rounded-xl shadow p-5 w-full flex items-center justify-center">
                    @if($servico->imagem)
                        <img src="{{ asset('storage/servicos/' . $servico->imagem) }}" alt="Imagem do Serviço" class="max-w-xs max-h-80 object-contain rounded-lg">
                    @else
                        <span class="text-gray-400">Imagem não disponível</span>
                    @endif
                </div>
            </div>
            {{-- Informações do Serviço --}}
            <div class="flex-1 min-w-[220px] flex flex-col justify-start gap-5">
                <h1 class="text-3xl font-bold text-blue-900 mb-0 flex items-center gap-2.5">
                    <svg xmlns='http://www.w3.org/2000/svg' class='w-7 h-7 text-blue-600 align-middle' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9.75 17L4.5 12.75l1.5-1.5L9.75 15l8.25-8.25 1.5 1.5z'/></svg>
                    {{ $servico->titulo }}
                </h1>
                <div class="text-base text-gray-600 flex items-center gap-2">
                    <svg xmlns='http://www.w3.org/2000/svg' class='w-4.5 h-4.5 text-gray-300' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 6h16M4 10h16M4 14h16M4 18h16'/></svg>
                    <span>Marca:</span>
                    <span class="font-semibold text-gray-900">{{ $servico->marca ?? '-' }}</span>
                </div>
                <div class="text-gray-700 text-base leading-relaxed mt-2">{{ $servico->descricao }}</div>
                <div class="text-base text-gray-600 flex items-center gap-2">
                    <span class="font-semibold text-gray-900">Código Interno:</span> {{ $servico->codigo_interno ?? '-' }}
                </div>
                @if($servico->valor_estimado)
                    <div class="mt-5 flex flex-col items-start">
                        <span class="text-lg text-gray-400">Valor Estimado</span>
                        <span class="text-4xl font-extrabold text-green-500 tracking-tight">R$ {{ number_format((float) $servico->valor_estimado, 2, ',', '.') }}</span>
                    </div>
                @endif
                <div class="text-base text-gray-600 flex items-center gap-2">
                    <span class="font-semibold text-gray-900">Prazo Médio:</span> {{ $servico->prazo_medio ?? '-' }}
                </div>
                <div class="text-base text-gray-600 flex items-center gap-2">
                    <span class="font-semibold text-gray-900">Possui Garantia:</span>
                    <span class="inline-block px-4 py-1 text-sm font-bold rounded-full text-white {{ $servico->possui_garantia ? 'bg-green-500' : 'bg-gray-400' }}">{{ $servico->possui_garantia ? 'Sim' : 'Não' }}</span>
                </div>
                <div class="text-base text-gray-600 flex items-center gap-2">
                    <span class="font-semibold text-gray-900">Ativo:</span>
                    <span class="inline-block px-4 py-1 text-sm font-bold rounded-full text-white {{ $servico->ativo ? 'bg-green-500' : 'bg-gray-400' }}">{{ $servico->ativo ? 'Sim' : 'Não' }}</span>
                </div>
                <div class="bg-blue-50 rounded-lg p-4 mt-2">
                    <div class="mb-1.5"><span class="font-semibold text-blue-600">Informações Técnicas:</span> {{ $servico->info_tecnica }}</div>
                    <div><span class="font-semibold text-blue-600">Instruções para o Cliente:</span> {{ $servico->instrucoes_cliente }}</div>
                </div>
                <div class="mt-8 flex gap-4 flex-wrap">
                    <a href="/" class="px-8 py-3 rounded-lg font-semibold bg-gray-100 text-gray-900 no-underline border-none shadow flex items-center gap-2 text-base cursor-pointer transition-colors duration-200 hover:bg-gray-200">
                        <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 19l-7-7 7-7'/></svg>
                        Voltar
                    </a>
                </div>
            </div>
        </div>
        @if($servico->marca)
            <div class="my-8 mx-6">
                <h3 class="text-base text-blue-600 font-semibold">Veja também outros serviços da marca {{ $servico->marca }}:</h3>
                <ul class="mt-2 p-0 list-none flex gap-4 flex-wrap">
                    @foreach(App\Models\Servico::where('marca', $servico->marca)->where('id', '!=', $servico->id)->limit(3)->get() as $relacionado)
                        <li><a href="/site/servicos/{{ $relacionado->id }}-{{ $relacionado->slug }}" class="text-blue-600 underline">{{ $relacionado->titulo }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection

@push('meta')
    <title>{{ $servico->titulo }} em Águas Claras, Taguatinga Sul e Norte | {{ config('app.name', 'ShopPreparos') }}</title>
    <meta name="description" content="{{ $servico->titulo }}: {{ Str::limit(strip_tags($servico->descricao), 140) }}. Disponível em Águas Claras, Taguatinga Sul e Norte. Veja detalhes, valor estimado e informações técnicas!">
    <meta property="og:title" content="{{ $servico->titulo }} em Águas Claras, Taguatinga Sul e Norte" />
    <meta property="og:description" content="{{ $servico->titulo }}: {{ Str::limit(strip_tags($servico->descricao), 140) }}. Atendemos Águas Claras, Taguatinga Sul e Norte." />
    <meta property="og:image" content="{{ $servico->imagem ? asset('storage/servicos/' . $servico->imagem) : asset('img/logo.png') }}" />
    <meta property="og:type" content="service" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="robots" content="index, follow">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Service",
      "name": "{{ $servico->titulo }}",
      "image": [
        @if($servico->imagem) "{{ asset('storage/servicos/' . $servico->imagem) }}" @endif
      ],
      "description": "{{ Str::limit(strip_tags($servico->descricao), 200) }}",
      "provider": {
        "@type": "LocalBusiness",
        "name": "{{ config('app.name', 'ShopPreparos') }}",
        "areaServed": ["Águas Claras", "Taguatinga Sul", "Taguatinga Norte"],
        "address": {
          "@type": "PostalAddress",
          "addressLocality": "Águas Claras, Taguatinga Sul, Taguatinga Norte",
          "addressRegion": "DF",
          "addressCountry": "BR"
        }
      },
      "offers": {
        "@type": "Offer",
        "priceCurrency": "BRL",
        "price": "{{ $servico->valor_estimado ?? '0.00' }}",
        "availability": "https://schema.org/InStock"
      }
    }
    </script>
@endpush
