<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'photographer_id' => ['required', 'exists:photographers,id'],
            'plan_id' => ['required', 'exists:plans,id'],
            'addons' => ['array'],
            'addons.*' => ['integer', 'exists:addons,id'],
            'name' => ['required', 'string', 'max:191'],
            'type' => ['required', 'string', 'max:191'],
            'date' => ['required', 'date', 'after:today'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string', 'max:191'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'percentage_to_pay' => ['required', 'integer']
        ];
    }
}
