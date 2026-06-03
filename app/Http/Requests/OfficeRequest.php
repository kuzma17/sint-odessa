<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => $this->isMethod('post') ? ['required', 'array', 'min:1'] : ['nullable'],
            'model.phones' => 'nullable|array|min:1|max:5',
            'model.phones.*' => 'required|string|size:9',
            'translations.ru.title' => ['required', 'string'],
            'translations.ua.title' => ['required', 'string'],
            'translations.ru.address' => ['required', 'string'],
            'translations.ua.address' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'model.phones.*.required' => 'Поле телефона обязательно',
            'model.phones.*.size' => 'Телефон должен содержать 12 цифр',
            'model.phones.min' => 'Добавьте хотя бы один телефон',
            'model.phones.max' => 'Не более 5 телефонов',
        ];
    }
}
