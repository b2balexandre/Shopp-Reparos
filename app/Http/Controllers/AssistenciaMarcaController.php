<?php

namespace App\Http\Controllers;

use App\Models\AssistenciaMarca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AssistenciaMarcaController extends Controller
{
    public function index()
    {
        $this->autorizar();
        $marcas = AssistenciaMarca::query()->orderBy('ordem')->orderBy('id')->get();

        return view('admin.assistencias.index', compact('marcas'));
    }

    public function store(Request $request)
    {
        $this->autorizar();

        $dados = $request->validate([
            'nome' => 'required|string|max:80',
            'texto' => 'nullable|string|max:280',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $marca = new AssistenciaMarca();
        $marca->nome = $dados['nome'];
        $marca->texto = $dados['texto'] ?? null;
        $marca->ordem = (AssistenciaMarca::max('ordem') ?? 0) + 1;
        $marca->ativo = true;
        if ($request->hasFile('imagem')) {
            $marca->imagem = $this->salvarImagem($request->file('imagem'));
        }
        $marca->save();

        return redirect()->route('admin.assistencias.index')->with('success', 'Assistência adicionada.');
    }

    public function update(Request $request, AssistenciaMarca $assistencia)
    {
        $this->autorizar();

        try {
            $request->validate([
                'nome' => 'nullable|string|max:80',
                'texto' => 'nullable|string|max:280',
                'ordem' => 'nullable|integer|min:1',
                'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            ], [
                'imagem.image' => 'Cole uma imagem (JPEG, PNG ou WEBP).',
                'imagem.max' => 'A imagem passa de 10 MB.',
            ]);

            if ($request->filled('nome')) {
                $assistencia->nome = $request->nome;
            }
            if ($request->exists('texto')) {
                $assistencia->texto = $request->texto;
            }
            if ($request->filled('ordem')) {
                $assistencia->ordem = $request->ordem;
            }
            if ($request->hasFile('imagem')) {
                $assistencia->imagem = $this->salvarImagem($request->file('imagem'));
            }
            $assistencia->save();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Imagem atualizada.',
                    'imagem_url' => $assistencia->imagem_url,
                ]);
            }

            return redirect()->route('admin.assistencias.index')->with('success', 'Assistência atualizada.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Não foi possível salvar a imagem. ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->route('admin.assistencias.index')->with('error', 'Não foi possível atualizar.');
        }
    }

    public function destroy(AssistenciaMarca $assistencia)
    {
        $this->autorizar();
        $assistencia->delete();

        return redirect()->route('admin.assistencias.index')->with('success', 'Assistência removida.');
    }

    private function autorizar(): void
    {
        if (!Auth::check() || Auth::user()->perfil !== 'admin') {
            abort(403);
        }
    }

    private function salvarImagem($file): string
    {
        $ext = strtolower((string) $file->getClientOriginalExtension());
        if ($ext === 'jpeg') {
            $ext = 'jpg';
        }
        if ($ext === '') {
            $ext = strtolower((string) ($file->guessExtension() ?: 'png'));
            if ($ext === 'jpeg') {
                $ext = 'jpg';
            }
        }

        $nome = 'assistencia_' . time() . '_' . Str::random(8) . '.' . $ext;
        $destino = public_path('img/assistencias');
        if (!is_dir($destino) && !mkdir($destino, 0755, true) && !is_dir($destino)) {
            throw new \RuntimeException('Não foi possível criar a pasta da imagem.');
        }

        $arquivo = $destino . DIRECTORY_SEPARATOR . $nome;
        $file->move($destino, $nome);
        if (!is_file($arquivo)) {
            throw new \RuntimeException('A imagem não foi gravada.');
        }

        return 'img/assistencias/' . $nome;
    }
}
