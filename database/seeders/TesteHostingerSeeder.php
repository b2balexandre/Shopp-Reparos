<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TesteHostingerSeeder extends Seeder
{
    public function run(): void
    {
        echo "Iniciando teste no Hostinger...\n";
        
        try {
            // Teste 1: Verificar se consegue criar post simples
            $post = Post::create([
                'title' => 'Teste Hostinger - ' . date('Y-m-d H:i:s'),
                'slug' => 'teste-hostinger-' . time(),
                'excerpt' => 'Post de teste para verificar funcionamento no Hostinger',
                'content' => '<h2>Teste</h2><p>Este é um post de teste para verificar se o seeder está funcionando no Hostinger.</p>',
                'featured_image' => 'blog/teste.jpg',
                'meta_title' => 'Teste Hostinger',
                'meta_description' => 'Post de teste',
                'meta_keywords' => ['teste', 'hostinger'],
                'author_name' => 'Teste',
                'category' => 'teste',
                'tags' => ['Teste'],
                'published' => true,
                'published_at' => Carbon::now(),
                'views' => 0,
                'reading_time' => 1
            ]);
            
            echo "✅ Post de teste criado com sucesso! ID: " . $post->id . "\n";
            
            // Teste 2: Verificar se consegue contar posts
            $totalPosts = Post::count();
            echo "✅ Total de posts na tabela: " . $totalPosts . "\n";
            
            // Teste 3: Verificar se consegue buscar posts
            $posts = Post::take(5)->get();
            echo "✅ Posts encontrados: " . $posts->count() . "\n";
            
        } catch (\Exception $e) {
            echo "❌ ERRO: " . $e->getMessage() . "\n";
            echo "📍 Linha: " . $e->getLine() . "\n";
            echo "📁 Arquivo: " . $e->getFile() . "\n";
            echo "🔍 Trace: " . $e->getTraceAsString() . "\n";
        }
        
        echo "Teste concluído!\n";
    }
}
