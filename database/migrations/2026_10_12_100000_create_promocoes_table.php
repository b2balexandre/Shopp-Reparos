<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promocoes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('selo', 40)->nullable();
            $table->text('descricao')->nullable();
            $table->string('imagem')->nullable();
            $table->foreignId('produto_id')->nullable()->constrained('produtos')->nullOnDelete();
            $table->decimal('preco_de', 10, 2)->nullable();
            $table->decimal('preco_por', 10, 2)->nullable();
            $table->boolean('loja_aguas_claras')->default(true);
            $table->boolean('loja_taguatinga')->default(true);
            $table->date('inicia_em')->nullable();
            $table->date('termina_em')->nullable();
            $table->boolean('destaque')->default(false);
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->index(['ativo', 'inicia_em', 'termina_em']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promocoes');
    }
};
