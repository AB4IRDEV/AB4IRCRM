<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    /** @use HasFactory<\Database\Factories\BeneficiaryFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 
        'surname', 
        'age', 
        'dob', 
        'phone', 
        'email', 
        'next_of_kin_name', 
        'next_of_kin_id', 
        'location_id', 
        'next_of_kin_last_name', 
        'relationship', 
        'next_of_kin_phone', 
        'next_of_kin_email', 
        'id_number', 
        'gender',  
        'highest_qualification',
        'photo',
        'created_by', 
        'updated_by', 
    ];
    

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_beneficiary')
                    ->using(\App\Models\ProjectBeneficiary::class)
                    ->withPivot('location_id', 'enrolment_date')
                    ->withTimestamps();
    }
    
    
    public function province()
    {
        return $this->belongsTo(Locations::class, 'location_id');
                    
    }
    
     // Relationship with Next of Kin
     public function nextOfKin() {
        return $this->belongsTo(NextOfKin::class, 'next_of_kin_id');
    }
    

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by'); // Link to User model
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }


    protected $casts = [
        'dob' => 'date',
    ];
}
