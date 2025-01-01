<?php

namespace App\Http\Requests\Admin;

use App\Models\Photographer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'id' => ['request', 'exists:users,id'],
            'name' => ['required', 'string', 'max:191'],
            'email' => ['nullable', 'email', 'unique:users,email,'. $this->id],
            'dob' => ['required', 'date'],
            'gender' => ['required', Rule::in(Photographer::GENDER)],
            'phone' => ['required', 'string', 'max:20', 'unique:users,phone,'. $this->id],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,heif'],
            'password' => ['nullable', Password::defaults()]

        ];
    }
}
