<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Promocao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PromocaoController extends Controller
{
    private const STATUS = [
        'no_ar' => 'No ar',
        'agendada' => 'Agendadas',
        'encerrada' => 'Encerradas',
        'pausada' => 'Pausadas',
    ];

    public function vitrine()
    {
        $todas = Promocao::vitrine()->with('produto')->get();
        $completas = $todas->where('so_imagem', false);

        return view('site.promocoes.index', [
            'destaques' => $completas->where('destaque', true)->values(),
            'paineis' => $todas->where('so_imagem', true)->values(),
            'promocoes' => $completas->where('destaque', false)->values(),
            'total' => $todas->count(),
        ]);
    }

    public function index(Request $request)
    {
        $this->somenteAdmin();

        $todas = Promocao::with('produto')->latest()->get();
        $contagem = collect(self::STATUS)->map(fn ($rotulo, $status) => $todas->where('status', $status)->count());
        $filtro = array_key_exists($request->query('status'), self::STATUS) ? $request->query('status') : null;
        $promocoes = $filtro ? $todas->where('status', $filtro)->values() : $todas;

        return view('promocoes.index', [
            'promocoes' => $promocoes,
            'contagem' => $contagem,
            'total' => $todas->count(),
            'filtro' => $filtro,
            'rotulos' => self::STATUS,
        ]);
    }

    public function create()
    {
        $this->somenteAdmin();

        return view('promocoes.create', [
            'promocao' => new Promocao(['ativo' => true, 'loja_aguas_claras' => true, 'loja_taguatinga' => true]),
            'produtos' => $this->produtosParaSelecao(),
        ]);
    }

    public function store(Request $request)
    {
        $this->somenteAdmin();

        $data = $this->validar($request, new Promocao());
        $data['imagem'] = $this->salvarImagem($request);
        Promocao::create($data);

        return redirect()->route('admin.promocoes.index')->with('success', 'Promoção cadastrada!');
    }

    public function edit(Promocao $promocao)
    {
        $this->somenteAdmin();

        return view('promocoes.edit', [
            'promocao' => $promocao->load('produto'),
            'produtos' => $this->produtosParaSelecao(),
        ]);
    }

    public function update(Request $request, Promocao $promocao)
    {
        $this->somenteAdmin();

        $data = $this->validar($request, $promocao);

        if ($request->hasFile('imagem') || $request->boolean('remover_imagem')) {
            $this->apagarImagem($promocao->imagem);
            $data['imagem'] = $this->salvarImagem($request);
        }

        $promocao->update($data);

        return redirect()->route('admin.promocoes.index')->with('success', 'Promoção atualizada!');
    }

    public function toggle(Promocao $promocao)
    {
        $this->somenteAdmin();

        $promocao->update(['ativo' => ! $promocao->ativo]);

        return back()->with('success', $promocao->ativo ? 'Promoção reativada.' : 'Promoção pausada. Ela saiu do site.');
    }

    public function duplicate(Promocao $promocao)
    {
        $this->somenteAdmin();

        $copia = $promocao->replicate();
        $copia->titulo = Str::limit($promocao->titulo . ' (cópia)', 255, '');
        $copia->ativo = false;
        $copia->imagem = $this->copiarImagem($promocao->imagem);
        $copia->save();

        return redirect()->route('admin.promocoes.edit', $copia)
            ->with('success', 'Cópia criada e pausada. Ajuste as datas e ative quando quiser.');
    }

    public function destroy(Promocao $promocao)
    {
        $this->somenteAdmin();

        $this->apagarImagem($promocao->imagem);
        $promocao->delete();

        return redirect()->route('admin.promocoes.index')->with('success', 'Promoção excluída.');
    }

    private function somenteAdmin(): void
    {
        if (! Auth::check() || Auth::user()->perfil !== 'admin') {
            abort(403);
        }
    }

    private function produtosParaSelecao()
    {
        return Produto::orderBy('nome')->get(['id', 'nome', 'preco', 'imagem']);
    }

    private function validar(Request $request, Promocao $promocao): array
    {
        $soImagem = $request->input('modo') === Promocao::MODO_IMAGEM;
        $mantemImagem = $promocao->imagem && ! $request->boolean('remover_imagem');

        $validator = Validator::make($request->all(), [
            'modo' => 'nullable|in:' . Promocao::MODO_COMPLETA . ',' . Promocao::MODO_IMAGEM,
            'titulo' => ($soImagem ? 'nullable' : 'required') . '|string|max:120',
            'selo' => 'nullable|string|max:40',
            'descricao' => 'nullable|string|max:1000',
            'produto_id' => 'nullable|exists:produtos,id',
            'preco_de' => 'nullable|numeric|min:0|max:99999999',
            'preco_por' => 'nullable|numeric|min:0|max:99999999',
            'inicia_em' => 'nullable|date',
            'termina_em' => $request->filled('inicia_em') ? 'nullable|date|after_or_equal:inicia_em' : 'nullable|date',
            'imagem' => ($soImagem && ! $mantemImagem ? 'required' : 'nullable') . '|image|mimes:jpeg,jpg,png,webp|max:4096',
        ], [
            'titulo.required' => 'Dê um título para a promoção.',
            'imagem.required' => 'No modo "Só imagem", envie a imagem do panfleto.',
            'termina_em.after_or_equal' => 'A data de término precisa ser igual ou depois do início.',
            'imagem.max' => 'A imagem pode ter no máximo 4 MB.',
            'imagem.mimes' => 'Use uma imagem JPG, PNG ou WEBP.',
        ]);

        $validator->after(function ($validator) use ($request, $soImagem) {
            $de = $request->input('preco_de');
            $por = $request->input('preco_por');
            if (! $soImagem && is_numeric($de) && is_numeric($por) && (float) $por >= (float) $de) {
                $validator->errors()->add('preco_por', 'O preço promocional precisa ser menor que o preço normal.');
            }
            if (! $request->boolean('loja_aguas_claras') && ! $request->boolean('loja_taguatinga')) {
                $validator->errors()->add('lojas', 'Marque pelo menos uma loja.');
            }
        });

        $data = $validator->validate();
        unset($data['imagem']);
        $data['modo'] = $soImagem ? Promocao::MODO_IMAGEM : Promocao::MODO_COMPLETA;

        if ($soImagem) {
            $data = array_merge($data, [
                'titulo' => filled($data['titulo'] ?? null) ? $data['titulo'] : 'Panfleto ' . Promocao::hoje()->format('d/m/Y'),
                'selo' => null,
                'descricao' => null,
                'produto_id' => null,
                'preco_de' => null,
                'preco_por' => null,
            ]);
        }

        return $data + [
            'loja_aguas_claras' => $request->boolean('loja_aguas_claras'),
            'loja_taguatinga' => $request->boolean('loja_taguatinga'),
            'destaque' => ! $soImagem && $request->boolean('destaque'),
            'ativo' => $request->boolean('ativo'),
        ];
    }

    private function salvarImagem(Request $request): ?string
    {
        if (! $request->hasFile('imagem')) {
            return null;
        }

        $arquivo = $request->file('imagem');
        $nome = 'promo_' . time() . '_' . Str::random(8) . '.' . strtolower($arquivo->getClientOriginalExtension());
        $arquivo->storeAs('promocoes', $nome, 'public');
        $this->espelharEmPublic('promocoes/' . $nome);

        return $nome;
    }

    private function copiarImagem(?string $nome): ?string
    {
        if (! $nome || ! Storage::disk('public')->exists('promocoes/' . $nome)) {
            return null;
        }

        $novo = 'promo_' . time() . '_' . Str::random(8) . '.' . pathinfo($nome, PATHINFO_EXTENSION);
        Storage::disk('public')->copy('promocoes/' . $nome, 'promocoes/' . $novo);
        $this->espelharEmPublic('promocoes/' . $novo);

        return $novo;
    }

    private function apagarImagem(?string $nome): void
    {
        if (! $nome) {
            return;
        }

        Storage::disk('public')->delete('promocoes/' . $nome);

        $copiaPublica = public_path('storage/promocoes/' . $nome);
        if (! is_link(public_path('storage')) && is_file($copiaPublica)) {
            @unlink($copiaPublica);
        }
    }

    private function espelharEmPublic(string $caminho): void
    {
        if (is_link(public_path('storage'))) {
            return;
        }

        $origem = storage_path('app/public/' . $caminho);
        $destino = public_path('storage/' . $caminho);
        if (! is_file($origem)) {
            return;
        }

        if (! is_dir(dirname($destino))) {
            mkdir(dirname($destino), 0755, true);
        }
        // Junções do Windows não são detectadas por is_link: copiar sobre o próprio arquivo o zeraria.
        if (realpath(dirname($origem)) !== realpath(dirname($destino))) {
            @copy($origem, $destino);
        }
    }
}
