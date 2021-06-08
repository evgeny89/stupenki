<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetStupenkaRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'country' => 'required|string|min:3',
            'city' => 'required|string|min:3',
            'name' => 'required|string|min:5',
            'count' => 'required|integer|numeric',
        ];
    }
}
