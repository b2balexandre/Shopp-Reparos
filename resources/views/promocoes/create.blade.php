@extends('admin.layout')

@section('title', 'Nova promoção')

@section('content')
<div class="mx-auto max-w-6xl">
    <a href="{{ route('admin.promocoes.index') }}" class="mb-4 inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-blue-600">
        <i class="fas fa-arrow-left"></i> Voltar para promoções
    </a>
    <form action="{{ route('admin.promocoes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('promocoes._form')
    </form>
</div>
@endsection
