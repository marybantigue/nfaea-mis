<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="InvoiceMember",
 *      required={},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="member_id",
 *          description="member_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="invoice_id",
 *          description="invoice_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="paid",
 *          description="paid",
 *          type="boolean"
 *      )
 * )
 */
class InvoiceMember extends Model
{
    use SoftDeletes;

    public $table = "invoice_member";
    
	protected $dates = ['deleted_at'];

    
    public $fillable = [
        "member_id",
		"invoice_id",
		"paid",
		"created_at",
		"updated_at"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
		"member_id" => "integer",
		"invoice_id" => "integer",
		"paid" => "boolean"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
