<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\invoices_members;

class Updateinvoices_membersRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return invoices_members::$rules;
    }
}
