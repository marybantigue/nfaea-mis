<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="invoice",
 *      required={account_type},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="total_amount",
 *          description="total_amount",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="account_type",
 *          description="account_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
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
class invoice extends Model
{
    use SoftDeletes;

    public $table = "invoices";
    
	protected $dates = ['deleted_at'];

    
    public $fillable = [
        "total_amount",
		"account_type",
		"status",
        "province_id"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "account_type" => "string",
		"status" => "string"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "total_amount" => "min:1",
		"account_type" => "required"
    ];
    
    
     public function province()
    {
        return $this->belongsToMany('App\Models\Province')->withPivot('remarks','id', 'status');
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\Member')->withPivot('paid');
    }

    public function helpMembers()
    {
        return $this->belongsToMany('App\Models\Member', 'help_members', 'invoice_id', 'member_id')->withPivot('amount');
    }
}
