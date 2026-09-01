@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5 text-center">Departamentos de Produtos</h1>
    <div class="row justify-content-center g-5">
        <div class="col-6 col-sm-4 col-md-2 text-center">
            <div class="categoria-icone mb-2 mx-auto">
                <img src="/img/icones/reparos-hidraulicos.svg" alt="Reparos Hidráulicos" class="img-fluid">
            </div>
            <div>Reparos Hidráulicos</div>
        </div>
        <div class="col-6 col-sm-4 col-md-2 text-center">
            <div class="categoria-icone mb-2 mx-auto">
                <img src="/img/icones/eletrica.svg" alt="Elétrica" class="img-fluid">
            </div>
            <div>Elétrica</div>
        </div>
        <div class="col-6 col-sm-4 col-md-2 text-center">
            <div class="categoria-icone mb-2 mx-auto">
                <img src="/img/icones/hidraulica.svg" alt="Hidráulica" class="img-fluid">
            </div>
            <div>Hidráulica</div>
        </div>
        <div class="col-6 col-sm-4 col-md-2 text-center">
            <div class="categoria-icone mb-2 mx-auto">
                <img src="/img/icones/ferragens.svg" alt="Ferragens" class="img-fluid">
            </div>
            <div>Ferragens</div>
        </div>
        <div class="col-6 col-sm-4 col-md-2 text-center">
            <div class="categoria-icone mb-2 mx-auto">
                <img src="/img/icones/ferramentas.svg" alt="Ferramentas" class="img-fluid">
            </div>
            <div>Ferramentas</div>
        </div>
        <div class="col-6 col-sm-4 col-md-2 text-center">
            <div class="categoria-icone mb-2 mx-auto">
                <img src="/img/icones/pintura.svg" alt="Pintura" class="img-fluid">
            </div>
            <div>Pintura</div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.categoria-icone {
    width: 90px;
    height: 90px;
    background: #002b6b;
    border-radius: 50%;
    border: 3px solid #ffc107;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
}
.categoria-icone img {
    width: 48px;
    height: 48px;
}
</style>
@endpush
