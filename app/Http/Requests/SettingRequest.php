<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'image_logo' => $this->isMethod('post') ? ['required', 'array', 'min:1'] : ['nullable'],
            'image_logo_footer' => $this->isMethod('post') ? ['required', 'array', 'min:1'] : ['nullable'],
            'model.data.title.ru' => ['required', 'string'],
            'model.data.title.ua' => ['required', 'string'],
            'model.data.description.ru' => ['required', 'string'],
            'model.data.description.ua' => ['required', 'string'],
            'model.data.address.ru' => ['required', 'string'],
            'model.data.address.ua' => ['required', 'string'],
            'model.data.phones' => 'nullable|array|min:1|max:5',
            'model.data.phones.*' => 'required|string|size:9',
            'model.data.email' => ['required', 'string'],
//            'model.data.viber' => ['required', 'string'],
//            'model.data.facebook' => ['required', 'string'],
//            'model.data.twitter' => ['required', 'string'],
//            'model.data.instagram' => ['required', 'string'],
//            'model.data.telegram' => ['required', 'string'],
//            'model.data.telegram_chat_id' => ['required', 'string'],
//            'model.data.telegram_chat_id.*' => ['required', 'string'],
            'model.data.working_hours_week' => ['required', 'string'],
            'model.data.working_hours_sat' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'model.data.phones.*.required' => 'Поле телефона обязательно',
            'model.data.phones.*.size' => 'Телефон должен содержать 12 цифр',
            'model.data.phones.min' => 'Добавьте хотя бы один телефон',
            'model.data.phones.max' => 'Не более 5 телефонов',
        ];
    }
}
