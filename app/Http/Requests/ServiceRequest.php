<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'image_card' => $this->isMethod('post') ? ['required', 'array', 'min:1'] : ['nullable'],
            'image' => $this->isMethod('post') ? ['required', 'array', 'min:1'] : ['nullable'],
            'model.slug' => ['required'],
            'translations.ru.title' => ['required', 'string'],
            'translations.ua.title' => ['required', 'string'],
            'translations.ru.description' => ['required', 'string'],
            'translations.ua.description' => ['required', 'string'],
            'translations.ru.content' => ['required', 'string'],
            'translations.ua.content' => ['required', 'string'],
        ];
    }
}
