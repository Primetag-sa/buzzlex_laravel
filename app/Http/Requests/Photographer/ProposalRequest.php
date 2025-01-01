<?php

namespace App\Http\Requests\Photographer;

use App\Models\GeneralOrder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProposalRequest extends FormRequest
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
            'general_order_id' => ['required', Rule::exists('general_orders', 'id')->where('status', GeneralOrder::PENDING)],
            'plan_id' => ['required', Rule::exists('plans', 'id')],
            'price' => ['nullable', 'numeric'],
        ];
    }
}
