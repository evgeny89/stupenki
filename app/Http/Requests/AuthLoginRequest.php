<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
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
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Поле E-mail незаполнено',
            'email.exists' => 'Такой e-mail адрес в базе данных не найден',
            'password.required' => 'Поле Password является обязательным',
            'password.min' => 'Поле Password не может быть короче 6 символов',
        ];
    }
}
