<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Transcation
 * @package App\Models
 * @version April 12, 2022, 11:45 am UTC
 *
 * @property boolean $type
 * @property integer $amount
 * @property integer $account_id
 * @property integer $category_id
 * @property integer $mode_id
 * @property string $date_time
 * @property string $description
 */
class Transcation extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'transcations';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'created_by',
        'type',
        'amount',
        'account_id',
        'category_id',
        'mode_id',
        'date',
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
        'type' => 'boolean',
        'amount' => 'integer',
        'account_id' => 'integer',
        'category_id' => 'integer',
        'mode_id' => 'integer',
        'date' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'created_by' => 'nullable',
        'type' => 'required',
        'amount' => 'required',
        'account_id' => 'required',
        'category_id' => 'required',
        'mode_id' => 'required',
        'date' => 'required'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Mode::class, 'category_id', 'id');
    }
    public function mode()
    {
        return $this->belongsTo(Mode::class, 'mode_id', 'id');
    }
}
