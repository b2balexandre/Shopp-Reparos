<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Promocao extends Model
{
    public const FUSO = 'America/Sao_Paulo';
    public const MODO_COMPLETA = 'completa';
    public const MODO_IMAGEM = 'imagem';

    protected $table = 'promocoes';

    protected $attributes = [
        'modo' => self::MODO_COMPLETA,
    ];

    protected $fillable = [
        'modo', 'titulo', 'selo', 'descricao', 'imagem', 'produto_id', 'preco_de', 'preco_por',
        'loja_aguas_claras', 'loja_taguatinga', 'inicia_em', 'termina_em', 'destaque', 'ativo',
    ];

    protected $casts = [
        'preco_de' => 'decimal:2',
        'preco_por' => 'decimal:2',
        'loja_aguas_claras' => 'boolean',
        'loja_taguatinga' => 'boolean',
        'inicia_em' => 'date',
        'termina_em' => 'date',
        'destaque' => 'boolean',
        'ativo' => 'boolean',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public static function hoje(): Carbon
    {
        return Carbon::parse(Carbon::now(self::FUSO)->toDateString());
    }

    public function scopeVigentes(Builder $query): Builder
    {
        $hoje = self::hoje()->toDateString();

        return $query->where('ativo', true)
            ->where(fn ($q) => $q->whereNull('inicia_em')->orWhereDate('inicia_em', '<=', $hoje))
            ->where(fn ($q) => $q->whereNull('termina_em')->orWhereDate('termina_em', '>=', $hoje));
    }

    public function scopeVitrine(Builder $query): Builder
    {
        return $query->vigentes()
            ->orderByDesc('destaque')
            ->orderByRaw('termina_em is null')
            ->orderBy('termina_em')
            ->orderByDesc('id');
    }

    public function getStatusAttribute(): string
    {
        $hoje = self::hoje();

        return match (true) {
            ! $this->ativo => 'pausada',
            $this->termina_em && $this->termina_em->lt($hoje) => 'encerrada',
            $this->inicia_em && $this->inicia_em->gt($hoje) => 'agendada',
            default => 'no_ar',
        };
    }

    public function getSoImagemAttribute(): bool
    {
        return $this->modo === self::MODO_IMAGEM;
    }

    public function getDescontoAttribute(): ?int
    {
        if ($this->so_imagem || ! $this->preco_de || ! $this->preco_por || (float) $this->preco_por >= (float) $this->preco_de) {
            return null;
        }

        return (int) round((1 - (float) $this->preco_por / (float) $this->preco_de) * 100);
    }

    public function getDiasRestantesAttribute(): ?int
    {
        return $this->termina_em ? (int) self::hoje()->diffInDays($this->termina_em, false) : null;
    }

    public function getImagemUrlAttribute(): ?string
    {
        if ($this->imagem) {
            return asset('storage/promocoes/' . $this->imagem);
        }

        if ($this->produto?->imagem) {
            return asset('storage/produtos/' . basename($this->produto->imagem));
        }

        return null;
    }

    public function getImagemPropriaAttribute(): bool
    {
        return (bool) $this->imagem;
    }

    public function lojas(): array
    {
        return collect(config('lojas'))
            ->filter(fn ($loja) => $loja['slug'] === 'taguatinga' ? $this->loja_taguatinga : $this->loja_aguas_claras)
            ->values()
            ->all();
    }

    public function whatsappUrl(array $loja): string
    {
        $texto = $this->so_imagem
            ? 'Olá! Vi este panfleto de promoção no site e quero aproveitar: ' . route('promocoes.index') . '#promo-' . $this->id
            : 'Olá! Vi a promoção "' . $this->titulo . '" no site e quero aproveitar.';

        return 'https://api.whatsapp.com/send?phone=' . $loja['whatsapp'] . '&text=' . rawurlencode($texto);
    }

    public static function formatarPreco($valor): string
    {
        return 'R$ ' . number_format((float) $valor, 2, ',', '.');
    }
}
