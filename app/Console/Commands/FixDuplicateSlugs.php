<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Produto;
use Illuminate\Support\Str;

class FixDuplicateSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:duplicate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Corrige slugs duplicados na tabela de produtos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Iniciando correção de slugs duplicados...');

        $duplicates = Produto::select('slug')
            ->groupBy('slug')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        if ($duplicates->isEmpty()) {
            $this->info('✅ Nenhum slug duplicado encontrado!');
            return 0;
        }

        $this->warn("⚠️  Encontrados {$duplicates->count()} slugs duplicados.");

        foreach ($duplicates as $duplicate) {
            $this->info("Corrigindo slug: {$duplicate->slug}");
            
            $products = Produto::where('slug', $duplicate->slug)
                ->orderBy('id')
                ->get();

            // Manter o primeiro produto com o slug original
            $firstProduct = $products->first();
            $this->line("  - Produto ID {$firstProduct->id} mantém slug: {$firstProduct->slug}");

            // Corrigir os demais produtos
            foreach ($products->slice(1) as $product) {
                $oldSlug = $product->slug;
                $product->slug = null; // Força regeneração do slug
                $product->save();
                
                $this->line("  - Produto ID {$product->id} novo slug: {$product->slug}");
            }
        }

        $this->info('✅ Slugs duplicados corrigidos com sucesso!');
        return 0;
    }
}
