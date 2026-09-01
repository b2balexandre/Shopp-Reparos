@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Ordem de Serviço #{{ $ordem_servico->id }}</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-blue-700 mb-2">Cliente</h2>
                <div class="text-gray-700">
                    <p><span class="font-bold">Nome:</span> {{ $ordem_servico->cliente_nome }}</p>
                    <p><span class="font-bold">Telefone:</span> {{ $ordem_servico->cliente_telefone }}</p>
                    <p><span class="font-bold">Endereço:</span> {{ $ordem_servico->endereco }}</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-blue-700 mb-2">Serviço</h2>
                <div class="text-gray-700">
                    <p><span class="font-bold">Serviço:</span> {{ $ordem_servico->servico }}</p>
                    <p><span class="font-bold">Descrição:</span> {{ $ordem_servico->descricao_problema }}</p>
                    <p><span class="font-bold">Status:</span>
                        @php
                            $statusColors = [
                                'Aberto' => 'bg-blue-500',
                                'Em andamento' => 'bg-yellow-500',
                                'Aguardando peça' => 'bg-orange-500',
                                'Finalizado' => 'bg-green-600',
                                'Cancelado' => 'bg-red-600',
                            ];
                        @endphp
                        <span class="inline-block px-3 py-1 text-xs font-bold rounded-full text-white {{ $statusColors[$ordem_servico->status] ?? 'bg-gray-400' }}">
                            {{ $ordem_servico->status }}
                        </span>
                    </p>
                    <p><span class="font-bold">Técnico:</span> {{ $ordem_servico->tecnico?->name }}</p>
                    <p><span class="font-bold">Agendada:</span> {{ $ordem_servico->data_agendada ? date('d/m/Y H:i', strtotime($ordem_servico->data_agendada)) : '-' }}</p>
                    <p><span class="font-bold">Conclusão:</span> {{ $ordem_servico->data_conclusao ? date('d/m/Y H:i', strtotime($ordem_servico->data_conclusao)) : '-' }}</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-blue-700 mb-2">Atualizar Andamento</h2>
                <form action="{{ route('admin.ordem_servicos.status', $ordem_servico) }}" method="POST" class="space-y-3">
                    @csrf
                    <select name="status" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                        @foreach(['Aberto','Em andamento','Aguardando peça','Finalizado','Cancelado'] as $status)
                            <option value="{{ $status }}" @if($ordem_servico->status == $status) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="observacao" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Observação (opcional)">
                    <button class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">Atualizar Status</button>
                </form>
            </div>
        </div>
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-blue-700 mb-2">Histórico de Status</h2>
                <ul class="divide-y divide-gray-200">
                    @foreach($ordem_servico->statusHistorico as $status)
                    <li class="py-3">
                        <span class="font-bold">{{ $status->status }}</span> - <span class="text-xs text-gray-500">{{ $status->created_at->format('d/m/Y H:i') }}</span><br>
                        <span class="text-xs text-gray-400">Por: {{ $status->user?->name ?? 'Sistema' }}</span><br>
                        <span class="text-sm">{{ $status->observacao }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-blue-700 mb-2">Comentários</h2>
                <form action="{{ route('admin.ordem_servicos.comentar', $ordem_servico) }}" method="POST" class="mb-3">
                    @csrf
                    <div class="flex gap-2">
                        <input type="text" name="comentario" class="flex-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Adicionar comentário..." required>
                        <button class="px-4 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700 transition">Enviar</button>
                    </div>
                </form>
                <ul class="divide-y divide-gray-200">
                    @foreach($ordem_servico->comentarios as $comentario)
                    <li class="py-3">
                        <b>{{ $comentario->user?->name ?? 'Sistema' }}</b>:
                        <span>{{ $comentario->comentario }}</span>
                        <br><small class="text-gray-500">{{ $comentario->created_at->format('d/m/Y H:i') }}</small>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-blue-700 mb-2">Fotos</h2>
                <form action="{{ route('admin.ordem_servicos.foto', $ordem_servico) }}" method="POST" enctype="multipart/form-data" class="mb-3">
                    @csrf
                    <div class="flex gap-2">
                        <input type="file" name="foto" class="flex-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                        <input type="text" name="descricao" class="flex-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Descrição da foto (opcional)">
                        <button class="px-4 py-2 bg-yellow-500 text-gray-800 font-semibold rounded hover:bg-yellow-600 transition">Enviar Foto</button>
                    </div>
                </form>
                <div class="grid grid-cols-3 gap-4">
                    @foreach($ordem_servico->fotos as $foto)
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('storage/' . $foto->caminho) }}" alt="Foto" class="w-20 h-20 object-cover rounded-lg mb-2">
                        <div class="text-center text-gray-700 text-sm">{{ $foto->descricao }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-blue-700 mb-2">Avaliação do Serviço</h2>
                @if($ordem_servico->status === 'Finalizado' && auth()->user() && auth()->user()->perfil === 'cliente')
                    <form action="{{ route('admin.ordem_servicos.avaliar', $ordem_servico) }}" method="POST" class="space-y-3">
                        @csrf
                        <div>
                            <label for="nota" class="block text-sm font-medium text-gray-700">Nota:</label>
                            <select name="nota" id="nota" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                @for($i=1; $i<=5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <input type="text" name="comentario_avaliacao" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Comentário (opcional)">
                        </div>
                        <button class="w-full px-4 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700 transition">Enviar Avaliação</button>
                    </form>
                @elseif($ordem_servico->avaliacao)
                    <div class="text-gray-700">
                        <b>Nota:</b> {{ $ordem_servico->avaliacao->nota }}<br>
                        <b>Comentário:</b> {{ $ordem_servico->avaliacao->comentario }}
                    </div>
                @else
                    <span class="text-muted">Avaliação disponível após finalização.</span>
                @endif
            </div>
        </div>
    </div>
    <div class="flex gap-4 mt-8">
        <a href="{{ route('admin.ordem_servicos.edit', $ordem_servico) }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-semibold shadow hover:bg-indigo-700 transition">Editar</a>
        <a href="{{ route('admin.ordem_servicos.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg font-semibold shadow hover:bg-gray-400 transition">Voltar</a>
    </div>
</div>
@endsection
