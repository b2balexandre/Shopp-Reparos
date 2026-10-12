@php
    $lojasPromo = $promo->lojas();
    $dias = $promo->dias_restantes;
    $urgencia = match (true) {
        $dias === 0 => 'Último dia',
        $dias === 1 => 'Termina amanhã',
        $dias !== null && $dias <= 3 => "Termina em {$dias} dias",
        default => null,
    };
    $precoPrincipal = $promo->preco_por ?? $promo->preco_de;
    $temDe = $promo->preco_por && $promo->preco_de && $promo->desconto;
    $linkProduto = $promo->produto ? '/site/produtos/' . $promo->produto->id . '-' . $promo->produto->slug : null;
    $meta = array_filter([
        count($lojasPromo) === 1 ? 'Só em ' . $lojasPromo[0]['nome'] : null,
        ! $urgencia && $promo->termina_em ? 'Até ' . $promo->termina_em->format('d/m') : null,
    ]);
@endphp
<article class="promo {{ $destaque ? 'promo--destaque' : '' }}"
         id="promo-{{ $promo->id }}"
         style="--i: {{ min($indice, 8) }}"
         data-lojas="{{ collect($lojasPromo)->pluck('slug')->implode(' ') }}"
         data-acabando="{{ $urgencia ? 1 : 0 }}">
    <div class="promo-media {{ $promo->imagem_propria ? 'is-arte' : '' }}">
        @if($promo->imagem_url)
            <img src="{{ $promo->imagem_url }}" alt="{{ $promo->titulo }}" loading="{{ $destaque ? 'eager' : 'lazy' }}" decoding="async">
        @else
            <span class="promo-ph" aria-hidden="true"><i class="fas fa-tags"></i></span>
        @endif
        @if($promo->desconto)
            <span class="promo-off">-{{ $promo->desconto }}%</span>
        @endif
        <button type="button" class="promo-share" data-url="{{ route('promocoes.index') }}#promo-{{ $promo->id }}" data-titulo="{{ $promo->titulo }}" aria-label="Compartilhar promoção">
            <i class="fas fa-share-nodes"></i>
        </button>
        @if($promo->selo || $urgencia)
            <div class="promo-tags">
                @if($urgencia)<span class="promo-urgente"><i class="fas fa-clock"></i> {{ $urgencia }}</span>@endif
                @if($promo->selo)<span class="promo-selo">{{ $promo->selo }}</span>@endif
            </div>
        @endif
    </div>

    <div class="promo-body">

        <h3 class="promo-titulo">
            @if($linkProduto)
                <a href="{{ $linkProduto }}">{{ $promo->titulo }}</a>
            @else
                {{ $promo->titulo }}
            @endif
        </h3>

        @if($destaque && $promo->descricao)
            <p class="promo-desc">{{ $promo->descricao }}</p>
        @endif

        @if($precoPrincipal)
            <div class="promo-preco">
                @if($temDe)
                    <s>{{ \App\Models\Promocao::formatarPreco($promo->preco_de) }}</s>
                @endif
                <div class="promo-preco-linha">
                    <strong>{{ \App\Models\Promocao::formatarPreco($precoPrincipal) }}</strong>
                    @if($temDe)<em>{{ $promo->desconto }}% OFF</em>@endif
                </div>
                @if($destaque && $temDe)
                    <span class="promo-economia">Economize {{ \App\Models\Promocao::formatarPreco($promo->preco_de - $promo->preco_por) }}</span>
                @endif
            </div>
        @endif

        @if($meta)
            <p class="promo-meta"><i class="{{ count($lojasPromo) === 1 ? 'fas fa-location-dot' : 'far fa-calendar' }}"></i> {{ implode(' · ', $meta) }}</p>
        @endif

        <div class="promo-acoes">
            @if(count($lojasPromo) === 1)
                <a class="promo-btn" href="{{ $promo->whatsappUrl($lojasPromo[0]) }}" target="_blank" rel="noopener">
                    <i class="fab fa-whatsapp"></i> Quero essa oferta
                </a>
            @else
                <details class="promo-escolha">
                    <summary class="promo-btn"><i class="fab fa-whatsapp"></i> Quero essa oferta</summary>
                    <div class="promo-escolha-lista">
                        <p>Escolha a loja</p>
                        @foreach($lojasPromo as $loja)
                            <a href="{{ $promo->whatsappUrl($loja) }}" target="_blank" rel="noopener">
                                <strong>{{ $loja['nome'] }}</strong>
                                <span>{{ $loja['telefone'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </details>
            @endif
        </div>
    </div>
</article>
