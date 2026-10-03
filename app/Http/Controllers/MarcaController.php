<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::withCount('produtos')->orderBy('nome')->get();

        return view('marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255|unique:marcas,nome',
        ]);
        Marca::create($data);

        return redirect()->route('admin.marcas.index')->with('success', 'Marca criada com sucesso!');
    }

    public function rapida(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255|unique:marcas,nome',
        ], [
            'nome.required' => 'Digite o nome da marca.',
            'nome.unique' => 'Essa marca já está cadastrada.',
        ]);
        $marca = Marca::create($data);

        return response()->json([
            'success' => true,
            'id' => $marca->id,
            'nome' => $marca->nome,
        ]);
    }

    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255', Rule::unique('marcas', 'nome')->ignore($marca->id)],
        ]);
        $marca->update($data);
        Produto::where('marca_id', $marca->id)->update(['marca' => $marca->nome]);

        return redirect()->route('admin.marcas.index')->with('success', 'Marca atualizada!');
    }

    public function show(Marca $marca)
    {
        $marca->load(['produtos' => fn ($query) => $query->orderBy('nome')]);

        return view('marcas.show', compact('marca'));
    }

    public function destroy(Marca $marca)
    {
        if ($marca->produtos()->exists()) {
            return redirect()->route('admin.marcas.index')->with('error', 'Essa marca está em produtos. Troque a marca desses produtos antes de excluir.');
        }

        $marca->delete();

        return redirect()->route('admin.marcas.index')->with('success', 'Marca removida!');
    }
}
