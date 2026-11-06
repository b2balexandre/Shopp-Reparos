@php
    $assistencias = $assistencias ?? \App\Models\AssistenciaMarca::ativas();
@endphp

<div class="ax-publico">
    @forelse($assistencias as $marca)
        <article class="ax-publico-card">
            <div class="ax-publico-foto">
                @if($marca->imagem_url)
                    <img src="{{ $marca->imagem_url }}" alt="Assistência {{ $marca->nome }}">
                @else
                    <span>Espaço para a imagem {{ $marca->nome }}</span>
                @endif
            </div>
            <h3>{{ $marca->nome }}</h3>
            @if($marca->texto)
                <p>{{ $marca->texto }}</p>
            @endif
        </article>
    @empty
        <p class="ax-publico-vazio">As assistências cadastradas no painel aparecem aqui.</p>
    @endforelse
</div>

<style>
    .ax-publico { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: .8rem; }
    .ax-publico-card { background: #fff; border: 1px solid rgba(11, 58, 130, .12); border-radius: 16px; overflow: hidden; }
    .ax-publico-foto { aspect-ratio: 4 / 3; background: #f4f7fb; display: flex; align-items: center; justify-content: center; }
    .ax-publico-foto img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .ax-publico-foto span { padding: 1rem; text-align: center; color: #5b6b82; font-size: .85rem; }
    .ax-publico-card h3 { margin: .75rem .9rem .2rem; font-size: 1rem; color: #072a5e; }
    .ax-publico-card p { margin: 0 .9rem .9rem; color: #5b6b82; font-size: .88rem; line-height: 1.4; }
    .ax-publico-vazio { margin: 0; color: #5b6b82; }
</style>
