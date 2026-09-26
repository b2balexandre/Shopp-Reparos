<style>
    .sr-footer {
        background: #fff;
        color: #10233f;
        border-top: 1px solid rgba(16, 35, 63, .08);
        width: 100%;
        max-width: 100%;
    }
    .sr-foot, .sr-foot-bar {
        width: min(1120px, calc(100% - 1.5rem));
        margin-inline: auto;
    }
    .sr-foot {
        display: grid;
        gap: 1.5rem;
        padding: 1.75rem 0 1.25rem;
    }
    .sr-foot-brand img {
        height: 2rem;
        width: auto;
        display: block;
    }
    .sr-foot-brand p {
        margin: .7rem 0 0;
        max-width: 22rem;
        color: #5b6b82;
        font-size: .92rem;
        line-height: 1.5;
    }
    .sr-foot-social {
        display: flex;
        gap: .4rem;
        margin-top: .9rem;
    }
    .sr-foot-social a {
        width: 2.25rem;
        height: 2.25rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        color: #0b3a82;
        background: #f4f7fb;
        text-decoration: none;
    }
    .sr-foot-social a:hover { background: #e7eef8; }
    .sr-foot-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem 1rem;
    }
    .sr-foot h2 {
        margin: 0 0 .55rem;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: #5b6b82;
    }
    .sr-foot-grid a, .sr-foot-stores a {
        display: block;
        padding: .28rem 0;
        color: #10233f;
        text-decoration: none;
        font-size: .92rem;
        font-weight: 600;
    }
    .sr-foot-grid a:hover, .sr-foot-stores a:hover { color: #0b3a82; }
    .sr-foot-stores { grid-column: 1 / -1; }
    .sr-foot-stores a span {
        display: block;
        margin-top: .1rem;
        color: #5b6b82;
        font-size: .8rem;
        font-weight: 500;
    }
    .sr-foot-stores a + a { margin-top: .45rem; }
    .sr-foot-hours {
        margin: .7rem 0 0;
        color: #5b6b82;
        font-size: .8rem;
    }
    .sr-foot-bar {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: .2rem;
        padding: .9rem 0 4.75rem;
        border-top: 1px solid rgba(16, 35, 63, .08);
        color: #5b6b82;
        font-size: .8rem;
    }
    .sr-foot-bar p { margin: 0; }
    @media (min-width: 800px) {
        .sr-foot {
            grid-template-columns: 1.1fr 1.6fr;
            gap: 2rem;
            padding: 2.5rem 0 1.5rem;
            align-items: start;
        }
        .sr-foot-grid { grid-template-columns: 1fr 1fr 1.3fr; }
        .sr-foot-stores { grid-column: auto; }
        .sr-foot-bar {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1.25rem;
        }
    }
</style>

@php $lojas = config('lojas'); @endphp
<footer class="sr-footer">
    <div class="sr-foot">
        <div class="sr-foot-brand">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logohorizontal.png') }}" alt="Shopp Reparos">
            </a>
            <p>Ferragens, hidráulica e reparos em Águas Claras e Taguatinga.</p>
            <div class="sr-foot-social">
                <a href="https://instagram.com/shoppreparos" target="_blank" rel="noopener" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Olá! Vim pelo site!" target="_blank" rel="noopener" aria-label="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>

        <div class="sr-foot-grid">
            <div>
                <h2>Páginas</h2>
                <a href="{{ route('home') }}">Home</a>
                <a href="/site/produtos">Produtos</a>
                <a href="/site/servicos">Serviços</a>
                <a href="{{ route('blog.index') }}">Blog</a>
                <a href="/contato">Contato</a>
            </div>
            <div>
                <h2>Serviços</h2>
                <a href="/reparos-hidraulicos">Reparos hidráulicos</a>
                <a href="/assistencia-tecnica">Assistência técnica</a>
                <a href="/site/servicos">Instalações elétricas</a>
                <a href="/lojas">Nossas lojas</a>
            </div>
            <div class="sr-foot-stores">
                <h2>Lojas</h2>
                @foreach($lojas as $loja)
                    <a href="{{ url('/lojas/' . $loja['slug']) }}">
                        {{ $loja['nome'] }}
                        <span>{{ $loja['endereco'] }}</span>
                        <span>{{ $loja['telefone'] }}</span>
                    </a>
                @endforeach
                <p class="sr-foot-hours">Seg a sex, 8h às 18h · Sáb, 8h às 14h</p>
            </div>
        </div>
    </div>
    <div class="sr-foot-bar">
        <p>&copy; {{ date('Y') }} Shopp Reparos</p>
        <p>Brasília — DF</p>
    </div>
</footer>
