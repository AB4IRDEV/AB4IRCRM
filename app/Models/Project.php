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
    return $this->belongsToMany(Locations::class, 'project_location', 'project_id', 'location_id')
                ->withTimestamps();
}
                        

 public function programs()
 {
    return $this->belongsToMany(Programs::class, 'program_project', 'project_id', 'program_id')
                ->withPivot('project_template_id');
         
 }
 
 public function location()
 {
     return $this->belongsTo(Locations::class, 'location_id');
 }
 
                       
 public function beneficiaries()
 {
     return $this->belongsToMany(Beneficiary::class, 'project_beneficiary')
                 ->withPivot('location_id', 'enrolment_date')
                 ->withTimestamps();
 }
 

public function stakeholders()
{
    return $this->belongsToMany(Stakeholder::class, 'project_stakeholder', 'project_id', 'stakeholder_id');
}

public function manager(){

    return $this->belongsTo(User::class, 'program_manager_id');
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
