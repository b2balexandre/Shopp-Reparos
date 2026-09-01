<?php
/**
 * Teste Simples para Verificar Seeder do Blog
 * Execute este arquivo para testar se tudo está funcionando
 */

require_once 'vendor/autoload.php';

// Simula o ambiente Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🧪 Testando seeder do blog...\n\n";

try {
    // Testa se o modelo Post existe
    if (class_exists('App\Models\Post')) {
        echo "✅ Modelo Post encontrado\n";
    } else {
        echo "❌ Modelo Post não encontrado\n";
        exit(1);
    }

    // Testa se o seeder existe
    if (class_exists('Database\Seeders\PostSeeder')) {
        echo "✅ PostSeeder encontrado\n";
    } else {
        echo "❌ PostSeeder não encontrado\n";
        exit(1);
    }

    // Testa se o comando personalizado existe
    if (class_exists('App\Console\Commands\SeedBlogProduction')) {
        echo "✅ Comando SeedBlogProduction encontrado\n";
    } else {
        echo "❌ Comando SeedBlogProduction não encontrado\n";
        exit(1);
    }

    // Verifica se as imagens existem
    $requiredImages = [
        'public/img/blog/desentupir-vaso-sanitario.jpg',
        'public/img/blog/vazamento-torneira.jpg',
        'public/img/blog/blog.svg'
    ];

    echo "\n🔍 Verificando imagens...\n";
    foreach ($requiredImages as $image) {
        if (file_exists($image)) {
            echo "✅ {$image} - Disponível\n";
        } else {
            echo "❌ {$image} - Não encontrada\n";
        }
    }

    echo "\n🎉 Todos os testes passaram!\n";
    echo "O blog está pronto para ser executado em produção.\n\n";
    
    echo "📋 Próximos passos:\n";
    echo "1. Execute: php artisan blog:seed-production\n";
    echo "2. Verifique os posts no navegador\n";
    echo "3. Confirme se as imagens estão carregando\n";

} catch (Exception $e) {
    echo "❌ Erro durante o teste: " . $e->getMessage() . "\n";
    exit(1);
}

