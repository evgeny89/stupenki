<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchAutocompleteRequest extends FormRequest
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
            'search' => 'required|string|min:3',
        ];
    }

    public function messages()
    {
        return [
            'search.required' => 'Поисковая строка пуста...',
            'search.string' => 'Поисковая фраза должна быть текстом.',
            'search.min' => 'Поисковая фраза нге может быть короче 3 символов.',
        ];
    }
}
