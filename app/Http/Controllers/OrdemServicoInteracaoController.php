<?php
namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\OrdemServicoComentario;
use App\Models\OrdemServicoFoto;
use App\Models\OrdemServicoStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdemServicoInteracaoController extends Controller
{
    public function comentar(Request $request, OrdemServico $ordem_servico)
    {
        $request->validate(['comentario' => 'required']);
        OrdemServicoComentario::create([
            'ordem_servico_id' => $ordem_servico->id,
            'user_id' => Auth::id(),
            'comentario' => $request->comentario,
        ]);
        return back()->with('success', 'Comentário adicionado!');
    }

    public function foto(Request $request, OrdemServico $ordem_servico)
    {
        $request->validate([
            'foto' => 'required|image|max:4096',
            'descricao' => 'nullable|string|max:255',
        ]);
        $path = $request->file('foto')->store('ordem_servico_fotos', 'public');
        OrdemServicoFoto::create([
            'ordem_servico_id' => $ordem_servico->id,
            'user_id' => Auth::id(),
            'caminho' => $path,
            'descricao' => $request->descricao,
        ]);
        return back()->with('success', 'Foto enviada!');
    }

    public function status(Request $request, OrdemServico $ordem_servico)
    {
        $request->validate([
            'status' => 'required',
            'observacao' => 'nullable|string',
        ]);
        $ordem_servico->update(['status' => $request->status]);
        OrdemServicoStatus::create([
            'ordem_servico_id' => $ordem_servico->id,
            'status' => $request->status,
            'observacao' => $request->observacao,
            'user_id' => Auth::id(),
        ]);
        return back()->with('success', 'Status atualizado!');
    }
}
