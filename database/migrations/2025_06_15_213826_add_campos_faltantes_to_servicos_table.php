<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('servicos', function (Blueprint $table) {
            if (!Schema::hasColumn('servicos', 'info_tecnica')) {
                $table->text('info_tecnica')->nullable();
            }
            if (!Schema::hasColumn('servicos', 'instrucoes_cliente')) {
                $table->text('instrucoes_cliente')->nullable();
            }
            if (!Schema::hasColumn('servicos', 'ativo')) {
                $table->boolean('ativo')->default(true);
            }
            // $table->string('codigo_interno')->nullable(); // coluna já existe
            // $table->string('imagem')->nullable(); // coluna já existe
            // $table->string('valor_estimado')->nullable(); // coluna já existe
            // $table->string('prazo_medio')->nullable(); // coluna já existe
            // $table->boolean('possui_garantia')->default(false); // coluna já existe
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicos', function (Blueprint $table) {
            // $table->dropColumn('codigo_interno'); // coluna já existe
            // $table->dropColumn('imagem'); // coluna já existe
            // $table->dropColumn('valor_estimado'); // coluna já existe
            // $table->dropColumn('prazo_medio'); // coluna já existe
            // $table->dropColumn('possui_garantia'); // coluna já existe
        });
    }
};
