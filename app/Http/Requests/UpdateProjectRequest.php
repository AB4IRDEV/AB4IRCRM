<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'program_id' => 'required',
            'project_template_id' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'accredited' => 'nullable',
            'nqf_level' => 'nullable',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'year' => 'nullable|integer|min:2000|max:' . date('Y'),
            'budget' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,completed,cancelled',
            'program_manager_id' => 'nullable|exists:users,id',
            'intended_beneficiaries' => 'nullable|integer|min:0',
            'completed_beneficiaries' => 'nullable|integer|min:0',
            'location_id' => 'nullable|array',
            'stakeholder_id' => 'required',
            'stakeholder_id.*' => 'exists:stakeholders,id',
            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id'
        ];
        
    }
}
