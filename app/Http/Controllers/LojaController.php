<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\OrdemServicoAvaliacao;
use App\Models\Produto;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LojaController extends Controller
{
    public function index(Request $request): View
    {
        $lojas = config('lojas');
        $busca = trim((string) $request->query('q', ''));
        $problemaId = (string) $request->query('problema', '');
        $problemas = $this->problemas();
        $problema = collect($problemas)->firstWhere('id', $problemaId);

        $categorias = Categoria::query()
            ->withCount(['produtos as produtos_aguas_claras_count' => fn ($q) => $q->where('loja_aguas_claras', true)])
            ->withCount(['produtos as produtos_taguatinga_count' => fn ($q) => $q->where('loja_taguatinga', true)])
            ->orderBy('nome')
            ->get()
            ->filter(fn ($categoria) => $categoria->produtos_aguas_claras_count > 0 || $categoria->produtos_taguatinga_count > 0)
            ->values();

        $marcas = Servico::query()
            ->where('ativo', true)
            ->whereNotNull('marca')
            ->where('marca', '!=', '')
            ->distinct()
            ->orderBy('marca')
            ->pluck('marca');

        $termos = $problema['termos'] ?? ($busca !== '' ? [$busca] : []);
        $resultados = $termos === []
            ? collect()
            : $this->buscar($termos);

        $avaliacoes = $this->avaliacoes();

        return view('site.lojas', compact(
            'lojas',
            'busca',
            'resultados',
            'categorias',
            'marcas',
            'problemas',
            'problema',
            'avaliacoes'
        ));
    }

    public function show(Request $request, string $slug): View
    {
        $lojas = config('lojas');

        if (! isset($lojas[$slug])) {
            abort(404);
        }

        $loja = $lojas[$slug];
        $outrasLojas = collect($lojas)->except($slug);
        $categoriaId = $request->integer('categoria') ?: null;

        $produtosQuery = Produto::with('categoria')->naLoja($slug)->orderBy('nome');
        if ($categoriaId) {
            $produtosQuery->where('categoria_id', $categoriaId);
        }

        $produtos = $produtosQuery->get();
        $servicos = Servico::query()->where('ativo', true)->naLoja($slug)->orderBy('titulo')->get();
        $categorias = Categoria::query()
            ->whereHas('produtos', fn ($q) => $q->naLoja($slug))
            ->withCount(['produtos' => fn ($q) => $q->naLoja($slug)])
            ->orderBy('nome')
            ->get();
        $marcas = $servicos->pluck('marca')->filter()->unique()->sort()->values();
        $fotos = $produtos->filter(fn ($produto) => filled($produto->imagem))->take(8)->values();
        $avaliacoes = $this->avaliacoes();
        $categoriaAtiva = $categorias->firstWhere('id', $categoriaId);

        return view('site.lojas.show', compact(
            'loja',
            'outrasLojas',
            'lojas',
            'produtos',
            'servicos',
            'categorias',
            'marcas',
            'fotos',
            'avaliacoes',
            'categoriaAtiva'
        ));
    }

    private function buscar(array $termos)
    {
        $produtos = Produto::with('categoria')
            ->where(function ($query) use ($termos) {
                foreach ($termos as $termo) {
                    $query->orWhere('nome', 'like', "%{$termo}%")
                        ->orWhere('descricao', 'like', "%{$termo}%")
                        ->orWhereHas('categoria', fn ($categoria) => $categoria->where('nome', 'like', "%{$termo}%"));
                }
            })
            ->limit(12)
            ->get()
            ->map(fn (Produto $produto) => $this->itemProduto($produto));

        $servicos = Servico::query()
            ->where('ativo', true)
            ->where(function ($query) use ($termos) {
                foreach ($termos as $termo) {
                    $query->orWhere('titulo', 'like', "%{$termo}%")
                        ->orWhere('descricao', 'like', "%{$termo}%")
                        ->orWhere('marca', 'like', "%{$termo}%");
                }
            })
            ->limit(12)
            ->get()
            ->map(fn (Servico $servico) => $this->itemServico($servico));

        return $produtos->concat($servicos)->take(16)->values();
    }

    private function itemProduto(Produto $produto): array
    {
        return [
            'tipo' => 'produto',
            'titulo' => $produto->nome,
            'descricao' => $produto->descricao,
            'categoria' => $produto->categoria->nome ?? null,
            'url' => url('/site/produtos/' . $produto->id . '-' . ($produto->slug ?: Str::slug($produto->nome))),
            'imagem' => $this->imagemProduto($produto->imagem),
            'aguas_claras' => (bool) $produto->loja_aguas_claras,
            'taguatinga' => (bool) $produto->loja_taguatinga,
        ];
    }

    private function itemServico(Servico $servico): array
    {
        return [
            'tipo' => 'servico',
            'titulo' => $servico->titulo,
            'descricao' => $servico->descricao,
            'categoria' => $servico->marca,
            'url' => url('/site/servicos/' . $servico->id . '-' . ($servico->slug ?: Str::slug($servico->titulo))),
            'imagem' => $this->imagemServico($servico->imagem),
            'aguas_claras' => (bool) $servico->loja_aguas_claras,
            'taguatinga' => (bool) $servico->loja_taguatinga,
        ];
    }

    private function imagemProduto(?string $imagem): string
    {
        if (! $imagem) {
            return asset('img/logo.png');
        }

        return asset('storage/produtos/' . basename(str_replace('\\', '/', $imagem)));
    }

    private function imagemServico(?string $imagem): string
    {
        if (! $imagem) {
            return asset('img/logo.png');
        }

        $path = ltrim(str_replace('\\', '/', $imagem), '/');
        if (! str_starts_with($path, 'servicos/')) {
            $path = 'servicos/' . basename($path);
        }

        return asset('storage/' . $path);
    }

    private function avaliacoes()
    {
        return OrdemServicoAvaliacao::query()
            ->with('user')
            ->whereNotNull('comentario')
            ->where('comentario', '!=', '')
            ->latest()
            ->take(6)
            ->get();
    }

    private function problemas(): array
    {
        return [
            [
                'id' => 'vazamento',
                'titulo' => 'Estou com vazamento na pia',
                'termos' => ['torneira', 'registro', 'vazamento', 'hidraul', 'vedante'],
            ],
            [
                'id' => 'chuveiro',
                'titulo' => 'Chuveiro sem aquecer',
                'termos' => ['chuveiro', 'lorenzetti', 'resistencia', 'eletr'],
            ],
            [
                'id' => 'disjuntor',
                'titulo' => 'Disjuntor desarmando',
                'termos' => ['disjuntor', 'eletr', 'fiacao'],
            ],
            [
                'id' => 'obra',
                'titulo' => 'Material para reforma',
                'termos' => ['ferragem', 'ferramenta', 'tinta', 'conex'],
            ],
        ];
    }
}
