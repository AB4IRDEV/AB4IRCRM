<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'stakeholder_id' => 'required|exists:stakeholders,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'email' => 'nullable|email|max:255',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
        ];
    }
}
