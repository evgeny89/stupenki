<?php

namespace App\Http\Requests;

use App\Models\City;
use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchGetStupenkiRequest extends FormRequest
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
            'type' => ['required', 'string', Rule::in(['city', 'country'])],
            'value' => ['required', 'integer', function($attribute, $value, $fail) {
                    $city = City::whereId($value)->exists();
                    $country = Country::whereId($value)->exists();
                    if (!$city && !$country) {
                        return $fail('Выбранное значение не найдено');
                    }
                    return true;
            }],
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Невозможно определить тип выбранного значения',
            'type.string' => 'Не правильный формат типа',
            'type.in' => 'Выбранный тип не соответствует ниодному из разрешенных',
            'value.required' => 'Не получено выбранное значение',
            'value.integer' => 'Неверный формат выбранного значения',
        ];
    }
}
