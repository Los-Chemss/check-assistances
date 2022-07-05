<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"=>'required',
            "lastname"=>'required',
            "address"=>'nullable',
            "province"=>'nullable',
            "postcode"=>'nullable',
            "phone"=>'nullable',
            "code"=>'required',
            "income"=>'required',
            "membership"=>'required',
            // "company_id"=>'required',
            // "registered_on_branch_id"=>'required',
        ];
    }
}
