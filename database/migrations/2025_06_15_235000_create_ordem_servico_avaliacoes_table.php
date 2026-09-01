<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('ordem_servico_avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordem_servico_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('nota');
            $table->string('comentario')->nullable();
            $table->timestamps();
            $table->foreign('ordem_servico_id')->references('id')->on('ordem_servicos')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
    public function down() {
        Schema::dropIfExists('ordem_servico_avaliacoes');
    }
};
