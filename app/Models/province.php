<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="province",
 *      required={name},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class province extends Model
{
    use SoftDeletes;

    public $table = "provinces";
    
	protected $dates = ['deleted_at'];

    
    public $fillable = [
        "name"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "name" => "string"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "name" => "required"
    ];

    public function members()
    {
        return $this->hasMany('App\Models\Member');
    }

     public function invoices()
    {
        return $this->belongsToMany('App\Models\Invoice')->withPivot('remarks','id', 'status');
    }

    public function user()
    {
         return $this->hasMany('App\User');
    }
}
