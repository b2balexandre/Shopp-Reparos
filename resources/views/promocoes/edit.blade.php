@extends('admin.layout')

@section('title', 'Editar promoção')

@section('content')
<div class="mx-auto max-w-6xl">
    <a href="{{ route('admin.promocoes.index') }}" class="mb-4 inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-blue-600">
        <i class="fas fa-arrow-left"></i> Voltar para promoções
    </a>

    @if(session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.promocoes.update', $promocao) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('promocoes._form')
    </form>
</div>
@endsection
