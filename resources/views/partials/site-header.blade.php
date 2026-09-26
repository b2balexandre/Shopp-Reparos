<style>
    .sr-header {
        position: sticky;
        top: 0;
        z-index: 80;
        width: 100%;
        background: #fff;
        border-bottom: 1px solid rgba(16, 35, 63, .08);
    }
    .sr-bar {
        width: min(1120px, calc(100% - 1.25rem));
        margin: 0 auto;
        min-height: 4.25rem;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .sr-logo {
        position: relative;
        display: flex;
        align-items: center;
        flex: 0 0 auto;
        gap: .65rem;
        overflow: hidden;
        text-decoration: none;
        border-radius: 4px;
    }
    .sr-logo::after {
        content: "";
        position: absolute;
        inset: -20% -40%;
        background: linear-gradient(105deg, transparent 38%, rgba(255, 255, 255, .15) 46%, rgba(255, 255, 255, .85) 50%, rgba(255, 255, 255, .15) 54%, transparent 62%);
        transform: translateX(-130%);
        animation: sr-logo-sweep 4.2s ease-in-out infinite;
        pointer-events: none;
    }
    @keyframes sr-logo-sweep {
        0%, 58% { transform: translateX(-130%); }
        100% { transform: translateX(130%); }
    }
    @media (prefers-reduced-motion: reduce) {
        .sr-logo::after { animation: none; display: none; }
    }
    .sr-logo-mark,
    .sr-logo-name {
        display: block;
        object-fit: cover;
    }
    .sr-logo-mark {
        width: 2.55rem;
        height: 2.55rem;
        object-position: left center;
    }
    .sr-logo-name {
        height: 1.55rem;
        width: calc(1.55rem * 856 / 132);
        object-position: right center;
    }
    .sr-nav {
        display: none;
        align-items: center;
        gap: .1rem;
        min-width: 0;
        margin-left: .35rem;
    }
    .sr-nav a {
        color: #24344d;
        text-decoration: none;
        font-size: .82rem;
        font-weight: 600;
        letter-spacing: -.01em;
        padding: .45rem .55rem;
        border-radius: 999px;
        white-space: nowrap;
    }
    .sr-nav a:hover { background: #f4f7fb; color: #0b3a82; }
    .sr-nav a.is-on { color: #0b3a82; background: #eef3fa; }
    .sr-tools {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: .15rem;
        position: relative;
    }
    .sr-ghost, .sr-burger {
        width: 2.5rem;
        height: 2.5rem;
        border: 0;
        background: transparent;
        color: #10233f;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        text-decoration: none;
    }
    .sr-ghost:hover, .sr-burger:hover { background: #f4f7fb; }
    .sr-desk { display: none; }
    .sr-wa {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .4rem;
        width: 2.5rem;
        height: 2.5rem;
        padding: 0;
        border: 0;
        border-radius: 999px;
        background: transparent;
        color: #10233f;
        font-size: .82rem;
        font-weight: 700;
        cursor: pointer;
    }
    .sr-wa-label { display: none; }
    .sr-wa:hover { background: #f4f7fb; color: #10233f; }
    .sr-panel {
        position: absolute;
        top: calc(100% + .45rem);
        right: 0;
        width: min(18.5rem, calc(100vw - 1.25rem));
        background: #fff;
        border: 1px solid rgba(16, 35, 63, .08);
        border-radius: 14px;
        box-shadow: 0 16px 40px rgba(16, 35, 63, .12);
        padding: .35rem;
        z-index: 90;
    }
    .sr-panel a, .sr-panel button {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: .1rem;
        padding: .7rem .75rem;
        border: 0;
        border-radius: 10px;
        background: transparent;
        color: #10233f;
        text-decoration: none;
        text-align: left;
        cursor: pointer;
        font: inherit;
    }
    .sr-panel a:hover, .sr-panel button:hover { background: #f4f7fb; }
    .sr-panel strong { font-size: .88rem; }
    .sr-panel span { color: #5b6b82; font-size: .78rem; }
    .sr-account { position: relative; }
    .sr-account .sr-panel { display: none; }
    .sr-account:hover .sr-panel,
    .sr-account:focus-within .sr-panel { display: block; }
    .sr-menu {
        position: fixed;
        inset: 0;
        z-index: 120;
        background: rgba(16, 35, 63, .35);
    }
    .sr-menu.hidden { display: none; }
    .sr-drawer {
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        width: min(20rem, 88vw);
        background: #fff;
        display: flex;
        flex-direction: column;
        transform: translateX(100%);
        transition: transform .25s ease;
    }
    .sr-drawer.is-open { transform: translateX(0); }
    .sr-drawer-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1rem .5rem;
    }
    .sr-drawer-head strong { font-size: 1rem; color: #10233f; }
    .sr-drawer nav { padding: .25rem .6rem 1rem; overflow: auto; }
    .sr-drawer nav a {
        display: block;
        padding: .8rem .7rem;
        color: #10233f;
        text-decoration: none;
        font-weight: 600;
        border-radius: 10px;
    }
    .sr-drawer nav a.is-on,
    .sr-drawer nav a:hover { background: #f4f7fb; color: #0b3a82; }
    .sr-drawer-foot {
        margin-top: auto;
        padding: .85rem 1rem 1rem;
        border-top: 1px solid rgba(16, 35, 63, .08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .5rem;
    }
    .sr-drawer-foot p { margin: 0; font-size: .82rem; color: #10233f; font-weight: 700; }
    .sr-drawer-foot small { color: #5b6b82; }
    .sr-linkish {
        color: #0b3a82;
        font-weight: 700;
        font-size: .82rem;
        text-decoration: none;
        background: none;
        border: 0;
        cursor: pointer;
        padding: 0;
    }
    @media (min-width: 1180px) {
        .sr-bar { min-height: 4.75rem; }
        .sr-logo-mark { width: 2.9rem; height: 2.9rem; }
        .sr-logo-name {
            height: 1.8rem;
            width: calc(1.8rem * 856 / 132);
        }
        .sr-nav { display: flex; }
        .sr-desk { display: inline-flex; }
        .sr-burger { display: none; }
        .sr-wa {
            width: auto;
            height: 2.35rem;
            padding: 0 .95rem;
            background: #0b3a82;
            color: #fff;
        }
        .sr-wa-label { display: inline; }
        .sr-wa:hover { background: #072a5e; color: #fff; }
    }
    @media (max-width: 768px) {
        #whatsappDropdown,
        #locationDropdown {
            right: 0 !important;
            left: auto !important;
            transform: none !important;
            width: min(18.5rem, calc(100vw - 1.25rem)) !important;
        }
    }
</style>

@php
    $currentPath = trim(request()->path(), '/');
    $navOn = function (string $path) use ($currentPath) {
        $clean = trim($path, '/');
        if ($clean === '') {
            return $currentPath === '';
        }
        return $currentPath === $clean || str_starts_with($currentPath, $clean . '/');
    };
    $itens = [
        ['/', 'Home', 'Home'],
        ['/lojas', 'Lojas', 'Lojas'],
        ['/site/produtos', 'Produtos', 'Produtos'],
        ['/site/servicos', 'Serviços', 'Serviços'],
        ['/reparos-hidraulicos', 'Hidráulica', 'Reparos hidráulicos'],
        ['/assistencia-tecnica', 'Assistência', 'Assistência técnica'],
        ['/blog', 'Blog', 'Blog'],
        ['/contato', 'Contato', 'Contato'],
    ];
@endphp

<header class="sr-header">
    <div class="sr-bar">
        <a class="sr-logo" href="{{ route('home') }}" aria-label="Shopp Reparos">
            <img class="sr-logo-mark" src="{{ asset('img/logohorizontal.png') }}" alt="">
            <img class="sr-logo-name" src="{{ asset('img/logohorizontal.png') }}" alt="">
        </a>

        <nav class="sr-nav" aria-label="Principal">
            @foreach($itens as [$url, $curto, $longo])
                <a href="{{ $url }}" class="{{ $navOn($url) ? 'is-on' : '' }}">{{ $curto }}</a>
            @endforeach
        </nav>

        <div class="sr-tools">
            <button id="whatsappBtn" class="sr-wa" type="button" aria-label="WhatsApp">
                <i class="fab fa-whatsapp"></i>
                <span class="sr-wa-label">WhatsApp</span>
            </button>
            <button id="locationBtn" class="sr-ghost sr-desk" type="button" aria-label="Nossas lojas" title="Nossas lojas">
                <i class="fas fa-location-dot"></i>
            </button>

            <div class="sr-account sr-desk">
                <button class="sr-ghost" type="button" aria-label="Conta">
                    <i class="fas fa-user"></i>
                </button>
                <div class="sr-panel">
                    @guest
                        <a href="{{ route('login') }}"><strong>Entrar</strong><span>Acesse sua conta</span></a>
                        <a href="{{ route('register') }}"><strong>Criar conta</strong><span>Cadastro de cliente</span></a>
                    @else
                        <a href="{{ Auth::user()->perfil === 'admin' ? '/admin' : '/dashboard' }}">
                            <strong>{{ Auth::user()->name }}</strong>
                            <span>{{ Auth::user()->perfil === 'admin' ? 'Abrir painel' : 'Minha conta' }}</span>
                        </a>
                        <button type="button" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <strong>Sair</strong>
                        </button>
                    @endguest
                </div>
            </div>

            <button id="mobile-menu-toggle" class="sr-burger" type="button" aria-label="Abrir menu">
                <i class="fas fa-bars"></i>
            </button>

            <div id="whatsappDropdown" class="sr-panel hidden">
                <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Vim pelo site!">
                    <strong>Águas Claras</strong>
                    <span>(61) 99609-6296</span>
                </a>
                <a href="https://api.whatsapp.com/send?phone=5561999318077&text=Olá! Vim pelo site!">
                    <strong>Taguatinga</strong>
                    <span>(61) 99931-8077</span>
                </a>
            </div>
            <div id="locationDropdown" class="sr-panel hidden">
                <a href="{{ url('/lojas/aguas-claras') }}">
                    <strong>Águas Claras</strong>
                    <span>Q 204 Alfa Mix Loja 15A</span>
                </a>
                <a href="{{ url('/lojas/taguatinga') }}">
                    <strong>Taguatinga</strong>
                    <span>CSE 02 Loja 19</span>
                </a>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="sr-menu hidden">
        <div class="absolute sr-drawer">
            <div class="sr-drawer-head">
                <strong>Menu</strong>
                <button id="mobile-menu-close" class="sr-ghost" type="button" aria-label="Fechar menu">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav>
                @foreach($itens as [$url, $curto, $longo])
                    <a href="{{ $url }}" class="{{ $navOn($url) ? 'is-on' : '' }}">{{ $longo }}</a>
                @endforeach
            </nav>
            <div class="sr-drawer-foot">
                @guest
                    <p>Conta</p>
                    <a class="sr-linkish" href="{{ route('login') }}">Entrar</a>
                @else
                    <div>
                        <p>{{ Auth::user()->name }}</p>
                        <small>{{ Auth::user()->email }}</small>
                    </div>
                    <button class="sr-linkish" type="button" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sair</button>
                @endguest
            </div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
</header>
