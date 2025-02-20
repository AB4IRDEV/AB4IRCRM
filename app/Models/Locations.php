<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $fillable = ['province'];

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_location');
    }

    public function beneficiaries()
    {
        return $this->belongsToMany(Beneficiary::class, 'beneficiary_program_location')
                    ->withPivot('program_id', 'enrollment_date')
                    ->withTimestamps();
    }
}
