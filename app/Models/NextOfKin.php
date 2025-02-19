<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    /** @use HasFactory<\Database\Factories\NextOfKinFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'relationship'
    ];

    // Relationship with Beneficiary
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class, 'next_of_kin_id');
    }
}
