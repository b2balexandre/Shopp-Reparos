<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ __('Ordens de Serviço') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Ordens de Serviço</h1>
            <a href="{{ route('admin.ordem_servicos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors">
                <i class="fas fa-plus mr-2"></i>Nova Ordem de Serviço
            </a>
        </div>

        <form method="GET" class="flex flex-col sm:flex-row gap-2 items-center mb-6">
            <label for="status" class="text-gray-700 font-medium">Filtrar por status:</label>
            <select name="status" id="status" class="rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()">
                <option value="">Todos</option>
                @foreach(['Aberto','Em andamento','Aguardando peça','Finalizado','Cancelado'] as $statusOpt)
                    <option value="{{ $statusOpt }}" @if(request('status') == $statusOpt) selected @endif>{{ $statusOpt }}</option>
                @endforeach
            </select>
        </form>

        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-xs">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Cliente</th>
                        <th class="px-4 py-3">Endereço</th>
                        <th class="px-4 py-3">Serviço</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Técnico</th>
                        <th class="px-4 py-3">Agendada</th>
                        <th class="px-4 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ordens as $os)
                    <tr class="border-b border-gray-100 hover:bg-blue-50 transition">
                        <td class="px-4 py-2 font-semibold">{{ $os->id }}</td>
                        <td class="px-4 py-2">{{ $os->cliente_nome }}</td>
                        <td class="px-4 py-2">{{ $os->endereco }}</td>
                        <td class="px-4 py-2">{{ $os->servico }}</td>
                        <td class="px-4 py-2">
                            @php
                                $statusColors = [
                                    'Aberto' => 'bg-blue-500',
                                    'Em andamento' => 'bg-yellow-500',
                                    'Aguardando peça' => 'bg-orange-500',
                                    'Finalizado' => 'bg-green-600',
                                    'Cancelado' => 'bg-red-600',
                                ];
                            @endphp
                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full text-white {{ $statusColors[$os->status] ?? 'bg-gray-400' }}">
                                {{ $os->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $os->tecnico?->name }}</td>
                        <td class="px-4 py-2">{{ $os->data_agendada ? date('d/m/Y H:i', strtotime($os->data_agendada)) : '-' }}</td>
                        <td class="px-4 py-2 flex gap-2">
                                                            <a href="{{ route('admin.ordem_servicos.show', $os) }}" class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition text-xs font-semibold shadow">Ver</a>
                                <a href="{{ route('admin.ordem_servicos.edit', $os) }}" class="px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition text-xs font-semibold shadow">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $ordens->links() }}</div>
    </div>
</x-app-layout>
