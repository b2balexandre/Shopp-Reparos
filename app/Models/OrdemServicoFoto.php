<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServicoFoto extends Model
{
    use HasFactory;
    protected $fillable = ['ordem_servico_id', 'caminho', 'descricao'];
    public function ordemServico() { return $this->belongsTo(OrdemServico::class); }
}
