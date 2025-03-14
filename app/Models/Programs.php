<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramsFactory> */
    use HasFactory;

    protected $fillable = [

        'name', 
        'description', 
        'created_by', 
        'updated_by'
     ];

     public function stakeholders()
{
    return $this->belongsTo(Stakeholder::class, 'project_stakeholder')
                ->withTimestamps();
}
     
}
