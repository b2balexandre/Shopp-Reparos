@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">Nova Ordem de Serviço</h1>
    <form action="{{ route('admin.ordem_servicos.store') }}" method="POST" class="space-y-6 bg-white rounded-lg shadow p-8">
        @csrf
        <div>
            <label for="cliente_nome" class="block font-medium text-gray-700 mb-1">Nome do Cliente</label>
            <input type="text" name="cliente_nome" id="cliente_nome" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="cliente_telefone" class="block font-medium text-gray-700 mb-1">Telefone</label>
            <input type="text" name="cliente_telefone" id="cliente_telefone" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <label for="endereco" class="block font-medium text-gray-700 mb-1">Endereço</label>
            <input type="text" name="endereco" id="endereco" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="servico" class="block font-medium text-gray-700 mb-1">Serviço</label>
            <input type="text" name="servico" id="servico" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="descricao_problema" class="block font-medium text-gray-700 mb-1">Descrição do Problema</label>
            <textarea name="descricao_problema" id="descricao_problema" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>
        <div>
            <label for="data_agendada" class="block font-medium text-gray-700 mb-1">Data/Hora Agendada</label>
            <input type="datetime-local" name="data_agendada" id="data_agendada" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <label for="tecnico_id" class="block font-medium text-gray-700 mb-1">Técnico Responsável</label>
            <select name="tecnico_id" id="tecnico_id" class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Selecione</option>
                @foreach($tecnicos as $tecnico)
                    <option value="{{ $tecnico->id }}">{{ $tecnico->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-4 pt-4">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition">Salvar</button>
            <a href="{{ route('admin.ordem_servicos.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg font-semibold shadow hover:bg-gray-400 transition">Cancelar</a>
        </div>
    </form>
</div>
@endsection
