@extends('admin.layout')

@section('title', 'Criar Novo Produto')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Criar Novo Produto</h2>
            </div>
            
            <form action="{{ route('admin.produtos.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        <div class="mb-4">
            <label for="nome" class="block font-medium text-gray-700 mb-1">Nome</label>
            <input type="text" name="nome" id="nome" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" required>
        </div>
        <div class="mb-4">
            <label for="descricao" class="block font-medium text-gray-700 mb-1">Descrição</label>
            <textarea name="descricao" id="descricao" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3"></textarea>
        </div>
        <div class="mb-4 flex items-center gap-2">
            <label for="categoria_id" class="block font-medium text-gray-700 mb-1">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3" required>
                <option value="">Selecione</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endforeach
            </select>
            <button type="button" id="btnNovaCategoria" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" style="white-space:nowrap;">+ Nova Categoria</button>
        </div>
        <!-- Modal Nova Categoria -->
        <div id="modalNovaCategoria" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.3);z-index:9999;align-items:center;justify-content:center;">
            <div style="background:#fff;padding:32px 24px;border-radius:12px;max-width:350px;width:100%;box-shadow:0 2px 16px rgba(0,0,0,0.15);">
                <h3 class="text-lg font-bold mb-4">Cadastrar Nova Categoria</h3>
                <input type="text" id="inputNovaCategoria" class="w-full border rounded p-2 mb-4" placeholder="Nome da categoria">
                <div class="flex gap-2 justify-end">
                    <button type="button" id="cancelarNovaCategoria" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
                    <button type="button" id="salvarNovaCategoria" class="px-4 py-2 bg-blue-600 text-white rounded">Salvar</button>
                </div>
                <div id="msgNovaCategoria" class="text-sm mt-2 text-red-600"></div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btn = document.getElementById('btnNovaCategoria');
                const modal = document.getElementById('modalNovaCategoria');
                const cancelar = document.getElementById('cancelarNovaCategoria');
                const salvar = document.getElementById('salvarNovaCategoria');
                const input = document.getElementById('inputNovaCategoria');
                const msg = document.getElementById('msgNovaCategoria');
                const select = document.getElementById('categoria_id');
                btn.onclick = () => { modal.style.display = 'flex'; input.value = ''; msg.textContent = ''; };
                cancelar.onclick = () => { modal.style.display = 'none'; };
                salvar.onclick = function() {
                    const nome = input.value.trim();
                    if (!nome) { 
                        msg.textContent = 'Digite o nome da categoria.'; 
                        return; 
                    }
                    
                    // Busca o token CSRF
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                                     document.querySelector('input[name="_token"]')?.value;
                    
                    if (!csrfToken) {
                        msg.textContent = 'Token CSRF não encontrado.';
                        return;
                    }
                    
                    fetch('/api/categorias', {
                        method: 'POST',
                        headers: { 
                            'Content-Type': 'application/json', 
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ nome })
                    })
                    .then(response => {
                        console.log('Status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Resposta:', data);
                        if (data.success && data.id) {
                            // Adiciona ao select
                            const opt = document.createElement('option');
                            opt.value = data.id;
                            opt.textContent = nome;
                            select.appendChild(opt);
                            select.value = data.id;
                            modal.style.display = 'none';
                            msg.textContent = '';
                        } else {
                            msg.textContent = data.message || 'Erro ao cadastrar.';
                        }
                    })
                    .catch(error => { 
                        console.error('Erro:', error);
                        msg.textContent = 'Erro ao cadastrar.'; 
                    });
                };
                // Fecha modal ao clicar fora
                modal.onclick = e => { if (e.target === modal) modal.style.display = 'none'; };
            });
        </script>
        <div class="mb-4">
            <label for="imagem" class="block font-medium text-gray-700 mb-1">Imagem (opcional)</label>
            <input type="file" name="imagem" id="imagem" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3">
        </div>
        <div class="mb-4">
            <label for="preco" class="block font-medium text-gray-700 mb-1">Preço</label>
            <input type="number" step="0.01" name="preco" id="preco" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3">
        </div>
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.produtos.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded transition-colors">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                        Criar Produto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
