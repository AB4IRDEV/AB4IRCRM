<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStakeholderRequest extends FormRequest
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
            
            'organisation'=>'required|string|max:255',
            'phone'=>'nullable|max:10',
            'type'=>'required',
            'email'=>'nullable|email|string|max:255',
            'address'=>'nullable|string|max:255',
            'image'=>'nullable|mimes:jpg,png,jpeg',
            
        ];
    }
}
