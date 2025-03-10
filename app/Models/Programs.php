<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramsFactory> */
    use HasFactory;

    protected $fillable = [

        'title', 
        'description', 
        'created_by', 
        'updated_by'
     ];
}
