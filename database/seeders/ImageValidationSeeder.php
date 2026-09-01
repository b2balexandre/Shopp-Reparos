<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageValidationSeeder extends Seeder
{
    /**
     * Executa a validação e preparação das imagens
     */
    public function run(): void
    {
        $this->command->info('🔍 Validando imagens do blog...');
        
        // Lista de imagens necessárias para o blog
        $requiredImages = [
            'img/blog/desentupir-vaso-sanitario.jpg',
            'img/blog/vazamento-torneira.jpg',
            'img/blog/trocar-registro-gaveta.jpg',
            'img/blog/limpeza-caixa-agua.jpg',
            'img/blog/pressao-agua-baixa.jpg',
            'img/blog/chuveiro-nao-esquenta.jpg',
            'img/blog/trocar-interruptor-luz.jpg',
            'img/blog/ferramentas-basicas-casa.jpg',
            'img/blog/como-pintar-parede.jpg',
            'img/blog/manutencao-preventiva-cronograma.jpg',
        ];

        // Imagens de fallback
        $fallbackImages = [
            'img/blog/blog.svg',
            'img/blog.svg',
            'img/iconfav.png'
        ];

        $missingImages = [];
        $availableImages = [];

        // Verifica imagens principais
        foreach ($requiredImages as $imagePath) {
            if (File::exists(public_path($imagePath))) {
                $availableImages[] = $imagePath;
                $this->command->info("✅ {$imagePath} - Disponível");
            } else {
                $missingImages[] = $imagePath;
                $this->command->warn("❌ {$imagePath} - Não encontrada");
            }
        }

        // Verifica imagens de fallback
        $this->command->info("\n🔍 Verificando imagens de fallback...");
        foreach ($fallbackImages as $fallbackPath) {
            if (File::exists(public_path($fallbackPath))) {
                $this->command->info("✅ {$fallbackPath} - Disponível como fallback");
            } else {
                $this->command->warn("⚠️ {$fallbackPath} - Fallback não encontrado");
            }
        }

        // Relatório final
        $this->command->info("\n📊 RELATÓRIO DE VALIDAÇÃO:");
        $this->command->info("Total de imagens necessárias: " . count($requiredImages));
        $this->command->info("Imagens disponíveis: " . count($availableImages));
        $this->command->info("Imagens em falta: " . count($missingImages));

        if (count($missingImages) > 0) {
            $this->command->warn("\n⚠️ ATENÇÃO: Algumas imagens estão em falta!");
            $this->command->warn("Os posts serão criados com imagens de fallback ou sem imagem.");
            $this->command->warn("Para melhor experiência, considere adicionar as imagens em falta.");
        } else {
            $this->command->info("\n🎉 Todas as imagens estão disponíveis!");
        }

        // Cria diretório de imagens se não existir
        $this->ensureImageDirectories();
    }

    /**
     * Garante que os diretórios de imagens existam
     */
    private function ensureImageDirectories(): void
    {
        $directories = [
            public_path('img'),
            public_path('img/blog'),
        ];

        foreach ($directories as $directory) {
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
                $this->command->info("📁 Diretório criado: {$directory}");
            }
        }
    }
}

