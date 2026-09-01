<?php
namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\OrdemServicoAvaliacao;
use App\Models\User;
use App\Models\Servico;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total = OrdemServico::count();
        $emAndamento = OrdemServico::where('status', 'Em andamento')->count();
        $aguardando = OrdemServico::where('status', 'Aguardando peça')->count();
        $finalizadas = OrdemServico::where('status', 'Finalizado')->count();
        $mediaAvaliacao = OrdemServicoAvaliacao::avg('nota');
        $porTecnico = User::where('perfil', 'tecnico')
            ->withCount(['ordemServicos' => function($q){ $q->where('status', '!=', 'Cancelado'); }])
            ->get();
        $servicos = Servico::where('ativo', 1)->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('total', 'emAndamento', 'aguardando', 'finalizadas', 'mediaAvaliacao', 'porTecnico', 'servicos'));
    }
}
