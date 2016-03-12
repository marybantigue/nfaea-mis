<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\help_members;

class Createhelp_membersRequest extends Request {

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
        return help_members::$rules;
    }
}
