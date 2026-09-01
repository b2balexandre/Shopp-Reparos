<?php
namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\User;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $user = auth()->user();
        if ($user && $user->perfil === 'tecnico') {
            $query = OrdemServico::where('tecnico_id', $user->id);
            if ($status) $query->where('status', $status);
            $ordens = $query->orderByDesc('created_at')->paginate(15);
            return view('ordem_servicos.tecnico_index', compact('ordens'));
        }
        if ($user && $user->perfil === 'cliente') {
            $ordens = OrdemServico::where('cliente_nome', $user->name)->orderByDesc('created_at')->paginate(15);
            return view('ordem_servicos.cliente_index', compact('ordens'));
        }
        $query = OrdemServico::with('tecnico');
        if ($status) $query->where('status', $status);
        $ordens = $query->orderByDesc('created_at')->paginate(15);
        return view('ordem_servicos.index', compact('ordens'));
    }

    public function indexCliente()
    {
        $ordens = OrdemServico::where('cliente_nome', auth()->user()->name)->orderByDesc('created_at')->paginate(15);
        return view('ordem_servicos.cliente_index', compact('ordens'));
    }

    public function create()
    {
        $tecnicos = User::all();
        return view('ordem_servicos.create', compact('tecnicos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_nome' => 'required',
            'cliente_telefone' => 'nullable',
            'endereco' => 'required',
            'servico' => 'required',
            'descricao_problema' => 'nullable',
            'data_agendada' => 'nullable|date',
            'tecnico_id' => 'nullable|exists:users,id',
        ]);
        $os = OrdemServico::create($data);
        return redirect()->route('ordem-servicos.show', $os)->with('success', 'Ordem de serviço criada!');
    }

    public function show(OrdemServico $ordem_servico)
    {
        $ordem_servico->load(['tecnico', 'statusHistorico.user', 'comentarios.user', 'fotos.user']);
        if (auth()->user() && auth()->user()->perfil === 'tecnico') {
            return view('ordem_servicos.tecnico_show', compact('ordem_servico'));
        }
        return view('ordem_servicos.show', compact('ordem_servico'));
    }

    public function edit(OrdemServico $ordem_servico)
    {
        $tecnicos = User::all();
        return view('ordem_servicos.edit', compact('ordem_servico', 'tecnicos'));
    }

    public function update(Request $request, OrdemServico $ordem_servico)
    {
        $data = $request->validate([
            'cliente_nome' => 'required',
            'cliente_telefone' => 'nullable',
            'endereco' => 'required',
            'servico' => 'required',
            'descricao_problema' => 'nullable',
            'data_agendada' => 'nullable|date',
            'tecnico_id' => 'nullable|exists:users,id',
            'status' => 'required',
        ]);
        $ordem_servico->update($data);
        return redirect()->route('ordem-servicos.show', $ordem_servico)->with('success', 'Ordem de serviço atualizada!');
    }
}
