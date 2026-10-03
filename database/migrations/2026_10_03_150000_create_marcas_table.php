<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->timestamps();
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->foreignId('marca_id')->nullable()->after('marca')->constrained('marcas')->nullOnDelete();
        });

        $canonicas = [];
        $produtos = DB::table('produtos')->whereNotNull('marca')->where('marca', '!=', '')->orderBy('id')->get(['id', 'marca']);

        foreach ($produtos as $produto) {
            $nome = trim((string) $produto->marca);
            $chave = mb_strtolower($nome);
            if (! isset($canonicas[$chave])) {
                $canonicas[$chave] = [
                    'id' => DB::table('marcas')->insertGetId([
                        'nome' => $nome,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]),
                    'nome' => $nome,
                ];
            }

            DB::table('produtos')->where('id', $produto->id)->update([
                'marca_id' => $canonicas[$chave]['id'],
                'marca' => $canonicas[$chave]['nome'],
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('marca_id');
        });

        Schema::dropIfExists('marcas');
    }
};
