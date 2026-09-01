<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Produto;
use Illuminate\Support\Str;

class TestSlugGeneration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:slug-generation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testa a geração de slugs únicos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Testando geração de slugs únicos...');

        // Teste 1: Produto com nome simples
        $this->info("\n1. Testando produto com nome simples:");
        $produto1 = new Produto(['nome' => 'Medidor de Distância']);
        $slug1 = $produto1->generateUniqueSlug();
        $this->line("   Nome: Medidor de Distância");
        $this->line("   Slug gerado: {$slug1}");

        // Teste 2: Produto com nome similar (deve gerar slug diferente)
        $this->info("\n2. Testando produto com nome similar:");
        $produto2 = new Produto(['nome' => 'Medidor de Distância']);
        $slug2 = $produto2->generateUniqueSlug();
        $this->line("   Nome: Medidor de Distância");
        $this->line("   Slug gerado: {$slug2}");

        // Teste 3: Verificar se já existe um produto com esse nome
        $existingProduct = Produto::where('nome', 'Medidor de Distância')->first();
        if ($existingProduct) {
            $this->warn("   ⚠️  Já existe um produto com este nome (ID: {$existingProduct->id})");
            $this->line("   Slug atual: {$existingProduct->slug}");
        } else {
            $this->info("   ✅ Nenhum produto existente com este nome");
        }

        // Teste 4: Simular criação de múltiplos produtos
        $this->info("\n3. Simulando criação de múltiplos produtos:");
        $nomes = [
            'Medidor de Distância',
            'Medidor de Distância',
            'Medidor de Distância',
            'Medidor de Distância'
        ];

        foreach ($nomes as $index => $nome) {
            $produto = new Produto(['nome' => $nome]);
            $slug = $produto->generateUniqueSlug();
            $this->line("   Produto " . ($index + 1) . ": {$nome} -> {$slug}");
        }

        $this->info("\n✅ Teste de geração de slugs concluído!");
        return 0;
    }
}
