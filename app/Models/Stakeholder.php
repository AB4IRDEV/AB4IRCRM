<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stakeholder extends Model
{
    /** @use HasFactory<\Database\Factories\StakeholderFactory> */
    use HasFactory;
    const TYPES = ['Funder', 'Associate', 'Impelementing_Partner', 'Supplier'];
    protected $fillable = ['organisation', 'type', 'email', 'phone','address', 'created_by', 'updated_by', 'logo'];

  

    public function programs()
    {
        return $this->belongsToMany(Project::class, 'funder_project');
    }
    public function contacts()
    {
        return $this->hasMany(Contact::class);
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
