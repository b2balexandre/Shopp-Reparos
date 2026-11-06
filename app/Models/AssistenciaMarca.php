<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssistenciaMarca extends Model
{
    protected $fillable = [
        'nome',
        'texto',
        'imagem',
        'ordem',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public static function ativas()
    {
        return static::query()->where('ativo', true)->orderBy('ordem')->orderBy('id')->get();
    }

    public static function frase($marcas = null): string
    {
        $marcas = $marcas ?? static::ativas();
        $temDocol = $marcas->contains(fn ($marca) => strcasecmp($marca->nome, 'Docol') === 0);
        $outros = $marcas->pluck('nome')->reject(fn ($nome) => strcasecmp($nome, 'Docol') === 0)->values();

        if ($temDocol) {
            return 'Temos assistência técnica Docol' . ($outros->isNotEmpty() ? ', além de ' . $outros->join(', ', ' e ') : '') . '.';
        }

        if ($marcas->isNotEmpty()) {
            return 'Assistência técnica ' . $marcas->pluck('nome')->join(', ', ' e ') . '.';
        }

        return 'Assistência técnica especializada.';
    }

    public function getImagemUrlAttribute(): ?string
    {
        if (!$this->imagem) {
            return null;
        }

        if (str_starts_with($this->imagem, 'img/') || str_starts_with($this->imagem, 'storage/')) {
            return asset($this->imagem);
        }

        return asset('storage/assistencias/' . $this->imagem);
    }
}
