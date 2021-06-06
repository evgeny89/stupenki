<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле Name является обязательным',
            'email.required' => 'Поле E-mail является обязательным',
            'email.email' => 'Поле E-mail не соответствует шаблону',
            'email.unique' => 'Пользователь с таким e-mail уже зарегистрирован',
            'password.required' => 'Поле Password является обязательным',
            'password.min' => 'Поле Password не может быть короче 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
            'password_confirmation.required' => 'Поле Password confirm является обязательным',
        ];
    }
}
