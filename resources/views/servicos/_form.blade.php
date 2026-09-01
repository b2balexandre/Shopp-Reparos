{{-- filepath: c:\Users\Alexandre Rodrigues\Desktop\shoppreparos\resources\views\servicos\_form.blade.php --}}
<div class="mb-4">
    <label for="titulo" class="block font-medium text-gray-700 mb-1">Título <span class="text-red-600">*</span></label>
    <input type="text" name="titulo" id="titulo" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" value="{{ old('titulo', $servico->titulo ?? '') }}" required placeholder="Ex: Troca de resistência">
</div>
<div class="mb-4">
    <label for="descricao" class="block font-medium text-gray-700 mb-1">Descrição <span class="text-red-600">*</span></label>
    <textarea name="descricao" id="descricao" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" required placeholder="Descreva o serviço de forma simples">{{ old('descricao', $servico->descricao ?? '') }}</textarea>
</div>
<div class="mb-4 flex items-center gap-2">
    <label for="marca" class="block font-medium text-gray-700 mb-1">Marca <span class="text-red-600">*</span></label>
    <select name="marca" id="marca" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" required>
        <option value="">Selecione</option>
        @foreach(['Lorenzetti', 'Roca', 'Meber'] as $marca)
            <option value="{{ $marca }}" @if(old('marca', $servico->marca ?? '') == $marca) selected @endif>{{ $marca }}</option>
        @endforeach
    </select>
    <button type="button" id="btnNovaMarca" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" style="white-space:nowrap;">+ Nova Marca</button>
</div>
<!-- Modal Nova Marca -->
<div id="modalNovaMarca" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.3);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#fff;padding:32px 24px;border-radius:12px;max-width:350px;width:100%;box-shadow:0 2px 16px rgba(0,0,0,0.15);">
        <h3 class="text-lg font-bold mb-4">Cadastrar Nova Marca</h3>
        <input type="text" id="inputNovaMarca" class="w-full border rounded p-2 mb-4" placeholder="Nome da marca">
        <div class="flex gap-2 justify-end">
            <button type="button" id="cancelarNovaMarca" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
            <button type="button" id="salvarNovaMarca" class="px-4 py-2 bg-blue-600 text-white rounded">Salvar</button>
        </div>
        <div id="msgNovaMarca" class="text-sm mt-2 text-red-600"></div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('btnNovaMarca');
        const modal = document.getElementById('modalNovaMarca');
        const cancelar = document.getElementById('cancelarNovaMarca');
        const salvar = document.getElementById('salvarNovaMarca');
        const input = document.getElementById('inputNovaMarca');
        const msg = document.getElementById('msgNovaMarca');
        const select = document.getElementById('marca');
        btn.onclick = () => { modal.style.display = 'flex'; input.value = ''; msg.textContent = ''; };
        cancelar.onclick = () => { modal.style.display = 'none'; };
        salvar.onclick = function() {
            const nome = input.value.trim();
            if (!nome) { msg.textContent = 'Digite o nome da marca.'; return; }
            fetch('/api/marcas', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value },
                body: JSON.stringify({ nome })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    // Adiciona ao select
                    const opt = document.createElement('option');
                    opt.value = nome;
                    opt.textContent = nome;
                    select.appendChild(opt);
                    select.value = nome;
                    modal.style.display = 'none';
                } else {
                    msg.textContent = data.message || 'Erro ao cadastrar.';
                }
            })
            .catch(() => { msg.textContent = 'Erro ao cadastrar.'; });
        };
        // Fecha modal ao clicar fora
        modal.onclick = e => { if (e.target === modal) modal.style.display = 'none'; };
    });
</script>
<div class="mb-4">
    <label for="codigo_interno" class="block font-medium text-gray-700 mb-1">Código Interno</label>
    <input type="text" name="codigo_interno" id="codigo_interno" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" value="{{ old('codigo_interno', $servico->codigo_interno ?? '') }}" placeholder="Opcional">
</div>
<div class="mb-4">
    <label for="imagem" class="block font-medium text-gray-700 mb-1">Imagem</label>
    <input type="file" name="imagem" id="imagem" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3">
    @if(!empty($servico->imagem))
        <div class="mt-2">
            <img src="{{ asset('storage/servicos/' . $servico->imagem) }}" alt="Imagem atual" class="rounded shadow max-w-xs">
        </div>
    @endif
</div>
<div class="mb-4">
    <label for="valor_estimado" class="block font-medium text-gray-700 mb-1">Valor Estimado</label>
    <input type="text" name="valor_estimado" id="valor_estimado" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" value="{{ old('valor_estimado', $servico->valor_estimado ?? '') }}" placeholder="Ex: R$ 100,00">
</div>
<div class="mb-4">
    <label for="prazo_medio" class="block font-medium text-gray-700 mb-1">Prazo Médio</label>
    <input type="text" name="prazo_medio" id="prazo_medio" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" value="{{ old('prazo_medio', $servico->prazo_medio ?? '') }}" placeholder="Ex: 2 dias">
</div>
<div class="mb-4 flex items-center gap-2">
    <input type="hidden" name="possui_garantia" value="0">
    <input type="checkbox" name="possui_garantia" id="possui_garantia" class="rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" value="1" {{ old('possui_garantia', $servico->possui_garantia ?? false) ? 'checked' : '' }}>
    <label for="possui_garantia" class="font-medium text-gray-700">Possui Garantia</label>
</div>
<div class="mb-4">
    <label for="info_tecnica" class="block font-medium text-gray-700 mb-1">Informações Técnicas</label>
    <textarea name="info_tecnica" id="info_tecnica" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="Opcional">{{ old('info_tecnica', $servico->info_tecnica ?? '') }}</textarea>
</div>
<div class="mb-4">
    <label for="instrucoes_cliente" class="block font-medium text-gray-700 mb-1">Instruções para o Cliente</label>
    <textarea name="instrucoes_cliente" id="instrucoes_cliente" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="Opcional">{{ old('instrucoes_cliente', $servico->instrucoes_cliente ?? '') }}</textarea>
</div>
<div class="mb-4 flex items-center gap-2">
    <input type="hidden" name="ativo" value="0">
    <input type="checkbox" name="ativo" id="ativo" class="rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" value="1" {{ old('ativo', $servico->ativo ?? true) ? 'checked' : '' }}>
    <label for="ativo" class="font-medium text-gray-700">Ativo</label>
</div>
