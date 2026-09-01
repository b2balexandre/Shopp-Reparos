<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        // Teste com um post simples
        try {
            $post = Post::create([
                'title' => 'Post de Teste - Shopp Reparos',
                'slug' => 'post-teste-shopp-reparos',
                'excerpt' => 'Este é um post de teste para verificar se o seeder está funcionando corretamente.',
                'content' => '<h2>Introdução</h2><p>Este é um post de teste para verificar se o seeder está funcionando corretamente.</p>',
                'featured_image' => 'blog/ferramentas-basicas-casa.jpg',
                'meta_title' => 'Post de Teste - Shopp Reparos',
                'meta_description' => 'Este é um post de teste para verificar se o seeder está funcionando corretamente.',
                'meta_keywords' => ['teste', 'seeder', 'shopp reparos'],
                'author_name' => 'Equipe Shopp Reparos',
                'category' => 'teste',
                'tags' => ['Teste', 'Seeder'],
                'published' => true,
                'published_at' => Carbon::now(),
                'views' => 0,
                'reading_time' => 1
            ]);
            
            echo "Post de teste criado com sucesso! ID: " . $post->id . "\n";
            
        } catch (\Exception $e) {
            echo "Erro ao criar post de teste: " . $e->getMessage() . "\n";
            echo "Linha: " . $e->getLine() . "\n";
            echo "Arquivo: " . $e->getFile() . "\n";
        }
    }
}
