@php
    $lojasPromo = $promo->lojas();
    $dias = $promo->dias_restantes;
    $urgencia = match (true) {
        $dias === 0 => 'Último dia',
        $dias === 1 => 'Termina amanhã',
        $dias !== null && $dias <= 3 => "Termina em {$dias} dias",
        default => null,
    };
@endphp
<article class="promo promo--painel"
         id="promo-{{ $promo->id }}"
         style="--i: {{ min($indice, 8) }}"
         data-lojas="{{ collect($lojasPromo)->pluck('slug')->implode(' ') }}"
         data-acabando="{{ $urgencia ? 1 : 0 }}">
    <div class="promo-painel">
        <button type="button" class="promo-painel-abrir" data-zoom="{{ $promo->imagem_url }}" aria-label="Ampliar panfleto">
            <img src="{{ $promo->imagem_url }}" alt="{{ $promo->titulo }}" loading="lazy" decoding="async">
            <span class="promo-painel-lupa" aria-hidden="true"><i class="fas fa-magnifying-glass-plus"></i></span>
        </button>
        <button type="button" class="promo-share" data-url="{{ route('promocoes.index') }}#promo-{{ $promo->id }}" data-titulo="Panfleto de ofertas Shopp Reparos" aria-label="Compartilhar panfleto">
            <i class="fas fa-share-nodes"></i>
        </button>
    </div>

    <div class="promo-body">
        <p class="promo-meta {{ $urgencia ? 'is-urgente' : '' }}">
            <i class="{{ $urgencia ? 'fas fa-clock' : 'far fa-calendar' }}"></i>
            {{ $urgencia ?? ($promo->termina_em ? 'Até ' . $promo->termina_em->format('d/m') : 'Enquanto durar o estoque') }}{{ count($lojasPromo) === 1 ? ' · Só em ' . $lojasPromo[0]['nome'] : '' }}
        </p>

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
