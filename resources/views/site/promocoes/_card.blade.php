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
    </div>

    <div class="promo-body">
        @if($promo->selo || $urgencia)
            <div class="promo-tags">
                @if($promo->selo)<span class="promo-selo">{{ $promo->selo }}</span>@endif
                @if($urgencia)<span class="promo-urgente"><i class="fas fa-clock"></i> {{ $urgencia }}</span>@endif
            </div>
        @endif

        <h3 class="promo-titulo">{{ $promo->titulo }}</h3>

        @if($promo->descricao)
            <p class="promo-desc">{{ $promo->descricao }}</p>
        @endif

        @if($precoPrincipal)
            <div class="promo-preco">
                @if($temDe)
                    <s>De {{ \App\Models\Promocao::formatarPreco($promo->preco_de) }}</s>
                @endif
                <strong><span>{{ $temDe ? 'Por' : '' }}</span> {{ \App\Models\Promocao::formatarPreco($precoPrincipal) }}</strong>
                @if($temDe)
                    <em>Economize {{ \App\Models\Promocao::formatarPreco($promo->preco_de - $promo->preco_por) }}</em>
                @endif
            </div>
        @endif

        <ul class="promo-info">
            <li><i class="fas fa-location-dot"></i> {{ collect($lojasPromo)->pluck('nome')->implode(' e ') }}</li>
            <li>
                <i class="far fa-calendar"></i>
                @if($promo->termina_em)
                    Válida até {{ $promo->termina_em->format('d/m') }}
                @else
                    Enquanto durar o estoque
                @endif
            </li>
        </ul>

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
            @if($linkProduto)
                <a class="promo-link" href="{{ $linkProduto }}">Ver produto</a>
            @endif
        </div>
    </div>
</article>
