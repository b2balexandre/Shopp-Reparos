<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoriaApiController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Log da requisição para debug
            \Log::info('Requisição recebida:', [
                'dados' => $request->all(),
                'headers' => $request->headers->all()
            ]);

            $request->validate([
                'nome' => 'required|string|max:255|unique:categorias,nome',
            ]);

            $categoria = Categoria::create([
                'nome' => $request->nome,
            ]);

            \Log::info('Categoria criada:', ['categoria' => $categoria]);

            return response()->json([
                'success' => true,
                'id' => $categoria->id,
                'nome' => $categoria->nome,
                'message' => 'Categoria criada com sucesso!'
            ]);

        } catch (ValidationException $e) {
            \Log::error('Erro de validação:', $e->validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first(),
                'errors' => $e->validator->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Erro interno:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Erro interno: ' . $e->getMessage()
            ], 500);
        }
    }
}
