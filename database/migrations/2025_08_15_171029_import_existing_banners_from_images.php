<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Limpar registros de banner existentes para evitar duplicatas
        DB::table('banners')->delete();

        // Definir os banners existentes baseados nas imagens físicas
        $bannersData = [
            [
                'titulo' => 'Banner Promocional 1',
                'desktop_image' => 'img/bannershero/desk1.webp',
                'mobile_image' => 'img/bannershero/mob1.webp',
                'ordem' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Banner Promocional 2',
                'desktop_image' => 'img/bannershero/desk2.webp',
                'mobile_image' => 'img/bannershero/mob2.webp',
                'ordem' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Banner Promocional 3',
                'desktop_image' => 'img/bannershero/desk3.webp',
                'mobile_image' => 'img/bannershero/mob3.webp',
                'ordem' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Verificar se as imagens existem antes de inserir
        foreach ($bannersData as $banner) {
            $desktopExists = file_exists(public_path($banner['desktop_image']));
            $mobileExists = file_exists(public_path($banner['mobile_image']));
            
            if ($desktopExists && $mobileExists) {
                DB::table('banners')->insert($banner);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remover apenas os banners que foram criados por esta migração
        DB::table('banners')->whereIn('desktop_image', [
            'img/bannershero/desk1.webp',
            'img/bannershero/desk2.webp',
            'img/bannershero/desk3.webp'
        ])->delete();
    }
};
