<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramFactory> */
    use HasFactory;

    protected $fillable = [

                           'title', 
                           'description', 
                           'accredited',
                           'nqf_level',
                           'start_date',
                           'end_date',
                           'year',
                           'budget',
                           'status',
                           'program_manager_id',
                           'intended_beneficiaries',
                           'completed_beneficiaries',
                           'created_by', 
                           'updated_by'
                        ];

public function provinces()
{
    return $this->belongsToMany(Province::class, 'project_location', 'project_id', 'province_id');
}
                       
public function beneficiaries()
{
    return $this->belongsToMany(Beneficiary::class, 'beneficiary_program_project_location')
                ->withPivot('province_id', 'enrollment_date')
                ->withTimestamps();
}

public function stakeholders()
{
    return $this->belongsToMany(Stakeholder::class, 'funder_project')
                ->withTimestamps();
}

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
