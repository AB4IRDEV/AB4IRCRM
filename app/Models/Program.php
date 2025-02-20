<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramFactory> */
    use HasFactory;

    protected $fillable = ['title', 
                           'description', 
                           'accredited',
                           'nqf_level',
                           'start_date',
                           'end_date',
                           'year',
                           'budget',
                           'Status',
                           'program_manager_id',
                           'intended_beneficiaries',
                           'completed_beneficiaries',
                           'created_by', 
                           'updated_by'];

public function locations()
{
    return $this->belongsToMany(Locations::class, 'program_location');
}
                       
public function beneficiaries()
{
    return $this->belongsToMany(Beneficiary::class, 'beneficiary_program_location')
                ->withPivot('location_id', 'enrollment_date')
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
