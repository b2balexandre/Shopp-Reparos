@extends('layouts.site')

@section('title', 'Lojas Shopp Reparos em Brasília | Águas Claras e Taguatinga')
@section('description', 'Encontre as lojas Shopp Reparos em Águas Claras e Taguatinga, Brasília. Veja endereço, horário, telefone, WhatsApp, produtos, serviços e como chegar.')
@section('keywords', 'loja de ferragens águas claras, loja de material hidráulico águas claras, loja de material elétrico águas claras, loja de ferramentas taguatinga, shopp reparos águas claras, shopp reparos taguatinga, material hidráulico taguatinga sul')

@push('meta')
    <meta name="robots" content="index, follow">
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Início', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Lojas', 'item' => url('/lojas')],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'Lojas Shopp Reparos',
        'itemListElement' => collect($lojas)->values()->map(function ($loja, $index) {
            return [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'item' => [
                    '@type' => 'HardwareStore',
                    'name' => $loja['nome_completo'],
                    'url' => url('/lojas/' . $loja['slug']),
                    'telephone' => $loja['telefone_e164'],
                    'image' => asset($loja['imagem']),
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => $loja['endereco'],
                        'addressLocality' => $loja['bairro'],
                        'addressRegion' => $loja['uf'],
                        'postalCode' => $loja['cep'],
                        'addressCountry' => 'BR',
                    ],
                    'openingHoursSpecification' => [
                        [
                            '@type' => 'OpeningHoursSpecification',
                            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                            'opens' => '08:00',
                            'closes' => '18:00',
                        ],
                        [
                            '@type' => 'OpeningHoursSpecification',
                            'dayOfWeek' => 'Saturday',
                            'opens' => '08:00',
                            'closes' => '14:00',
                        ],
                    ],
                ],
            ];
        })->all(),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@push('styles')
<style>
    .lojas-page {
        --sr-blue: #0b3a82;
        --sr-blue-deep: #072a5e;
        --sr-yellow: #f5c518;
        --sr-ink: #10233f;
        --sr-muted: #5b6b82;
        --sr-line: rgba(11, 58, 130, 0.12);
        --sr-soft: #f3f7fc;
        color: var(--sr-ink);
        width: 100%;
        max-width: 100%;
        overflow-x: clip;
    }

    .lojas-page * { box-sizing: border-box; }

    .lojas-shell {
        width: 100%;
        max-width: 1120px;
        margin-inline: auto;
        padding-inline: 1rem;
    }

    .lojas-kicker {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--sr-blue);
        max-width: 100%;
    }

    .lojas-kicker::before {
        content: "";
        width: 1.5rem;
        height: 2px;
        flex: 0 0 auto;
        background: var(--sr-yellow);
    }

    .lojas-hero {
        position: relative;
        overflow: hidden;
        padding: 1.25rem 0 2.5rem;
        background:
            radial-gradient(circle at 12% 18%, rgba(245, 197, 24, .18), transparent 32%),
            radial-gradient(circle at 88% 8%, rgba(11, 58, 130, .12), transparent 28%),
            linear-gradient(180deg, #eef4fb 0%, #ffffff 72%);
    }

    .lojas-hero::after {
        content: "";
        position: absolute;
        inset: auto 0 -40% auto;
        width: min(18rem, 50vw);
        height: min(18rem, 50vw);
        border-radius: 50%;
        background: radial-gradient(circle, rgba(11, 58, 130, .08), transparent 70%);
        pointer-events: none;
    }

    .lojas-breadcrumb {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        align-items: center;
        font-size: .84rem;
        color: var(--sr-muted);
        margin-bottom: 1.5rem;
    }

    .lojas-breadcrumb a { color: var(--sr-blue); text-decoration: none; font-weight: 600; }
    .lojas-breadcrumb a:hover { text-decoration: underline; }

    .lojas-hero h1 {
        width: 100%;
        max-width: 100%;
        font-family: Poppins, sans-serif;
        font-size: clamp(1.55rem, 4.8vw + .6rem, 3.2rem);
        line-height: 1.12;
        letter-spacing: -.03em;
        font-weight: 800;
        color: var(--sr-blue-deep);
        margin: .85rem 0 1rem;
        overflow-wrap: anywhere;
        word-break: break-word;
        hyphens: auto;
    }

    .lojas-hero-lead {
        width: 100%;
        max-width: 38rem;
        font-size: clamp(.95rem, 2.2vw, 1.05rem);
        line-height: 1.65;
        color: var(--sr-muted);
        margin-bottom: 1.5rem;
        overflow-wrap: anywhere;
    }

    .lojas-hero-meta {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .65rem;
        width: 100%;
        max-width: min(28rem, 100%);
    }

    .lojas-hero-meta div {
        min-width: 0;
        padding: .85rem .75rem;
        border: 1px solid var(--sr-line);
        background: rgba(255,255,255,.78);
        backdrop-filter: blur(6px);
    }

    .lojas-hero-meta strong {
        display: block;
        font-size: clamp(1.1rem, 4vw, 1.35rem);
        font-family: Poppins, sans-serif;
        color: var(--sr-blue);
        line-height: 1;
        margin-bottom: .25rem;
    }

    .lojas-hero-meta span {
        display: block;
        font-size: .72rem;
        color: var(--sr-muted);
        font-weight: 600;
        line-height: 1.35;
        overflow-wrap: anywhere;
    }

    .lojas-section {
        padding: 2.75rem 0;
    }

    .lojas-section + .lojas-section {
        border-top: 1px solid var(--sr-line);
    }

    .lojas-section-head {
        margin-bottom: 1.5rem;
    }

    .lojas-section-head h2 {
        font-family: Poppins, sans-serif;
        font-size: clamp(1.45rem, 4vw, 2rem);
        line-height: 1.15;
        font-weight: 800;
        color: var(--sr-blue-deep);
        margin: .4rem 0 .55rem;
    }

    .lojas-section-head p {
        max-width: 36rem;
        color: var(--sr-muted);
        line-height: 1.6;
    }

    .lojas-store-stack {
        display: grid;
        gap: 1.25rem;
    }

    .lojas-store {
        display: grid;
        gap: 0;
        overflow: hidden;
        border: 1px solid var(--sr-line);
        background: #fff;
        box-shadow: 0 18px 40px rgba(7, 42, 94, .06);
        transition: transform .35s ease, box-shadow .35s ease;
    }

    .lojas-store:hover {
        transform: translateY(-3px);
        box-shadow: 0 24px 48px rgba(7, 42, 94, .1);
    }

    .lojas-store-media {
        position: relative;
        min-height: 15rem;
        overflow: hidden;
    }

    .lojas-store-media img {
        width: 100%;
        height: 100%;
        min-height: 15rem;
        object-fit: cover;
        display: block;
        transition: transform .6s ease;
    }

    .lojas-store:hover .lojas-store-media img {
        transform: scale(1.04);
    }

    .lojas-store-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        z-index: 1;
        background: var(--sr-yellow);
        color: var(--sr-blue-deep);
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .06em;
        text-transform: uppercase;
        padding: .45rem .7rem;
    }

    .lojas-store-body {
        padding: 1.25rem 1.15rem 1.35rem;
        display: grid;
        gap: 1rem;
    }

    .lojas-store-body h2 {
        font-family: Poppins, sans-serif;
        font-size: 1.55rem;
        font-weight: 800;
        color: var(--sr-blue-deep);
        margin: 0;
    }

    .lojas-store-body h2 a {
        color: inherit;
        text-decoration: none;
    }

    .lojas-store-body h2 a:hover { color: var(--sr-blue); }

    .lojas-store-body > p {
        margin: -.35rem 0 0;
        color: var(--sr-muted);
        font-size: .95rem;
    }

    .lojas-facts {
        display: grid;
        gap: .7rem;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .lojas-facts li {
        display: grid;
        grid-template-columns: 1.1rem 1fr;
        gap: .7rem;
        align-items: start;
        font-size: .95rem;
        line-height: 1.45;
        color: var(--sr-ink);
    }

    .lojas-facts i {
        margin-top: .18rem;
        color: var(--sr-blue);
        font-size: .85rem;
    }

    .lojas-cta-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: .65rem;
    }

    .lojas-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .55rem;
        min-height: 3.1rem;
        padding: .85rem 1.1rem;
        font-weight: 700;
        font-size: .95rem;
        text-decoration: none;
        border: 0;
        cursor: pointer;
        transition: transform .2s ease, background .2s ease, color .2s ease, border-color .2s ease;
    }

    .lojas-btn:active { transform: scale(.98); }

    .lojas-btn-primary {
        background: var(--sr-blue);
        color: #fff;
    }

    .lojas-btn-primary:hover { background: var(--sr-blue-deep); color: #fff; }

    .lojas-btn-whatsapp {
        background: #1f9d57;
        color: #fff;
    }

    .lojas-btn-whatsapp:hover { background: #178a4a; color: #fff; }

    .lojas-btn-ghost {
        background: transparent;
        color: var(--sr-blue);
        border: 1px solid var(--sr-line);
    }

    .lojas-btn-ghost:hover {
        border-color: var(--sr-blue);
        background: #f5f9ff;
        color: var(--sr-blue-deep);
    }

    .lojas-link {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        color: var(--sr-blue);
        font-weight: 700;
        text-decoration: none;
    }

    .lojas-link:hover { text-decoration: underline; }

    .lojas-compare {
        display: grid;
        gap: 1rem;
    }

    .lojas-compare-card {
        background: var(--sr-soft);
        border: 1px solid var(--sr-line);
        padding: 1.15rem;
    }

    .lojas-compare-card h3 {
        font-family: Poppins, sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--sr-blue-deep);
        margin: 0 0 1rem;
    }

    .lojas-compare-rows {
        display: grid;
        gap: .75rem;
    }

    .lojas-compare-rows div {
        display: grid;
        gap: .2rem;
        padding-bottom: .75rem;
        border-bottom: 1px solid var(--sr-line);
    }

    .lojas-compare-rows div:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .lojas-compare-rows dt {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .08em;
        font-weight: 700;
        color: var(--sr-muted);
    }

    .lojas-compare-rows dd {
        margin: 0;
        font-size: .95rem;
        font-weight: 600;
        color: var(--sr-ink);
    }

    .lojas-compare-rows a {
        color: var(--sr-blue);
        text-decoration: none;
        font-weight: 700;
    }

    .lojas-search-box {
        display: grid;
        gap: .75rem;
        margin-bottom: 1.5rem;
    }

    .lojas-search-box input {
        width: 100%;
        min-height: 3.2rem;
        border: 1.5px solid var(--sr-line);
        background: #fff;
        padding: .9rem 1.1rem;
        font-size: 1rem;
        color: var(--sr-ink);
        outline: none;
    }

    .lojas-search-box input:focus {
        border-color: var(--sr-blue);
        box-shadow: 0 0 0 4px rgba(11, 58, 130, .08);
    }

    .lojas-results {
        display: grid;
        gap: 1rem;
        margin-bottom: 1.75rem;
    }

    .lojas-result {
        display: grid;
        gap: .9rem;
        padding: 1rem;
        background: #fff;
        border: 1px solid var(--sr-line);
    }

    .lojas-result-top {
        display: grid;
        grid-template-columns: 4rem 1fr;
        gap: .85rem;
        align-items: center;
    }

    .lojas-result-top img {
        width: 4rem;
        height: 4rem;
        object-fit: contain;
        background: var(--sr-soft);
        padding: .35rem;
    }

    .lojas-result-top small {
        display: block;
        font-size: .7rem;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--sr-muted);
        font-weight: 700;
        margin-bottom: .2rem;
    }

    .lojas-result-top h3 {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: var(--sr-ink);
        line-height: 1.3;
    }

    .lojas-result p {
        margin: 0;
        color: var(--sr-muted);
        font-size: .9rem;
        line-height: 1.5;
    }

    .lojas-availability {
        display: grid;
        gap: .35rem;
        font-size: .85rem;
        font-weight: 600;
    }

    .lojas-empty {
        padding: 1.2rem;
        background: #fff8e8;
        border: 1px solid rgba(245, 197, 24, .45);
    }

    .lojas-empty h3 {
        margin: 0 0 .4rem;
        font-size: 1.05rem;
        color: var(--sr-blue-deep);
    }

    .lojas-empty p {
        margin: 0 0 1rem;
        color: var(--sr-muted);
    }

    .lojas-cats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .65rem;
    }

    .lojas-cat {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 3.4rem;
        padding: .8rem .7rem;
        text-align: center;
        text-decoration: none;
        font-weight: 700;
        font-size: .9rem;
        color: var(--sr-blue-deep);
        background: var(--sr-soft);
        border: 1px solid var(--sr-line);
        transition: background .2s ease, border-color .2s ease, transform .2s ease;
    }

    .lojas-cat:hover {
        background: #e7effb;
        border-color: rgba(11, 58, 130, .28);
        transform: translateY(-1px);
    }

    .lojas-faq details {
        border-bottom: 1px solid var(--sr-line);
        padding: 1rem 0;
    }

    .lojas-faq summary {
        list-style: none;
        cursor: pointer;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        font-weight: 700;
        color: var(--sr-blue-deep);
        font-size: 1rem;
        line-height: 1.35;
    }

    .lojas-faq summary::-webkit-details-marker { display: none; }

    .lojas-faq summary i {
        color: var(--sr-blue);
        margin-top: .2rem;
        transition: transform .25s ease;
    }

    .lojas-faq details[open] summary i {
        transform: rotate(180deg);
    }

    .lojas-faq p {
        margin: .75rem 0 0;
        color: var(--sr-muted);
        line-height: 1.6;
        max-width: 42rem;
    }

    .lojas-reveal {
        animation: lojasRise .7s ease both;
    }

    .lojas-reveal:nth-child(2) { animation-delay: .08s; }
    .lojas-reveal:nth-child(3) { animation-delay: .16s; }

    @keyframes lojasRise {
        from {
            opacity: 0;
            transform: translateY(18px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .lojas-reveal {
            animation: none;
        }
    }

    @media (min-width: 640px) {
        .lojas-cta-row { grid-template-columns: 1fr 1fr; }
        .lojas-search-box {
            grid-template-columns: 1fr auto;
            align-items: stretch;
        }
        .lojas-cats { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .lojas-compare { grid-template-columns: 1fr 1fr; }
    }

    @media (min-width: 900px) {
        .lojas-hero { padding: 2rem 0 3.5rem; }
        .lojas-hero-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.3fr) minmax(0, .7fr);
            gap: 2rem;
            align-items: end;
        }
        .lojas-store-stack {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.5rem;
        }
        .lojas-store-body { padding: 1.5rem; }
        .lojas-section { padding: 3.5rem 0; }
        .lojas-cats { grid-template-columns: repeat(6, minmax(0, 1fr)); }
        .lojas-results { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (min-width: 1100px) {
        .lojas-results { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }
</style>
@endpush

@section('content')
<div class="lojas-page">
    <section class="lojas-hero">
        <div class="lojas-shell">
            <nav class="lojas-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ url('/') }}">Início</a>
                <span aria-hidden="true">/</span>
                <span>Lojas</span>
            </nav>

            <div class="lojas-hero-grid">
                <div class="lojas-reveal">
                    <p class="lojas-kicker">Lojas Shopp Reparos</p>
                    <h1>Ferragens, hidráulica, elétrica e ferramentas em Brasília</h1>
                    <p class="lojas-hero-lead">
                        Encontre a Shopp Reparos em Águas Claras e Taguatinga. Consulte endereço, horário, telefone, WhatsApp e como chegar em cada unidade.
                    </p>
                </div>

                <div class="lojas-hero-meta lojas-reveal">
                    <div>
                        <strong>2</strong>
                        <span>Lojas físicas</span>
                    </div>
                    <div>
                        <strong>8–18h</strong>
                        <span>Seg a sex · Sáb até 14h</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="nossas-lojas" class="lojas-section" style="background:#fff;">
        <div class="lojas-shell">
            <div class="lojas-section-head">
                <p class="lojas-kicker">Escolha sua unidade</p>
                <h2>Nossas lojas</h2>
                <p>Cada loja com rota, atendimento e WhatsApp prontos para uso no celular.</p>
            </div>

            <div class="lojas-store-stack">
                @foreach($lojas as $loja)
                    <article class="lojas-store lojas-reveal">
                        <a href="{{ url('/lojas/' . $loja['slug']) }}" class="lojas-store-media" aria-label="Ver página {{ $loja['nome_completo'] }}">
                            <span class="lojas-store-badge">{{ $loja['destaque'] }}</span>
                            <img src="{{ asset($loja['imagem']) }}" alt="{{ $loja['nome_completo'] }}">
                        </a>

                        <div class="lojas-store-body">
                            <div>
                                <h2><a href="{{ url('/lojas/' . $loja['slug']) }}">{{ $loja['nome'] }}</a></h2>
                                <p>Ferragens, hidráulica, elétrica e ferramentas</p>
                            </div>

                            <ul class="lojas-facts">
                                <li><i class="fas fa-map-marker-alt"></i><span>{{ $loja['endereco'] }} — {{ $loja['bairro'] }}, {{ $loja['cidade'] }}/{{ $loja['uf'] }}</span></li>
                                <li><i class="fas fa-clock"></i><span>{{ $loja['horario_resumo'] }}</span></li>
                                <li><i class="fas fa-phone"></i><a href="tel:{{ $loja['telefone_e164'] }}" style="color:inherit;text-decoration:none;">{{ $loja['telefone'] }}</a></li>
                            </ul>

                            <div class="lojas-cta-row">
                                <a class="lojas-btn lojas-btn-primary" href="{{ $loja['maps_url'] }}" target="_blank" rel="noopener">
                                    <i class="fas fa-route"></i> Como chegar
                                </a>
                                <a class="lojas-btn lojas-btn-whatsapp" href="https://api.whatsapp.com/send?phone={{ $loja['whatsapp'] }}&text={{ urlencode('Olá! Gostaria de falar com a loja de ' . $loja['nome'] . '.') }}" target="_blank" rel="noopener">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>

                            <a class="lojas-link" href="{{ url('/lojas/' . $loja['slug']) }}">
                                Ver página da loja <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lojas-section" style="background:var(--sr-soft);">
        <div class="lojas-shell">
            <div class="lojas-section-head">
                <p class="lojas-kicker">Comparativo rápido</p>
                <h2>Qual loja fica melhor para você?</h2>
                <p>Compare localização, telefone, horário e rota das duas unidades.</p>
            </div>

            <div class="lojas-compare">
                @foreach($lojas as $loja)
                    <article class="lojas-compare-card">
                        <h3>{{ $loja['nome'] }}</h3>
                        <dl class="lojas-compare-rows">
                            <div>
                                <dt>Localização</dt>
                                <dd>{{ $loja['bairro'] }}</dd>
                            </div>
                            <div>
                                <dt>Telefone</dt>
                                <dd><a href="tel:{{ $loja['telefone_e164'] }}">{{ $loja['telefone'] }}</a></dd>
                            </div>
                            <div>
                                <dt>Horário</dt>
                                <dd>{{ $loja['horario_resumo'] }}</dd>
                            </div>
                            <div>
                                <dt>WhatsApp</dt>
                                <dd><a href="https://api.whatsapp.com/send?phone={{ $loja['whatsapp'] }}&text={{ urlencode('Olá! Vim pela página de lojas.') }}" target="_blank" rel="noopener">Falar agora</a></dd>
                            </div>
                            <div>
                                <dt>Rota</dt>
                                <dd><a href="{{ $loja['maps_url'] }}" target="_blank" rel="noopener">Como chegar</a></dd>
                            </div>
                            <div>
                                <dt>Página</dt>
                                <dd><a href="{{ url('/lojas/' . $loja['slug']) }}">Ver loja</a></dd>
                            </div>
                        </dl>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="busca" class="lojas-section" style="background:#fff;">
        <div class="lojas-shell">
            <div class="lojas-section-head">
                <p class="lojas-kicker">Busca rápida</p>
                <h2>Encontre o que precisa</h2>
                <p>Digite produto, marca ou o que você precisa resolver. Exemplos: torneira, disjuntor, silicone, chuveiro.</p>
            </div>

            <form action="{{ url('/lojas') }}#busca" method="GET" class="lojas-search-box">
                <label for="busca-loja" class="sr-only">O que você está procurando?</label>
                <input id="busca-loja" type="search" name="q" value="{{ $busca }}" placeholder="O que você está procurando?">
                <button type="submit" class="lojas-btn lojas-btn-primary">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </form>

            @if($busca !== '' || $problema)
                @if($resultados->isEmpty())
                    <div class="lojas-empty">
                        <h3>Não encontramos “{{ $problema['titulo'] ?? $busca }}” no catálogo</h3>
                        <p>Consulte a disponibilidade diretamente pelo WhatsApp da loja.</p>
                        <div class="lojas-cta-row">
                            @foreach($lojas as $loja)
                                <a class="lojas-btn lojas-btn-whatsapp" href="https://api.whatsapp.com/send?phone={{ $loja['whatsapp'] }}&text={{ urlencode('Olá! Estou procurando: ' . ($problema['titulo'] ?? $busca)) }}" target="_blank" rel="noopener">
                                    Consultar em {{ $loja['nome'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="lojas-results">
                        @foreach($resultados as $item)
                            <article class="lojas-result">
                                <div class="lojas-result-top">
                                    <img src="{{ $item['imagem'] }}" alt="{{ $item['titulo'] }}">
                                    <div>
                                        <small>{{ $item['tipo'] === 'produto' ? 'Produto' : 'Serviço' }}@if($item['categoria']) · {{ $item['categoria'] }}@endif</small>
                                        <h3>{{ $item['titulo'] }}</h3>
                                    </div>
                                </div>
                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($item['descricao'] ?? ''), 90) }}</p>
                                <div class="lojas-availability">
                                    <span>{{ $item['aguas_claras'] ? 'Disponível em Águas Claras' : 'Indisponível em Águas Claras' }}</span>
                                    <span>{{ $item['taguatinga'] ? 'Disponível em Taguatinga' : 'Indisponível em Taguatinga' }}</span>
                                </div>
                                <div class="lojas-cta-row">
                                    <a class="lojas-btn lojas-btn-primary" href="{{ $item['url'] }}">Ver detalhes</a>
                                    @php
                                        $lojaWhats = $item['aguas_claras'] ? $lojas['aguas-claras'] : $lojas['taguatinga'];
                                    @endphp
                                    <a class="lojas-btn lojas-btn-ghost" href="https://api.whatsapp.com/send?phone={{ $lojaWhats['whatsapp'] }}&text={{ urlencode('Olá! Quero consultar: ' . $item['titulo']) }}" target="_blank" rel="noopener">WhatsApp</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            @endif

            <div class="lojas-section-head" style="margin-top:2rem;">
                <h2 style="font-size:1.25rem;">O que você está tentando resolver?</h2>
            </div>
            <div class="lojas-cats">
                @foreach($problemas as $itemProblema)
                    <a class="lojas-cat" href="{{ url('/lojas') }}?problema={{ $itemProblema['id'] }}#busca">{{ $itemProblema['titulo'] }}</a>
                @endforeach
            </div>

            <div class="lojas-section-head" style="margin-top:2rem;">
                <h2 style="font-size:1.25rem;">Categorias do catálogo</h2>
            </div>
            <div class="lojas-cats">
                @forelse($categorias as $categoria)
                    <a class="lojas-cat" href="{{ url('/lojas/aguas-claras') }}?categoria={{ $categoria->id }}">{{ $categoria->nome }}</a>
                @empty
                    <p>As categorias criadas no admin aparecem aqui.</p>
                @endforelse
            </div>
            @if($marcas->isNotEmpty())
                <p style="margin-top:1rem;color:#5b6b82;">Marcas nos serviços: {{ $marcas->join(', ') }}.</p>
            @endif
            <div style="margin-top:1rem;">
                <a class="lojas-link" href="/site/produtos">Ver produtos <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <section class="lojas-section" style="background:#fff;">
        <div class="lojas-shell">
            <div class="lojas-section-head">
                <p class="lojas-kicker">Avaliações</p>
                <h2>Depoimentos das ordens de serviço</h2>
            </div>
            @if($avaliacoes->isEmpty())
                <p style="color:#5b6b82;">Quando uma ordem de serviço receber comentário, ele aparece nesta página.</p>
            @else
                <div class="lojas-compare">
                    @foreach($avaliacoes as $avaliacao)
                        <article class="lojas-compare-card">
                            <h3>{{ str_repeat('★', (int) $avaliacao->nota) }}</h3>
                            <p>{{ $avaliacao->comentario }}</p>
                            <p style="margin:0;color:#5b6b82;">{{ $avaliacao->user->name ?? 'Cliente' }}</p>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="lojas-section lojas-faq" style="background:var(--sr-soft);">
        <div class="lojas-shell">
            <div class="lojas-section-head">
                <p class="lojas-kicker">Dúvidas frequentes</p>
                <h2>Perguntas frequentes</h2>
            </div>

            @foreach([
                ['A Shopp Reparos tem loja em Águas Claras?', 'Sim. A Shopp Reparos possui loja física em Águas Claras, Brasília/DF. Confira endereço, horário e WhatsApp na página da loja.'],
                ['A Shopp Reparos tem loja em Taguatinga?', 'Sim. A empresa possui loja em Taguatinga Sul, Brasília/DF, com atendimento em ferragens, hidráulica, elétrica e ferramentas.'],
                ['Qual o horário de funcionamento?', 'Nas duas lojas: segunda a sexta, das 8h às 18h; sábado, das 8h às 14h.'],
                ['Posso consultar um produto antes de ir à loja?', 'Sim. A busca desta página mostra se o item está marcado como disponível em Águas Claras, em Taguatinga ou nas duas, conforme o cadastro do admin.'],
                ['A Shopp Reparos faz entrega?', 'Sim, fazemos entrega local em Águas Claras, Taguatinga e Brasília. Prazo e valor são confirmados no WhatsApp da loja, conforme o produto.'],
                ['Posso solicitar um reparo pelo WhatsApp?', 'Sim. Você pode solicitar orçamento de reparos hidráulicos, serviços elétricos, assistência técnica e manutenção predial pelo WhatsApp.'],
            ] as [$pergunta, $resposta])
                <details>
                    <summary>
                        <span>{{ $pergunta }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </summary>
                    <p>{{ $resposta }}</p>
                </details>
            @endforeach
        </div>
    </section>
</div>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [
        ['@type' => 'Question', 'name' => 'A Shopp Reparos tem loja em Águas Claras?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Sim. A Shopp Reparos possui loja física em Águas Claras, Brasília/DF.']],
        ['@type' => 'Question', 'name' => 'A Shopp Reparos tem loja em Taguatinga?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Sim. A empresa possui loja em Taguatinga Sul, Brasília/DF.']],
        ['@type' => 'Question', 'name' => 'Qual o horário de funcionamento?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Segunda a sexta, das 8h às 18h; sábado, das 8h às 14h.']],
        ['@type' => 'Question', 'name' => 'Posso consultar um produto antes de ir à loja?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Sim. Entre em contato pelo WhatsApp da loja desejada.']],
        ['@type' => 'Question', 'name' => 'Posso solicitar um reparo pelo WhatsApp?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Sim. Você pode solicitar orçamento de reparos e assistência técnica pelo WhatsApp.']],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection
