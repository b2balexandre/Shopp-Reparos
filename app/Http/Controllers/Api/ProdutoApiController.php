<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoApiController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->orderBy('nome')->get();
        
        return response()->json($produtos);
    }
}
