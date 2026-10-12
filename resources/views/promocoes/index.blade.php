@extends('admin.layout')

@section('title', 'Promoções')

@php
    $estilos = [
        'no_ar' => ['No ar', 'bg-emerald-100 text-emerald-700', 'fa-circle-play'],
        'agendada' => ['Agendada', 'bg-blue-100 text-blue-700', 'fa-calendar'],
        'encerrada' => ['Encerrada', 'bg-slate-200 text-slate-600', 'fa-flag-checkered'],
        'pausada' => ['Pausada', 'bg-amber-100 text-amber-700', 'fa-pause'],
    ];
    $data = fn ($d) => $d->year === now()->year ? $d->format('d/m') : $d->format('d/m/Y');
    $periodo = function ($promo) use ($data) {
        return match (true) {
            $promo->inicia_em && $promo->termina_em => $data($promo->inicia_em) . ' a ' . $data($promo->termina_em),
            (bool) $promo->inicia_em => 'A partir de ' . $data($promo->inicia_em),
            (bool) $promo->termina_em => 'Até ' . $data($promo->termina_em),
            default => 'Sem prazo',
        };
    };
@endphp

@section('content')
<div class="mx-auto max-w-6xl">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">As ofertas entram e saem da página <a href="{{ route('promocoes.index') }}" target="_blank" class="font-semibold text-blue-600 hover:underline">/promocoes</a> de acordo com o período cadastrado.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('promocoes.index') }}" target="_blank" class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 sm:flex-none">
                <i class="fas fa-arrow-up-right-from-square"></i> Ver página
            </a>
            <a href="{{ route('admin.promocoes.create') }}" class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 sm:flex-none">
                <i class="fas fa-plus"></i> Nova promoção
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">{{ session('success') }}</div>
    @endif

    <nav class="mb-5 flex gap-2 overflow-x-auto pb-1" aria-label="Filtrar por situação">
        <a href="{{ route('admin.promocoes.index') }}" class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold {{ $filtro ? 'bg-white text-slate-600 ring-1 ring-slate-200 hover:ring-slate-300' : 'bg-slate-900 text-white' }}">
            Todas <span class="ml-1 opacity-70">{{ $total }}</span>
        </a>
        @foreach($rotulos as $status => $rotulo)
            <a href="{{ route('admin.promocoes.index', ['status' => $status]) }}" class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold {{ $filtro === $status ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:ring-slate-300' }}">
                {{ $rotulo }} <span class="ml-1 opacity-70">{{ $contagem[$status] }}</span>
            </a>
        @endforeach
    </nav>

    @if($promocoes->isEmpty())
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-amber-100 text-xl text-amber-600"><i class="fas fa-tags"></i></div>
            @if($total === 0)
                <p class="text-lg font-semibold text-slate-800">Nenhuma promoção cadastrada</p>
                <p class="mx-auto mt-1 max-w-md text-sm text-slate-500">Cadastre a primeira oferta. Ela aparece na página de promoções do site assim que estiver no período.</p>
                <a href="{{ route('admin.promocoes.create') }}" class="mt-5 inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700"><i class="fas fa-plus"></i> Nova promoção</a>
            @else
                <p class="text-lg font-semibold text-slate-800">Nada por aqui</p>
                <p class="mt-1 text-sm text-slate-500">Nenhuma promoção com a situação "{{ $rotulos[$filtro] }}".</p>
            @endif
        </div>
    @else
        <ul class="space-y-3">
            @foreach($promocoes as $promo)
                @php [$rotuloStatus, $corStatus, $iconeStatus] = $estilos[$promo->status]; @endphp
                <li class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm {{ in_array($promo->status, ['encerrada', 'pausada']) ? 'opacity-80' : '' }}">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center">
                        <div class="flex min-w-0 flex-1 items-start gap-4">
                            <div class="relative h-20 w-20 shrink-0 overflow-hidden rounded-xl bg-slate-100">
                                @if($promo->imagem_url)
                                    <img src="{{ $promo->imagem_url }}" alt="" class="h-full w-full {{ $promo->imagem_propria ? 'object-cover' : 'object-contain p-1' }}">
                                @else
                                    <span class="flex h-full w-full items-center justify-center text-slate-300"><i class="fas fa-tags text-2xl"></i></span>
                                @endif
                                @if($promo->desconto)
                                    <span class="absolute left-1 top-1 rounded-md bg-yellow-400 px-1.5 py-0.5 text-[11px] font-extrabold text-slate-900">-{{ $promo->desconto }}%</span>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="mb-1 flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-bold {{ $corStatus }}"><i class="fas {{ $iconeStatus }} text-[10px]"></i> {{ $rotuloStatus }}</span>
                                    @if($promo->so_imagem)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-violet-100 px-2.5 py-0.5 text-xs font-bold text-violet-700"><i class="far fa-image text-[10px]"></i> Panfleto</span>
                                    @endif
                                    @if($promo->destaque)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-bold text-yellow-800"><i class="fas fa-star text-[10px]"></i> Destaque</span>
                                    @endif
                                    @if($promo->selo)
                                        <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-600">{{ $promo->selo }}</span>
                                    @endif
                                </div>
                                <p class="truncate font-semibold text-slate-900">{{ $promo->titulo }}</p>
                                <p class="mt-0.5 text-sm text-slate-600">
                                    @if($promo->so_imagem)
                                        <span class="text-slate-400">Informações no próprio panfleto</span>
                                    @elseif($promo->preco_por && $promo->preco_de)
                                        <span class="text-slate-400 line-through">{{ \App\Models\Promocao::formatarPreco($promo->preco_de) }}</span>
                                        <span class="font-bold text-slate-900">{{ \App\Models\Promocao::formatarPreco($promo->preco_por) }}</span>
                                    @elseif($promo->preco_por || $promo->preco_de)
                                        <span class="font-bold text-slate-900">{{ \App\Models\Promocao::formatarPreco($promo->preco_por ?? $promo->preco_de) }}</span>
                                    @else
                                        <span class="text-slate-400">Sem preço</span>
                                    @endif
                                </p>
                                <p class="mt-1 flex flex-wrap gap-x-4 gap-y-1 text-xs text-slate-500">
                                    <span><i class="far fa-calendar mr-1"></i>{{ $periodo($promo) }}@if($promo->status === 'no_ar' && $promo->dias_restantes !== null && $promo->dias_restantes <= 3) · <strong class="text-rose-600">{{ $promo->dias_restantes === 0 ? 'último dia' : 'faltam ' . $promo->dias_restantes . ' dia(s)' }}</strong>@endif</span>
                                    <span><i class="fas fa-location-dot mr-1"></i>{{ collect($promo->lojas())->pluck('nome')->implode(' e ') }}</span>
                                    @if($promo->produto)
                                        <span><i class="fas fa-box mr-1"></i>{{ $promo->produto->nome }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 border-t border-slate-100 pt-3 md:border-0 md:pt-0">
                            <a href="{{ route('admin.promocoes.edit', $promo) }}" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                <i class="fas fa-pen text-xs"></i> Editar
                            </a>
                            <form action="{{ route('admin.promocoes.toggle', $promo) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold {{ $promo->ativo ? 'text-amber-700 hover:bg-amber-50' : 'text-emerald-700 hover:bg-emerald-50' }}">
                                    <i class="fas {{ $promo->ativo ? 'fa-pause' : 'fa-play' }} text-xs"></i> {{ $promo->ativo ? 'Pausar' : 'Ativar' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.promocoes.duplicate', $promo) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50" title="Criar uma cópia para reaproveitar">
                                    <i class="far fa-copy text-xs"></i> Duplicar
                                </button>
                            </form>
                            <form action="{{ route('admin.promocoes.destroy', $promo) }}" method="POST" onsubmit="return confirm('Excluir a promoção &quot;{{ addslashes($promo->titulo) }}&quot;? Isso não pode ser desfeito.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg border border-rose-200 px-3 py-2 text-sm font-semibold text-rose-600 hover:bg-rose-50">
                                    <i class="fas fa-trash text-xs"></i> Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
