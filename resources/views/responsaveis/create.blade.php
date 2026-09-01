@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-8">
    <h1 class="mb-6 text-2xl font-bold text-gray-800">Cadastrar Responsável</h1>
    <form action="{{ route('admin.responsaveis.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div>
            <label for="name" class="block mb-1 font-medium text-gray-700">Nome</label>
            <input type="text" name="name" id="name" class="w-full rounded border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="email" class="block mb-1 font-medium text-gray-700">E-mail</label>
            <input type="email" name="email" id="email" class="w-full rounded border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="password" class="block mb-1 font-medium text-gray-700">Senha</label>
            <input type="password" name="password" id="password" class="w-full rounded border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="foto" class="block mb-1 font-medium text-gray-700">Foto</label>
            <input type="file" name="foto" id="foto" class="w-full rounded border-gray-300">
        </div>
        <div>
            <label for="telefone" class="block mb-1 font-medium text-gray-700">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="w-full rounded border-gray-300">
        </div>
        <div>
            <label for="valor_hora" class="block mb-1 font-medium text-gray-700">Valor Hora (R$)</label>
            <input type="number" step="0.01" name="valor_hora" id="valor_hora" class="w-full rounded border-gray-300">
        </div>
        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded shadow focus:outline-none focus:ring-2 focus:ring-green-400 transition">Salvar</button>
            <a href="{{ route('admin.responsaveis.index') }}" class="w-full sm:w-auto px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded shadow text-center transition">Cancelar</a>
        </div>
    </form>
</div>
@endsection
