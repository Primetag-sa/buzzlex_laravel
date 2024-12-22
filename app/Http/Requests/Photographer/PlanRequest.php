<?php

namespace App\Http\Requests\Photographer;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'is_recommended' => ['required', 'boolean'],
            'type' => ['required', 'string'],
            'features' => ['required', 'array', 'min:1'],
            'features.*' => ['required'],
            'features.*.feature' => ['required', 'string', 'max:191'],
            'addons' => ['array'],
            'addons.*' => ['required'],
            'addons.*.name' => ['required', 'string', 'max:191'],
            'addons.*.price' => ['required', 'numeric'],
            'addons.*.type' => ['required', 'string', 'max:191'],
            'conditions' => ['array'],
            'conditions.*' => ['required'],
            'conditions.*.condition' => ['required', 'string', 'max:191'],
            'outputs' => ['array'],
            'outputs.*' => ['required'],
            'outputs.*.name' => ['required', 'string', 'max:191'],
            'outputs.*.description' => ['nullable', 'string', 'max:191'],
            'outputs.*.size' => ['string', 'max:191'],
            'outputs.*.color' => ['string', 'max:191'],
            'outputs.*.type' => ['string', 'max:191'],
            'outputs.*.receipt_after' => ['integer'],
            'outputs.*.images' => ['array'],
            'outputs.*.images.*' => ['image', 'mimes:jpg,jpeg,png,heif']
        ];
    }
}
