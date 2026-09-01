<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Servico;
use Illuminate\Support\Facades\DB;

class CleanDuplicateServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'services:clean-duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove serviços duplicados baseado no título';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Procurando por serviços duplicados...');
        
        // Encontrar títulos duplicados
        $duplicates = DB::table('servicos')
            ->select('titulo', DB::raw('COUNT(*) as count'))
            ->groupBy('titulo')
            ->having('count', '>', 1)
            ->get();
        
        if ($duplicates->isEmpty()) {
            $this->info('✅ Nenhum serviço duplicado encontrado!');
            return;
        }
        
        $this->warn("⚠️  Encontrados {$duplicates->count()} títulos duplicados:");
        
        foreach ($duplicates as $duplicate) {
            $this->line("   - {$duplicate->titulo} ({$duplicate->count} ocorrências)");
        }
        
        if ($this->confirm('Deseja remover os serviços duplicados?')) {
            $this->info('🗑️  Removendo serviços duplicados...');
            
            $totalRemoved = 0;
            
            foreach ($duplicates as $duplicate) {
                // Manter o primeiro e remover os outros
                $servicesToRemove = Servico::where('titulo', $duplicate->titulo)
                    ->orderBy('id')
                    ->skip(1)
                    ->take($duplicate->count - 1)
                    ->get();
                
                foreach ($servicesToRemove as $service) {
                    $this->line("   Removendo: {$service->titulo} (ID: {$service->id})");
                    $service->delete();
                    $totalRemoved++;
                }
            }
            
            $this->info("✅ {$totalRemoved} serviços duplicados foram removidos!");
        } else {
            $this->info('❌ Operação cancelada pelo usuário.');
        }
    }
}
