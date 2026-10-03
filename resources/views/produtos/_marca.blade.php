<div class="mb-4">
    <label for="marca_id" class="block font-medium text-gray-700 mb-1">Marca</label>
    <div class="flex items-center gap-2">
        <select name="marca_id" id="marca_id" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3">
            <option value="">Sem marca</option>
            @foreach($marcas as $marca)
                <option value="{{ $marca->id }}" @selected((string) old('marca_id', isset($produto) ? $produto->marca_id : '') === (string) $marca->id)>{{ $marca->nome }}</option>
            @endforeach
        </select>
        <button type="button" id="btnNovaMarca" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" style="white-space:nowrap;">+ Nova Marca</button>
    </div>
    @error('marca_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
</div>
<div id="modalNovaMarca" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.3);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#fff;padding:32px 24px;border-radius:12px;max-width:350px;width:100%;">
        <h3 class="text-lg font-bold mb-4">Cadastrar nova marca</h3>
        <input type="text" id="inputNovaMarca" class="w-full border rounded p-2 mb-4" placeholder="Nome da marca">
        <div class="flex gap-2 justify-end">
            <button type="button" id="cancelarNovaMarca" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
            <button type="button" id="salvarNovaMarca" class="px-4 py-2 bg-blue-600 text-white rounded">Salvar</button>
        </div>
        <div id="msgNovaMarca" class="text-sm mt-2 text-red-600"></div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalNovaMarca');
    const select = document.getElementById('marca_id');
    const input = document.getElementById('inputNovaMarca');
    const msg = document.getElementById('msgNovaMarca');
    document.getElementById('btnNovaMarca').onclick = function () {
        modal.style.display = 'flex';
        input.value = '';
        msg.textContent = '';
    };
    document.getElementById('cancelarNovaMarca').onclick = function () { modal.style.display = 'none'; };
    modal.onclick = function (e) { if (e.target === modal) modal.style.display = 'none'; };
    document.getElementById('salvarNovaMarca').onclick = function () {
        const nome = input.value.trim();
        if (!nome) { msg.textContent = 'Digite o nome da marca.'; return; }
        const token = document.querySelector('input[name="_token"]')?.value;
        fetch('{{ route('admin.marcas.rapida') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
            body: JSON.stringify({ nome })
        }).then(function (response) { return response.json().then(function (data) { return { ok: response.ok, data: data }; }); })
          .then(function (result) {
              if (result.ok && result.data.id) {
                  const opt = document.createElement('option');
                  opt.value = result.data.id;
                  opt.textContent = result.data.nome;
                  select.appendChild(opt);
                  select.value = result.data.id;
                  modal.style.display = 'none';
              } else {
                  msg.textContent = result.data.message || 'Não foi possível cadastrar a marca.';
              }
          }).catch(function () { msg.textContent = 'Não foi possível cadastrar a marca.'; });
    };
});
</script>
