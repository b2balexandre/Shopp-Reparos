<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServicoStatus extends Model
{
    use HasFactory;
    protected $fillable = ['ordem_servico_id', 'status', 'observacao'];
    public function ordemServico() { return $this->belongsTo(OrdemServico::class); }
}
