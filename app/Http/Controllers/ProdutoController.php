<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->orderBy('nome')->paginate(12);

        // Normaliza valores antigos (apenas para exibição)
        $produtos->getCollection()->transform(function ($p) {
            $p->imagem = $this->normalizeFilename($p->imagem);
            return $p;
        });

        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('produtos.create', compact('categorias'));
    }

    private function normalizeFilename(?string $value): ?string
    {
        if (!$value) return null;
        $v = ltrim(str_replace('\\','/',$value), '/');
        // Remove repetições de produtos/ no início
        $v = preg_replace('#^(produtos/)+#', '', $v);
        // Se por algum motivo vier um caminho completo, fica só o basename
        $v = basename($v);
        return $v;
    }

    private function copyToPublicStorage(string $relativePath): void
    {
        if (is_link(public_path('storage'))) {
            return;
        }

        $source = storage_path('app/public/' . $relativePath);
        $target = public_path('storage/' . $relativePath);

        if (!file_exists($source)) {
            return;
        }

        $targetDir = dirname($target);
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        @copy($source, $target);
    }

    private function deletePublicCopy(string $relativePath): void
    {
        if (is_link(public_path('storage'))) {
            return;
        }

        $target = public_path('storage/' . $relativePath);
        if (file_exists($target)) {
            @unlink($target);
        }
    }

    private function uploadImagem(Request $request, array &$data, ?Produto $produto = null): void
    {
        if (!$request->hasFile('imagem')) return;

        try {
            $file = $request->file('imagem');

            if ($produto && $produto->imagem) {
                $oldFile = $this->normalizeFilename($produto->imagem);
                $oldPath = 'produtos/' . $oldFile;
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
                $this->deletePublicCopy($oldPath);
            }

            $filename = uniqid('produto_') . '.' . $file->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('produtos')) {
                Storage::disk('public')->makeDirectory('produtos');
            }

            $storedPath = $file->storeAs('produtos', $filename, 'public');
            $this->copyToPublicStorage($storedPath);
            $data['imagem'] = $this->normalizeFilename($storedPath);
        } catch (\Throwable $e) {
            Log::error('Erro upload imagem produto: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'preco' => 'nullable|numeric',
        ]);
        $data['slug'] = null;

        $this->uploadImagem($request, $data);
        $data['imagem'] = $this->normalizeFilename($data['imagem'] ?? null);

        try {
            Produto::create($data);
            return redirect()->route('admin.produtos.index')->with('success', 'Produto cadastrado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao criar produto: '.$e->getMessage());
            return back()->withInput()->with('error', 'Erro ao cadastrar produto.');
        }
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::orderBy('nome')->get();
        $produto->imagem = $this->normalizeFilename($produto->imagem); // normaliza antes da view
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'preco' => 'nullable|numeric',
        ]);

        if ($data['nome'] !== $produto->nome) {
            $data['slug'] = null;
        }

        $this->uploadImagem($request, $data, $produto);
        if (array_key_exists('imagem', $data)) {
            $data['imagem'] = $this->normalizeFilename($data['imagem']);
        }

        try {
            $produto->update($data);
            return redirect()->route('admin.produtos.index')->with('success', 'Produto atualizado!');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar produto: '.$e->getMessage());
            return back()->withInput()->with('error', 'Erro ao atualizar produto.');
        }
    }

    public function show(Produto $produto)
    {
        // normaliza para evitar produtos/produtos/ ao montar a URL na view admin
        $produto->imagem = $this->normalizeFilename($produto->imagem);
        return view('produtos.show', compact('produto'));
    }

    public function duplicate(Produto $produto)
    {
        $produtoDuplicado = $produto->replicate();
        $produtoDuplicado->nome = $produto->nome . ' (Cópia)';
        $produtoDuplicado->slug = null;

        $originalNome = $this->normalizeFilename($produto->imagem);
        if ($originalNome) {
            $origPath = 'produtos/' . $originalNome;
            if (Storage::disk('public')->exists($origPath)) {
                try {
                    $ext = pathinfo($origPath, PATHINFO_EXTENSION);
                    $newFilename = 'produto_' . time() . '_' . Str::random(8) . '.' . $ext;
                    Storage::disk('public')->copy($origPath, 'produtos/' . $newFilename);
                    $this->copyToPublicStorage('produtos/' . $newFilename);
                    $produtoDuplicado->imagem = $newFilename;
                } catch (\Throwable $e) {
                    Log::warning('Falha ao copiar imagem na duplicação: ' . $e->getMessage());
                }
            }
        }

        $produtoDuplicado->save();
        return redirect()->route('admin.produtos.index')->with('success', 'Produto duplicado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        if ($produto->imagem) {
            $file = $this->normalizeFilename($produto->imagem);
            $path = 'produtos/' . $file;
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            $this->deletePublicCopy($path);
        }
        $produto->delete();
        return redirect()->route('admin.produtos.index')->with('success', 'Produto removido!');
    }
}
