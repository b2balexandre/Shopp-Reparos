@extends('layouts.site')

@section('title', 'Ferragens e Materiais Hidráulicos em Águas Claras e Taguatinga | Shopp Reparos')
@section('description', 'Loja de ferragens, materiais hidráulicos, peças para obra e itens de manutenção em Águas Claras, Taguatinga e Brasília.')
@section('keywords', 'ferragens águas claras, ferragens taguatinga, materiais hidráulicos brasília, loja de hidráulica df')

@push('styles')
<style>
    .catalogo {
        --sr-blue: #0b3a82;
        --sr-blue-deep: #072a5e;
        --sr-ink: #10233f;
        --sr-muted: #5b6b82;
        --sr-line: rgba(11, 58, 130, .12);
        --sr-soft: #f3f7fc;
        color: var(--sr-ink);
        width: 100%;
        max-width: 100%;
        overflow-x: clip;
    }
    .catalogo-shell {
        width: 100%;
        max-width: 1120px;
        margin-inline: auto;
        padding-inline: 1rem;
    }
    .catalogo-head {
        padding: 1.25rem 0 1rem;
        background: linear-gradient(180deg, #eef4fb 0%, #fff 80%);
    }
    .catalogo-kicker {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--sr-blue);
    }
    .catalogo-kicker::before {
        content: "";
        width: 1.25rem;
        height: 2px;
        background: #f5c518;
    }
    .catalogo-head h1 {
        margin: .55rem 0 .4rem;
        font-family: Poppins, sans-serif;
        font-size: clamp(1.45rem, 4.2vw, 2.2rem);
        line-height: 1.15;
        font-weight: 800;
        color: var(--sr-blue-deep);
        overflow-wrap: anywhere;
    }
    .catalogo-head p {
        margin: 0;
        max-width: 36rem;
        color: var(--sr-muted);
        line-height: 1.5;
        font-size: .98rem;
    }
    .catalogo-tools {
        display: flex;
        gap: .5rem;
        overflow-x: auto;
        padding: .15rem 0 1rem;
        scrollbar-width: none;
    }
    .catalogo-tools::-webkit-scrollbar { display: none; }
    .catalogo-chip {
        flex: 0 0 auto;
        border: 1px solid var(--sr-line);
        background: #fff;
        color: var(--sr-blue-deep);
        font-weight: 700;
        font-size: .85rem;
        padding: .55rem .85rem;
        cursor: pointer;
    }
    .catalogo-chip.is-active,
    .catalogo-chip:hover {
        background: var(--sr-blue);
        color: #fff;
        border-color: var(--sr-blue);
    }
    .catalogo-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .75rem;
        padding-bottom: 1.5rem;
    }
    .catalogo-card {
        display: flex;
        flex-direction: column;
        min-width: 0;
        background: #fff;
        border: 1px solid var(--sr-line);
        text-decoration: none;
        color: inherit;
    }
    .catalogo-card img,
    .catalogo-card .catalogo-ph {
        width: 100%;
        height: 7.5rem;
        object-fit: contain;
        background: var(--sr-soft);
        padding: .6rem;
    }
    .catalogo-ph {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 1.4rem;
    }
    .catalogo-body {
        padding: .7rem .75rem .85rem;
        display: grid;
        gap: .25rem;
    }
    .catalogo-body small {
        color: var(--sr-muted);
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
    }
    .catalogo-body h2 {
        margin: 0;
        font-size: .92rem;
        line-height: 1.3;
        font-weight: 700;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .catalogo-body strong {
        color: var(--sr-blue);
        font-size: .95rem;
    }
    .catalogo-empty {
        display: none;
        padding: 1.5rem 0 2rem;
        color: var(--sr-muted);
    }
    .catalogo-empty.is-visible { display: block; }
    .catalogo-pages {
        display: flex;
        flex-wrap: wrap;
        gap: .4rem;
        align-items: center;
        padding-bottom: 2rem;
    }
    .catalogo-pages a,
    .catalogo-pages span {
        min-width: 2.2rem;
        min-height: 2.2rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--sr-line);
        text-decoration: none;
        color: var(--sr-blue);
        font-weight: 700;
        font-size: .9rem;
    }
    .catalogo-pages .is-current {
        background: var(--sr-blue);
        color: #fff;
        border-color: var(--sr-blue);
    }
    @media (min-width: 700px) {
        .catalogo-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1rem; }
        .catalogo-card img, .catalogo-card .catalogo-ph { height: 9rem; }
    }
    @media (min-width: 1024px) {
        .catalogo-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    }
</style>
@endpush

@section('content')
@php
    $todasCategorias = collect($produtos->items())->map(fn ($p) => optional($p->categoria)->nome)->filter()->unique()->sort()->values();
@endphp
<div class="catalogo">
    <header class="catalogo-head">
        <div class="catalogo-shell">
            <p class="catalogo-kicker">Produtos</p>
            <h1>Ferragens e materiais hidráulicos em Brasília</h1>
            <p>Peças para obra, reforma e manutenção em Águas Claras e Taguatinga.</p>
        </div>
    </header>

    <div class="catalogo-shell">
        <div class="catalogo-tools" role="tablist" aria-label="Filtrar por categoria">
            <button type="button" class="catalogo-chip is-active" data-categoria="">Todas</button>
            @foreach($todasCategorias as $cat)
                <button type="button" class="catalogo-chip" data-categoria="{{ $cat }}">{{ $cat }}</button>
            @endforeach
        </div>

        <div id="produtos-grid" class="catalogo-grid">
            @foreach($produtos as $produto)
                <a class="catalogo-card"
                   href="/site/produtos/{{ $produto->id }}-{{ $produto->slug }}"
                   data-categoria="{{ optional($produto->categoria)->nome }}">
                    @if($produto->imagem)
                        <img src="{{ asset('storage/produtos/' . basename($produto->imagem)) }}" alt="{{ $produto->nome }}">
                    @else
                        <span class="catalogo-ph"><i class="fas fa-box-open"></i></span>
                    @endif
                    <span class="catalogo-body">
                        @if(optional($produto->categoria)->nome)
                            <small>{{ $produto->categoria->nome }}</small>
                        @endif
                        <h2>{{ $produto->nome }}</h2>
                        @if($produto->preco)
                            <strong>R$ {{ number_format((float) $produto->preco, 2, ',', '.') }}</strong>
                        @endif
                    </span>
                </a>
            @endforeach
        </div>

        <p id="no-results" class="catalogo-empty">Nenhum produto nessa categoria.</p>

        @if($produtos->hasPages())
            <nav class="catalogo-pages" aria-label="Paginação">
                @if($produtos->onFirstPage())
                    <span aria-hidden="true">‹</span>
                @else
                    <a href="{{ $produtos->previousPageUrl() }}" aria-label="Página anterior">‹</a>
                @endif
                @foreach($produtos->getUrlRange(max(1, $produtos->currentPage() - 2), min($produtos->lastPage(), $produtos->currentPage() + 2)) as $page => $url)
                    @if($page == $produtos->currentPage())
                        <span class="is-current" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
                @if($produtos->hasMorePages())
                    <a href="{{ $produtos->nextPageUrl() }}" aria-label="Próxima página">›</a>
                @else
                    <span aria-hidden="true">›</span>
                @endif
            </nav>
        @endif
    </div>
</div>
@endsection

@push('meta')
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org/',
        '@type' => 'ItemList',
        'name' => 'Produtos Shopp Reparos',
        'itemListElement' => collect($produtos->items())->values()->map(function ($produto, $i) {
            return [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $produto->nome,
                'url' => url('/site/produtos/' . $produto->id . '-' . $produto->slug),
            ];
        })->all(),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const chips = document.querySelectorAll('.catalogo-chip');
    const cards = document.querySelectorAll('.catalogo-card');
    const empty = document.getElementById('no-results');

    function filtrar(categoria) {
        let visiveis = 0;
        cards.forEach(function (card) {
            const ok = !categoria || card.dataset.categoria === categoria;
            card.style.display = ok ? '' : 'none';
            if (ok) visiveis++;
        });
        empty.classList.toggle('is-visible', visiveis === 0);
    }

    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            chips.forEach(function (item) { item.classList.remove('is-active'); });
            chip.classList.add('is-active');
            filtrar(chip.dataset.categoria || '');
        });
    });
});
</script>
@endpush
