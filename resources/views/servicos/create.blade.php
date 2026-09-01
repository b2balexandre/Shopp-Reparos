@extends($layout ?? 'layouts.app')

@section('title', 'Cadastrar Serviço')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-gray-900 mb-8 text-center">Cadastrar Serviço</h1>
    <form action="{{ route('admin.servicos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white rounded-lg shadow p-8">
        @csrf
        @include('servicos._form', ['servico' => new App\Models\Servico])
        <div class="flex gap-4 pt-4">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition">Salvar</button>
            <a href="{{ route('admin.servicos.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg font-semibold shadow hover:bg-gray-400 transition">Cancelar</a>
        </div>
    </form>
</div>
@endsection
