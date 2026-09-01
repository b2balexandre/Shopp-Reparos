<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicos = Servico::orderBy('created_at', 'desc')->paginate(10);
        
        // Verificar se o usuário é admin
        $isAdmin = Auth::check() && Auth::user()->perfil === 'admin';
        
        // Se for admin, usar layout admin, senão usar layout comum
        $layout = $isAdmin ? 'admin.layout' : 'layouts.app';
        
        return view('servicos.index', compact('servicos', 'layout', 'isAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verificar se o usuário é admin
        $isAdmin = Auth::check() && Auth::user()->perfil === 'admin';
        
        // Se for admin, usar layout admin, senão usar layout comum
        $layout = $isAdmin ? 'admin.layout' : 'layouts.app';
        
        return view('servicos.create', compact('layout', 'isAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'marca' => 'required|in:Lorenzetti,Roca,Meber',
            'codigo_interno' => 'nullable|string|max:255',
            'imagem' => 'nullable|image|max:2048',
            'valor_estimado' => 'nullable|string|max:255',
            'prazo_medio' => 'nullable|string|max:255',
            'possui_garantia' => 'nullable|boolean',
            'info_tecnica' => 'nullable|string',
            'instrucoes_cliente' => 'nullable|string',
            'ativo' => 'nullable|boolean',
        ]);

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $this->uploadImagem($request->file('imagem'), null);
        }

        $data['possui_garantia'] = $request->has('possui_garantia') ? 1 : 0;
        $data['ativo'] = $request->has('ativo') ? 1 : 0;

        Servico::create($data);

        return redirect()->route('admin.servicos.index')->with('success', 'Serviço cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    {
        // Verificar se o usuário é admin
        $isAdmin = Auth::check() && Auth::user()->perfil === 'admin';
        
        // Se for admin, usar layout admin, senão usar layout comum
        $layout = $isAdmin ? 'admin.layout' : 'layouts.app';
        
        return view('servicos.show', compact('servico', 'layout', 'isAdmin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        // Verificar se o usuário é admin
        $isAdmin = Auth::check() && Auth::user()->perfil === 'admin';
        
        // Se for admin, usar layout admin, senão usar layout comum
        $layout = $isAdmin ? 'admin.layout' : 'layouts.app';
        
        return view('servicos.edit', compact('servico', 'layout', 'isAdmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servico $servico)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'marca' => 'required|in:Lorenzetti,Roca,Meber',
            'codigo_interno' => 'nullable|string|max:255',
            'imagem' => 'nullable|image|max:2048',
            'valor_estimado' => 'nullable|string|max:255',
            'prazo_medio' => 'nullable|string|max:255',
            'possui_garantia' => 'nullable|boolean',
            'info_tecnica' => 'nullable|string',
            'instrucoes_cliente' => 'nullable|string',
            'ativo' => 'nullable|boolean',
        ]);

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $this->uploadImagem($request->file('imagem'), $servico->imagem);
        } else {
            // Mantém a imagem existente se não houver upload novo
            $data['imagem'] = $servico->imagem;
        }

        $data['possui_garantia'] = $request->has('possui_garantia') ? 1 : 0;
        $data['ativo'] = $request->has('ativo') ? 1 : 0;

        $servico->update($data);

        return redirect()->route('admin.servicos.index')->with('success', 'Serviço atualizado com sucesso!');
    }

    /**
     * Duplicate the specified resource.
     */
    public function duplicate(Servico $servico)
    {
        // Criar uma cópia do serviço
        $servicoDuplicado = $servico->replicate();
        $servicoDuplicado->titulo = $servico->titulo . ' (Cópia)';
        $servicoDuplicado->codigo_interno = $servico->codigo_interno ? $servico->codigo_interno . '_copy' : null;
        $servicoDuplicado->ativo = false; // Por padrão, cópias ficam inativas
        $servicoDuplicado->slug = null; // Limpar o slug para que seja regenerado automaticamente
        if ($servico->imagem) {
            if ($novaImagem = $this->duplicateImagem($servico->imagem)) {
                $servicoDuplicado->imagem = $novaImagem;
            }
        }

        $servicoDuplicado->save();

        return redirect()->route('admin.servicos.index')->with('success', 'Serviço duplicado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        if ($servico->imagem) {
            $this->deleteImagem($servico->imagem);
        }

        $servico->delete();

        return redirect()->route('admin.servicos.index')->with('success', 'Serviço excluído com sucesso!');
    }

    private function uploadImagem($file, ?string $oldImage): ?string
    {
        if (!$file) {
            return $oldImage;
        }

        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $relativePath = 'servicos/' . $filename;

        $storedPath = $file->storeAs('servicos', $filename, 'public');
        $this->copyToPublicStorage($relativePath);

        if ($oldImage) {
            $this->deleteImagem($oldImage);
        }

        return $filename;
    }

    private function deleteImagem(?string $filename): void
    {
        if (!$filename) {
            return;
        }

        $normalized = $this->normalizePath($filename);

        if (Storage::disk('public')->exists($normalized)) {
            Storage::disk('public')->delete($normalized);
        }

        if (!is_link(public_path('storage'))) {
            $publicPath = public_path('storage/' . $normalized);
            if (file_exists($publicPath)) {
                @unlink($publicPath);
            }
        }
    }

    private function duplicateImagem(?string $filename): ?string
    {
        $sourcePath = $this->normalizePath($filename);
        if (!$sourcePath) {
            return null;
        }

        if (!Storage::disk('public')->exists($sourcePath)) {
            $publicCopy = public_path('storage/' . $sourcePath);
            if (file_exists($publicCopy)) {
                $storagePath = storage_path('app/public/' . $sourcePath);
                $storageDir = dirname($storagePath);
                if (!file_exists($storageDir)) {
                    mkdir($storageDir, 0755, true);
                }
                @copy($publicCopy, $storagePath);
            } else {
                return null;
            }
        }

        $ext = pathinfo($sourcePath, PATHINFO_EXTENSION);
        $newName = time() . '_' . Str::random(10) . '.' . $ext;
        $newPath = 'servicos/' . $newName;

        if (!Storage::disk('public')->copy($sourcePath, $newPath)) {
            return null;
        }

        $this->copyToPublicStorage($newPath);

        return $newName;
    }

    private function normalizePath(?string $filename): ?string
    {
        if (!$filename) {
            return null;
        }

        $normalized = ltrim(str_replace('\\', '/', $filename), '/');
        if (!str_starts_with($normalized, 'servicos/')) {
            $normalized = 'servicos/' . basename($normalized);
        }

        return $normalized;
    }

    private function copyToPublicStorage(string $relativePath): void
    {
        if (is_link(public_path('storage'))) {
            return;
        }

        $source = storage_path('app/public/' . ltrim($relativePath, '/'));
        if (!file_exists($source)) {
            return;
        }

        $target = public_path('storage/' . ltrim($relativePath, '/'));
        $targetDir = dirname($target);
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        @copy($source, $target);
    }
}
