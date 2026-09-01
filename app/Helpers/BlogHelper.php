<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class BlogHelper
{
    /**
     * Retorna a URL correta para a imagem do blog
     * Compatível com sistema antigo (public/img/blog) e novo (storage)
     */
    public static function getImageUrl($featuredImage)
    {
        if (!$featuredImage) {
            return null;
        }

        // Sistema antigo: public/img/blog/
        if (str_starts_with($featuredImage, 'img/blog/')) {
            return asset($featuredImage);
        }

        // Sistema novo: storage/blog/
        if (str_starts_with($featuredImage, 'blog/')) {
            // Usa caminho público padrão via symlink: public/storage/blog/...
            return asset('storage/' . $featuredImage);
        }

        // Fallback para o sistema antigo
        return asset($featuredImage);
    }

    /**
     * Verifica se a imagem existe
     */
    public static function imageExists($featuredImage)
    {
        if (!$featuredImage) {
            return false;
        }

        // Sistema antigo: public/img/blog/
        if (str_starts_with($featuredImage, 'img/blog/')) {
            return file_exists(public_path($featuredImage));
        }

        // Sistema novo: storage/blog/
        if (str_starts_with($featuredImage, 'blog/')) {
            return Storage::disk('public')->exists($featuredImage);
        }

        // Fallback para o sistema antigo
        return file_exists(public_path($featuredImage));
    }
}
