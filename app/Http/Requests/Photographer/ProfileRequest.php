<?php

namespace App\Http\Requests\Photographer;

use App\Models\Photographer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'dob' => ['required', 'date'],
            'gender' => ['required', Rule::in(Photographer::GENDER)],
            'phone' => ['required', 'string', 'max:20', 'unique:photographers,phone,'. auth()->id()],
            'email' => ['required', 'email', 'max:191', 'unique:photographers,email,'. auth()->id()],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,heif']
        ];
    }
}
