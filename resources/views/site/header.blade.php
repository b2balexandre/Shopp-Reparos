<header class="topo">
    <button class="menu-mobile only-mobile">☰</button>
    <div class="logo">
        <img src="{{ asset('img/logohorizontal.png') }}" alt="SHOPP REPAROS">
    </div>
    <div class="icones">
        <!-- WhatsApp -->
        <span class="icone whatsapp">
            <img src="{{ asset('img/whatsapp.svg') }}" alt="">
            <div class="dropdown-info">
                <img src="{{ asset('img/logohorizontal.png') }}" class="logo" alt="Logo">
                <p>Atendimento rápido e direto no WhatsApp!</p>
                <a href="https://api.whatsapp.com/send?phone=%205561996096296&text=Ol%C3%A1+vim+pelo+site+%21" class="whatsapp-btn" target="_blank"> Águas Claras</a>
                <a href="https://api.whatsapp.com/send?phone=5561999318077&text=Ol%C3%A1+%21+Vim+pelo+site." class="whatsapp-btn" target="_blank">Taguatinga</a>
            </div>
        </span>
        <!-- Blog -->
        <span class="icone blog">
            <a href="{{ route('blog.index') }}" title="Blog - Dicas e Soluções">
                <img src="{{ asset('img/blog.svg') }}" alt="Blog">
            </a>
            <div class="dropdown-info">
                <img src="{{ asset('img/logohorizontal.png') }}" class="logo" alt="Logo">
                <p>Descubra dicas práticas e soluções para seus reparos!</p>
                <a href="{{ route('blog.index') }}" class="blog-btn">Acessar Blog</a>
            </div>
        </span>
        <!-- Localização -->
        <span class="icone local">
            <img src="{{ asset('img/location.svg') }}" alt="">
            <div class="dropdown-info">
                <iframe src="https://www.google.com/maps?q=Q%20204%20Alfa%20Mix%20Loja%2015A%2C%20%C3%81guas%20Claras%2C%20Bras%C3%ADlia%20-%20DF%2C%2071939-540&output=embed" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <p><strong>Águas Claras:</strong><br>Q 204 Alfa Mix Loja 15A - Águas Claras, Brasília</p>
                <iframe src="https://www.google.com/maps?q=St.%20E%20Sul%20CSE%202%20-%20Taguatinga%20Sul%2C%20Bras%C3%ADlia%20-%20DF%2C%2072025-025&output=embed" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <p><strong>Taguatinga:</strong><br>St. E Sul CSE 2 - Taguatinga Sul, Brasília</p>
            </div>
        </span>
    </div>
</header>
<nav class="menu">
    <a href="/">HOME</a>
    <a href="#">LOJAS</a>
    <a href="/reparos-hidraulicos">REPAROS HIDRÁULICOS</a>
    <a href="/site/produtos">PRODUTOS</a>
    <a href="/site/servicos">SERVIÇOS</a>
    <a href="#">ASSISTÊNCIA TÉCNICA</a>
</nav>
