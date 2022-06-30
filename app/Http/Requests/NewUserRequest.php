<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUserRequest extends FormRequest
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
            "user_name" => 'required', //'required|unique:users,branch_id',
            "email" => 'required',
            "name" => 'required',
            "last_name" => 'required',
            "avatar" => 'nullable',
            "password" => 'required|min:4',
            "themme_layout" => 'nullable',
            "branch_id" => 'nullable',
        ];
    }
}
