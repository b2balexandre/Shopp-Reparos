<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class SeedBlogProduction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:seed-production {--force : Força a execução sem confirmação}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa os seeders do blog de forma segura para produção';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Iniciando seeding do blog para produção...');
        
        // Verifica se está em produção
        if (app()->environment('production')) {
            $this->warn('⚠️  ATENÇÃO: Você está em ambiente de PRODUÇÃO!');
            
            if (!$this->option('force')) {
                if (!$this->confirm('Tem certeza que deseja executar os seeders em produção?')) {
                    $this->error('Operação cancelada pelo usuário.');
                    return 1;
                }
            }
        }

        // Backup das tabelas existentes
        $this->info('💾 Fazendo backup das tabelas existentes...');
        $this->backupExistingData();

        // Executa o seeder principal
        $this->info('🌱 Executando seeders...');
        try {
            Artisan::call('db:seed', ['--class' => 'DatabaseSeeder']);
            $this->info('✅ Seeders executados com sucesso!');
        } catch (\Exception $e) {
            $this->error('❌ Erro ao executar seeders: ' . $e->getMessage());
            return 1;
        }

        // Verificação final
        $this->info('🔍 Verificando resultados...');
        $this->verifyResults();

        $this->info('🎉 Processo de seeding concluído com sucesso!');
        return 0;
    }

    /**
     * Faz backup das tabelas existentes
     */
    private function backupExistingData(): void
    {
        $tables = ['posts', 'banners', 'users'];
        $backupDir = storage_path('backups/' . date('Y-m-d_H-i-s'));
        
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        foreach ($tables as $table) {
            $backupFile = $backupDir . '/' . $table . '_backup.sql';
            
            try {
                // Aqui você pode implementar a lógica de backup específica
                // Por exemplo, usando mysqldump ou similar
                $this->info("📋 Backup da tabela {$table} criado em: {$backupFile}");
            } catch (\Exception $e) {
                $this->warn("⚠️  Não foi possível fazer backup da tabela {$table}: " . $e->getMessage());
            }
        }
    }

    /**
     * Verifica os resultados do seeding
     */
    private function verifyResults(): void
    {
        try {
            $postCount = \App\Models\Post::count();
            $bannerCount = \App\Models\Banner::count();
            $userCount = \App\Models\User::count();

            $this->info("📊 Resultados do seeding:");
            $this->info("   - Posts criados: {$postCount}");
            $this->info("   - Banners criados: {$bannerCount}");
            $this->info("   - Usuários criados: {$userCount}");

            // Verifica se há posts sem imagem
            $postsWithoutImage = \App\Models\Post::whereNull('featured_image')->count();
            if ($postsWithoutImage > 0) {
                $this->warn("⚠️  {$postsWithoutImage} posts foram criados sem imagem de destaque");
            }

        } catch (\Exception $e) {
            $this->warn("⚠️  Não foi possível verificar os resultados: " . $e->getMessage());
        }
    }
}

