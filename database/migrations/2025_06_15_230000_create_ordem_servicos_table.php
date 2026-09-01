<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->id();
            $table->string('cliente_nome');
            $table->string('cliente_telefone')->nullable();
            $table->string('endereco');
            $table->string('servico');
            $table->text('descricao_problema')->nullable();
            $table->dateTime('data_agendada')->nullable();
            $table->unsignedBigInteger('tecnico_id')->nullable();
            $table->string('status')->default('Aberto');
            $table->dateTime('data_conclusao')->nullable();
            $table->timestamps();
            $table->foreign('tecnico_id')->references('id')->on('users')->nullOnDelete();
        });
    }
    public function down() {
        Schema::dropIfExists('ordem_servicos');
    }
};
