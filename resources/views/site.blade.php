@extends('layouts.site')

@section('title', 'Shopp Reparos | Ferragens, Hidráulica, Elétrica e Serviços em Brasília')
@section('description', 'Ferragens, hidráulica, elétrica e assistência técnica em Águas Claras e Taguatinga. Veja produtos, serviços e como chegar.')

@push('meta')
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1EWW9KM5F2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-1EWW9KM5F2');
    </script>
    <meta name="google-site-verification" content="ZQmbqwogObdR4NMxb9qRSihILN5ftW2hnsQo7xYQKCM" />
    <meta name="robots" content="index, follow" />
@endpush

@push('styles')
<style>
    .home {
        --blue: #0b3a82;
        --deep: #072a5e;
        --ink: #10233f;
        --muted: #5b6b82;
        --line: rgba(11, 58, 130, .12);
        --soft: #f4f7fb;
        --yellow: #f5c518;
        color: var(--ink);
        width: 100%;
        max-width: 100%;
        overflow-x: clip;
        background: #fff;
    }
    .home-wrap {
        width: min(1120px, calc(100% - 2rem));
        margin-inline: auto;
    }
    .home-hero {
        padding: 1.75rem 0 1.25rem;
        background:
            radial-gradient(circle at 100% 0%, rgba(245, 197, 24, .18), transparent 28%),
            linear-gradient(180deg, #eef3fa 0%, #fff 78%);
    }
    .home-kicker {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        margin: 0 0 .7rem;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--blue);
    }
    .home-kicker::before {
        content: "";
        width: 1.35rem;
        height: 2px;
        background: var(--yellow);
    }
    .home-hero h1 {
        margin: 0 0 .7rem;
        max-width: 16ch;
        font-family: Poppins, sans-serif;
        font-size: clamp(1.85rem, 5.4vw, 3.35rem);
        line-height: 1.05;
        letter-spacing: -.035em;
        font-weight: 800;
        color: var(--deep);
        overflow-wrap: anywhere;
    }
    .home-hero p {
        margin: 0 0 1.15rem;
        max-width: 34rem;
        color: var(--muted);
        font-size: 1.02rem;
        line-height: 1.55;
    }
    .home-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: .6rem;
        max-width: 28rem;
    }
    .home-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 3rem;
        padding: .8rem 1rem;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid transparent;
    }
    .home-btn-primary { background: var(--blue); color: #fff; }
    .home-btn-primary:hover { background: var(--deep); color: #fff; }
    .home-btn-ghost { background: #fff; color: var(--blue); border-color: var(--line); }
    .home-btn-ghost:hover { border-color: var(--blue); color: var(--deep); }
    .home-section { padding: 1.6rem 0; }
    .home-section h2 {
        margin: 0 0 .9rem;
        font-family: Poppins, sans-serif;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--deep);
    }
    .home-paths {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .65rem;
    }
    .home-path {
        display: grid;
        gap: .2rem;
        min-height: 5.5rem;
        padding: .9rem;
        background: var(--soft);
        border: 1px solid var(--line);
        text-decoration: none;
        color: inherit;
    }
    .home-path strong { color: var(--deep); font-size: .95rem; }
    .home-path span { color: var(--muted); font-size: .8rem; line-height: 1.35; }
    .home-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .7rem;
    }
    .home-card {
        display: flex;
        flex-direction: column;
        min-width: 0;
        border: 1px solid var(--line);
        background: #fff;
        text-decoration: none;
        color: inherit;
    }
    .home-card img, .home-ph {
        width: 100%;
        height: 7rem;
        object-fit: contain;
        background: var(--soft);
    }
    .home-ph {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
    }
    .home-card div { padding: .7rem .75rem .85rem; }
    .home-card small {
        display: block;
        margin-bottom: .15rem;
        color: var(--muted);
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
    }
    .home-card h3 {
        margin: 0;
        font-size: .9rem;
        line-height: 1.3;
        font-weight: 700;
    }
    .home-stores {
        display: grid;
        gap: .75rem;
    }
    .home-store {
        display: grid;
        grid-template-columns: 6.5rem 1fr;
        gap: .8rem;
        padding: .7rem;
        border: 1px solid var(--line);
        background: #fff;
        text-decoration: none;
        color: inherit;
    }
    .home-store img {
        width: 6.5rem;
        height: 6.5rem;
        object-fit: cover;
    }
    .home-store h3 { margin: 0 0 .2rem; font-size: 1rem; color: var(--deep); }
    .home-store p { margin: 0; color: var(--muted); font-size: .82rem; line-height: 1.4; }
    .home-banner {
        width: min(88rem, calc(100% - 1.5rem));
        margin: 1rem auto 0;
    }
    .home-banner-frame {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        background: var(--soft);
        box-shadow: 0 8px 24px rgba(11, 58, 130, .12);
    }
    .home-slide { display: none; }
    .home-slide.is-on { display: block; }
    .home-slide img {
        display: block;
        width: 100%;
        height: auto;
    }
    .home-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 2.4rem;
        height: 2.4rem;
        border: 0;
        border-radius: 999px;
        background: rgba(255, 255, 255, .92);
        color: var(--deep);
        font-size: 1.2rem;
        line-height: 1;
        cursor: pointer;
    }
    .home-arrow.prev { left: .7rem; }
    .home-arrow.next { right: .7rem; }
    .home-dots {
        position: absolute;
        left: 0;
        right: 0;
        bottom: .7rem;
        display: flex;
        justify-content: center;
        gap: .4rem;
    }
    .home-dots button {
        width: .5rem;
        height: .5rem;
        border: 0;
        border-radius: 99px;
        background: rgba(255, 255, 255, .7);
        padding: 0;
    }
    .home-dots button.is-on { background: var(--yellow); width: 1.15rem; }
    .home-more {
        display: inline-block;
        margin-top: .8rem;
        color: var(--blue);
        font-weight: 700;
        text-decoration: none;
    }
    .home-partners {
        padding: 1.6rem 0 1.85rem;
        background: #fff;
        border-top: 1px solid var(--line);
        overflow: hidden;
    }
    .home-partners h2 {
        margin: 0 0 .85rem;
        text-align: center;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--muted);
    }
    .home-marquee {
        overflow: hidden;
        width: 100%;
        -webkit-mask-image: linear-gradient(90deg, transparent, #000 6%, #000 94%, transparent);
        mask-image: linear-gradient(90deg, transparent, #000 6%, #000 94%, transparent);
    }
    .home-marquee-track {
        display: flex;
        align-items: center;
        gap: 2.75rem;
        width: max-content;
        animation: home-marquee 42s linear infinite;
    }
    .home-marquee:hover .home-marquee-track { animation-play-state: paused; }
    .home-marquee img {
        height: 3.5rem;
        width: auto;
        max-width: 8.5rem;
        object-fit: contain;
    }
    @keyframes home-marquee {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); }
    }
    @media (prefers-reduced-motion: reduce) {
        .home-marquee { mask-image: none; -webkit-mask-image: none; }
        .home-marquee-track {
            animation: none;
            flex-wrap: wrap;
            justify-content: center;
            width: min(1120px, calc(100% - 2rem));
            margin-inline: auto;
            row-gap: 1.25rem;
        }
        .home-marquee-copy { display: none; }
    }
    @media (min-width: 720px) {
        .home-hero { padding: 2.6rem 0 1.5rem; }
        .home-actions { grid-template-columns: auto auto; }
        .home-paths { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .home-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .home-stores { grid-template-columns: 1fr 1fr; }
        .home-marquee img { height: 4.25rem; max-width: 10.5rem; }
    }
</style>
@endpush

@section('content')
@php $lojas = config('lojas'); @endphp
<div class="home">
    @if($banners->isNotEmpty())
        <section class="home-banner" aria-label="Destaques">
            <div class="home-banner-frame">
                @foreach($banners as $index => $banner)
                    <div class="home-slide {{ $index === 0 ? 'is-on' : '' }}">
                        <picture>
                            <source media="(max-width: 767px)" srcset="{{ $banner->mobile_image_path ?: $banner->desktop_image_path }}">
                            <img src="{{ $banner->desktop_image_path }}" alt="{{ $banner->titulo ?: 'Banner Shopp Reparos' }}">
                        </picture>
                    </div>
                @endforeach
                @if($banners->count() > 1)
                    <button class="home-arrow prev" type="button" aria-label="Banner anterior">&#10094;</button>
                    <button class="home-arrow next" type="button" aria-label="Próximo banner">&#10095;</button>
                    <div class="home-dots">
                        @foreach($banners as $index => $banner)
                            <button type="button" class="{{ $index === 0 ? 'is-on' : '' }}" aria-label="Destaque {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    <section class="home-hero">
        <div class="home-wrap">
            <p class="home-kicker">Águas Claras e Taguatinga</p>
            <h1>Ferragens, hidráulica e reparos em Brasília</h1>
            <p>Produtos para obra e serviços de assistência técnica, com duas lojas físicas e atendimento pelo WhatsApp.</p>
            <div class="home-actions">
                <a class="home-btn home-btn-primary" href="/site/produtos">Ver produtos</a>
                <a class="home-btn home-btn-ghost" href="/lojas">Encontrar uma loja</a>
            </div>
        </div>
    </section>

    <section class="home-section">
        <div class="home-wrap">
            <h2>O que você precisa</h2>
            <div class="home-paths">
                <a class="home-path" href="/reparos-hidraulicos">
                    <strong>Hidráulica</strong>
                    <span>Vazamentos, torneiras e registros</span>
                </a>
                <a class="home-path" href="/site/servicos">
                    <strong>Elétrica</strong>
                    <span>Instalação e manutenção</span>
                </a>
                <a class="home-path" href="/site/produtos">
                    <strong>Ferragens</strong>
                    <span>Peças para obra e reforma</span>
                </a>
                <a class="home-path" href="/assistencia-tecnica">
                    <strong>Assistência</strong>
                    <span>Docol e marcas especializadas</span>
                </a>
            </div>
        </div>
    </section>

    @if($produtos->isNotEmpty())
        <section class="home-section" style="background:var(--soft);">
            <div class="home-wrap">
                <h2>Produtos</h2>
                <div class="home-grid">
                    @foreach($produtos->take(4) as $produto)
                        <a class="home-card" href="/site/produtos/{{ $produto->id }}-{{ $produto->slug }}">
                            @if($produto->imagem)
                                <img src="{{ asset('storage/produtos/' . basename($produto->imagem)) }}" alt="{{ $produto->nome }}">
                            @else
                                <span class="home-ph"><i class="fas fa-box-open"></i></span>
                            @endif
                            <div>
                                @if(optional($produto->categoria)->nome)
                                    <small>{{ $produto->categoria->nome }}</small>
                                @endif
                                <h3>{{ $produto->nome }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
                <a class="home-more" href="/site/produtos">Ver todos os produtos</a>
            </div>
        </section>
    @endif

    @if($servicos->isNotEmpty())
        <section class="home-section">
            <div class="home-wrap">
                <h2>Serviços</h2>
                <div class="home-grid">
                    @foreach($servicos->take(4) as $servico)
                        <a class="home-card" href="/site/servicos/{{ $servico->id }}-{{ $servico->slug }}">
                            @php
                                $imagem = $servico->imagem ? ltrim(str_replace('\\', '/', $servico->imagem), '/') : null;
                                if ($imagem && ! str_starts_with($imagem, 'servicos/')) {
                                    $imagem = 'servicos/' . basename($imagem);
                                }
                            @endphp
                            @if($imagem)
                                <img src="{{ asset('storage/' . $imagem) }}" alt="{{ $servico->titulo }}">
                            @else
                                <span class="home-ph"><i class="fas fa-tools"></i></span>
                            @endif
                            <div>
                                @if($servico->marca)
                                    <small>{{ $servico->marca }}</small>
                                @endif
                                <h3>{{ $servico->titulo }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
                <a class="home-more" href="/site/servicos">Ver todos os serviços</a>
            </div>
        </section>
    @endif

    <section class="home-section" style="background:var(--soft);">
        <div class="home-wrap">
            <h2>Lojas</h2>
            <div class="home-stores">
                @foreach($lojas as $loja)
                    <a class="home-store" href="{{ url('/lojas/' . $loja['slug']) }}">
                        <img src="{{ asset($loja['imagem']) }}" alt="{{ $loja['nome_completo'] }}">
                        <div>
                            <h3>{{ $loja['nome'] }}</h3>
                            <p>{{ $loja['endereco'] }}</p>
                            <p>{{ $loja['horario_resumo'] }}</p>
                            <p>{{ $loja['telefone'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <a class="home-more" href="/lojas">Ver endereços e como chegar</a>
        </div>
    </section>

    @php
        $parceiros = [
            ['blukit.png', 'Blukit'],
            ['bosch.png', 'Bosch'],
            ['censi.png', 'Censi'],
            ['dewalt.png', 'DeWalt'],
            ['docol.png', 'Docol'],
            ['exatron.png', 'Exatron'],
            ['hydra.png', 'Hydra'],
            ['imperatriz.png', 'Imperatriz'],
            ['legrand.png', 'Legrand'],
            ['Lorenzetti.png', 'Lorenzetti'],
            ['osram.png', 'OSRAM'],
            ['pado.png', 'Pado'],
            ['siemens.png', 'Siemens'],
            ['sil.png', 'SIL'],
            ['stam.png', 'Stam'],
            ['taschibra.png', 'Taschibra'],
            ['tramontina.png', 'Tramontina'],
            ['tigre.png', 'Tigre'],
        ];
    @endphp
    <section class="home-partners" aria-label="Parceiros">
        <h2>Parceiros</h2>
        <div class="home-marquee">
            <div class="home-marquee-track">
                @foreach([false, true] as $copia)
                    @foreach($parceiros as [$arquivo, $nome])
                        <img class="{{ $copia ? 'home-marquee-copy' : '' }}" src="{{ asset('img/parceiros/' . $arquivo) }}" alt="{{ $nome }}">
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.home-slide');
    const dots = document.querySelectorAll('.home-dots button');
    if (slides.length < 2) return;
    let current = 0;
    function show(index) {
        current = (index + slides.length) % slides.length;
        slides.forEach(function (slide, i) { slide.classList.toggle('is-on', i === current); });
        dots.forEach(function (dot, i) { dot.classList.toggle('is-on', i === current); });
    }
    dots.forEach(function (dot, i) { dot.addEventListener('click', function () { show(i); }); });
    document.querySelector('.home-arrow.prev')?.addEventListener('click', function () { show(current - 1); });
    document.querySelector('.home-arrow.next')?.addEventListener('click', function () { show(current + 1); });
    setInterval(function () { show(current + 1); }, 5000);
});
</script>
@endpush
