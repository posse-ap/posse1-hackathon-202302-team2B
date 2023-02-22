<?php

namespace App\Http\Requests\DeliveryAddress;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
{
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
        return [
            'name'        => 'required|string|max:255',
            'tel'         => 'required|string|max:255|regex:/^\d{2,4}-?\d{2,4}-?\d{4}$/',
            'postal_code' => 'required|string|max:255|regex:/^\d{3}-?\d{4}$/',
            'city'        => 'required|string|max:255',
            'address_1'   => 'required|string|max:255',
            'address_2'   => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'name'        => '名前',
            'tel'         => '電話番号',
            'postal_code' => '郵便番号',
            'city'        => '市区町村',
            'address_1'   => '住所1',
            'address_2'   => '住所2',
        ];
    }
}
