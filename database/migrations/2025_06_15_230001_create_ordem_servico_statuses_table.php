<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('ordem_servico_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordem_servico_id');
            $table->string('status');
            $table->text('observacao')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('ordem_servico_id')->references('id')->on('ordem_servicos')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }
    public function down() {
        Schema::dropIfExists('ordem_servico_statuses');
    }
};
