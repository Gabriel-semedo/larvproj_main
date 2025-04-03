<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



/**
 * 
 * @property int $v_id
 * @property string $nome
 * @property string $matricula
 * @property integer $empresa
 * @property integer $segurança
 * @property string $entrada
 * @property string|null $saida
 * @package App\Models
 */

class Visitas extends Model
{
    use HasFactory;

    protected $table = 'visitas'; 

    // Definir a chave primária
    protected $primaryKey = 'v_id';

    // Ativar timestamps (created_at, updated_at)
    public $timestamps = true;


    protected $fillable = [
        'nome',
        'matricula',
        'empresa',
        'segurança',
        'entrada',
        'saida',
    ];

    
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa', 'e_id');
    }


    public function segurança()
    {
        return $this->belongsTo(Seguranca::class, 'segurança', 's_id');
    }
}
