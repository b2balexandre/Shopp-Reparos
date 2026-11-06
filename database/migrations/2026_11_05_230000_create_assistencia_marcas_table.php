<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assistencia_marcas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('texto')->nullable();
            $table->string('imagem')->nullable();
            $table->unsignedInteger('ordem')->default(1);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        $agora = now();
        DB::table('assistencia_marcas')->insert([
            [
                'nome' => 'Docol',
                'texto' => 'Assistência técnica Docol, com peças e atendimento especializado.',
                'imagem' => null,
                'ordem' => 1,
                'ativo' => true,
                'created_at' => $agora,
                'updated_at' => $agora,
            ],
            [
                'nome' => 'Lorenzetti',
                'texto' => 'Assistência técnica especializada Lorenzetti.',
                'imagem' => 'img/assistencia/lorenzetti/01.jpg',
                'ordem' => 2,
                'ativo' => true,
                'created_at' => $agora,
                'updated_at' => $agora,
            ],
            [
                'nome' => 'Meber',
                'texto' => 'Atendimento especializado Meber.',
                'imagem' => 'img/assistencia/meber/01.png',
                'ordem' => 3,
                'ativo' => true,
                'created_at' => $agora,
                'updated_at' => $agora,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('assistencia_marcas');
    }
};
