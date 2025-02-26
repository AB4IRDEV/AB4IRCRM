<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBeneficiaryRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:100',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:beneficiaries,email|max:255',
            'next_of_kin_name' => 'required|string|max:255',
            'next_of_kin_last_name' => 'required|string|max:255',
            'relationship' => 'required|in:Parent,Sibling,Spouse,Guardian,Relative,Friend,Other',
            'next_of_kin_phone' => 'required|string|max:15',
            'next_of_kin_email'=>'nullable|email|max:255',
            'id_number' => 'required|string|size:13|unique:beneficiaries,id_number',
            'gender' => 'required',
            'dob' => 'required',
            'highest_qualification' => 'nullable|string|max:255',
            'photo' => 'nullable|mimes:png,jpg,jpeg',
            'province_id'               => 'required',
            'program_id'                => 'required',
            
        ];
    }
}
