<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTemplate extends Model
{
    protected $fillable = ['program_id', 'title', 'description'];

    public function program()
    {
        return $this->belongsTo(Programs::class);
    }
}
