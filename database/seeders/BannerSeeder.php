<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;
use Illuminate\Support\Facades\File;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpar banners existentes para evitar duplicados
        Banner::query()->delete();
        
        // Criar banners usando as imagens existentes
        $banners = [
            [
                'titulo' => 'Promoção Torneira Elétrica',
                'desktop_image' => 'desk1.webp',
                'mobile_image' => 'mob1.webp', 
                'ordem' => 1,
                'is_active' => true
            ],
            [
                'titulo' => 'Jogo de Chaves Promoção', 
                'desktop_image' => 'desk2.webp',
                'mobile_image' => 'mob2.webp',
                'ordem' => 2, 
                'is_active' => true
            ],
            [
                'titulo' => 'Thinner em Oferta',
                'desktop_image' => 'desk3.webp', 
                'mobile_image' => 'mob3.webp',
                'ordem' => 3,
                'is_active' => true
            ]
        ];

        foreach ($banners as $bannerData) {
            Banner::create($bannerData);
        }

        echo "Banners limpos e recriados com sucesso!\n";
    }
}
