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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->string('author_name')->default('Shopp Reparos');
            $table->string('category');
            $table->json('tags')->nullable();
            $table->boolean('published')->default(false);
            $table->datetime('published_at')->nullable();
            $table->integer('views')->default(0);
            $table->integer('reading_time')->nullable(); // em minutos
            $table->timestamps();
            
            $table->index(['published', 'published_at']);
            $table->index('category');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};