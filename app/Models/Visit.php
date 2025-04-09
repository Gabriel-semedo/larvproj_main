<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @property int $id
 * @property string $name
 * @property string $plate
 * @property integer $company
 * @property integer $user
 * @property string $entry
 * @property string|null $exit
 * @package App\Models
 */

class Visit extends Model
{
    use HasFactory;

    protected $table = 'visits';

    // Definir a chave primária
    protected $primaryKey = 'id';

    // Ativar timestamps (created_at, updated_at)
    public $timestamps = true;


    protected $fillable = [
        'name',
        'plate',
        'company',
        'user',
        'entry',
        'exit',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class, 'company', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}