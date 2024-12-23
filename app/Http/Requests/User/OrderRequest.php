<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'plan_id' => ['required', Rule::exists('plans', 'id')->where('photographer_id', $this->photographer_id)],
            'addons' => ['array'],
            'addons.*' => ['integer', Rule::exists('plan_addons', 'id')->where('plan_id', $this->plan_id)],
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
