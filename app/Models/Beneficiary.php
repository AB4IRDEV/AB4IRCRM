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
        'next_of_kin_last_name', 
        'relationship', 
        'next_of_kin_phone', 
        'next_of_kin_email', 
        'id_number', 
        'gender', 
        'location', 
        'highest_qualification',
        'created_by', 
        'updated_by', 
    ];
    

    public function program()
    {
        return $this->belongsTo(Program::class);
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

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'beneficiary_program');
    }

    protected $casts = [
        'dob' => 'date',
    ];
}
