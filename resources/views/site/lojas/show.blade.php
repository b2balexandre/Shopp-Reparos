@extends('layouts.site')

@section('title', $loja['titulo'] . ' | Shopp Reparos')
@section('description', $loja['descricao'])
@section('keywords', 'shopp reparos ' . strtolower($loja['nome']) . ', loja de ferragens ' . strtolower($loja['nome']) . ', material hidráulico ' . strtolower($loja['nome']) . ', ferramentas brasília')

@push('meta')
    <meta property="og:image" content="{{ asset($loja['imagem']) }}" />
    <meta name="robots" content="index, follow">
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Início', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Lojas', 'item' => url('/lojas')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $loja['nome'], 'item' => url('/lojas/' . $loja['slug'])],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'HardwareStore',
        'name' => $loja['nome_completo'],
        'image' => asset($loja['imagem']),
        'url' => url('/lojas/' . $loja['slug']),
        'telephone' => $loja['telefone_e164'],
        'description' => $loja['descricao'],
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
        'areaServed' => [$loja['bairro'], 'Brasília', 'DF'],
        'sameAs' => [
            'https://api.whatsapp.com/send?phone=' . $loja['whatsapp'],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@push('styles')
<style>
    .loja-page {
        --sr-blue: #0b3a82;
        --sr-blue-deep: #072a5e;
        --sr-yellow: #f5c518;
        --sr-ink: #10233f;
        --sr-muted: #5b6b82;
        --sr-line: rgba(11, 58, 130, 0.12);
        --sr-soft: #f3f7fc;
        color: var(--sr-ink);
        padding-bottom: 5.5rem;
        width: 100%;
        max-width: 100%;
        overflow-x: clip;
    }

    .loja-shell {
        width: 100%;
        max-width: 1120px;
        margin-inline: auto;
        padding-inline: 1rem;
    }

    .loja-kicker {
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

    .loja-kicker::before {
        content: "";
        width: 1.5rem;
        height: 2px;
        flex: 0 0 auto;
        background: var(--sr-yellow);
    }

    .loja-breadcrumb {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        align-items: center;
        font-size: .84rem;
        color: var(--sr-muted);
        padding: 1.1rem 0 0;
    }

    .loja-breadcrumb a {
        color: var(--sr-blue);
        text-decoration: none;
        font-weight: 600;
    }

    .loja-hero {
        position: relative;
        overflow: hidden;
        padding: 1.25rem 0 2rem;
        background:
            radial-gradient(circle at 80% 0%, rgba(245, 197, 24, .16), transparent 28%),
            linear-gradient(180deg, #eef4fb 0%, #ffffff 78%);
    }

    .loja-hero h1 {
        width: 100%;
        max-width: 100%;
        font-family: Poppins, sans-serif;
        font-size: clamp(1.55rem, 4.8vw + .55rem, 2.9rem);
        line-height: 1.12;
        letter-spacing: -.03em;
        font-weight: 800;
        color: var(--sr-blue-deep);
        margin: .7rem 0 .85rem;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .loja-hero-lead {
        width: 100%;
        max-width: 34rem;
        color: var(--sr-muted);
        font-size: clamp(.95rem, 2.2vw, 1.05rem);
        line-height: 1.6;
        margin-bottom: 1.25rem;
        overflow-wrap: anywhere;
    }

    .loja-cta-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: .65rem;
        margin-bottom: 1.5rem;
    }

    .loja-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .55rem;
        min-height: 3.15rem;
        padding: .85rem 1.1rem;
        font-weight: 700;
        font-size: .95rem;
        text-decoration: none;
        border: 0;
        transition: transform .2s ease, background .2s ease, border-color .2s ease;
    }

    .loja-btn:active { transform: scale(.98); }

    .loja-btn-primary {
        background: var(--sr-blue);
        color: #fff;
    }

    .loja-btn-primary:hover { background: var(--sr-blue-deep); color: #fff; }

    .loja-btn-whatsapp {
        background: #1f9d57;
        color: #fff;
    }

    .loja-btn-whatsapp:hover { background: #178a4a; color: #fff; }

    .loja-btn-ghost {
        background: #fff;
        color: var(--sr-blue);
        border: 1px solid var(--sr-line);
    }

    .loja-btn-ghost:hover {
        border-color: var(--sr-blue);
        background: #f5f9ff;
        color: var(--sr-blue-deep);
    }

    .loja-info-grid {
        display: grid;
        gap: .85rem;
    }

    .loja-info-item {
        padding: 1rem 0;
        border-top: 1px solid var(--sr-line);
    }

    .loja-info-item:last-child {
        border-bottom: 1px solid var(--sr-line);
    }

    .loja-info-item h2 {
        margin: 0 0 .35rem;
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .08em;
        font-weight: 800;
        color: var(--sr-muted);
    }

    .loja-info-item p {
        margin: 0;
        font-size: 1rem;
        line-height: 1.5;
        font-weight: 600;
        color: var(--sr-ink);
    }

    .loja-info-item a {
        color: var(--sr-blue);
        text-decoration: none;
        font-weight: 700;
    }

    .loja-visual {
        margin-top: 1.5rem;
        display: grid;
        gap: .85rem;
    }

    .loja-visual img {
        width: 100%;
        height: 15.5rem;
        object-fit: cover;
        display: block;
    }

    .loja-visual iframe {
        width: 100%;
        height: 14rem;
        border: 0;
        display: block;
    }

    .loja-section {
        padding: 2.6rem 0;
        border-top: 1px solid var(--sr-line);
    }

    .loja-section-head {
        margin-bottom: 1.25rem;
    }

    .loja-section-head h2 {
        font-family: Poppins, sans-serif;
        font-size: clamp(1.35rem, 4vw, 1.9rem);
        line-height: 1.15;
        font-weight: 800;
        color: var(--sr-blue-deep);
        margin: .35rem 0 .5rem;
    }

    .loja-section-head p {
        margin: 0;
        color: var(--sr-muted);
        line-height: 1.55;
        max-width: 36rem;
    }

    .loja-split {
        display: grid;
        gap: 1.75rem;
    }

    .loja-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: .65rem;
    }

    .loja-list li {
        display: flex;
        align-items: center;
        gap: .7rem;
        font-weight: 600;
        color: var(--sr-ink);
    }

    .loja-list li::before {
        content: "";
        width: .55rem;
        height: .55rem;
        flex: 0 0 auto;
        background: var(--sr-yellow);
        border-radius: 50%;
    }

    .loja-list a {
        color: var(--sr-blue);
        text-decoration: none;
        font-weight: 700;
    }

    .loja-list a:hover { text-decoration: underline; }

    .loja-panel {
        background: var(--sr-soft);
        border: 1px solid var(--sr-line);
        padding: 1.15rem;
    }

    .loja-panel h3 {
        margin: 0 0 .7rem;
        font-family: Poppins, sans-serif;
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--sr-blue-deep);
    }

    .loja-panel p {
        margin: 0 0 1rem;
        color: var(--sr-muted);
        line-height: 1.55;
    }

    .loja-cats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .65rem;
        margin-bottom: 1rem;
    }

    .loja-cat {
        min-height: 3.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: .75rem .6rem;
        background: #fff;
        border: 1px solid var(--sr-line);
        color: var(--sr-blue-deep);
        text-decoration: none;
        font-weight: 700;
        font-size: .9rem;
        transition: background .2s ease, border-color .2s ease, transform .2s ease;
    }

    .loja-cat:hover {
        background: #e7effb;
        border-color: rgba(11, 58, 130, .28);
        transform: translateY(-1px);
    }

    .loja-faq details {
        border-bottom: 1px solid var(--sr-line);
        padding: 1rem 0;
    }

    .loja-faq summary {
        list-style: none;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        align-items: flex-start;
        font-weight: 700;
        color: var(--sr-blue-deep);
        line-height: 1.35;
    }

    .loja-faq summary::-webkit-details-marker { display: none; }

    .loja-faq summary i {
        color: var(--sr-blue);
        margin-top: .15rem;
        transition: transform .25s ease;
    }

    .loja-faq details[open] summary i { transform: rotate(180deg); }

    .loja-faq p {
        margin: .7rem 0 0;
        color: var(--sr-muted);
        line-height: 1.6;
    }

    .loja-other {
        display: grid;
        gap: 1rem;
    }

    .loja-other a {
        display: grid;
        gap: .85rem;
        text-decoration: none;
        color: inherit;
        background: #fff;
        border: 1px solid var(--sr-line);
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .loja-other a:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 32px rgba(7, 42, 94, .08);
    }

    .loja-other img {
        width: 100%;
        height: 10rem;
        object-fit: cover;
        display: block;
    }

    .loja-other-body {
        padding: 0 1rem 1.1rem;
    }

    .loja-other-body h3 {
        margin: 0 0 .35rem;
        font-family: Poppins, sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--sr-blue-deep);
    }

    .loja-other-body p {
        margin: 0 0 .55rem;
        color: var(--sr-muted);
        font-size: .92rem;
    }

    .loja-other-body span {
        color: var(--sr-blue);
        font-weight: 700;
        font-size: .9rem;
    }

    .loja-sticky-cta {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 40;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .5rem;
        padding: .65rem .75rem calc(.65rem + env(safe-area-inset-bottom));
        background: rgba(255,255,255,.94);
        backdrop-filter: blur(10px);
        border-top: 1px solid var(--sr-line);
        box-shadow: 0 -10px 30px rgba(7, 42, 94, .08);
    }

    .loja-sticky-cta .loja-btn {
        min-height: 2.9rem;
        font-size: .88rem;
    }

    /* Evita conflito com o botão flutuante global do layout */
    body:has(.loja-sticky-cta) .fixed.bottom-6.right-6 {
        display: none !important;
    }

    .loja-reveal {
        animation: lojaRise .65s ease both;
    }

    @keyframes lojaRise {
        from {
            opacity: 0;
            transform: translateY(16px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .loja-reveal { animation: none; }
    }

    @media (min-width: 640px) {
        .loja-cta-row { grid-template-columns: 1fr 1fr; }
        .loja-cats { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .loja-visual img { height: 18rem; }
        .loja-visual iframe { height: 16rem; }
    }

    @media (min-width: 900px) {
        .loja-page { padding-bottom: 0; }
        .loja-sticky-cta { display: none; }
        .loja-hero-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(0, .95fr);
            gap: 2.25rem;
            align-items: start;
        }
        .loja-visual { margin-top: 0; }
        .loja-split { grid-template-columns: minmax(0, 1.1fr) minmax(0, .9fr); gap: 2rem; align-items: start; }
        .loja-section { padding: 3.25rem 0; }
        .loja-cats { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .loja-other { grid-template-columns: 1fr; max-width: 28rem; }
        .loja-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="loja-page">
    <section class="loja-hero">
        <div class="loja-shell">
            <nav class="loja-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ url('/') }}">Início</a>
                <span aria-hidden="true">/</span>
                <a href="{{ url('/lojas') }}">Lojas</a>
                <span aria-hidden="true">/</span>
                <span>{{ $loja['nome'] }}</span>
            </nav>

            <div class="loja-hero-grid" style="margin-top:1.25rem;">
                <div class="loja-reveal">
                    <p class="loja-kicker">{{ $loja['nome_completo'] }}</p>
                    <h1>{{ $loja['nome_completo'] }}</h1>
                    <p class="loja-hero-lead">
                        Loja de ferragens, materiais hidráulicos, elétricos e ferramentas em {{ $loja['bairro'] }} — {{ $loja['cidade'] }}/{{ $loja['uf'] }}.
                    </p>

                    <div class="loja-cta-row">
                        <a class="loja-btn loja-btn-primary" href="{{ $loja['maps_url'] }}" target="_blank" rel="noopener">
                            <i class="fas fa-route"></i> Abrir no Google Maps
                        </a>
                        <a class="loja-btn loja-btn-whatsapp" href="https://api.whatsapp.com/send?phone={{ $loja['whatsapp'] }}&text={{ urlencode('Olá! Gostaria de falar com a ' . $loja['nome_completo'] . '.') }}" target="_blank" rel="noopener">
                            <i class="fab fa-whatsapp"></i> Falar no WhatsApp
                        </a>
                    </div>

                    <div class="loja-info-grid">
                        <div class="loja-info-item">
                            <h2>Onde estamos</h2>
                            <p>{{ $loja['endereco'] }}</p>
                            <p>{{ $loja['bairro'] }} — {{ $loja['cidade'] }}/{{ $loja['uf'] }}</p>
                            <p style="margin-top:.45rem;"><a href="{{ $loja['maps_url'] }}" target="_blank" rel="noopener">Como chegar</a></p>
                        </div>
                        <div class="loja-info-item">
                            <h2>Horário</h2>
                            <p>{{ $loja['horario_semana'] }}</p>
                            <p>{{ $loja['horario_sabado'] }}</p>
                        </div>
                        <div class="loja-info-item">
                            <h2>Atendimento</h2>
                            <p><a href="tel:{{ $loja['telefone_e164'] }}">{{ $loja['telefone'] }}</a></p>
                        </div>
                    </div>
                </div>

                <div class="loja-visual loja-reveal">
                    <img src="{{ asset($loja['imagem']) }}" alt="{{ $loja['nome_completo'] }}">
                    <iframe
                        src="{{ $loja['maps_embed'] }}"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Mapa {{ $loja['nome_completo'] }}">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="loja-section" style="background:#fff;">
        <div class="loja-shell loja-split">
            <div>
                <div class="loja-section-head">
                    <p class="loja-kicker">Nesta loja</p>
                    <h2>O que você encontra</h2>
                </div>
                <ul class="loja-list">
                    @forelse($categorias as $categoria)
                        <li>
                            <a href="{{ url('/lojas/' . $loja['slug']) }}?categoria={{ $categoria->id }}">
                                {{ $categoria->nome }} ({{ $categoria->produtos_count }})
                            </a>
                        </li>
                    @empty
                        <li>As categorias cadastradas no admin aparecem aqui.</li>
                    @endforelse
                </ul>
            </div>

            <div class="loja-panel">
                <h3>Serviços disponíveis em {{ $loja['nome'] }}</h3>
                <ul class="loja-list" style="margin-bottom:1.1rem;">
                    @forelse($servicos as $servico)
                        <li>
                            <a href="{{ url('/site/servicos/' . $servico->id . '-' . ($servico->slug ?: \Illuminate\Support\Str::slug($servico->titulo))) }}">
                                {{ $servico->titulo }}@if($servico->marca) — {{ $servico->marca }}@endif
                            </a>
                        </li>
                    @empty
                        <li>Os serviços ativos desta loja aparecem aqui assim que forem cadastrados no admin.</li>
                    @endforelse
                </ul>
                <h3>Marcas</h3>
                @if($marcas->isEmpty())
                    <p>As marcas dos serviços cadastrados no admin aparecem nesta loja.</p>
                @else
                    <p>{{ $marcas->join(', ') }}.</p>
                @endif
                <a class="loja-btn loja-btn-ghost" href="/assistencia-tecnica">Ver assistência técnica</a>
            </div>
        </div>
    </section>

    <section class="loja-section" style="background:var(--sr-soft);">
        <div class="loja-shell">
            <div class="loja-section-head">
                <p class="loja-kicker">Produtos</p>
                <h2>Produtos encontrados na {{ $loja['nome_completo'] }}</h2>
                <p>
                    @if($categoriaAtiva)
                        Categoria {{ $categoriaAtiva->nome }}, conforme o cadastro do admin.
                    @else
                        Itens marcados como disponíveis nesta unidade no cadastro de produtos.
                    @endif
                </p>
            </div>

            <div class="loja-cats">
                <a class="loja-cat" href="{{ url('/lojas/' . $loja['slug']) }}">Todas</a>
                @foreach($categorias as $categoria)
                    <a class="loja-cat" href="{{ url('/lojas/' . $loja['slug']) }}?categoria={{ $categoria->id }}">{{ $categoria->nome }}</a>
                @endforeach
            </div>

            @if($produtos->isEmpty())
                <p style="margin-top:1rem;color:#5b6b82;">Nenhum produto desta loja nessa seleção. Cadastre ou marque a disponibilidade no admin.</p>
            @else
                <div class="loja-cats" style="margin-top:1rem;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));">
                    @foreach($produtos->take(8) as $produto)
                        <a class="loja-cat" href="{{ url('/site/produtos/' . $produto->id . '-' . ($produto->slug ?: \Illuminate\Support\Str::slug($produto->nome))) }}" style="flex-direction:column;gap:.4rem;min-height:7rem;">
                            <img src="{{ $produto->imagem ? asset('storage/produtos/' . basename($produto->imagem)) : asset('img/logo.png') }}" alt="" style="width:3rem;height:3rem;object-fit:contain;">
                            <span>{{ $produto->nome }}</span>
                        </a>
                    @endforeach
                </div>
            @endif

            <a class="loja-btn loja-btn-primary" href="/site/produtos" style="max-width:22rem;margin-top:1rem;">
                Ver catálogo completo
            </a>
        </div>
    </section>

    <section class="loja-section" style="background:#fff;">
        <div class="loja-shell">
            <div class="loja-section-head">
                <p class="loja-kicker">Fotos</p>
                <h2>A loja e os produtos</h2>
            </div>
            <div class="loja-cats" style="grid-template-columns:repeat(auto-fit,minmax(160px,1fr));">
                <div class="loja-cat" style="padding:0;overflow:hidden;min-height:8rem;">
                    <img src="{{ asset($loja['imagem']) }}" alt="Fachada {{ $loja['nome_completo'] }}" style="width:100%;height:8rem;object-fit:cover;">
                </div>
                @foreach($fotos as $foto)
                    <div class="loja-cat" style="padding:.5rem;min-height:8rem;flex-direction:column;">
                        <img src="{{ asset('storage/produtos/' . basename($foto->imagem)) }}" alt="{{ $foto->nome }}" style="width:100%;height:6rem;object-fit:contain;">
                        <span>{{ $foto->nome }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="loja-section" style="background:var(--sr-soft);">
        <div class="loja-shell">
            <div class="loja-section-head">
                <p class="loja-kicker">Avaliações</p>
                <h2>O que os clientes registraram</h2>
            </div>
            @if($avaliacoes->isEmpty())
                <p style="color:#5b6b82;">As avaliações das ordens de serviço aparecem aqui quando houver comentário no admin.</p>
            @else
                <div class="loja-split">
                    @foreach($avaliacoes as $avaliacao)
                        <article class="loja-panel">
                            <h3>{{ str_repeat('★', (int) $avaliacao->nota) }} {{ $avaliacao->nota }}/5</h3>
                            <p>{{ $avaliacao->comentario }}</p>
                            <p style="margin:0;font-size:.85rem;">{{ $avaliacao->user->name ?? 'Cliente' }}</p>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="loja-section loja-faq" style="background:#fff;">
        <div class="loja-shell">
            <div class="loja-section-head">
                <p class="loja-kicker">FAQ</p>
                <h2>Perguntas frequentes — {{ $loja['nome'] }}</h2>
            </div>

            @foreach([
                ['A Shopp Reparos tem loja em ' . $loja['nome'] . '?', 'Sim. A ' . $loja['nome_completo'] . ' fica em ' . $loja['endereco'] . ', ' . $loja['bairro'] . ' — ' . $loja['cidade'] . '/' . $loja['uf'] . '.'],
                ['Qual o horário de funcionamento em ' . $loja['nome'] . '?', $loja['horario_semana'] . '. ' . $loja['horario_sabado'] . '.'],
                ['Como falar com a loja de ' . $loja['nome'] . '?', 'Ligue para ' . $loja['telefone'] . ' ou fale pelo WhatsApp para consultar produtos, disponibilidade e serviços.'],
                ['A Shopp Reparos faz entrega?', 'Sim, fazemos entrega local em Águas Claras, Taguatinga e Brasília. Prazo e valor são confirmados no WhatsApp da loja, conforme o produto.'],
                ['Posso solicitar um reparo nesta loja?', 'Sim. Você pode solicitar reparos hidráulicos, serviços elétricos, assistência técnica e manutenção predial pelo WhatsApp.'],
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

    @if($outrasLojas->isNotEmpty())
    <section class="loja-section" style="background:var(--sr-soft);">
        <div class="loja-shell">
            <div class="loja-section-head">
                <p class="loja-kicker">Outra unidade</p>
                <h2>Outra loja Shopp Reparos</h2>
            </div>
            <div class="loja-other">
                @foreach($outrasLojas as $outra)
                    <a href="{{ url('/lojas/' . $outra['slug']) }}">
                        <img src="{{ asset($outra['imagem']) }}" alt="{{ $outra['nome_completo'] }}">
                        <div class="loja-other-body">
                            <h3>{{ $outra['nome_completo'] }}</h3>
                            <p>{{ $outra['endereco'] }} — {{ $outra['bairro'] }}</p>
                            <span>Ver loja →</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <div class="loja-sticky-cta" aria-label="Ações rápidas">
        <a class="loja-btn loja-btn-primary" href="{{ $loja['maps_url'] }}" target="_blank" rel="noopener">
            <i class="fas fa-route"></i> Como chegar
        </a>
        <a class="loja-btn loja-btn-whatsapp" href="https://api.whatsapp.com/send?phone={{ $loja['whatsapp'] }}&text={{ urlencode('Olá! Gostaria de falar com a ' . $loja['nome_completo'] . '.') }}" target="_blank" rel="noopener">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
    </div>
</div>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [
        [
            '@type' => 'Question',
            'name' => 'A Shopp Reparos tem loja em ' . $loja['nome'] . '?',
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Sim. A ' . $loja['nome_completo'] . ' fica em ' . $loja['endereco'] . ', ' . $loja['bairro'] . '.'],
        ],
        [
            '@type' => 'Question',
            'name' => 'Qual o horário de funcionamento em ' . $loja['nome'] . '?',
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $loja['horario_semana'] . '. ' . $loja['horario_sabado'] . '.'],
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection
