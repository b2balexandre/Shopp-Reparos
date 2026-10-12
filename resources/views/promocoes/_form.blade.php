@php
    $reenviado = old('_token') !== null;
    $marcado = fn (string $campo) => $reenviado ? (bool) old($campo) : (bool) $promocao->{$campo};
    $campo = 'w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30';
    $rotulo = 'mb-1.5 block text-sm font-semibold text-slate-700';
    $ajuda = 'mt-1.5 text-xs text-slate-500';
    $erro = 'mt-1.5 text-sm font-medium text-rose-600';
    $produtoAtual = old('produto_id', $promocao->produto_id);
    $modo = old('modo', $promocao->modo);
    $soImagem = $modo === \App\Models\Promocao::MODO_IMAGEM;
@endphp

<style>
    #form-promocao[data-modo="imagem"] [data-so="completa"],
    #form-promocao[data-modo="completa"] [data-so="imagem"] { display: none; }
    #form-promocao[data-modo="imagem"] .bloco-imagem { order: -1; }
    .modo-opcao:has(input:checked) { border-color: #2563eb; background: #eff6ff; box-shadow: 0 0 0 1px #2563eb; }
</style>

@if($errors->any())
    <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
        <p class="font-semibold">Confira os campos destacados:</p>
        <ul class="mt-1 list-disc pl-5">
            @foreach($errors->all() as $mensagem)
                <li>{{ $mensagem }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div id="form-promocao" data-modo="{{ $soImagem ? 'imagem' : 'completa' }}">
<fieldset class="mb-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
    <legend class="sr-only">Tipo de promoção</legend>
    <p class="mb-3 text-base font-bold text-slate-900">Como você quer cadastrar?</p>
    <div class="grid gap-3 sm:grid-cols-2">
        <label class="modo-opcao flex cursor-pointer items-start gap-3 rounded-xl border border-slate-200 p-4 transition">
            <input type="radio" name="modo" value="completa" class="mt-1 h-4 w-4 text-blue-600" @checked(! $soImagem)>
            <span>
                <span class="block font-semibold text-slate-900"><i class="fas fa-list-ul mr-1 text-blue-600"></i> Completa</span>
                <span class="mt-0.5 block text-sm text-slate-500">Título, texto, preço "De / Por" e imagem. O site monta o cartão da oferta.</span>
            </span>
        </label>
        <label class="modo-opcao flex cursor-pointer items-start gap-3 rounded-xl border border-slate-200 p-4 transition">
            <input type="radio" name="modo" value="imagem" class="mt-1 h-4 w-4 text-blue-600" @checked($soImagem)>
            <span>
                <span class="block font-semibold text-slate-900"><i class="far fa-image mr-1 text-blue-600"></i> Só imagem (panfleto)</span>
                <span class="mt-0.5 block text-sm text-slate-500">Para algo rápido: envie o panfleto que já tem preço e informações. Só a imagem aparece.</span>
            </span>
        </label>
    </div>
</fieldset>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="flex flex-col gap-6 lg:col-span-2">
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <h2 class="text-base font-bold text-slate-900" data-so="completa">O que está em promoção</h2>
            <p class="mb-5 text-sm text-slate-500" data-so="completa">Vincule a um produto do catálogo para puxar nome, preço e foto automaticamente. É opcional.</p>
            <h2 class="text-base font-bold text-slate-900" data-so="imagem">Identificação</h2>
            <p class="mb-5 text-sm text-slate-500" data-so="imagem">Opcional e não aparece na página. Serve para você achar o panfleto na lista do painel.</p>

            <div class="mb-5" data-so="completa">
                <label for="produto_id" class="{{ $rotulo }}">Produto do catálogo</label>
                @if($produtos->count() > 15)
                    <input type="search" id="filtro-produto" placeholder="Buscar produto pelo nome..." class="{{ $campo }} mb-2">
                @endif
                <select name="produto_id" id="produto_id" class="{{ $campo }}">
                    <option value="">Nenhum (promoção avulsa)</option>
                    @foreach($produtos as $produto)
                        <option value="{{ $produto->id }}"
                                data-nome="{{ $produto->nome }}"
                                data-preco="{{ $produto->preco }}"
                                data-imagem="{{ $produto->imagem ? asset('storage/produtos/' . basename($produto->imagem)) : '' }}"
                                @selected($produtoAtual == $produto->id)>
                            {{ $produto->nome }}{{ $produto->preco ? ' — R$ ' . number_format((float) $produto->preco, 2, ',', '.') : '' }}
                        </option>
                    @endforeach
                </select>
                @error('produto_id')<p class="{{ $erro }}">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5">
                <label for="titulo" class="{{ $rotulo }}" data-so="completa">Título da promoção <span class="text-rose-500">*</span></label>
                <label for="titulo" class="{{ $rotulo }}" data-so="imagem">Nome do panfleto</label>
                <input type="text" name="titulo" id="titulo" maxlength="120" @required(! $soImagem) value="{{ old('titulo', $promocao->titulo) }}" placeholder="Ex.: Chuveiro Lorenzetti Advanced 7500W" data-exemplo-imagem="Ex.: Encarte de outubro" class="{{ $campo }}">
                @error('titulo')<p class="{{ $erro }}">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5" data-so="completa">
                <label for="selo" class="{{ $rotulo }}">Selo <span class="font-normal text-slate-400">(opcional)</span></label>
                <input type="text" name="selo" id="selo" maxlength="40" value="{{ old('selo', $promocao->selo) }}" placeholder="Ex.: Queima de estoque, Leve 3 pague 2" class="{{ $campo }}" list="sugestoes-selo">
                <datalist id="sugestoes-selo">
                    <option value="Queima de estoque">
                    <option value="Oferta da semana">
                    <option value="Leve 3 pague 2">
                    <option value="Últimas unidades">
                    <option value="Preço de fábrica">
                </datalist>
                <p class="{{ $ajuda }}">Aparece como etiqueta em cima do título.</p>
                @error('selo')<p class="{{ $erro }}">{{ $message }}</p>@enderror
            </div>

            <div data-so="completa">
                <label for="descricao" class="{{ $rotulo }}">Descrição e condições <span class="font-normal text-slate-400">(opcional)</span></label>
                <textarea name="descricao" id="descricao" rows="3" maxlength="1000" placeholder="Ex.: Pagamento no PIX ou à vista. Limite de 2 unidades por cliente." class="{{ $campo }}">{{ old('descricao', $promocao->descricao) }}</textarea>
                @error('descricao')<p class="{{ $erro }}">{{ $message }}</p>@enderror
            </div>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6" data-so="completa">
            <h2 class="text-base font-bold text-slate-900">Preço</h2>
            <p class="mb-5 text-sm text-slate-500">Com os dois preços preenchidos, o site mostra "De / Por" e a porcentagem de desconto.</p>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="preco_de" class="{{ $rotulo }}">Preço normal (De)</label>
                    <div class="relative">
                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">R$</span>
                        <input type="number" step="0.01" min="0" inputmode="decimal" name="preco_de" id="preco_de" value="{{ old('preco_de', $promocao->preco_de) }}" class="{{ $campo }} pl-11" placeholder="0,00">
                    </div>
                    @error('preco_de')<p class="{{ $erro }}">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="preco_por" class="{{ $rotulo }}">Preço promocional (Por)</label>
                    <div class="relative">
                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">R$</span>
                        <input type="number" step="0.01" min="0" inputmode="decimal" name="preco_por" id="preco_por" value="{{ old('preco_por', $promocao->preco_por) }}" class="{{ $campo }} pl-11" placeholder="0,00">
                    </div>
                    @error('preco_por')<p class="{{ $erro }}">{{ $message }}</p>@enderror
                </div>
            </div>
            <p id="previa-desconto" class="mt-4 hidden rounded-xl bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700"></p>
        </section>

        <section class="bloco-imagem rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <h2 class="text-base font-bold text-slate-900" data-so="completa">Imagem</h2>
            <p class="mb-5 text-sm text-slate-500" data-so="completa">Envie uma arte ou foto da oferta. Sem imagem, o site usa a foto do produto vinculado.</p>
            <h2 class="text-base font-bold text-slate-900" data-so="imagem">Imagem do panfleto <span class="text-rose-500">*</span></h2>
            <p class="mb-5 text-sm text-slate-500" data-so="imagem">A imagem aparece inteira, sem cortes, e o cliente pode tocar para ampliar e ler os detalhes.</p>

            <div class="flex flex-col gap-5 sm:flex-row sm:items-start">
                <div class="flex h-40 w-full shrink-0 items-center justify-center overflow-hidden rounded-xl border border-dashed border-slate-300 bg-slate-50 sm:w-52">
                    <img id="previa-imagem" src="{{ $promocao->imagem_url }}" alt="" class="{{ $promocao->imagem_url ? '' : 'hidden' }} h-full w-full object-contain">
                    <span id="previa-vazia" class="{{ $promocao->imagem_url ? 'hidden' : '' }} text-center text-sm text-slate-400"><i class="fas fa-image mb-1 block text-2xl"></i>Sem imagem</span>
                </div>
                <div class="flex-1">
                    <label for="imagem" class="{{ $rotulo }}">{{ $promocao->imagem ? 'Trocar imagem' : 'Escolher imagem' }}</label>
                    <input type="file" name="imagem" id="imagem" accept="image/jpeg,image/png,image/webp" class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2.5 file:font-semibold file:text-blue-700 hover:file:bg-blue-100">
                    <p class="{{ $ajuda }}" data-so="completa">JPG, PNG ou WEBP, até 4 MB. Imagens quadradas ou 4:3 ficam melhores.</p>
                    <p class="{{ $ajuda }}" data-so="imagem">JPG, PNG ou WEBP, até 4 MB. Panfletos em pé (formato retrato) ficam melhores.</p>
                    @error('imagem')<p class="{{ $erro }}">{{ $message }}</p>@enderror
                    @if($promocao->imagem)
                        <label class="mt-4 inline-flex items-center gap-2 text-sm text-slate-600">
                            <input type="checkbox" name="remover_imagem" value="1" id="remover_imagem" class="h-4 w-4 rounded border-slate-300 text-rose-600">
                            Remover a imagem enviada
                        </label>
                    @endif
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-6">
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <h2 class="text-base font-bold text-slate-900">Período</h2>
            <p class="mb-5 text-sm text-slate-500">A promoção entra e sai do site sozinha nessas datas. Deixe em branco para não ter limite.</p>
            <div class="space-y-4">
                <div>
                    <label for="inicia_em" class="{{ $rotulo }}">Começa em</label>
                    <input type="date" name="inicia_em" id="inicia_em" value="{{ old('inicia_em', $promocao->inicia_em?->format('Y-m-d')) }}" class="{{ $campo }}">
                    @error('inicia_em')<p class="{{ $erro }}">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="termina_em" class="{{ $rotulo }}">Termina em</label>
                    <input type="date" name="termina_em" id="termina_em" value="{{ old('termina_em', $promocao->termina_em?->format('Y-m-d')) }}" class="{{ $campo }}">
                    <p class="{{ $ajuda }}">A oferta fica no ar até o fim desse dia.</p>
                    @error('termina_em')<p class="{{ $erro }}">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <h2 class="mb-4 text-base font-bold text-slate-900">Lojas</h2>
            <div class="space-y-2">
                @foreach(config('lojas') as $loja)
                    @php $nomeCampo = $loja['slug'] === 'taguatinga' ? 'loja_taguatinga' : 'loja_aguas_claras'; @endphp
                    <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 hover:bg-slate-50">
                        <input type="checkbox" name="{{ $nomeCampo }}" value="1" class="h-5 w-5 rounded border-slate-300 text-blue-600" @checked($marcado($nomeCampo))>
                        <span>
                            <span class="block text-sm font-semibold text-slate-800">{{ $loja['nome'] }}</span>
                            <span class="block text-xs text-slate-500">WhatsApp {{ $loja['telefone'] }}</span>
                        </span>
                    </label>
                @endforeach
            </div>
            <p class="{{ $ajuda }}">O botão "Quero essa oferta" abre o WhatsApp da loja escolhida.</p>
            @error('lojas')<p class="{{ $erro }}">{{ $message }}</p>@enderror
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <h2 class="mb-4 text-base font-bold text-slate-900">Exibição</h2>
            <div class="space-y-3">
                <label class="flex cursor-pointer items-start gap-3">
                    <input type="checkbox" name="ativo" value="1" class="mt-0.5 h-5 w-5 rounded border-slate-300 text-emerald-600" @checked($marcado('ativo'))>
                    <span>
                        <span class="block text-sm font-semibold text-slate-800">Ativa</span>
                        <span class="block text-xs text-slate-500">Desmarque para pausar sem apagar.</span>
                    </span>
                </label>
                <label class="flex cursor-pointer items-start gap-3" data-so="completa">
                    <input type="checkbox" name="destaque" value="1" class="mt-0.5 h-5 w-5 rounded border-slate-300 text-amber-500" @checked($marcado('destaque'))>
                    <span>
                        <span class="block text-sm font-semibold text-slate-800">Destaque</span>
                        <span class="block text-xs text-slate-500">Aparece maior, no topo da página.</span>
                    </span>
                </label>
            </div>
        </section>

        <div class="flex flex-col-reverse gap-3 sm:flex-row lg:flex-col-reverse">
            <a href="{{ route('admin.promocoes.index') }}" class="inline-flex flex-1 items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 font-semibold text-slate-700 hover:bg-slate-50">Cancelar</a>
            <button type="submit" class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white shadow-sm hover:bg-blue-700">
                <i class="fas fa-check"></i> {{ $promocao->exists ? 'Salvar alterações' : 'Publicar promoção' }}
            </button>
        </div>
    </div>
</div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('produto_id');
    const filtro = document.getElementById('filtro-produto');
    const titulo = document.getElementById('titulo');
    const precoDe = document.getElementById('preco_de');
    const precoPor = document.getElementById('preco_por');
    const arquivo = document.getElementById('imagem');
    const remover = document.getElementById('remover_imagem');
    const previa = document.getElementById('previa-imagem');
    const previaVazia = document.getElementById('previa-vazia');
    const previaDesconto = document.getElementById('previa-desconto');
    const imagemPropria = @json($promocao->imagem ? $promocao->imagem_url : null);
    const opcoes = Array.from(select.options);
    const raiz = document.getElementById('form-promocao');
    const exemploTitulo = titulo.placeholder;

    function soImagem() {
        return raiz.dataset.modo === 'imagem';
    }

    function aplicarModo(modo) {
        raiz.dataset.modo = modo;
        titulo.required = modo !== 'imagem';
        titulo.placeholder = modo === 'imagem' ? titulo.dataset.exemploImagem : exemploTitulo;
        atualizarImagem();
    }

    document.querySelectorAll('input[name="modo"]').forEach(function (radio) {
        radio.addEventListener('change', function () { aplicarModo(radio.value); });
    });

    function mostrarImagem(url) {
        previa.classList.toggle('hidden', !url);
        previaVazia.classList.toggle('hidden', !!url);
        if (url) previa.src = url;
    }

    function imagemDoProduto() {
        const opcao = select.selectedOptions[0];
        return opcao ? opcao.dataset.imagem || null : null;
    }

    function atualizarImagem() {
        if (arquivo.files && arquivo.files[0]) {
            mostrarImagem(URL.createObjectURL(arquivo.files[0]));
        } else if (imagemPropria && !(remover && remover.checked)) {
            mostrarImagem(imagemPropria);
        } else {
            mostrarImagem(soImagem() ? null : imagemDoProduto());
        }
    }

    function formatar(valor) {
        return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    function atualizarDesconto() {
        const de = parseFloat(precoDe.value);
        const por = parseFloat(precoPor.value);
        if (de > 0 && por > 0 && por < de) {
            previaDesconto.textContent = Math.round((1 - por / de) * 100) + '% de desconto · cliente economiza ' + formatar(de - por);
            previaDesconto.className = 'mt-4 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700';
        } else if (de > 0 && por >= de) {
            previaDesconto.textContent = 'O preço promocional precisa ser menor que o preço normal.';
            previaDesconto.className = 'mt-4 rounded-xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700';
        } else {
            previaDesconto.className = 'hidden';
        }
    }

    select.addEventListener('change', function () {
        const opcao = select.selectedOptions[0];
        if (opcao && opcao.value) {
            if (!titulo.value.trim()) titulo.value = opcao.dataset.nome;
            if (!precoDe.value && opcao.dataset.preco) precoDe.value = parseFloat(opcao.dataset.preco).toFixed(2);
        }
        atualizarImagem();
        atualizarDesconto();
    });

    if (filtro) {
        filtro.addEventListener('input', function () {
            const termo = filtro.value.trim().toLocaleLowerCase('pt-BR');
            const atual = select.value;
            select.replaceChildren(...opcoes.filter(function (opcao) {
                return !opcao.value || opcao.value === atual || opcao.text.toLocaleLowerCase('pt-BR').includes(termo);
            }));
            select.value = atual;
        });
    }

    arquivo.addEventListener('change', atualizarImagem);
    if (remover) remover.addEventListener('change', atualizarImagem);
    precoDe.addEventListener('input', atualizarDesconto);
    precoPor.addEventListener('input', atualizarDesconto);
    aplicarModo(raiz.dataset.modo);
    atualizarDesconto();
});
</script>
@endpush
