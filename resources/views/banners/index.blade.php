@extends('admin.layout')

@section('title', 'Gerenciar Banners')

@section('content')
<div class="px-4 sm:px-6 lg:px-10 py-10 bg-slate-950/5">
    @php($latestUpdate = $banners->max('updated_at'))
    <div class="max-w-7xl mx-auto space-y-10">
        <section class="relative overflow-hidden rounded-[32px] bg-slate-900 text-white shadow-[0_30px_80px_-40px_rgba(15,23,42,0.8)]">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.2)_0,rgba(15,23,42,0.6)_65%,rgba(15,23,42,0.95)_100%)]"></div>
            <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-cyan-400/20 blur-3xl"></div>
            <div class="absolute -left-32 bottom-0 h-80 w-80 rounded-full bg-indigo-500/20 blur-3xl"></div>
            <div class="relative z-10 grid gap-10 p-10 lg:grid-cols-[minmax(0,3fr)_minmax(260px,2fr)] lg:items-center">
                <div class="space-y-6">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.32em] text-cyan-100">
                        <i class="fas fa-bolt"></i>
                        Central de Criativos
                    </span>
                    <h1 class="text-4xl font-black leading-tight sm:text-5xl">Gerencie banners com visual de campanha premium</h1>
                    <p class="text-base text-white/80 sm:text-lg">Organize artes desktop e mobile, mantenha a ordem do carrossel e publique novidades com pré-visualização instantânea. Um ambiente único para coordenar suas campanhas com segurança.</p>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="flex items-start gap-3 text-sm text-white/80">
                            <span class="mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-white/15 text-white"><i class="fas fa-layer-group text-xs"></i></span>
                            <span>Fluxo guiado para upload das versões desktop e mobile com feedback imediato.</span>
                        </div>
                        <div class="flex items-start gap-3 text-sm text-white/80">
                            <span class="mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-white/15 text-white"><i class="fas fa-shield-alt text-xs"></i></span>
                            <span>Histórico preservado para restaurar campanhas anteriores sem complicação.</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.banners.gallery') }}" class="inline-flex items-center gap-2 rounded-full bg-white/15 px-5 py-2 text-sm font-semibold backdrop-blur transition hover:bg-white/25">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Galeria de histórico
                        </a>
                        <a href="#novo-banner" class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-2 text-sm font-semibold text-slate-900 shadow transition hover:shadow-lg">
                            <i class="fas fa-plus text-indigo-600"></i>
                            Novo banner
                        </a>
                    </div>
                </div>
                <div class="grid gap-4">
                    <div class="rounded-3xl border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <div class="flex items-center justify-between text-white/80">
                            <span class="text-xs uppercase tracking-widest">Banners ativos</span>
                            <i class="fas fa-signal"></i>
                        </div>
                        <p class="mt-3 text-4xl font-bold text-white">{{ $banners->where('is_active', true)->count() }}</p>
                        <p class="mt-1 text-xs uppercase tracking-widest text-white/60">Operando no carrossel</p>
                    </div>
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur">
                        <div class="flex items-center justify-between text-white/80">
                            <span class="text-xs uppercase tracking-widest">Total cadastrados</span>
                            <i class="fas fa-database"></i>
                        </div>
                        <p class="mt-3 text-4xl font-bold text-white">{{ $banners->count() }}</p>
                        <p class="mt-1 text-xs uppercase tracking-widest text-white/60">Arte pronta para uso</p>
                    </div>
                    @if($latestUpdate)
                        <div class="flex items-center justify-between rounded-3xl border border-white/10 bg-white/5 px-6 py-4 text-xs font-medium text-white/70 backdrop-blur">
                            <span class="inline-flex items-center gap-2 uppercase tracking-widest">
                                <i class="fas fa-clock"></i>
                                Última atualização
                            </span>
                            <span>{{ \Illuminate\Support\Carbon::parse($latestUpdate)->format('d/m/Y H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @if(session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">
                <div class="flex items-center gap-3">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600/10 text-lg">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-rose-700 shadow-sm">
                <div class="flex items-center gap-3">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-rose-600/10 text-lg">!</span>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <section id="novo-banner" class="grid gap-10 lg:grid-cols-[minmax(0,3fr)_minmax(0,2fr)]">
            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-xl">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Novo banner</h2>
                        <p class="text-sm text-slate-500">Faça o upload das versões desktop e mobile em alta qualidade.</p>
                    </div>
                    <span class="rounded-full bg-indigo-100 px-4 py-1 text-xs font-semibold text-indigo-700">Workflow guiado</span>
                </div>

                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-8">
                    @csrf
                    <div class="grid gap-6 md:grid-cols-2">
                        <label class="space-y-2">
                            <span class="text-sm font-medium text-slate-700">Título da campanha</span>
                            <input type="text" name="titulo" id="titulo" required placeholder="Ex: Black Friday 2025" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 transition focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                        </label>
                        <label class="space-y-2">
                            <span class="text-sm font-medium text-slate-700">Ordem no carrossel</span>
                            <input type="number" name="ordem" id="ordem" min="1" placeholder="Automático" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 transition focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                            <span class="block text-xs text-slate-500">Em branco, ele ocupa a próxima posição disponível.</span>
                        </label>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-3">
                            <span class="text-sm font-medium text-slate-700 flex items-center gap-2"><i class="fas fa-desktop text-indigo-500"></i> Versão desktop</span>
                            <label class="group relative flex min-h-[260px] cursor-pointer flex-col items-center justify-center gap-4 rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center transition hover:border-indigo-300 hover:bg-indigo-50" for="desktop_image">
                                <div class="absolute inset-3 rounded-2xl bg-gradient-to-br from-white/70 via-white/60 to-white/30 opacity-0 transition group-hover:opacity-100"></div>
                                <div class="relative z-10 flex flex-col items-center gap-3 text-slate-500">
                                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-indigo-500/10 text-indigo-500"><i class="fas fa-cloud-upload-alt text-xl"></i></span>
                                    <div class="space-y-1">
                                        <p class="text-sm font-semibold text-slate-700">Arraste a arte ou clique para carregar</p>
                                        <p class="text-xs text-slate-500">JPEG, PNG ou WEBP até 5MB</p>
                                    </div>
                                    <img id="desktop_preview" class="hidden w-full rounded-xl border border-slate-200 object-cover shadow-lg" alt="Pré-visualização Desktop" />
                                </div>
                            </label>
                            <input type="file" name="desktop_image" id="desktop_image" required accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="sr-only" data-preview-target="desktop_preview" />
                        </div>

                        <div class="space-y-3">
                            <span class="text-sm font-medium text-slate-700 flex items-center gap-2"><i class="fas fa-mobile-alt text-indigo-500"></i> Versão mobile</span>
                            <label class="group relative flex min-h-[260px] cursor-pointer flex-col items-center justify-center gap-4 rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center transition hover:border-indigo-300 hover:bg-indigo-50" for="mobile_image">
                                <div class="absolute inset-3 rounded-2xl bg-gradient-to-br from-white/70 via-white/60 to-white/30 opacity-0 transition group-hover:opacity-100"></div>
                                <div class="relative z-10 flex flex-col items-center gap-3 text-slate-500">
                                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-cyan-500/10 text-cyan-500"><i class="fas fa-cloud-upload-alt text-xl"></i></span>
                                    <div class="space-y-1">
                                        <p class="text-sm font-semibold text-slate-700">Arraste a arte ou clique para carregar</p>
                                        <p class="text-xs text-slate-500">JPEG, PNG ou WEBP até 5MB</p>
                                    </div>
                                    <img id="mobile_preview" class="hidden w-full rounded-xl border border-slate-200 object-cover shadow-lg" alt="Pré-visualização Mobile" />
                                </div>
                            </label>
                            <input type="file" name="mobile_image" id="mobile_image" required accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="sr-only" data-preview-target="mobile_preview" />
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-indigo-100 bg-indigo-50 px-6 py-4 text-indigo-700">
                        <div class="flex items-center gap-3 text-sm">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white text-indigo-600"><i class="fas fa-lightbulb"></i></span>
                            <span>Use textos curtos e chamativos. Combine cores com as campanhas atuais.</span>
                        </div>
                        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow transition hover:bg-indigo-700">
                            <i class="fas fa-rocket text-sm"></i>
                            Publicar banner
                        </button>
                    </div>
                </form>
            </div>

            <aside class="flex flex-col gap-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl">
                    <h3 class="text-base font-semibold text-slate-900">Como funciona o carrossel</h3>
                    <ul class="mt-4 space-y-3 text-sm text-slate-600">
                        <li class="flex gap-3"><span class="mt-1 h-2.5 w-2.5 rounded-full bg-indigo-500"></span> A ordem define a sequência do carrossel na home.</li>
                        <li class="flex gap-3"><span class="mt-1 h-2.5 w-2.5 rounded-full bg-indigo-500"></span> Substitua imagens para atualizar campanhas sem perder histórico.</li>
                        <li class="flex gap-3"><span class="mt-1 h-2.5 w-2.5 rounded-full bg-indigo-500"></span> Dimensões ideais: <strong>Desktop 1920x540</strong> e <strong>Mobile 1080x1350</strong>.</li>
                    </ul>
                </div>
                <div class="rounded-3xl border border-indigo-200 bg-white p-6 shadow-lg">
                    <h3 class="text-base font-semibold text-indigo-900">Precisa revisar artes antigas?</h3>
                    <p class="mt-2 text-sm text-indigo-600">Abra a galeria de histórico para restaurar versões antigas em poucos cliques.</p>
                    <a href="{{ route('admin.banners.gallery') }}" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                        <i class="fas fa-images"></i>
                        Acessar galeria
                    </a>
                </div>
            </aside>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-8 shadow-xl">
            <header class="flex flex-col gap-6 border-b border-slate-100 pb-6">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="space-y-3">
                        <span class="inline-flex items-center gap-2 rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.32em] text-indigo-700">
                            <i class="fas fa-wave-square text-indigo-600"></i>
                            Monitoramento
                        </span>
                        <h2 class="text-3xl font-bold text-slate-900">Banners em produção</h2>
                        <p class="text-sm text-slate-500">Arrumamos as informações para facilitar ajustes rápidos e garantir coerência visual nas campanhas.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500/10 text-emerald-600"><i class="fas fa-play"></i></span>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-slate-400">Ativos</p>
                                <p class="text-lg">{{ $banners->where('is_active', true)->count() }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-slate-900/10 text-slate-900"><i class="fas fa-layer-group"></i></span>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-slate-400">Total</p>
                                <p class="text-lg">{{ $banners->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-3 text-xs font-semibold uppercase tracking-widest text-slate-400">
                    <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 px-3 py-1 text-emerald-600">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Ativo
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-amber-500/10 px-3 py-1 text-amber-600">
                        <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                        Rascunho
                    </span>
                    @if($latestUpdate)
                        <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-slate-500">
                            <i class="fas fa-history"></i>
                            Atualizado em {{ \Illuminate\Support\Carbon::parse($latestUpdate)->format('d/m/Y H:i') }}
                        </span>
                    @endif
                </div>
            </header>

            @if($banners->count() > 0)
                <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($banners as $banner)
                        @php($isActive = (bool) ($banner->is_active ?? true))
                        <article class="group relative flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-2xl">
                            <div class="relative px-6 py-5 text-white">
                                <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-indigo-700 to-slate-900 opacity-95 transition group-hover:opacity-100"></div>
                                <div class="relative flex items-start justify-between gap-3">
                                    <div>
                                        <h3 class="text-lg font-semibold leading-tight">{{ $banner->titulo ?? 'Banner #' . $banner->id }}</h3>
                                        <p class="text-xs uppercase tracking-widest text-white/60">Ordem {{ $banner->ordem ?? '—' }}</p>
                                    </div>
                                    <span class="inline-flex items-center gap-1 rounded-full {{ $isActive ? 'bg-emerald-400/20 text-emerald-100' : 'bg-amber-400/20 text-amber-100' }} px-3 py-1 text-[11px] font-semibold uppercase tracking-widest">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $isActive ? 'bg-emerald-300' : 'bg-amber-300' }}"></span>
                                        {{ $isActive ? 'Ativo' : 'Rascunho' }}
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-4 px-6 py-5">
                                <div class="grid gap-4">
                                    @if($banner->desktop_image)
                                        <figure class="space-y-2">
                                            <figcaption class="text-xs font-medium text-slate-500 uppercase tracking-widest">Desktop</figcaption>
                                            <img src="{{ $banner->desktop_image_path }}" alt="Banner desktop" class="h-28 w-full rounded-2xl border border-slate-200 object-cover shadow-inner" />
                                        </figure>
                                    @endif
                                    @if($banner->mobile_image)
                                        <figure class="space-y-2">
                                            <figcaption class="text-xs font-medium text-slate-500 uppercase tracking-widest">Mobile</figcaption>
                                            <img src="{{ $banner->mobile_image_path }}" alt="Banner mobile" class="h-28 w-full rounded-2xl border border-slate-200 object-cover shadow-inner" />
                                        </figure>
                                    @endif
                                </div>

                                <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid gap-3">
                                        <label class="space-y-1 text-sm">
                                            <span class="text-slate-600">Título</span>
                                            <input type="text" name="titulo" value="{{ $banner->titulo }}" placeholder="Título do banner" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
                                        </label>
                                        <label class="space-y-1 text-sm">
                                            <span class="text-slate-600">Ordem</span>
                                            <input type="number" min="1" name="ordem" value="{{ $banner->ordem }}" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
                                        </label>
                                        <label class="space-y-1 text-xs text-slate-500">
                                            <span class="font-semibold text-slate-600">Nova imagem desktop</span>
                                            <input type="file" name="desktop_image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="w-full rounded-lg border border-dashed border-slate-300 bg-white px-3 py-2 text-xs text-slate-600 file:mr-3 file:rounded-md file:border-0 file:bg-indigo-600 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-indigo-700" />
                                        </label>
                                        <label class="space-y-1 text-xs text-slate-500">
                                            <span class="font-semibold text-slate-600">Nova imagem mobile</span>
                                            <input type="file" name="mobile_image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="w-full rounded-lg border border-dashed border-slate-300 bg-white px-3 py-2 text-xs text-slate-600 file:mr-3 file:rounded-md file:border-0 file:bg-indigo-600 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-indigo-700" />
                                        </label>
                                    </div>

                                    <div class="flex gap-3">
                                        <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 rounded-full bg-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow transition hover:bg-emerald-600">
                                            <i class="fas fa-save"></i>
                                            Salvar ajustes
                                        </button>
                                        <button type="button" onclick="deleteBanner({{ $banner->id }})" class="inline-flex items-center justify-center rounded-full bg-rose-500 px-4 py-2 text-sm font-semibold text-white shadow transition hover:bg-rose-600" title="Remover banner">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="mt-8 flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-200 bg-slate-50 py-16 text-center text-slate-500">
                    <i class="fas fa-images text-4xl text-slate-400"></i>
                    <p class="mt-4 text-base font-medium">Nenhum banner cadastrado ainda</p>
                    <p class="text-sm">Use o formulário acima para criar a primeira campanha.</p>
                </div>
            @endif
        </section>
    </div>
</div>

<script>
    const previewInputs = document.querySelectorAll('[data-preview-target]');
    previewInputs.forEach((input) => {
        input.addEventListener('change', (event) => {
            const file = event.target.files?.[0];
            const previewId = event.target.getAttribute('data-preview-target');
            if (!file || !previewId) {
                return;
            }
            const previewEl = document.getElementById(previewId);
            if (!previewEl) {
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => {
                previewEl.src = e.target?.result;
                previewEl.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });
    });

    function deleteBanner(bannerId) {
        if (!confirm('Tem certeza que deseja deletar este banner? Esta ação não pode ser desfeita.')) {
            return;
        }
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('/admin/banners') }}/${bannerId}`;

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);

        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection