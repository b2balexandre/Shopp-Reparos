<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'descricao', 'imagem', 'categoria_id', 'preco', 'slug'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    protected static function booted()
    {
        static::saving(function ($produto) {
            if (empty($produto->slug) && !empty($produto->nome)) {
                $produto->slug = $produto->generateUniqueSlug();
            }
        });
    }

    /**
     * Gera um slug único baseado no nome do produto
     */
    public function generateUniqueSlug()
    {
        $baseSlug = Str::slug($this->nome);
        $slug = $baseSlug;
        $counter = 1;

        // Verifica se o slug já existe
        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
