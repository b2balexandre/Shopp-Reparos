<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServicoApiController;
use App\Http\Controllers\Api\CategoriaApiController;
use App\Http\Controllers\Api\ProdutoApiController;

Route::get('/servicos', [ServicoApiController::class, 'index']);
Route::get('/produtos', [ProdutoApiController::class, 'index']);
Route::post('/categorias', [CategoriaApiController::class, 'store']);
