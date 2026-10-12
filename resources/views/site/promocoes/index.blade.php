@extends('layouts.site')

@section('title', 'Promoções e ofertas | Shopp Reparos Águas Claras e Taguatinga')
@section('description', 'Ofertas da Shopp Reparos em ferragens, hidráulica, elétrica e ferramentas. Preços especiais nas lojas de Águas Claras e Taguatinga, com pedido direto pelo WhatsApp.')
@section('keywords', 'promoção ferragens brasília, ofertas hidráulica águas claras, promoção material elétrico taguatinga, shopp reparos ofertas')

@php
    $todas = $destaques->concat($paineis)->concat($promocoes);
    $contar = fn (string $slug) => $todas->filter(fn ($p) => collect($p->lojas())->contains('slug', $slug))->count();
    $acabando = $todas->filter(fn ($p) => $p->dias_restantes !== null && $p->dias_restantes <= 3)->count();
    $whatsappPadrao = config('lojas.aguas-claras.whatsapp');
@endphp

@push('styles')
<style>
    .promos {
        --azul: #0b3a82;
        --azul-escuro: #072a5e;
        --tinta: #10233f;
        --suave: #5b6b82;
        --linha: rgba(16, 35, 63, .1);
        --amarelo: #f5c518;
        --verde: #16a34a;
        --urgente: #e11d48;
        color: var(--tinta);
        overflow-x: clip;
    }
    .promos-shell {
        width: min(1120px, calc(100% - 2rem));
        margin-inline: auto;
    }

    .promos-hero {
        position: relative;
        overflow: hidden;
        color: #fff;
        padding: 1.9rem 0 2.1rem;
        background:
            radial-gradient(110% 140% at 100% 0%, rgba(56, 132, 255, .55) 0%, transparent 55%),
            linear-gradient(135deg, #061f47 0%, #0b3a82 100%);
    }
    .promos-hero::after {
        content: "%";
        position: absolute;
        right: -1.5rem;
        bottom: -4.5rem;
        font: 800 15rem/1 Poppins, sans-serif;
        color: var(--amarelo);
        opacity: .12;
        transform: rotate(-12deg);
        pointer-events: none;
    }
    .promos-hero .promos-kicker {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        margin: 0;
        font-size: .74rem;
        font-weight: 800;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--amarelo);
    }
    .promos-kicker::before {
        content: "";
        width: 1.4rem;
        height: 2px;
        background: currentColor;
    }
    .promos-hero h1 {
        margin: .6rem 0 .5rem;
        max-width: 40rem;
        font: 800 clamp(1.75rem, 5.2vw, 2.9rem)/1.1 Poppins, sans-serif;
        letter-spacing: -.02em;
    }
    .promos-hero p {
        margin: 0;
        max-width: 34rem;
        color: rgba(255, 255, 255, .82);
        font-size: 1rem;
        line-height: 1.55;
    }
    .promos-resumo {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-top: 1.1rem;
    }
    .promos-resumo span {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .42rem .8rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, .16);
        font-size: .83rem;
        font-weight: 600;
    }
    .promos-resumo span:first-child {
        background: var(--amarelo);
        border-color: var(--amarelo);
        color: #1b1b1b;
        font-weight: 800;
    }

    .promos-filtros {
        position: sticky;
        top: calc(4.25rem + 1px);
        z-index: 30;
        background: rgba(255, 255, 255, .92);
        backdrop-filter: saturate(160%) blur(10px);
        -webkit-backdrop-filter: saturate(160%) blur(10px);
        border-bottom: 1px solid var(--linha);
    }
    .promos-filtros .promos-shell {
        display: flex;
        gap: .5rem;
        overflow-x: auto;
        padding: .7rem 0;
        scrollbar-width: none;
    }
    .promos-filtros .promos-shell::-webkit-scrollbar { display: none; }
    .promos-chip {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        min-height: 2.5rem;
        padding: 0 .95rem;
        border: 1px solid var(--linha);
        border-radius: 999px;
        background: #fff;
        color: var(--tinta);
        font-size: .86rem;
        font-weight: 700;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
    }
    .promos-chip small {
        min-width: 1.35rem;
        padding: 0 .35rem;
        border-radius: 999px;
        background: #eef3fa;
        color: var(--azul);
        font-size: .72rem;
        line-height: 1.35rem;
        text-align: center;
    }
    .promos-chip:hover { border-color: var(--azul); }
    .promos-chip.is-ativo {
        background: var(--azul);
        border-color: var(--azul);
        color: #fff;
    }
    .promos-chip.is-ativo small { background: rgba(255, 255, 255, .18); color: #fff; }
    .promos-chip--urgente i { color: var(--urgente); }
    .promos-chip--urgente.is-ativo { background: var(--urgente); border-color: var(--urgente); }
    .promos-chip--urgente.is-ativo i { color: #fff; }

    .promo[hidden], .promos-secao[hidden] { display: none; }
    .promos-secao { padding: 1.6rem 0 .4rem; }
    .promos-secao h2 {
        display: flex;
        align-items: center;
        gap: .55rem;
        margin: 0 0 .9rem;
        font: 700 1.15rem/1.2 Poppins, sans-serif;
        color: var(--azul-escuro);
    }
    .promos-secao h2 i { color: var(--amarelo); }

    .promos-destaques {
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: 88%;
        gap: 1rem;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        padding-bottom: .75rem;
        scrollbar-width: none;
    }
    .promos-destaques::-webkit-scrollbar { display: none; }
    .promos-destaques.is-unico { grid-auto-columns: 100%; }
    .promos-destaques > .promo { scroll-snap-align: start; }

    .promos-grade {
        display: grid;
        grid-template-columns: minmax(0, 1fr);
        gap: .85rem;
    }

    .promo {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        background: #fff;
        border: 1px solid var(--linha);
        border-radius: 18px;
        box-shadow: 0 1px 2px rgba(16, 35, 63, .04);
        scroll-margin-top: 9rem;
        transition: transform .2s ease, box-shadow .2s ease;
        animation: promo-entra .5s ease backwards;
        animation-delay: calc(var(--i, 0) * 60ms);
    }
    .promo:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px -22px rgba(11, 58, 130, .45);
    }
    .promo:target {
        box-shadow: 0 0 0 3px var(--amarelo), 0 20px 40px -22px rgba(11, 58, 130, .45);
    }
    .promo--destaque {
        border-color: rgba(245, 197, 24, .6);
        box-shadow: 0 22px 45px -28px rgba(11, 58, 130, .55);
    }
    @keyframes promo-entra {
        from { opacity: 0; transform: translateY(14px); }
    }

    .promo-media {
        position: relative;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        border-radius: 17px 17px 0 0;
        background: linear-gradient(180deg, #f5f8fd 0%, #e8eff9 100%);
    }
    .promo--destaque .promo-media { aspect-ratio: 16 / 10; }
    .promo-media img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 1rem;
        transition: transform .4s ease;
    }
    .promo-media.is-arte img { object-fit: cover; padding: 0; }
    .promo:hover .promo-media img { transform: scale(1.04); }
    .promo-ph {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #a9bcd6;
        font-size: 2.4rem;
    }
    .promo-off {
        position: absolute;
        top: .75rem;
        left: .75rem;
        padding: .28rem .6rem;
        border-radius: 10px;
        background: var(--amarelo);
        color: #1b1b1b;
        font: 800 1rem/1.2 Poppins, sans-serif;
        box-shadow: 0 6px 16px -6px rgba(0, 0, 0, .35);
    }
    .promo-share {
        position: absolute;
        top: .6rem;
        right: .6rem;
        width: 2.4rem;
        height: 2.4rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 999px;
        background: rgba(255, 255, 255, .94);
        color: var(--tinta);
        box-shadow: 0 4px 12px -4px rgba(16, 35, 63, .35);
        cursor: pointer;
    }
    .promo-share:hover { color: var(--azul); }

    .promo-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: .55rem;
        min-width: 0;
        padding: 1rem 1.1rem 1.1rem;
    }
    .promo-tags { display: flex; flex-wrap: wrap; gap: .35rem; }
    .promo-selo,
    .promo-urgente {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .22rem .55rem;
        border-radius: 999px;
        font-size: .7rem;
        font-weight: 800;
        letter-spacing: .05em;
        text-transform: uppercase;
    }
    .promo-selo { background: #eef3fa; color: var(--azul); }
    .promo-urgente { background: #fff1f2; color: var(--urgente); }
    .promo-titulo {
        margin: 0;
        font: 700 1.05rem/1.3 Poppins, sans-serif;
        color: var(--tinta);
        overflow-wrap: anywhere;
    }
    .promo-desc {
        margin: 0;
        color: var(--suave);
        font-size: .9rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .promo-preco { display: flex; flex-direction: column; gap: .1rem; }
    .promo-preco s { color: var(--suave); font-size: .85rem; }
    .promo-preco strong {
        font: 800 1.6rem/1.1 Poppins, sans-serif;
        letter-spacing: -.02em;
        color: var(--azul-escuro);
    }
    .promo-preco strong span { font-size: .85rem; font-weight: 600; color: var(--suave); letter-spacing: 0; }
    .promo-preco em { font-style: normal; font-size: .82rem; font-weight: 700; color: var(--verde); }
    .promo-info {
        display: grid;
        gap: .2rem;
        margin: 0;
        padding: 0;
        list-style: none;
        color: var(--suave);
        font-size: .82rem;
    }
    .promo-info i { width: 1rem; color: var(--azul); text-align: center; }

    .promo-acoes {
        display: flex;
        flex-direction: column;
        gap: .55rem;
        margin-top: auto;
        padding-top: .35rem;
    }
    .promo-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        min-height: 2.9rem;
        padding: 0 1rem;
        border-radius: 12px;
        background: var(--verde);
        color: #fff;
        font-weight: 700;
        font-size: .95rem;
        text-decoration: none;
        list-style: none;
        cursor: pointer;
        user-select: none;
        transition: background .15s;
    }
    .promo-btn::-webkit-details-marker { display: none; }
    .promo-btn:hover { background: #15803d; color: #fff; }
    .promo-btn i { font-size: 1.15rem; }
    .promo-escolha { position: relative; }
    .promo-escolha-lista {
        position: absolute;
        left: 0;
        right: 0;
        bottom: calc(100% + .5rem);
        z-index: 5;
        padding: .4rem;
        background: #fff;
        border: 1px solid var(--linha);
        border-radius: 14px;
        box-shadow: 0 20px 40px -14px rgba(16, 35, 63, .35);
    }
    .promo-escolha-lista p {
        margin: .2rem .55rem .35rem;
        font-size: .7rem;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--suave);
    }
    .promo-escolha-lista a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .5rem;
        padding: .7rem .65rem;
        border-radius: 10px;
        color: var(--tinta);
        text-decoration: none;
        font-size: .9rem;
    }
    .promo-escolha-lista a:hover { background: #f0fdf4; }
    .promo-escolha-lista span { color: var(--suave); font-size: .8rem; white-space: nowrap; }
    .promo-link {
        align-self: center;
        color: var(--azul);
        font-size: .85rem;
        font-weight: 700;
        text-decoration: none;
    }
    .promo-link:hover { text-decoration: underline; }

    .promos-paineis {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .75rem;
    }
    .promo-painel {
        position: relative;
        overflow: hidden;
        border-radius: 17px 17px 0 0;
        background: linear-gradient(180deg, #f5f8fd 0%, #e8eff9 100%);
    }
    .promo-painel-abrir {
        display: block;
        width: 100%;
        aspect-ratio: 4 / 5;
        padding: 0;
        border: 0;
        background: transparent;
        cursor: zoom-in;
    }
    .promo-painel-abrir img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform .4s ease;
    }
    .promo--painel:hover .promo-painel-abrir img { transform: scale(1.03); }
    .promo-painel-lupa {
        position: absolute;
        left: .6rem;
        bottom: .6rem;
        width: 2.2rem;
        height: 2.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        background: rgba(16, 35, 63, .75);
        color: #fff;
        font-size: .9rem;
    }
    .promo--painel .promo-body { padding: .75rem .8rem .85rem; gap: .6rem; }
    .promo-painel-validade {
        margin: 0;
        color: var(--suave);
        font-size: .8rem;
        font-weight: 600;
        line-height: 1.4;
    }
    .promo-painel-validade i { margin-right: .2rem; color: var(--azul); }
    .promo-painel-validade span { font-weight: 500; }
    .promo-painel-validade.is-urgente,
    .promo-painel-validade.is-urgente i { color: var(--urgente); }
    .promos-paineis .promo-btn { min-height: 2.6rem; padding: 0 .5rem; gap: .4rem; font-size: .86rem; }
    .promos-paineis .promo-escolha-lista a { flex-direction: column; align-items: flex-start; gap: .1rem; }

    .promos-zoom {
        max-width: min(92vw, 900px) !important;
        max-height: none;
        padding: 0;
        border: 0;
        background: transparent;
        overflow: visible;
    }
    .promos-zoom::backdrop { background: rgba(6, 18, 40, .88); }
    .promos-zoom img {
        display: block;
        max-width: 100%;
        max-height: 88vh;
        border-radius: 12px;
        background: #fff;
    }
    .promos-zoom-fechar {
        position: absolute;
        top: -.8rem;
        right: -.8rem;
        z-index: 1;
        width: 2.6rem;
        height: 2.6rem;
        border: 0;
        border-radius: 999px;
        background: #fff;
        color: var(--tinta);
        font-size: 1.1rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, .3);
        cursor: pointer;
    }

    .promos-sem-resultado {
        display: none;
        padding: 2.5rem 0 1rem;
        text-align: center;
        color: var(--suave);
    }
    .promos-sem-resultado.is-visivel { display: block; }

    .promos-vazio {
        max-width: 32rem;
        margin: 2.5rem auto 1rem;
        padding: 2rem 1.5rem;
        text-align: center;
        background: #fff;
        border: 1px solid var(--linha);
        border-radius: 20px;
    }
    .promos-vazio-icone {
        width: 4rem;
        height: 4rem;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        background: #fff8db;
        color: #b58900;
        font-size: 1.6rem;
    }
    .promos-vazio h2 { margin: 0 0 .4rem; font: 700 1.25rem/1.25 Poppins, sans-serif; color: var(--azul-escuro); }
    .promos-vazio p { margin: 0 0 1.25rem; color: var(--suave); line-height: 1.55; }
    .promos-vazio-acoes { display: flex; flex-wrap: wrap; gap: .6rem; justify-content: center; }
    .promos-vazio-acoes a {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        min-height: 2.75rem;
        padding: 0 1.1rem;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid var(--linha);
        color: var(--azul);
    }
    .promos-vazio-acoes a:first-child { background: var(--verde); border-color: var(--verde); color: #fff; }

    .promos-nota {
        display: flex;
        gap: .55rem;
        margin: 1.75rem 0 1rem;
        color: var(--suave);
        font-size: .8rem;
        line-height: 1.5;
    }
    .promos-nota i { margin-top: .2rem; color: var(--azul); }

    .promos-toast {
        position: fixed;
        left: 50%;
        bottom: 1.5rem;
        z-index: 60;
        padding: .7rem 1.1rem;
        border-radius: 999px;
        background: var(--tinta);
        color: #fff;
        font-size: .88rem;
        font-weight: 600;
        opacity: 0;
        pointer-events: none;
        transform: translate(-50%, 12px);
        transition: opacity .2s, transform .2s;
    }
    .promos-toast.is-visivel { opacity: 1; transform: translate(-50%, 0); }

    @media (max-width: 599px) {
        .promos-grade .promo { flex-direction: row; border-radius: 16px; }
        .promos-grade .promo-media {
            flex: 0 0 38%;
            aspect-ratio: auto;
            min-height: 11rem;
            border-radius: 15px 0 0 15px;
        }
        .promos-grade .promo-media img { position: absolute; inset: 0; padding: .55rem; }
        .promos-grade .promo-media.is-arte img { padding: 0; }
        .promos-grade .promo-off { top: .5rem; left: .5rem; font-size: .85rem; padding: .2rem .45rem; }
        .promos-grade .promo-share { top: auto; bottom: .5rem; right: .5rem; width: 2.15rem; height: 2.15rem; }
        .promos-grade .promo-body { padding: .8rem .85rem .9rem; gap: .4rem; }
        .promos-grade .promo-titulo { font-size: .98rem; }
        .promos-grade .promo-desc { -webkit-line-clamp: 2; font-size: .85rem; }
        .promos-grade .promo-preco strong { font-size: 1.3rem; }
        .promos-grade .promo-btn { min-height: 2.6rem; font-size: .88rem; padding: 0 .6rem; }
        .promos-grade .promo-escolha-lista { left: auto; width: min(14rem, 75vw); }
        .promos-grade .promo-escolha-lista a { flex-direction: column; align-items: flex-start; gap: .1rem; }
    }
    @media (min-width: 600px) {
        .promos-grade { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; }
    }
    @media (min-width: 900px) {
        .promos-hero { padding: 3rem 0 3.2rem; }
        .promos-hero::after { font-size: 22rem; bottom: -7rem; right: 2rem; }
        .promos-secao { padding-top: 2.2rem; }
        .promos-secao h2 { font-size: 1.35rem; }
        .promos-destaques {
            grid-auto-flow: row;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.25rem;
            overflow: visible;
        }
        .promos-destaques.is-unico { grid-template-columns: minmax(0, 1fr); }
        .promos-destaques.is-unico .promo { flex-direction: row; }
        .promos-destaques.is-unico .promo-media {
            flex: 0 0 50%;
            aspect-ratio: auto;
            min-height: 22rem;
            border-radius: 17px 0 0 17px;
        }
        .promos-destaques.is-unico .promo-media img { position: absolute; inset: 0; }
        .promo--destaque .promo-body { padding: 1.4rem 1.5rem 1.5rem; gap: .7rem; }
        .promo--destaque .promo-titulo { font-size: 1.35rem; }
        .promo--destaque .promo-preco strong { font-size: 2rem; }
        .promo--destaque .promo-desc { -webkit-line-clamp: 5; }
        .promos-grade { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.25rem; }
        .promos-paineis { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.25rem; }
        .promo--painel .promo-body { padding: .9rem 1rem 1rem; }
    }
    @media (min-width: 1180px) {
        .promos-filtros { top: calc(4.75rem + 1px); }
    }
    @media (prefers-reduced-motion: reduce) {
        .promo, .promo-media img, .promos-toast { animation: none; transition: none; }
        .promo:hover { transform: none; }
    }
</style>
@endpush

@section('content')
<div class="promos">
    <section class="promos-hero">
        <div class="promos-shell">
            <p class="promos-kicker">Ofertas Shopp Reparos</p>
            <h1>Promoções para sua obra e manutenção</h1>
            <p>Preços especiais em ferragens, hidráulica e elétrica nas nossas lojas de Águas Claras e Taguatinga. Escolha a oferta e peça direto pelo WhatsApp.</p>
            <div class="promos-resumo">
                <span><i class="fas fa-tags"></i> {{ $total }} {{ $total === 1 ? 'oferta no ar' : 'ofertas no ar' }}</span>
                <span><i class="fas fa-store"></i> Águas Claras e Taguatinga</span>
            </div>
        </div>
    </section>

    @if($total === 0)
        <div class="promos-shell">
            <div class="promos-vazio">
                <div class="promos-vazio-icone"><i class="fas fa-tags"></i></div>
                <h2>Nenhuma promoção no ar agora</h2>
                <p>Estamos preparando novas ofertas. Enquanto isso, fale com a gente: sempre dá para conseguir uma condição especial na loja.</p>
                <div class="promos-vazio-acoes">
                    <a href="https://api.whatsapp.com/send?phone={{ $whatsappPadrao }}&text={{ rawurlencode('Olá! Vim pela página de promoções do site.') }}" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i> Falar no WhatsApp
                    </a>
                    <a href="/site/produtos"><i class="fas fa-box-open"></i> Ver produtos</a>
                </div>
            </div>
        </div>
    @else
        <nav class="promos-filtros" aria-label="Filtrar promoções">
            <div class="promos-shell">
                <button type="button" class="promos-chip is-ativo" data-filtro="">Todas <small>{{ $total }}</small></button>
                @foreach(config('lojas') as $loja)
                    @if($n = $contar($loja['slug']))
                        <button type="button" class="promos-chip" data-filtro="{{ $loja['slug'] }}">{{ $loja['nome'] }} <small>{{ $n }}</small></button>
                    @endif
                @endforeach
                @if($acabando)
                    <button type="button" class="promos-chip promos-chip--urgente" data-filtro="acabando"><i class="fas fa-clock"></i> Acabando <small>{{ $acabando }}</small></button>
                @endif
            </div>
        </nav>

        <div class="promos-shell">
            @if($destaques->isNotEmpty())
                <section class="promos-secao" aria-labelledby="titulo-destaques">
                    <h2 id="titulo-destaques"><i class="fas fa-star"></i> Ofertas em destaque</h2>
                    <div class="promos-destaques {{ $destaques->count() === 1 ? 'is-unico' : '' }}">
                        @foreach($destaques as $promo)
                            @include('site.promocoes._card', ['promo' => $promo, 'destaque' => true, 'indice' => $loop->index])
                        @endforeach
                    </div>
                </section>
            @endif

            @if($paineis->isNotEmpty())
                <section class="promos-secao" aria-labelledby="titulo-paineis">
                    <h2 id="titulo-paineis"><i class="fas fa-newspaper"></i> Panfletos de ofertas</h2>
                    <div class="promos-paineis">
                        @foreach($paineis as $promo)
                            @include('site.promocoes._painel', ['promo' => $promo, 'indice' => $loop->index])
                        @endforeach
                    </div>
                </section>
            @endif

            @if($promocoes->isNotEmpty())
                <section class="promos-secao" aria-labelledby="titulo-ofertas">
                    <h2 id="titulo-ofertas"><i class="fas fa-bolt"></i> {{ $destaques->isNotEmpty() || $paineis->isNotEmpty() ? 'Mais ofertas' : 'Todas as ofertas' }}</h2>
                    <div class="promos-grade">
                        @foreach($promocoes as $promo)
                            @include('site.promocoes._card', ['promo' => $promo, 'destaque' => false, 'indice' => $loop->index])
                        @endforeach
                    </div>
                </section>
            @endif

            <p id="promos-sem-resultado" class="promos-sem-resultado">Nenhuma promoção com esse filtro.</p>

            <p class="promos-nota">
                <i class="fas fa-circle-info"></i>
                <span>Ofertas válidas nas lojas físicas e pelo WhatsApp, dentro do período informado e enquanto durarem os estoques. Imagens ilustrativas.</span>
            </p>
        </div>
    @endif

    @if($paineis->isNotEmpty())
        <dialog id="promos-zoom" class="promos-zoom" aria-label="Panfleto ampliado">
            <button type="button" class="promos-zoom-fechar" aria-label="Fechar"><i class="fas fa-xmark"></i></button>
            <img src="" alt="Panfleto ampliado">
        </dialog>
    @endif

    <div id="promos-toast" class="promos-toast" role="status" aria-live="polite"></div>
</div>
@endsection

@if($total > 0)
@push('meta')
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'OfferCatalog',
        'name' => 'Promoções Shopp Reparos',
        'url' => route('promocoes.index'),
        'itemListElement' => $todas->map(fn ($promo) => array_filter([
            '@type' => 'Offer',
            'name' => $promo->titulo,
            'description' => $promo->descricao,
            'url' => route('promocoes.index') . '#promo-' . $promo->id,
            'image' => $promo->imagem_url,
            'price' => ($promo->preco_por ?? $promo->preco_de) ? number_format((float) ($promo->preco_por ?? $promo->preco_de), 2, '.', '') : null,
            'priceCurrency' => ($promo->preco_por ?? $promo->preco_de) ? 'BRL' : null,
            'priceValidUntil' => $promo->termina_em?->toDateString(),
            'availability' => 'https://schema.org/InStock',
            'seller' => ['@type' => 'LocalBusiness', 'name' => 'Shopp Reparos'],
        ]))->values()->all(),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const chips = document.querySelectorAll('.promos-chip');
    const cards = document.querySelectorAll('.promo');
    const secoes = document.querySelectorAll('.promos-secao');
    const semResultado = document.getElementById('promos-sem-resultado');
    const toast = document.getElementById('promos-toast');
    let toastTimer;

    function filtrar(filtro) {
        cards.forEach(function (card) {
            const ok = !filtro
                || (filtro === 'acabando' ? card.dataset.acabando === '1' : card.dataset.lojas.split(' ').includes(filtro));
            card.hidden = !ok;
        });
        let algum = false;
        secoes.forEach(function (secao) {
            const visivel = secao.querySelector('.promo:not([hidden])') !== null;
            secao.hidden = !visivel;
            algum = algum || visivel;
        });
        semResultado.classList.toggle('is-visivel', !algum);
    }

    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            chips.forEach(function (c) { c.classList.toggle('is-ativo', c === chip); });
            filtrar(chip.dataset.filtro);
            const hero = document.querySelector('.promos-hero');
            const cabecalho = document.querySelector('.sr-header');
            const inicio = hero.offsetTop + hero.offsetHeight - (cabecalho ? cabecalho.offsetHeight : 0);
            if (window.scrollY > inicio) window.scrollTo({ top: inicio, behavior: 'smooth' });
        });
    });

    const escolhas = document.querySelectorAll('.promo-escolha');
    escolhas.forEach(function (item) {
        item.addEventListener('toggle', function () {
            if (item.open) escolhas.forEach(function (outro) { if (outro !== item) outro.open = false; });
        });
    });
    document.addEventListener('click', function (e) {
        escolhas.forEach(function (item) { if (!item.contains(e.target)) item.open = false; });
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') escolhas.forEach(function (item) { item.open = false; });
    });

    function avisar(texto) {
        toast.textContent = texto;
        toast.classList.add('is-visivel');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () { toast.classList.remove('is-visivel'); }, 2200);
    }

    const zoom = document.getElementById('promos-zoom');
    if (zoom) {
        const zoomImg = zoom.querySelector('img');
        document.querySelectorAll('.promo-painel-abrir').forEach(function (botao) {
            botao.addEventListener('click', function () {
                zoomImg.src = botao.dataset.zoom;
                zoom.showModal();
            });
        });
        zoom.querySelector('.promos-zoom-fechar').addEventListener('click', function () { zoom.close(); });
        zoom.addEventListener('click', function (e) { if (e.target === zoom) zoom.close(); });
    }

    document.querySelectorAll('.promo-share').forEach(function (botao) {
        botao.addEventListener('click', function () {
            const dados = { title: botao.dataset.titulo, text: 'Olha essa promoção da Shopp Reparos: ' + botao.dataset.titulo, url: botao.dataset.url };
            if (navigator.share) {
                navigator.share(dados).catch(function () {});
            } else if (navigator.clipboard) {
                navigator.clipboard.writeText(dados.url).then(function () { avisar('Link da promoção copiado'); });
            } else {
                window.prompt('Copie o link da promoção:', dados.url);
            }
        });
    });
});
</script>
@endpush
@endif
