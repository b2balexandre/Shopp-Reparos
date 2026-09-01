<?php
namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\OrdemServicoAvaliacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdemServicoAvaliacaoController extends Controller
{
    public function store(Request $request, OrdemServico $ordem_servico)
    {
        $request->validate([
            'nota' => 'required|integer|min:1|max:5',
            'comentario_avaliacao' => 'nullable|string|max:255',
        ]);
        if ($ordem_servico->avaliacao) {
            return back()->with('error', 'Avaliação já realizada.');
        }
        OrdemServicoAvaliacao::create([
            'ordem_servico_id' => $ordem_servico->id,
            'user_id' => Auth::id(),
            'nota' => $request->nota,
            'comentario' => $request->comentario_avaliacao,
        ]);
        return back()->with('success', 'Avaliação registrada!');
    }
}
