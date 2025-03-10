<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable=[
        'stakeholder_id',
        'name',
        'email',
        'phone',
        'department',
        'position',
        'created_by',
        'update_by',
    ];


    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class);
    }
}