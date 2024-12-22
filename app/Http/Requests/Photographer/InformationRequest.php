<?php

namespace App\Http\Requests\Photographer;

use Illuminate\Foundation\Http\FormRequest;

class InformationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'bio' => ['required', 'string'],
            'city' => ['required'],
            'country' => ['required'],
            'age' => ['required', 'numeric'],
            'services' => ['array'],
            'services.*' => ['required'],
            'services.*.service_id'=> ['exists:services,id']
        ];
    }
}
