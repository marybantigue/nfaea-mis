<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Member",
 *      required={first_name, last_name},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="first_name",
 *          description="first_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="last_name",
 *          description="last_name",
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
class Member extends Model
{
    use SoftDeletes;

    public $table = "members";
    
	protected $dates = ['deleted_at'];

    
    public $fillable = [
        "first_name",
		"last_name",
        "province_id"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "first_name" => "string",
		"last_name" => "string"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "first_name" => "required",
		"last_name" => "required",
        "province_id" => "required"
    ];

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }
    public function invoices()
    {
        return $this->belongsToMany('App\Models\Invoice')->withPivot('paid');
    }
    public function helpMembers()
    {
        return $this->belongsToMany('App\Models\HelpMembers')->withPivot('amount');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }


}
