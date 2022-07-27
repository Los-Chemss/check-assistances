<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
       /*  return [
            'quantity' => 'required|>0',
            'product_id' => 'required'
        ]; */
    }

    /* public function messages()
    {
        return [
            'quantity.required' => 'Ingrese un valor de cantidad valido',
            'product_id.required' => 'Seleccione un producto',
        ];
    } */
}
