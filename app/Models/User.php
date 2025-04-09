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

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    // Definir a chave primária
    protected $primaryKey = 'id';

    // Ativar timestamps (created_at, updated_at)
    public $timestamps = false;


    protected $fillable = [
        'name',
        
    ];
    /**
     * Relationship of a company with visits.
     * A company can have multiple visits recorded.
     */
    public function visits()
    {
        return $this->hasMany(Visit::class, 'company', 'id');
    }


}
