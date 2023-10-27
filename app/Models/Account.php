<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Account
 * @package App\Models
 * @version April 12, 2022, 8:45 am UTC
 *
 * @property string $name
 * @property string $description
 */
class Account extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'accounts';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'is_default',
        'created_by',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'created_by' => 'integer',
        'name' => 'string', 
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        // 'type' => 'required'
    ];

    
}
