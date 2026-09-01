@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Minhas Ordens de Serviço</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
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
