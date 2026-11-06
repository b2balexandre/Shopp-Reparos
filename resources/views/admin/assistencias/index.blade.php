@extends('admin.layout')

@section('title', 'Assistências')

@section('content')
<style>
    .ax-admin { max-width: 980px; margin: 0 auto; padding: 28px 20px 96px; display: flex; flex-direction: column; gap: 18px; }
    .ax-head, .ax-card, .ax-new { background: #fff; border: 1px solid #e2e8f0; border-radius: 22px; box-shadow: 0 18px 50px -36px rgba(15, 23, 42, .45); }
    .ax-head, .ax-card, .ax-new { padding: 18px; }
    .ax-head h1, .ax-new h2 { margin: 0; color: #0f172a; font-weight: 800; }
    .ax-head p, .ax-new p { margin: 6px 0 0; color: #64748b; }
    .ax-row { display: flex; gap: 10px; align-items: center; }
    .ax-row input[type="hidden"] { display: none; }
    .ax-row input[type="text"], .ax-row input[type="number"], .ax-new input[type="text"] { border: 1px solid #e2e8f0; background: #f8fafc; border-radius: 12px; padding: 10px 12px; color: #0f172a; }
    .ax-nome { flex: 1; min-width: 0; font-weight: 700; }
    .ax-ordem { width: 76px; }
    .ax-save, .ax-add { border: 0; border-radius: 999px; background: #0f172a; color: #fff; font-weight: 700; padding: 10px 14px; cursor: pointer; }
    .ax-add { background: #4f46e5; margin-top: 12px; }
    .ax-del { width: 42px; height: 42px; border: 0; border-radius: 14px; background: #fff1f2; color: #e11d48; cursor: pointer; }
    .ax-stage { display: grid; grid-template-columns: 220px minmax(0, 1fr); gap: 14px; margin-top: 12px; align-items: start; }
    .ax-zone { position: relative; aspect-ratio: 4 / 3; border-radius: 16px; overflow: hidden; border: 2px dashed #cbd5e1; background: #f8fafc; cursor: pointer; outline: none; }
    .ax-zone.is-armed { border-style: solid; border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79, 70, 229, .18); }
    .ax-zone img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .ax-zone.is-busy { pointer-events: none; }
    .ax-empty { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; text-align: center; padding: 12px; color: #64748b; font-size: .85rem; }
    .ax-hud { position: absolute; left: 0; right: 0; bottom: 0; display: flex; justify-content: space-between; gap: 8px; padding: 8px 10px; color: #fff; background: linear-gradient(transparent, rgba(15,23,42,.78)); font-size: .75rem; }
    .ax-hud kbd { border: 1px solid rgba(255,255,255,.35); border-radius: 6px; padding: 0 4px; }
    .ax-file { border: 0; border-radius: 999px; background: rgba(255,255,255,.18); color: #fff; font-weight: 700; padding: 4px 8px; cursor: pointer; }
    .ax-input { position: absolute; width: 1px; height: 1px; opacity: 0; pointer-events: none; }
    .ax-note { margin-top: 8px; color: #334155; font-size: .92rem; }
    .ax-note.is-ok { color: #047857; }
    .ax-note.is-error { color: #be123c; }
    .flash { border-radius: 16px; padding: 12px 14px; font-weight: 600; }
    .flash.ok { background: #ecfdf5; color: #047857; }
    .flash.bad { background: #fff1f2; color: #be123c; }
    #ax-bar { position: fixed; left: 50%; bottom: 18px; transform: translateX(-50%); z-index: 40; padding: 12px 16px; border-radius: 999px; background: #0f172a; color: #fff; }
    #ax-bar[hidden] { display: none; }
    @media (max-width: 720px) {
        .ax-row, .ax-stage { display: block; }
        .ax-save, .ax-del, .ax-ordem { margin-top: 8px; }
    }
</style>

<div class="ax-admin">
    <header class="ax-head">
        <h1>Assistências</h1>
        <p>Clique na imagem e aperte <strong>Ctrl+V</strong>. Ela aparece na página inicial, na assistência técnica e nos reparos hidráulicos.</p>
    </header>

    @if(session('success'))
        <div class="flash ok">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash bad">{{ session('error') }}</div>
    @endif

    @foreach($marcas as $marca)
        <article class="ax-card">
            <form class="ax-row" action="{{ route('admin.assistencias.update', $marca) }}" method="POST">
                @csrf
                @method('PUT')
                <input class="ax-nome" type="text" name="nome" value="{{ $marca->nome }}" aria-label="Nome da assistência" required>
                <input class="ax-ordem" type="number" min="1" name="ordem" value="{{ $marca->ordem }}" aria-label="Ordem">
                <button class="ax-save" type="submit">Salvar</button>
                <button class="ax-del" type="button" onclick="removerAssistencia({{ $marca->id }})" aria-label="Remover">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
            <div class="ax-stage">
                <div class="ax-zone {{ $marca->imagem_url ? 'has-image' : '' }}" tabindex="0" data-ax-zone data-upload-url="{{ route('admin.assistencias.update', $marca) }}" data-label="{{ $marca->nome }}">
                    @if($marca->imagem_url)
                        <img src="{{ $marca->imagem_url }}" alt="{{ $marca->nome }}">
                    @endif
                    <div class="ax-empty" @if($marca->imagem_url) hidden @endif>Espaço da imagem</div>
                    <div class="ax-hud"><span><kbd>Ctrl</kbd>+<kbd>V</kbd></span><button type="button" class="ax-file" data-ax-file>Arquivo</button></div>
                    <input class="ax-input" type="file" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" tabindex="-1">
                </div>
                <form action="{{ route('admin.assistencias.update', $marca) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="texto" value="{{ $marca->texto }}" placeholder="Frase curta, ex.: Assistência técnica Docol" aria-label="Texto de {{ $marca->nome }}" style="width:100%; border:1px solid #e2e8f0; background:#f8fafc; border-radius:12px; padding:10px 12px;">
                    <button class="ax-save" type="submit" style="margin-top:10px;">Salvar texto</button>
                    <p class="ax-note" data-ax-note>{{ $marca->imagem_url ? 'Clique na imagem para trocar' : 'Ainda sem imagem' }}</p>
                </form>
            </div>
        </article>
    @endforeach

    <section class="ax-new">
        <h2>Nova assistência</h2>
        <p>Informe o nome, cole a imagem e adicione.</p>
        <form action="{{ route('admin.assistencias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="ax-stage">
                <div class="ax-zone" tabindex="0" data-ax-zone data-mode="draft" data-label="Nova assistência">
                    <div class="ax-empty">Cole com Ctrl+V</div>
                    <div class="ax-hud"><span><kbd>Ctrl</kbd>+<kbd>V</kbd></span><button type="button" class="ax-file" data-ax-file>Arquivo</button></div>
                    <input class="ax-input" type="file" name="imagem" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" tabindex="-1">
                </div>
                <div>
                    <input type="text" name="nome" required placeholder="Ex.: Docol" aria-label="Nome" style="width:100%; border:1px solid #e2e8f0; background:#f8fafc; border-radius:12px; padding:10px 12px;">
                    <input type="text" name="texto" placeholder="Frase curta" aria-label="Texto" style="width:100%; margin-top:8px; border:1px solid #e2e8f0; background:#f8fafc; border-radius:12px; padding:10px 12px;">
                    <button class="ax-add" type="submit">Adicionar</button>
                </div>
            </div>
        </form>
    </section>
</div>

<div id="ax-bar" hidden>Imagem selecionada. Aperte Ctrl+V.</div>

<script>
    const axCsrf = @json(csrf_token());
    const axBar = document.getElementById('ax-bar');

    function armar(zone) {
        document.querySelectorAll('.ax-zone.is-armed').forEach((item) => {
            if (item !== zone) item.classList.remove('is-armed');
        });
        zone.classList.add('is-armed');
        if (document.activeElement !== zone) zone.focus();
        axBar.hidden = false;
        axBar.textContent = (zone.dataset.label || 'Imagem') + ' selecionada. Aperte Ctrl+V.';
    }

    function nota(zone, texto, tipo) {
        const el = zone.parentElement.querySelector('[data-ax-note]');
        if (!el) return;
        el.textContent = texto;
        el.classList.toggle('is-ok', tipo === 'ok');
        el.classList.toggle('is-error', tipo === 'error');
    }

    function normalizarImagem(blob) {
        const type = blob.type && blob.type.startsWith('image/') ? blob.type : 'image/png';
        let ext = (type.split('/')[1] || 'png').toLowerCase();
        if (ext === 'jpeg') ext = 'jpg';
        const nome = blob.name && blob.name.includes('.') ? blob.name : `colado-${Date.now()}.${ext}`;
        return new File([blob], nome, { type });
    }

    function arquivoDaArea(evento) {
        const dados = evento.clipboardData;
        if (!dados) return null;
        const lista = dados.files ? Array.from(dados.files) : [];
        const direto = lista.find((arquivo) => arquivo.type.startsWith('image/'));
        if (direto) return normalizarImagem(direto);
        const itens = dados.items ? Array.from(dados.items) : [];
        for (const item of itens) {
            if (item.kind === 'file' && item.type.startsWith('image/')) {
                const blob = item.getAsFile();
                if (blob) return normalizarImagem(blob);
            }
        }
        return null;
    }

    function mostrar(zone, arquivo) {
        let img = zone.querySelector('img');
        if (!img) {
            img = document.createElement('img');
            img.alt = zone.dataset.label || 'Assistência';
            zone.prepend(img);
        }
        const anterior = img.getAttribute('src') || '';
        img.src = URL.createObjectURL(arquivo);
        const vazio = zone.querySelector('.ax-empty');
        if (vazio) vazio.hidden = true;
        return anterior;
    }

    async function enviar(zone, arquivo, anterior) {
        if (zone.dataset.mode === 'draft') {
            const entrada = zone.querySelector('input[type="file"]');
            const transferencia = new DataTransfer();
            transferencia.items.add(arquivo);
            entrada.files = transferencia.files;
            return;
        }
        zone.classList.add('is-busy');
        nota(zone, 'Salvando…');
        const corpo = new FormData();
        corpo.append('_token', axCsrf);
        corpo.append('_method', 'PUT');
        corpo.append('imagem', arquivo, arquivo.name);
        try {
            const resposta = await fetch(zone.dataset.uploadUrl, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                body: corpo,
            });
            const dados = await resposta.json().catch(() => ({}));
            if (!resposta.ok || !dados.success) {
                throw new Error(dados.errors?.imagem?.[0] || dados.message || 'Não foi possível trocar a imagem.');
            }
            if (dados.imagem_url) {
                zone.querySelector('img').src = dados.imagem_url + '?t=' + Date.now();
            }
            nota(zone, 'Imagem atualizada', 'ok');
        } catch (erro) {
            const img = zone.querySelector('img');
            if (anterior) img.src = anterior;
            nota(zone, erro.message || 'Falha ao colar.', 'error');
        } finally {
            zone.classList.remove('is-busy');
        }
    }

    function receber(zone, arquivo) {
        arquivo = normalizarImagem(arquivo);
        if (!arquivo || !arquivo.type.startsWith('image/')) {
            nota(zone, 'Cole uma imagem.', 'error');
            return;
        }
        if (arquivo.size > 10 * 1024 * 1024) {
            nota(zone, 'A imagem passa de 10 MB.', 'error');
            return;
        }
        const anterior = mostrar(zone, arquivo);
        enviar(zone, arquivo, anterior);
    }

    document.querySelectorAll('[data-ax-zone]').forEach((zone) => {
        zone.addEventListener('click', (evento) => {
            if (evento.target.closest('[data-ax-file]')) return;
            armar(zone);
        });
        zone.querySelector('[data-ax-file]').addEventListener('click', (evento) => {
            evento.preventDefault();
            evento.stopPropagation();
            armar(zone);
            zone.querySelector('input[type="file"]').click();
        });
        zone.querySelector('input[type="file"]').addEventListener('change', (evento) => {
            const arquivo = evento.target.files?.[0];
            if (arquivo) receber(zone, arquivo);
        });
        zone.addEventListener('dragover', (evento) => { evento.preventDefault(); armar(zone); });
        zone.addEventListener('drop', (evento) => {
            evento.preventDefault();
            const arquivo = evento.dataTransfer?.files?.[0];
            if (arquivo) receber(zone, arquivo);
        });
    });

    document.addEventListener('paste', (evento) => {
        const alvo = evento.target;
        const digitando = alvo instanceof Element && (alvo.matches('input, textarea') || alvo.isContentEditable) && alvo.type !== 'file';
        if (digitando) return;
        const zone = document.querySelector('.ax-zone.is-armed');
        const arquivo = arquivoDaArea(evento);
        if (!arquivo) return;
        evento.preventDefault();
        if (!zone) {
            axBar.hidden = false;
            axBar.textContent = 'Clique primeiro na imagem que você quer trocar.';
            return;
        }
        receber(zone, arquivo);
    });

    function removerAssistencia(id) {
        if (!confirm('Remover esta assistência do site?')) return;
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('/admin/assistencias') }}/${id}`;
        form.innerHTML = `<input type="hidden" name="_token" value="${axCsrf}"><input type="hidden" name="_method" value="DELETE">`;
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection
