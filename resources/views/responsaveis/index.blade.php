@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Responsáveis Técnicos</h1>
        <a href="{{ route('admin.responsaveis.create') }}" class="inline-block mt-4 sm:mt-0 px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">Novo Responsável</a>
    </div>
    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-xs">
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Nome</th>
                    <th class="px-4 py-3">E-mail</th>
                    <th class="px-4 py-3">Telefone</th>
                    <th class="px-4 py-3">Valor Hora</th>
                    <th class="px-4 py-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($responsaveis as $resp)
                <tr class="border-b border-gray-100 hover:bg-blue-50 transition">
                    <td class="px-4 py-2">
                        @if($resp->foto)
                            <img src="{{ asset('storage/' . $resp->foto) }}" alt="Foto" class="rounded-full shadow max-w-[48px]">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $resp->name }}</td>
                    <td class="px-4 py-2">{{ $resp->email }}</td>
                    <td class="px-4 py-2">{{ $resp->telefone }}</td>
                    <td class="px-4 py-2">R$ {{ number_format($resp->valor_hora, 2, ',', '.') }}</td>
                    <td class="px-4 py-2 flex gap-2 justify-center">
                        <a href="#" class="px-3 py-1 bg-yellow-400 text-gray-900 rounded hover:bg-yellow-500 transition text-xs font-semibold shadow">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
