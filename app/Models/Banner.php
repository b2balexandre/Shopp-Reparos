<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titulo',
        'desktop_image',
        'mobile_image',
        'desktop_old_image',
        'mobile_old_image',
        'is_active',
        'ordem'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at'
    ];

    // Método para obter o banner ativo (compatibilidade)
    public static function getActive()
    {
        return self::where('is_active', true)->orderBy('ordem')->first();
    }

    // Método para obter todos os banners ativos ordenados
    public static function getActiveAll()
    {
        return self::where('is_active', true)->orderBy('ordem')->get();
    }

    // Método para obter o caminho completo da imagem desktop
    public function getDesktopImagePathAttribute()
    {
        return $this->resolverImagem($this->desktop_image, 'desktop');
    }

    public function getMobileImagePathAttribute()
    {
        return $this->resolverImagem($this->mobile_image, 'mobile');
    }

    private function resolverImagem(?string $arquivo, string $tipo): ?string
    {
        if (!$arquivo) {
            return null;
        }

        if (str_starts_with($arquivo, 'img/') || str_starts_with($arquivo, 'storage/')) {
            return asset($arquivo);
        }

        $storage = "storage/banners/{$tipo}/{$arquivo}";
        if (is_file(public_path($storage))) {
            return asset($storage);
        }

        $hero = "img/bannershero/{$arquivo}";
        if (is_file(public_path($hero))) {
            return asset($hero);
        }

        return asset($storage);
    }

    // Método para obter o caminho completo da imagem desktop antiga
    public function getDesktopOldImagePathAttribute()
    {
        return $this->desktop_old_image ? asset('storage/banners/history/desktop/' . $this->desktop_old_image) : null;
    }

    // Método para obter o caminho completo da imagem mobile antiga
    public function getMobileOldImagePathAttribute()
    {
        return $this->mobile_old_image ? asset('storage/banners/history/mobile/' . $this->mobile_old_image) : null;
    }
}
