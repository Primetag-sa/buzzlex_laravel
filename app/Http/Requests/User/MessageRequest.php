<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'message' => ['nullable'],
            'photographer_id' => ['required', 'exists:photographers,id'],
            'media' => ['nullable', 'array'],
            'media.*' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'record' => ['nullable', 'file']
        ];
    }
}
