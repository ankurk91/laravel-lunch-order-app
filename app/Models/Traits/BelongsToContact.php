<?php

namespace App\Models\Traits;

use App\Models\User;

trait BelongsToUser
{

    /**
     * This resource belong to al-least one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
