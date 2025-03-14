<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
                'program_id'=>'required',
                'project_template_id'=>'required',
                'title' =>'required',
                'description'=> 'nullable', 
                'accredited'=> 'nullable',
                'nqf_level'=> 'nullable',
                'start_date'=> 'nullable',
                'end_date'=> 'nullable',
                'year'=> 'nullable',
                'budget'=> 'nullable',
                'status' => 'required|in:active,completed,cancelled',
                'program_manager_id'=> 'nullable',
                'intended_beneficiaries'=> 'nullable',
                'completed_beneficiaries'=> 'nullable',
                'location_id' => 'nullable|array',
                'stakeholder_id' => 'required',
                'created_by', 
                'updated_by'
                ];
    }
}
