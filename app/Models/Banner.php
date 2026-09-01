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
        if (!$this->desktop_image) return null;
        
        // Se o caminho já começa com 'img/', é um banner antigo
        if (str_starts_with($this->desktop_image, 'img/')) {
            return asset($this->desktop_image);
        }
        
        // Caso contrário, é um banner novo no storage
        return asset('storage/banners/desktop/' . $this->desktop_image);
    }

    // Método para obter o caminho completo da imagem mobile
    public function getMobileImagePathAttribute()
    {
        if (!$this->mobile_image) return null;
        
        // Se o caminho já começa com 'img/', é um banner antigo
        if (str_starts_with($this->mobile_image, 'img/')) {
            return asset($this->mobile_image);
        }
        
        // Caso contrário, é um banner novo no storage
        return asset('storage/banners/mobile/' . $this->mobile_image);
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
