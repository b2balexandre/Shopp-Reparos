@extends('layouts.site')

@section('breadcrumbs')
<nav aria-label="breadcrumb" style="margin:16px 0 8px 0;">
    <ol style="list-style:none;display:flex;gap:8px;padding:0;">
        <li><a href="/" style="color:#2563eb;text-decoration:none;">Início</a> &gt;</li>
        <li><a href="/site/produtos" style="color:#2563eb;text-decoration:none;">Produtos</a> &gt;</li>
        <li style="color:#222;">{{ $produto->nome }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div style="max-width:900px;margin:40px auto 0 auto;padding:0 8px;">
    <div style="background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(37,99,235,0.08);display:flex;flex-direction:column;gap:0;overflow:hidden;">
        <div style="display:flex;flex-direction:row;align-items:flex-start;gap:32px;padding:32px 24px 24px 24px;flex-wrap:wrap;">
            {{-- Imagem do Produto --}}
            <div style="flex:0 0 320px;max-width:320px;display:flex;align-items:center;justify-content:center;">
                <div style="background:#f3f4f6;border-radius:16px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:18px 12px;width:100%;display:flex;align-items:center;justify-content:center;">
                    @if($produto->imagem)
                        <img src="{{ asset('storage/produtos/' . $produto->imagem) }}" alt="Imagem do Produto" style="max-width:260px;max-height:320px;object-fit:contain;border-radius:12px;">
                    @else
                        <span style="color:#888;">Imagem não disponível</span>
                    @endif
                </div>
            </div>
            {{-- Informações do Produto --}}
            <div style="flex:1;min-width:220px;display:flex;flex-direction:column;justify-content:flex-start;gap:18px;">
                <h1 style="font-size:2.1rem;font-weight:700;color:#1e3a8a;margin-bottom:0;display:flex;align-items:center;gap:10px;">
                    <svg xmlns='http://www.w3.org/2000/svg' style='width:28px;height:28px;color:#2563eb;vertical-align:middle;' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 7h18M3 12h18M3 17h18'/></svg>
                    {{ $produto->nome }}
                </h1>
                <div style="font-size:1rem;color:#555;display:flex;align-items:center;gap:8px;">
                    <svg xmlns='http://www.w3.org/2000/svg' style='width:18px;height:18px;color:#aaa;' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 6h16M4 10h16M4 14h16M4 18h16'/></svg>
                    <span>Categoria:</span>
                    <span style="font-weight:600;color:#222;">{{ $produto->categoria->nome ?? '-' }}</span>
                </div>
                <div style="color:#444;font-size:1.08rem;line-height:1.6;margin-top:8px;">{{ $produto->descricao }}</div>
                @if($produto->preco)
                    <div style="margin-top:18px;display:flex;flex-direction:column;align-items:flex-start;">
                        <span style="font-size:1.1rem;color:#888;">Preço</span>
                        <span style="font-size:2.6rem;font-weight:800;color:#22c55e;letter-spacing:-1px;">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                    </div>
                @endif
                <div style="margin-top:32px;display:flex;gap:16px;flex-wrap:wrap;">
                    <a href="/" style="padding:12px 32px;border-radius:10px;font-weight:600;background:#f3f4f6;color:#222;text-decoration:none;border:none;box-shadow:0 1px 4px rgba(0,0,0,0.04);display:flex;align-items:center;gap:8px;font-size:1rem;cursor:pointer;transition:background 0.2s;">
                        <svg xmlns='http://www.w3.org/2000/svg' style='width:20px;height:20px;' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 19l-7-7 7-7'/></svg>
                        Voltar
                    </a>
                    <button style="padding:12px 32px;border-radius:10px;font-weight:600;background:#2563eb;color:#fff;border:none;box-shadow:0 1px 4px rgba(37,99,235,0.10);display:flex;align-items:center;gap:8px;font-size:1rem;cursor:pointer;transition:background 0.2s;">
                        <svg xmlns='http://www.w3.org/2000/svg' style='width:20px;height:20px;' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 3h18v18H3V3z'/></svg>
                        Comprar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @if(isset($produto->categoria) && $produto->categoria)
        <div style="margin-top:32px;">
            <h3 style="font-size:1.1rem;color:#2563eb;font-weight:600;">Veja também outros produtos da categoria {{ $produto->categoria->nome }}:</h3>
            <ul style="margin:10px 0 0 0;padding:0;list-style:none;display:flex;gap:18px;flex-wrap:wrap;">
                @foreach(App\Models\Produto::where('categoria_id', $produto->categoria_id)->where('id', '!=', $produto->id)->limit(3)->get() as $relacionado)
                    <li><a href="/site/produtos/{{ $relacionado->id }}-{{ $relacionado->slug }}" style="color:#2563eb;text-decoration:underline;">{{ $relacionado->nome }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection

@push('meta')
    <title>{{ $produto->nome }} em Águas Claras, Taguatinga Sul e Norte | {{ config('app.name', 'ShopPreparos') }}</title>
    <meta name="description" content="{{ $produto->nome }}: {{ Str::limit(strip_tags($produto->descricao), 140) }}. Disponível em Águas Claras, Taguatinga Sul e Norte. Confira preço, categoria e detalhes!">
    <meta property="og:title" content="{{ $produto->nome }} em Águas Claras, Taguatinga Sul e Norte" />
    <meta property="og:description" content="{{ $produto->nome }}: {{ Str::limit(strip_tags($produto->descricao), 140) }}. Categoria: {{ $produto->categoria->nome ?? '-' }}. Atendemos Águas Claras, Taguatinga Sul e Norte." />
    <meta property="og:image" content="{{ $produto->imagem ? asset('storage/produtos/' . $produto->imagem) : asset('img/logo.png') }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="robots" content="index, follow">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "{{ $produto->nome }}",
      "image": [
        @if($produto->imagem) "{{ asset('storage/produtos/' . $produto->imagem) }}" @endif
      ],
      "description": "{{ Str::limit(strip_tags($produto->descricao), 200) }}",
      "brand": {
        "@type": "Brand",
        "name": "{{ config('app.name', 'ShopPreparos') }}"
      },
      "offers": {
        "@type": "Offer",
        "priceCurrency": "BRL",
        "price": "{{ $produto->preco ?? '0.00' }}",
        "availability": "https://schema.org/InStock"
      },
      "category": "{{ $produto->categoria->nome ?? '-' }}",
      "areaServed": ["Águas Claras", "Taguatinga Sul", "Taguatinga Norte"],
      "seller": {
        "@type": "LocalBusiness",
        "name": "{{ config('app.name', 'ShopPreparos') }}",
        "address": {
          "@type": "PostalAddress",
          "addressLocality": "Águas Claras, Taguatinga Sul, Taguatinga Norte",
          "addressRegion": "DF",
          "addressCountry": "BR"
        }
      }
    }
    </script>
@endpush
