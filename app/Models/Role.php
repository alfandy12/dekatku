<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends SpatieRole
{
    //
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
