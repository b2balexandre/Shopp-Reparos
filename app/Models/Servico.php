<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'marca',
        'codigo_interno',
        'imagem',
        'valor_estimado',
        'prazo_medio',
        'possui_garantia',
        'info_tecnica',
        'instrucoes_cliente',
        'ativo',
        'slug',
        'loja_aguas_claras',
        'loja_taguatinga',
    ];

    protected $casts = [
        'possui_garantia' => 'boolean',
        'ativo' => 'boolean',
        'loja_aguas_claras' => 'boolean',
        'loja_taguatinga' => 'boolean',
    ];

    public function scopeNaLoja($query, string $slug)
    {
        $coluna = $slug === 'taguatinga' ? 'loja_taguatinga' : 'loja_aguas_claras';

        return $query->where($coluna, true);
    }

    protected static function booted()
    {
        static::saving(function ($servico) {
            if (empty($servico->slug) && !empty($servico->titulo)) {
                $servico->slug = $servico->generateUniqueSlug();
            }
        });
    }

    /**
     * Gera um slug único baseado no título do serviço
     */
    public function generateUniqueSlug()
    {
        $baseSlug = Str::slug($this->titulo);
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
