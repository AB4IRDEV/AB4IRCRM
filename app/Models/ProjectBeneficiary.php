<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectBeneficiary extends Pivot
{
    public function location()
    {
        return $this->belongsTo(Locations::class, 'location_id');
    }
}
