<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;
    protected $fillable = [
        'cliente_nome', 'cliente_telefone', 'endereco', 'servico', 'descricao_problema',
        'data_agendada', 'tecnico_id', 'status', 'data_conclusao'
    ];

    public function statusHistorico() { return $this->hasMany(OrdemServicoStatus::class); }
    public function comentarios() { return $this->hasMany(OrdemServicoComentario::class); }
    public function fotos() { return $this->hasMany(OrdemServicoFoto::class); }
    public function avaliacao() { return $this->hasOne(OrdemServicoAvaliacao::class); }
}
