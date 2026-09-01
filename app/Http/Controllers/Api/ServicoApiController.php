<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicoApiController extends Controller
{
    public function index()
    {
        $servicos = Servico::where('ativo', 1)->orderBy('created_at', 'desc')->get();
        return response()->json($servicos);
    }
}
