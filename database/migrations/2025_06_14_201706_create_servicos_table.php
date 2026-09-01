<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('servicos', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->text('descricao');
        $table->enum('marca', ['Lorenzetti', 'Roca', 'Meber']);
        $table->string('codigo_interno')->nullable();
        $table->string('imagem')->nullable();
        $table->string('valor_estimado')->nullable(); // pode ser 'sob consulta'
        $table->string('prazo_medio')->nullable();
        $table->boolean('possui_garantia')->default(false);
        $table->text('info_tecnica')->nullable();
        $table->text('instrucoes_cliente')->nullable();
        $table->boolean('ativo')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicos');
    }
};
