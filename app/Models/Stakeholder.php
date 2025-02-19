<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stakeholder extends Model
{
    /** @use HasFactory<\Database\Factories\StakeholderFactory> */
    use HasFactory;
    const TYPES = ['Funder', 'Associate', 'Impelementing Partner', 'supplier'];
    protected $fillable = ['organisation', 'type', 'contact_person', 'email', 'phone', 'created_by', 'updated_by'];

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_funder')
            ->withPivot('financial_year')
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
