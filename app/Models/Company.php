<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $e_id
 * @property string $name
 * @package App\Models
 */
class Company extends Model
{
    use HasFactory;

    // Defining the table name in the database
    protected $table = 'companies';
    // Define the primary key
    protected $primaryKey = 'id';

    // Enable timestamps (created_at, updated_at) unless disabled
    public $timestamps = true;

    // Define the fields that can be mass-assigned
    protected $fillable = [
        'name',  // company name
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
