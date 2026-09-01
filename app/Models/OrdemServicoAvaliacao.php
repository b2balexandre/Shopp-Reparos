<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServicoAvaliacao extends Model
{
    use HasFactory;
    protected $table = 'ordem_servico_avaliacoes';
    protected $fillable = ['ordem_servico_id', 'nota', 'comentario'];
    public function ordemServico() { return $this->belongsTo(OrdemServico::class); }
}
