@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Minhas Ordens de Serviço</h1>

    <div class="mb-3">
        <form method="GET" class="d-flex gap-2 align-items-center">
            <label for="status" class="form-label mb-0">Filtrar por status:</label>
            <select name="status" id="status" class="form-select w-auto" onchange="this.form.submit()">
                <option value="">Todos</option>
                @foreach(['Aberto','Em andamento','Aguardando peça','Finalizado','Cancelado'] as $statusOpt)
                    <option value="{{ $statusOpt }}" @if(request('status') == $statusOpt) selected @endif>{{ $statusOpt }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Endereço</th>
                    <th>Serviço</th>
                    <th>Status</th>
                    <th>Agendada</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordens as $os)
                <tr>
                    <td>{{ $os->id }}</td>
                    <td>{{ $os->cliente_nome }}</td>
                    <td>{{ $os->endereco }}</td>
                    <td>{{ $os->servico }}</td>
                    <td><span class="badge bg-info">{{ $os->status }}</span></td>
                    <td>{{ $os->data_agendada ? date('d/m/Y H:i', strtotime($os->data_agendada)) : '-' }}</td>
                    <td>
                                                    <a href="{{ route('admin.ordem_servicos.show', $os) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $ordens->links() }}</div>
</div>
@endsection
