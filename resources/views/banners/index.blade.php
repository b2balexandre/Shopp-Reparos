@extends('admin.layout')

@section('title', 'Gerenciar Banners')

@section('content')
<style>
    .banner-page { max-width: 1100px; margin: 0 auto; padding: 28px 20px 96px; display: flex; flex-direction: column; gap: 22px; }
    .banner-head, .banner-card, .banner-create { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; box-shadow: 0 18px 50px -36px rgba(15, 23, 42, .45); }
    .banner-head { display: flex; justify-content: space-between; gap: 18px; align-items: center; padding: 22px 24px; }
    .banner-head h1 { margin: 0; font-size: 1.7rem; font-weight: 800; color: #0f172a; letter-spacing: -0.03em; }
    .banner-head p { margin: 6px 0 0; color: #475569; font-size: .95rem; }
    .banner-actions { display: flex; gap: 8px; flex-wrap: wrap; }
    .banner-link, .banner-save, .banner-publish { border: 0; border-radius: 999px; padding: 10px 16px; font-weight: 700; font-size: .875rem; text-decoration: none; cursor: pointer; }
    .banner-link { background: #eef2ff; color: #3730a3; }
    .banner-link.dark { background: #0f172a; color: #fff; }
    .banner-card { padding: 16px; display: flex; flex-direction: column; gap: 12px; }
    .banner-meta { display: flex; gap: 10px; align-items: center; }
    .banner-meta input[type="hidden"] { display: none; }
    .banner-title, .banner-order, .banner-field input { border: 1px solid #e2e8f0; background: #f8fafc; border-radius: 12px; padding: 10px 12px; color: #0f172a; font-size: .95rem; }
    .banner-title { flex: 1 1 auto; min-width: 0; width: auto; font-weight: 700; }
    .banner-order { flex: 0 0 84px; width: 84px; }
    .banner-field input { width: 100%; }
    .banner-title:focus, .banner-order:focus, .banner-field input:focus { outline: none; border-color: #818cf8; background: #fff; box-shadow: 0 0 0 4px rgba(99, 102, 241, .15); }
    .banner-save { background: #0f172a; color: #fff; white-space: nowrap; }
    .banner-delete { width: 42px; height: 42px; border: 0; border-radius: 14px; background: #fff1f2; color: #e11d48; cursor: pointer; }
    .banner-stage { display: grid; grid-template-columns: minmax(0, 1fr) 168px; gap: 12px; min-width: 0; }
    .paste-zone { position: relative; overflow: hidden; border-radius: 18px; border: 2px dashed #cbd5e1; background: #f8fafc; cursor: pointer; outline: none; min-height: 168px; }
    .paste-zone-desktop { aspect-ratio: 1920 / 620; }
    .paste-zone-mobile { aspect-ratio: 4 / 5; min-height: 100%; }
    .paste-zone-mobile .paste-hud { justify-content: space-between; }
    .paste-zone-mobile .paste-status { display: none; }
    .paste-zone-mobile .paste-status.is-ok,
    .paste-zone-mobile .paste-status.is-error { display: block; flex: 1; text-align: right; }
    .paste-zone.is-armed { border-style: solid; border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79, 70, 229, .18); }
    .paste-zone.is-busy { pointer-events: none; }
    .paste-preview { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; display: none; }
    .paste-zone.has-image .paste-preview { display: block; }
    .paste-placeholder { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px; color: #64748b; text-align: center; padding: 16px; }
    .paste-zone.has-image .paste-placeholder { display: none; }
    .paste-kicker { font-size: .72rem; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; color: #6366f1; }
    .paste-placeholder strong { color: #0f172a; font-size: .95rem; }
    .paste-placeholder span, .paste-status { font-size: .78rem; }
    .paste-hud { position: absolute; left: 0; right: 0; bottom: 0; z-index: 2; display: flex; align-items: center; gap: 8px; padding: 10px 12px; color: #fff; background: linear-gradient(transparent, rgba(15, 23, 42, .78)); }
    .paste-zone.is-armed .paste-hud { background: linear-gradient(transparent, rgba(67, 56, 202, .9)); }
    .paste-keys { display: inline-flex; gap: 4px; }
    .paste-keys kbd, .banner-head kbd, #paste-bar kbd { display: inline-flex; align-items: center; justify-content: center; min-width: 1.4rem; padding: 1px 5px; border-radius: 6px; border: 1px solid rgba(255,255,255,.35); background: rgba(255,255,255,.16); font-size: .72rem; font-family: inherit; }
    .banner-head kbd { border-color: #cbd5e1; background: #fff; color: #0f172a; }
    .paste-status { flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .paste-status.is-ok { color: #bbf7d0; }
    .paste-status.is-error { color: #fecdd3; }
    .paste-file-btn { border: 0; border-radius: 999px; background: rgba(255,255,255,.18); color: #fff; font-size: .75rem; font-weight: 700; padding: 5px 10px; cursor: pointer; }
    .paste-input { position: absolute; width: 1px; height: 1px; opacity: 0; pointer-events: none; }
    .paste-zone.is-busy::after { content: "Salvando…"; position: absolute; inset: 0; z-index: 3; display: flex; align-items: center; justify-content: center; background: rgba(15, 23, 42, .45); color: #fff; font-weight: 800; }
    .banner-create { padding: 22px; }
    .banner-create h2 { margin: 0; font-size: 1.25rem; font-weight: 800; color: #0f172a; }
    .banner-create .hint { margin: 4px 0 16px; color: #64748b; font-size: .9rem; }
    .banner-create-grid { display: grid; grid-template-columns: 1fr 180px; gap: 12px; margin-top: 14px; }
    .banner-fields { display: grid; grid-template-columns: 1fr 140px; gap: 12px; }
    .banner-field span { display: block; margin-bottom: 6px; font-size: .8rem; font-weight: 700; color: #475569; }
    .banner-publish { margin-top: 14px; background: #4f46e5; color: #fff; }
    .banner-empty { padding: 36px 16px; text-align: center; color: #64748b; }
    .flash { border-radius: 16px; padding: 12px 14px; font-weight: 600; }
    .flash.ok { background: #ecfdf5; color: #047857; }
    .flash.bad { background: #fff1f2; color: #be123c; }
    #paste-bar { position: fixed; left: 50%; bottom: 18px; transform: translateX(-50%); z-index: 40; display: flex; align-items: center; gap: 8px; max-width: calc(100% - 24px); padding: 12px 16px; border-radius: 999px; background: #0f172a; color: #fff; box-shadow: 0 16px 40px rgba(15, 23, 42, .28); font-size: .92rem; }
    #paste-bar[hidden] { display: none; }
    #paste-bar kbd { background: rgba(255,255,255,.12); }
    @media (max-width: 760px) {
        .banner-head, .banner-meta, .banner-fields, .banner-stage, .banner-create-grid { display: block; }
        .banner-order, .banner-save, .banner-delete, .banner-publish { margin-top: 8px; }
        .paste-zone-mobile { aspect-ratio: 16 / 8; margin-top: 12px; }
    }
</style>

<div class="banner-page">
    <header class="banner-head">
        <div>
            <h1>Banners</h1>
            <p>Clique na arte e aperte <kbd>Ctrl</kbd> + <kbd>V</kbd>. A imagem troca na hora.</p>
        </div>
        <div class="banner-actions">
            <a class="banner-link" href="{{ route('admin.banners.gallery') }}">Histórico</a>
            <a class="banner-link dark" href="#novo-banner">Novo banner</a>
        </div>
    </header>

    @if(session('success'))
        <div class="flash ok">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash bad">{{ session('error') }}</div>
    @endif

    @forelse($banners as $banner)
        <article class="banner-card">
            <form class="banner-meta" action="{{ route('admin.banners.update', $banner) }}" method="POST">
                @csrf
                @method('PUT')
                <input class="banner-title" type="text" name="titulo" value="{{ $banner->titulo }}" placeholder="Título do banner" aria-label="Título do banner">
                <input class="banner-order" type="number" min="1" name="ordem" value="{{ $banner->ordem }}" aria-label="Ordem no carrossel">
                <button class="banner-save" type="submit">Salvar texto</button>
                <button class="banner-delete" type="button" onclick="deleteBanner({{ $banner->id }})" title="Arquivar banner" aria-label="Arquivar banner">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
            <div class="banner-stage">
                @include('banners.paste-zone', [
                    'mode' => 'live',
                    'field' => 'desktop_image',
                    'label' => 'Desktop',
                    'variant' => 'desktop',
                    'banner' => $banner->titulo ?: ('Banner ' . $banner->id),
                    'uploadUrl' => route('admin.banners.update', $banner),
                    'imageUrl' => $banner->desktop_image_path,
                ])
                @include('banners.paste-zone', [
                    'mode' => 'live',
                    'field' => 'mobile_image',
                    'label' => 'Mobile',
                    'variant' => 'mobile',
                    'banner' => $banner->titulo ?: ('Banner ' . $banner->id),
                    'uploadUrl' => route('admin.banners.update', $banner),
                    'imageUrl' => $banner->mobile_image_path,
                ])
            </div>
        </article>
    @empty
        <div class="banner-card banner-empty">Nenhum banner no ar. Crie o primeiro abaixo.</div>
    @endforelse

    <section class="banner-create" id="novo-banner">
        <h2>Novo banner</h2>
        <p class="hint">Clique em cada área e cole a arte. As duas versões entram juntas quando você publica.</p>
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="banner-fields">
                <label class="banner-field">
                    <span>Título</span>
                    <input type="text" name="titulo" required placeholder="Ex.: Queima de estoque" value="{{ old('titulo') }}">
                </label>
                <label class="banner-field">
                    <span>Ordem</span>
                    <input type="number" name="ordem" min="1" placeholder="Auto" value="{{ old('ordem') }}">
                </label>
            </div>
            <div class="banner-create-grid">
                @include('banners.paste-zone', [
                    'mode' => 'draft',
                    'field' => 'desktop_image',
                    'label' => 'Desktop',
                    'variant' => 'desktop',
                    'inputId' => 'desktop_image',
                    'required' => true,
                ])
                @include('banners.paste-zone', [
                    'mode' => 'draft',
                    'field' => 'mobile_image',
                    'label' => 'Mobile',
                    'variant' => 'mobile',
                    'inputId' => 'mobile_image',
                    'required' => true,
                ])
            </div>
            <button class="banner-publish" type="submit">Publicar banner</button>
        </form>
    </section>
</div>

<div id="paste-bar" hidden>
    <span data-bar-text>Arte selecionada.</span>
    <kbd>Ctrl</kbd><kbd>V</kbd>
</div>

<script>
    const bannerCsrf = @json(csrf_token());
    const pasteBar = document.getElementById('paste-bar');
    const pasteBarText = pasteBar.querySelector('[data-bar-text]');

    function armZone(zone) {
        document.querySelectorAll('.paste-zone.is-armed').forEach((item) => {
            if (item !== zone) item.classList.remove('is-armed');
        });
        zone.classList.add('is-armed');
        if (document.activeElement !== zone) zone.focus();
        const label = zone.dataset.label || 'Arte';
        const banner = zone.dataset.banner;
        pasteBarText.textContent = banner
            ? `${label} de “${banner}” selecionada. Cole a imagem.`
            : `${label} selecionada. Cole a imagem.`;
        pasteBar.hidden = false;
    }

    function setStatus(zone, message, kind) {
        const status = zone.querySelector('[data-status]');
        status.textContent = message;
        status.classList.toggle('is-ok', kind === 'ok');
        status.classList.toggle('is-error', kind === 'error');
    }

    function normalizeImageFile(blob) {
        const type = blob.type || 'image/png';
        let ext = (type.split('/')[1] || 'png').toLowerCase();
        if (ext === 'jpeg') ext = 'jpg';
        const fallback = `colado-${Date.now()}.${ext}`;
        const name = blob.name && blob.name !== 'image.png' ? blob.name : fallback;
        return new File([blob], name.includes('.') ? name : `${name}.${ext}`, { type });
    }

    function imageFromClipboard(event) {
        const data = event.clipboardData;
        if (!data) return null;
        const listed = data.files ? Array.from(data.files) : [];
        const direct = listed.find((file) => file.type.startsWith('image/'));
        if (direct) return normalizeImageFile(direct);
        const items = data.items ? Array.from(data.items) : [];
        for (const item of items) {
            if (item.kind === 'file' && item.type.startsWith('image/')) {
                const blob = item.getAsFile();
                if (blob) return normalizeImageFile(blob);
            }
        }
        return null;
    }

    function showPreview(zone, file) {
        const img = zone.querySelector('.paste-preview');
        const previous = img.getAttribute('src') || '';
        img.src = URL.createObjectURL(file);
        zone.classList.add('has-image');
        return previous;
    }

    function assignInputFile(zone, file) {
        const input = zone.querySelector('input[type="file"]');
        if (!input) return;
        const transfer = new DataTransfer();
        transfer.items.add(file);
        input.files = transfer.files;
    }

    async function uploadLive(zone, file, previousSrc) {
        zone.classList.add('is-busy');
        setStatus(zone, 'Salvando…');
        const body = new FormData();
        body.append('_token', bannerCsrf);
        body.append('_method', 'PUT');
        body.append(zone.dataset.field, file);

        try {
            const response = await fetch(zone.dataset.uploadUrl, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body,
            });
            const data = await response.json().catch(() => ({}));
            if (!response.ok || !data.success) {
                const fieldError = data.errors?.[zone.dataset.field]?.[0];
                throw new Error(fieldError || data.message || 'Não foi possível trocar a imagem.');
            }
            const urlKey = zone.dataset.field === 'mobile_image' ? 'mobile_image_url' : 'desktop_image_url';
            const savedUrl = data.banner?.[urlKey];
            if (savedUrl) {
                zone.querySelector('.paste-preview').src = `${savedUrl}${savedUrl.includes('?') ? '&' : '?'}t=${Date.now()}`;
            }
            setStatus(zone, 'Imagem atualizada', 'ok');
        } catch (error) {
            const img = zone.querySelector('.paste-preview');
            if (previousSrc) {
                img.src = previousSrc;
            } else {
                img.removeAttribute('src');
                zone.classList.remove('has-image');
            }
            setStatus(zone, error.message || 'Falha ao colar a imagem.', 'error');
        } finally {
            zone.classList.remove('is-busy');
        }
    }

    function receiveFile(zone, file, fromInput = false) {
        if (!file || !file.type.startsWith('image/')) {
            setStatus(zone, 'Cole uma imagem.', 'error');
            return;
        }
        if (file.size > 10 * 1024 * 1024) {
            setStatus(zone, 'A imagem passa de 10 MB.', 'error');
            return;
        }
        if (!fromInput) assignInputFile(zone, file);
        const previousSrc = showPreview(zone, file);
        if (zone.dataset.mode === 'live') {
            uploadLive(zone, file, previousSrc);
            return;
        }
        setStatus(zone, 'Pronta para publicar', 'ok');
    }

    document.querySelectorAll('[data-paste-zone]').forEach((zone) => {
        zone.addEventListener('click', (event) => {
            if (event.target.closest('[data-file-trigger]')) return;
            armZone(zone);
        });
        zone.addEventListener('focus', () => armZone(zone));
        zone.querySelector('[data-file-trigger]').addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();
            armZone(zone);
            zone.querySelector('input[type="file"]').click();
        });
        zone.querySelector('input[type="file"]').addEventListener('change', (event) => {
            const file = event.target.files?.[0];
            if (file) receiveFile(zone, file, true);
        });
        zone.addEventListener('dragover', (event) => {
            event.preventDefault();
            armZone(zone);
        });
        zone.addEventListener('drop', (event) => {
            event.preventDefault();
            const file = event.dataTransfer?.files?.[0];
            if (file) receiveFile(zone, file);
        });
    });

    document.addEventListener('paste', (event) => {
        const target = event.target;
        const typing = target instanceof Element
            && (target.matches('input, textarea') || target.isContentEditable)
            && target.type !== 'file';
        if (typing) return;

        const zone = document.querySelector('.paste-zone.is-armed');
        const file = imageFromClipboard(event);
        if (!file) return;
        event.preventDefault();
        if (!zone) {
            pasteBarText.textContent = 'Clique primeiro na arte que você quer trocar.';
            pasteBar.hidden = false;
            return;
        }
        receiveFile(zone, file);
    });

    function deleteBanner(bannerId) {
        if (!confirm('Arquivar este banner? Ele sai do ar e fica no histórico.')) return;
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('/admin/banners') }}/${bannerId}`;
        form.innerHTML = `<input type="hidden" name="_token" value="${bannerCsrf}"><input type="hidden" name="_method" value="DELETE">`;
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection
