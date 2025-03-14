<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $fillable = ['province'];

    public function programs()
    {
        return $this->belongsToMany(Project::class, 'project_province');
    }

    public function beneficiaries()
    {
        return $this->belongsToMany(Beneficiary::class, 'beneficiary_program_project_location')
                    ->withPivot('project_id', 'enrollment_date')
                    ->withTimestamps();
    }
}
