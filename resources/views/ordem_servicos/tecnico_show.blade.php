@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Ordem de Serviço #{{ $ordem_servico->id }}</h1>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Cliente</h5>
                    <p><b>Nome:</b> {{ $ordem_servico->cliente_nome }}</p>
                    <p><b>Endereço:</b> {{ $ordem_servico->endereco }}</p>
                    <p><b>Telefone:</b> {{ $ordem_servico->cliente_telefone }}</p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Serviço</h5>
                    <p><b>Serviço:</b> {{ $ordem_servico->servico }}</p>
                    <p><b>Descrição:</b> {{ $ordem_servico->descricao_problema }}</p>
                    <p><b>Status:</b> <span class="badge bg-info">{{ $ordem_servico->status }}</span></p>
                    <p><b>Agendada:</b> {{ $ordem_servico->data_agendada ? date('d/m/Y H:i', strtotime($ordem_servico->data_agendada)) : '-' }}</p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Atualizar Andamento</h5>
                    <form action="{{ route('admin.ordem_servicos.status', $ordem_servico) }}" method="POST" class="mb-2">
                        @csrf
                        <div class="mb-2">
                            <select name="status" class="form-select" required>
                                @foreach(['Aberto','Em andamento','Aguardando peça','Finalizado','Cancelado'] as $status)
                                    <option value="{{ $status }}" @if($ordem_servico->status == $status) selected @endif>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="observacao" class="form-control" placeholder="Observação (opcional)">
                        </div>
                        <button class="btn btn-primary btn-sm">Atualizar Status</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Comentários</h5>
                    <form action="{{ route('admin.ordem_servicos.comentar', $ordem_servico) }}" method="POST" class="mb-3">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="comentario" class="form-control" placeholder="Adicionar comentário..." required>
                            <button class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                    <ul class="list-group">
                        @foreach($ordem_servico->comentarios as $comentario)
                        <li class="list-group-item">
                            <b>{{ $comentario->user?->name ?? 'Sistema' }}</b>:
                            <span>{{ $comentario->comentario }}</span>
                            <br><small>{{ $comentario->created_at->format('d/m/Y H:i') }}</small>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Fotos</h5>
                    <form action="{{ route('admin.ordem_servicos.foto', $ordem_servico) }}" method="POST" enctype="multipart/form-data" class="mb-3">
                        @csrf
                        <div class="mb-2">
                            <input type="file" name="foto" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="descricao" class="form-control" placeholder="Descrição da foto (opcional)">
                        </div>
                        <button class="btn btn-warning text-dark">Enviar Foto</button>
                    </form>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($ordem_servico->fotos as $foto)
                        <div>
                            <img src="{{ asset('storage/' . $foto->caminho) }}" alt="Foto" style="width:80px; border-radius:8px;">
                            <div class="small text-muted">{{ $foto->descricao }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
            <a href="{{ route('admin.ordem_servicos.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
