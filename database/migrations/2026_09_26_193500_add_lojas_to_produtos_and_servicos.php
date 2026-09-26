<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->boolean('loja_aguas_claras')->default(true)->after('preco');
            $table->boolean('loja_taguatinga')->default(true)->after('loja_aguas_claras');
        });

        Schema::table('servicos', function (Blueprint $table) {
            $table->boolean('loja_aguas_claras')->default(true)->after('ativo');
            $table->boolean('loja_taguatinga')->default(true)->after('loja_aguas_claras');
        });
    }

    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn(['loja_aguas_claras', 'loja_taguatinga']);
        });

        Schema::table('servicos', function (Blueprint $table) {
            $table->dropColumn(['loja_aguas_claras', 'loja_taguatinga']);
        });
    }
};
