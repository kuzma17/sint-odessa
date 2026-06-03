<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
            'translations.ru.question' => ['required', 'string'],
            'translations.ru.answer' => ['required', 'string'],
            'translations.ua.question' => ['required', 'string'],
            'translations.ua.answer' => ['required', 'string'],
        ];
    }
}
